<template>
  <div class="v-select">
    <div
      class="v-select__field"
      @click="optionsVisible = !optionsVisible"
      :class="optionsVisible === true ? 'active' : ''"
    >
      {{ selected }}
    </div>
    <div class="v-select__options" v-if="optionsVisible">
      <span
        v-for="(option, i) in options"
        :key="i"
        @click="selectOption(option)"
        >{{ option.name }}</span
      >
    </div>
  </div>
</template>

<script>
export default {
  props: {
    options: {
      type: Array,
      default: [],
    },
    selected: {
      type: String,
      default: "",
    },
  },
  data() {
    return {
      optionsVisible: false,
    };
  },
  methods: {
    selectOption(option) {
      this.$emit("select", option);
      this.optionsVisible = false;
    },
    hideSelect() {
      this.optionsVisible = false;
    },
  },
  mounted() {
    document.addEventListener("click", this.hideSelect.bind(this), true);
  },
  beforeDestroy() {
    document.removeEventListener("click", this.hideSelect);
  },
};
</script>

<style lang="scss">
.v-select {
  position: relative;
  max-width: 100%;
  @media (max-width: 767px) {
    max-width: 100%;
  }
  &__field {
    font-size: 16px;
    font-weight: 600;
    border-bottom: solid 1px #9f9d9d;
    display: flex;
    align-items: center;
    justify-content: space-between;
    &::after {
      content: "";
      display: flex;
      width: 15px;
      height: 15px;

      transition: 0.3s;
      background-image: url("@/assets/img/icon-select.svg");
      background-repeat: no-repeat;
      text-align: center;
      background-size: cover;
    }

    &.active {
      &::after {
        transform: rotate(180deg);
      }
    }
  }
  &__options {
    position: absolute;
    width: 100%;
    top: 100%;
    left: 0;
    background-color: #fff;
    z-index: 50;
    padding: 10px;
    box-shadow: 0 0 10px rgba(#000, 0.5);
    border-radius: 7px;
    span {
      display: block;
      padding: 5px;
      margin-bottom: 5px;
      border-radius: 7px;
      transition: 0.3s;
      cursor: pointer;
      &:hover {
        @media (min-width: 1024px) {
          background-color: #dedede;
        }
      }
    }
  }
}
</style>
