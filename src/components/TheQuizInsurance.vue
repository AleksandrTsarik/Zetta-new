<template>
  <div class="quiz">
    <div class="quiz__container">
      <div class="quiz__header">
        <span class="logo logo_color_primary">Полис Zetta</span>
        <h1 class="quiz__title">Оформить полис</h1>
      </div>

      <div class="quiz__main">
        <!-- Левая колонка -->
        <div class="quiz__left">
          <div class="step-title">
            <span class="step-title__number"
              >{{ currentStep === 1 ? "1" : "2" }} шаг.</span
            >
            <span class="step-title__name">{{
              currentStep === 1 ? "Расчёт" : "Оформление"
            }}</span>
          </div>

          <!-- Полоса прогресса -->
          <div class="progress-bar">
            <div class="progress-bar__track">
              <div class="progress-bar__divider"></div>
              <div
                class="progress-bar__fill"
                :style="{ width: `${currentStep === 1 ? 50 : 100}%` }"
              ></div>
            </div>
          </div>

          <!-- Шаг 1: Расчёт -->
          <div v-if="currentStep === 1" class="quiz__step">
            <h2 class="quiz__subtitle">Полис страхования имущества</h2>
            <Checkbox
              v-for="item in checkboxItems"
              :key="item.value"
              :label="item.label"
              :modelValue="selectedItems.includes(item.value)"
              @update:modelValue="toggleCheckbox(item.value)"
              class="checkbox__item"
            />

            <div class="slider">
              <div class="slider__label">Введите страховую сумму полиса</div>
              <div class="slider__input">
                <div class="slider__value-wrapper">
                  <span class="slider__value">{{
                    formatCurrency(insuranceSum)
                  }}</span>
                  <button @click="editSum" class="slider__edit-btn">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                      <path
                        d="M13.897 3.915C14.25 4.268 14.25 4.852 13.897 5.205L11.52 7.582L13.897 9.959C14.25 10.312 14.25 10.896 13.897 11.249C13.544 11.602 12.96 11.602 12.607 11.249L10.23 8.872L7.853 11.249C7.499 11.602 6.915 11.602 6.562 11.249C6.209 10.896 6.209 10.312 6.562 9.959L8.939 7.582L6.562 5.205C6.209 4.852 6.209 4.268 6.562 3.915C6.915 3.562 7.499 3.562 7.853 3.915L10.23 6.292L12.607 3.915C12.96 3.562 13.544 3.562 13.897 3.915Z"
                        fill="#8D7FFF"
                      />
                    </svg>
                  </button>
                </div>
                <input
                  type="range"
                  min="0"
                  max="30000000"
                  step="1000"
                  v-model.number="insuranceSum"
                  @input="updateDisplay"
                />
              </div>
            </div>

            <div class="quiz__buttons">
              <button
                class="button button_theme_back"
                :disabled="currentStep === 1"
              >
                ← Назад
              </button>
              <button class="button button_theme_next" @click="goNext">
                Продолжить →
              </button>
            </div>
          </div>

          <!-- Шаг 2: Оформление -->
          <div v-else class="quiz__step">
            <h2 class="quiz__subtitle">
              Заполните данные для оформления полиса
            </h2>
            <form class="form">
              <div
                class="form__group"
                v-for="(field, key) in formFields"
                :key="key"
              >
                <TheInput
                  v-model="formData[key]"
                  :type="field.type"
                  :name="field.label"
                  :placeholder="field.label"
                  :invalid="false"
                />
              </div>
              <div class="form__group">
                <checkbox
                  label="Даю согласие на обработку персональный данных в соответствии с <a href='https://codeseven.ru/pdf/opd.pdf' target='_blank'>Политикой конфиденциальности</a>"
                />
              </div>
            </form>

            <div class="quiz__buttons">
              <button class="button button_theme_back" @click="goBack">
                ← Назад
              </button>
              <button class="button button_theme_submit" @click="submitForm">
                Оформить полис
              </button>
            </div>
          </div>
        </div>

        <!-- Правая колонка -->
        <div class="quiz__right">
          <!-- Блок "Наполнение полиса" -->
          <div
            class="summary"
            :class="{ active: isDetailsOpen }"
            @click="toggleDetails()"
          >
            <div class="summary__header">
              <span>Наполнение полиса</span>
              <svg
                :class="{ summary__arrow_rotate: isDetailsOpen }"
                width="12"
                height="12"
                viewBox="0 0 12 12"
                fill="none"
              >
                <path d="M6 3L9 6L6 9L3 6L6 3Z" fill="currentColor" />
              </svg>
            </div>
            <div v-show="isDetailsOpen" class="summary__details">
              <p>Пакет "Конструктивные элементы и инженерное оборудование"</p>
              <ul class="summary__list">
                <li
                  v-for="item in selectedItems"
                  :key="item"
                  class="summary__item"
                >
                  {{ getLabel(item) }}
                </li>
              </ul>
            </div>
          </div>

          <!-- Блок "Детали" -->
          <div
            class="summary"
            :class="{ active: detailsOpen }"
            @click="toggleDetails('details')"
          >
            <div class="summary__header">
              <span>Детали</span>
              <svg
                :class="{ summary__arrow_rotate: detailsOpen }"
                width="12"
                height="12"
                viewBox="0 0 12 12"
                fill="none"
              >
                <path d="M6 3L9 6L6 9L3 6L6 3Z" fill="currentColor" />
              </svg>
            </div>
            <div v-show="detailsOpen" class="summary__details">
              <div class="summary__item">
                <span>Страховая сумма</span>
                <span>{{ formatCurrency(insuranceSum) }}</span>
              </div>
            </div>
            <div class="summary__total">
              <span>Итого:</span>
              <span>{{ formatCurrency(totalCost) }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Checkbox from "./UI/TheCheckbox.vue";
import TheInput from "./UI/TheInput.vue";

export default {
  components: {
    Checkbox,
    TheInput,
  },
  name: "TheQuizInsurance",
  data() {
    return {
      currentStep: 1,
      selectedItems: ["construction"],
      insuranceSum: 115000,
      formData: {
        companyName: "",
        inn: "",
        phone: "",
        email: "",
        agree: false,
      },
      isDetailsOpen: true,
      detailsOpen: true,
      checkboxItems: [
        {
          value: "construction",
          label: "Конструктивные элементы и инженерное оборудование",
        },
        { value: "interior", label: "Внутренняя отделка" },
        { value: "movable", label: "Движимое имущество" },
        {
          value: "inventory",
          label: "Товарно-материальные ценности в обороте",
        },
        {
          value: "windows",
          label: "Оконные стекла, витрины, внутреннее остекление",
        },
        { value: "civil", label: "Гражданское имущество" },
      ],
      formFields: {
        companyName: {
          label: "Наименование юр. лица",
          type: "text",
          required: true,
        },
        inn: { label: "ИНН", type: "text", required: true },
        phone: { label: "Контактный номер", type: "tel", required: true },
        email: { label: "Электронная почта", type: "email", required: true },
      },
    };
  },
  computed: {
    totalCost() {
      const base = this.insuranceSum;
      const multiplier = this.selectedItems.length > 1 ? 0.05 : 0;
      return Math.round(base * (1 + multiplier));
    },
  },
  methods: {
    toggleCheckbox(value) {
      const index = this.selectedItems.indexOf(value);
      if (index === -1) {
        this.selectedItems.push(value);
      } else {
        this.selectedItems.splice(index, 1);
      }
    },
    toggleDetails(type) {
      if (type === "details") {
        this.detailsOpen = !this.detailsOpen;
      } else {
        this.isDetailsOpen = !this.isDetailsOpen;
      }
    },
    goBack() {
      if (this.currentStep > 1) {
        this.currentStep--;
      }
    },
    goNext() {
      if (this.currentStep < 2) {
        this.currentStep++;
      }
    },
    editSum() {
      const newValue = prompt("Введите новую сумму:", this.insuranceSum);
      if (newValue && !isNaN(newValue)) {
        this.insuranceSum = parseInt(newValue);
      }
    },
    updateDisplay() {
      this.$nextTick(() => {
        const display = this.$el.querySelector(".slider__value");
        if (display) {
          display.textContent = this.formatCurrency(this.insuranceSum);
        }
      });
    },
    submitForm() {
      alert("Форма отправлена!");
      console.log("Данные:", this.formData);
    },
    formatCurrency(value) {
      return new Intl.NumberFormat("ru-RU", {
        style: "currency",
        currency: "RUB",
        minimumFractionDigits: 0,
      }).format(value);
    },
    getLabel(key) {
      return (
        this.checkboxItems.find((item) => item.value === key)?.label || key
      );
    },
  },
  mounted() {
    this.updateDisplay();
  },
};
</script>

<style lang="scss" scoped>
$color-primary: #8d7fff;
$color-primary-dark: #7a6bde;
$color-gray-light: #e0e0e0;
$color-gray-border: #eee;
$color-text-secondary: #666;

.quiz {
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  color: #333;
  margin: 0 auto;
  max-width: 1200px;
  padding: 20px;
}

.quiz__container {
}

.quiz__header {
  text-align: center;
  margin-bottom: 30px;
}

.logo {
  color: $color-primary;
  font-size: 14px;
  margin-bottom: 5px;

  &_color_primary {
    color: $color-primary;
  }
}

.quiz__title {
  font-size: 24px;
  margin: 0;
}

.quiz__main {
  display: flex;
  gap: 30px;
}

.quiz__left,
.quiz__right {
  flex: 1;
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.quiz__left {
  background: white;
  padding: 20px;
}

.quiz__right {
  background: #f8f9fa;
  padding: 20px;
}

.step-title {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 20px;

  &__number {
    font-weight: bold;
    color: $color-primary;
  }

  &__name {
    font-size: 14px;
    color: $color-text-secondary;
  }
}

.progress-bar {
  width: 100%;
  height: 6px;
  background: transparent;
  border-radius: 3px;
  overflow: hidden;
  margin-bottom: 20px;

  &__track {
    position: relative;
    width: 100%;
    height: 100%;
    background: $color-gray-light;
    border-radius: 3px;
  }

  &__divider {
    position: absolute;
    top: 0;
    left: 50%;
    width: 2px;
    height: 100%;
    background: white;
    z-index: 1;
    border-radius: 2px;
  }

  &__fill {
    height: 100%;
    background: $color-primary;
    border-radius: 3px;
    transition: width 0.3s ease;
  }
}

.quiz__subtitle {
  font-size: 18px;
  margin: 0 0 20px 0;
}

.checkbox {
  margin-bottom: 20px;

  &__item {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
    cursor: pointer;

    input[type="checkbox"] {
      width: 16px;
      height: 16px;
    }
  }
}

.slider {
  margin-bottom: 30px;

  &__label {
    font-size: 14px;
    margin-bottom: 10px;
    color: $color-text-secondary;
  }

  &__input {
    position: relative;
    width: 100%;
  }

  &__input input[type="range"] {
    width: 100%;
    height: 8px;
    -webkit-appearance: none;
    background: $color-gray-light;
    border-radius: 4px;
    outline: none;
  }

  &__input input[type="range"]::-webkit-slider-thumb {
    appearance: none;
    width: 20px;
    height: 20px;
    background: $color-primary;
    border-radius: 50%;
    cursor: pointer;
    border: 2px solid white;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
  }

  &__input input[type="range"]::-moz-range-thumb {
    width: 20px;
    height: 20px;
    background: $color-primary;
    border-radius: 50%;
    cursor: pointer;
    border: 2px solid white;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
  }

  &__value-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
    font-size: 16px;
    font-weight: 500;
  }

  &__value {
    font-size: 16px;
    font-weight: 500;
  }

  &__edit-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 14px;
    color: $color-primary;
  }
}

