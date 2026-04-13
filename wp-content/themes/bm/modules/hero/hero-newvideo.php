<section class="hero">
  <div class="hero-inner">
    <div class="hero-video">
      <iframe
        src="https://player.vimeo.com/video/1181298865?background=1&autoplay=1&muted=1&loop=1&autopause=0"
        frameborder="0"
        allow="autoplay; fullscreen"
        allowfullscreen
        title="Hero Video"
      ></iframe>
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

.hero-inner {
  max-width: 2600px;
  margin: 0 auto;
  height: 100%;
  position: relative;
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
.hero { --video-x-offset: 0; }
</style>