<?php

use Phalcon\Mvc\Model;

class Products extends Model
{
    public $product_id;
    public $product_image;
    public $product_name;
    public $category_id;
    public $sub_category_id;
    public $price;
    public $list_price;
}