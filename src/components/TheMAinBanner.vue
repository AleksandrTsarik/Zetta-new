<template>
  <div class="m-banner">
    <div class="m-banner__circle">
      <img ref="circle1" src="/img/circle/item3.png" alt="circle" />
      <img ref="circle2" src="/img/circle/item3.png" alt="circle" />
      <img ref="circle3" src="/img/circle/item3.png" alt="circle" />
    </div>
    <div class="m-banner__container">
      <div class="m-banner__inner">
        <div class="m-banner__info">
          <h1 class="title m-banner__title">
            Ваш&nbsp;надежный партнёр в&nbsp;
            <span class="color-primary">
              {{ typedText }}<span class="cursor">|</span>
            </span>
          </h1>
          <div class="m-banner__subtitle">
            Мы — дочерний проект Code7, обеспечивающий удобное и быстрое
            оформление страховых полисов.
          </div>
          <div class="m-banner__btns">
            <a href="" class="btn btn-primary">Оформить онлайн</a>
            <a href="" class="btn btn-light">Задать вопрос</a>
          </div>
        </div>
        <div class="m-banner__offer m-banner-offe">
          <div class="m-banner-offer__list">
            <div class="m-banner-offer__item">
              <div class="m-banner-offer__ico"></div>
              <div class="m-banner-offer__info">
                <div class="m-banner-offer__name"></div>
                <div class="m-banner-offer__text"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { gsap } from "gsap";
export default {
  data() {
    return {
      fullText: "страховании, бизнесе без рисков",
      typedText: "",
    };
  },
  mounted() {
    // Эффект печатной машинки для span
    const start = 1;
    this.typedText = this.fullText.slice(0, start);
    let i = start;
    const type = () => {
      if (i <= this.fullText.length) {
        this.typedText = this.fullText.slice(0, i);
        i++;
        setTimeout(type, 220);
      }
    };
    setTimeout(type, 400);

    // GSAP-анимация кругов
    const circles = [
      this.$refs.circle1,
      this.$refs.circle2,
      this.$refs.circle3,
    ];
    const container = this.$el.querySelector(".m-banner__circle");
    const containerRect = container.getBoundingClientRect();
    const w = containerRect.width;
    const h = containerRect.height;
    const sizes = [100, 80, 120];
    const centerX = (w - sizes[0]) / 2;
    const centerY = h * 0.1;
    const spreadX = w * 0.45;
    const spreadY = h * 0.18;
    circles.forEach((circle, i) => {
      gsap.set(circle, {
        x: centerX,
        y: centerY,
        scale: gsap.utils.random(0.4, 1.0),
      });
      const angle = gsap.utils.random(0, Math.PI * 2);
      const radiusX = gsap.utils.random(0, spreadX);
      const radiusY = gsap.utils.random(0, spreadY);
      const firstX = centerX + Math.cos(angle) * radiusX;
      const firstY = centerY + Math.sin(angle) * radiusY;
      gsap.to(circle, {
        x: firstX,
        y: firstY,
        scale: gsap.utils.random(0.4, 1.0),
        duration: gsap.utils.random(2, 4),
        ease: "power1.inOut",
        delay: i * 0.5,
        onComplete: animate,
      });
      function animate() {
        const angle = gsap.utils.random(0, Math.PI * 2);
        const radiusX = gsap.utils.random(0, spreadX);
        const radiusY = gsap.utils.random(0, spreadY);
        const toX = centerX + Math.cos(angle) * radiusX;
        const toY = centerY + Math.sin(angle) * radiusY;
        gsap.to(circle, {
          x: toX,
          y: toY,
          scale: gsap.utils.random(0.4, 1.0),
          duration: gsap.utils.random(1, 8),
          ease: "power1.inOut",
          onComplete: animate,
        });
      }
    });
  },
};
</script>

<style lang="scss" scoped>
.m-banner {
  position: relative;
  width: 100%;
  //min-height: 500px;

  overflow-x: hidden;
  background: rgb(var(--bg));
  position: relative;

  &__circle {
    width: 100%;
    height: 100%;
    position: absolute;
    z-index: 0;
    img {
      filter: blur(70px);
      opacity: 0.1;
      display: block;
      pointer-events: none;
      position: absolute;
      top: 0;
      left: 0;
    }
  }
  &__inner {
    padding: 140px 0;
    &:after {
      content: "";
      display: block;
      width: 100%;
      height: 500px;
      background-image: url(/img/circle/item1.png);
      background-position: 50% 50%;
      background-repeat: no-repeat;
      position: absolute;
      left: 0;
      top: 0;
      background-size: contain;
    }
  }
  &__title {
    text-align: center;
    max-width: 80%;
    margin: 0 auto;
    .color-primary {
      display: block;
    }
  }
  &__subtitle {
    text-align: center;
    max-width: 40%;
    margin: 0 auto;
    @media (max-width: 1023px) {
      max-width: 100%;
    }
  }
  &__btns {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    margin: 40px;
    position: relative;
    z-index: 1;
  }
}
.cursor {
  display: inline-block;
  animation: blink 1s steps(1) infinite;
}
@keyframes blink {
  0%,
  50% {
    opacity: 1;
  }
  51%,
  100% {
    opacity: 0;
  }
}
</style>
