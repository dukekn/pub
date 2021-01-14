<?php

//Get config
require_once  'definers.php';
require_once  'core/config/database.php';

require 'controllers'.DIRECTORY_SEPARATOR.'Car.php';

$cars = new App\Controllers\Car;

$offset = filter_var($_GET['offset'] ?? 0, FILTER_SANITIZE_NUMBER_INT);

$results_array = json_decode($cars->getResults($offset));
$results_list          = $results_array->results ?? null;

require 'view'. DIRECTORY_SEPARATOR . 'index.php';

