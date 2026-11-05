<?php declare(strict_types=1); ?>
<section class="hero section-shell" id="home" data-ambient="hero">
    <div class="hero-art">
        <div class="magic-circle circle-one" aria-hidden="true"></div>
        <div class="magic-circle circle-two" aria-hidden="true"></div>
        <figure class="hero-portrait">
            <img src="<?= EscapeHtml(BuildAssetUrl('img/ProfilePicture.jpg')) ?>" alt="Portrait of <?= EscapeHtml($Profile['name']) ?>" width="530" height="768" fetchpriority="high">
        </figure>
    </div>
    <div class="hero-clover-effect" aria-hidden="true">✿</div>

    <div class="hero-copy reveal">
        <p class="eyebrow"><span class="eyebrow-mark">✳</span><?= EscapeHtml($Profile['location']) ?></p>
        <h1><?= EscapeHtml($Profile['name']) ?><span class="hero-period">.</span></h1>
        <p class="hero-role"><?= EscapeHtml($Profile['role']) ?></p>
        <p class="hero-pitch"><?= EscapeHtml($Profile['pitch']) ?></p>
        <div class="button-row">
            <a class="button button-primary" href="#projects">View projects <span>↘</span></a>
            <a class="button button-quiet" href="#contact">Contact me <span>↗</span></a>
        </div>
        <p class="hero-about"><?= EscapeHtml($Profile['about']) ?></p>
    </div>

    <a class="scroll-cue" href="#stack"><span class="scroll-line"></span> Scroll to explore</a>
</section>
