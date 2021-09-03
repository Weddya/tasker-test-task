<?php

return [
    //HomeController
    '' => [
        'controller' => 'home',
        'action' => 'index',
    ],
    'add' => [
        'controller' => 'home',
        'action' => 'add',
    ],
        'edit/{id:\d+}' => [
        'controller' => 'home',
        'action' => 'edit',
    ],
    '{page:\d+}' => [
        'controller' => 'home',
        'action' => 'index',
    ],
    //Sorting
    '{page:\d+}/{sort:\w+}' => [
        'controller' => 'home',
        'action' => 'index',
    ],
    '{sort:sortUsernameAsc}' => [
        'controller' => 'home',
        'action' => 'index',
    ],
    '{sort:sortUsernameDesc}' => [
        'controller' => 'home',
        'action' => 'index',
    ],
    '{sort:sortEmailAsc}' => [
        'controller' => 'home',
        'action' => 'index',
    ],
    '{sort:sortEmailDesc}' => [
        'controller' => 'home',
        'action' => 'index',
    ],
    '{sort:sortStatusAsc}' => [
        'controller' => 'home',
        'action' => 'index',
    ],
    '{sort:sortStatusDesc}' => [
        'controller' => 'home',
        'action' => 'index',
    ],
    //AdminController
    'login' => [
        'controller' => 'admin',
        'action' => 'login',
    ],
    'logout' => [
        'controller' => 'admin',
        'action' => 'logout',
    ],
];