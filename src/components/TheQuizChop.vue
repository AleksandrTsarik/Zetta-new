<template>
  <div class="quiz">
    <div class="quiz__head">
      <span class="span-primary">Полис Zetta</span>
      <h2 class="quiz__title title">Оформить полис</h2>
    </div>
    <div class="quiz__container">
      <div class="quiz__left">
        <h3>Полис страхования ЧОП</h3>
        <div class="quiz__steps">
          <div class="progress-bar">
            <div class="progress-bar__labels">
              <span
                v-for="(step, idx) in steps"
                :key="idx"
                class="progress-bar__label"
                :class="{
                  'progress-bar__label_active': currentStep >= idx + 1,
                }"
              >
                {{ step.title }}
              </span>
            </div>

            <div class="progress-bar__track">
              <div class="progress-bar__divider" style="left: 25%"></div>
              <div class="progress-bar__divider" style="left: 50%"></div>
              <div class="progress-bar__divider" style="left: 75%"></div>

              <div
                class="progress-bar__fill"
                :style="{ width: `${getProgressWidth()}%` }"
              ></div>
            </div>
          </div>
        </div>

        <div v-if="currentStep === 1" class="quiz__step-content">
          <div class="form-group form-group-slider">
            <div class="slider">
              <div class="slider__label">Страховая сумма полиса</div>
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
                    min="0"
                    :max="max"
                    autofocus
                  />
                </div>
                <div
                  class="slider__track"
                  @click="onTrackClick"
                  @mousedown="startDrag"
                  @touchstart="startDrag"
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
                <div class="slider__max">15 000 000 ₽</div>
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
                  class="radio-item__input"
                />
                <span class="radio-item__checked"></span>
                <span class="radio-item__name">{{ option.label }}</span>
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
                  class="radio-item__input"
                />
                <span class="radio-item__checked"></span>
                <span class="radio-item__name">{{ option.label }}</span>
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
                  class="radio-item__input"
                />
                <span class="radio-item__checked"></span>
                <span class="radio-item__name">{{ option.label }}</span>
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
                  class="radio-item__input"
                />
                <span class="radio-item__checked"></span>
                <span class="radio-item__name">{{ option.label }}</span>
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
                  class="radio-item__input"
                />
                <span class="radio-item__checked"></span>
                <span class="radio-item__name">{{ option.label }}</span>
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

        <div v-else-if="currentStep === 3" class="quiz__step-content">
          <div class="form-group">
            <label class="form-label">Заявление на страхование ЧОП</label>
            <p class="form-note">(Скачать шаблон заявления)</p>
            <div class="file-upload">
              <button class="btn btn-border-primary" @click="triggerFileInput">
                <svg
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M20.3333 15.3333V19.5C20.3333 19.721 20.2455 19.933 20.0893 20.0893C19.933 20.2455 19.721 20.3333 19.5 20.3333H4.5C4.27899 20.3333 4.06702 20.2455 3.91074 20.0893C3.75446 19.933 3.66667 19.721 3.66667 19.5V15.3333H2V19.5C2 20.163 2.26339 20.7989 2.73223 21.2678C3.20107 21.7366 3.83696 22 4.5 22H19.5C20.163 22 20.7989 21.7366 21.2678 21.2678C21.7366 20.7989 22 20.163 22 19.5V15.3333H20.3333Z"
                    fill="#7D51FE"
                  />
                  <path
                    d="M11.9725 2.00001C11.6443 1.9991 11.3192 2.06297 11.0158 2.18796C10.7123 2.31294 10.4365 2.49657 10.2042 2.72834L6.93833 5.99417L8.11667 7.17251L11.145 4.14501L11.1667 17.8333H12.8333L12.8117 4.15668L15.8275 7.17251L17.0058 5.99417L13.74 2.72834C13.5078 2.4966 13.2322 2.31297 12.9289 2.18799C12.6255 2.063 12.3005 1.99912 11.9725 2.00001Z"
                    fill="#7D51FE"
                  />
                </svg>
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

        <div v-else-if="currentStep === 4" class="quiz__step-content">
          <div class="form-group">
            <label class="form-label"
              >Заполните данные для оформления полиса</label
            >
            <form class="form-fields" @submit.prevent="submitForm">
              <!-- Скрытые поля -->
              <input
                type="hidden"
                name="companyName"
                :value="formData.companyName"
              />
              <input type="hidden" name="inn" :value="formData.inn" />
              <input type="hidden" name="phone" :value="formData.phone" />
              <input type="hidden" name="email" :value="formData.email" />
              <input
                type="hidden"
                name="price"
                :value="formatCurrency(totalCost)"
              />
              <input
                type="hidden"
                name="data"
                :value="JSON.stringify(payload)"
              />

              <!-- Видимые поля -->
              <TheInput
                v-model="formData.companyName"
                type="text"
                placeholder="Наименование юр. лица"
                required
              />
              <TheInput
                v-model="formData.inn"
                type="text"
                placeholder="ИНН"
                v-mask="'##########'"
                @input="formatInn"
                :invalid="innError"
                required
              />
              <TheInput
                v-model="phoneDisplay"
                type="tel"
                placeholder="Контактный номер"
                v-mask="'+7 (###) ###-##-##'"
                @input="formatPhone"
                :invalid="phoneError"
                required
              />
              <TheInput
                v-model="formData.email"
                type="email"
                placeholder="Электронная почта"
                required
              />

              <div class="form-group">
                <TheCheckbox
                  v-model="formData.agree"
                  label="Даю согласие на обработку персональных данных в соответствии с <a href='https://codeseven.ru/pdf/opd.pdf' target='_blank'>Политикой конфиденциальности</a>"
                />
              </div>

              <div class="quiz__buttons">
                <button class="btn btn-light" @click="goBack">← Назад</button>
                <button
                  class="btn btn-primary"
                  type="submit"
                  :disabled="!isFormValid"
                >
                  Оформить полис
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="quiz__right">
        <div
          class="summary-card"
          @click="toggleDetails('details')"
          :class="{ active: showDetails }"
        >
          <div class="summary-card__header">
            <span>Наполнение полиса</span>
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M17.293 15.2069L12 9.91388L6.70697 15.2069L5.29297 13.7929L10.586 8.49988C10.961 8.12494 11.4696 7.91431 12 7.91431C12.5303 7.91431 13.0389 8.12494 13.414 8.49988L18.707 13.7929L17.293 15.2069Z"
                fill="#141517"
              />
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

        <div
          class="summary-card"
          @click="toggleDetails('cost')"
          :class="{ active: showCost }"
        >
          <div class="summary-card__header">
            <span>Детали</span>
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M17.293 15.2069L12 9.91388L6.70697 15.2069L5.29297 13.7929L10.586 8.49988C10.961 8.12494 11.4696 7.91431 12 7.91431C12.5303 7.91431 13.0389 8.12494 13.414 8.49988L18.707 13.7929L17.293 15.2069Z"
                fill="#141517"
              />
            </svg>
          </div>
          <div v-show="showCost" class="summary-card__body">
            <div class="summary-card__item">
              <span>Страховая сумма</span>
              <span>{{ formatCurrency(insuranceSum) }}</span>
            </div>
          </div>
          <div class="summary-card__total">
            <span>Итого:</span>
            <span>{{ formatCurrency(totalCost) }}</span>
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
  components: {
    TheCheckbox,
    TheInput,
  },
  data() {
    return {
      tempInsuranceSum: 0,
      isEditingSum: false,
      phoneDisplay: "",
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

      steps: [
        { title: "1 шаг. Расчёт" },
        { title: "2 шаг. Дополнительно" },
        { title: "3 шаг. Заявление" },
        { title: "4 шаг. Оформление" },
      ],
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
    payload() {
      return {
        experience: this.getExperienceLabel(this.selectedExperience),
        objects: this.getObjectsLabel(this.selectedObjects),
        liability: this.getLiabilityLabel(this.selectedLiability),
        franchise: this.getFranchiseLabel(this.selectedFranchise),
        financialRisk: this.getFinancialRiskLabel(this.selectedFinancialRisk),
      };
    },
  },

  methods: {
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
    formatPhone(event) {
      const value = event.target.value;
      if (!value) return;
      const digits = value.replace(/\D/g, "");
      const cleaned = digits[0] !== "7" ? "7" + digits : digits.slice(0, 11);
      this.formData.phone = cleaned;
    },
    formatInn(event) {
      const value = event.target.value;
      if (!value) return;
      const digits = value.replace(/\D/g, "").slice(0, 12);
      this.formData.inn = digits;
    },
    submitForm(event) {
      if (!this.isFormValid) {
        alert("Пожалуйста, заполните все поля корректно.");
        return;
      }

      const formData = new FormData(event.target);

      if (this.uploadedFile) {
        formData.append("file", this.uploadedFile);
      }

      fetch("/php/api/mailer-chop.php", {
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
            this.showSuccess = true;
          } else {
          }
        })
        .catch((error) => {});
    },
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
    // startDrag(event) {
    //   event.preventDefault();
    //   this.isDragging = true;
    //   const rect = this.$el
    //     .querySelector(".slider-container")
    //     .getBoundingClientRect();
    //   this.trackRect = rect;

    //   document.addEventListener("mousemove", this.onDragMove);
    //   document.addEventListener("mouseup", this.onDragEnd);
    //   document.addEventListener("touchmove", this.onDragMove);
    //   document.addEventListener("touchend", this.onDragEnd);

    //   const clientX =
    //     event.type === "touchstart" ? event.touches[0].clientX : event.clientX;
    //   this.onDragMove({ clientX });
    // },
    startDrag(event) {
      event.preventDefault();
      this.isDragging = true;
      const rect = this.$el
        .querySelector(".slider__track")
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
      this.phoneDisplay = "";
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
.form-fields {
  margin: 20px 0 0;
  .block-input {
    margin-bottom: 20px;
  }
}
.quiz {
  .btn-border-primary {
    display: flex;
    align-content: center;
    gap: 5px;
    svg {
      height: 1.2em;
      margin-top: -2px;
    }
  }
  &__head {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 16px;
    margin-bottom: 30px;
    span {
      position: relative;
    }
  }
  &__left {
    background: white;
    h3 {
      margin-bottom: 24px;
      font-size: 28px;
      font-weight: 500;
    }
  }
  &__container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    @media (max-width: 1023px) {
      grid-template-columns: 1fr;
      gap: 20px;
    }
  }

  &__left,
  &__right {
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 24px;
    flex: 1;
  }
  &__right {
    @media (max-width: 767px) {
      padding: 16px;
    }
  }
  &__steps {
    margin-bottom: 20px;
  }
  &__step-content {
    margin-top: 40px;
  }
  &__buttons {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-top: 24px;
    @media (max-width: 374px) {
      flex-wrap: wrap;
    }
    button {
      white-space: nowrap;
      @media (max-width: 374px) {
        flex-grow: 1;
      }
    }
  }
}

.progress-bar {
  width: 100%;
  height: 6px;
  background: transparent;
  border-radius: 3px;
  position: relative;

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
    background: rgb(var(--white));
    z-index: 1;
    border-radius: 2px;
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
    color: rgba(var(--text), 0.6);
  }

  &__label {
    text-align: left;
    flex: 1;
    transition: color 0.3s ease;
    font-size: 10px;
    margin-bottom: 5px;
    &_active {
      font-weight: 500;
    }
  }
}

