<?php

namespace App\Controller;

use App\Entity\Appointment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScheduleController extends AbstractController
{
    #[Route('/schedule', name: 'app_schedule')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $appointments = $entityManager->getRepository(Appointment::class)->findAll();

        $currentMonth = date('m');
        $currentYear = date('Y');

        $numberOfDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

        $dayArray = array();

        for ($x = 1; $x <= $numberOfDaysInMonth; $x++) {

            $dayArray[] = $currentYear . '-' . $currentMonth . '-'. $this->getDay($x);
        }

        return $this->render('schedule/index.html.twig', [
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'numberOfDaysInMonth' => $numberOfDaysInMonth,
            'dayArray' => $dayArray,
            'appointments' => $appointments
        ]);
    }

    private function getDay(int $x): string
    {
        if($x < 10){
            return '0'. $x;
        }
        return (string)$x;
    }
}
