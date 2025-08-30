<template>
  <div class="banner">
    <div class="banner__container">
      <div class="banner__inner">
        <div class="banner__item">
          <span class="span-primary">
            <svg
              width="14"
              height="16"
              viewBox="0 0 14 16"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M6.96501 16L6.72901 15.8953C6.46634 15.78 0.333008 13.01 0.333008 7.994V3.64467C0.333242 3.22611 0.46553 2.81831 0.711034 2.47932C0.956539 2.14033 1.30274 1.88744 1.70034 1.75667L6.99967 0L12.299 1.75667C12.6966 1.88744 13.0428 2.14033 13.2883 2.47932C13.5338 2.81831 13.6661 3.22611 13.6663 3.64467V7.994C13.6663 13.712 7.47434 15.8307 7.21034 15.9187L6.96501 16ZM6.99967 1.398L2.12234 3.01533C1.98964 3.05868 1.87405 3.1429 1.79214 3.25595C1.71023 3.369 1.6662 3.50506 1.66634 3.64467V7.994C1.66634 11.6567 5.95967 14.0327 7.03101 14.568C8.10034 14.138 12.333 12.1693 12.333 7.994V3.64467C12.3332 3.50506 12.2891 3.369 12.2072 3.25595C12.1253 3.1429 12.0097 3.05868 11.877 3.01533L6.99967 1.398Z"
                fill="#7D51FE"
                class="fill-primary"
              />
              <path
                d="M6.42582 9.45453H6.40442C6.24027 9.45218 6.07834 9.41885 5.92842 9.35655C5.7785 9.29425 5.6437 9.20427 5.53217 9.09205L4.03671 7.64214L4.97121 6.80724L6.42647 8.2209L9.78639 5.09091L10.7034 5.94515L7.29157 9.12346C7.17794 9.22924 7.0429 9.31296 6.8943 9.36979C6.74569 9.42661 6.58645 9.45542 6.42582 9.45453Z"
                fill="#7D51FE"
                class="fill-primary"
              />
            </svg>
            <p>Полис Zetta</p>
          </span>
          <div class="banner__item-top">
            <h2
              class="banner__title title"
              v-if="descr.title"
              v-html="descr.title"
            ></h2>
            <div class="banner__subtitle" v-if="descr.subtitle">
              {{ descr.subtitle }}
            </div>
            <div class="banner__more">
              <a
                :href="descr.url"
                :target="descr.target ? '_blank' : undefined"
                class="btn btn-primary"
              >
                {{ descr.btn }}
              </a>
            </div>
          </div>
          <div class="banner__item-botoom">
            <div class="banner-offer">
              <div
                class="banner-offer__item"
                v-for="(item, i) in descr.list"
                :key="i"
              >
                <div class="banner-offer__ico">
                  <svg
                    width="22"
                    height="16"
                    viewBox="0 0 22 16"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M7.18545 15.5C6.88179 15.5001 6.58108 15.4414 6.30055 15.3273C6.02003 15.2132 5.76519 15.0459 5.55064 14.8349L0.5 9.87979L2.42726 7.98886L7.18545 12.6596L19.5727 0.5L21.5 2.39094L8.82026 14.8349C8.60571 15.0459 8.35087 15.2132 8.07035 15.3273C7.78982 15.4414 7.48912 15.5001 7.18545 15.5Z"
                      fill="#7D51FE"
                      class="fill-primary"
                    />
                  </svg>
                </div>
                <div class="banner-offer__info">
                  <div class="banner-offer__name" v-if="item.title">
                    {{ item.title }}
                  </div>
                  <div class="banner-offer__text" v-if="item.text">
                    {{ item.text }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="banner__item">
          <div class="banner__img">
            <img :src="descr.img" :alt="descr.alt" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Button from "../components/UI/TheButton.vue";

export default {
  components: {
    Button,
  },
  props: {
    descr: {
      type: Object,
      default: {},
    },
  },
  mounted() {
    console.log(this.descr);
  },
};
</script>

<style lang="scss" scoped>
.banner {
  &__inner {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    @media (max-width: 1200px) {
      grid-template-columns: 1fr;
    }
  }
  &__item {
    &:first-child {
      display: flex;
      flex-direction: column;
    }
    .span-primary {
      margin: 24px;
    }
    &:has(.span-primary) .banner__item-top {
      padding-top: 80px;
    }
  }
  &__item-top {
    background-color: rgb(var(--white));
    border-radius: var(--radius);
    padding: 24px;
    flex-grow: 1;
    display: inline-flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 20px;
  }
  &__title {
    margin-bottom: 0;
  }
  &__subtitle {
    font-size: 16px;
    font-weight: 500;
    color: rgba(var(--text), 0.6);
  }
  &__img {
    border-radius: var(--radius);
    overflow: hidden;
    height: 100%;
    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      @media (max-width: 1200px) {
        max-height: 500px;
      }
    }
  }
  &__more {
    @media (max-width: 575px) {
      width: 100%;
      a.btn {
        display: block;
        text-align: center;
      }
    }
  }
}
.banner-offer {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap: 20px;
  margin: 20px 0 0;
  @media (max-width: 767px) {
    grid-template-columns: 1fr 1fr;
  }
  &__item {
    background-color: rgb(var(--white));
    border-radius: var(--radius);
    padding: 16px;
    @media (max-width: 767px) {
      &:last-child {
        display: none;
      }
    }
  }
  &__ico {
    margin-bottom: 12px;
  }
  &__info {
  }
  &__name {
    font-size: 20px;
    font-weight: 500;
    color: rgb(var(--text));
    margin-bottom: 12px;
  }
  &__text {
    font-size: 16px;
    font-weight: 400;
    color: rgba(var(--text), 0.6);
  }
}
</style>
