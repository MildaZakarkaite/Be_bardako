
<?php
session_start();

require 'functions/html/generators.php';
require 'functions/file.php';

if (!empty($_SESSION)) {
//    Prisijungęs

    $users = file_to_array('data/users.txt');
    foreach ($users as $user) {
        if ($user['email'] == $_SESSION['cookie_email']) {
            $full_name = $user['full_name'];
        }
    }
    $text = "Sveikas atvykęs, $full_name";
} else {
    $text = 'Jūs esate neprisijungęs';
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>home</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
<?php include 'navbar.php'; ?>   
        <?php include 'bubbles.php'; ?> 
        <div>
            <div>
<?php require 'templates/form.tpl.php'; ?>       
            </div> 
        </div>
        <h1><?php print $text; ?></h1>       
    </body>
    <footer>2006 - 2019 © UAB „Digital Projects“</footer>
</html>