<template>
  <label class="default-checkbox">
    <input v-model="isCheck" type="checkbox" class="default-checkbox__input" ref="checkbox">
    <span class="default-checkbox__container"></span>
    <span v-if="!hiddenLabel" class="default-checkbox__text" v-html="label"></span>
  </label>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      default: ''
    },
    hiddenLabel: {
      type: Boolean,
      default: false,
    },
    size: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      isCheck: true,
    }
  },
  watch: {
    isCheck(val) {
      this.$emit('input', val)
    }
  }
}
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
    &:checked ~ .default-checkbox__container {
      border-color: #3C3A3A;
      background-color: transparent;
      &::before {
        opacity: 1;
      }
    }
  }
  &__container {
    position: relative;
    display: inline-block;
    width: 15px;
    height: 15px;
    border: 1px solid #C9C9C9;
    border-radius: 3px;
    flex: 0 0 15px;
    transition: background-color 0.3s;
    margin-top: 0px;
    &:before {
      content: '';
      position: absolute;
      display: block;
      top: 45%;
      left: 50%;
      width: 4px;
      height: 7px;
      border-right: solid 1px #2E2D2D;
      border-bottom: solid 1px #2E2D2D;
      transform: translate(-50%, -50%) rotate(45deg); 
      opacity: 0;
      transition: 0.3s;
    }
  }
}
</style>