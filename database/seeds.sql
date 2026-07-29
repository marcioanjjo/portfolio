-- 1. Criação das Tabelas
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `senha` VARCHAR(255) NOT NULL,
  `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `projetos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `titulo` VARCHAR(150) NOT NULL,
  `descricao_curta` VARCHAR(255) NOT NULL,
  `descricao_completa` TEXT NOT NULL,
  `link_demo` VARCHAR(255) NULL,
  `link_github` VARCHAR(255) NULL,
  `tipo_servidor` VARCHAR(100) NOT NULL,
  `imagem_capa` VARCHAR(255) NOT NULL,
  `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `tecnologias` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(50) NOT NULL UNIQUE,
  `icone` VARCHAR(50) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `projeto_tecnologia` (
  `projeto_id` INT NOT NULL,
  `tecnologia_id` INT NOT NULL,
  PRIMARY KEY (`projeto_id`, `tecnologia_id`),
  FOREIGN KEY (`projeto_id`) REFERENCES `projetos`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`tecnologia_id`) REFERENCES `tecnologias`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `contatos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `whatsapp` VARCHAR(20) NOT NULL,
  `mensagem` TEXT NOT NULL,
  `lido` TINYINT(1) DEFAULT 0,
  `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Inserção dos Registros de Exemplo
INSERT INTO `tecnologias` (`id`, `nome`, `icone`) VALUES
(1, 'PHP 8.3', 'fab fa-php'),
(2, 'MySQL', 'fas fa-database'),
(3, 'Docker', 'fab fa-docker'),
(4, 'AWS EC2', 'fab fa-aws'),
(5, 'HostGator (cPanel)', 'fas fa-server')
ON DUPLICATE KEY UPDATE `nome` = VALUES(`nome`);

INSERT INTO `projetos` (`id`, `titulo`, `descricao_curta`, `descricao_completa`, `link_demo`, `link_github`, `tipo_servidor`, `imagem_capa`) VALUES
(1, 'E-Commerce Completo', 'Plataforma de vendas online com checkout transparente.', 'Sistema completo desenvolvido em PHP com arquitetura MVC, banco de dados MySQL otimizado e hospedagem em ambiente de nuvem.', 'https://loja.sqltecnologia.inf.br', 'https://github.com/sqltecnologia/loja-demo', 'HostGator (cPanel)', 'loja.jpg')
ON DUPLICATE KEY UPDATE `titulo` = VALUES(`titulo`);

INSERT IGNORE INTO `projeto_tecnologia` (`projeto_id`, `tecnologia_id`) VALUES
(1, 1),
(1, 2),
(1, 5);