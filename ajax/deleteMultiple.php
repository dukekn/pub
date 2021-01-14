<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    require_once  '../definers.php';
    require_once  '../core/config/database.php';

    require '../controllers'.DIRECTORY_SEPARATOR.'Car.php';

    $array_str = filter_var($_POST['id_arr'] , FILTER_SANITIZE_STRING);

    $cars = new App\Controllers\Car;

    return $cars->deleteMultiple($array_str);
}