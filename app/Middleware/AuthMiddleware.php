<?php

namespace App\Middleware;


class AuthMiddleware
{
    /**
     * Garante que apenas usuarios logados acesse a rota.
     */

    public static function handle(): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['admin_user'])) {
            header('Location: /admin/login');
            exit;
        }
    }
}
