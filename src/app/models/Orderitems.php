<?php

use Phalcon\Mvc\Model;

class Orderitems extends Model
{
    public $order_id;
    public $product_id;
    public $discount;
    public $quantity;
}