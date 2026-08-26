<h1 style="color: #0f172a;">📋 Nosso Portfólio de Projetos</h1>
<p style="color: #64748b;">Conheça alguns dos sistemas desenvolvidos e as infraestruturas onde estão hospedados.</p>

<div class="card-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem; margin-top: 1.5rem;">
    <?php if (empty($projetos)): ?>
        <p style="color: #64748b;">Nenhum projeto publicado no momento.</p>
    <?php else: ?>
        <?php foreach ($projetos as $projeto): ?>
            <div class="card" style="background: #fff; border-radius: 8px; border: 1px solid #e2e8f0; overflow: hidden; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">

                <!-- Capa -->
                <?php if (!empty($projeto['imagem_capa'])): ?>
                    <div style="width: 100%; height: 180px; overflow: hidden; background: #0f172a; display: flex; align-items: center; justify-content: center;">
                        <img src="<?= htmlspecialchars($projeto['imagem_capa']) ?>"
                            alt="<?= htmlspecialchars($projeto['titulo']) ?>"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                <?php endif; ?>

                <div style="padding: 1.2rem; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">
                    <div>
                        <h3 style="margin-top: 0; margin-bottom: 0.5rem; color: #0f172a; font-size: 1.25rem;">
                            <?= htmlspecialchars($projeto['titulo']) ?>
                        </h3>

                        <p style="margin: 0 0 1rem 0; color: #475569; font-size: 0.92rem; line-height: 1.5;">
                            <?= htmlspecialchars($projeto['descricao_curta']) ?>
                        </p>

                        <!-- Badges / Ícones das Tecnologias -->
                        <?php if (!empty($projeto['tecnologias']) && is_array($projeto['tecnologias'])): ?>
                            <div style="display: flex; flex-wrap: wrap; gap: 6px; margin: 0.8rem 0;">
                                <?php foreach ($projeto['tecnologias'] as $tech): ?>
                                    <?php
                                    $nomeTech  = is_array($tech) ? ($tech['nome'] ?? '') : $tech;
                                    $iconeTech = is_array($tech) ? ($tech['icone'] ?? '') : '';
                                    ?>
                                    <span style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 8px; font-size: 0.78rem; font-weight: 600; background: #e2e8f0; color: #0f172a; border-radius: 4px;">
                                        <?php if (!empty($iconeTech)): ?>
                                            <i class="<?= htmlspecialchars($iconeTech) ?>"></i>
                                        <?php endif; ?>
                                        <?= htmlspecialchars($nomeTech) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($projeto['tipo_servidor'])): ?>
                            <p style="margin-bottom: 0.8rem; font-size: 0.85rem; color: #64748b;">
                                <strong>Infra:</strong>
                                <span style="background: #f1f5f9; color: #334155; padding: 0.2rem 0.5rem; border-radius: 4px;">
                                    <?= htmlspecialchars($projeto['tipo_servidor']) ?>
                                </span>
                            </p>
                        <?php endif; ?>

                        <!-- Tecnologias com Ícones -->
                        <?php
                        $techs = array_filter(array_map('trim', explode(',', $projeto['tecnologias'] ?? '')));
                        if (!empty($techs)):
                        ?>
                            <div style="margin-bottom: 1.2rem; display: flex; gap: 0.4rem; flex-wrap: wrap;">
                                <?php foreach ($techs as $tech):
                                    $icon = \App\Helpers\TechBadge::getIconClass($tech);
                                ?>
                                    <span style="background: #f8fafc; color: #0f172a; border: 1px solid #e2e8f0; padding: 0.2rem 0.55rem; border-radius: 4px; font-size: 0.78rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.35rem;">
                                        <i class="<?= $icon ?> colored" style="font-size: 1rem;"></i>
                                        <?= htmlspecialchars($tech) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <a href="/projeto/<?= $projeto['id'] ?>" class="btn" style="background: #0284c7; color: #fff; text-align: center; text-decoration: none; padding: 0.6rem 1rem; border-radius: 6px; font-weight: 600; display: block; margin-top: 0.5rem;">
                        Ver Detalhes do Projeto &rarr;
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>