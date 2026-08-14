<?php

namespace App\Controllers;


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
     * Dashboard principal: Visualiza solicitações de orçamento.
     */

    public function dashboard(): void
    {
        AuthMiddleware::handle();

        $db = \App\Connection::getConnection();
        $stmt = $db->query("SELECT * FROM contatos ORDER BY criado_em DESC");
        $contatos = $stmt->fetchAll();

        View::render('admin/dashboard', [
            'title' => 'Dashboard | Painel SQL Tecnologia',
            'contatos' => $contatos
        ]);
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
