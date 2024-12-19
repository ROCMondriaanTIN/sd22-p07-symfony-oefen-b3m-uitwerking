<?php

namespace App\Object;

class ShoppingCartProduct
{
    // Properties
    public $product;
    public $quantity;

    function getProduct(){
        return $this->product;
    }

    function setProduct($product){
        $this->product = $product;
    }

    function getQuantity(){
        return $this->quantity;
    }

    function setQuantity($quantity){
        $this->quantity = $quantity;
    }
}