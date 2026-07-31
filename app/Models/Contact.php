<?php

namespace App\Models;

use App\Connection;
use PDO;

class Contact
{
    /**
     * Salva uma nova mensagem de contato/orçamento no banco de dados
     */
    public static function create(array $data): bool
    {
        $db = Connection::getConnection();

        $sql = "INSERT INTO contatos (nome, email, whatapp, mensagem)
                VALUE (:nome, :email, :whatapp, :mensagem)";

        $stmt = $db->prepare($sql);

        return $stmt->execute([
            ':nome' => htmlspecialchars(trim($data['nome'])),
            ':email' => filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL),
            ':whatapp' => htmlspecialchars(trim($data['whatapp'])),
            ':mensagem' => htmlspecialchars(trim($data['mensagem'])),
        ]);
    }
}
