<template>
  <div class="extra">
    <div class="extra__container">
      <span class="span-primary">
        <svg
          width="16"
          height="16"
          viewBox="0 0 16 16"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M8.00016 14.6667C6.68162 14.6667 5.39269 14.2757 4.29636 13.5432C3.20004 12.8106 2.34555 11.7694 1.84097 10.5513C1.33638 9.33309 1.20436 7.99265 1.4616 6.69944C1.71883 5.40623 2.35377 4.21835 3.28612 3.286C4.21847 2.35365 5.40636 1.71871 6.69956 1.46148C7.99277 1.20424 9.33321 1.33626 10.5514 1.84085C11.7696 2.34543 12.8108 3.19991 13.5433 4.29624C14.2758 5.39257 14.6668 6.6815 14.6668 8.00004C14.6649 9.76757 13.9619 11.4621 12.7121 12.712C11.4623 13.9618 9.76769 14.6648 8.00016 14.6667ZM8.00016 2.44449C6.90138 2.44449 5.82727 2.77032 4.91366 3.38077C4.00006 3.99122 3.28799 4.85888 2.8675 5.87402C2.44701 6.88917 2.337 8.00621 2.55136 9.08388C2.76572 10.1615 3.29484 11.1515 4.07179 11.9284C4.84875 12.7054 5.83866 13.2345 6.91633 13.4488C7.994 13.6632 9.11104 13.5532 10.1262 13.1327C11.1413 12.7122 12.009 12.0001 12.6194 11.0865C13.2299 10.1729 13.5557 9.09883 13.5557 8.00004C13.5541 6.52711 12.9683 5.11498 11.9267 4.07346C10.8852 3.03194 9.47309 2.44611 8.00016 2.44449Z"
            fill="#7D51FE"
          />
          <path
            d="M9.11127 11.8889H8.00016V8.00004H6.88905V6.88893H8.00016C8.29485 6.88893 8.57746 7.00599 8.78584 7.21437C8.99421 7.42274 9.11127 7.70535 9.11127 8.00004V11.8889Z"
            fill="#7D51FE"
          />
          <path
            d="M8.00016 5.77782C8.4604 5.77782 8.83349 5.40472 8.83349 4.94448C8.83349 4.48425 8.4604 4.11115 8.00016 4.11115C7.53992 4.11115 7.16683 4.48425 7.16683 4.94448C7.16683 5.40472 7.53992 5.77782 8.00016 5.77782Z"
            fill="#7D51FE"
          />
        </svg>
        Полезно
      </span>
      <h2 class="title extra__title">Дополнительная информация</h2>

      <div class="extra-tab">
        <div class="extra-tab-name">
          <div
            class="extra-tab-name__item"
            :class="{ active: activeTab === 0 }"
            @click="setActiveTab(0)"
          >
            <span
              ><svg
                width="25"
                height="24"
                viewBox="0 0 25 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M12.4996 21.9992C8.08862 21.9992 4.5 18.2643 4.5 13.6735C4.5 10.8777 5.70394 9.12847 7.51185 7.36258L9.47015 5.44851L8.83658 8.16518C8.61659 9.11098 8.559 12 9.72614 13.5444C10.2149 14.1913 10.8605 14.506 11.6996 14.506C12.5852 14.506 13.2884 13.77 13.2996 12.8301C13.3108 11.9001 12.9332 11.13 12.5332 10.3157C12.1236 9.48148 11.6996 8.61977 11.6996 7.57239C11.6996 5.31529 12.8292 3.26967 12.8772 3.18391L13.5395 2L14.2443 3.15811C14.9235 4.27292 15.8394 5.31196 16.7266 6.31688C18.5817 8.41828 20.5 10.593 20.5 13.6743C20.5 18.2651 16.9114 22 12.5004 22L12.4996 21.9992ZM6.09992 13.6735C6.09992 17.3459 8.97098 20.334 12.4996 20.334C16.0282 20.334 18.8993 17.3459 18.8993 13.6735C18.8993 11.2407 17.2714 9.39489 15.5474 7.44251C14.9315 6.74398 14.3011 6.03047 13.7267 5.26867C13.5059 5.91225 13.2996 6.73649 13.2996 7.57406C13.2996 8.22013 13.6043 8.8404 13.9571 9.55974C14.4067 10.4739 14.9155 11.5096 14.8995 12.8526C14.8779 14.6825 13.442 16.172 11.6996 16.172C10.3757 16.172 9.25816 15.6192 8.4678 14.5743C7.55105 13.3613 7.21266 11.6795 7.13667 10.2566C6.4671 11.2282 6.09992 12.2756 6.09992 13.6735Z"
                  fill="#EEEEEE"
                />
              </svg>
            </span>
            <p>Страховой случай</p>
          </div>

          <div
            class="extra-tab-name__item"
            :class="{ active: activeTab === 1 }"
            @click="setActiveTab(1)"
          >
            <span
              ><svg
                width="25"
                height="24"
                viewBox="0 0 25 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M7.75 12H16.25V13.6667H7.75V12ZM7.75 17H13.7V15.3333H7.75V17ZM20.5 8.32167V22H3.5V4.5C3.5 3.83696 3.76866 3.20107 4.24688 2.73223C4.7251 2.26339 5.3737 2 6.05 2H14.0519L20.5 8.32167ZM14.55 7.83333H17.5981L14.55 4.845V7.83333ZM18.8 20.3333V9.5H12.85V3.66667H6.05C5.82457 3.66667 5.60837 3.75446 5.44896 3.91074C5.28955 4.06702 5.2 4.27899 5.2 4.5V20.3333H18.8Z"
                  fill="#7D51FE"
                />
              </svg>
            </span>
            <p>Документы</p>
          </div>
        </div>

        <div class="extra-tab__content">
          <div
            class="extra-tab__content-item tab-content"
            v-show="activeTab === 0"
          >
            <div class="tab-content__head">
              Что считается страховым случаем?
            </div>

            <div class="tab-content__body">
              <div class="tab-content-card">
                <div class="tab-content-card__img">
                  <img src="/img/tabs/item3.webp" alt="picture" />
                </div>
                <div class="tab-content-card__info">
                  <div class="tab-content-card__title">
                    Гражданская ответственность
                  </div>
                  <div class="tab-content-card__list">
                    <div class="tab-content-card__list-name">
                      Требования третьих лиц о возмещении вреда, причинённого:
                    </div>
                    <ul>
                      <li>жизни и здоровью и/или имуществу.</li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="tab-content-card">
                <div class="tab-content-card__img">
                  <img src="/img/tabs/item4.webp" alt="picture" />
                </div>
                <div class="tab-content-card__info">
                  <div class="tab-content-card__title">Финансовые риски</div>
                  <div class="tab-content-card__list">
                    <div class="tab-content-card__list-text">
                      Судебные и внесудебные расходы, связанные с рассмотрением
                      дела о причинении вреда (если включены в покрытие).
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-content-card">
                <div class="tab-content-card__info">
                  <div class="tab-content-card__title">
                    Страховой случай признаётся таковым, если:
                  </div>
                  <div class="tab-content-card__list">
                    <ol>
                      <li>произошёл в период действия договора;</li>
                      <li>
                        вред причинён непреднамеренно при осуществлении охранной
                        деятельности;
                      </li>
                      <li>
                        претензия предъявлена в рамках срока действия договора
                        и в соответствии с законодательством РФ.
                      </li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Вкладка 2 -->
          <div class="extra-tab__content-item" v-show="activeTab === 1">
            <div class="tab-link">
              <div class="tab-link__item">
                <p>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M7.25 12H15.75V13.6667H7.25V12ZM7.25 17H13.2V15.3333H7.25V17ZM20 8.32167V22H3V4.5C3 3.83696 3.26866 3.20107 3.74688 2.73223C4.2251 2.26339 4.8737 2 5.55 2H13.5519L20 8.32167ZM14.05 7.83333H17.0981L14.05 4.845V7.83333ZM18.3 20.3333V9.5H12.35V3.66667H5.55C5.32457 3.66667 5.10837 3.75446 4.94896 3.91074C4.78955 4.06702 4.7 4.27899 4.7 4.5V20.3333H18.3Z"
                      fill="#7D51FE"
                    />
                  </svg>
                  Основные условия страхования
                </p>
                <a
                  href="/pdf/Основные_условия_страхования_ЧОП.pdf"
                  class="btn btn-light"
                  target="_blank"
                  >Смотреть</a
                >
              </div>

              <div class="tab-link__item">
                <p>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M7.25 12H15.75V13.6667H7.25V12ZM7.25 17H13.2V15.3333H7.25V17ZM20 8.32167V22H3V4.5C3 3.83696 3.26866 3.20107 3.74688 2.73223C4.2251 2.26339 4.8737 2 5.55 2H13.5519L20 8.32167ZM14.05 7.83333H17.0981L14.05 4.845V7.83333ZM18.3 20.3333V9.5H12.35V3.66667H5.55C5.32457 3.66667 5.10837 3.75446 4.94896 3.91074C4.78955 4.06702 4.7 4.27899 4.7 4.5V20.3333H18.3Z"
                      fill="#7D51FE"
                    />
                  </svg>
                  Правила страхования лиц, осуществляющих охранную деятельность
                </p>
                <a
                  href="https://zettains.ru/upload/rules/%D0%BF%D1%80%D0%B0%D0%B2%D0%B8%D0%BB%D0%B0%20%D0%BE%D1%82%D0%B2%20%D1%87%D0%BE%D0%BF%20%D0%BD%D0%B0%20%D1%81%D0%B0%D0%B9%D1%82.pdf?t=1755491459778"
                  class="btn btn-light"
                  target="_blank"
                  >Смотреть</a
                >
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
  name: "ExtraTabs",

  data() {
    return {
      activeTab: 0,
    };
  },

  methods: {
    setActiveTab(index) {
      this.activeTab = index;
    },
  },
};
</script>

