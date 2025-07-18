<template>
  <div>
    <Banner :descr="bannerDescription" />
  </div>
  <div></div>
</template>

<script>
import Banner from "../components/TheBanner.vue";
export default {
  components: {
    Banner,
  },
  data() {
    return {
      bannerDescription: {
        img: "/img/bgBanner/item1.webp",
        alt: "picture",
        title:
          "<span class='color-primary'>ОСГОП такси</span> — защита пассажиров и бизнеса",
        subtitle:
          "Оформите обязательное страхование гражданской ответственности перевозчика онлайн за пару минут. ",
        url: "https://zettains.ru/calculators/osgop/?utm_source=2512541&utm_medium=9519741456&utm_campaign=9510823705",
        //--данный url тлько для ОСГОП!!!!!
        list: [
          {
            title: "ФЗ № 67-ФЗ",
            text: "Соответствие требованиям ФЗ",
          },
          {
            title: "Срок 1 год",
            text: "Действителен в течение года",
          },
          {
            title: "до 2 025 000 ₽",
            text: "Максимальные выплаты",
          },
        ],
      },
    };
  },
};
</script>

<style lang="scss"></style>
