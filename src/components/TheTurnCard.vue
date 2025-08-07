<template>
  <div class="turn">
    <div class="turn__container">
      <div class="turn__head">
        <h2 class="turn__title title" v-if="title">{{ title }}</h2>
        <div class="turn__subtitle" v-if="subtitle">{{ subtitle }}</div>
      </div>
      <div class="turn__body" :class="'turn__body--' + bodyClass">
        <div class="turn-item" v-for="(item, i) in turnInfo" :key="i">
          <div class="turn-item__front turn-item-front">
            <div class="turn-item__img">
              <img :src="item.img" :alt="item.alt" />
            </div>
            <div class="turn-item__info">
              <div class="turn-item__title">{{ item.title }}</div>
              <div class="turn-item__text">
                <p>
                  {{ item.text }}

                  <svg
                    width="16"
                    height="16"
                    viewBox="0 0 16 16"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M14.18 6.73505L11.6321 4L10.8465 4.8433L13.2144 7.38572L1.33301 7.40361V8.59639L13.2477 8.5785L10.846 11.1567L11.6316 12L14.18 9.26495C14.4915 8.92889 14.6663 8.47409 14.6663 8C14.6663 7.52591 14.4915 7.07111 14.18 6.73505Z"
                      fill="white"
                    />
                  </svg>
                </p>
              </div>
            </div>
          </div>
          <div class="turn-item__back turn-item-back">
            <div class="turn-item-back__ico" v-html="item.ico"></div>
            <div class="turn-item-back__info">
              <div class="turn-item-back__title">{{ item.backTitle }}</div>
              <div class="turn-item-back__text">{{ item.backText }}</div>
            </div>
            <router-link :to="item.url" class="turn-item-back__more">
              <span>Оформить сейчас</span>
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    turnInfo: {
      type: Array,
      default: [],
    },
    title: {
      type: String,
      default: "",
    },
    subtitle: {
      type: String,
      default: "",
    },
    bodyClass: {
      type: String,
      default: "",
    },
  },
};
</script>

<style lang="scss" scoped>
.turn {
  &__head {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 64px;
    @media (max-width: 1023px) {
      grid-template-columns: 1fr;
      gap: 24px;
      margin-bottom: 32px;
      .title {
        margin-bottom: 0;
      }
    }
  }

  &__body {
    display: grid;
    //grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));

    gap: 30px;
  }
  &--third {
    grid-template-columns: repeat(3, 1fr);
    @media (max-width: 767px) {
      grid-template-columns: 1fr;
    }
  }
  &--fourth {
    grid-template-columns: repeat(4, 1fr);
    @media (max-width: 767px) {
      grid-template-columns: 1fr;
    }
  }
}

.turn-item {
  position: relative;
  perspective: 1000px;
  cursor: pointer;
  height: 460px; // Фиксированная высота для карточек
  &__front,
  &__back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    transition: transform 0.8s ease-in-out, opacity 1s ease-in-out;
    border-radius: 12px;
    overflow: hidden;
  }
  &__front {
    transform: rotateY(0deg);
    background: #fff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  }
  &__back {
    transform: rotateY(180deg);
    background: linear-gradient(
      135deg,
      rgb(var(--primary)),
      rgb(var(--primary-dark))
    );
    // color: white;
    // padding: 30px;
    // display: flex;
    // flex-direction: column;
    // justify-content: center;
    // align-items: center;
    // text-align: center;
  }

  &:hover {
    .turn-item__front {
      transform: rotateY(180deg);
      opacity: 0;
    }

    .turn-item__back {
      transform: rotateY(360deg);
      opacity: 1;
    }
  }

  &__img {
    width: 100%;
    height: 100%;
    overflow: hidden;
    position: absolute;
    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }
  &__info {
    color: rgb(var(--white));
    position: relative;
    z-index: 1;
    padding: 20px;
    display: flex;
    flex-direction: column;
    height: 100%;
  }
  &__title {
    flex-grow: 1;
    font-size: 28px;
    font-weight: 500;
  }
  &__text {
    margin-top: auto;
    display: inline-block;
    font-size: 14px;
    font-weight: 500;

    p {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      background-color: rgba(var(--white), 0.1);
      padding: 8px 16px;
      border-radius: 50px;
    }
    span {
      display: inline-block;
    }
  }
}
.turn-item-front {
}

.turn-item-back {
  background-color: rgb(var(--white));
  color: rgb(var(--text));
  padding: 32px 24px;
  display: flex;
  flex-direction: column;
  &__ico {
    ::v-deep svg path {
      fill: rgb(var(--primary));
    }
  }

  &__info {
    flex-grow: 1;
  }

  &__title {
    font-size: 28px;
    font-weight: 500;
    margin: 16px 0 24px;
  }

  &__text {
    font-size: 16px;
    font-weight: 400;
    color: rgba(var(--text), 0.6);
  }
  &__more {
    margin-top: auto;
    span {
      display: inline-block;
      color: rgb(var(--white));
      background-color: rgb(var(--primary));
      border-radius: 50px;
      font-size: 14px;
      font-weight: 500;
      padding: 8px 16px;
    }
  }
}
</style>