.form-group {
  margin-bottom: 20px;
  &:first-child {
    margin-top: 20px;
  }
}

.form-label {
  font-size: 18px;
  font-weight: 600;
  color: rgb(var(--text));
  margin: 10px 0 10px;
}

.form-note {
  font-size: 12px;
  color: #999;
  margin-bottom: 12px;
}

.radio-group {
  margin-top: 8px;
}

.radio-label {
  font-size: 14px;
  color: #333;
}

.file-upload {
  margin-top: 12px;
}

.file-preview {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-top: 8px;
  padding: 8px;

  border-radius: 6px;
  font-size: 12px;
  color: #333;
}

.btn-close {
  background: none;
  border: none;
  font-size: 14px;
  cursor: pointer;
}

// .quiz__buttons {
//   display: flex;
//   justify-content: space-between;
//   gap: 10px;
//   margin-top: 24px;
//   @media (max-width: 374px) {
//     flex-wrap: wrap;
//   }
//   button {
//     white-space: nowrap;
//     @media (max-width: 374px) {
//       flex-grow: 1;
//     }
//   }
// }

.summary-card {
  border-radius: 8px;
  overflow: hidden;
  background: rgb(var(--white));

  padding: 16px;
  margin-bottom: 16px;
  box-shadow: 0 1px 4px rgba(var(--text), 0.1);
  cursor: pointer;
  transition: all 0.3s ease;
  &:last-child {
    margin-bottom: 0;
  }
  &.active {
    .summary-card__header svg {
      transform: rotate(180deg);
    }
  }
  &__header {
    display: flex;
    justify-content: space-between;
    align-items: center;

    font-size: 14px;
    font-weight: 500;
    background: rgb(var(--white));
    cursor: pointer;
  }

  &__arrow_rotate {
    transform: rotate(180deg);
  }

  &__body {
    margin-top: 16px;
  }

  &__item {
    display: grid;
    grid-template-columns: 40% auto;
    justify-content: space-between;
    margin-bottom: 8px;
    gap: 10px;
    font-size: 14px;
    color: rgb(var(--text));
    @media (max-width: 575px) {
      font-size: 10px;
    }
    span {
      display: block;
      &:last-child {
        text-align: right;
      }
    }
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
  .quiz__container {
    flex-direction: column;
  }
}
</style>
