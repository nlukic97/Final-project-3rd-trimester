<template>
  <div class="about">
    <v-container>
      <v-row>
        <v-col class="red white--text pt-8 pb-8">
          <h1>About</h1>
          <p>Where it all starts...</p>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" sm="5" md="4" class="d-flex align-center">
            <img src="../assets/sea.jpg" alt="" class="image">
        </v-col>
        <v-col cols="12" sm="7" md="8" class="text-left">
          <h3>Where it all started...</h3>
          <div>
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Mollitia nam minus voluptate perspiciatis! Suscipit eum cupiditate, quasi, a voluptates veniam corporis libero eaque dolor fugit exercitationem, dignissimos aspernatur. Excepturi eligendi exercitationem tenetur aperiam animi sequi vero assumenda accusamus sunt explicabo non nam magnam deserunt doloribus nihil, atque pariatur ipsum id placeat? Similique possimus at distinctio voluptates laboriosam, sapiente tempora. Quas iste incidunt tempora nostrum excepturi unde quae placeat harum quidem sint suscipit, voluptatum quos sed assumenda pariatur eaque. Itaque, quis aspernatur. Error ratione magnam repudiandae quae? Repellat nisi impedit excepturi!
          </div>
        </v-col>
      </v-row>

      <!-- 1. Only displays when the screen is small -->
      <v-row class="d-none d-sm-flex">
        <v-col sm="7" md="8" class="text-left">
          <h3>Just how we imagined it..</h3>
          <div>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam exercitationem quaerat nesciunt dolorem quam sapiente? Atque inventore iusto dolor ipsam adipisci fugiat eos et eaque odit sed consequuntur quae corrupti amet illo, consectetur maiores repellendus veniam blanditiis incidunt molestiae. Voluptatibus quae voluptates mollitia tenetur vel autem, expedita quia, earum reprehenderit perspiciatis aliquam optio ipsa necessitatibus nemo minus, odit blanditiis. Corrupti odio numquam magnam at dolor sint eveniet temporibus ex delectus.
          </div>
        </v-col>
        <v-col sm="5" md="4" class="d-flex align-center">
            <img src="../assets/park-food.jpg" alt="" class="image">
        </v-col>
      </v-row>
      <!-- 2. This displays on larger screens instead of the previous row -->
      <v-row class="d-sm-none">
        <v-col cols="12" class="d-flex align-center">
            <img src="../assets/park-food.jpg" alt="" class="image">
        </v-col>
        <v-col cols="12" class="text-left">
          <h3>Just how we imagined it...</h3>
          <div>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam exercitationem quaerat nesciunt dolorem quam sapiente? Atque inventore iusto dolor ipsam adipisci fugiat eos et eaque odit sed consequuntur quae corrupti amet illo, consectetur maiores repellendus veniam blanditiis incidunt molestiae. Voluptatibus quae voluptates mollitia tenetur vel autem, expedita quia, earum reprehenderit perspiciatis aliquam optio ipsa necessitatibus nemo minus, odit blanditiis. Corrupti odio numquam magnam at dolor sint eveniet temporibus ex delectus.
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<style lang="scss" scoped>
.about {
  .image {
    width:100%;
  }
}
</style>
