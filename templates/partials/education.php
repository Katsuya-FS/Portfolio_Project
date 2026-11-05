<?php
declare(strict_types=1);
?>
<section class="education-section section-shell" id="education" data-ambient="education">
    <div class="section-intro reveal">
        <p class="eyebrow"><span class="eyebrow-mark">03</span> Education</p>
        <h2>Learning<br><span>along the way.</span></h2>
        <p>My education, from the first classroom to the one I’m in today.</p>
    </div>

    <ol class="education-list">
        <?php foreach ($Education as $EducationRecord): ?>
            <li class="education-card reveal">
                <span class="education-level"><?= EscapeHtml($EducationRecord['level']) ?></span>
                <div class="education-details">
                    <h3><?= EscapeHtml($EducationRecord['school']) ?></h3>
                    <p><?= EscapeHtml($EducationRecord['program']) ?></p>
                </div>
                <span class="education-period"><?= EscapeHtml($EducationRecord['period']) ?></span>
            </li>
        <?php endforeach; ?>
    </ol>
</section>
