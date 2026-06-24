<section class="hero">
  <a href="#intro-content" class="hero-link" aria-label="Learn more about Blake Morgan's services"></a>
  <div class="hero-inner">
    <div class="hero-video">
      <iframe
        src="https://player.vimeo.com/video/1200348375?background=1&autoplay=1&muted=1&loop=1&autopause=0"
        frameborder="0"
        allow="autoplay; fullscreen"
        allowfullscreen
        title="Blake Morgan Feature Video"
      ></iframe>
    </div>

    <div class="hero-mobile-content">
      <p class="hero-brand">Relevant Realistic Solutions</p>
      <a href="#intro-content" class="btn btn-green">Learn More</a>
    </div>

  </div>
</section>

<style>
.hero {
  --video-x-offset: 0px; /* adjust this */
  position: relative;
  height: 75vh;
  overflow: hidden;
  padding: 0 !important;
  background-color: #f1efe6;
}
.hero-link {
  position: absolute;
  inset: 0;
  z-index: 10;
  display: block;
}

.hero-video iframe {
  pointer-events: none;
}

.hero-inner {
  max-width: 2600px;
  margin: 0 auto;
  height: 100%;
  position: relative;
}

.hero-brand {
  font-size: clamp(3rem, 8vw, 6rem)!important;
  line-height: 1;
  font-weight: 700;
  margin: 0 0 1rem;
  font-family: var(--font-heading);
  color: var(--bm-purple);
}

.hero-video {
  position: absolute;
  inset: 0;
  overflow: hidden;
}

.hero-video iframe {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 100vw;
  height: 56.25vw; /* 16:9 */
  min-width: 177.78vh;
  min-height: 100%;
  transform: translate(calc(-50% + var(--video-x-offset)), -50%);
}
.hero { --video-x-offset: 0px; }
.hero-mobile-content {
  display: none;
}

/* Mobile */
@media (max-width: 767px) {

  .hero {
    height: auto;
    min-height: 420px;
    display: flex;
    align-items: center;
    background-color: #f1efe6;
    padding: 4rem 1.5rem !important;
    background-image: url('/wp-content/uploads/New-Expertise-Images/BM-Expertise-Background.png');
    background-size: cover;
    background-position: center;
    color: var(--bm-purple);
  }

  .hero-video {
    display: none;
  }

  .hero-link {
    display: none;
  }

  .hero-inner {
    width: 100%;
  }

  .hero-mobile-content {
    display: block;
    position: relative;
    z-index: 2;
    text-align: left;
    max-width: 500px;
    margin: 0 auto;
  }
}
</style>