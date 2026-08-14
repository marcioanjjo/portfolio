<?php

namespace App\Models;


use App\Connection;
use PDO;

class User
{
    /**
     * bucas um usuário no banco de dados pelo email
     */

    public static function getByEmail(string $email): ?array
    {
        $db = Connection::getConnection();

        $sql = "SELECT id, nome, email, senha FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":email", trim($email));
        $stmt->execute();

        $user = $stmt->fetch();
        return $user ?: null;
    }

    public static function createAdmin($nome, $email, $senhapura): bool
    {
        $db = Connection::getConnection();

        $sql = "INSERT INTO usuarios(nome, email, senha) VALUES(:nome, :email, :senha)";
        $smtp = $db->prepare($sql);
        $smtp->bindValue(":email", $email);
        $smtp->execute();

        /**
         * hach seguro nativo do PHP 8.3
         */
        $hash = password_hash($senhapura, PASSWORD_DEFAULT);

        return $smtp->execute([
            'nome' => $nome,
            'email' => $email,
            'senha' => $hash
        ]);
    }
}
