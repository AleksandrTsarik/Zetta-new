<template>
  <div class="choice">
    <div class="choice__head">
      <div class="choice__title">{{ title }}</div>
      <div class="choice__subtitle">{{ subtitle }}</div>
    </div>
    <div class="choice__body">
      <div class="choice__item" v-for="(item, i) in choiceInfo" :key="i">
        <div class="choice__name">{{ item.name }}</div>
        <div class="choice__text">{{ item.text }}</div>
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

<style lang="scss" scoped></style>
