<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SQL Tecnologia | Desenvolvimento e Cloud' ?></title>
    <!-- FontAwesome para Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS Nativo Simples -->
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            color: #333;
            line-height: 1.6;
        }

        header {
            background-color: #0f172a;
            color: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            font-size: 1.4rem;
            font-weight: bold;
            color: #38bdf8;
            text-decoration: none;
        }

        nav a {
            color: #cbd5e1;
            text-decoration: none;
            margin-left: 1.5rem;
            transition: 0.3s;
        }

        nav a:hover {
            color: #38bdf8;
        }

        .container {
            max-width: 1100px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .card {
            background: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .badge {
            background: #e0f2fe;
            color: #0369a1;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin-right: 0.4rem;
        }

        .btn {
            display: inline-block;
            background: #0284c7;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 1rem;
            transition: 0.2s;
        }

        .btn:hover {
            background: #0369a1;
        }

        footer {
            background: #0f172a;
            color: #94a3b8;
            text-align: center;
            padding: 1.5rem;
            margin-top: 3rem;
        }
    </style>
    <!-- Devicon Icons CDN -->
    <link rel="stylesheet" type='text/css' href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />
</head>

<body>
    <!-- Barra Rápida do Administrador (só aparece se estiver logado) -->
    <?php if (!empty($_SESSION['admin_user'])): ?>
        <div style="background: #1e293b; color: #38bdf8; padding: 0.4rem 2rem; font-size: 0.85rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #334155;">
            <span>👤 Olá, <strong><?= htmlspecialchars($_SESSION['admin_user']['nome']) ?></strong></span>
            <div style="display: flex; gap: 1rem;">
                <a href="/admin/dashboard" style="color: #38bdf8; text-decoration: none; font-weight: 600;">⚙️ Ir para o Painel</a>
                <a href="/admin/logout" style="color: #f87171; text-decoration: none;">Sair</a>
            </div>
        </div>
    <?php endif; ?>

    <header>
        <a href="/" class="logo">⚡ SQL Tecnologia</a>
        <nav>
            <a href="/">Inicio</a>
            <a href="/portfolio">Portfólio</a>
            <a href="/#contato">Solicitar Orçamento</a>
        </nav>
    </header>

    <main class="container">
        <!-- </body>
</html> -->