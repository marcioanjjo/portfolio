<?php 
    namespace App;
    use PDO;
    use PDOException;

    class Connection{
        private static ?PDO $instance = null;

        # Retorna uma instancia unica de conexão com o banco de dados.
        public static function getConnection(): PDO{
                #pega as credencias das variaveis de ambiente carregadas pelo Dotenv
            if(self::$instance === null){
                try{
                    //$host = $_ENV['DB_HOST'] ?? 'localhost';
                    $host = $_ENV['DB_HOST'] ?? 'db';
                    $dbname = $_ENV['DB_NAME'] ?? '';
                    $username = $_ENV['DB_USER'] ?? '';
                    $password = $_ENV['DB_PASS'] ?? '';
                    $port = $_ENV['DB_PORT'] ?? '3306';

                    $dns = "mysql:host=$host;dbname=$dbname;port=$port;charset=utf8mb4";

                    //Configurações de segurança do PDO
                    $options = [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //Transforma erros em exceções capturáveis
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //Define o modo de busca padrão como array associativo
                        PDO::ATTR_EMULATE_PREPARES => false, //Desativa a emulação para evitar SQL injection de forma Robusta  
                    ];

                    self::$instance = new PDO($dns, $username, $password, $options);

                } catch(PDOException $e){
                    //echo "<h1>Mostrando o erro que esta acontecendo: </h1>" . $e->getMessage();
                    // Em produção (hostgator), nunca mostre o erro cru ao usuário por segurança
                    if(($_ENV['APP_ENV'] ?? 'production') === 'local'){
                        die("Erro de conexão local: " . $e->getMessage());
                    }else{
                        die("Erro temporario no servidor. Por favor, tente novamente mais tarde.");
                    }
                }
            }
            return self::$instance;

        }
    }

    