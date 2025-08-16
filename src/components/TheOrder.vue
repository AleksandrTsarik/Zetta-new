<template>
  <div class="order">
    <div class="order__container">
      <h2 class="title order__title">{{ title }}</h2>
      <div class="order__list">
        <div class="order__img">
          <img src="/img/order.webp" alt="order-picture" />
        </div>

        <div class="order__info order-info">
          <div>
            <div
              class="order-info__item"
              v-for="(order, i) in orderInfo"
              :key="i"
            >
              <div class="order-info__name">{{ order.name }}</div>
              <div class="order-info__text" v-html="order.text"></div>
              <div class="order-info__attention" v-if="order.attention">
                <span
                  ><svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M22.6755 17.4714L14.0539 3.1581C13.6229 2.43429 12.8616 2 11.9994 2C11.1373 2 10.376 2.43429 9.95409 3.1581L1.32331 17.4714C0.89223 18.2133 0.89223 19.091 1.32331 19.8238C1.75439 20.5567 2.52483 21 3.37782 21H20.6302C21.4924 21 22.2628 20.5567 22.6847 19.8238C23.1066 19.091 23.1066 18.2133 22.6755 17.4714ZM21.098 18.919C21.0521 19.0005 20.9145 19.1814 20.6302 19.1814H3.36865C3.08432 19.1814 2.94674 18.9914 2.90088 18.919C2.85502 18.8467 2.7633 18.6295 2.90088 18.3852L11.5317 4.0719C11.6692 3.83667 11.9077 3.80952 11.9994 3.80952C12.0911 3.80952 12.3204 3.83667 12.4672 4.08095L21.0888 18.3943C21.2355 18.6295 21.1347 18.8467 21.0888 18.9281L21.098 18.919ZM11.0822 8.33333H12.9166V13.7619H11.0822V8.33333ZM11.0822 15.5714H12.9166V17.381H11.0822V15.5714Z"
                      fill="#FFBB00"
                    />
                  </svg>
                </span>
                <p>{{ order.attention }}</p>
              </div>
            </div>
          </div>
          <div class="order-info__more" v-if="orderLink">
            <router-link class="btn btn-primary" :to="orderLink"
              >Оформить полис</router-link
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    orderInfo: {
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
    orderLink: {
      type: String,
      default: "",
    },
  },
  data() {
    return {};
  },
};
</script>

<style lang="scss" scoped>
.order {
  &__list {
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    gap: 24px;
    @media (max-width: 1023px) {
      grid-template-columns: 1fr;
    }
  }
  &__title {
    margin-bottom: -40px;
    @media (max-width: 1023px) {
      margin-bottom: 0.5em;
    }
  }
  &__img {
    @media (max-width: 1023px) {
      display: none;
    }
  }
}
.order-info {
  counter-reset: num;
  position: relative;

  &__item {
    counter-increment: num;
    position: relative;
    padding-left: 70px;
    z-index: 2;
    padding-bottom: 20px;
    &:before {
      content: counter(num);
      display: flex;
      align-items: center;
      justify-content: center;
      flex: 0 0 55px;
      height: 55px;
      width: 55px;
      border-radius: 50%;
      background-color: rgba(var(--primary), 0.2);
      color: rgb(var(--primary));
      font-size: 28px;
      font-weight: 500;
      position: absolute;
      left: 0;
      top: 0px;
      z-index: 5;
      @media (max-width: 767px) {
        width: 45px;
        height: 45px;
        flex: 0 0 45px;
        font-size: 20px;
      }
    }

    &:last-child {
      &:before {
        background-color: rgb(var(--primary));
        color: rgb(var(--white));
      }
      .order-info__name {
        &:after {
          display: none;
        }
      }
    }
  }
  &__name {
    font-size: 28px;
    font-weight: 500;
    padding-bottom: 16px;
    @media (max-width: 767px) {
      font-size: 20px;
    }
    &:after {
      content: "";
      position: absolute;
      left: 27.5px;
      top: 58px;
      width: 1px;
      height: calc(100% - 60px);
      border-right: dashed 2px rgb(var(--primary));
      z-index: 1;
      @media (max-width: 767px) {
        left: 21.5px;
        top: 48px;
        height: calc(100% - 50px);
      }
    }
  }
  &__text {
    font-size: 16px;
    font-weight: 400;
  }
  &__attention {
    background-color: rgba(var(--secondary), 0.1);
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 10px;
    padding: 10px;
    margin-top: 10px;
  }
}
</style>
