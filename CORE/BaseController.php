<?php

namespace CORE;
use CORE\Database;
class BaseController
{
    public $DB;
    public function __construct()
    {
        $this->DB = App::resolve(Database::class);


    }
   protected function view($viewName,$Attributes=[]): void
   {
        extract($Attributes);
        require BASEPATH('views/'.$viewName);
    }

    protected function redirect($Path)
    {
        header("Location: {$Path}");
        exit();
    }

    public function isUserLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }



}