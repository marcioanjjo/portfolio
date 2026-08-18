<?php
if (empty($projeto)) {
    echo "<p>Projeto não encontrado.</p>";
    return;
}
?>
<a href="/portfolio" style="text-decoration: none; color: #0284c7; font-weight: 600;">← Voltar para o Portfólio</a>

<div class="card" style="margin-top: 1.5rem; background: #fff; padding: 2rem; border-radius: 8px; border: 1px solid #e2e8f0;">

    <h1 style="color: #0f172a; margin-bottom: 0.5rem; font-size: 2rem;"><?= htmlspecialchars($projeto['titulo'] ?? '') ?></h1>

    <?php if (!empty($projeto['tipo_servidor'])): ?>
        <div style="margin-bottom: 1.5rem;">
            <span class="badge" style="background: #f1f5f9; color: #334155; padding: 0.4rem 0.8rem; border-radius: 4px; font-size: 0.9rem;">
                <i class="fas fa-server"></i> Infraestrutura: <?= htmlspecialchars($projeto['tipo_servidor']); ?>
            </span>
        </div>
    <?php endif; ?>

    <?php if (!empty($projeto['imagem_capa'])): ?>
        <div style="margin-bottom: 2rem; text-align: center;">
            <img src="<?= htmlspecialchars($projeto['imagem_capa']) ?>" alt="<?= htmlspecialchars($projeto['titulo']) ?>" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
        </div>
    <?php endif; ?>

    <?php
    $techs = array_filter(explode(',', $projeto['tecnologias'] ?? ''));
    if (!empty($techs)):
    ?>
        <div style="margin-bottom: 1.5rem;">
            <strong style="color: #1e293b;">Tecnologias Utilizadas:</strong><br>
            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-top: 0.5rem;">
                <?php foreach ($techs as $tech): ?>
                    <span style="background: #e0f2fe; color: #0369a1; padding: 0.3rem 0.7rem; border-radius: 4px; font-weight: 500; font-size: 0.85rem;">
                        <?= htmlspecialchars(trim($tech)); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 1.5rem 0;">

    <h3 style="color: #1e293b; margin-bottom: 0.75rem;">Sobre o Projeto e Desafios Técnicos</h3>
    <div style="color: #334155; font-size: 1rem; line-height: 1.7; white-space: pre-line;">
        <?= htmlspecialchars($projeto['descricao_completa'] ?? $projeto['descricao_curta'] ?? 'Sem descrição detalhada cadastrada.') ?>
    </div>

    <div style="margin-top: 2rem; display: flex; gap: 1rem; flex-wrap: wrap;">
        <?php if (!empty($projeto['link_demo'])): ?>
            <a href="<?= htmlspecialchars($projeto['link_demo']) ?>" target="_blank" class="btn" style="background: #16a34a; color: #fff; text-decoration: none; padding: 0.75rem 1.5rem; border-radius: 6px; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-external-link-alt"></i> Acessar Demonstração ao Vivo
            </a>
        <?php endif; ?>

        <?php if (!empty($projeto['link_github'])): ?>
            <a href="<?= htmlspecialchars($projeto['link_github']) ?>" target="_blank" class="btn" style="background: #334155; color: #fff; text-decoration: none; padding: 0.75rem 1.5rem; border-radius: 6px; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                <i class="fab fa-github"></i> Ver Código no GitHub
            </a>
        <?php endif; ?>
    </div>
</div>