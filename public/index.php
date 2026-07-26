<?php

require_once __DIR__ . '/../vendor/autoload.php';


use App\Connection;

//Carregar as Variaveis de Ambiente do arquivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

echo "<h1>🚀 Teste de Ambiente SQL TECNOLOGIA</h1>";
echo "<p>PHP Versão atual: " . phpversion() . "</p>";

try {
    $db = Connection::getConnection();
    echo "<p style='color: green; font-weight: bold;'>✔ Conexão com o banco de dados realizada com sucesso!</p>";
} catch (PDOException $e) {
    echo "<p style='color: red; font-weight: bold;'>❌ Erro ao conectar com o banco de dados: " . $e->getMessage() . "</p>";
}
