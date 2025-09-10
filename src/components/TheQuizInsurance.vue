<!-- TheQuizInsurance.vue -->
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
                  <span
                    v-if="!isEditingSum"
                    class="slider__value"
                    @click="startEditingSum"
                    style="cursor: pointer; user-select: none"
                  >
                    {{ formatCurrency(insuranceSum) }}
                    <span
                      class="slider__edit-icon"
                      style="margin-left: 6px; font-size: 12px; opacity: 0.7"
                      ><svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M20.2052 3.79505C19.6954 3.28594 19.0043 3 18.2837 3C17.5632 3 16.8721 3.28594 16.3622 3.79505L3 17.157V21H6.84306L20.2052 7.63803C20.7142 7.12805 21 6.43701 21 5.71654C21 4.99607 20.7142 4.30503 20.2052 3.79505ZM6.22505 19.5H4.50002V17.775L14.4827 7.80003L16.2077 9.52503L6.22505 19.5ZM19.1447 6.57754L17.2645 8.45778L15.5432 6.73279L17.4227 4.85554C17.6515 4.62679 17.9617 4.49828 18.2852 4.49828C18.6087 4.49828 18.919 4.62679 19.1477 4.85554C19.3765 5.08429 19.505 5.39454 19.505 5.71804C19.505 6.04154 19.3765 6.35179 19.1477 6.58054L19.1447 6.57754Z"
                          fill="#7D51FE"
                        />
                      </svg>
                    </span>
                  </span>

                  <input
                    v-else
                    v-model.number="tempInsuranceSum"
                    @keyup.enter="saveEditedSum"
                    @blur="saveEditedSum"
                    class="slider__input-edit"
                    type="number"
                    :min="min"
                    :max="max"
                    autofocus
                  />
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
            <form class="form" @submit.prevent="calculateInsuranceSubmit">
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
                  v-model="formData.inn"
                  :type="field.type"
                  :placeholder="field.label"
                  :invalid="innError"
                  :name="key"
                />
                <!-- Телефон с маской -->
                <TheInput
                  v-else-if="key === 'phone'"
                  v-model="formData.phone"
                  v-mask="'+7 (###) ###-##-##'"
                  :type="field.type"
                  :placeholder="field.label"
                  :invalid="phoneError"
                  :name="key"
                />
                <!-- Остальные поля -->
                <TheInput
                  v-else
                  v-model="formData[key]"
                  :type="field.type"
                  :placeholder="field.label"
                  :invalid="false"
                  :name="key"
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

    <div v-if="showSuccess" class="success-modal">
      <div class="success-modal__content">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
          <circle
            cx="20"
            cy="20"
            r="16"
            stroke="#8D7FFF"
            stroke-width="4"
            fill="none"
          />
          <path
            d="M14 20L18 24L26 16"
            stroke="#8D7FFF"
            stroke-width="4"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
        <h3>Спасибо! Запрос отправлен</h3>
        <p>
          В ближайшее время мы свяжемся с вами для уточнения информации и
          условий оплаты.
        </p>
        <button class="btn btn-primary" @click="closeSuccess">Хорошо</button>
      </div>
    </div>
  </div>
</template>

<script>
import TheCheckbox from "./UI/TheCheckbox.vue";
import TheInput from "./UI/TheInput.vue";

