<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../definers.php';
    require_once '../core/config/database.php';

    require '../controllers' . DIRECTORY_SEPARATOR . 'Car.php';

    $manufacturer  = filter_var($_POST['create_manufacturer'], FILTER_SANITIZE_STRING);
    $model                    = filter_var($_POST['create_model'], FILTER_SANITIZE_STRING);
    $year                        = filter_var($_POST['create_year'], FILTER_SANITIZE_STRING);
    $engine                   = filter_var($_POST['create_engine'], FILTER_SANITIZE_STRING);
    $fuel                          = filter_var($_POST['create_fuel'], FILTER_SANITIZE_STRING);
    $is_hybrid             = filter_var($_POST['create_is_hybrid'], FILTER_SANITIZE_STRING);
    $is_4x4                    = filter_var($_POST['create_is_4x4'], FILTER_SANITIZE_STRING);
    $is_automatic   = filter_var($_POST['create_is_automatic'], FILTER_SANITIZE_STRING);
    $email                      = filter_var($_POST['create_email'], FILTER_SANITIZE_EMAIL);
    $password_hash  = password_hash($_POST['create_password'] , PASSWORD_BCRYPT);

    $arr = [
        'manufacturer'   => $manufacturer,
        'model'                     => $model,
        'year'                         => $year,
        'engine'                    => $engine,
        'fuel'                           => $fuel,
        'is_hybrid'             => $is_hybrid,
        'is_4x4'                    => $is_4x4,
        'is_automatic'   => $is_automatic,
        'email'                     => $email,
        'password'           => $password_hash,
    ];
    $cars = new App\Controllers\Car;

     $cars->create($arr);
}