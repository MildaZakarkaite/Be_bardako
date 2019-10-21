<?php
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
            'class' => ''
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
}

function form_fail($filtered_input, &$form) {
    $form['message'] = 'Formoje yra klaid?!';
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
        <style>
            body{
                background: url('http://4.bp.blogspot.com/-iaWUF3aInY0/VMBAAcIfnwI/AAAAAAAA2fs/GMSdHWC8fxs/s1600/zone-baignade-en-vau.jpg');
                background-size: cover;
                color: #333;
                font: 100% Lato, Arial, Sans Serif;
                height: 100vh;
                overflow-x: hidden;
            }

            div{
                display: flex;
                justify-content: center;
                margin-top: 30px;
            }

            input{
                text-align: center;
                margin: 5px;
                border-color: block;
            }

            .create{
                background-color: lightsteelblue;
            }
        </style>
    </head>
    <body>
        <div>
            <div>
                <?php require 'templates/form.tpl.php'; ?>       
            </div> 
        </div>
    </body>
</html>