.quiz__buttons {
  display: flex;
  justify-content: space-between;
  gap: 10px;
}

.button {
  padding: 10px 20px;
  border-radius: 50px;
  font-size: 14px;
  cursor: pointer;
  transition: all 0.3s;
  border: none;

  &_theme_back {
    border: 1px solid #ddd;
    background: white;
    color: $color-text-secondary;

    &:hover {
      background: #f0f0f0;
    }

    &:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }
  }

  &_theme_next,
  &_theme_submit {
    background: $color-primary;
    color: white;

    &:hover {
      background: $color-primary-dark;
    }
  }
}

.form {
}

.form__group {
  margin-bottom: 16px;
}

.form__label {
  display: block;
  margin-bottom: 8px;
  font-size: 14px;
  color: $color-text-secondary;
}

.form__link {
  color: $color-primary;
  text-decoration: underline;
}

.summary {
  background: white;
  border-radius: 8px;
  padding: 16px;
  margin-bottom: 16px;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transition: all 0.3s ease;

  &.active {
    background: #f0f0ff;
    border: 1px solid $color-primary;

    .summary__header {
      color: $color-primary;
    }
  }

  &__header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 500;
    font-size: 14px;
    color: $color-text-secondary;
  }

  &__arrow_rotate {
    transform: rotate(180deg);
  }

  &__details {
    margin-top: 8px;
    padding-top: 8px;
    border-top: 1px solid $color-gray-border;
  }

  &__item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    font-size: 14px;
  }

  &__total {
    display: flex;
    justify-content: space-between;
    font-weight: bold;
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid $color-gray-border;
  }
}

@media (max-width: 900px) {
  .quiz__main {
    flex-direction: column;
  }
}
</style>
