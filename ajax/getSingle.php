<?php

//Get config
require_once '../definers.php';
require_once '../core/config/database.php';

require '../controllers' . DIRECTORY_SEPARATOR . 'Car.php';

$id = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT);
$cars = new App\Controllers\Car;

$single =  $cars->getSingle($id);

$is_automatic_true = ($single->is_automatic == 'true')? 'selected' : '';
$is_automatic_false = ($single->is_automatic == 'false')? 'selected' : '';

$is_4x4_true = ($single->is_4x4  == 'true')? 'selected' : '';
$is_4x4_false = ($single->is_4x4 == 'false')? 'selected' : '';

$is_hybrid_true = ($single->is_hybrid == 'true')? 'selected' : '';
$is_hybrid_false = ($single->is_hybrid == 'false')? 'selected' : '';

$fuel_Gasoline = ($single->fuel == 'Gasoline')? 'selected' : '';
$fuel_Gasoline_Hybrid = ($single->fuel == 'Gasoline Hybrid')? 'selected' : '';
$fuel_Diesel = ($single->fuel == 'Diesel')? 'selected' : '';
$fuel_Electric = ($single->fuel == 'Electric')? 'selected' : '';
$fuel_Compressed_Natural_Gas = ($single->fuel == 'Compressed Natural Gas')? 'selected' : '';


 $html = '
           <section class="header">
            <h2>Edit Car '.$single->manufacturer.'</h2>
            <span class="close" onclick="_close(\'.edit\');">X</span>
        </section>
        <section class="general">
            <h2>General</h2>
            <hr>
            <fieldset>
                <h3>Manufacturer</h3>
                <input type="text" name="edit_manufacturer"  value="'.$single->manufacturer.'" required>
            </fieldset>
            <fieldset>
                <h3>Model</h3>
                <input type="text" name="edit_model"  value="'.$single->model.'" required>
            </fieldset>
            <fieldset>
                <h3>Model year</h3>
                <input type="number" name="edit_year" value="'.$single->year.'" required>
            </fieldset>
            <fieldset>
                <h3>Engine</h3>
                <input type="text" name="edit_engine" value="'.$single->engine.'" required>
            </fieldset>
            <fieldset>
                <h3>Fuel type</h3>
                <select name="edit_fuel" required>
                    <option value="">- choose option -</option>
                    <option value="Gasoline"  '.$fuel_Gasoline.'>Gasoline</option>
                    <option value="Gasoline Hybrid"  '.$fuel_Gasoline_Hybrid.'>Gasoline Hybrid</option>
                    <option value="Diesel"  '.$fuel_Diesel.'>Diesel</option>
                    <option value="Electric"  '.$fuel_Electric.'>Electric</option>
                    <option value="Compressed Natural Gas"  '.$fuel_Compressed_Natural_Gas.'>Compressed Natural Gas</option>
                </select>
            </fieldset>
        </section>
        <section class="attributes">
            <h2>Attributes</h2>
            <hr>
            <fieldset>
                <h3>Hybrid</h3>
                <select name=\'edit_is_hybrid\' required>
                    <option value=\'\'>- choose option -</option>
                    <option value=\'true\' '.$is_hybrid_true.'>Yes</option>
                    <option value=\'false\'  '.$is_hybrid_false.'>No</option>
                </select>
            </fieldset>
            <fieldset>
                <h3>4x4</h3>
                <select name=\'edit_is_4x4\' required>
                    <option value=\'\'>- choose option -</option>
                    <option value=\'true\' '.$is_4x4_true.'>Yes</option>
                    <option value=\'false\' '.$is_4x4_false.'>No</option>
                </select>
            </fieldset>
            <fieldset>
                <h3>Automatic gearbox</h3>
                <select name=\'edit_is_automatic\' required>
                    <option value=\'\'>- choose option -</option>
                    <option value=\'true\' '.$is_automatic_true.'>Yes</option>
                    <option value=\'false\' '.$is_automatic_false.'>No</option>
                </select>
            </fieldset>
        </section>
        <section class="login">
            <h2>Login</h2>
            <hr>
            <fieldset>
                <h3>Email</h3>
                <input type="email" name="edit_email"  value="'.$single->email.'" required>
            </fieldset>
            <fieldset>
                <h3>Password</h3>
                <input type="password" name="edit_password"  placeholder="************" >
            </fieldset>
        </section>
        <section class="footer">
        <input type="hidden" name="edit_id" value="'.$id.'">
            <button class="background-green" onclick="submit_edit()">Submit</button>
        </section>';


print($html);