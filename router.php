<?php

$routes = [
    '' => 'pages/index.php',
    'log-in' => 'pages/index.php',
    'register' => 'pages/register.php',
    'dashboard' => 'pages/dashboard.php',
    'course-registration' => 'pages/course-registration.php',
    'gpa-tracking' => 'pages/gpa-tracking.php',
    'credit-tracking' => 'pages/foundation.php',
    'get-advice' => 'pages/contact.php',
    'input-result' => 'pages/input-result.php',
    'admin' => 'pages/admin.php',
    'departments' => 'pages/departments.php',
    'courses' => 'pages/courses.php',
    'users' => 'pages/users.php',
    'log-out' => 'pages/log-out.php'
];

$route = isset($_SERVER["REDIRECT_URL"]) ? basename($_SERVER["REDIRECT_URL"]) : 'log-in';
// $route = ucfirst($route);

if (array_key_exists($route, $routes)) {
    require $routes[$route];
} else {
    http_response_code(404);
    include 'pages/404.php';
}