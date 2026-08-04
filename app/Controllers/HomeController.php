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

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        //Trava de segurança: Se não for POST manda de volta para a home.
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location', '/');
            exit;
        }

        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $whatsapp = $_POST['whatsapp'] ?? '';
        $mensagem = $_POST['mensagem'] ?? '';

        //Validação Básica dos campos obrigatórios
        if (empty($nome) || empty($email) || empty($whatsapp) || empty($mensagem)) {
            $_SESSION['erro'] = 'Por favor, preencha todos os campos obrigatórios.';
            header('Location: /#contato');
            exit;
        }

        $salvo = Contact::create([
            'nome' => $nome,
            'email' => $email,
            'whatsapp' => $whatsapp,
            'mensagem' => $mensagem
        ]);

        if ($salvo) {
            $_SESSION['sucesso'] = 'Mensagem enviada com sucesso!';
        } else {
            $_SESSION['erro'] = 'Erro ao enviar mensagem. Tente novamente.';
        }

        header('Location: /#contato');
        exit;
    }
}
