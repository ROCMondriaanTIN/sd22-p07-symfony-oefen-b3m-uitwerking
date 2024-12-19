-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 23, 2024 at 09:48 AM
-- Server version: 8.2.0
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `symfony`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
                            `id` int NOT NULL,
                            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `image`) VALUES
                                                                  (1, 'Vleesch pizza', 'De lekkerste carnivoren pizza\'s vind je hier', '/images/pizza.png'),
                                                                  (2, 'Visch pizza', 'Je bent verkeerd, ga naar vleesch', '/images/tonno.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
                                               `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
                                               `executed_at` datetime DEFAULT NULL,
                                               `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
    ('DoctrineMigrations\\Version20240323070640', '2024-03-23 07:06:49', 71);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
                                      `id` bigint NOT NULL,
                                      `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                                      `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                                      `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
                                      `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
                                      `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
                                      `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
                         `id` int NOT NULL,
                         `product_id` int DEFAULT NULL,
                         `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `order_price` decimal(5,2) NOT NULL,
                         `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `product_id`, `firstname`, `lastname`, `address`, `order_price`, `size`) VALUES
    (2, 1, 'Michiel', 'Auerbach', 'A Piersonlaan 184', '10.99', 'large');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
                           `id` int NOT NULL,
                           `category_id` int DEFAULT NULL,
                           `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `price` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `description`, `image`, `price`) VALUES
                                                                                         (1, 1, 'Pizza Salami', 'Een salami pizza', '/images/pizza.png', '6.99'),
                                                                                         (2, 1, 'Pizza Margaritha', 'De basis pizza der pizza\'s', '/images/pizza.png', '6.99'),
                                                                                         (3, 1, 'Pizza Chicken BBQ', 'Kip en BBQ - de combi die je wilt', '/images/pizza.png', '8.99'),
                                                                                         (4, 1, 'Pizza Shoarma', 'Vanavond geen date? Bestel dan extra knoflooksaus', '/images/pizza.png', '9.99'),
                                                                                         (5, 1, 'Pizza Hawaii zonder ananas', 'Omdat je gewoon geen ananas op een pizza doet maar toch tropisch wilt genieten', '/images/pizza.png', '2.99'),
                                                                                         (6, 1, 'Pizza Calzone', 'Een pizza te groot? Dan vouw je hem toch lekker dubbel', '/images/pizza.png', '11.99'),
                                                                                         (7, 1, 'Pizza Lamsbout', 'Pizza en een groot stuk vleesch :-) ', '/images/pizza.png', '15.99'),
                                                                                         (8, 2, 'Pizza Tonno', 'Als je wilt dat je vrienden uit de buurt blijven', '/images/tonno.jpg', '7.99'),
                                                                                         (9, 2, 'Pizza Garnalencocktail', 'Normaal in een glas, maar alles kan op een pizza, dus ook cocktailsaus en garnalen', '/images/tonno.jpg', '16.99'),
                                                                                         (10, 2, 'Pizza Zeevruchten', 'Nee niets gezonds, gewoon een hoop zee-smurrie bij elkaar', '/images/tonno.jpg', '26.99'),
                                                                                         (11, 2, 'Pizza Gravalax', 'Een soort zelfbouw pizza, Gravalax van de Ikea op een deegbodem', '/images/tonno.jpg', '18.99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
    ADD PRIMARY KEY (`version`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
    ADD PRIMARY KEY (`id`),
    ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
    ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
    ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
    ADD PRIMARY KEY (`id`),
    ADD KEY `IDX_F52993984584665A` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
    ADD PRIMARY KEY (`id`),
    ADD KEY `IDX_D34A04AD12469DE2` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
    MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
    ADD CONSTRAINT `FK_F52993984584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
    ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
