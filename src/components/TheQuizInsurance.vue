<template>
  <div class="quiz">
    <div class="quiz__container">
      <!-- Шапка -->
      <header class="quiz__header">
        <span class="logo logo_color_primary">Полис Zetta</span>
        <h1 class="quiz__title">Оформить полис</h1>
      </header>

      <!-- Основной контент -->
      <main class="quiz__main">
        <!-- Левая колонка -->
        <div class="quiz__left">
          <h4>Полис страхования имущества</h4>
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
            <h2 class="quiz__subtitle">
              Выберите, какое имущество необходимо застраховать
            </h2>
            <div class="checkbox">
              <TheCheckbox
                v-for="item in checkboxItems"
                :key="item.value"
                :label="item.label"
                :modelValue="selectedItems.includes(item.value)"
                @update:modelValue="toggleCheckbox(item.value)"
                class="checkbox__item"
              />
            </div>

            <!-- Кастомный слайдер -->
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

                <!-- Контейнер слайдера -->
                <div
                  class="slider__track"
                  @click="onTrackClick"
                  @mousedown="onDragStart"
                  @touchstart="onDragStart"
                >
                  <!-- Прогресс (заполненная часть) -->
                  <div
                    class="slider__progress"
                    :style="{ width: `${(insuranceSum / max) * 100}%` }"
                  ></div>

                  <!-- Ползунок -->
                  <div
                    class="slider__thumb"
                    :style="{ left: `${(insuranceSum / max) * 100}%` }"
                  ></div>
                </div>

                <!-- Мин/макс подпись -->
                <div class="slider__min">0 ₽</div>
                <div class="slider__max">30 000 000 ₽</div>
              </div>
            </div>

            <div class="quiz__buttons">
              <button class="btn btn-light" :disabled="currentStep === 1">
                ← Назад
              </button>
              <button class="btn btn-primary" @click="goNext">
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
                <TheCheckbox
                  v-model="formData.agree"
                  label="Даю согласие на обработку персональных данных в соответствии с <a href='https://codeseven.ru/pdf/opd.pdf' target='_blank'>Политикой конфиденциальности</a>"
                />
              </div>
            </form>

            <div class="quiz__buttons">
              <button class="btn btn-light" @click="goBack">← Назад</button>
              <button class="btn btn-primary" @click="submitForm">
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
      </main>
    </div>
  </div>
</template>

<script>
import TheCheckbox from "./UI/TheCheckbox.vue";
import TheInput from "./UI/TheInput.vue";

