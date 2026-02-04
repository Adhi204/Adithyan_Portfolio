<?php

/**
 * Making Seed Data Configurable.
 * This file contains the default data used to seed the portfolio application.
 */
return [

    'user' => [
        'email' => 'admin@portfolio.test',
        'password' => env('PORTFOLIO_ADMIN_PASSWORD', 'password'),
    ],

    'profile' => [
        'name' => 'Adithyan C',
        'designation' => 'Laravel Developer',
        'about' => 'I build scalable backend systems using Laravel.',
        'location' => 'India',
        'avatar' => null,
    ],

    'skills' => [
        ['name' => 'Laravel', 'level' => 'Expert'],
        ['name' => 'PHP', 'level' => 'Expert'],
        ['name' => 'JavaScript', 'level' => 'Intermediate'],
        ['name' => 'MySQL', 'level' => 'Expert'],
    ],

    'projects' => [
        [
            'title' => 'Portfolio CMS',
            'description' => 'Headless CMS built with Laravel.',
            'github_url' => 'https://github.com/yourname/portfolio',
        ],
        [
            'title' => 'API Platform',
            'description' => 'REST API with authentication.',
            'github_url' => null,
        ],
    ],

    'resume' => [
        'title' => 'Latest Resume',
        'file_name' => 'resume.pdf',
    ],

];
