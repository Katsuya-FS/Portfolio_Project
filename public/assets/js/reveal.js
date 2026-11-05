import { RevealObserverThreshold } from './constants.js?v=2';

export function InitializeRevealAnimations() {
    const RevealObserver = new IntersectionObserver((ObserverEntries) => {
        ObserverEntries.forEach((ObserverEntry) => {
            if (!ObserverEntry.isIntersecting) return;

            ObserverEntry.target.classList.add('is-visible');
            RevealObserver.unobserve(ObserverEntry.target);
        });
    }, { threshold: RevealObserverThreshold });

    document.querySelectorAll('.reveal').forEach((RevealElement) => RevealObserver.observe(RevealElement));
}
