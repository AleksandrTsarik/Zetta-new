<template>
  <header class="header">
    <div class="header__wrap">
      <div class="header__item">
        <TheNetwork type="logo" />
        <nav class="header-nav desktop-item">
          <ul>
            <li v-for="(item, i) in nav" :key="i">
              <router-link :to="item.url">{{ item.name }}</router-link>
            </li>
          </ul>
        </nav>
      </div>
      <div class="header__item desktop-item">
        <div class="header-contact">
          <div class="header-contact__social">
            <TheNetwork type="wp" />
            <TheNetwork type="tg" />
          </div>
          <div class="header-contact__phone">
            <a href="tel:+7 (909) 005-85-85">+7 (909) 005-85-85</a>
          </div>
          <div class="header-contact__write">
            <Button label="Написать" class="btn-light" />
          </div>
        </div>
      </div>
      <div class="header__item mobile-item" v-click-outside="hide">
        <div class="burger" @click="menuOpen" :class="{ active: isOpenMenu }">
          <div class="burger__btn">
            <span></span>
          </div>
        </div>
        <div class="header-mobile" :class="{ active: isOpenMenu }">
          <div class="header-mobile__overlay"></div>
          <div class="header-mobile__wrap">
            <nav class="header-nav">
              <ul>
                <li v-for="(item, i) in nav" :key="i">
                  <router-link :to="item.url">{{ item.name }}</router-link>
                </li>
              </ul>
            </nav>
            <div class="header-contact">
              <div class="header-contact__social">
                <TheNetwork type="wp" />
                <TheNetwork type="tg" />
              </div>
              <div class="header-contact__phone">
                <a href="tel:+7 (909) 005-85-85">+7 (909) 005-85-85</a>
              </div>
              <div class="header-contact__write">
                <Button label="Написать" class="btn-light" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import TheNetwork from "./TheNetwork.vue";
import Button from "./UI/TheButton.vue";
export default {
  components: {
    TheNetwork,
    Button,
  },
  data() {
    return {
      isOpenMenu: false,
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
  methods: {
    menuOpen() {
      if (!this.isOpenMenu) document.body.classList.add("lock");
      else document.body.classList.remove("lock");
      this.isOpenMenu = !this.isOpenMenu;
    },
    hide() {
      this.isOpenMenu = false;
      document.body.classList.remove("lock");
    },
  },
};
</script>

<style scoped lang="scss">
.desktop-item {
  @media (max-width: 1200px) {
    display: none !important;
  }
}
.mobile-item {
  display: none;
}
.header {
  max-width: 1980px;
  margin: 0 auto;
  padding: 20px 24px;
  width: 100%;
  position: relative;
  overflow: hidden;
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
    &:nth-child(2) {
      margin-left: auto;
    }
    @media (max-width: 1200px) {
      justify-content: space-between;
      width: 100%;
    }
  }
}
.header-nav {
  border-radius: 50px;
  background-color: rgb(var(--white));
  padding: 12px 24px;
  @media (max-width: 1200px) {
    padding: 0;
    margin-bottom: 20px;
    flex-grow: 1;
  }
  ul {
    display: flex;
    align-items: center;
    gap: 10px;
    @media (max-width: 1200px) {
      flex-direction: column;
      align-items: flex-start;
      padding-left: 0;
    }
  }
  a {
    color: rgb(var(--primary));
    font-size: 16px;
    font-weight: 400;
  }
}

.header-contact {
  display: flex;
  align-items: center;
  gap: 15px;
  @media (max-width: 1200px) {
    flex-direction: column;
    align-items: flex-start;
    margin-top: auto;
  }
  &__social {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  &__phone {
    a {
      white-space: nowrap;
      color: rgb(var(--primary));
      font-size: 16px;
      font-weight: 400;
    }
  }
}

.burger {
  width: 24px;
  cursor: pointer;
  display: none;
  margin-left: auto;
  @media (max-width: 1200px) {
    display: block;
  }
  &__btn {
    pointer-events: none;
    border: 0;
    background: 0;
    height: 18px;
    width: 32px;
    display: none;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    span,
    &::after,
    &::before {
      background-color: rgb(var(--primary));
      position: absolute;
      left: 0;
      border-radius: 30px;
    }
    span {
      top: 50%;
      transform: translateY(-50%);
      width: 100%;
      height: 3px;
      transition: opacity 0.3s ease;
    }
    &::before,
    &::after {
      content: "";
      height: 3px;
      width: 100%;
    }
    &::before {
      top: 0;
      transition: top 300ms 300ms cubic-bezier(0.23, 1, 0.32, 1),
        transform 300ms cubic-bezier(0.23, 1, 0.32, 1);
    }
    &::after {
      bottom: 0;
      transition: bottom 300ms 300ms cubic-bezier(0.23, 1, 0.32, 1),
        transform 300ms cubic-bezier(0.23, 1, 0.32, 1);
    }

    &:focus-visible {
      outline: none;
    }
  }
  &.active {
    .burger__btn {
      span {
        opacity: 0;
      }
      &::after {
        transform: rotate(-45deg);
        bottom: 7px;
        transition: bottom 300ms cubic-bezier(0.23, 1, 0.32, 1),
          transform 300ms 300ms cubic-bezier(0.23, 1, 0.32, 1);
      }
      &::before {
        transform: rotate(45deg);
        top: 8px;
        transition: top 300ms cubic-bezier(0.23, 1, 0.32, 1),
          transform 300ms 300ms cubic-bezier(0.23, 1, 0.32, 1);
      }
    }
  }
}
.header-mobile {
  position: fixed;
  top: 70px;
  right: -320px;
  width: 300px;
  height: calc(100% - 70px);
  bottom: 0;
  background-color: rgb(var(--white));
  border-radius: 16px 0 0 16px;

  box-shadow: -4px 0 12px rgba(0, 0, 0, 0.1);
  opacity: 0;
  visibility: hidden;
  transition: right 0.3s ease, opacity 0.3s ease, visibility 0.3s ease;
  // &__overlay {
  //   display: block;

  //   position: fixed;
  //   top: 0;
  //   left: 0;
  //   width: 100%;
  //   height: 100%;
  //   background-color: rgba(0, 0, 0, 0.5);
  //   z-index: -1;
  // }
  &__wrap {
    height: 100%;
    display: flex;
    flex-direction: column;
    padding: 20px;
  }
  &.active {
    right: 0;
    opacity: 1;
    visibility: visible;
    z-index: 1000;
  }
}
.mobile-item {
}
</style>
