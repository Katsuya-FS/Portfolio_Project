export function InitializeSmoothScroll() {
    const ReduceMotionPreference = matchMedia('(prefers-reduced-motion: reduce)').matches;
    const HasScrollAnimationLibraries = window.gsap && window.ScrollTrigger && window.Lenis;

    if (ReduceMotionPreference || !HasScrollAnimationLibraries) return;

    gsap.registerPlugin(ScrollTrigger);
    const SmoothScrollController = new Lenis();
    SmoothScrollController.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((FrameTime) => SmoothScrollController.raf(FrameTime * 1000));
    gsap.ticker.lagSmoothing(0);

    document.fonts?.ready.then(() => ScrollTrigger.refresh());
    addEventListener('load', () => ScrollTrigger.refresh(), { once: true });
}
