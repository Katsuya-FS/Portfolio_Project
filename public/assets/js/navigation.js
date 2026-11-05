import { NavigationObserverRootMargin } from './constants.js?v=2';

export function InitializeNavigation() {
    const NavigationLinks = [...document.querySelectorAll('.nav-links a')];
    const MenuToggleButton = document.querySelector('.menu-toggle');
    const PrimaryNavigation = document.querySelector('#primary-nav');
    const PageSections = ['home', 'stack', 'education', 'projects', 'contact']
        .map((SectionId) => document.getElementById(SectionId))
        .filter(Boolean);

    MenuToggleButton?.addEventListener('click', () => {
        const IsMenuOpen = MenuToggleButton.getAttribute('aria-expanded') !== 'true';
        MenuToggleButton.setAttribute('aria-expanded', String(IsMenuOpen));
        MenuToggleButton.setAttribute('aria-label', IsMenuOpen ? 'Close navigation' : 'Open navigation');
        PrimaryNavigation?.classList.toggle('is-open', IsMenuOpen);
    });

    NavigationLinks.forEach((NavigationLink) => {
        NavigationLink.addEventListener('click', () => {
            MenuToggleButton?.setAttribute('aria-expanded', 'false');
            PrimaryNavigation?.classList.remove('is-open');
        });
    });

    const NavigationObserver = new IntersectionObserver((ObserverEntries) => {
        ObserverEntries.forEach((ObserverEntry) => {
            if (!ObserverEntry.isIntersecting) return;

            NavigationLinks.forEach((NavigationLink) => {
                NavigationLink.classList.toggle('active', NavigationLink.hash === `#${ObserverEntry.target.id}`);
            });
        });
    }, { rootMargin: NavigationObserverRootMargin });

    PageSections.forEach((PageSection) => NavigationObserver.observe(PageSection));
}
