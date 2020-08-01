<template>
  <v-app>
    <Nav/>

    <v-main>
      <router-view/>
    </v-main>

    <Footer/>
  </v-app>
</template>

<script>
import Nav from './components/Nav'
import Footer from './components/Footer'

export default {
  name: 'App',

  components: {
    Nav,
    Footer
  },

  data: () => ({
    //
  }),
};
</script>
<style lang="scss">
  body {
    text-align: center;
  }
</style>
