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
            'description' => [
                'Built using Laravel 11',
                'Admin dashboard for content management',
                'Dynamic portfolio rendering using API',
                'Clean and modern UI with Tailwind CSS',
            ],
            'github_url' => 'https://github.com/yourname/portfolio',
        ],
        [
            'title' => 'API Platform',
            'description' => [
                'REST API built with Laravel',
                'Authentication using Sanctum',
                'Role-based access control',
                'Optimized database queries',
            ],
            'github_url' => null,
        ],
    ],

    'resume' => [
        'title' => 'Latest Resume',
        'file_name' => 'resume.pdf',
    ],

    'services' => [
        [
            'title' => 'Backend Development',
            'description' =>
            'Designing scalable backend systems, REST APIs,
             authentication flows, and clean business logic
             using Laravel best practices.',
            'order' => 1,
        ],
        [
            'title' => 'Database Design',
            'description' =>
            'Creating efficient database schemas, writing
             optimized queries, indexing strategies,
             and handling migrations with confidence.',
            'order' => 2,
        ],
        [
            'title' => 'API Integration',
            'description' =>
            'Building and consuming secure APIs, handling
             authentication with Sanctum, and connecting
             backend services with modern frontends.',
            'order' => 3,
        ],
    ],


];
