<?php
namespace App\Controllers;

class MainController extends BaseController
{
    public function index(): void
    {
        $this->render('index', []);
    }
};