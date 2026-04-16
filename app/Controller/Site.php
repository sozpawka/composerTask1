<?php

namespace Controller;

use Src\View;

class Site
{
   public function index(): string
   {
       return (string) new \Src\View('site.index');
   }
}