import { ProjectCenterObserverRootMargin, ProjectCounterDigits } from './constants.js?v=2';

export function InitializeProjects() {
    const ProjectTrack = document.querySelector('[data-project-track]');
    if (!ProjectTrack) return;

    const ProjectCards = [...ProjectTrack.querySelectorAll('[data-project-card]')];
    if (ProjectCards.length === 0) return;

    const ProjectSlides = ProjectCards.map((ProjectCard) => ProjectCard.closest('.project-slide') ?? ProjectCard);
    const ProjectCountLabel = document.querySelector('[data-current-project]');
    const ReducedMotionPreference = matchMedia('(prefers-reduced-motion: reduce)');
    let ActiveProjectIndex = 0;
    let IsProjectUpdateQueued = false;

    const SetActiveProjectCard = (ProjectIndex) => {
        if (ProjectIndex < 0 || ProjectIndex >= ProjectCards.length) return;

        ActiveProjectIndex = ProjectIndex;
        ProjectCards.forEach((ProjectCard, CardIndex) => {
            const IsActiveProject = CardIndex === ActiveProjectIndex;
            ProjectCard.classList.toggle('is-active', IsActiveProject);
            ProjectCard.setAttribute('aria-current', String(IsActiveProject));
        });

        if (ProjectCountLabel) {
            ProjectCountLabel.textContent = String(ActiveProjectIndex + 1).padStart(ProjectCounterDigits, '0');
        }
    };

    const UpdateActiveProjectCard = () => {
        const ProjectTrackBounds = ProjectTrack.getBoundingClientRect();
        const ProjectTrackCenter = ProjectTrackBounds.left + ProjectTrack.clientWidth / 2;
        let ClosestProjectDistance = Number.POSITIVE_INFINITY;
        let ClosestProjectIndex = ActiveProjectIndex;

        ProjectSlides.forEach((ProjectSlide, ProjectIndex) => {
            const ProjectSlideBounds = ProjectSlide.getBoundingClientRect();
            const ProjectSlideCenter = ProjectSlideBounds.left + ProjectSlideBounds.width / 2;
            const CenterDistance = Math.abs(ProjectSlideCenter - ProjectTrackCenter);

            if (CenterDistance < ClosestProjectDistance) {
                ClosestProjectDistance = CenterDistance;
                ClosestProjectIndex = ProjectIndex;
            }
        });

        SetActiveProjectCard(ClosestProjectIndex);
    };

    const QueueActiveProjectUpdate = () => {
        if (IsProjectUpdateQueued) return;

        IsProjectUpdateQueued = true;
        requestAnimationFrame(() => {
            UpdateActiveProjectCard();
            IsProjectUpdateQueued = false;
        });
    };

    const ScrollToProject = (ProjectIndex) => {
        const WrappedProjectIndex = (ProjectIndex + ProjectCards.length) % ProjectCards.length;
        const ProjectCardBounds = ProjectCards[WrappedProjectIndex].getBoundingClientRect();
        const ProjectTrackBounds = ProjectTrack.getBoundingClientRect();
        const TargetScrollLeft = ProjectTrack.scrollLeft
            + ProjectCardBounds.left
            - ProjectTrackBounds.left
            - (ProjectTrack.clientWidth - ProjectCardBounds.width) / 2;

        ProjectTrack.scrollTo({
            left: TargetScrollLeft,
            behavior: ReducedMotionPreference.matches ? 'auto' : 'smooth',
        });
    };

    const OpenProjectDialog = (ProjectCard) => {
        const ProjectDialog = document.getElementById(ProjectCard.getAttribute('aria-controls'));
        if (!ProjectDialog) return;

        if (typeof ProjectDialog.showModal === 'function') {
            try {
                ProjectDialog.showModal();
                return;
            } catch (DialogOpenError) {
                if (ProjectDialog.open) return;
            }
        }

        ProjectDialog.setAttribute('open', '');
    };

    const CloseProjectDialog = (ProjectDialog) => {
        if (typeof ProjectDialog.close === 'function' && ProjectDialog.open) {
            ProjectDialog.close();
            return;
        }

        ProjectDialog.removeAttribute('open');
    };

    ProjectTrack.addEventListener('scroll', QueueActiveProjectUpdate, { passive: true });
    ProjectTrack.addEventListener('scrollend', UpdateActiveProjectCard);
    addEventListener('resize', QueueActiveProjectUpdate);

    const ProjectCenterObserver = new IntersectionObserver((ObserverEntries) => {
        const CenteredProjectEntry = ObserverEntries.find((ObserverEntry) => ObserverEntry.isIntersecting);
        if (!CenteredProjectEntry) return;

        const ProjectIndex = ProjectSlides.indexOf(CenteredProjectEntry.target);
        SetActiveProjectCard(ProjectIndex);
    }, {
        root: ProjectTrack,
        rootMargin: ProjectCenterObserverRootMargin,
    });

    ProjectSlides.forEach((ProjectSlide) => ProjectCenterObserver.observe(ProjectSlide));

    ProjectCards.forEach((ProjectCard, ProjectIndex) => {
        ProjectCard.addEventListener('click', () => OpenProjectDialog(ProjectCard));

        const ProjectDialog = document.getElementById(ProjectCard.getAttribute('aria-controls'));
        if (!ProjectDialog) return;

        const DialogCloseButton = ProjectDialog.querySelector('[data-dialog-close]');
        DialogCloseButton?.addEventListener('click', () => CloseProjectDialog(ProjectDialog));
        ProjectDialog.addEventListener('click', (DialogClickEvent) => {
            if (DialogClickEvent.target === ProjectDialog) CloseProjectDialog(ProjectDialog);
        });

        ProjectCard.addEventListener('keydown', (ProjectKeyEvent) => {
            if (ProjectKeyEvent.key === 'ArrowLeft') {
                ProjectKeyEvent.preventDefault();
                ScrollToProject(ProjectIndex - 1);
            } else if (ProjectKeyEvent.key === 'ArrowRight') {
                ProjectKeyEvent.preventDefault();
                ScrollToProject(ProjectIndex + 1);
            }
        });
    });

    UpdateActiveProjectCard();
}
