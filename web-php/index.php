<?php
// Minimální stránka – projekt slouží jen k testu skeneru závislostí.
require __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\ArrayLoader(['index' => 'Ahoj {{ name }}!']);
$twig = new \Twig\Environment($loader);
echo $twig->render('index', ['name' => 'Trivy']);
