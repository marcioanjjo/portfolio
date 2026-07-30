<h1 style="color: #0f172a;">📋 Nosso Portfólio de Projetos</h1>
<p style="color: #64748b;">Conheça alguns dos sistemas desenvolvidos e as infraestruturas onde estão hospedados.</p>

<div class="card-grid">
    <?php if (empty($projetos)): ?>
        <p>Nenhum projeto publicado no momento.</p>
    <?php else: ?>
        <?php foreach ($projetos as $projeto): ?>
            <div class="card">
                <h3><?= htmlspecialchars($projeto['titulo']) ?></h3>
                <p style="margin: 0.5rem 0 1rem 0; color: #475569;"><?= htmlspecialchars($projeto['descricao_curta']) ?></p>
                
                <p style="margin-bottom: 0.5rem;">
                    <strong>Servidor:</strong> 
                    <span class="badge" style="background: #f1f5f9; color: #334155;">
                        <i class="fas fa-server"></i> <?= htmlspecialchars($projeto['tipo_servidor']) ?>
                    </span>
                </p>

                <p style="margin-bottom: 1rem;">
                    <strong>Tecnologias:</strong><br>
                    <?php 
                        $techs = explode(',', $projeto['tecnologias'] ?? '');
                        foreach ($techs as $tech): 
                            if (trim($tech) === '') continue;
                    ?>
                        <span class="badge"><?= htmlspecialchars(trim($tech)) ?></span>
                    <?php endforeach; ?>
                </p>

                <a href="/projeto/<?= $projeto['id'] ?>" class="btn">Ver Detalhes do Projeto</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>