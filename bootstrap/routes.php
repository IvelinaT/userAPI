<?php
$app->get('/users', 'UserController:listUsers')->setName('users-list');
$app->get('/users/{id:[0-9]+}', 'UserController:showUser')->setName('user-show');
$app->post('/users', 'UserController:addUser')->setName('user-add');
$app->post('/users/{id:[0-9]+}', 'UserController:editUser')->setName('user-edit');
$app->delete('/users/{id:[0-9]+}', 'UserController:deleteUser')->setName('user-delete');
