<?php
declare(strict_types=1);
?>
<header class="site-header" id="site-header">
    <a class="logo" href="#home" aria-label="<?= EscapeHtml($Profile['name']) ?> home">
        <span class="clover" aria-hidden="true">
            <svg viewBox="0 0 48 48">
                <path d="M24 22C12 22 9 17 11 12c2-5 9-4 13 7Zm2 0c0-12 5-15 10-13s4 9-7 13Zm0 3c12 0 15 5 13 10s-9 4-13-7Zm-3 0c0 12-5 15-10 13s-4-9 7-13Z" fill="currentColor"/>
                <path d="M24 24c-7-7-12-10-15-7 1 5 7 9 15 7Zm0 0c7-7 10-12 7-15-5 1-9 7-7 15Zm0 0c7 7 12 10 15 7-1-5-7-9-15-7Zm0 0c-7 7-10 12-7 15 5-1 9-7 7-15Z" fill="currentColor" opacity=".55"/>
                <path d="M24 25v12" stroke="currentColor" stroke-width="2"/>
            </svg>
        </span>
        <span><?= EscapeHtml($Profile['name']) ?></span>
    </a>

    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-nav" aria-label="Open navigation">
        <span></span><span></span>
    </button>

    <nav id="primary-nav" class="nav-links" aria-label="Primary navigation">
        <a href="#home">Home</a>
        <a href="#stack">Tech Stack</a>
        <a href="#education">Education</a>
        <a href="#projects">Projects</a>
        <a href="#contact">Contact</a>
    </nav>
    <button class="theme-toggle" type="button" aria-label="Switch to light theme" aria-pressed="false">
        <span class="theme-label">Light Mode</span>
    </button>
    <div class="progress-track" aria-hidden="true"><span id="scroll-progress"></span></div>
</header>
