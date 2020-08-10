<template>
  <div id="Checkout">
    <v-container>
      <v-row>
        <v-col cols="12">
          <router-link to="/order">
            <v-btn
              class="red white--text"
            >
              Back
            </v-btn>
          </router-link>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <h3>Checkout</h3>
        </v-col>
      </v-row>
      <v-row>
        <!-- address info -->
        <v-col cols="12" sm="12" md="4">
          <h4>address</h4>
          <v-card>
            <p>address</p>
          </v-card>
        </v-col >
        <!-- payment info -->
        <v-col cols="12" sm="12" md="4">
          <h4>payment info</h4>
          <v-card>
            <p>payment info</p>
          </v-card>
        </v-col>
        <!-- order info -->
        <v-col cols="12" sm="12" md="4">
          <v-card>
            <div 
            v-for="(item, index) in cart" :key="index"
            class="pb-3 pt-1"
            style="border-bottom:1px solid gray;"
            >
              <div>
                <span>{{item.size}} {{item.title}} </span>
                <span>{{item.price}} 	&#163;</span>
              </div>
              <span v-if="item.extras">+ {{item.extras}}</span>
            </div>
          </v-card>
        </v-col>
      </v-row>
      


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
      cart:[
        {
          title: 'Cod',
          img:'https://www.thesprucepets.com/thmb/FOLwbR72UrUpF9sZ45RYKzgO8dg=/3072x2034/filters:fill(auto,1)/yellow-tang-fish-508304367-5c3d2790c9e77c000117dcf2.jpg',
          size: 'Regular',
          price: 4.30,
          extras: ''
        }
        ,
        {
          title: 'Cod',
          img: 'https://images.unsplash.com/photo-1524704654690-b56c05c78a00?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80',
          size: 'Regular',
          price: 5.03,
          extras: "pepper, salt"
        },
        {
          title: 'Cod',
          img: 'https://www.hakaimagazine.com/wp-content/uploads/header-fish-feel.jpg',
          size: 'Regular',
          price: 5.25,
          extras: 'salt, vinager'
        }
      ]
    }
  },
  methods:{
    finalCart(){
      //nesto sto ce da strpa sve iz cookie-a u this.cart. Ovo je final cart pred purchase.
      //prvo bi ocistio ovaj array da bude prazan, i onda populisao iz cookie-a
    }
  },
  beforeMount(){
    //ovde bi pozivao finalCart()
  },
  mounted(){
    if(this.cart.length == 0){
      this.$router.push('/order')
    }
  }
}
</script>
<style lang="less" scoped>

</style>