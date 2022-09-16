<?php

use App\Classes\FormBuilder;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$form = new FormBuilder();

echo $form->open('index.php', 'POST');

echo $form->label('name', 'Your name');
echo $form->input('text', 'Enter value', 'name', 'name');
echo '<br>';

echo $form->label('password', 'Your password');
echo $form->input('password', 'Enter password', 'password', 'password');
echo '<br>';

echo $form->label('name', 'Repeat password');
echo $form->password('Enter password');
echo '<br>';

echo $form->checkbox('checkbox1', 'checkbox1', checked: true);
echo $form->label('checkbox1', 'checkbox1');

echo $form->checkbox('checkbox2', 'checkbox2');
echo $form->label('checkbox2', 'checkbox2');
echo '<br>';

echo $form->textarea('Enter additional info...', rows: 5, cols: 30);
echo '<br>';

echo $form->submit('Go');
echo '<br>';

echo $form->close();