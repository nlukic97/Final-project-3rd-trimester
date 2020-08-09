<template>
  <div v-if="CookiePromptDisplay">
    <v-card id="cookieBanner" class="pt-0 pr-0 pb-0 pl-0">
      <div class="d-flex justify-center  align-center red pt-5 pb-5">
        <span class="ml-5 mr-10 white--text">Our site uses cookies. By browsing this site, you consent to the use of these cookies.</span>
        <v-btn
        class="white red--text mr-5"
        @click="toggleCookiePrompt"
        >
          OK
        </v-btn>
      </div>
    </v-card>
  </div>
</template>
<script>
export default {
  name:'CookieBanner',
  data(){
    return {
      CookiePromptDisplay:true
    }
  },
  methods: {
    toggleCookiePrompt(){
      if(this.CookiePromptDisplay == true){
        this.CookiePromptDisplay = false;
      }
    },

    acceptedCookieCheck(){
      console.log('This will read if these is a cookie. It will store the answer in var ans');
      var ans = 'cookie not present';
      if(ans == 'cookie present'){
        this.CookiePromptDisplay = false;
      }
    }
  },
  beforeMount() {
    this.acceptedCookieCheck()
  }
}
</script>
<style scoped lang="scss">
  #cookieBanner {
    margin:0;
    padding:0 ;
    position:fixed;
    top:86vh; //this needs to be different for some screens sizes
    left:0;
    width:100%;
    z-index: 1000;
  }
</style>