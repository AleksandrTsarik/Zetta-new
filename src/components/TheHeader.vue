<template>
  <header class="header">
    <div class="header__wrap">
      <div class="header__item">
        <TheNetwork type="logo" />
        <nav class="header-nav">
          <ul>
            <li v-for="(item, i) in nav" :key="i">
              <router-link :to="item.url">{{ item.name }}</router-link>
            </li>
          </ul>
        </nav>
      </div>
      <div class="header__item"></div>
    </div>
  </header>
</template>

<script>
import TheNetwork from "./TheNetwork.vue";
export default {
  components: {
    TheNetwork,
  },
  data() {
    return {
      nav: [
        {
          name: "ОСГОП такси",
          url: "/osgop",
        },
        {
          name: "Страхование имущества",
          url: "/insurance",
        },
        {
          name: "Страхование ЧОП",
          url: "/insurance-cop",
        },
      ],
    };
  },
};
</script>

<style scoped lang="scss">
.header {
  max-width: 1980px;
  margin: 0 auto;
  padding: 20px 24px;
  width: 100%;
  &__wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
  }
  &__item {
    display: flex;
    align-items: center;
    gap: 20px;
    &:first-child {
    }
  }
}
.header-nav {
  border-radius: 50px;
  background-color: rgb(var(--white));
  padding: 12px 24px;
  ul {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  a {
    color: rgb(var(--primary));
    font-size: 16px;
    font-weight: 400;
  }
}
</style>
