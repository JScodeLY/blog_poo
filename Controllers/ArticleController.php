<?php

namespace App\Controllers;

class ArticleController extends Controller
{
    public function index()
    {
        $donnees = ['a','b'];

        include_once ROOT.'/Views/articles/index.php';
    }
}