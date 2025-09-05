<template>
  <div class="quiz">
    <div class="quiz__container">
      <!-- Шапка -->
      <div class="quiz__header">
        <span class="span-primary">Полис Zetta</span>
        <h1 class="quiz__title">Оформить полис</h1>
      </div>

      <!-- Основной контент -->
      <div class="quiz__main">
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
                :modelValue="selectedItems.includes(item.label)"
                @update:modelValue="toggleCheckbox(item.label)"
                class="checkbox__item"
              />
            </div>

            <!-- Слайдер -->
            <div class="slider">
              <div class="slider__label">Введите страховую сумму полиса</div>
              <div class="slider__input">
                <div class="slider__value-wrapper">
                  <span class="slider__value">{{
                    formatCurrency(insuranceSum)
                  }}</span>
                  <!-- <button @click="editSum" class="slider__edit-btn">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                      <path
                        d="M13.897 3.915C14.25 4.268 14.25 4.852 13.897 5.205L11.52 7.582L13.897 9.959C14.25 10.312 14.25 10.896 13.897 11.249C13.544 11.602 12.96 11.602 12.607 11.249L10.23 8.872L7.853 11.249C7.499 11.602 6.915 11.602 6.562 11.249C6.209 10.896 6.209 10.312 6.562 9.959L8.939 7.582L6.562 5.205C6.209 4.852 6.209 4.268 6.562 3.915C6.915 3.562 7.499 3.562 7.853 3.915L10.23 6.292L12.607 3.915C12.96 3.562 13.544 3.562 13.897 3.915Z"
                        fill="#8D7FFF"
                      />
                    </svg>
                  </button> -->
                </div>

                <div
                  class="slider__track"
                  @click="onTrackClick"
                  @mousedown="onDragStart"
                  @touchstart="onDragStart"
                >
                  <div
                    class="slider__progress"
                    :style="{ width: `${(insuranceSum / max) * 100}%` }"
                  ></div>
                  <div
                    class="slider__thumb"
                    :style="{ left: `${(insuranceSum / max) * 100}%` }"
                  ></div>
                </div>
                <div class="slider__min">0 ₽</div>
                <div class="slider__max">30 000 000 ₽</div>
              </div>
            </div>

            <div class="quiz__buttons">
              <button class="btn btn-light" disabled>← Назад</button>
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
            <form
              class="form"
              method="post"
              @submit.prevent="calculateInsuranceSubmit"
            >
              <input type="hidden" name="material[]" :value="selectedItems" />
              <input
                type="hidden"
                name="price"
                :value="formatCurrency(totalCost)"
              />

              <div
                class="form__group"
                v-for="(field, key) in formFields"
                :key="key"
              >
                <!-- ИНН -->
                <TheInput
                  v-if="key === 'inn'"
                  v-model="inn"
                  :type="field.type"
                  :placeholder="field.label"
                  :invalid="innError"
                />
                <!-- Телефон -->
                <TheInput
                  v-else-if="key === 'phone'"
                  v-model="phone"
                  :type="field.type"
                  :placeholder="field.label"
                  :invalid="phoneError"
                  @focus="onPhoneFocus"
                  @blur="onPhoneBlur"
                />
                <!-- Остальные поля -->
                <TheInput
                  v-else
                  v-model="formData[key]"
                  :type="field.type"
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

              <div class="quiz__buttons">
                <button class="btn btn-light" @click="goBack">← Назад</button>
                <button
                  class="btn btn-primary"
                  :disabled="!isFormValid"
                  :class="{ 'btn-disabled': !isFormValid }"
                >
                  Оформить полис
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Правая колонка -->
        <div class="quiz__right">
          <div
            class="summary"
            :class="{ active: isDetailsOpen }"
            @click="toggleDetails()"
          >
            <div class="summary__header">
              <span>Наполнение полиса</span>
              <svg
                :class="{ summary__arrow_rotate: isDetailsOpen }"
                width="14"
                height="8"
                viewBox="0 0 14 8"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M6.99997 7.50003C6.73736 7.50049 6.47725 7.44904 6.23459 7.34865C5.99192 7.24825 5.7715 7.10089 5.58597 6.91503L0.292969 1.62103L1.70697 0.207031L6.99997 5.50003L12.293 0.207031L13.707 1.62103L8.41397 6.91403C8.22852 7.10007 8.00813 7.24762 7.76547 7.34819C7.5228 7.44875 7.26265 7.50036 6.99997 7.50003Z"
                  fill="#141517"
                />
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

          <div
            class="summary"
            :class="{ active: detailsOpen }"
            @click="toggleDetails('details')"
          >
            <div class="summary__header">
              <span>Детали</span>
              <svg
                :class="{ summary__arrow_rotate: detailsOpen }"
                width="14"
                height="8"
                viewBox="0 0 14 8"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M6.99997 7.50003C6.73736 7.50049 6.47725 7.44904 6.23459 7.34865C5.99192 7.24825 5.7715 7.10089 5.58597 6.91503L0.292969 1.62103L1.70697 0.207031L6.99997 5.50003L12.293 0.207031L13.707 1.62103L8.41397 6.91403C8.22852 7.10007 8.00813 7.24762 7.76547 7.34819C7.5228 7.44875 7.26265 7.50036 6.99997 7.50003Z"
                  fill="#141517"
                />
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
      selectedItems: ["Конструктивные элементы и инженерное оборудование"],
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
      phoneInput: "", // форматированный ввод
      phoneRaw: "", // только цифры
      showPhoneRaw: false,
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
          name: "companyName",
          type: "text",
          required: true,
        },
        inn: {
          label: "ИНН",
          name: "inn",
          type: "text",
          required: true,
        },
        phone: {
          label: "Контактный номер",
          name: "phone",
          type: "tel",
          required: true,
        },
        email: {
          label: "Электронная почта",
          name: "mail",
          type: "email",
          required: true,
        },
      },
    };
  },
  computed: {
    totalCost() {
      const base = this.insuranceSum;
      const multiplier = this.selectedItems.length > 1 ? 0.05 : 0;
      return Math.round(base * (1 + multiplier));
    },
    phoneError() {
      return this.formData.phone.length !== 11;
    },
    innError() {
      return this.formData.inn.length !== 10 && this.formData.inn.length !== 12;
    },
    phone: {
      get() {
        if (this.showPhoneRaw) {
          return this.phoneRaw;
        }
        return this.phoneInput;
      },
      set(value) {
        let digits = value.replace(/\D/g, "");
        if (digits.length === 0) {
          digits = "";
        } else if (digits[0] !== "7") {
          digits = "7" + digits.replace(/^7*/, "");
        } else {
          digits = digits.slice(0, 1) + digits.slice(1).replace(/^7*/, "");
        }
        digits = digits.slice(0, 11);

        this.phoneRaw = digits;

        if (!this.showPhoneRaw) {
          let formatted = "";
          if (digits) {
            formatted = "+7";
            if (digits.length > 1) formatted += " (" + digits.slice(1, 4);
            if (digits.length >= 4) formatted += ") " + digits.slice(4, 7);
            if (digits.length >= 7) formatted += "-" + digits.slice(7, 9);
            if (digits.length >= 9) formatted += "-" + digits.slice(9, 11);
          }
          this.phoneInput = formatted;
        }

        this.formData.phone = digits;
      },
    },
    inn: {
      get() {
        return this.formData.inn;
      },
      set(value) {
        const digits = value.replace(/\D/g, "").slice(0, 12);
        this.formData.inn = digits;
      },
    },
    isFormValid() {
      const { companyName, inn, phone, email, agree } = this.formData;
      const emailRegex = /^\S+@\S+\.\S+$/;
      const validInn = inn.length === 10 || inn.length === 12;
      const validPhone = phone.length === 11;

      return (
        companyName.trim() !== "" &&
        validInn &&
        validPhone &&
        emailRegex.test(email) &&
        agree
      );
    },
  },
  methods: {
    calculateInsuranceSubmit($event) {
      const formData = new FormData($event.target);
      for (let [key, value] of formData.entries()) {
        console.log(key, "=", value);
      }
      console.groupEnd();

      fetch("/api/mailer.php", { method: "POST", body: formData })
        .then((res) => res.json())
        .then((data) => {
          this.resetForm(); //Очистка формы
        })
        .catch((err) => {
          // console.error("Ошибка отправки:", err);
        });
    },

    // ✅ Сброс формы
    resetForm() {
      // Сбрасываем шаг
      this.currentStep = 1;

      // Очищаем основные поля
      this.formData = {
        companyName: "",
        inn: "",
        phone: "",
        email: "",
        agree: false,
      };

      // Сбрасываем маски телефона
      this.phoneInput = "";
      this.phoneRaw = "";
      this.showPhoneRaw = false;

      // Можно сбросить сумму, если нужно
      // this.insuranceSum = 115000;

      // Сбрасываем чекбоксы (кроме первого по умолчанию)
      this.selectedItems = [
        "Конструктивные элементы и инженерное оборудование",
      ];

      // Закрываем детали
      this.isDetailsOpen = true;
      this.detailsOpen = true;
    },

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
    onPhoneFocus() {
      this.showPhoneRaw = true;
      this.$nextTick(() => {
        this.phoneInput = this.phoneRaw;
      });
    },
    onPhoneBlur() {
      this.showPhoneRaw = false;
      // Не вызываем this.phone = this.phoneRaw
    },
  },
};
</script>

