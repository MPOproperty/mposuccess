<?php

return [
    'site_url' => '/',
    'register_url' => '/auth/register/',
    'panel_url' => 'panel',
    'admin_prefix' => 'admin',
    'panel_admin_url' => 'panel/admin',
    'profile_url' => 'profile',
    'teacher_url' => 'admin',

    'company_id' => 0,


    'structure_count'           => '6',

    'news_type_private'         => '1',
    'news_type_company'         => '2',
    'news_type_world'           => '3',
    'entities_storage_img'      => '/images/entities/',
    'news_storage_img'          => '/images/news/',
    'news_private_default_img'  => '/images/news/' . 'default-private.png',
    'news_none_img'             => '/images/news/news_none.png',
    'user_default_img'          => '/images/users/' . 'default.jpg',


    /*
     * Переменная $company_title - переменная которая всегда есть в заголовке в виде названия сайта или компании.
     */
    'company_title' => 'МПО «Успех-М»',

    /*
     * Переменная $default_title - это переменная вызывается в случае отсутствия переменной заголовка.
     */
    'default_title' => 'Значение по умолчанию',

    'site_host'    => 'mpouspehm.com',
    'landing_host' => 'vip.loc'
];