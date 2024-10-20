<?php

namespace Http\controllers;

use CORE\BaseController;

require BASE_PATH . 'CORE/BaseController.php';

class HomeController extends BaseController
{
    public function index()
    {
        $this->view('index.view.php');
    }
}
$home=new HomeController();
$home->index();