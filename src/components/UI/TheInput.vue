<template>
  <div v-if="type === 'text'" class="block-input">
    <label>
      <input
        type="text"
        :class="{ 'field-erorr': invalid }"
        :value="value"
        :placeholder="placeholder"
        @input="$emit('update:value', $event.target.value)"
      />
      <span v-if="name">{{ name }}</span>
      <span v-if="img" class="block-input__img">
        <svg
          width="17.000000"
          height="18.000000"
          viewBox="0 0 17 18"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink"
        >
          <path
            id="Vector"
            d="M16 16.5L12.13 12.63M13.68 10.33C14.03 9.46 14.22 8.54 14.22 7.61C14.22 6.67 14.03 5.75 13.68 4.88C13.32 4.02 12.79 3.24 12.13 2.58C11.47 1.92 10.69 1.39 9.83 1.04C8.96 0.68 8.04 0.5 7.11 0.5C6.17 0.5 5.25 0.68 4.38 1.04C3.52 1.39 2.74 1.92 2.08 2.58C0.74 3.91 0 5.72 0 7.61C0 9.49 0.74 11.3 2.08 12.63C3.41 13.97 5.22 14.72 7.11 14.72C8.99 14.72 10.8 13.97 12.13 12.63C12.79 11.97 13.32 11.19 13.68 10.33Z"
            stroke="#212529"
            stroke-opacity="1.000000"
            stroke-width="1.066654"
            stroke-linejoin="round"
          />
        </svg>
      </span>
    </label>
  </div>
  <div v-else-if="type === 'tel'" class="block-input">
    <label>
      <input
        :class="{ 'field-erorr': invalid }"
        :value="value"
        @input="$emit('update:value', $event.target.value)"
        type="tel"
        :placeholder="placeholder"
      />
      <!--        <MaskInput type="tel"  v-model="phoneNumber" mask="+7(###) ###-##-##" placeholder="+7 (-&#45;&#45;) -&#45;&#45; &#45;&#45; &#45;&#45;" />-->
      <span v-if="name">{{ name }}</span>
    </label>
  </div>
  <div v-else-if="type === 'email'" class="block-input">
    <label>
      <input
        :class="{ 'field-erorr': invalid }"
        :value="value"
        type="email"
        :placeholder="placeholder"
        @input="$emit('update:value', $event.target.value)"
      />
      <span v-if="name">{{ name }}</span>
    </label>
  </div>
  <div v-else-if="type === 'file'" class="block-input__file">
    <label>
      <input
        :class="{ 'field-erorr': invalid }"
        :value="value"
        type="file"
        :placeholder="fileName"
        @change="uploadFile($event.target.files)"
        multiple
      />
      <span v-if="fileName">{{ fileName }}</span>
      <span class="block-input__file-ico">
        <svg
          width="16"
          height="14"
          viewBox="0 0 16 14"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M0.5 9C0.632608 9 0.759785 9.05268 0.853553 9.14645C0.947322 9.24022 1 9.36739 1 9.5V12C1 12.2652 1.10536 12.5196 1.29289 12.7071C1.48043 12.8946 1.73478 13 2 13H14C14.2652 13 14.5196 12.8946 14.7071 12.7071C14.8946 12.5196 15 12.2652 15 12V9.5C15 9.36739 15.0527 9.24022 15.1464 9.14645C15.2402 9.05268 15.3674 9 15.5 9C15.6326 9 15.7598 9.05268 15.8536 9.14645C15.9473 9.24022 16 9.36739 16 9.5V12C16 12.5304 15.7893 13.0391 15.4142 13.4142C15.0391 13.7893 14.5304 14 14 14H2C1.46957 14 0.960859 13.7893 0.585786 13.4142C0.210714 13.0391 0 12.5304 0 12V9.5C0 9.36739 0.0526784 9.24022 0.146447 9.14645C0.240215 9.05268 0.367392 9 0.5 9Z"
            fill="black"
          />
          <path
            d="M8.14606 10.8531C8.1925 10.8997 8.24767 10.9366 8.3084 10.9618C8.36914 10.987 8.43424 11 8.5 11C8.56576 11 8.63086 10.987 8.6916 10.9618C8.75233 10.9366 8.8075 10.8997 8.85394 10.8531L11.8534 7.85336C11.9473 7.75948 12 7.63216 12 7.49939C12 7.36663 11.9473 7.2393 11.8534 7.14542C11.7595 7.05154 11.6322 6.9988 11.4995 6.9988C11.3667 6.9988 11.2394 7.05154 11.1455 7.14542L8.99991 9.29224V0.499959C8.99991 0.367362 8.94724 0.240195 8.85349 0.146435C8.75974 0.0526741 8.63258 0 8.5 0C8.36742 0 8.24026 0.0526741 8.14651 0.146435C8.05276 0.240195 8.00009 0.367362 8.00009 0.499959V9.29224L5.85448 7.14542C5.76061 7.05154 5.63329 6.9988 5.50054 6.9988C5.36779 6.9988 5.24047 7.05154 5.14661 7.14542C5.05274 7.2393 5 7.36663 5 7.49939C5 7.63216 5.05274 7.75948 5.14661 7.85336L8.14606 10.8531Z"
            fill="black"
          />
        </svg>
      </span>
    </label>
  </div>
  <div v-else-if="type === 'textarea'" class="block-textarea">
    <textarea
      :class="{ 'field-erorr': invalid }"
      :placeholder="placeholder"
      :value="value"
      @input="$emit('update:value', $event.target.value)"
    ></textarea>
  </div>
