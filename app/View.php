<?php
    namespace App;

    use Exception;

    class View
    {
        /**
     * Renderiza uma view injetando dados e envolvendo com layout padrão (header/footer)
     */
    public static function render(string $viewPath, array $data = [], ?string $layout = 'default')
        {
            // Transforma o array ['projetos' => $dados] em variáveis acessíveis na view ($projetos)
            extract($data);

            $viewFile = __DIR__ . "/Views/{$viewPath}.php";

            if(!file_exists($viewFile)){
                throw new Exception("A view '{$viewPath}' não foi encontrada no caminho: {$viewFile}");
            }

            //Caminhos dos arquivos de layout
            $header = __DIR__ . "/Views/layouts/header.php";
            $footer = __DIR__ . "/Views/layouts/footer.php";
            
            //Incluir o cabeçalho
            if(file_exists($header) && $layout !== null){
                require $header;
            }

            require $viewFile;

            if(file_exists($footer) && $layout !== null){
                require $footer;
            }
        }
    }