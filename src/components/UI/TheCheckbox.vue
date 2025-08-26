<template>
  <label class="default-checkbox" @click="toggle">
    <input
      type="checkbox"
      :checked="modelValue"
      class="default-checkbox__input"
      @change="$emit('update:modelValue', $event.target.checked)"
      :ref="name"
    />
    <span class="default-checkbox__checked"></span>
    <span
      v-if="!hiddenLabel"
      class="default-checkbox__text"
      v-html="label"
    ></span>
  </label>
</template>

<script>
export default {
  name: "TheCheckbox",
  props: {
    modelValue: {
      type: Boolean,
      default: false,
    },
    label: {
      type: String,
      default: "",
    },
    hiddenLabel: {
      type: Boolean,
      default: false,
    },
    name: {
      type: String,
      default: "",
    },
  },
  emits: ["update:modelValue"],
  methods: {
    toggle() {
      this.$emit("update:modelValue", !this.modelValue);
    },
  },
};
</script>

<style lang="scss">
.default-checkbox {
  display: flex;
  column-gap: 10px;
  cursor: pointer;
  &__input {
    opacity: 0;
    appearance: none;
    position: absolute;
  }
  &__checked {
    flex: 0 0 24px;
    height: 24px;
    width: 24px;
    border: solid 1px rgb(var(--primary));
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    &::before {
      content: "";
      display: block;
      background-image: url("img/check.svg");
      background-position: center;
      background-repeat: no-repeat;
      background-size: contain;
      width: 1em;
      height: 1em;
    }
  }
  &__input:checked ~ .default-checkbox__checked {
    background-color: rgb(var(--primary));
  }
}
</style>
