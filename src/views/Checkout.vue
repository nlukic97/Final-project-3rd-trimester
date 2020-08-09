<template>
  <div id="Checkout">
    <v-container>
      <router-link to="/order">
        <v-btn
          class="red white--text"
        >
          Back
        </v-btn>
      </router-link>

      <h3>Checkout</h3>

      <v-card>
        <p>these are your items</p>
      </v-card>
      <v-btn
          class="red white--text"
        >
          Order now
        </v-btn>
    </v-container>
  </div>
</template>
<script>
export default {
  name:'Checkout',
  data(){
    return {
      cart: []
    }
  },
  methods:{
    finalCart(){
      //nesto sto ce da strpa sve iz cookie-a u this.cart. Ovo je final cart pred purchase
    }
  },
  beforeMount(){
    //ovde bi pozivao final cart da populises cart array
  },
  mounted(){
    // if(this.cart.length == 0){
    //   this.$router.push('/order')
    // }
  }
}
</script>
<style lang="less" scoped>

</style>