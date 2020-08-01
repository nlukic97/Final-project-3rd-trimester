<template>
<!-- Obrati paznju na ovaj padding top sto si stavio ovde ispod -->
  <v-app-bar id="theBar" height="80" class="pt-3" 
      app
      color="#ffffff"
      dark
    >
      
      <router-link to="/" class="text-decoration-none mr-2">
        <v-btn 
          color="secondary"
          text
        >
        <span class="black--text">Home</span>
        </v-btn>
      </router-link>
      

      <router-link to="/about" class="text-decoration-none mr-2">
        <v-btn 
          color="secondary"
          text
        >
        <span class="black--text">About</span>
        </v-btn>
      </router-link>

      <v-card class="d-flex justify-space-around red align-center" flat width="250" min-height="80" id="logo">
        <v-img id="logo-img-1" 
        class="ml-5"
        contain
        src='../assets/fish-white.png'
        max-width="35"
        >
        </v-img>

        <!-- <v-card max-width="50%" class="red" flat> -->
        <h2 id="logo-text">Hillingdon chippie</h2>
        <!-- </v-card> -->

        <v-img id="logo-img-2" 
        class="mr-5"
        contain
        src='../assets/fish-white.png'
        max-width="35"
        >
        </v-img>
      </v-card>      

      <!-- <v-spacer></v-spacer> -->
      <router-link to="/faq" class="text-decoration-none ml-2">
        <v-btn 
          color="secondary"
          text
        >
        <span class="black--text">FAQ</span>
        </v-btn>
      </router-link>
      
      <router-link to="/order" class="text-decoration-none ml-2">
        <v-btn 
          color="secondary"
          text
        >
        <span class="black--text">Order</span>
        </v-btn>
      </router-link>
    </v-app-bar>
</template>
<script>
export default {
  name: 'Nav'
}
</script>
<style lang="scss">
.v-toolbar__content {
  width:100%;
  display:flex;
  justify-content: center;
}

#logo {
  border-radius: 0;
  line-height: 1.2;
  #logo-text {
    max-width: 120px;
  }
  #logo-img-1 {
  transform: rotate(-40deg);
  }
  #logo-img-2 {
  transform: rotate(130deg);
  }
}




</style>