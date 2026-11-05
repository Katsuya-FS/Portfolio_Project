import { InitializeTheme } from './theme.js?v=2';
import { InitializeNavigation } from './navigation.js?v=2';
import { InitializeRevealAnimations } from './reveal.js?v=2';
import { InitializeScrollProgress } from './scroll-progress.js?v=2';
import { InitializeSmoothScroll } from './smooth-scroll.js?v=2';
import { InitializeParticles } from './particles.js?v=2';
import { InitializeProjects } from './projects.js?v=7';

document.documentElement.classList.add('js-ready');
InitializeTheme();
InitializeNavigation();
InitializeRevealAnimations();
InitializeScrollProgress();
InitializeSmoothScroll();
InitializeParticles();
InitializeProjects();
