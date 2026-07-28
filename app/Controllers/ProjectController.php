<?php

    namespace App\Controllers;


    class ProjectController
    {
        public function index(): void
        {
            echo "<h2>📋 Lista de Todos os Projetos do PoftFolio SQL Tecnologia</h2>";
        }

        public function show(string $id): void
        {
            echo "<h2>🔎 Exibindo Detalhes do projeto ID: {$id}</h2>";
            echo "<p>Aqui vamos carregar os dados do banco de dados Mysql e mostrar as tecnologias e o servidor usando (AWS / HOSTGATO).</p>";
        }


    }