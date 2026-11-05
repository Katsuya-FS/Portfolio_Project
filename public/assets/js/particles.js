import {
    DarkParticleColors,
    LightParticleColors,
    MinimumParticleCount,
    ParticleCountPerSection,
    ParticleHorizontalSpeedVariation,
    ParticleLightThemeHorizontalDrift,
    ParticleLightThemeRadiusScale,
    ParticleOpacityMinimum,
    ParticleOpacityVariation,
    ParticleRadiusMinimum,
    ParticleRadiusVariation,
    ParticleSectionSpeedFactor,
    ParticleVerticalSpeedMinimum,
    ParticleVerticalSpeedVariation,
    ParticleWrapOffset,
} from './constants.js?v=2';

export function InitializeParticles() {
    const ParticleCanvas = document.querySelector('.ambient-canvas');
    const ReduceMotionPreference = matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!ParticleCanvas || ReduceMotionPreference) return;

    const CanvasContext = ParticleCanvas.getContext('2d');
    if (!CanvasContext) return;

    const Particles = [];
    let CanvasWidth = 0;
    let CanvasHeight = 0;
    let AnimationFrameId = 0;

    const ResizeCanvas = () => {
        const CanvasBounds = ParticleCanvas.getBoundingClientRect();
        CanvasWidth = ParticleCanvas.width = CanvasBounds.width * devicePixelRatio;
        CanvasHeight = ParticleCanvas.height = CanvasBounds.height * devicePixelRatio;
        CanvasContext.scale(devicePixelRatio, devicePixelRatio);
    };

    const CreateParticle = () => ({
        PositionX: Math.random() * CanvasWidth / devicePixelRatio,
        PositionY: Math.random() * CanvasHeight / devicePixelRatio,
        Radius: Math.random() * ParticleRadiusVariation + ParticleRadiusMinimum,
        VerticalVelocity: Math.random() * ParticleVerticalSpeedVariation + ParticleVerticalSpeedMinimum,
        HorizontalVelocity: (Math.random() - 0.5) * ParticleHorizontalSpeedVariation,
        Opacity: Math.random() * ParticleOpacityVariation + ParticleOpacityMinimum,
    });

    const UpdateParticle = (Particle, SectionIndex, IsLightTheme) => {
        Particle.PositionY -= Particle.VerticalVelocity + SectionIndex * ParticleSectionSpeedFactor;
        Particle.PositionX += Particle.HorizontalVelocity + (IsLightTheme ? ParticleLightThemeHorizontalDrift : 0);

        if (Particle.PositionY < -ParticleWrapOffset) {
            Object.assign(Particle, CreateParticle(), {
                PositionY: CanvasHeight / devicePixelRatio + ParticleWrapOffset,
            });
        }
    };

    const DrawParticle = (Particle, SectionIndex, IsLightTheme) => {
        const Palette = IsLightTheme ? LightParticleColors : DarkParticleColors;
        const ColorIndex = IsLightTheme ? Number(SectionIndex > 2) : Number(SectionIndex > 1);

        CanvasContext.globalAlpha = Particle.Opacity;
        CanvasContext.fillStyle = Palette[ColorIndex];
        CanvasContext.beginPath();
        CanvasContext.arc(
            Particle.PositionX,
            Particle.PositionY,
            IsLightTheme ? Particle.Radius * ParticleLightThemeRadiusScale : Particle.Radius,
            0,
            Math.PI * 2,
        );
        CanvasContext.fill();
    };

    const DrawParticles = () => {
        CanvasContext.clearRect(0, 0, CanvasWidth, CanvasHeight);

        const AmbientSections = [...document.querySelectorAll('[data-ambient]')];
        const ActiveAmbientSection = AmbientSections.find((AmbientSection) => {
            const SectionBounds = AmbientSection.getBoundingClientRect();
            return SectionBounds.top < innerHeight * 0.65 && SectionBounds.bottom > innerHeight * 0.35;
        });
        const ActiveSectionIndex = Math.max(0, AmbientSections.indexOf(ActiveAmbientSection));
        const ParticleLimit = MinimumParticleCount + ActiveSectionIndex * ParticleCountPerSection;
        const IsLightTheme = document.documentElement.dataset.theme === 'light';

        if (Particles.length < ParticleLimit) Particles.push(CreateParticle());

        Particles.forEach((Particle) => {
            UpdateParticle(Particle, ActiveSectionIndex, IsLightTheme);
            DrawParticle(Particle, ActiveSectionIndex, IsLightTheme);
        });

        CanvasContext.globalAlpha = 1;
        AnimationFrameId = requestAnimationFrame(DrawParticles);
    };

    ResizeCanvas();
    addEventListener('resize', ResizeCanvas);
    DrawParticles();

    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            cancelAnimationFrame(AnimationFrameId);
            return;
        }

        DrawParticles();
    });
}
