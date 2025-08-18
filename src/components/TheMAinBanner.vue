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
            <a href="/#turn" class="btn btn-primary">Оформить онлайн</a>
            <a href="mailto:info@codeseven.ru" class="btn btn-light"
              >Задать вопрос</a
            >
          </div>
        </div>
        <div class="m-banner__offer m-banner-offer">
          <div class="m-banner-offer__list">
            <div
              class="m-banner-offer__item"
              v-for="(item, i) in list"
              :key="i"
            >
              <div class="m-banner-offer__ico" v-html="item.ico"></div>
              <div class="m-banner-offer__info">
                <div class="m-banner-offer__name">{{ item.name }}</div>
                <div class="m-banner-offer__text">{{ item.text }}</div>
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
      list: [
        {
          ico: '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_3010_901)"><path d="M10 24H0V22H10V24ZM8 18H0V20H8V18ZM6 14H0V16H6V14ZM12 0C8.81846 0.00344108 5.76821 1.26883 3.51852 3.51852C1.26883 5.76821 0.00344108 8.81846 0 12H2C2 10.0222 2.58649 8.08879 3.6853 6.4443C4.78412 4.79981 6.3459 3.51808 8.17317 2.7612C10.0004 2.00433 12.0111 1.8063 13.9509 2.19215C15.8907 2.578 17.6725 3.53041 19.0711 4.92893C20.4696 6.32746 21.422 8.10929 21.8079 10.0491C22.1937 11.9889 21.9957 13.9996 21.2388 15.8268C20.4819 17.6541 19.2002 19.2159 17.5557 20.3147C15.9112 21.4135 13.9778 22 12 22V24C15.1826 24 18.2348 22.7357 20.4853 20.4853C22.7357 18.2348 24 15.1826 24 12C24 8.8174 22.7357 5.76515 20.4853 3.51472C18.2348 1.26428 15.1826 0 12 0ZM11 7V12.414L14.293 15.707L15.707 14.293L13 11.586V7H11Z" fill="currentColor"/></g><defs><clipPath id="clip0_3010_901"><rect width="24" height="24" fill="currentColor"/></clipPath></defs></svg>',
          name: "Быстро",
          text: "минимальные требования к документам",
        },
        {
          ico: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.948 24L11.594 23.843C11.2 23.67 2 19.515 2 11.991V5.467C2.00035 4.83917 2.19878 4.22746 2.56704 3.71897C2.9353 3.21049 3.4546 2.83116 4.051 2.635L12 0L19.949 2.635C20.5454 2.83116 21.0647 3.21049 21.433 3.71897C21.8012 4.22746 21.9997 4.83917 22 5.467V11.991C22 20.568 12.712 23.746 12.316 23.878L11.948 24ZM12 2.097L4.684 4.523C4.48495 4.58802 4.31157 4.71436 4.1887 4.88393C4.06584 5.05349 3.99978 5.2576 4 5.467V11.991C4 17.485 10.44 21.049 12.047 21.852C13.651 21.207 20 18.254 20 11.991V5.467C20.0002 5.2576 19.9342 5.05349 19.8113 4.88393C19.6884 4.71436 19.5151 4.58802 19.316 4.523L12 2.097Z" fill="#7D51FE"/><path d="M11.1392 14.1818H11.1071C10.8609 14.1783 10.618 14.1283 10.3931 14.0348C10.1682 13.9414 9.96604 13.8064 9.79875 13.6381L7.55556 11.4632L8.95731 10.2109L11.1402 12.3313L16.1801 7.63636L17.5556 8.91772L12.4379 13.6852C12.2674 13.8439 12.0648 13.9694 11.8419 14.0547C11.619 14.1399 11.3802 14.1831 11.1392 14.1818Z" fill="#7D51FE"/></svg>',
          name: "Надежно",
          text: "работаем с проверенной страховой",
        },
        {
          ico: '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_3010_890)"><path d="M7 8.667L2 13.418V24H0V12.5L7 6V8.667ZM24 0V19C24 20.654 22.654 22 21 22H12C11.473 22 10.954 21.861 10.5 21.598L10 22.311V23.999H8V21.687L12.667 14.931C13.136 14.372 13.077 13.649 12.598 13.242C12.168 12.878 11.527 12.884 11.1 13.258L6.67 17.251L5.33 15.766L9.768 11.766C10.938 10.731 12.709 10.713 13.893 11.718C14.591 12.312 14.955 13.148 14.986 14H22V2H11V9.062C10.295 9.181 9.616 9.452 9 9.862V0H24ZM22 16H14.354C14.318 16.048 11.645 19.927 11.645 19.927C11.759 19.97 11.877 20 12 20H21C21.552 20 22 19.551 22 19V16ZM18 19V17H15V19H18Z" fill="currentColor"/></g><defs><clipPath id="clip0_3010_890"><rect width="24" height="24" fill="currentColor"/></clipPath></defs></svg>',
          name: "Удобно",
          text: "оформление полисов полностью онлайн",
        },
        {
          ico: '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_3010_921)"><path d="M24 16V24H16C13.045 24 10.465 22.385 9.08 19.996C9.849 19.99 10.598 19.905 11.322 19.748C12.423 21.119 14.109 22 16 22H22V16C22 14.109 21.119 12.423 19.748 11.322C19.904 10.598 19.99 9.849 19.996 9.08C22.385 10.465 24 13.045 24 16ZM18 9C18 4.037 13.963 0 9 0C4.037 0 0 4.037 0 9V18H9C13.963 18 18 13.963 18 9ZM2 9C2 5.141 5.14 2 9 2C12.86 2 16 5.141 16 9C16 12.859 12.86 16 9 16H2V9ZM10 10.505C10 10.193 10.26 9.732 10.447 9.629C11.571 9.008 12.176 7.737 11.953 6.465C11.74 5.253 10.745 4.259 9.536 4.048C8.65 3.887 7.753 4.129 7.073 4.701C6.391 5.273 6.001 6.111 6.001 7H8.001C8.001 6.703 8.131 6.424 8.359 6.233C8.589 6.04 8.885 5.962 9.191 6.017C9.582 6.085 9.916 6.418 9.984 6.81C10.077 7.341 9.772 7.717 9.482 7.876C8.637 8.341 8.001 9.471 8.001 10.504V10.999H10.001V10.504L10 10.505ZM10 12H8V14H10V12Z" fill="currentColor"/></g><defs><clipPath id="clip0_3010_921"><rect width="24" height="24" fill="currentColor"/></clipPath></defs></svg>',
          name: "С поддержкой",
          text: "готовы помочь по любым вопросам 24/7",
        },
      ],
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

<style lang="scss">
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
.m-banner-offer {
  &__list {
    margin-top: 40px;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    @media (max-width: 1023px) {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  &__item {
    padding: 0 15px;
  }
  &__ico {
    fill: red;
    text-align: center;
    svg {
    }
    svg path {
      fill: rgba(var(--primary), 1);
    }
  }
  &__name {
    font-weight: 500;
    text-align: center;
    font-size: 20px;
    margin-bottom: 10px;
  }
  &__text {
    text-align: center;
    font-size: 16px;
    font-weight: 400;
    color: rgba(var(--text), 0.6);
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