<style lang="scss" scoped>
.extra {
  &__container {
    position: relative;
    margin-top: 50px;
  }
  &__title {
    text-align: center;
  }
  .span-primary {
    top: -60px;
    left: 50%;
    transform: translateX(-50%);
  }
}
.extra-tab {
  display: flex;
  flex-direction: column;
  gap: 24px;
  &__content {
    background-color: rgb(var(--white));
    border-radius: var(--radius);
    padding: 24px;
    @media (max-width: 767px) {
      padding: 16px;
    }
  }
}
.extra-tab-name {
  display: inline-flex;
  padding: 5px;
  gap: 5px;
  margin-bottom: 20px;
  background-color: rgb(var(--white));
  border-radius: 5px;
  margin: 0 auto;
  justify-content: center;
  @media (max-width: 340px) {
    flex-direction: column;
  }
  &__item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 15px;
    border-radius: 4px;
    transition: 0.3s;
    cursor: pointer;
    font-size: 16px;
    @media (max-width: 767px) {
      font-size: 12px;
    }
    svg {
      transition: 0.3s;
      path {
        fill: rgb(var(--primary));
      }
    }
    &.active {
      background: rgb(var(--primary));
      color: rgb(var(--white));
      svg {
        path {
          fill: rgb(var(--white));
        }
      }
    }
  }
}
.tab-content {
  &__head {
    text-align: center;
    margin-bottom: 24px;
    font-size: 28px;
    font-weight: 500;
    @media (max-width: 767px) {
      margin-bottom: 20px;
    }
  }
  &__body {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 24px;
    grid-template-areas: "a b c";
    @media (max-width: 1023px) {
      grid-template-columns: 1fr 1fr;
      grid-template-areas: "a b" "c c";
    }
    @media (max-width: 767px) {
      grid-template-columns: 1fr;
      grid-template-areas: "a" "b" "c";
    }
  }
}
.tab-content-card {
  border-radius: var(--radius);
  padding: 24px;
  display: flex;
  flex-direction: column;
  background-color: rgb(var(--bg));
  transition: 0.3s;

  &:first-child {
    grid-area: a;
  }
  &:nth-child(2) {
    grid-row: b;
  }
  &:last-child {
    grid-area: c;
    color: rgb(var(--white));
    background: linear-gradient(
      123.1deg,
      rgba(var(--primary), 0.5) 0%,
      rgb(var(--primary)) 100%
    );
    .choice__text {
      color: rgb(var(--white));
    }
    .tab-content-card__title {
      font-size: 28px;
      flex-grow: 1;
    }
    .tab-content-card__info {
      display: flex;
      flex-direction: column;
      height: 100%;
    }
    .tab-content-card__list {
      margin-bottom: 0;
      ol {
        margin-top: auto;
        list-style-type: decimal;
        padding-left: 1.3em;
        color: rgb(var(--white));
        li {
          font-size: 16px;
          font-weight: 400;
          margin-bottom: 0.8em;
          &:last-child {
            margin-bottom: 0;
          }
        }
      }
    }
  }
  &__img {
    margin-bottom: 24px;
    transition: 0.3s;
    overflow: hidden;
    border-radius: var(--radius);
    img {
      transition: 0.3s;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }
  &__info {
  }
  &__title {
    font-size: 20px;
    font-weight: 500;
    margin-bottom: 16px;
  }
  &__text {
    font-size: 16px;
    font-weight: 400;
    margin-bottom: 16px;
    color: rgba(var(--text), 0.6);
  }
  &__list {
    font-size: 16px;
    font-weight: 400;
    margin-bottom: 16px;
    color: rgba(var(--text), 0.6);
    ul {
    }
  }
  &__list-name {
    margin-bottom: 16px;
  }
}
.tab-link {
  &__item {
    display: flex;
    align-items: center;
    gap: 10px;
    justify-content: space-between;
    background-color: rgb(var(--bg));
    padding: 16px;
    font-size: 16px;
    font-weight: 400;
    border-radius: 50px;
    margin-bottom: 10px;
    &:last-child {
      margin-bottom: 0;
    }
    @media (max-width: 767px) {
      border-radius: 8px;
    }
    @media (max-width: 575px) {
      flex-direction: column;
      align-items: flex-start;
      font-size: 14px;
      a {
        width: 100%;
        justify-content: center;
        text-align: center;
      }
    }
    a {
      height: 30px;
      line-height: 27px;
      padding: 0 10px;
      align-items: center;
      justify-content: center;
    }
    svg {
      flex: 0 0 16px;
    }
    &:last-child {
      margin-bottom: 0;
    }
    p {
      display: flex;
      align-items: center;
      gap: 5px;
    }
  }
}
</style>
