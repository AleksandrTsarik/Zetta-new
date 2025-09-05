<template>
  <!-- Текстовое поле -->
  <div v-if="type === 'text'" class="block-input">
    <label>
      <input
        :type="type"
        :class="inputClass"
        :value="modelValue"
        :placeholder="placeholder"
        :name="name"
        :required="required"
        @input="$emit('update:modelValue', $event.target.value)"
        @blur="$emit('blur', $event.target.value)"
        @focus="$emit('focus', $event.target.value)"
      />
      <span v-if="name" class="block-input__label">{{ name }}</span>
      <span v-if="img" class="block-input__img">
        <slot name="img">
          <svg
            width="17"
            height="18"
            viewBox="0 0 17 18"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M16 16.5L12.13 12.63M13.68 10.33C14.03 9.46 14.22 8.54 14.22 7.61C14.22 6.67 14.03 5.75 13.68 4.88C13.32 4.02 12.79 3.24 12.13 2.58C11.47 1.92 10.69 1.39 9.83 1.04C8.96 0.68 8.04 0.5 7.11 0.5C6.17 0.5 5.25 0.68 4.38 1.04C3.52 1.39 2.74 1.92 2.08 2.58C0.74 3.91 0 5.72 0 7.61C0 9.49 0.74 11.3 2.08 12.63C3.41 13.97 5.22 14.72 7.11 14.72C8.99 14.72 10.8 13.97 12.13 12.63C12.79 11.97 13.32 11.19 13.68 10.33Z"
              stroke="#212529"
              stroke-width="1.06665"
              stroke-linejoin="round"
            />
          </svg>
        </slot>
      </span>
    </label>
  </div>

  <!-- Телефон -->
  <div v-else-if="type === 'tel'" class="block-input">
    <label>
      <input
        :type="type"
        :class="inputClass"
        :value="modelValue"
        :placeholder="placeholder"
        :name="name"
        :required="required"
        @input="$emit('update:modelValue', $event.target.value)"
        @blur="$emit('blur', $event.target.value)"
        @focus="$emit('focus', $event.target.value)"
        inputmode="numeric"
        pattern="[0-9]*"
        autocomplete="tel"
      />
      <span v-if="name" class="block-input__label">{{ name }}</span>
    </label>
  </div>

  <!-- Email -->
  <div v-else-if="type === 'email'" class="block-input">
    <label>
      <input
        :type="type"
        :class="inputClass"
        :value="modelValue"
        :placeholder="placeholder"
        :name="name"
        :required="required"
        @input="$emit('update:modelValue', $event.target.value)"
        @blur="$emit('blur', $event.target.value)"
        @focus="$emit('focus', $event.target.value)"
        autocomplete="email"
      />
      <span v-if="name" class="block-input__label">{{ name }}</span>
    </label>
  </div>

  <!-- Файл -->
  <div v-else-if="type === 'file'" class="block-input__file">
    <label>
      <input
        type="file"
        :class="{ 'field-error': invalid }"
        :placeholder="fileName"
        @change="uploadFile($event.target.files)"
        :multiple="multiple"
        :accept="accept"
      />
      <span class="block-input__file-name">{{ fileName }}</span>
      <span class="block-input__file-ico">
        <svg
          width="16"
          height="14"
          viewBox="0 0 16 14"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M0.5 9C0.632608 9 0.759785 9.05268 0.853553 9.14645C0.947322 9.24022 1 9.36739 1 9.5V12C1 12.2652 1.10536 12.5196 1.29289 12.7071C1.48043 12.8946 1.73478 13 2 13H14C14.2652 13 14.5196 12.8946 14.7071 12.7071C14.8946 12.5196 15 12.2652 15 12V9.5C15 9.36739 15.0527 9.24022 15.1464 9.14645C15.2402 9.05268 15.3674 9 15.5 9C15.6326 9 15.7598 9.05268 15.8536 9.14645C16 9.36739 16 9.5 16 9.5V12C16 12.5304 15.7893 13.0391 15.4142 13.4142C15.0391 13.7893 14.5304 14 14 14H2C1.46957 14 0.960859 13.7893 0.585786 13.4142C0.210714 13.0391 0 12.5304 0 12V9.5C0 9.36739 0.0526784 9.24022 0.146447 9.14645C0.240215 9.05268 0.367392 9 0.5 9Z"
            fill="black"
          />
          <path
            d="M8.14606 10.8531C8.1925 10.8997 8.24767 10.9366 8.3084 10.9618C8.36914 10.987 8.43424 11 8.5 11C8.56576 11 8.63086 10.987 8.6916 10.9618C8.75233 10.9366 8.8075 10.8997 8.85394 10.8531L11.8534 7.85336C11.9473 7.75948 12 7.63216 12 7.49939C12 7.36663 11.9473 7.05154 11.8534 7.14542C11.7595 7.05154 11.6322 6.9988 11.4995 6.9988C11.3667 6.9988 11.2394 7.05154 11.1455 7.14542L8.99991 9.29224V0.499959C8.99991 0.367362 8.94724 0.240195 8.85349 0.146435C8.75974 0.0526741 8.63258 0 8.5 0C8.36742 0 8.24026 0.0526741 8.14651 0.146435C8.05276 0.240195 8.00009 0.367362 8.00009 0.499959V9.29224L5.85448 7.14542C5.76061 7.05154 5.63329 6.9988 5.50054 6.9988C5.36779 6.9988 5.24047 7.05154 5.14661 7.14542C5.05274 7.2393 5 7.36663 5 7.49939C5 7.63216 5.05274 7.75948 5.14661 7.85336L8.14606 10.8531Z"
            fill="black"
          />
        </svg>
      </span>
    </label>
  </div>

  <!-- Textarea -->
  <div v-else-if="type === 'textarea'" class="block-textarea">
    <textarea
      :class="inputClass"
      :placeholder="placeholder"
      :value="modelValue"
      :name="name"
      :required="required"
      :rows="rows"
      @input="$emit('update:modelValue', $event.target.value)"
      @blur="$emit('blur', $event.target.value)"
      @focus="$emit('focus', $event.target.value)"
    ></textarea>
  </div>
