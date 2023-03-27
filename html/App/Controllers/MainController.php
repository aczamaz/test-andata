<?php
namespace App\Controllers;

class MainController extends BaseController
{
    public function index()
    {
        $this->render('index', []);
    }
};