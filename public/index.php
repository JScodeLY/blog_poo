<?php

// je définie une constante contenant le dossier racine du projet
define('ROOT',dirname(__DIR__));
echo ROOT;
// use App\Autoloader;
// use App\Models\Articles;
// use App\Models\Users;

// require_once 'Autoloader.php';
// Autoloader::register();

// $model = new Articles;
// $articles = $model->findBy(['status'=>1]);
// $articles = $model->find(2);


// Methode d'hydratation pour la création d'un article
// $donnees = [
//     'title' => 'article hydraté est modifié',
//     'shortDescription' => 'Description courte de l\'article hydraté et modifié',
//     'status'=> 0
// ];

// $article = $model->hydrate($donnees);


// $article = $model
//             ->setTitle('nouvelle article')
//             ->setShortDescription('courte description de la nouvelle article')
//             ->setStatus('1');

// $model->create($article)
// $model->update(5,$article);
// $model->delete(6);
// $model = new Users;

// echo '<pre>';
//     // var_dump($article);
//     // var_dump($model->findAll());
//     var_dump($model);
// echo '</pre>';