<style lang="scss" scoped>
/* Без изменений */
.quiz {
  color: #333;
  margin: 0 auto;
  max-width: 1200px;
  padding: 20px;
  &__header {
    text-align: center;
    margin-bottom: 30px;
    span {
      position: relative;
      margin-bottom: 20px;
    }
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
  margin-bottom: 60px;
  &__label {
    font-size: 16px;
    margin-bottom: 10px;
    color: rgb(var(--text));
  }

  &__input {
    position: relative;
    width: 100%;
  }
  &__track {
    margin: 10px auto;
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
    bottom: -30px;
    font-size: 14px;
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

  &__link {
    color: red;
    text-decoration: underline;
  }
}

.summary {
  background: rgb(var(--white));
  border-radius: 8px;
  padding: 16px;
  margin-bottom: 16px;
  box-shadow: 0 1px 4px rgba(var(--text), 0.1);
  cursor: pointer;
  transition: all 0.3s ease;

  &.active {
    border: 1px solid rgba(var(--text), 0.2);

    .summary__header {
      color: rgb(var(--text));
    }
  }

  &__header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 600;
    font-size: 16px;
    //color: rgba(var(--text), 0.6);
  }

  &__arrow_rotate {
    transform: rotate(180deg);
  }

  &__details {
    margin-top: 8px;
    padding-top: 8px;
    border-top: 1px solid rgb(var(--border));
    transition: 0.3s;
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

.btn-disabled {
  opacity: 0.5;
  cursor: not-allowed;
  pointer-events: none;
}

@media (max-width: 900px) {
  .quiz__main {
    flex-direction: column;
  }
}
</style>
