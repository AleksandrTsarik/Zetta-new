<template>
  <div class="osgop-d">
    <div class="osgop-d__container">
      <div class="osgop-d__item">
        <h2 class="title osgop-d__title">Что такое ОСГОП такси?</h2>
      </div>
      <div class="osgop-d__item">
        <div class="osgop-d__info">
          <p>
            Договор ОСГОП такси защищает имущественные интересы перевозчика
            в случае причинения вреда жизни, здоровью или имуществу пассажиров.
          </p>
          <p>
            Размер выплаты зависит от характера травм и установлен
            Законодательством.
          </p>
        </div>
        <div class="osgop-d__attention">
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
          <p>
            Договор ОСГОП такси заключается, если есть разрешение на
            перевозчика. Наличие разрешения можно проверить на сайте
            <a href="#" target="_blank"> ФГИС «Такси»</a> в разделе
            «Перевозчики»
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
};
</script>

<style lang="scss" scoped>
.osgop-d {
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
}
</style>
