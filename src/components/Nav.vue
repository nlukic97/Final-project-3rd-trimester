<template>
  <!-- <v-app-bar id="theBar" class="d-flex justify-center" -->
  <v-app-bar id="theBar"
      app
      color="red"
      dark
    >
      <router-link to="/">Home</router-link>
      <router-link to="/About">About</router-link>

      <div class="d-flex align-center">
        <v-img
          alt="Vuetify Logo"
          class="shrink mr-2"
          contain
          src="https://cdn.vuetifyjs.com/images/logos/vuetify-logo-dark.png"
          transition="scale-transition"
          width="40"
        />

        <v-img id="name"
          alt="Vuetify Name"
          class="shrink mt-1 hidden-sm-and-down"
          contain
          min-width="100"
          src="https://cdn.vuetifyjs.com/images/logos/vuetify-name-dark.png"
          width="100"
        />

      </div>
      

      <!-- <v-spacer></v-spacer> -->

      <v-btn
        href="https://github.com/vuetifyjs/vuetify/releases/latest"
        target="_blank"
        text
      >
        <span class="mr-2">Order</span>
        <v-icon>mdi-open-in-new</v-icon>
      </v-btn>
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
</style>