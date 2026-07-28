<?php

    namespace App;


    class Router 
    {
            private array $routes = [];

            //Registra uma rota HTTP GET
        public function get(string $path, callable|array $action): void
        {
            $this->addRoute('GET', $path, $action);
        }

            //Regristra um rota HTTP POST(PARA FORMULÁRIOS)
        public function post(string $path, callable|array $action): void
        {
            $this->addRoute('POST', $path, $action);
        }

        private function addRoute(string $method, string $path, callable|array $action): void
        {
            // Converte sintaxe /projeto/{id} em Expressão Regular
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $path);
            $pattern = '#^' . $pattern . '$#';

            $this->routes[] = 
            [ 
                'method' => $method, 
                'pattern' => $pattern, 
                'action' => $action
            ];
        }

        //Executa a busca da rota correspondente à URL atual

        public function dispatch(): void
        {
            $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

            // Pega a URI limpa sem os parâmetros da query string (?busca=php)
            $requestUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

            foreach($this->routes as $route)
            {
                if($route['method'] === $requestMethod && preg_match($route['pattern'], $requestUri, $matches))
                    {
                        $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                        $action = $route['action'];
                            
                        // Se a ação for uma Closure/Função Anônima
                        if(is_callable($action))
                            {
                                call_user_func_array($action, $params);
                                return;
                            }

                            if(is_array($action))
                                {
                                    [$controllerClass, $method] = $action;
                                        if(class_exists($controllerClass))
                                            {
                                                $controller = new $controllerClass();
                                                    if(method_exists($controller, $method))
                                                        {
                                                            call_user_func_array([$controller, $method], $params);
                                                            return;
                                                        }
                                            }
                                }
                        }
                }
            

            // Se nenhuma rota bater, exibe Erro 404
            http_response_code(404);
            echo "<h1>404 - Página não encontrada</h1>";
            echo "<p>A página que você está procurando no portfolio SQL Tecnologia não existe.</p>";
        }
    }

