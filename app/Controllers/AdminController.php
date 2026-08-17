<?php

namespace App\Controllers;

use App\Helpers\Csrf;
use App\Middleware\AuthMiddleware;
use App\Models\Contact;
use App\Models\Project;
use App\Models\User;
use App\View;

class AdminController
{
    /**
     * Exibe a tela de Login do Painel.
     */
    public function loginView(): void
    {
        if (session_status()  === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION['admin_user'])) {
            header('Location: /admin/dashboard');
            exit;
        }

        $erro = $_SESSION['login_erro'] ?? null;
        unset($_SESSION['login_erro']);

        View::render('admin/login', [
            'title' => 'Login | Painel SQL Tecnologia',
            'erro' => $erro
        ], layout: null); //rederiza sem header/foot publico.
    }

    /**
     * Processa o formúlaro de login
     */

    public function loginProcess(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Validação do Token (CSRF) Vindo do Formulario.
        $tokenEnviado = $_POST['csrf_token'] ?? null;
        if (!Csrf::validate($tokenEnviado)) {
            $_SESSION['login_erro'] = "Solicitação invalida ou explirada (CSRF). Tente Novamente.";
            header('Location: /admin/login');
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        $usuario = User::getByEmail($email);

        //Verifica e-mail e hash da senha
        if (is_array($usuario)) {
            if ($usuario && password_verify($senha, $usuario['senha'])) {
                session_regenerate_id(true);
                $_SESSION['admin_user'] = [
                    'id' => $usuario['id'],
                    'nome' => $usuario['nome'],
                    'email' => $usuario['email']
                ];

                header('Location: /admin/dashboard');
                exit;
            }
        }
        //Caso o login falhe (e-mail inexistente ou senha errada)
        $_SESSION['login_erro'] = "E-mail ou senha incorretos.";
        header('Location: /admin/login');
        exit;
    }


    /**
     * Dashboard com suporte a filtro de status
     */

    public function dashboard(): void
    {
        AuthMiddleware::handle();

        $statusAtual = $_GET['status'] ?? 'pendente';
        if (!in_array($statusAtual, ['pendente', 'concluido', 'arquivado'], true)) {
            $statusAtual = 'pendente';
        }

        $contatos = Contact::getByStatus($statusAtual);
        $contadores = Contact::countByStatus();

        View::render('admin/dashboard', [
            'title' => 'Dashboard | Painel SQL Tecnologia',
            'contatos' => $contatos,
            'statusAtual' => $statusAtual,
            'contadores' => $contadores,
            'usuarioLogado' => $_SESSION['admin_user']['nome'] ?? 'Administrador'
        ]);
    }

    /**
     * Altera o status do orçamento (Concluir / Reabrir / Arquivar)
     */

    public function changeContactStatus(): void
    {
        AuthMiddleware::handle();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/dashboard');
            exit;
        }

        //Validação do Token CSRF.
        if (!Csrf::validate($_POST['csrf_token'] ?? null)) {
            header('Location: /admin/dashboard');
            exit;
        }

        $id = (int) ($_POST['id'] ?? 0);
        $novoStatus = $_POST['status'] ?? 'pendente';

        if ($id > 0  && in_array($novoStatus, ['pendente', 'concluido', 'arquivado'], true)) {
            Contact::updateStatus($id, $novoStatus);
        }

        // Redireciona mantendo na visualização correspondente
        $origem = $_POST['redirect_status'] ?? 'pendente';
        header("Location: /admin/dashboard?status={$origem}");
        exit;
    }

    /**
     * Desloga o usuário da seção
     */
    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        unset($_SESSION['admin_user']);
        session_destroy();

        header('Location: /admin/login');
        exit;
    }
}
