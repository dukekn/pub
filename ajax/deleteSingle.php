<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    require_once  '../definers.php';
    require_once  '../core/config/database.php';

    require '../controllers'.DIRECTORY_SEPARATOR.'Car.php';

    $id = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT);

    $cars = new App\Controllers\Car;

    return $cars->deleteSingle($id);
}