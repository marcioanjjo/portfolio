-- 1. Criação da Tabela de Usuários Administrativos (Para gerenciar seu portfólio)
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `senha` VARCHAR(255) NOT NULL, -- Guardará hash seguro via password_hash()
  `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Criação da Tabela de Projetos (Informações gerais de cada portfólio)
CREATE TABLE IF NOT EXISTS `projetos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `titulo` VARCHAR(150) NOT NULL,
  `descricao_curta` VARCHAR(255) NOT NULL, -- Resumo para o card da Home
  `descricao_completa` TEXT NOT NULL,       -- Detalhes, desafios e soluções técnicas
  `link_demo` VARCHAR(255) NULL,            -- Ex: https://loja.sqltecnologia.inf.br
  `link_github` VARCHAR(255) NULL,          -- Ex: https://github.com/...
  `tipo_servidor` VARCHAR(100) NOT NULL,    -- Ex: "Compartilhado (HostGator)", "AWS EC2", "VPS"
  `imagem_capa` VARCHAR(255) NOT NULL,      -- Caminho do arquivo da imagem
  `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Criação da Tabela de Tecnologias/Habilidades (Para filtrar no site)
CREATE TABLE IF NOT EXISTS `tecnologias` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(50) NOT NULL UNIQUE,       -- Ex: "PHP", "Docker", "AWS S3", "Java"
  `icone` VARCHAR(50) NULL                  -- Nome do ícone (ex: FontAwesome "fab fa-php")
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Tabela Intermediária (Pivot) para Relacionar Projetos e Tecnologias
CREATE TABLE IF NOT EXISTS `projeto_tecnologia` (
  `projeto_id` INT NOT NULL,
  `tecnologia_id` INT NOT NULL,
  PRIMARY KEY (`projeto_id`, `tecnologia_id`),
  FOREIGN KEY (`projeto_id`) REFERENCES `projetos`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`tecnologia_id`) REFERENCES `tecnologias`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Tabela de Contatos/Orçamentos (Mensagens captadas de clientes interessados)
CREATE TABLE IF NOT EXISTS `contatos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `whatsapp` VARCHAR(20) NOT NULL,
  `mensagem` TEXT NOT NULL,
  `lido` TINYINT(1) DEFAULT 0,              -- Controle de mensagens novas no painel (0 = Não lido, 1 = Lido)
  `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;