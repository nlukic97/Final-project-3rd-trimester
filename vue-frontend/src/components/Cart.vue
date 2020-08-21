<template>
  <div id="Prompt" v-if="displayMobileCart">
    <!-- overlay - covers the background order page -->
    <div id="overlay"></div>

    <!-- The prompt -->
    <div class="promptContainer">
      <v-card class="innerBox">
        <div class="d-flex justify-space-between align-center">
          <div v-if="this.cart.length==0"></div> <!-- fantom div to keep the x btn to the right -->
          <v-btn
            class="red white--text"
            @click="emptyCart"
            v-if="this.cart.length!=0" 
          >
            Empty
          </v-btn>
          <v-btn
            class="red white--text"
            text
            fab 
            width="25px" 
            height="25px" 
            @click="closeMobileCart()"
          >
            X
          </v-btn>  
        </div>
        
        <h2>Cart</h2>
        <p><span v-if="cart.length == 0">Cart empty! - </span>{{checkoutPrice}} &#163;</p>
        

        <!-- Item list section -->
        <v-card class="pt-5 pb-5 pl-3 pr-3 mb-4 text-left"
          v-for="(item, index) in cart" :key="index"
        >
          <div class="d-flex justify-space-between text-left">
            <span>{{item.title}}</span>
            <span class="pr-5">{{item.price}} &#163;</span>
            <v-btn
            class="red white--text xBtn"
            fab
            width="20px"
            height="20px"
            @click="removeItem(index)"
            >
              x
            </v-btn>
          </div>
          <span class="pl-5" v-if="item.extras">+ {{item.extras}}</span>
        </v-card>

        <v-btn
          v-if="cart.length != 0"
          class="red white--text mb-5 mt-5"
          @click="checkout"
        >Checkout
        </v-btn>

      </v-card>
    </div>

  </div>
</template>
<script>
export default {
  name: 'Cart',
  props: {
    checkoutCart: Array,
    checkoutPrice: String,
    displayMobileCart: Boolean
  },
  watch: {
    checkoutCart: function(){
      this.cart = this.checkoutCart;     
    }
  },
  data(){
    return {
      cart:''
    }
  },
  methods:{
    closeMobileCart(){
      this.$emit('close-mobile-cart')
    },

    removeItem(index){
      this.$emit('remove-item', index)
    },

    emptyCart(){
      this.$emit('empty-cart')

      //Becuase the user probably has no need to stare at an empty cart. This closes the cart after 0.6 seconds of the user deleting all the items
      setTimeout(()=>{
        this.$emit('close-mobile-cart')
      }, 600)
    },

    checkout(){
      if(this.cart.length == 0){
        console.log('Your cart is empty !')
      } else {
        console.log(this.cart)
        this.$router.push('order/checkout') 
      }
    }
  }
}
</script>
<style scoped lang="scss">
#overlay{
  background-color: rgba(102, 101, 101, 0.6);
  width:100%;
  height:100%;
  position: fixed;
  z-index: 9;
  top:0;
  left:0;
}
.promptContainer {
  width:100%;
  height:100%;
  position: fixed;
  left:0;
  top:0;
  z-index: 10;
  .innerBox {
    width:53%;
    margin:20px auto 0 auto;
    padding:30px;
    max-height:90%;
    overflow-y: scroll;
    .xBtn {
      position:absolute;
      right:0px; top:-5px;
    }
  }
}


@media (max-width: 791px){
  .promptContainer {
    .innerBox {
      width:70%;
    }
  }
}

@media (max-width: 575px){
  .promptContainer {
    .innerBox {
      width:80%;
    }
  }
}
</style>