<?php

require_once __DIR__ . '/../vendor/autoload.php';


use App\Router;
use App\Controllers\HomeController;
use App\Controllers\ProjectController;
use App\Controllers\AdminController;

//Carregar as variáveis de ambiente do arquivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Cria uma instância do roteador
$router = new Router();

// Rotas da Home e do Formulário de Contato
$router->get('/', [HomeController::class, 'index']);
$router->post('/contact', [HomeController::class, 'storeContact']);

// Rotas do Portfólio de Projetos
$router->get('/portfolio', [ProjectController::class, 'index']);
$router->get('/projeto/{id}', [ProjectController::class, 'show']);

//Rotas da áre administrativa
$router->get('/admin/login', [AdminController::class, 'loginView']);
$router->post('/admin/login', [AdminController::class, 'loginProcess']);
$router->get('/admin/dashboard', [AdminController::class, 'dashboard']);
$router->get('/admin/logout', [AdminController::class, 'logout']);
$router->post('/admin/contato/status', [AdminController::class, 'changeContactStatus']);
$router->get('/admin/projetos', [AdminController::class, 'projects']);
$router->post('/admin/projetos', [AdminController::class, 'storeProject']);

//Executa o roteamento da requisição atual
$router->dispatch();
