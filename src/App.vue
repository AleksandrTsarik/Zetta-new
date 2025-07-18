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

<style lang="scss"></style>
