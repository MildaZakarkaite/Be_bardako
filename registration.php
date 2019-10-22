<?php
require 'functions/form/core.php';
require 'functions/html/generators.php';
require 'functions/file.php';

$form = [
    'attr' => [
        'action' => '',
    ],
    'fields' => [
        'full_name' => [
            'type' => 'text',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter Full Name',
                ]
            ],
            'validators' => [
                'validate_not_empty',
            ],
        ],
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
                'validate_email_unique'
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
        'password_repeat' => [
            'type' => 'password',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter Password',
                ]
            ],
            'validators' => [
            ],
        ],
    ],
    'validators' => [
        'validate_fields_match' => [
            'password',
            'password_repeat'
        ]
    ],
    'buttons' => [
        'registration' => [
            'type' => 'submit',
            'value' => 'Registruotis',
            'class' => 'buttons'
        ]
    ],
    'callbacks' => [
        'fail' => 'form_fail',
        'success' => 'form_success'
    ]
];

function form_success($filtered_input, $form) {
    $users_array = file_to_array('data/users.txt');
    $users_array[] = $filtered_input;
    array_to_file($users_array, 'data/users.txt');
    header('Location: login.php');
}

function form_fail($filtered_input, &$form) {
    $form['message'] = 'Formoje yra klaidų!';
}

$filtered_input = get_filtered_input($form);

if (!empty($filtered_input)) {
    validate_form($filtered_input, $form);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include 'navbar.php'; ?>   
        <div>
            <div class="container-registration">
                <?php require 'templates/form.tpl.php'; ?>       
            </div> 
        </div>
        <?php include 'bubbles.php'; ?> 
    </body>
    <footer>2006 - 2019 © UAB „Digital Projects“</footer>
</html>