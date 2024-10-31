<?php

namespace Http\Controllers;

use CORE\BaseController;

class AboutController extends BaseController
{
    function index(): void
    {
        $this->view('about.view.php');
    }

}