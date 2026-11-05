export function InitializeScrollProgress() {
    const ScrollProgressIndicator = document.querySelector('#scroll-progress');
    let IsScrollUpdateQueued = false;

    const UpdateScrollProgress = () => {
        const MaximumScrollDistance = document.documentElement.scrollHeight - innerHeight;
        const ScrollProgress = MaximumScrollDistance > 0 ? (scrollY / MaximumScrollDistance) * 100 : 0;

        if (ScrollProgressIndicator) ScrollProgressIndicator.style.width = `${ScrollProgress}%`;
        IsScrollUpdateQueued = false;
    };

    addEventListener('scroll', () => {
        if (IsScrollUpdateQueued) return;

        IsScrollUpdateQueued = true;
        requestAnimationFrame(UpdateScrollProgress);
    }, { passive: true });

    UpdateScrollProgress();
}
