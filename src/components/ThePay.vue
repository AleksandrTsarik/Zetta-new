<template>
  <div class="pay-block">
    <div class="pay-block__container">
      <div class="pay-block__list">
        <div class="pay-block__item">
          <span></span>
          <div class="pay-block__img"></div>
          <div class="pay-block__info">
            <div class="pay-block__ico"></div>
            <div class="pay-block__name">
              <p></p>
              <p></p>
            </div>
            <div class="pay-block__text"></div>
          </div>
        </div>
        <div class="pay-block__item">
          <div class="pay-block__descr" v-for="(item, i) in descr" :key="i">
            <div class="pay-block__descr-head">
              {{ item.name }}
              <span>
                <svg
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <g clip-path="url(#clip0_3118_1565)">
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M7.99091 13.6618V12.1636H9.03091V7H10.18H10.7836H12.9945C13.0479 7 13.1521 7.00242 13.3073 7.00727C13.4673 7.01212 13.6442 7.02909 13.8382 7.05818C14.4394 7.1503 14.9364 7.35151 15.3291 7.66182C15.7267 7.97212 16.02 8.36485 16.2091 8.84C16.403 9.3103 16.5 9.82909 16.5 10.3964C16.5 11.2642 16.2794 11.9818 15.8382 12.5491C15.397 13.1164 14.7303 13.4679 13.8382 13.6036C13.6442 13.6279 13.4673 13.6448 13.3073 13.6545C13.1521 13.6594 13.0479 13.6618 12.9945 13.6618H10.7836V14.6727H14.1945V16.0473H10.7836V17.4727H9.03091V16.0473H7.99091V14.6727H9.03091V13.6618H7.99091ZM13.2055 12.1564C13.0939 12.1612 12.9994 12.1636 12.9218 12.1636H10.7836V8.64364H12.9218C12.9848 8.64364 13.0794 8.64606 13.2055 8.65091C13.3364 8.65576 13.4649 8.67515 13.5909 8.70909C13.877 8.78182 14.1024 8.9103 14.2673 9.09455C14.437 9.27879 14.5558 9.49212 14.6236 9.73455C14.6964 9.97212 14.7327 10.2097 14.7327 10.4473C14.7327 10.84 14.643 11.1842 14.4636 11.48C14.2842 11.7709 13.9933 11.9721 13.5909 12.0836C13.4503 12.1224 13.3218 12.1467 13.2055 12.1564Z"
                      fill="currentColor"
                    />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M12 0C5.383 0 0 5.383 0 12C0 18.617 5.383 24 12 24C18.617 24 24 18.617 24 12C24 5.383 18.617 0 12 0ZM2 12C2 17.514 6.486 22 12 22C17.514 22 22 17.514 22 12C22 6.486 17.514 2 12 2C6.486 2 2 6.486 2 12Z"
                      fill="currentColor"
                    />
                  </g>
                  <defs>
                    <clipPath id="clip0_3118_1565">
                      <rect width="24" height="24" fill="white" />
                    </clipPath>
                  </defs>
                </svg>
              </span>
            </div>
            <div class="pay-block__descr-body">
              <p>{{ item.text }}</p>
              <p v-if="item.snock">{{ item.snock }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      descr: [
        {
          name: "до 2 025 000 ₽",
          text: "Вред жизни пассажира",
        },
        {
          name: "до 2 000 000 ₽",
          text: "Вред здоровью пассажира",
          snock: "в зависимости от тяжести травм.",
        },
        {
          name: "до 23 000 ₽",
          text: "Вред имуществу пассажира",
          snock: "с учётом стоимости повреждений.",
        },
      ],
    };
  },
};
</script>

<style lang="scss" scoped></style>
