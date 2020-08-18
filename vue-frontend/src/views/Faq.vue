<template>
  <div class="faq">
    <h2 class="pt-6 pb-3">FAQ</h2>
    <v-container>
      <v-card 
      class="white dark--text pt-8 pb-6 pl-8 pr-8 mb-5 text-left"
      v-for="(faq, index) in faqs" :key="index"
      >
        <h3>{{index + 1}}. {{faq.question}}</h3>
        <p class="pl-4">{{faq.answer}}</p>
      </v-card>
    </v-container>
  </div>
</template>
<script>
import Axios from 'axios'
export default {
  name: 'faq',
  data(){
    return {
      faqs: []
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
.faq {
  background-color: #f1efef;
}
</style>