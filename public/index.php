<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use ClassTest\Controllers\AuthController;
use ClassTest\Controllers\DashboardController;
use ClassTest\Controllers\AssessmentController;
use ClassTest\Controllers\SubmissionController;
use ClassTest\Database\Migration;
use ClassTest\Helpers\Auth;

try {
    $migration = new Migration();
    $migration->up();
} catch (Exception $e) {
    error_log("Migration error: " . $e->getMessage());
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$basePath = str_replace('/public', '', dirname($_SERVER['SCRIPT_NAME']));
if ($basePath !== '/') {
    $uri = str_replace($basePath, '', $uri);
}
if (empty($uri)) {
    $uri = '/';
}

if (!Auth::check() && $uri !== '/login' && $uri !== '/logout') {
    header('Location: /login');
    exit;
}

if ($uri === '/' || $uri === '/login') {
    if (Auth::check()) {
        if (Auth::isAdmin()) {
            header('Location: /dashboard');
        } else {
            header('Location: /student/assessments');
        }
        exit;
    }
    $controller = new AuthController();
    $controller->login();
    exit;
}

if ($uri === '/logout') {
    $controller = new AuthController();
    $controller->logout();
    exit;
}

if ($uri === '/dashboard') {
    $controller = new DashboardController();
    if (Auth::isAdmin()) {
        $controller->admin();
    } else {
        $controller->student();
    }
    exit;
}

if ($uri === '/student/assessments') {
    $controller = new DashboardController();
    $controller->student();
    exit;
}

if ($uri === '/assessments') {
    $controller = new AssessmentController();
    $controller->index();
    exit;
}

if ($uri === '/assessment/create') {
    $controller = new AssessmentController();
    $controller->create();
    exit;
}

if (preg_match('/^\/assessment\/edit\/(\d+)$/', $uri, $matches)) {
    $controller = new AssessmentController();
    $controller->edit($matches[1]);
    exit;
}

if (preg_match('/^\/assessment\/view\/(\d+)$/', $uri, $matches)) {
    $controller = new AssessmentController();
    $controller->view($matches[1]);
    exit;
}

if (preg_match('/^\/assessment\/publish\/(\d+)$/', $uri, $matches)) {
    $controller = new AssessmentController();
    $controller->publish($matches[1]);
    exit;
}

if (preg_match('/^\/assessment\/take\/(\d+)$/', $uri, $matches)) {
    $controller = new AssessmentController();
    $controller->take($matches[1]);
    exit;
}

if ($uri === '/assessment/add-section' && $method === 'POST') {
    $controller = new AssessmentController();
    $controller->addSection();
    exit;
}

if ($uri === '/assessment/add-question' && $method === 'POST') {
    $controller = new AssessmentController();
    $controller->addQuestion();
    exit;
}

if (preg_match('/^\/submission\/(\d+)$/', $uri, $matches)) {
    $controller = new SubmissionController();
    $controller->show($matches[1]);
    exit;
}

if ($uri === '/submission/save-answer' && $method === 'POST') {
    $controller = new SubmissionController();
    $controller->saveAnswer();
    exit;
}

if (preg_match('/^\/submission\/submit\/(\d+)$/', $uri, $matches)) {
    $controller = new SubmissionController();
    $controller->submit($matches[1]);
    exit;
}

if (preg_match('/^\/submission\/result\/(\d+)$/', $uri, $matches)) {
    $controller = new SubmissionController();
    $controller->result($matches[1]);
    exit;
}

if (preg_match('/^\/results\/(\d+)$/', $uri, $matches)) {
    $controller = new SubmissionController();
    $controller->results($matches[1]);
    exit;
}

if (preg_match('/^\/results\/export\/(\d+)$/', $uri, $matches)) {
    $controller = new SubmissionController();
    $controller->exportResults($matches[1]);
    exit;
}

if (preg_match('/^\/(css|js|assets)\//', $uri)) {
    return false;
}

http_response_code(404);
echo '404 - Page not found';
