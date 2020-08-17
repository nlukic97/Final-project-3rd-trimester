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
  ul {
    border:1px solid #333;
    background-color: white;
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
}
</style>