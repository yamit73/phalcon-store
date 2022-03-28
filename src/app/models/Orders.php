<?php

use Phalcon\Mvc\Model;

class Orders extends Model
{
    public $order_id;
    public $user_id;
    public $first_name;
    public $last_name;
    public $email;
    public $status;
    public $shipping_address;
    public $country;
    public $state;
    public $shipping_pincode;
    public $order_date;
    public $delivery_date;
}