</template>

<script>
// import { MaskInput } from 'vue-3-mask';
export default {
  components: {
    // MaskInput
  },
  emits: ["update:value", "selectFile"],
  props: {
    value: {
      type: [String, Number],
      default: "",
    },
    label: {
      type: String,
      default: "",
    },
    img: {
      type: String,
      default: "",
    },
    name: {
      type: String,
      default: "",
    },
    type: {
      type: String,
      defrault: "",
      require: true,
    },
    placeholder: {
      type: String,
      default: "",
      require: true,
    },
    invalid: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      phoneNumber: "",
      fileName: "",
    };
  },

  mounted() {
    this.fileName = this.name;
  },

  methods: {
    uploadFile(files) {
      files = Array.from(files);
      if (files.length === 0) {
        this.fileName = this.name;
      } else {
        this.fileName = files.map((f) => f.name).join(", ");
      }
      this.$emit("selectFile", files);
    },
  },
};
</script>

<style lang="scss">
.block-input {
  width: 100%;

  font-size: 18px;
  position: relative;
  margin-bottom: 10px;

  input {
    padding: 14px 25px;
    border: solid 1px #c9c9c9;
    border-radius: 6px;
    width: 100%;
    text-overflow: ellipsis;

    &:focus {
      border-color: rgb(244, 172, 172);
    }

    &.field-erorr {
      border: solid 1px red;
    }
  }

  &__file-ico {
    margin: 0 1em;

    svg {
      width: 20px;
    }
  }

  &__file {
    position: relative;
    height: 50px;
    margin-top: 10px;

    label {
      cursor: pointer;
      display: flex;
      width: 100%;
      padding: 14px 25px;
      border: solid 1px #c9c9c9;
      border-radius: 6px;
    }

    input {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      opacity: 0;
    }
  }

  &__img {
    position: absolute;
    right: 20px;
    top: 60%;
    transform: translateY(-50%);
  }
}

.block-textarea {
  textarea {
    resize: none;
    width: 100%;
    border: solid 1px #c1c1c1;
    border-radius: 10px;
    padding: 15px 25px;
    background-color: transparent;
    font-size: 16px;

    &:focus {
      border: solid 1px rgb(244, 172, 172);
    }

    &.field-erorr {
      border: solid 1px red;
    }
  }
}
</style>
