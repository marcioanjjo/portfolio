<?php

require_once __DIR__ . '/../vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


use App\Router;
use App\Controllers\ProjectController;

// Cria uma instância do roteador
$router = new Router();

//Rota para home (Apresentação / captação de clientes)
$router->get('/', function()
{
    echo "<h1>🚀 SQL Tecnologia - Portfolio profissional</h1>";
    echo "<p>Desenvolvimento Web, APIs, em PHP e Infraestrutura em Nuvem. </p>";

});

//Rota do portfolio de projetos
$router->get('/portfolio', [ProjectController::class, 'index']);
$router->get('/projeto/{id}', [ProjectController::class, 'show']);

//Rota de processamento de Contato de Clientes (POST)
$router->get('/contato', function()
{
    echo '<h1>📧 Formulario de Orçamento (SQL TECNOLOGIA)</h1>';
    echo 
    '
    <form action="/contato" method="POST">
        <div>
            <label>Nome do Cliente:</label>
            <input type="text" name="nome" placeholder="Digite seu nome" required>
        </div>
        <br>
        <div>
            <label>E-mail coporativo:</label>
            <input type="email" name="email" placeholder="seu@email.com" required>
        </div>
        <br>
        <div>
            <label>Dados Sigilosos / mesnagem:</label>
            <textarea name="mensagem" placeholder="Descreva o projeto..." required></textarea>
        </div>
        <br>
    <button type="submit">Enviar Dados com segurança (POST)</button>
    ';
});

$router->post('/contato', function()
{
    $nome = $_POST['nome'] ?? 'Não informado';
    $email = $_POST['email'] ?? 'Não Informado';
    $mesagem = $_POST['mesagem'] ?? '';

    echo '<h2>✔ Dados Recebidos Via POST com sucesso!</h2>';
    echo '<p><strong>Cliente:</strong>' . htmlspecialchars($nome) . '</p>';
    echo '<p><strong>E-mail:</strong>' . htmlspecialchars($email) . '</p>';
    echo '<p><strong>Mesagem Projeto</strong>' . htmlspecialchars($mesagem);
    echo '<p><em>Os Dados foram transmitidos no corpo da requisição sem expor parametros na URL.</em>';
});

//Executa o roteamento da requisição atual
$router->dispatch();