<template>
  <button :type="type" class="btn">
    <span v-if="svg" v-html="svg"></span>
    {{ label }}
  </button>
</template>

<script>
export default {
  props: {
    label: {
      label: String,
      default: "",
      require: true,
    },
    type: {
      type: String,
      dafault: "",
    },
    svg: {
      type: String,
      dafault: "",
    },
  },
};
</script>

<style lang="scss"></style>
