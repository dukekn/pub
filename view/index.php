<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
</head>
<body>
<main>
    <section class="results_container">
        <?= $results_list; ?>
    </section>

    <section class="create hidden">
        <section class="header">
            <h2>Create Car</h2>
            <span class="close"  onclick="_close('.create');">X</span>
        </section>
        <section class="general">
            <h2>General</h2>
            <hr>
            <fieldset>
                <h3>Manufacturer</h3>
                <input type="text" name="create_manufacturer" required>
            </fieldset>
            <fieldset>
                <h3>Model</h3>
                <input type="text" name="create_model" required>
            </fieldset>
            <fieldset>
                <h3>Model year</h3>
                <input type="number" name="create_year" required>
            </fieldset>
            <fieldset>
                <h3>Engine</h3>
                <input type="text" name="create_engine" required>
            </fieldset>
            <fieldset>
                <h3>Fuel type</h3>
                <select name="create_fuel" required>
                    <option value="">- choose option -</option>
                    <option value="Gasoline">Gasoline</option>
                    <option value="Gasoline Hybrid">Gasoline Hybrid</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Electric">Electric</option>
                    <option value="Compressed Natural Gas">Compressed Natural Gas</option>
                </select>
            </fieldset>
        </section>
        <section class="attributes">
            <h2>Attributes</h2>
            <hr>
            <fieldset>
                <h3>Hybrid</h3>
                <select name='create_is_hybrid' required>
                    <option value=''>- choose option -</option>
                    <option value='true'>Yes</option>
                    <option value='false'>No</option>
                </select>
            </fieldset>
            <fieldset>
                <h3>4x4</h3>
                <select name='create_is_4x4' required>
                    <option value=''>- choose option -</option>
                    <option value='true'>Yes</option>
                    <option value='false'>No</option>
                </select>
            </fieldset>
            <fieldset>
                <h3>Automatic gearbox</h3>
                <select name='create_is_automatic' required>
                    <option value=''>- choose option -</option>
                    <option value='true'>Yes</option>
                    <option value='false'>No</option>
                </select>
            </fieldset>
        </section>
        <section class="login">
            <h2>Login</h2>
            <hr>
            <fieldset>
                <h3>Email</h3>
                <input type="email" name="create_email" required>
            </fieldset>
            <fieldset>
                <h3>Password</h3>
                <input type="password" name="create_password" required>
            </fieldset>
        </section>
        <section class="footer">
            <button class="background-green">Submit</button>
        </section>
    </section><!-- //create-->
    <section class="edit hidden"></section>

</main>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="assets/js/main.js"></script>
</html>