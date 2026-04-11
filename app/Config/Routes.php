<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::index');
$routes->get('logout', 'Auth::logout');
$routes->get('blocked', 'Auth::forbiddenPage');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::registration');

// Profile Routes
$routes->get('/profile', 'ProfileController::show');
$routes->get('/profile/edit', 'ProfileController::edit');
$routes->post('/profile/update', 'ProfileController::update');

$routes->get('dashboard', 'Home::index');
$routes->get('dashboard-v2', 'Home::dashboardV2');
$routes->get('dashboard-v3', 'Home::dashboardV3');

// Setting Routes
$routes->group('users', static function ($routes) {
    $routes->get('/', 'Settings::users');
    $routes->post('create-role', 'Settings::createRole');
    $routes->post('update-role', 'Settings::updateRole');
    $routes->delete('delete-role/(:num)', 'Settings::deleteRole/$1');

    $routes->get('role-access', 'Settings::roleAccess');
    $routes->post('create-user', 'Settings::createUser');
    $routes->post('update-user', 'Settings::updateUser');
    $routes->delete('delete-user/(:num)', 'Settings::deleteUser/$1');

    $routes->post('change-menu-permission', 'Settings::changeMenuPermission');
    $routes->post('change-menu-category-permission', 'Settings::changeMenuCategoryPermission');
    $routes->post('change-submenu-permission', 'Settings::changeSubMenuPermission');
});

$routes->group('menu-management', static function ($routes) {
    $routes->get('/', 'Settings::menuManagement');
    $routes->post('create-menu-category', 'Settings::createMenuCategory');
    $routes->post('create-menu', 'Settings::createMenu');
    $routes->post('create-submenu', 'Settings::createSubMenu');
});
$routes->get('menu','Menu::index');

// Student Routes
$routes->get('students', 'Student::index');
$routes->post('student/store', 'Student::store');
$routes->get('student/show/(:num)', 'Student::show/$1');
$routes->get('student/edit/(:num)', 'Student::edit/$1');
$routes->post('student/update/(:num)', 'Student::update/$1');
$routes->delete('student/delete/(:num)', 'Student::delete/$1');

// Exam module routes
$routes->get('exam', 'Exam::index');
$routes->get('exam/create', 'Exam::create');
$routes->post('exam/store', 'Exam::store');
$routes->get('exam/edit/(:num)', 'Exam::edit/$1');
$routes->post('exam/update/(:num)', 'Exam::update/$1');
$routes->delete('exam/delete/(:num)', 'Exam::delete/$1');

// ── API v1 ────────────────────────────────────────────────────
// Public: POST /api/v1/auth/token
$routes->post('api/v1/auth/token', 'Api\AuthController::issueToken');

// Protected: requires Bearer token
$routes->group('api/v1', ['filter' => 'api_auth'], function ($routes) {
    $routes->delete('auth/token',       'Api\AuthController::revokeToken');
    $routes->get('students',            'Api\StudentsController::index');
    $routes->get('students/(:num)',     'Api\StudentsController::show/$1');
});
