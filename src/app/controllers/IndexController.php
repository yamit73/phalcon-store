<?php

use Phalcon\Mvc\Controller;


class IndexController extends Controller
{
    public function indexAction()
    {
        $products=Products::find();
        $this->view->products=$products;
    }
    public function cartAction()
    {
        $this->view->cart=$this->session->get('cart');
    }
    public function addToCartAction($id)
    {
        $product=Products::findFirst($id);
        if ($product) {
            $this->session->set(
                'cart',
                [
                    'id'=>$product->id,
                    'name'=>$product->product_name,
                    'image'=>$product->product_image,
                    'price'=>$product->list_price,
                    'quantity'=>1
                ]
            );
            $this->response->redirect('');
        }
        print_r($this->session->get('cart'));
        die();
    }
}
