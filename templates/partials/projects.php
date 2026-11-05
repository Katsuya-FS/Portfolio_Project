<?php
declare(strict_types=1);
?>
<section class="projects-section" id="projects" data-ambient="projects">
    <div class="section-intro section-shell reveal">
        <p class="eyebrow"><span class="eyebrow-mark">04</span> Projects</p>
        <h2>Made with<br><span>purpose.</span></h2>
        <p>A few projects that I created.</p>
    </div>

    <div class="project-carousel" aria-label="Project carousel">
        <div class="project-controls section-shell">
            <p class="carousel-count" aria-live="polite"><span data-current-project>01</span> / <?= EscapeHtml(str_pad((string) count($Projects), 2, '0', STR_PAD_LEFT)) ?></p>
            <p class="carousel-hint">Scroll to explore projects</p>
        </div>

        <div class="project-track" data-project-track role="list" aria-label="Projects" tabindex="0">
            <?php foreach ($Projects as $ProjectIndex => $Project): ?>
                <?php $DialogId = 'project-details-' . $ProjectIndex; ?>
                <article class="project-slide" role="listitem">
                    <button
                        class="project-card<?= $ProjectIndex === 0 ? ' is-active' : '' ?>"
                        type="button"
                        data-project-card
                        aria-haspopup="dialog"
                        aria-controls="<?= EscapeHtml($DialogId) ?>"
                        aria-current="<?= $ProjectIndex === 0 ? 'true' : 'false' ?>"
                        aria-label="View details for <?= EscapeHtml($Project['title']) ?>"
                    >
                        <span class="project-card-image">
                            <img src="<?= EscapeHtml(BuildAssetUrl($Project['image'])) ?>" alt="<?= EscapeHtml($Project['alt']) ?>" loading="lazy">
                            <span class="visual-index">0<?= (int) ($ProjectIndex + 1) ?> / PROJECT</span>
                        </span>
                        <span class="project-card-copy">
                            <span class="project-eyebrow"></span>
                            <span class="project-card-title"><?= EscapeHtml($Project['title']) ?></span>
                            <span class="project-summary"><?= EscapeHtml($Project['summary']) ?></span>
                            <span class="tag-list" aria-label="Technology used">
                                <?php foreach ($Project['stack'] as $TechnologyTag): ?>
                                    <span><?= EscapeHtml($TechnologyTag) ?></span>
                                <?php endforeach; ?>
                            </span>
                            <span class="project-card-action">Explore project <span aria-hidden="true">↗</span></span>
                        </span>
                    </button>
                </article>

                <dialog class="project-dialog" id="<?= EscapeHtml($DialogId) ?>" aria-labelledby="<?= EscapeHtml($DialogId) ?>-title">
                    <div class="project-dialog-content">
                        <div class="project-dialog-cover">
                            <img src="<?= EscapeHtml(BuildAssetUrl($Project['image'])) ?>" alt="<?= EscapeHtml($Project['alt']) ?>">
                            <span class="visual-index">0<?= (int) ($ProjectIndex + 1) ?> / PROJECT</span>
                        </div>
                        <div class="project-dialog-details">
                            <button class="dialog-close" type="button" data-dialog-close aria-label="Close project details">×</button>
                            <p class="eyebrow">Project details · 0<?= (int) ($ProjectIndex + 1) ?></p>
                            <h3 id="<?= EscapeHtml($DialogId) ?>-title"><?= EscapeHtml($Project['title']) ?></h3>
                            <div class="project-story">
                                <div>
                                    <h4>About The Project</h4>
                                    <p><?= EscapeHtml($Project['about_project'] ?? $Project['problem'] ?? '') ?></p>
                                </div>
                            </div>
                            <ul class="tag-list" aria-label="Technologies used">
                                <?php foreach ($Project['stack'] as $TechnologyTag): ?>
                                    <li><?= EscapeHtml($TechnologyTag) ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="project-links">
                                <?php if ($Project['live'] !== '#'): ?>
                                    <a class="project-live-button" href="<?= EscapeHtml($Project['live']) ?>" target="_blank" rel="noopener noreferrer">Live site <span aria-hidden="true">↗</span></a>
                                <?php endif; ?>
                                <?php if ($Project['repo'] !== '#'): ?>
                                    <a class="project-repository-button" href="<?= EscapeHtml($Project['repo']) ?>" target="_blank" rel="noopener noreferrer">GitHub repository <span aria-hidden="true">↗</span></a>
                                <?php else: ?>
                                    <button class="project-repository-button is-placeholder" type="button" disabled>GitHub repository <span aria-hidden="true">↗</span></button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </dialog>
            <?php endforeach; ?>
        </div>
    </div>
</section>
