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

    /**
     * Retorna um projeto específico pelo ID junto com suas tecnologias.
     */
    public static function getById(int $id): ?array
    {
        $db = Connection::getConnection();

        $sql = "SELECT * FROM projetos WHERE id = :id LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $projeto = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$projeto) {
            return null;
        }

        /**
         * Busca Tecnologia do Projeto.
         */
        $sqlTechs = "SELECT t.id, t.nome, t.icone 
                 FROM tecnologias t
                 INNER JOIN projeto_tecnologia pt ON pt.tecnologia_id = t.id
                 WHERE pt.projeto_id = :projeto_id";

        $stmtTechs = $db->prepare($sqlTechs);
        $stmtTechs->execute([':projeto_id' => $id]);
        $projeto['tecnologias'] = $stmtTechs->fetchAll(\PDO::FETCH_ASSOC);

        return $projeto;
    }

    /**
     * Insere um novo projeto no banco de dados.
     */
    public static function create(array $data): int
    {
        $db = Connection::getConnection();

        $sql = "INSERT INTO projetos (titulo, descricao_curta, descricao_completa, link_demo, link_github, tipo_servidor, imagem_capa) 
                VALUES (:titulo, :descricao_curta, :descricao_completa, :link_demo, :link_github, :tipo_servidor, :imagem_capa)";

        $stmt = $db->prepare($sql);
        $sucesso = $stmt->execute([
            ':titulo'             => $data['titulo'],
            ':descricao_curta'    => $data['descricao_curta'],
            ':descricao_completa' => $data['descricao_completa'] ?? null,
            ':link_demo'          => $data['link_demo'] ?? null,
            ':link_github'        => $data['link_github'] ?? null,
            ':tipo_servidor'      => $data['tipo_servidor'] ?? 'Docker / Apache',
            ':imagem_capa'        => $data['imagem_capa'] ?? '/assets/img/projeto-default.svg'
        ]);

        return $sucesso ? (int) $db->lastInsertId() : 0;
    }

    public static function getAllTechnologies(): array
    {
        $db = Connection::getConnection();
        return $db->query("SELECT id, nome FROM tecnologias ORDER BY nome ASC")->fetchAll();
    }

    public static function syncTechnologies(int $projetoIds, array $techIds): void
    {
        if (empty($techIds)) return;

        $db = Connection::getConnection();
        $stmt = $db->prepare("INSERT INTO projeto_tecnologia (projeto_id, tecnologia_id) VALUES (:projeto_id, :tecnologia_id)");

        foreach ($techIds as $techId) {
            $stmt->execute([
                ':projeto_id' => $projetoIds,
                ':tecnologia_id' => (int) $techId
            ]);
        }
    }
}
