<?php

return [
    'category/([0-9]+)/page-([0-9]+)' => 'category/view/$1/$2',
    'category/([0-9]+)' => 'category/view/$1',

    'post/([0-9]+)' => 'post/view/$1',

    'admin/delete/([0-9]+)' => 'admin/delete/$1',
    'admin/edit/([0-9]+)' => 'admin/edit/$1',
    'admin/list/page-([0-9]+)' => 'admin/list/$1',
    'admin/list' => 'admin/list',

    'admin/categories/delete/([0-9]+)' => 'admin/categories_delete/$1',
    'admin/categories/edit/([0-9]+)' => 'admin/categories_edit/$1',
    'admin/categories/page-([0-9]+)' => 'admin/categories/$1',
    'admin/categories' => 'admin/categories',
    'admin/category' => 'admin/category',

    'admin' => 'admin/main',

    'cabinet' => 'cabinet/main',

    'register'=>'user/register',
    'login' => 'user/login',
    'logout' => 'user/logout',

    '' => 'main/index',
];
