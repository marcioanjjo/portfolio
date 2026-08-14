<!-- Hero Section -->
<section style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #fff; padding: 3rem 2rem; border-radius: 12px; margin-bottom: 2.5rem; text-align: center;">
    <h1 style="font-size: 2.5rem; color: #38bdf8; margin-bottom: 1rem;">Soluções em Desenvolvimento & Nuvem</h1>
    <p style="font-size: 1.2rem; color: #cbd5e1; max-width: 800px; margin: 0 auto 1.5rem auto;">
        Desenvolvimento de sistemas web modernos em PHP, APIs personalizadas e arquitetura de servidores (de hospedagens comuns cPanel a infraestrutura escalável na AWS).
    </p>
    <a href="#contato" class="btn" style="background: #38bdf8; color: #0f172a; font-weight: bold; padding: 0.8rem 1.8rem; font-size: 1.1rem;">
        Solicitar Orçamento
    </a>
</section>

<!-- Seção de Serviços -->
<section style="margin-bottom: 3rem;">
    <h2 style="color: #0f172a; text-align: center; margin-bottom: 1.5rem;">O Que Fazemos na SQL Tecnologia</h2>
    <div class="card-grid">
        <div class="card">
            <h3 style="color: #0284c7; margin-bottom: 0.5rem;"><i class="fas fa-code"></i> Sistemas Web & APIs</h3>
            <p style="color: #475569;">Desenvolvimento de aplicações sob medida em PHP 8.3 com arquitetura MVC limpa, segura e de alta performance.</p>
        </div>
        <div class="card">
            <h3 style="color: #0284c7; margin-bottom: 0.5rem;"><i class="fas fa-server"></i> Infraestrutura & Cloud</h3>
            <p style="color: #475569;">Configuração de servidores VPS, hospedagens cPanel/HostGator e implantação de contêineres Docker e instâncias AWS EC2.</p>
        </div>
        <div class="card">
            <h3 style="color: #0284c7; margin-bottom: 0.5rem;"><i class="fas fa-database"></i> Banco de Dados</h3>
            <p style="color: #475569;">Modelagem relacional SQL, otimização de consultas e integração segura com a camada de dados da sua empresa.</p>
        </div>
    </div>
</section>

<!-- Seção de Projetos em Destaque -->
<?php if (!empty($projetos)): ?>
    <section style="margin-bottom: 3rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <h2 style="color: #0f172a;">Projetos em Destaque</h2>
            <a href="/portfolio" style="color: #0284c7; text-decoration: none; font-weight: 600;">Ver todos os projetos →</a>
        </div>
        <div class="card-grid">
            <?php foreach ($projetos as $projeto): ?>
                <div class="card">
                    <h3><?= htmlspecialchars($projeto['titulo']) ?></h3>
                    <p style="margin: 0.5rem 0 1rem 0; color: #475569;"><?= htmlspecialchars($projeto['descricao_curta']) ?></p>
                    <span class="badge" style="background: #f1f5f9; color: #334155;">
                        <i class="fas fa-server"></i> <?= htmlspecialchars($projeto['tipo_servidor']) ?>
                    </span>
                    <br>
                    <a href="/projeto/<?= $projeto['id'] ?>" class="btn" style="margin-top: 1rem;">Detalhes</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>

<!-- Seção do Formulário de Contato / Captação de Clientes -->
<section id="contato" class="card" style="padding: 2rem; background: #fff; border: 2px solid #38bdf8;">
    <h2 style="color: #0f172a; margin-bottom: 0.5rem;">Vamos Tirar Seu Projeto do Papel?</h2>
    <p style="color: #64748b; margin-bottom: 1.5rem;">Preencha o formulário abaixo para solicitar um orçamento ou tirar dúvidas técnicas sobre nossos serviços.</p>

    <!-- Avisos de Sucesso ou Erro -->
    <?php if (!empty($sucesso)): ?>
        <div style="background: #dcfce7; color: #15803d; padding: 1rem; border-radius: 6px; margin-bottom: 1rem; font-weight: 600;">
            ✓ <?= htmlspecialchars($sucesso) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($erro)): ?>
        <div style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 6px; margin-bottom: 1rem; font-weight: 600;">
            ✕ <?= htmlspecialchars($erro) ?>
        </div>
    <?php endif; ?>

    <form action="/contact" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
        <input type="hidden" name="csrf_token" value="<?= \App\Helpers\Csrf::generate(); ?>">
        <div>
            <label style="display: block; font-weight: 600; margin-bottom: 0.3rem;">Nome Completo / Empresa:</label>
            <input type="text" name="nome" required style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 6px;">
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 0.3rem;">E-mail de Contato:</label>
                <input type="email" name="email" required style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 6px;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 0.3rem;">WhatsApp / Telefone:</label>
                <input type="text" name="whatsapp" placeholder="(83) 99999-9999" required style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 6px;">
            </div>
        </div>

        <div>
            <label style="display: block; font-weight: 600; margin-bottom: 0.3rem;">Descrição do Serviço Desejado:</label>
            <textarea name="mensagem" rows="4" required placeholder="Descreva brevemente o sistema, site ou infraestrutura que você precisa..." style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 6px;"></textarea>
        </div>

        <button type="submit" class="btn" style="background: #0284c7; font-size: 1.1rem; padding: 0.9rem; border: none; cursor: pointer; border-radius: 6px;">
            <i class="fas fa-paper-plane"></i> Enviar Solicitação de Orçamento
        </button>
    </form>
</section>