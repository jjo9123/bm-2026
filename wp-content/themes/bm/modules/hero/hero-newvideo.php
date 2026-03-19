<section class="hero">
  <div class="hero-inner">
      <div class="hero-video">
        <iframe
          src="https://player.vimeo.com/video/1170631839?background=1&autoplay=1&muted=1&loop=1&autopause=0"
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
  position: relative;
  height: 75vh;
  overflow: hidden;
  padding:0!important;
  background-color: #f1efe6;
}

.hero-inner {
  max-width: 2600px; /* adjust to your design */
  margin: 0 auto;
  height: 100%;
  position: relative;
}

.hero-video {
  position: absolute;
  top: 0;
  left: 50%;
  width: 100%;
  height: 100%;
  transform: translateX(-50%);
  overflow: hidden;
}

.hero-video iframe {
  position: absolute;
  top: 50%;
  left: 50%;

  width: 100vw;
  height: 56.25vw; /* 16:9 */

  min-height: 100%;
  min-width: 177.78vh;

  transform: translate(-50%, -50%);
}
</style>