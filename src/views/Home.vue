<template>
  <div class="home">
    <!-- <HelloWorld msg="Welcome to Hillingdon chippie !"/> -->
    <v-container style="padding:0;">
      <v-row>
        <v-col id="hero">
          <div class="overlay"></div>
          <h2 class="white--text">Doing what we do best since 2010.</h2>
          <img class="image" src="../assets/chefs.jpg" alt="">
        </v-col>
      </v-row>
      <v-row>
        <v-col class="red white--text">
          <h2>Who are we?</h2>
          <p class="text-left">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vitae adipisci a accusantium ex sunt, obcaecati quaerat. Voluptatibus, est perferendis eius eligendi nihil nam soluta aliquid unde porro reprehenderit non quae optio numquam magnam totam? Doloremque vel unde quidem et optio? Natus enim sapiente sed aliquam, adipisci unde quod ullam debitis.</p>
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
#hero {
  position: relative;
  padding:0;
  .overlay{
    width:100%;
    height:100%;
    position: absolute;
    top:0;
    left:0;
    // background-color:rgba(80, 72, 72, 0.272);
    // background-color:orange;
  }
  h2 {
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
}
</style>