</template>

<script>
export default {
  name: "TheInput",
  emits: ["update:modelValue", "selectFile", "blur", "focus"],
  props: {
    modelValue: {
      type: [String, Number],
      default: "",
    },
    label: {
      type: String,
      default: "",
    },
    img: {
      type: Boolean,
      default: false,
    },
    name: {
      type: String,
      default: "",
    },
    type: {
      type: String,
      required: true,
      validator(value) {
        return ["text", "tel", "email", "file", "textarea"].includes(value);
      },
    },
    placeholder: {
      type: String,
      required: true,
    },
    invalid: {
      type: Boolean,
      default: false,
    },
    required: {
      type: Boolean,
      default: false,
    },
    multiple: {
      type: Boolean,
      default: false,
    },
    accept: {
      type: String,
      default: "",
    },
    rows: {
      type: Number,
      default: 4,
    },
  },
  computed: {
    inputClass() {
      return {
        "field-error": this.invalid,
      };
    },
    fileName() {
      return this.modelValue || this.name || "Файл не выбран";
    },
  },
  methods: {
    uploadFile(files) {
      files = Array.from(files);
      const names = files.length
        ? files.map((f) => f.name).join(", ")
        : this.name || "Файл не выбран";
      this.$emit("selectFile", files);
      // Если вы хотите передавать имена файлов через v-model — раскомментируйте:
      // this.$emit("update:modelValue", names);
    },
  },
};
</script>

<style scoped>
.block-input {
  margin-bottom: 16px;
  position: relative;
}

.block-input label {
  display: block;
  position: relative;
}

.block-input input {
  width: 100%;
  padding: 10px;
  border: 1px solid rgba(var(--text), 0.2);
  border-radius: 8px;
  font-size: 14px;
  box-sizing: border-box;
  transition: border-color 0.3s ease;
  background: white;
  height: 50px;
}

.block-input input:focus {
  outline: none;
  border-color: rgb(var(--primary));
  box-shadow: 0 0 0 1px rgba(var(--primary), 0.2);
}

.block-input__label {
  position: absolute;
  left: 12px;
  top: -10px;
  background: white;
  padding: 0 4px;
  font-size: 12px;
  color: #666;
  z-index: 1;
  pointer-events: none;
}

.block-input__img {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  pointer-events: none;
}

/* ✅ Исправлено: field-erorr → field-error */
.field-error {
  border-color: #dc3545 !important;
}

/* Файл */
.block-input__file {
  margin-bottom: 16px;
}

.block-input__file label {
  display: block;
  position: relative;
  cursor: pointer;
}

.block-input__file input[type="file"] {
  position: absolute;
  inset: 0;
  opacity: 0;
  cursor: pointer;
  z-index: 1;
}

.block-input__file input + span,
.block-input__file span {
  display: block;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 8px;
  background: white;
  text-align: left;
  color: #666;
  font-size: 14px;
  min-height: 44px;
  display: flex;
  align-items: center;
}

.block-input__file-ico {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  pointer-events: none;
}

.block-input__file-name {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  padding-right: 30px;
}

/* Textarea */
.block-textarea textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 14px;
  resize: vertical;
  min-height: 100px;
  box-sizing: border-box;
  transition: border-color 0.3s ease;
}

.block-textarea textarea:focus {
  outline: none;
  border-color: #8d7fff;
  box-shadow: 0 0 0 2px rgba(141, 127, 255, 0.2);
}
</style>
