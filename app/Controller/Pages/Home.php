<?php

namespace App\Controller\Pages;

use App\Utils\View;

class Home
{
    public static function getHome()
    {
        return View::render('home', [
            'name'=>"MVC",
            'description'=>"Em busca de novos conhecimentos"
        ], 'Home');
    }
}