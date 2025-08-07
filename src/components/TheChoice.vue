<template>
  <div class="choice">
    <div class="choice__container">
      <div class="choice__head">
        <h2 class="choice__title title">{{ title }}</h2>
        <div class="choice__subtitle">{{ subtitle }}</div>
      </div>
      <div class="choice__body">
        <div class="choice__item" v-for="(item, i) in choiceInfo" :key="i">
          <div class="choice__name">{{ item.name }}</div>
          <div class="choice__text">{{ item.text }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    choiceInfo: {
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
  },
};
</script>

<style lang="scss" scoped>
.choice {
  &__head {
    display: grid;
    grid-template-columns: 1fr 1fr;
    margin-bottom: 64px;
  }
  &__body {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
  }
}
</style>
