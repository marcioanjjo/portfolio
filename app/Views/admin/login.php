<?php
$title = $title ?? 'Acesso Administrativo';

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        body {
            background: #0f172a;
            color: #fff;
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            background: #1e293b;
            padding: 2.5rem;
            border-radius: 8px;
            width: 100%;
            max-width: 380px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        input {
            width: 100%;
            padding: 0.8rem;
            margin: 0.5rem 0 1.2rem 0;
            border-radius: 4px;
            border: 1px solid #334155;
            background: #0f172a;
            color: #fff;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 0.8rem;
            background: #0284c7;
            border: none;
            color: #fff;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
        }

        .erro {
            background: #ef4444;
            color: #fff;
            padding: 0.6rem;
            border-radius: 4px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <h2 style="text-align: center; color: #38bdf8; margin-top: 0;">⚡ Painel SQL Tecnologia</h2>

        <?php if (!empty($erro)): ?>
            <div class="erro"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form action="/admin/login" method="POST">
            <label>E-mail Corporativo:</label>
            <input type="email" name="email" required>

            <label>Senha:</label>
            <input type="password" name="senha" required>

            <button type="submit">Acessar Painel</button>
        </form>
    </div>
</body>

</html>