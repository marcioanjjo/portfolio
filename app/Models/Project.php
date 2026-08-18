<?php

namespace App\Models;

use App\Connection;
use PDO;

class Project
{
    /**
     * Busca todos os projetos no banco de dados trazendo suas tecnologias agrupadas
     */

    public static function getAll(): array
    {
        $db = Connection::getConnection();

        // Query SQL otimizada com JOIN para buscar o projeto e a lista de tecnologias associadas
        $sql = "SELECT 
                    p.id,
                    p.titulo,
                    p.descricao_curta,
                    p.descricao_completa,
                    p.link_demo,
                    p.link_github,
                    p.tipo_servidor,
                    p.imagem_capa,
                    p.criado_em,
                    GROUP_CONCAT(t.nome SEPARATOR ', ') AS tecnologias
                FROM projetos p
                LEFT JOIN projeto_tecnologia pt ON p.id = pt.projeto_id
                LEFT JOIN tecnologias t ON pt.tecnologia_id = t.id
                GROUP BY p.id
                ORDER BY p.criado_em DESC";

        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }

    public static function getById(int $id): ?array
    {
        $db = Connection::getConnection();

        $sql = "SELECT 
                    p.id,
                    p.titulo,
                    p.descricao_curta,
                    p.descricao_completa,
                    p.link_demo,
                    p.link_github,
                    p.tipo_servidor,
                    p.imagem_capa,
                    p.criado_em,
                    GROUP_CONCAT(t.nome SEPARATOR ', ') AS tecnologias
                FROM projetos p
                LEFT JOIN projeto_tecnologia pt ON p.id = pt.projeto_id
                LEFT JOIN tecnologias t ON pt.tecnologia_id = t.id
                WHERE p.id = :id
                GROUP BY p.id";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result ?: null;
    }

    /**
     * Insere um novo projeto no banco de dados.
     */
    public static function create(array $data): bool
    {
        $db = Connection::getConnection();

        $sql = "INSERT INTO projetos (titulo, descricao_curta, descricao_completa, link_demo, link_github, tipo_servidor, imagem_capa) 
                VALUES (:titulo, :descricao_curta, :descricao_completa, :link_demo, :link_github, :tipo_servidor, :imagem_capa)";

        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':titulo'               => $data['titulo'],
            ':descricao_curta'      => $data['descricao_curta'],
            ':descricao_completa'   => $data['descricao_completa'],
            ':link_demo'            => $data['link_demo'] ?? null,
            ':link_github'          => $data['link_github'] ?? null,
            ':tipo_servidor'         => $data['tipo_servidor'] ?? null,
            ':imagem_capa'          => $data['imagem_capa'] ?? null
        ]);
    }
}
