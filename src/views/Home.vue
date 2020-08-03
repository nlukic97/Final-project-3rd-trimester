<template>
  <div class="home">
    <!-- <HelloWorld msg="Welcome to Hillingdon chippie !"/> -->
    <v-container>
      <v-row>
        <v-col class="hero">
          <div class="overlay"></div>
          <h2 id="hero-text-one" class="white--text">Doing what we do best since 2010.</h2>
          <img class="image" src="../assets/chefs.jpg" alt="">
        </v-col>
      </v-row>

      <v-row>
        <v-col class="red white--text">
          <h2>Who are we?</h2>
          <p class="text-left">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vitae adipisci a accusantium ex sunt, obcaecati quaerat. Voluptatibus, est perferendis eius eligendi nihil nam soluta aliquid unde porro reprehenderit non quae optio numquam magnam totam? Doloremque vel unde quidem et optio? Natus enim sapiente sed aliquam, adipisci unde quod ullam debitis.</p>
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <h2>How it works</h2>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="3">
          <div class="circle"></div>
          <h4>Pick your food</h4>
        </v-col>

        <v-col cols="3">
          <div class="circle"></div>
          <h4>Pay by card</h4>
        </v-col>

        <v-col cols="3">
          <div class="circle"></div>
          <h4>Food is cooked</h4>
        </v-col>

        <v-col cols="3">
          <div class="circle"></div>
          <h4>Quick delivery</h4>
        </v-col>
      </v-row>
      <v-row>
        <v-col class="hero">
          <div class="overlay"></div>
          <div id="hero-2-container">
            <div id="hero-2-box">
              <h2 id="hero-2-text" class="white--text">You can't go wrong with<br>fish and chips.</h2>
              <p class="white--text">-Michael Sandel</p>
            </div>

            <router-link to="/order" class="text-decoration-none"> <!-- scroll to the top of page on load of order -->
              <v-btn
              class="red white--text mt-10"
              width="200px"
              >
                Order now
              </v-btn>
            </router-link>

          </div>
          <img class="image" src="../assets/hero-2.jpg" alt="">
          
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
// @ is an alias to /src
// import HelloWorld from '@/components/HelloWorld.vue'

export default {
  name: 'Home',
  components: {
    // HelloWorld
  } 
}
</script>
<style scoped lang="scss">
.home {
  .hero {
    position: relative;
    padding:0;
    .overlay{
      width:100%;
      height:100%;
      position: absolute;
      top:0;
      left:0;
      background-color:rgba(80, 72, 72, 0.272);
    }
    #hero-text-one {
      position:absolute;
      width: 100%;
      top:45%;
      left:0;
      text-align: center;
      background-color: rgba(233, 45, 45, 0.653);
      font-weight: normal;
    }
    .image {
      width:100%;
      height:100%; //iz nekog razloga je sirina slike manja od kontejnera, i zato ima mali razmakcic
    }
    #hero-2-container {
      // display: none;
      width:100%;
      margin: 0 auto;
      position: absolute;
      top:35%;
      #hero-2-box {
        min-width:340px;
        width: 40%;
        background-color: rgba(196, 20, 20, 0.564);
        margin: 0 auto;
        padding:20px;
      }
    }
  }
  .circle {
    width:110px;
    height:110px;
    border:1px solid #333;
    border-radius: 50%;
    margin: 0 auto;
  }
}
</style>
