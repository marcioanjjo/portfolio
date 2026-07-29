<?php

    namespace App\Controllers;


    use App\Models\Project;

    class ProjectController
    {
        public function index(): void
        {
            $projetos = Project::getAll();

            echo '<h1>📋 Portfólio de Projetos - SQL Tecnologia</h1>';

            if(empty($projetos)){
                echo '<p>Nenhum projeto cadastrado no momento.</p>';
                return;
            }

            echo '<div style="display: flex; gap: 20px; flex-wrap: wrap;">';
            foreach($projetos as $projeto){
                $tecnologia = htmlspecialchars($projeto['tecnologias'] ?? "NENHUMA");
                echo
                "<div style='border: 1px solid #ccc; padding: 15px; border-radius: 8px; width: 300px'>
                    <h3>" . htmlspecialchars($projeto['titulo']) . "</h3>
                    <p><strong>Servidor:</strong> " . htmlspecialchars($projeto['tipo_servidor']) . "</p>
                    <p>" . htmlspecialchars($projeto['descricao_curta']) . "</p>
                    <p><strong>Tecnologia:</strong> " . $tecnologia . "</p>
                    <a href='/projeto/" . $projeto['id'] . "'>Ver detalhes</a>
                </div>";
            }
            echo '</div>';
        }

        public function show(string $id): void
        {
            $idInt = (int) $id;
            $projeto = Project::getById($idInt);

            if(!$projeto){
                http_response_code(404);
                echo "<h1>Projeto não encontrado</h1>";
                return;
            }

            echo "<h1>" . htmlspecialchars($projeto['titulo']) . "</h1>";
            echo "<p><strong>Tipo de Infraestrutura:<strong> " . htmlspecialchars($projeto['tipo_servidor']) . "</p>";
            echo "<p><strong>Tecnologia Ultilizada:</strong>" . htmlspecialchars($projeto['tecnologias']) . "</p>";
            echo "<hr>";
            echo "<p>" . nl2br(htmlspecialchars($projeto['descricao_completa'])) . "</p>";

            if($projeto['link_demo']){
                echo "<p><a href='" . htmlspecialchars($projeto['link_demo']) . "' target='_blank'>🚀 Acessar Demonstração ao Vivo</a></p>";
            }

            if($projeto['link_github']){
                echo "<p><a href='" . htmlspecialchars($projeto['link_github']) . "' target='_blank'>💻 Repositório GitHub</a></p>";
            }

            echo "<p><a href='/portfolio'>← Voltar para o Portfólio</a></p>";
        }


    }