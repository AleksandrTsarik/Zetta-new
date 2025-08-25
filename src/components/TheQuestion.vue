<template>
  <div class="qestion-b">
    <div class="qestion-b__container">
      <div class="qestion-b__item">
        <h2 class="title qestion-b__title">{{ descriptionQuestion.title }}</h2>
      </div>
      <div class="qestion-b__item">
        <div
          class="qestion-b__info contant-inner"
          v-html="descriptionQuestion.text"
        ></div>
        <div class="qestion-b__attention" v-if="descriptionQuestion.atention">
          <span>
            <svg
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
          <p v-html="descriptionQuestion.atention"></p>
        </div>
        <div class="qestion-b__warning" v-if="descriptionQuestion.warning">
          <svg
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M12 22C10.0222 22 8.08879 21.4135 6.4443 20.3147C4.79981 19.2159 3.51809 17.6541 2.76121 15.8268C2.00433 13.9996 1.8063 11.9889 2.19215 10.0491C2.578 8.10929 3.53041 6.32746 4.92894 4.92894C6.32746 3.53041 8.10929 2.578 10.0491 2.19215C11.9889 1.8063 13.9996 2.00433 15.8268 2.76121C17.6541 3.51809 19.2159 4.79981 20.3147 6.4443C21.4135 8.08879 22 10.0222 22 12C21.9971 14.6513 20.9426 17.1932 19.0679 19.0679C17.1932 20.9426 14.6513 21.9971 12 22ZM12 3.66667C10.3518 3.66667 8.74066 4.15541 7.37025 5.07109C5.99984 5.98677 4.93174 7.28826 4.30101 8.81097C3.67028 10.3337 3.50525 12.0092 3.82679 13.6258C4.14834 15.2423 4.94201 16.7271 6.10745 17.8926C7.27288 19.058 8.75774 19.8517 10.3743 20.1732C11.9908 20.4948 13.6663 20.3297 15.189 19.699C16.7117 19.0683 18.0132 18.0002 18.9289 16.6298C19.8446 15.2593 20.3333 13.6482 20.3333 12C20.3309 9.79061 19.4522 7.6724 17.8899 6.11013C16.3276 4.54785 14.2094 3.6691 12 3.66667Z"
              fill="#7D51FE"
            />
            <path
              d="M13.6667 17.8333H12V12H10.3333V10.3333H12C12.442 10.3333 12.8659 10.5089 13.1785 10.8215C13.4911 11.134 13.6667 11.558 13.6667 12V17.8333Z"
              fill="#7D51FE"
            />
            <path
              d="M12 8.66667C12.6904 8.66667 13.25 8.10702 13.25 7.41667C13.25 6.72631 12.6904 6.16667 12 6.16667C11.3096 6.16667 10.75 6.72631 10.75 7.41667C10.75 8.10702 11.3096 8.66667 12 8.66667Z"
              fill="#7D51FE"
            />
          </svg>
          <p v-html="descriptionQuestion.warning"></p>
        </div>
        <a
          :href="descriptionQuestion.anhor"
          class="qestion-b__ankhor btn btn-primary"
          v-if="descriptionQuestion.anhor"
          >Оформить полис</a
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    descriptionQuestion: {
      type: Object,
      default: {},
    },
  },
  data() {
    return {};
  },
};
</script>

<style lang="scss" scoped>
.qestion-b {
  &__item {
  }
  &__title {
  }
  &__container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    @media (max-width: 767px) {
      grid-template-columns: 1fr;
      gap: 20px;
    }
  }
  &__info {
    p {
      font-size: 20px;
      font-weight: 500;
      margin-bottom: 24px;
    }
  }
  &__attention {
    background-color: rgba(var(--secondary), 0.1);
    padding: 12px;
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 10px;
    p {
      font-size: 16px;
      font-weight: 400;
      line-height: 120%;
    }
    a {
      color: rgb(var(--primary));
    }
  }
  &__warning {
    background-color: rgba(var(--primary), 0.1);
    border-radius: 4px;
    padding: 12px;
    display: grid;
    grid-template-columns: 24px 1fr;
    gap: 10px;
    margin: 24px 0 40px;
  }
  &__ankhor {
  }
}
</style>
