import { ThemeCookieLifetimeSeconds, ThemeTransitionDurationMilliseconds } from './constants.js?v=2';

export function InitializeTheme() {
    const RootElement = document.documentElement;
    const ThemeToggleButton = document.querySelector('.theme-toggle');
    const ThemeLabel = document.querySelector('.theme-label');

    const SetTheme = (ThemeName) => {
        RootElement.dataset.theme = ThemeName;
        const IsLightTheme = ThemeName === 'light';

        ThemeToggleButton?.setAttribute('aria-pressed', String(IsLightTheme));
        ThemeToggleButton?.setAttribute(
            'aria-label',
            `Switch to ${IsLightTheme ? 'dark' : 'light'} theme`,
        );

        if (ThemeLabel) ThemeLabel.textContent = IsLightTheme ? 'Dark Mode' : 'Light Mode';

        document.cookie = `theme=${ThemeName}; Max-Age=${ThemeCookieLifetimeSeconds}; Path=/; SameSite=Lax${location.protocol === 'https:' ? '; Secure' : ''}`;
    };

    const PreferredTheme = matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
    SetTheme(RootElement.dataset.theme || PreferredTheme);

    ThemeToggleButton?.addEventListener('click', () => {
        const NextTheme = RootElement.dataset.theme === 'dark' ? 'light' : 'dark';
        const ReduceMotionPreference = matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (ReduceMotionPreference) {
            SetTheme(NextTheme);
            return;
        }

        RootElement.classList.add('theme-morph');
        void RootElement.offsetWidth;
        SetTheme(NextTheme);
        window.setTimeout(() => RootElement.classList.remove('theme-morph'), ThemeTransitionDurationMilliseconds);
    });
}
