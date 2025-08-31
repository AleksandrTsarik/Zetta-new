<template>
  <div class="quiz">
    <!-- Логотип -->
    <div class="quiz__logo-wrapper">
      <span class="logo logo_color_primary">Полис Zetta</span>
    </div>

    <!-- Заголовок -->
    <h1 class="quiz__title">Оформить полис</h1>

    <!-- Основной контейнер -->
    <div class="quiz__container">
      <!-- Левая колонка: форма -->
      <div class="quiz__left">
        <!-- Прогресс-бар (шаги) -->
        <div class="quiz__steps">
          <div class="progress-bar">
            <div class="progress-bar__track">
              <div class="progress-bar__divider"></div>
              <div class="progress-bar__divider"></div>
              <div class="progress-bar__divider"></div>
              <div
                class="progress-bar__fill"
                :style="{ width: `${getProgressWidth()}%` }"
              ></div>
            </div>
            <div class="progress-bar__labels">
              <span
                class="progress-bar__label"
                :class="{ active: currentStep >= 1 }"
                >1 шаг: Расчёт</span
              >
              <span
                class="progress-bar__label"
                :class="{ active: currentStep >= 2 }"
                >2 шаг: Дополнительно</span
              >
              <span
                class="progress-bar__label"
                :class="{ active: currentStep >= 3 }"
                >3 шаг: Заявление</span
              >
              <span
                class="progress-bar__label"
                :class="{ active: currentStep >= 4 }"
                >4 шаг: Оформление</span
              >
            </div>
          </div>
        </div>

        <!-- Шаг 1: Расчёт -->
        <div v-if="currentStep === 1" class="quiz__step-content">
          <div class="form-group">
            <label class="form-label">Страховая сумма полиса</label>
            <div class="slider-wrapper">
              <div class="slider-value">
                <span class="slider-value__amount">{{
                  formatCurrency(insuranceSum)
                }}</span>
                <button @click="editSum" class="slider-value__edit">
                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path
                      d="M13.897 3.915C14.25 4.268 14.25 4.852 13.897 5.205L11.52 7.582L13.897 9.959C14.25 10.312 14.25 10.896 13.897 11.249C13.544 11.602 12.96 11.602 12.607 11.249L10.23 8.872L7.853 11.249C7.499 11.602 6.915 11.602 6.562 11.249C6.209 10.896 6.209 10.312 6.562 9.959L8.939 7.582L6.562 5.205C6.209 4.852 6.209 4.268 6.562 3.915C6.915 3.562 7.499 3.562 7.853 3.915L10.23 6.292L12.607 3.915C12.96 3.562 13.544 3.562 13.897 3.915Z"
                      fill="#8D7FFF"
                    />
                  </svg>
                </button>
              </div>
              <div
                class="slider-container"
                @click="onTrackClick"
                @mousedown="startDrag"
                @touchstart="startDrag"
              >
                <div class="slider-track"></div>
                <div
                  class="slider-progress"
                  :style="{ width: `${(insuranceSum / max) * 100}%` }"
                ></div>
                <div
                  class="slider-thumb"
                  :style="{ left: `${(insuranceSum / max) * 100}%` }"
                ></div>
              </div>
              <div class="slider-minmax">
                <span class="slider-min">0 ₽</span>
                <span class="slider-max">15 000 000 ₽</span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label"
              >Стаж деятельности объекта страхования</label
            >
            <div class="radio-group">
              <label
                v-for="(option, idx) in experienceOptions"
                :key="idx"
                class="radio-item"
                @click="selectExperience(idx)"
              >
                <input
                  type="radio"
                  :checked="selectedExperience === idx"
                  class="radio-input"
                />
                <span class="radio-label">{{ option.label }}</span>
              </label>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Количество объектов</label>
            <div class="radio-group">
              <label
                v-for="(option, idx) in objectsOptions"
                :key="idx"
                class="radio-item"
                @click="selectObjects(idx)"
              >
                <input
                  type="radio"
                  :checked="selectedObjects === idx"
                  class="radio-input"
                />
                <span class="radio-label">{{ option.label }}</span>
              </label>
            </div>
          </div>

          <div class="quiz__buttons">
            <button class="btn btn-light" disabled>← Назад</button>
            <button class="btn btn-primary" @click="goNext">
              Продолжить →
            </button>
          </div>
        </div>

        <!-- Шаг 2: Дополнительно -->
        <div v-else-if="currentStep === 2" class="quiz__step-content">
          <div class="form-group">
            <label class="form-label"
              >Лимит ответственности на каждый страховой случай</label
            >
            <div class="radio-group">
              <label
                v-for="(option, idx) in liabilityOptions"
                :key="idx"
                class="radio-item"
                @click="selectLiability(idx)"
              >
                <input
                  type="radio"
                  :checked="selectedLiability === idx"
                  class="radio-input"
                />
                <span class="radio-label">{{ option.label }}</span>
              </label>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Включение франшизы</label>
            <div class="radio-group">
              <label
                v-for="(option, idx) in franchiseOptions"
                :key="idx"
                class="radio-item"
                @click="selectFranchise(idx)"
              >
                <input
                  type="radio"
                  :checked="selectedFranchise === idx"
                  class="radio-input"
                />
                <span class="radio-label">{{ option.label }}</span>
              </label>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Включение финансовых рисков</label>
            <div class="radio-group">
              <label
                v-for="(option, idx) in financialRiskOptions"
                :key="idx"
                class="radio-item"
                @click="selectFinancialRisk(idx)"
              >
                <input
                  type="radio"
                  :checked="selectedFinancialRisk === idx"
                  class="radio-input"
                />
                <span class="radio-label">{{ option.label }}</span>
              </label>
            </div>
          </div>

          <div class="quiz__buttons">
            <button class="btn btn-light" @click="goBack">← Назад</button>
            <button class="btn btn-primary" @click="goNext">
              Продолжить →
            </button>
          </div>
        </div>

        <!-- Шаг 3: Заявление -->
        <div v-else-if="currentStep === 3" class="quiz__step-content">
          <div class="form-group">
            <label class="form-label">Заявление на страхование ЧОП</label>
            <p class="form-note">(Скачать шаблон заявления)</p>
            <div class="file-upload">
              <button class="btn btn-outline" @click="triggerFileInput">
                Выберите файл
              </button>
              <input
                type="file"
                ref="fileInput"
                @change="onFileChange"
                style="display: none"
              />
              <div v-if="uploadedFile" class="file-preview">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                  <path
                    d="M4 12H12V14H4V12ZM4 8H12V10H4V8ZM4 4H12V6H4V4Z"
                    fill="currentColor"
                  />
                </svg>
                <span>{{ uploadedFile.name }}</span>
                <button @click="removeFile" class="btn-close">×</button>
              </div>
            </div>
          </div>

          <div class="quiz__buttons">
            <button class="btn btn-light" @click="goBack">← Назад</button>
            <button class="btn btn-primary" @click="goNext">
              Продолжить →
            </button>
          </div>
        </div>

        <!-- Шаг 4: Оформление -->
        <div v-else-if="currentStep === 4" class="quiz__step-content">
          <div class="form-group">
            <label class="form-label"
              >Заполните данные для оформления полиса</label
            >
            <div class="form-fields">
              <TheInput
                v-model="formData.companyName"
                placeholder="Наименование юр. лица"
              />
              <TheInput v-model="formData.inn" placeholder="ИНН" />
              <TheInput
                v-model="formData.phone"
                placeholder="Контактный номер"
              />
              <TheInput
                v-model="formData.email"
                placeholder="Электронная почта"
              />
            </div>
          </div>

          <div class="form-group">
            <TheCheckbox
              v-model="formData.agree"
              label="Даю согласие на обработку персональных данных в соответствии с <a href='https://codeseven.ru/pdf/opd.pdf' target='_blank'>Политикой конфиденциальности</a>"
            />
          </div>

          <div class="quiz__buttons">
            <button class="btn btn-light" @click="goBack">← Назад</button>
            <button class="btn btn-primary" @click="submitForm">
              Оформить полис
            </button>
          </div>
        </div>
      </div>

      <!-- Правая колонка: детали и итого -->
      <div class="quiz__right">
        <div class="summary-card">
          <div class="summary-card__header" @click="toggleDetails('details')">
            <span>Наполнение полиса</span>
            <svg
              :class="{ 'summary-card__arrow_rotate': showDetails }"
              width="12"
              height="12"
              viewBox="0 0 12 12"
              fill="none"
            >
              <path d="M6 3L9 6L6 9L3 6L6 3Z" fill="currentColor" />
            </svg>
          </div>
          <div v-show="showDetails" class="summary-card__body">
            <div class="summary-card__item">
              <span>Стаж</span>
              <span>{{ getExperienceLabel(selectedExperience) }}</span>
            </div>
            <div class="summary-card__item">
              <span>Количество объектов</span>
              <span>{{ getObjectsLabel(selectedObjects) }}</span>
            </div>
            <div v-if="currentStep >= 2" class="summary-card__item">
              <span>Лимит ответственности</span>
              <span>{{ getLiabilityLabel(selectedLiability) }}</span>
            </div>
            <div v-if="currentStep >= 2" class="summary-card__item">
              <span>Франшиза</span>
              <span>{{ getFranchiseLabel(selectedFranchise) }}</span>
            </div>
            <div v-if="currentStep >= 2" class="summary-card__item">
              <span>Финансовые риски</span>
              <span>{{ getFinancialRiskLabel(selectedFinancialRisk) }}</span>
            </div>
          </div>
        </div>

        <div class="summary-card">
          <div class="summary-card__header" @click="toggleDetails('cost')">
            <span>Детали</span>
            <svg
              :class="{ 'summary-card__arrow_rotate': showCost }"
              width="12"
              height="12"
              viewBox="0 0 12 12"
              fill="none"
            >
              <path d="M6 3L9 6L6 9L3 6L6 3Z" fill="currentColor" />
            </svg>
          </div>
          <div v-show="showCost" class="summary-card__body">
            <div class="summary-card__item">
              <span>Страховая сумма</span>
              <span>{{ formatCurrency(insuranceSum) }}</span>
            </div>
            <div class="summary-card__total">
              <span>Итого:</span>
              <span>{{ formatCurrency(totalCost) }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Уведомление о успехе -->
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
  components: {
    TheCheckbox,
    TheInput,
  },
  data() {
    return {
      currentStep: 1,
      insuranceSum: 115000,
      min: 0,
      max: 15000000,
      isDragging: false,
      trackRect: null,
      selectedExperience: 2,
      selectedObjects: 2,
      selectedLiability: 2,
      selectedFranchise: 0,
      selectedFinancialRisk: 0,
      uploadedFile: null,
      formData: {
        companyName: "",
        inn: "",
        phone: "",
        email: "",
        agree: false,
      },
      showDetails: true,
      showCost: true,
      showSuccess: false,

      experienceOptions: [
        { label: "от 1 года, но не более 3 лет" },
        { label: "от 4 лет, но не более 7 лет" },
        { label: "7 лет и более" },
      ],
      objectsOptions: [
        { label: "До 10" },
        { label: "11 – 50" },
        { label: "51 – 100" },
        { label: "Более 100" },
      ],
      liabilityOptions: [
        { label: "Без установления лимита" },
        { label: "В размере 50% от общей страховой суммы" },
        { label: "В размере 30% от общей страховой суммы" },
        { label: "В размере 10% от общей страховой суммы" },
      ],
      franchiseOptions: [
        { label: "Без франшизы" },
        { label: "10 000 ₽" },
        { label: "30 000 ₽" },
        { label: "50 000 ₽" },
        { label: "100 000 ₽" },
      ],
      financialRiskOptions: [
        {
          label:
            "Страховая сумма по финансовым рискам устанавливается в размере до 5% от страховой суммы по страхованию гражданской ответственности",
        },
        {
          label:
            "Исключение из договора страхования финансовых рисков (судебных издержек)",
        },
      ],
    };
  },

  computed: {
    totalCost() {
      const base = this.insuranceSum;
      let multiplier = 0;

      if (this.selectedExperience === 0) multiplier += 0.05;
      if (this.selectedExperience === 1) multiplier += 0.03;
      if (this.selectedExperience === 2) multiplier += 0.01;

      if (this.selectedObjects === 0) multiplier += 0.02;
      if (this.selectedObjects === 1) multiplier += 0.01;
      if (this.selectedObjects === 2) multiplier += 0.005;
      if (this.selectedObjects === 3) multiplier += 0.002;

      if (this.selectedLiability === 0) multiplier += 0.05;
      if (this.selectedLiability === 1) multiplier += 0.02;
      if (this.selectedLiability === 2) multiplier += 0.01;
      if (this.selectedLiability === 3) multiplier += 0.005;

      if (this.selectedFranchise === 0) multiplier += 0.01;
      if (this.selectedFranchise === 1) multiplier -= 0.01;
      if (this.selectedFranchise === 2) multiplier -= 0.02;
      if (this.selectedFranchise === 3) multiplier -= 0.03;
      if (this.selectedFranchise === 4) multiplier -= 0.05;

      if (this.selectedFinancialRisk === 0) multiplier += 0.02;

      return Math.round(base * (1 + multiplier));
    },
  },

  methods: {
    getProgressWidth() {
      return (this.currentStep - 1) * 25;
    },

    goBack() {
      if (this.currentStep > 1) this.currentStep--;
    },
    goNext() {
      if (this.currentStep < 4) this.currentStep++;
    },

    editSum() {
      const newValue = prompt("Введите новую сумму:", this.insuranceSum);
      if (newValue && !isNaN(newValue)) {
        const num = parseInt(newValue);
        this.insuranceSum = Math.max(this.min, Math.min(this.max, num));
      }
    },

    onTrackClick(event) {
      const rect = this.$el
        .querySelector(".slider-container")
        .getBoundingClientRect();
      const percent = (event.clientX - rect.left) / rect.width;
      this.insuranceSum = Math.round(
        this.min + percent * (this.max - this.min)
      );
      this.insuranceSum = Math.max(
        this.min,
        Math.min(this.max, this.insuranceSum)
      );
    },

    startDrag(event) {
      event.preventDefault();
      this.isDragging = true;
      const rect = this.$el
        .querySelector(".slider-container")
        .getBoundingClientRect();
      this.trackRect = rect;

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
      const value = Math.round(this.min + percent * (this.max - this.min));
      this.insuranceSum = Math.max(this.min, Math.min(this.max, value));
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

    selectExperience(idx) {
      this.selectedExperience = idx;
    },
    selectObjects(idx) {
      this.selectedObjects = idx;
    },
    selectLiability(idx) {
      this.selectedLiability = idx;
    },
    selectFranchise(idx) {
      this.selectedFranchise = idx;
    },
    selectFinancialRisk(idx) {
      this.selectedFinancialRisk = idx;
    },

    toggleDetails(type) {
      if (type === "details") this.showDetails = !this.showDetails;
      else this.showCost = !this.showCost;
    },

    triggerFileInput() {
      this.$refs.fileInput.click();
    },
    onFileChange(event) {
      const file = event.target.files[0];
      if (file) this.uploadedFile = file;
    },
    removeFile() {
      this.uploadedFile = null;
    },

    submitForm() {
      if (!this.formData.agree) {
        alert("Вы должны дать согласие на обработку данных.");
        return;
      }
      this.showSuccess = true;
    },

    closeSuccess() {
      this.showSuccess = false;
      this.currentStep = 1;
      this.resetForm();
    },

    resetForm() {
      this.formData = {
        companyName: "",
        inn: "",
        phone: "",
        email: "",
        agree: false,
      };
      this.uploadedFile = null;
    },

    formatCurrency(value) {
      return new Intl.NumberFormat("ru-RU", {
        style: "currency",
        currency: "RUB",
        minimumFractionDigits: 0,
      }).format(value);
    },

    getExperienceLabel(idx) {
      return this.experienceOptions[idx]?.label || "";
    },
    getObjectsLabel(idx) {
      return this.objectsOptions[idx]?.label || "";
    },
    getLiabilityLabel(idx) {
      return this.liabilityOptions[idx]?.label || "";
    },
    getFranchiseLabel(idx) {
      return this.franchiseOptions[idx]?.label || "";
    },
    getFinancialRiskLabel(idx) {
      return this.financialRiskOptions[idx]?.label || "";
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
  font-family: "Inter", sans-serif;
}

.quiz__logo-wrapper {
  text-align: center;
  margin-bottom: 16px;
}

.logo {
  font-size: 14px;
  color: #8d7fff;
  font-weight: 500;
}

.quiz__title {
  text-align: center;
  font-size: 28px;
  margin: 0 0 20px 0;
  font-weight: 600;
}

.quiz__container {
  display: flex;
  gap: 24px;
  margin-top: 20px;
}

.quiz__left,
.quiz__right {
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  background: white;
  padding: 24px;
  flex: 1;
}

// Прогресс-бар (шаги)
.quiz__steps {
  margin-bottom: 24px;
  position: relative;
}

.progress-bar {
  position: relative;
  width: 100%;
  height: 6px;
  background: transparent;
  border-radius: 3px;
  overflow: hidden;
  margin-bottom: 8px;

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
    width: 2px;
    height: 100%;
    background: white;
    z-index: 1;
    border-radius: 2px;

    &:nth-child(1) {
      left: 25%;
    }
    &:nth-child(2) {
      left: 50%;
    }
    &:nth-child(3) {
      left: 75%;
    }
  }

  &__fill {
    height: 100%;
    background: rgb(var(--primary));
    border-radius: 3px;
    transition: width 0.3s ease;
  }

  &__labels {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: #999;
    margin-top: 8px;
  }

  &__label {
    cursor: default;
    padding: 4px 0;
    transition: color 0.3s ease;

    &.active {
      color: rgb(var(--primary));
      font-weight: 500;
    }
  }
}

.form-group {
  margin-bottom: 24px;
}

.form-label {
  font-size: 14px;
  color: #333;
  margin-bottom: 8px;
}

.form-note {
  font-size: 12px;
  color: #999;
  margin-bottom: 12px;
}

// Слайдер
.slider-wrapper {
  margin-bottom: 16px;
}

.slider-value {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 8px;
  font-size: 16px;
  font-weight: 500;
  color: #8d7fff;
}

.slider-value__amount {
  font-size: 16px;
  font-weight: 500;
}

.slider-value__edit {
  background: none;
  border: none;
  cursor: pointer;
  color: #8d7fff;
  font-size: 12px;
}

.slider-container {
  position: relative;
  height: 4px;
  background: #e0e0e0;
  border-radius: 2px;
  overflow: hidden;
  cursor: pointer;
}

.slider-track {
  width: 100%;
  height: 100%;
  background: #e0e0e0;
}

.slider-progress {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  background: #8d7fff;
  border-radius: 2px;
  transition: width 0.1s ease;
}

.slider-thumb {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  left: 0;
  width: 16px;
  height: 16px;
  background: white;
  border: 2px solid #8d7fff;
  border-radius: 50%;
  z-index: 2;
  display: flex;
  align-items: center;
  justify-content: center;

  &:after {
    content: "";
    display: block;
    width: 6px;
    height: 6px;
    background-color: #8d7fff;
    border-radius: 50%;
  }
}

.slider-minmax {
  display: flex;
  justify-content: space-between;
  font-size: 12px;
  color: #999;
  margin-top: 8px;
}

.slider-min {
  left: 0;
}

.slider-max {
  right: 0;
}

// Радио-группы
.radio-group {
  margin-top: 8px;
}

.radio-item {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 8px 0;
  cursor: pointer;
}

.radio-input {
  appearance: none;
  width: 16px;
  height: 16px;
  border: 2px solid #ccc;
  border-radius: 50%;
  cursor: pointer;

  &:checked {
    background: #8d7fff;
    border-color: #8d7fff;

    &:after {
      content: "";
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 6px;
      height: 6px;
      background: white;
      border-radius: 50%;
    }
  }
}

.radio-label {
  font-size: 14px;
  color: #333;
}

// Файл
.file-upload {
  margin-top: 12px;
}

.btn {
  padding: 10px 20px;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  border: none;
  transition: all 0.2s ease;

  &.btn-light {
    background: #f5f5f5;
    color: #333;
    border: 1px solid #ddd;
  }

  &.btn-primary {
    background: #8d7fff;
    color: white;
  }

  &.btn-outline {
    background: transparent;
    color: #8d7fff;
    border: 1px solid #8d7fff;
  }

  &:disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }
}

.file-preview {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-top: 8px;
  padding: 8px;
  background: #f0f0ff;
  border-radius: 6px;
  font-size: 12px;
  color: #333;
}

.btn-close {
  background: none;
  border: none;
  font-size: 14px;
  cursor: pointer;
  color: #999;
}

// Кнопки
.quiz__buttons {
  display: flex;
  justify-content: space-between;
  gap: 10px;
  margin-top: 24px;
}

// Сводка
.summary-card {
  margin-bottom: 16px;
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  overflow: hidden;

  &__header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 16px;
    font-size: 14px;
    font-weight: 500;
    background: #f8f9fa;
    border-bottom: 1px solid #e0e0e0;
    cursor: pointer;
  }

  &__arrow_rotate {
    transform: rotate(180deg);
  }

  &__body {
    padding: 16px;
  }

  &__item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    font-size: 14px;
    color: #333;
  }

  &__total {
    display: flex;
    justify-content: space-between;
    font-weight: 600;
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid #e0e0e0;
  }
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

// Адаптив
@media (max-width: 900px) {
  .quiz__container {
    flex-direction: column;
  }
}
</style>
