<script setup>
import TheHeader from "./components/TheHeader.vue";
import TheFooter from "./components/TheFooter.vue";
</script>

<template>
  <TheHeader />
  <main>
    <router-view />
  </main>
  <TheFooter />
</template>

<style lang="scss">
.vue-logo-fixed {
  position: fixed;
  left: 50%;
  bottom: 32px;
  transform: translateX(-50%);
  z-index: 1000;
  pointer-events: none;
  opacity: 0.8;
  img {
    width: 64px;
    height: 64px;
    display: block;
  }
}
</style>
