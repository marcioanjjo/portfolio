<?php

namespace App\Controllers;


use App\Models\Contact;
use App\Models\Project;
use App\View;

class HomeController
{
    /**
     * Exibe a página inicial (Home) com projetos em destaque
     */
    public function index(): void
    {
        // Busca os projetos para exibir como destaque na Home
        $projetos = Project::getAll();

        // Pega mensagem de sucesso/erro da sessão se existir
        session_start();
        $mensagemSucesso = $_SESSION['sucesso'] ?? null;
        $mensagemErro = $_SESSION['erro'] ?? null;
        unset($_SESSION['sucesso'], $_SESSION['erro']);

        View::render('home/index', [
            'title' => 'SQL Tecnologia | Desenvolvimento web  & Infraestrutura em Nuvem',
            // Pega até 3 projetos para a Home
            'projetos' => array_slice($projetos, 0, 3),
            'sucesso' => $mensagemSucesso,
            'erro' => $mensagemErro
        ]);
    }

    /**
     * Processa o envio do formulário de contato via POST
     */
    public function storeContact(): void
    {
        session_start();
        if ($_SESSION['REQUEST_METHOD'] == 'POST') {
            header('Location', '/');
            exit;
        }
    }
}