export default {
  components: {
    TheCheckbox,
    TheInput,
  },
  name: "TheQuizInsurance",
  data() {
    return {
      currentStep: 1,
      selectedItems: ["construction"],
      insuranceSum: 115000,
      min: 0,
      max: 30000000,
      isDragging: false,
      trackRect: null,
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
        const num = parseInt(newValue);
        this.insuranceSum = Math.max(this.min, Math.min(this.max, num));
      }
    },
    onTrackClick(event) {
      const track = this.$el.querySelector(".slider__track");
      const rect = track.getBoundingClientRect();
      const percent = (event.clientX - rect.left) / rect.width;
      this.insuranceSum = Math.round(
        this.min + percent * (this.max - this.min)
      );
      this.insuranceSum = Math.max(
        this.min,
        Math.min(this.max, this.insuranceSum)
      );
    },
    onDragStart(event) {
      event.preventDefault();
      this.isDragging = true;
      const track = this.$el.querySelector(".slider__track");
      this.trackRect = track.getBoundingClientRect();

      document.addEventListener("mousemove", this.onDragMove);
      document.addEventListener("mouseup", this.onDragEnd);
      document.addEventListener("touchmove", this.onDragMove);
      document.addEventListener("touchend", this.onDragEnd);

      const clientX =
        event.type === "touchstart" ? event.touches[0].clientX : event.clientX;
      this.onDragMove({ clientX });
    },
    onDragMove(event) {
      if (!this.isDragging) return;
      const clientX =
        event.type === "touchmove" ? event.touches[0].clientX : event.clientX;
      const { left, width } = this.trackRect;
      const percent = (clientX - left) / width;
      let value = Math.round(this.min + percent * (this.max - this.min));
      value = Math.max(this.min, Math.min(this.max, value));
      this.insuranceSum = value;
    },
    onDragEnd() {
      if (!this.isDragging) return;
      this.isDragging = false;
      this.trackRect = null;

      document.removeEventListener("mousemove", this.onDragMove);
      document.removeEventListener("mouseup", this.onDragEnd);
      document.removeEventListener("touchmove", this.onDragMove);
      document.removeEventListener("touchend", this.onDragEnd);
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
};
</script>

<style lang="scss" scoped>
.quiz {
  color: #333;
  margin: 0 auto;
  max-width: 1200px;
  padding: 20px;
  &__header {
    text-align: center;
    margin-bottom: 30px;
  }
  &__title {
    font-size: 24px;
    margin: 0;
  }
  &__main {
    display: flex;
    gap: 30px;
  }
  &__left {
    background: white;
    padding: 20px;
  }
  &__right {
    background: #f8f9fa;
    padding: 20px;
  }
  &__subtitle {
    font-size: 18px;
    margin: 0 0 20px 0;
  }
  &__buttons {
    display: flex;
    justify-content: space-between;
    gap: 10px;
  }
}

.quiz__left,
.quiz__right {
  flex: 1;
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.logo {
  color: red;
  font-size: 14px;
  margin-bottom: 5px;

  &_color_primary {
    color: red;
  }
}

.step-title {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 20px;

  &__number {
    color: rgba(var(--text), 0.6);
    font-size: 14px;
  }

  &__name {
    font-size: 14px;
    color: rgba(var(--text), 0.6);
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
    background: rgba(var(--text), 0.1);
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
    background: rgb(var(--primary));
    border-radius: 3px;
    transition: width 0.3s ease;
  }
}

.checkbox {
  margin-bottom: 20px;
  &__item {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
    cursor: pointer;
  }
}

.slider {
  margin-bottom: 30px;
  &__label {
    font-size: 14px;
    margin-bottom: 10px;
    color: #dedede;
  }

  &__input {
    position: relative;
    width: 100%;
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
    font-size: 20px;
    font-weight: 500;
    color: rgb(var(--primary));
  }

  &__edit-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 14px;
    color: rgb(var(--primary));
  }

  &__track {
    position: relative;
    width: 100%;
    height: 4px;
    background: rgba(var(--text), 0.1);
    border-radius: 4px;
    cursor: pointer;
  }

  &__progress {
    position: absolute;
    top: 0;
    left: 0;
    height: 4px;
    width: 0;
    background: rgb(var(--primary));
    border-radius: 4px;
    transition: width 0.1s ease;
  }

  &__thumb {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    left: 0;
    width: 20px;
    height: 20px;
    background: white;
    border: 1px solid rgb(var(--primary));
    border-radius: 50%;
    cursor: pointer;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: center;
    &:after {
      content: "";
      display: block;
      width: 0.7em;
      height: 0.7em;
      background-color: rgb(var(--primary));
      border-radius: 50%;
    }
  }

  &__min,
  &__max {
    position: absolute;
    bottom: -20px;
    font-size: 14px;
    margin-top: 20px;
    color: rgba(var(--text), 0.6);
  }

  &__min {
    left: 0;
  }

  &__max {
    right: 0;
  }
}

.form {
  &__group {
    margin-bottom: 16px;
  }
  &__label {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
    color: #dedede;
  }
  &__link {
    color: red;
    text-decoration: underline;
  }
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
    border: 1px solid red;

    .summary__header {
      color: red;
    }
  }

  &__header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 500;
    font-size: 14px;
    color: #dedede;
  }

  &__arrow_rotate {
    transform: rotate(180deg);
  }

  &__details {
    margin-top: 8px;
    padding-top: 8px;
    border-top: 1px solid rgb(var(--border));
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
    border-top: 1px solid rgb(var(--border));
  }
}

@media (max-width: 900px) {
  .quiz__main {
    flex-direction: column;
  }
}
</style>
