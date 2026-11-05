<?php
declare(strict_types=1);
?>
<section class="stack-section section-shell" id="stack" data-ambient="stack">
    <div class="section-intro reveal">
        <p class="eyebrow"><span class="eyebrow-mark">02</span> Tech Stack</p>
        <h2>Tools of<br><span>the trade.</span></h2>
        <p>A growing collection of technologies I use for devs.</p>
    </div>

    <div class="stack-groups">
        <?php foreach ($Stack as $CategoryName => $TechnologyItems): ?>
            <article class="grimoire-card reveal">
                <span class="card-sigil" aria-hidden="true">✳</span>
                <p class="card-index"><?= EscapeHtml(strtoupper($CategoryName)) ?></p>
                <h3><?= EscapeHtml($CategoryName) ?></h3>
                <ul class="tag-list">
                    <?php foreach ($TechnologyItems as $TechnologyName): ?>
                        <li><?= EscapeHtml($TechnologyName) ?></li>
                    <?php endforeach; ?>
                </ul>
            </article>
        <?php endforeach; ?>
    </div>
</section>
