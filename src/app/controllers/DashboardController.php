<?php
use Phalcon\Mvc\controller;

class DashboardController extends controller
{
    public function indexAction()
    {
        if (!$this->session->id) {
            header('location: login');
        }
        $this->view->date=$this->serverDate;
    }
}
