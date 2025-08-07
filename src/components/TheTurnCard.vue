<template>
  <div class="turn">
    <div class="turn__head">
      <div class="turn__title" v-if="title">{{ title }}</div>
      <div class="turn__subtitle" v-if="subtitle">{{ subtitle }}</div>
    </div>
    <div class="turn__body" :class="'turn__body--' + bodyClass">
      <div class="turn-item" v-from="(item, i) in turnInfo" :key="i">
        <div class="turn-item__img">
          <img :src="item.img" :alt="item.alt" />
        </div>
        <div class="turn-item__info">
          <div class="turn-item__title">{{ item.title }}</div>
          <div class="turn-item__text">{{ item.text }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    turnInfo: {
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
    bodyClass: {
      type: String,
      default: "",
    },
  },
};
</script>

<style lang="scss" scoped></style>
