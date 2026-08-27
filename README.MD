# 🚀 SQL Tecnologia - Portfólio Profissional & Plataforma CMS

Uma aplicação web moderna e robusta desenvolvida em **PHP 8.3** puro utilizando arquitetura **MVC (Model-View-Controller)** proprietária, orientada a objetos (OOP), conteinerizada com **Docker** e com banco relacional **MySQL**.

A plataforma reúne a apresentação de projetos, formulário de contato integrado e um **painel administrativo completo (CMS)** para gerenciamento seguro de conteúdo em tempo real.

---

## 📌 Demonstração Online

* **Site em Produção:** [sqltecnologia.inf.br](https://sqltecnologia.inf.br)

---

## 🛠️ Tecnologias Utilizadas

* **Backend:** PHP 8.3 (POO, MVC, PDO com Prepared Statements, Namespace e Autoload PSR-4)
* **Banco de Dados:** MySQL 8.0 (Modelagem relacional, tabelas intermediárias N:N e integridade referencial)
* **Frontend:** HTML5 semântico, CSS3 responsivo (Grid/Flexbox), JavaScript Vanilla e Font Awesome
* **DevOps & Infra:** Docker, Docker Compose, Apache (mod_rewrite via `.htaccess`) e Git
* **Bibliotecas:** `vlucas/phpdotenv` (Gerenciamento de variáveis de ambiente)

---

## 💡 Destaques de Engenharia e Arquitetura

* **Framework MVC do Zero:** Roteamento dinâmico e carregamento de controllers sem dependência de frameworks pesados, demonstrando domínio profundo da linguagem.
* **Segurança Reforçada:**
  * Camada de autenticação administrativa com Middleware e gerenciamento de sessões.
  * Sanitização de entradas e prevenção contra ataques **SQL Injection** via consultas parametrizadas com PDO.
  * Escapamento de saídas contra **XSS (Cross-Site Scripting)**.
  * Isolamento de código backend fora da raiz pública (`public_html`) em ambiente de produção.
* **Relacionamento Relacional N:N:** Gerenciamento dinâmico de tecnologias associadas a projetos via tabela associativa (`projeto_tecnologia`).
* **Upload e Tratamento de Mídias:** Processamento seguro de uploads de imagens com validação de extensão e geração de hashes únicos.

---

## 📂 Estrutura de Diretórios

```text
├── app/
│   ├── Controllers/       # Camada de controle e regras de negócio
│   ├── Models/            # Modelos e interação com banco de dados
│   ├── Views/             # Templates e renderização de telas
│   ├── Middleware/        # Filtros de requisição e autenticação
│   ├── Connection.php     # Singleton de conexão segura via PDO
│   ├── Router.php         # Mecanismo de roteamento customizado
│   └── View.php           # Motor de renderização de views
├── database/              # Scripts DDL e dumps de inicialização
├── public/                # Raiz acessível pela web
│   ├── assets/            # CSS, JS, ícones e diretório de uploads
│   ├── .htaccess          # Regras de reescrita para URLs amigáveis
│   └── index.php          # Ponto de entrada da aplicação (Front Controller)
├── docker-compose.yml     # Orquestração dos contêineres Docker
├── Dockerfile             # Configuração da imagem PHP/Apache
├── composer.json          # Dependências e mapeamento de autoload PSR-4
└── .env.example           # Modelo de variáveis de ambiente
```

## ⚙️ Como Executar o Projeto Localmente

### Pré-requisitos

* Docker e Docker Compose instalados

* Git

* PHP 8.3 e Composer instalados no computador

### Passo a Passo

Clone o repositório:

```bash
git clone https://github.com/marcioanjjo/sqltecnologia.git
cd sqltecnologia
```

Crie o arquivo `.env` a partir do modelo e mantenha as configurações locais:

```bash
cp .env.example .env
```

No ambiente Docker, use estas configurações no `.env`:

```env
APP_ENV=local
DB_HOST=db
DB_NAME=portfolio_db
DB_USER=portfolio_user
DB_PASS=user_password_seguro
DB_PORT=3306
```

Instale as dependências do PHP no computador, na raiz do projeto:

```bash
composer install
```

Suba o ambiente conteinerizado:

```bash
docker compose up -d --build
```

O Compose é executado no computador e inicia os serviços `web` e `db`. Como o banco local não é populado automaticamente, importe os scripts na ordem indicada:

```powershell
Get-Content database/schema.sql | docker compose exec -T db mysql -uportfolio_user -puser_password_seguro portfolio_db
Get-Content database/seeds.sql | docker compose exec -T db mysql -uportfolio_user -puser_password_seguro portfolio_db
```

Em Bash, use:

```bash
docker compose exec -T db mysql -uportfolio_user -puser_password_seguro portfolio_db < database/schema.sql
docker compose exec -T db mysql -uportfolio_user -puser_password_seguro portfolio_db < database/seeds.sql
```

Para parar o ambiente:

```bash
docker compose down
```

Acesse no navegador:

* Aplicação: http://localhost:8080

* Painel Administrativo: http://localhost:8080/admin/login

## 🚀 Publicação no cPanel

O ambiente de produção deste projeto utiliza hospedagem cPanel, e não Docker.

1. Crie um banco de dados MySQL, um usuário e associe o usuário ao banco pelo cPanel.
2. Importe `database/schema.sql` e `database/seeds.sql`, nessa ordem, pelo phpMyAdmin.
3. Crie o arquivo `.env` no servidor com as credenciais do cPanel:

```env
APP_ENV=production
DB_HOST=localhost
DB_NAME=seuusuario_portfolio
DB_USER=seuusuario_portfolio
DB_PASS=sua_senha_do_banco
DB_PORT=3306
APP_URL=https://seu-dominio.com
```

4. Execute `composer install --no-dev` na raiz do projeto, pelo Terminal do cPanel ou localmente antes do envio.
5. Envie o conteúdo de `public/` para `public_html/`.
6. Mantenha `app/`, `vendor/`, `.env` e `composer.json` fora de `public_html/` quando a hospedagem permitir.
7. Caso o cPanel não permita configurar a raiz do domínio para a pasta `public/`, ajuste os caminhos do projeto conforme a estrutura da hospedagem e mantenha o `.env` fora da área pública.

Acesse no navegador:

* Aplicação: https://seu-dominio.com

* Painel Administrativo: https://seu-dominio.com/admin/login

## 👨‍💻 Autor
Desenvolvido por Marcio dos Anjos Silva

Empresa: SQL Tecnologia

LinkedIn: www.linkedin.com/in/marciosilva59543029

GitHub: https://github.com/marcioanjjo