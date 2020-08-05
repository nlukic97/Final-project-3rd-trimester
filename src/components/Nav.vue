<template>
<!-- Obrati paznju na ovaj padding top sto si stavio ovde ispod -->
  <div>
    <!-- regular menu -->
    <v-app-bar id="theBar" height="100"  
      app
      hide-on-scroll
      flat
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
        <h3 id="logo-text">Hillingdon chippie</h3>
        <!-- </v-card> -->

        <v-img id="logo-img-2" 
        class="mr-5"
        contain
        src='../assets/fish-white.png'
        max-width="35"
        >
        </v-img>
      </v-card>      

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

    <!--mobile menu -->
    <div class="text-left pt-5 pl-2" id="mobile-menu" >
      <v-menu 
      offset-y
      close-on-click
      close-on-content-click
      >
        <template v-slot:activator="{ on, attrs }"  >
          <v-btn style="width:30%"
            color="red"
            dark
            v-bind="attrs"
            v-on="on"
          >
            Menu
          </v-btn>
        </template>
        <v-list
        
        >
          <v-list-item
            id="mobile-menu-list"
            v-for="(item, index) in menuItems"
            :key="index"
          >
            <router-link :to="item.route"
            class="black--text text-decoration-none">
              <v-list-item-title>{{ item.name }}</v-list-item-title>
            </router-link>
          </v-list-item>
        </v-list>
      </v-menu>
    </div>
  </div>
  
    
</template>
<script>
export default {
  name: 'Nav',
  data(){
    return {
      menuItems:[
        {
          name:'Home',
          route:'/'
        },
        {
          name:'About',
          route:'/about'
        },
        {
          name:'FAQ',
          route:'/faq'
        },
        {
          name:'Order',
          route:'/order'
        }
      ]
    }
  }
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
@media (min-width:536px){
  #theBar {
    display:block;
  }
  #mobile-menu, #mobile-menu-list {
    display:none;
  }
}

@media (max-width:535px){
  #theBar {
    display:none;
  }
  #mobile-menu, #mobile-menu-list {
    display:block;
  }

  .v-main {
  padding:0!important;
  }
}



</style>