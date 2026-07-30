<?php
    if(empty($projeto)){
        echo "<p> Projeto não encontrado.</p>";
        return;
    }
?>
<a href="/portfolio" style="text-decoration: none; color: #0284c7; font-weight: 600;">← Voltar para o Portfólio</a>

<div class="card" style="margin-top: 1.5rem;">
    <h1 style="color: #0f172a; margin-bottom: 0.5rem;"><?= htmlspecialchars($projeto['titulo']) ?></h1>

    <div style="margin-bottom: 1.5rem;">
        <span class="badge" style="background: #f1f5f9; color: #334155; padding: 0.4rem 0.8rem;">
            <i class="fas fa-server"></i> Infraestrutura: <?= htmlspecialchars($projeto['tipo_servidor']); ?>
        </span>
    </div>

    <div style="margin-bottom: 1.5rem;">
        <strong>Tecnologias Utilizadas:</strong><br>
        <?php 
            $techs = explode(',', $projeto['tecnologias'] ?? '');
            foreach ($techs as $tech): 
                if (trim($tech) === '') continue;
        ?>
            <span class="badge" style="padding: 0.4rem 0.8rem; margin-top: 0.4rem;"><?= htmlspecialchars(trim($tech)); ?></span>
        <?php endforeach; ?>
    </div>

    <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 1.5rem 0;">

    <h3 style="color: #1e293b; margin-bottom: 0.5rem;">Sobre o Projeto e Desafios Técnicos</h3>
    <p style="color: #334155; font-size: 1.05rem; white-space: pre-line;"><?= htmlspecialchars($projeto['descricao_completa']) ?></p>

    <div style="margin-top: 2rem; display: flex; gap: 1rem; flex-wrap: wrap;">
        <?php if (!empty($projeto['link_demo'])): ?>
            <a href="<?= htmlspecialchars($projeto['link_demo']) ?>" target="_blank" class="btn" style="background: #16a34a;">
                <i class="fas fa-external-link-alt"></i> Acessar Demonstração ao Vivo
            </a>
        <?php endif; ?>

        <?php if (!empty($projeto['link_github'])): ?>
            <a href="<?= htmlspecialchars($projeto['link_github']) ?>" target="_blank" class="btn" style="background: #334155;">
                <i class="fab fa-github"></i> Ver Código no GitHub
            </a>
        <?php endif; ?>
    </div>
</div>