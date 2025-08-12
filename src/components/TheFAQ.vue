<template>
  <div class="faq">
    <div class="faq__container">
      <div class="faq__inner">
        <h2 class="title">{{ title }}</h2>
        <div class="faq-accordion">
          <div
            class="faq-accordion__item"
            v-for="(item, i) in faqOptions"
            :key="i"
          >
            <div class="faq-accordion__name" @click="toggle(i)">
              {{ item.name }}
              <span :class="{ open: isOpen(i) }"></span>
            </div>

            <div class="faq-accordion__content" :class="{ open: isOpen(i) }">
              <div
                class="faq-accordion__content-inner"
                v-html="item.text"
              ></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "TheFAQ",

  props: {
    faqOptions: {
      type: Array,
      default: () => [],
    },
    title: {
      type: String,
      default: "",
    },
  },

  data() {
    return {
      activeIndex: -1, // -1 означает, что ничего не открыто
    };
  },

  methods: {
    toggle(index) {
      this.activeIndex = this.activeIndex === index ? -1 : index;
    },
  },

  computed: {
    isOpen() {
      return (index) => index === this.activeIndex;
    },
  },
};
</script>

<style lang="scss" scoped>
.faq {
  &__inner {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 100px;
    @media (max-width: 1023px) {
      grid-template-columns: 1fr;
      gap: 32px;
    }
  }
}
.faq-accordion {
  &__item {
    margin-bottom: 8px;
    border-bottom: solid 1px rgb(var(--text));

    &:first-child {
      border-top: solid 1px rgb(var(--text));
    }
  }

  &__name {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 0;
    cursor: pointer;
    transition: color 0.2s ease;

    span {
      display: block;
      width: 24px;
      height: 24px;
      position: relative;
      transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); // "anticipation" — плавный старт
      transform: rotate(0deg);

      &::after,
      &::before {
        content: "";
        display: block;
        width: 100%;
        height: 2px;
        background-color: rgb(var(--text));
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        transition: background-color 0.2s ease;
      }

      &::after {
        transform: translate(-50%, -50%) rotate(90deg);
      }

      &.open {
        transform: rotate(135deg);
      }
    }
  }

  &__content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94); // "ease-in-out-soft"
    background: rgb(var(--bg-light));

    &.open {
      max-height: 1000px; // Достаточно для длинных ответов
      transition: max-height 0.55s cubic-bezier(0.16, 0.85, 0.47, 0.99); // Очень плавное открытие
    }
  }

  &__content-inner {
    padding: 20px 0;
    line-height: 1.6;
    color: rgb(var(--text-secondary));
  }
}
</style>
