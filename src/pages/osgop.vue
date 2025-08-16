<template>
  <section class="section">
    <Banner :descr="bannerDescription" />
  </section>
  <section class="section">
    <Choice
      :choiceInfo="choiceDescription"
      title="Почему полис от Code7?"
      subtitle="Выбирая Code7 Страхование, вы получаете надежного партнера, который делает процесс оформления страховых полисов максимально простым и удобным."
    />
  </section>
  <section class="section">
    <Osgop />
  </section>
</template>

<script>
import Banner from "../components/TheBanner.vue";
import Choice from "../components/TheChoice.vue";
import Osgop from "../components/TheOsgopDescription.vue";
export default {
  components: {
    Banner,
    Choice,
    Osgop,
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
      choiceDescription: [
        {
          name: "Простота оформления",
          text: "Полностью онлайн — от заполнения заявки до получения полиса на email.",
        },
        {
          name: "Соотвествие ФЗ РФ",
          text: "Полис соответствует требованиям Федерального закона № 67-ФЗ.",
        },
        {
          name: "Минимум усилий",
          text: "Отсутствие необходимости в предъявлении документов для оформления онлайн.",
        },
        {
          name: "Надёжная поддержка",
          text: "Наша команда всегда на связи, чтобы помочь с любыми вопросами.",
        },
      ],
    };
  },
};
</script>

<style lang="scss"></style>
