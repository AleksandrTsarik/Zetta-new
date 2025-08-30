<template>
  <section class="section"><Banner :descr="bannerDescription" /></section>

  <section class="section">
    <DqscriptionQ :descriptionQuestion="descriptionQuestion1" />
  </section>

  <section class="section">
    <Possible />
  </section>

  <section class="section">
    <DqscriptionQ :descriptionQuestion="descriptionQuestion2" />
  </section>

  <section class="section" id="order-policy">asdassd</section>
</template>

<script>
import Banner from "../components/TheBanner.vue";
import DqscriptionQ from "../components/TheQuestion.vue";
import Possible from "../components/ThePossibleChop.vue";
export default {
  components: {
    Banner,
    DqscriptionQ,
    Possible,
  },
  data() {
    return {
      bannerDescription: {
        img: "/img/bgBanner/item3.webp",
        alt: "picture",
        title:
          "<span class='color-primary'>Страхование ЧОП</span> — защита финансов от риска",
        subtitle:
          "Защита интересов компаний и их клиентов при оказании охранных услуг.",
        url: "#order-policy",
        btn: "Рассчитать стоимость",
        target: true,
        list: [
          {
            title: "Защита",
            text: "Покрытие ущерба охранных услуг",
          },
          {
            title: "Гибкость",
            text: "Индивидуальные условия по сумме.",
          },
          {
            title: "Экономия",
            text: "Оптимальные тарифы от 0,2%.",
          },
        ],
      },
      descriptionQuestion1: {
        title: "Что такое полис страхования ЧОП?",
        text: "<p>Продукт обеспечивает страхование ответственности частных охранных предприятий (ЧОП) за имущественный вред, причинённый третьим лицам при оказании охранных услуг.</p>",
        warning:
          "Также возможно включение в покрытие финансовых рисков, связанных с судебными и внесудебными расходами.",
      },
      descriptionQuestion2: {
        title: "Кому подойдёт?",
        text: "<p>Продукт разработан для частных охранных предприятий, имеющих действующую лицензию МВД РФ.</p>",
        warning:
          "Заключить договор может как сам ЧОП, так и лицо, ответственное за организацию охранной деятельности.",
        anhor: "#order-policy",
      },
    };
  },
};
</script>

<style lang="scss" scoped></style>
