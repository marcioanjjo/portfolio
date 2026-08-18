<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; background: #fff; padding: 1.2rem 1.5rem; border-radius: 8px; border: 1px solid #e2e8f0;">
    <div>
        <h1 style="margin: 0; font-size: 1.6rem; color: #0f172a;">🚀 Gerenciamento de Projetos</h1>
        <p style="margin: 0.3rem 0 0 0; color: #64748b; font-size: 0.95rem;">
            Conectado como: <strong style="color: #0284c7;">👤 <?= htmlspecialchars($usuarioLogado ?? 'Admin') ?></strong>
        </p>
    </div>

    <div style="display: flex; gap: 0.7rem; align-items: center;">
        <a href="/admin/dashboard" class="btn" style="background: #0284c7; font-size: 0.9rem;">📨 Orçamentos</a>
        <a href="/" target="_blank" class="btn" style="background: #475569; font-size: 0.9rem;">🌐 Ver Site</a>
        <a href="/admin/logout" class="btn" style="background: #ef4444; font-size: 0.9rem;">Sair</a>
    </div>
</div>

<?php if (!empty($sucesso)): ?>
    <div style="background: #dcfce7; color: #166534; padding: 0.8rem; border-radius: 6px; margin-bottom: 1.5rem;">
        <?= htmlspecialchars($sucesso) ?>
    </div>
<?php endif; ?>

<?php if (!empty($erro)): ?>
    <div style="background: #fee2e2; color: #991b1b; padding: 0.8rem; border-radius: 6px; margin-bottom: 1.5rem;">
        <?= htmlspecialchars($erro) ?>
    </div>
<?php endif; ?>

<!-- Formulário de Cadastro Completo -->
<div class="card" style="margin-bottom: 2.5rem; border-top: 4px solid #0284c7;">
    <h2 style="margin-top: 0; color: #0f172a;">➕ Cadastrar Novo Projeto</h2>

    <form action="/admin/projetos" method="POST" enctype="multipart/form-data style=" display: grid; gap: 1.2rem; margin-top: 1rem;">
        <input type="hidden" name="csrf_token" value="<?= \App\Helpers\Csrf::generate(); ?>">

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1rem;">
            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.3rem;">Título do Projeto *</label>
                <input type="text" name="titulo" placeholder="Ex: Sistema de Gestão Empresarial" required style="width: 100%; padding: 0.6rem; border-radius: 4px; border: 1px solid #cbd5e1;">
            </div>
            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.3rem;">Tipo de Servidor / Infra</label>
                <input type="text" name="tipo_servidor" placeholder="Ex: Docker / Nginx / Linux" value="Docker / Apache" style="width: 100%; padding: 0.6rem; border-radius: 4px; border: 1px solid #cbd5e1;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.3rem;">Link da Demonstração (Demo / Site)</label>
                <input type="url" name="link_demo" placeholder="https://meuprojeto.com.br" style="width: 100%; padding: 0.6rem; border-radius: 4px; border: 1px solid #cbd5e1;">
            </div>
            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.3rem;">Link do Repositório GitHub</label>
                <input type="url" name="link_github" placeholder="https://github.com/usuario/repositorio" style="width: 100%; padding: 0.6rem; border-radius: 4px; border: 1px solid #cbd5e1;">
            </div>
        </div>

        <div>
            <label style="font-weight: 600; display: block; margin-bottom: 0.3rem;">URL ou Caminho da Imagem de Capa</label>
            <input type="file" name="imagem_arquivo" placeholder="Nome do Arquivo(Print)" style="width: 100%; padding: 0.6rem; border-radius: 4px; border: 1px solid #cbd5e1;">
        </div>

        <div>
            <label style="font-weight: 600; display: block; margin-bottom: 0.3rem;">Descrição Curta (Exibida no Card da Home) *</label>
            <input type="text" name="descricao_curta" placeholder="Resumo em 1 ou 2 frases do objetivo da aplicação" required style="width: 100%; padding: 0.6rem; border-radius: 4px; border: 1px solid #cbd5e1;">
        </div>

        <div>
            <label style="font-weight: 600; display: block; margin-bottom: 0.3rem;">Descrição Completa / Regras de Negócio</label>
            <textarea name="descricao_completa" rows="4" placeholder="Detalhes técnicos, arquitetura MVC, segurança implementada, desafios superados..." style="width: 100%; padding: 0.6rem; border-radius: 4px; border: 1px solid #cbd5e1;"></textarea>
        </div>

        <button type="submit" class="btn" style="background: #16a34a; justify-self: start; padding: 0.7rem 1.8rem; border: none; cursor: pointer;">
            💾 Salvar Projeto
        </button>
    </form>
</div>

<!-- Listagem dos Projetos Existentes -->
<h2>Projetos Atuais no Portfólio (<?= count($projetos ?? []) ?>)</h2>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 1rem;">
    <?php if (!empty($projetos) && is_iterable($projetos)): ?>
        <?php foreach ($projetos as $p): ?>
            <div class="card" style="display: flex; flex-direction: column; justify-content: space-between; border-top: 3px solid #0284c7;">
                <div>
                    <h3 style="margin-top: 0; color: #0f172a;"><?= htmlspecialchars($p['titulo']) ?></h3>
                    <p style="color: #64748b; font-size: 0.85rem; margin-bottom: 0.5rem;">
                        <strong>Servidor:</strong> <?= htmlspecialchars($p['tipo_servidor'] ?? 'N/D') ?> |
                        <strong>Techs:</strong> <?= htmlspecialchars($p['tecnologias'] ?? 'N/D') ?>
                    </p>
                    <p style="color: #334155; font-size: 0.9rem; line-height: 1.4;">
                        <?= nl2br(htmlspecialchars($p['descricao_curta'] ?? $p['descricao'] ?? '')) ?>
                    </p>
                </div>

                <div style="display: flex; gap: 0.8rem; margin-top: 1rem; flex-wrap: wrap;">
                    <?php if (!empty($p['link_demo'])): ?>
                        <a href="<?= htmlspecialchars($p['link_demo']) ?>" target="_blank" style="color: #0284c7; text-decoration: none; font-size: 0.85rem; font-weight: bold;">
                            🌐 Demo
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($p['link_github'])): ?>
                        <a href="<?= htmlspecialchars($p['link_github']) ?>" target="_blank" style="color: #334155; text-decoration: none; font-size: 0.85rem; font-weight: bold;">
                            🐙 GitHub
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
    <?php endif; ?>

</div>