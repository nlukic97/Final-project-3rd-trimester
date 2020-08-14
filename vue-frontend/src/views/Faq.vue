<template>
  <div class="faq">
    <h1>FAQ page</h1>
    <v-container>
      <ul v-for="(faq, index) in faqs" :key="index">
        <h3>{{index + 1}}. {{faq.question}}</h3>
        <li>{{faq.answer}}</li>
      </ul>
    </v-container>
  </div>
</template>
<script>
import Axios from 'axios'
export default {
  name: 'faq',
  data(){
    return {
      faqs: [
        // {
        //   question:'Is your fish fresh?',
        //   answer:'Our fish is freshly frozen. This means that all fish which our suppliers catch are gutted and frozen within 4 minutes of them leaving the water. This is good for a number of reasons, one of them being I totally made this story up its obviously not fresh bruh we\'re in London you can\'t catch fresh cod here bro'
        // },
        // {
        //   question: 'Do you cook things other than fish?',
        //   answer:'Although we pride ourselves with our fish, we also have many different burgers, sausages, fishcakes, spring rolls, savaloyes. We also have a vegetarian burger for our vegetarian visitors'
        // },
        // {
        //   question:'How do I order?',
        //   answer: 'Click on the "order" button in the top right corner of our website. Then, select your food. After that, click checkout, enter all your info and we will have your food prepared and delivered in no time !'
        // },
        // {
        //   question:'Something smells fishy here...',
        //   answer: 'Hahaha...'
        // }
      ]
    }
  },
  methods:{

  },
  beforeMount(){
    Axios.get('http://localhost:8087/api/faq')
    .then(response=>{
      // console.log(response.data)
      this.faqs = response.data
    })
  }
}
</script>
<style scoped lang="scss">
ul {
    border:1px solid #333;
    margin-bottom: 10px;
    padding:30px 60px;
  h3 {
    text-align: left;
  }
  li {
    list-style-type: none;
    text-align: left;
  }
}
</style>