<?php

namespace App\Controllers;


use App\Models\Project;
use App\View;

class ProjectController
{
    public function index(): void
    {
        $projetos = Project::getAll();

        // Chama a View limpamente passando as variáveis
        View::render('projects/index', ['title' => 'Portfolio | SQL Tecnologia', 'projetos' => $projetos]);
    }

    public function show(string $id): void
    {

        $projeto = Project::getById((int) $id);

        if (!$projeto) {
            http_response_code(404);
            View::render('404', ['title' => 'Projeto não encontrado']);
            return;
        }

        View::render('projects/show', [
            'title' => $projeto['titulo'] . '| SQL Tecnologia',
            'projeto' => $projeto
        ]);
    }
}
