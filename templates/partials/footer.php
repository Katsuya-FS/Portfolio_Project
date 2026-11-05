<?php
declare(strict_types=1);
?>
<section class="contact-section section-shell" id="contact" data-ambient="contact">
    <div class="contact-heading reveal">
        <p class="eyebrow"><span class="eyebrow-mark">05</span> Get in touch</p>
        <h2>Let’s<br><span>connect.</span></h2>
        <p>Find me online and get in touch through any of these channels.</p>
    </div>

    <div class="social-links reveal" aria-label="Contact and social links">
        <a class="social-card" href="mailto:<?= EscapeHtml($SiteConfig['email']) ?>">
            <span class="social-type">Email</span>
            <span class="social-value"><?= EscapeHtml($SiteConfig['email']) ?></span>
            <span class="social-arrow" aria-hidden="true">↗</span>
        </a>
        <?php if ($SiteConfig['socials']['github'] !== ''): ?>
            <a class="social-card" href="<?= EscapeHtml($SiteConfig['socials']['github']) ?>" target="_blank" rel="noopener noreferrer">
                <span class="social-type">GitHub</span>
                <span class="social-value">View my projects</span>
                <span class="social-arrow" aria-hidden="true">↗</span>
            </a>
        <?php endif; ?>
        <?php if ($SiteConfig['socials']['linkedin'] !== ''): ?>
            <a class="social-card" href="<?= EscapeHtml($SiteConfig['socials']['linkedin']) ?>" target="_blank" rel="noopener noreferrer">
                <span class="social-type">LinkedIn</span>
                <span class="social-value">Connect with me</span>
                <span class="social-arrow" aria-hidden="true">↗</span>
            </a>
        <?php endif; ?>
    </div>
</section>

<footer class="site-footer section-shell">
    <div class="footer-bottom">
        <span>© <?= date('Y') ?> <?= EscapeHtml($Profile['name']) ?></span>
        <span>Built with curiosity &amp; passion.</span>
        <a href="#home">Back to top ↑</a>
    </div>
</footer>