export default {
  components: { TheCheckbox, TheInput },
  name: "TheQuizInsurance",
  data() {
    return {
      isEditingSum: false,
      tempInsuranceSum: 0,
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
      isDetailsOpen: true,
      detailsOpen: true,
      showSuccess: false,
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
    phoneError() {
      return this.formData.phone.length !== 11;
    },
    innError() {
      return this.formData.inn.length !== 10 && this.formData.inn.length !== 12;
    },
    isFormValid() {
      const { companyName, inn, phone, email, agree } = this.formData;
      const emailRegex = /^\S+@\S+\.\S+$/;
      return (
        companyName.trim() !== "" &&
        (inn.length === 10 || inn.length === 12) &&
        phone.length === 11 &&
        emailRegex.test(email) &&
        agree
      );
    },
  },
  methods: {
    closeSuccess() {
      this.showSuccess = false;
      this.currentStep = 1;
      this.resetForm();
    },
    startEditingSum() {
      this.tempInsuranceSum = this.insuranceSum;
      this.isEditingSum = true;
      this.$nextTick(() => {
        const input = this.$el.querySelector(".slider__input-edit");
        if (input) input.focus();
      });
    },

    saveEditedSum() {
      let value = Math.max(this.min, Math.min(this.max, this.tempInsuranceSum));
      this.insuranceSum = Math.round(value);
      this.isEditingSum = false;
    },
    calculateInsuranceSubmit($event) {
      const formData = new FormData($event.target);
      formData.append("material", JSON.stringify(this.selectedItems));
      formData.set("price", this.formatCurrency(this.totalCost));

      fetch("/api/mailer.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          if (!response.ok) throw new Error(`Ошибка: ${response.status}`);
          return response.text();
        })
        .then((text) => {
          let data;
          try {
            data = JSON.parse(text);
          } catch (e) {
            return;
          }

          if (data.success) {
            // this.resetForm();
            this.showSuccess = true;
          } else {
            // Можно добавить уведомление об ошибке
          }
        })
        .catch((error) => {
          // Можно добавить уведомление об ошибке сети
        });
    },

    resetForm() {
      this.currentStep = 1;
      this.formData = {
        companyName: "",
        inn: "",
        phone: "",
        email: "",
        agree: false,
      };
      this.selectedItems = [
        "Конструктивные элементы и инженерное оборудование",
      ];
      this.isDetailsOpen = true;
      this.detailsOpen = true;
    },

    closeSuccess() {
      this.showSuccess = false;
      this.resetForm();
    },

    toggleCheckbox(value) {
      const i = this.selectedItems.indexOf(value);
      i === -1
        ? this.selectedItems.push(value)
        : this.selectedItems.splice(i, 1);
    },

    toggleDetails(type) {
      if (type === "details") this.detailsOpen = !this.detailsOpen;
      else this.isDetailsOpen = !this.isDetailsOpen;
    },

    goBack() {
      if (this.currentStep > 1) this.currentStep--;
    },

    goNext() {
      if (this.currentStep < 2) this.currentStep++;
    },

    onTrackClick(e) {
      const track = this.$el.querySelector(".slider__track");
      const rect = track.getBoundingClientRect();
      const percent = (e.clientX - rect.left) / rect.width;
      this.insuranceSum = Math.round(
        this.min + percent * (this.max - this.min)
      );
    },

    onDragStart(e) {
      e.preventDefault();
      this.isDragging = true;
      this.trackRect = this.$el
        .querySelector(".slider__track")
        .getBoundingClientRect();
      const move = (e) => {
        const clientX = e.touches?.[0]?.clientX || e.clientX;
        const percent = (clientX - this.trackRect.left) / this.trackRect.width;
        this.insuranceSum = Math.max(
          this.min,
          Math.min(
            this.max,
            Math.round(this.min + percent * (this.max - this.min))
          )
        );
      };
      const up = () => {
        this.isDragging = false;
        document.removeEventListener("mousemove", move);
        document.removeEventListener("mouseup", up);
        document.removeEventListener("touchmove", move);
        document.removeEventListener("touchend", up);
      };
      document.addEventListener("mousemove", move);
      document.addEventListener("mouseup", up);
      document.addEventListener("touchmove", move, { passive: true });
      document.addEventListener("touchend", up);
    },

    formatCurrency(value) {
      return new Intl.NumberFormat("ru-RU", {
        style: "currency",
        currency: "RUB",
        minimumFractionDigits: 0,
      }).format(value);
    },

    getLabel(key) {
      return this.checkboxItems.find((i) => i.value === key)?.label || key;
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
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    @media (max-width: 767px) {
      grid-template-columns: 1fr;
      gap: 20px;
    }
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
// Успех
.success-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.success-modal__content {
  background: white;
  padding: 32px;
  border-radius: 12px;
  text-align: center;
  max-width: 400px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.success-modal__content svg {
  margin-bottom: 16px;
}

.success-modal__content h3 {
  font-size: 18px;
  margin: 0 0 12px 0;
  font-weight: 600;
}

.success-modal__content p {
  color: #666;
  font-size: 14px;
  margin-bottom: 24px;
}
@media (max-width: 900px) {
  .quiz__main {
    flex-direction: column;
  }
}
</style>
