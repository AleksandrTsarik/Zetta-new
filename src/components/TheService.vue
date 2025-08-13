<template>
  <div class="service">
    <div class="service__container">
      <div class="service__list">
        <div class="service__item">
          <div class="service-block">
            <span class="span-primary">О сервисе</span>
            <div class="service-block__info service-block-info">
              <div class="service-block-info__inner">
                <div class="service-block-info__overlay"></div>
                <div class="service-block-info__head">
                  <div class="service-block-info__photo">
                    <img src="/img/user.webp" alt="photo" />
                  </div>
                  <div class="service-block-info__name">
                    <p>Константин</p>
                    <p>CEO Code7</p>
                  </div>
                </div>
                <div class="service-block-info__body">
                  “Мы объединили наши компетенции в IT и знания рынка
                  страхования, чтобы предложить простой, прозрачный и надёжный
                  сервис”.
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="service__item">
          <div class="service-info">
            <div class="service-info__item">
              <div class="service-info__text">
                Code7 Страхование — это часть IT-компании Code7, оказывающей
                комплексные решения для бизнеса.
              </div>
              <router-link to="/" class="service-info__more btn btn-primary"
                >Сайт Code7
                <svg
                  width="20"
                  height="12"
                  viewBox="0 0 20 12"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M19.2704 4.10258L15.4487 0L14.2703 1.26495L17.8221 5.07857L0 5.10541V6.89459L17.8721 6.86775L14.2695 10.7351L15.4478 12L19.2704 7.89742C19.7377 7.39333 20 6.71113 20 6C20 5.28887 19.7377 4.60667 19.2704 4.10258Z"
                    fill="#EEEEEE"
                  />
                </svg>
              </router-link>
            </div>
            <div class="service-info__item">
              <div class="service-info-small">
                <div class="service-info-small__item">
                  <div class="service-info-small__name">17 лет опыта</div>
                  <div class="service-info-small__text">
                    специалистов в IT-сфере
                  </div>
                </div>
                <div class="service-info-small__item">
                  <div class="service-info-small__name">250+ проектов</div>
                  <div class="service-info-small__text">
                    в самых разных нишах
                  </div>
                </div>
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
    return {};
  },
};
</script>

<style lang="scss" scoped>
.service {
  &__list {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    @media (max-width: 767px) {
      grid-template-columns: 1fr;
    }
  }
  &__item {
    height: 100%;
    @media (max-width: 767px) {
      a {
        width: 100%;
        text-align: center;
      }
    }
  }
}
.service-block {
  background-color: rgb(var(--white));
  border-radius: var(--radius);
  //padding: 24px;
  position: relative;
  overflow: hidden;
  height: 100%;
  &::after {
    content: "";
    background-image: url("/img/service.webp");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
    @media (max-width: 1200px) {
    }
  }
  .span-primary {
    position: absolute;
    top: 24px;
    left: 24px;
  }
}
.service-block-info {
  position: relative;
  z-index: 2;
  padding: 60% 24px 24px;
  position: relative;
  //   @media (max-width: 1200px) {
  //     padding: 30% 24px 24px;
  //   }
  &__inner {
    position: relative;
    border-radius: var(--radius);
    overflow: hidden;
    padding: 20px;
  }
  &__overlay {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    opacity: 1;
    background: rgba(238, 238, 238, 0.52);
    backdrop-filter: blur(10px);
  }
  &__head {
    display: flex;
    align-items: center;
    gap: 20px;
  }
  &__photo {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    border: solid 1px rgb(var(--white));
    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }
  &__name {
    margin-bottom: 16px;
    p {
      &:first-child {
        font-size: 20px;
        font-weight: 500;
      }
      &:last-child {
        font-size: 16px;
        font-weight: 400;
        color: rgba(var(--text), 0.6);
      }
    }
  }
  &__body {
    font-size: 20px;
    font-weight: 500;
  }
}
.service-info {
  display: flex;
  flex-direction: column;
  gap: 24px;
  height: 100%;
  &__item {
    &:first-child {
      background-color: rgb(var(--white));
      border-radius: var(--radius);
      padding: 32px 24px;
      height: 100%;
    }
    &:last-child {
      height: 100%;
    }
  }
  &__text {
    font-size: 28px;
    font-weight: 500;
    margin-bottom: 45px;
  }
}
.service-info-small {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 24px;
  height: 100%;
  @media (max-width: 374px) {
    grid-template-columns: 1fr;
  }
  &__item {
    background-color: rgb(var(--white));
    border-radius: var(--radius);
    padding: 32px 24px;
    display: flex;
    flex-direction: column;
  }
  &__name {
    font-size: 40px;
    font-weight: 500;
    line-height: 100%;
    color: rgb(var(--primary));
    margin-bottom: 24px;
    @media (max-width: 1200px) {
      font-size: 24px;
    }
  }
  &__text {
    margin-top: auto;
    color: rgba(var(--text), 0.6);
  }
}
</style>
