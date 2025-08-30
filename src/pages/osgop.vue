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
    <DqscriptionQ :descriptionQuestion="descriptionQuestion" />
  </section>

  <section class="section">
    <Pay />
  </section>

  <section class="section">
    <Order
      :orderInfo="orderDescription"
      title="Как оформить?"
      orderLink="https://zettains.ru/calculators/osgop/?utm_source=2512541&utm_medium=9519741456&utm_campaign=9510823705"
    />
  </section>

  <section class="section section-bg">
    <Tab />
  </section>
</template>

<script>
import Banner from "../components/TheBanner.vue";
import Choice from "../components/TheChoice.vue";
import Pay from "../components/ThePay.vue";
import Order from "../components/TheOrder.vue";
import Tab from "../components/TheExtra.vue";
import DqscriptionQ from "../components/TheQuestion.vue";
export default {
  components: {
    Banner,
    Choice,
    Pay,
    Order,
    Tab,
    DqscriptionQ,
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
        btn: "Оформить онлайн",
        target: true,
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
      orderDescription: [
        {
          name: "Проверка разрешения на перевозку",
          text: "<p>Убедитесь, что у вас есть действующее разрешение. Проверьте его на сайте .<a target='_blank' href='https://sicmt.ru/fgis-taksi'>ФГИС «Такси»</a></p>",
        },
        {
          name: "Оформление заявления",
          text: "Укажите данные перевозчика, такси и пассажиров при оформлении заявления на сайте. Оформление занимает 5-7 минут",
        },
        {
          name: "Оплата",
          text: "После оформления заявления необходимо оплатить полис ОСГОП по появившейся ссылке, выбрав удобный вариант оплаты.",
          attention:
            "Ссылка на оплату дейтсвует 20 минут. Если не успели оплатить, необходимо заново оформить заявления на получение полиса.",
        },
        {
          name: "Получение полиса",
          text: "После подтверждения и оплаты полис будет отправлен на указанный Вами Email в течение 2-4 часов.",
        },
      ],
      descriptionQuestion: {
        title: "Что такое ОСГОП такси?",
        text: "<p>Договор ОСГОП такси защищает имущественные интересы перевозчика в случае причинения вреда жизни, здоровью или имуществу пассажиров.</p><p>Размер выплаты зависит от характера травм и установлен Законодательством.</p>",
        atention:
          "Договор ОСГОП такси заключается, если есть разрешение на перевозчика. Наличие разрешения можно проверить на сайте <a href='https://sicmt.ru/fgis-taksi' target='_blank'> ФГИС «Такси»</a> в разделе «Перевозчики»",
        warning: "",
        anhor: "",
      },
    };
  },
};
</script>

<style lang="scss"></style>
