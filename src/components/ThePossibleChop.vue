<template>
  <div class="possible">
    <div class="possible__container">
      <div class="possible__inner">
        <div class="possible__header">
          <h2 class="possible__title title">
            Возможные виды охранной деятельности
          </h2>
          <div class="possible__subtitle">
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

            <p>
              Страхование осуществляется в соответствии с действующим
              законодательством РФ и правилами страхования ответственности лиц,
              осуществляющих частную охранную и/или детективную деятельность.
            </p>
          </div>
        </div>
        <div class="possible__body possible-cards">
          <div class="possible-card" v-for="(item, i) in crads" :key="i">
            <div class="possible-card__front">
              <div class="possible-card__top">
                <div
                  class="possible-card__title"
                  v-html="item.titleFront"
                ></div>
              </div>
              <div class="possible-card__bottom possible-card__front-bottom">
                <div class="possible-card__front-numb">
                  {{ ("0" + (i + 1)).slice(-2) }}
                </div>
                <div class="possible-card__front-more">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M21.2704 10.1026L17.4487 6L16.2703 7.26495L19.8221 11.0786L2 11.1054V12.8946L19.8721 12.8677L16.2695 16.7351L17.4478 18L21.2704 13.8974C21.7377 13.3933 22 12.7111 22 12C22 11.2889 21.7377 10.6067 21.2704 10.1026Z"
                      fill="#7D51FE"
                    />
                  </svg>
                </div>
              </div>
            </div>
            <div class="possible-card__back">
              <div class="possible-card__top">
                <div class="possible-card__title">{{ item.titleBack }}</div>
              </div>
              <div class="possible-card__bottom">
                <div class="possible-card__text">{{ item.textBack }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      crads: [
        {
          titleFront: "<p>Охрана  <span class='color-primary'>жизни</span></p>",
          titleBack: "Охрана жизни",
          textBack:
            "Защита жизни и здоровья граждан в рамках охранной деятельности, предусмотренной лицензией.",
        },
        {
          titleFront:
            "<p> Охрана <span class='color-primary'>имущества</span></p>",
          titleBack: "Охрана имущества",
          textBack:
            "Физическая охрана объектов и/или имущества, включая сопровождение и транспортировку.",
        },
        {
          titleFront:
            "<p><span class='color-primary'>Техническая</span> охрана</p>",
          titleBack: "Техническая охрана",
          textBack:
            "Контроль объектов с использованием сигнализации, камер и других охранных систем.",
        },
        {
          titleFront:
            "<p>Массовые  <span class='color-primary'>мероприятия</span></p>",
          titleBack: "Массовые мероприятия",
          textBack:
            "Обеспечение порядка и безопасности на концертах, фестивалях и других публичных событиях.",
        },
        {
          titleFront:
            "<p> <span class='color-primary'>Режим </span> на объектах</p>",
          titleBack: "Режим на объектах",
          textBack:
            "Организация пропускного и внутриобъектового режима для предотвращения несанкционированного доступа.",
        },
        {
          titleFront: "<p> <span class='color-primary'>Иные</span> услуги</p>",
          titleBack: "Иные услуги",
          textBack:
            "Другие виды охранной деятельности, соответствующие лицензии и законодательству РФ.",
        },
      ],
    };
  },
};
</script>

<style lang="scss" scoped>
.possible {
  &__header {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    @media (max-width: 1023px) {
      grid-template-columns: 1fr;
      gap: 24px;
    }
  }
  &__subtitle {
    background-color: rgba(var(--secondary), 0.1);
    display: flex;
    gap: 10px;
    padding: 12px;
    font-size: 16px;
    svg {
      flex: 0 0 24px;
    }
  }
}
.possible-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 24px;
  margin-top: 32px;
  @media (max-width: 767px) {
    margin-top: 24px;
  }
}

.possible-card {
  position: relative;
  width: 100%;
  height: 200px;
  perspective: 1200px;
  cursor: pointer;
  will-change: transform;
  position: relative;
  &__front,
  &__back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: 12px;
    overflow: hidden;
    transition: transform 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 20px;
    box-sizing: border-box;
    transform-style: preserve-3d;
  }
  &__front {
    background: rgb(var(--white));
    color: #111;
    z-index: 2;
    &::after {
      content: "";
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%) rotateY(180deg);
      width: 100%;
      height: 100%;
      z-index: -1;
      background-image: url("img/circle/item1.webp");
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
  }

  &__back {
    background: rgb(var(--white));
    color: rgb(var(--text));
    transform: rotateY(180deg);
  }

  &:hover &__front {
    transform: rotateY(-180deg);
  }
  &:hover &__back {
    transform: rotateY(0deg);
  }

  &__front-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  &__front-numb {
    font-size: 48px;
    color: rgba(var(--text), 0.2);
    font-weight: 700;
  }
  &__front-more {
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 50px;
    height: 50px;
    width: 50px;
    border-radius: 50%;
    background-color: rgba(var(--primary), 0.1);
  }
  &__title {
    font-size: 28px;
    font-weight: 500;
  }
  &__text {
    font-size: 16px;
    line-height: 1.5;
    color: rgba(var(--text), 0.6);
  }
}
</style>
