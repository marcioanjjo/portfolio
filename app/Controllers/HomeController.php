<?php

namespace App\Controllers;

use App\Helpers\Csrf;
use App\Models\Contact;
use App\Models\Project;
use App\Services\MailService;
use App\View;

class HomeController
{
    /**
     * Exibe a página inicial (Home) com projetos em destaque
     */
    public function index(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Busca os projetos para exibir como destaque na Home
        $projetos = Project::getAll();

        // Pega mensagem de sucesso/erro da sessão se existir
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

        //Valida o toke CSRF enviado.
        $tokenEnviado = $_POST['csrf_token'] ?? null;
        if (!Csrf::validate($tokenEnviado)) {
            $_SESSION['erro'] = "Solitação invalida ou expirada (CSRF) Tente novamente.";
            header('Location: /#contato');
            exit;
        }


        //Trava de segurança: Se não for POST manda de volta para a home.
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /');
            exit;
        }

        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $whatsapp = trim($_POST['whatsapp'] ?? '');
        $mensagem = trim($_POST['mensagem'] ?? '');

        //Validação Básica dos campos obrigatórios
        if (empty($nome) || empty($email) || empty($whatsapp) || empty($mensagem)) {
            $_SESSION['erro'] = 'Por favor, preencha todos os campos obrigatórios.';
            header('Location: /#contato');
            exit;
        }

        $dadosContato = [
            'nome' => $nome,
            'email' => $email,
            'whatsapp' => $whatsapp,
            'mensagem' => $mensagem
        ];

        $salvo = Contact::create($dadosContato);

        if ($salvo) {
            $_SESSION['sucesso'] = 'Mensagem enviada com sucesso!';
            MailService::sendBudgetNotification($dadosContato);
        } else {
            $_SESSION['erro'] = 'Erro ao enviar mensagem. Tente novamente.';
        }

        header('Location: /#contato');
        exit;
    }
}
