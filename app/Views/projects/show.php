<div style="max-width: 1000px; margin: 2rem auto; padding: 0 1rem;">
    <a href="/portfolio" style="text-decoration: none; color: #0284c7; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem; margin-bottom: 1.5rem;">
        &larr; Voltar para o Portfólio
    </a>

    <div class="card" style="background: #fff; padding: 2rem; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">

        <h1 style="color: #0f172a; margin-top: 0; margin-bottom: 0.5rem; font-size: 2rem;">
            <?= htmlspecialchars($projeto['titulo'] ?? '') ?>
        </h1>

        <?php if (!empty($projeto['tipo_servidor'])): ?>
            <div style="margin-bottom: 1.5rem;">
                <span style="background: #f1f5f9; color: #334155; padding: 0.35rem 0.75rem; border-radius: 4px; font-size: 0.88rem; font-weight: 500;">
                    ⚙️ Infraestrutura: <?= htmlspecialchars($projeto['tipo_servidor']); ?>
                </span>
            </div>
        <?php endif; ?>

        <?php if (!empty($projeto['imagem_capa'])): ?>
            <div style="margin-bottom: 2rem; text-align: center; background: #0f172a; border-radius: 8px; overflow: hidden; max-height: 450px; display: flex; align-items: center; justify-content: center;">
                <img src="<?= htmlspecialchars($projeto['imagem_capa']) ?>"
                    alt="<?= htmlspecialchars($projeto['titulo'] ?? 'Projeto') ?>"
                    style="max-width: 100%; height: auto; object-fit: contain;">
            </div>
        <?php endif; ?>

        <?php
        $techs = $projeto['tecnologias'] ?? [];
        if (!empty($techs)):
        ?>
            <div style="margin-bottom: 1.5rem;">
                <strong style="color: #1e293b; display: block; margin-bottom: 0.5rem;">Tecnologias Utilizadas:</strong>
                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                    <?php foreach ($techs as $tech): ?>
                        <?php
                        $nomeTech  = is_array($tech) ? ($tech['nome'] ?? '') : $tech;
                        $iconeTech = is_array($tech) ? ($tech['icone'] ?? '') : '';
                        ?>
                        <span style="display: inline-flex; align-items: center; gap: 6px; background: #f8fafc; color: #0f172a; border: 1px solid #cbd5e1; padding: 0.4rem 0.8rem; border-radius: 6px; font-size: 0.9rem; font-weight: 500;">
                            <?php if (!empty($iconeTech)): ?>
                                <i class="<?= htmlspecialchars($iconeTech) ?>"></i>
                            <?php endif; ?>
                            <?= htmlspecialchars($nomeTech) ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 1.5rem 0;">

        <h3 style="color: #1e293b; margin-bottom: 0.75rem;">Sobre o Projeto e Detalhes</h3>
        <div style="color: #334155; font-size: 1rem; line-height: 1.7; white-space: pre-line;">
            <?= htmlspecialchars(!empty($projeto['descricao_completa']) ? $projeto['descricao_completa'] : ($projeto['descricao_curta'] ?? 'Sem descrição cadastrada.')) ?>
        </div>

        <div style="margin-top: 2rem; display: flex; gap: 1rem; flex-wrap: wrap;">
            <?php if (!empty($projeto['link_demo'])): ?>
                <a href="<?= htmlspecialchars($projeto['link_demo']) ?>" target="_blank" class="btn" style="background: #16a34a; color: #fff; text-decoration: none; padding: 0.75rem 1.5rem; border-radius: 6px; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                    🌐 Acessar Demonstração ao Vivo
                </a>
            <?php endif; ?>

            <?php if (!empty($projeto['link_github'])): ?>
                <a href="<?= htmlspecialchars($projeto['link_github']) ?>" target="_blank" class="btn" style="background: #334155; color: #fff; text-decoration: none; padding: 0.75rem 1.5rem; border-radius: 6px; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                    🐙 Ver Código no GitHub
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>