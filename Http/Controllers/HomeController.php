<?php

namespace Http\Controller;

use CORE\BaseController;



class HomeController extends BaseController
{
    public function index()
    {
        $this->view('index.view.php');
    }
}
$home=new HomeController();
$home->index();