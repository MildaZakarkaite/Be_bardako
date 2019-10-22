<?php
session_start();

require 'functions/form/core.php';
require 'functions/html/generators.php';
require 'functions/file.php';

$form = [
    'attr' => [
        'action' => '',
    ],
    'fields' => [
        'email' => [
            'type' => 'text',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter Email',
                ]
            ],
            'validators' => [
                'validate_not_empty',
                'validate_email',
            ],
        ],
        'password' => [
            'type' => 'password',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter Password',
                ]
            ],
            'validators' => [
                'validate_not_empty',
            ],
        ],
    ],
    'buttons' => [
        'login' => [
            'type' => 'submit',
            'value' => 'Login',
            'class' => 'buttons'
        ]
    ],
    'validators' => [
        'validate_login'
    ],
    'callbacks' => [
        'fail' => 'form_fail',
        'success' => 'form_success'
    ]
];

function form_success($filtered_input, $form) {
    $_SESSION['cookie_email'] = $filtered_input['email'];
    $form['message'] = 'sveiki,sugrįžę';
    header('Location: home.php');
}

function form_fail($filtered_input, &$form) {
 $form['message'] = 'Formoje yra klaidų';
}

$filtered_input = get_filtered_input($form);

if (!empty($filtered_input)) {
    validate_form($filtered_input, $form);
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include 'navbar.php'; ?>   
        <div>
            <div class="container-login">
                <?php require 'templates/form.tpl.php'; ?>       
            </div> 
        </div>
        <?php include 'bubbles.php'; ?> 
    </body>
    <footer>2006 - 2019 © UAB „Digital Projects“</footer>
</html>

