<?php
$container['db'] = function ($container) use ($capsule) {

    return $capsule;

};


$container['validator'] = function () {
    \Respect\Validation\Validator::with('\\User\\Validation\\Rules');

    return new \User\Validation\Validator();
};

$container[User\Repository\UserRepository::class] = function () {

    return new \User\Repository\UserRepository();
};

$container[User\Factory\UserFactory::class] = function () {

    return new \User\Factory\UserFactory();
};
$container['UserController'] = function ($container) {
    return new User\Controller\UserController($container,$container->get(User\Repository\UserRepository::class),$container->get(User\Factory\UserFactory::class) );

};





