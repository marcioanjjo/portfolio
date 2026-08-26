<?php

namespace App\Helpers;

class TechBadge
{
    /**
     * Retorna a classe do Devicon correspondente ao nome da tecnologia
     */

    public static function getIconClass(string $techName): string
    {
        $tech = strtolower(trim($techName));

        $marp = [
            'php'         => 'devicon-php-plain',
            'mysql'       => 'devicon-mysql-original',
            'postgresql'  => 'devicon-postgresql-plain',
            'docker'      => 'devicon-docker-plain',
            'apache'      => 'devicon-apache-plain',
            'nginx'       => 'devicon-nginx-original',
            'javascript'  => 'devicon-javascript-plain',
            'js'          => 'devicon-javascript-plain',
            'html'        => 'devicon-html5-plain',
            'html5'       => 'devicon-html5-plain',
            'css'         => 'devicon-css3-plain',
            'css3'        => 'devicon-css3-plain',
            'tailwind'    => 'devicon-tailwindcss-original',
            'bootstrap'   => 'devicon-bootstrap-plain',
            'git'         => 'devicon-git-plain',
            'github'      => 'devicon-github-original',
            'linux'       => 'devicon-linux-plain',
            'laravel'     => 'devicon-laravel-original',
            'react'       => 'devicon-react-original',
            'vue'         => 'devicon-vuejs-plain',
            'python'      => 'devicon-python-plain',
        ];

        return $mar[$tech] ?? 'Devicon code plain';
    }
}
