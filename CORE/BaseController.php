<?php

namespace CORE;

class BaseController
{

   protected function view($viewName,$Attributes=[]): void
   {
        extract($Attributes);
        require BASEPATH('views/'.$viewName);
    }

   protected function redirect($Path)
    {
        header("location :{$Path}");
        exit();
    }
    public function isUserLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }



}