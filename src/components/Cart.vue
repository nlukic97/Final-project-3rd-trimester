<template>
  <div id="Prompt" v-if="displayMobileCart">
    <div id="overlay"></div>

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
        


        <v-card class="pt-5 pb-5 pl-3 pr-3 mb-4 text-left"
          v-for="(item, index) in cart" :key="index"
        >
          <div class="d-flex justify-space-between text-left">
            <span>{{item.size}} {{item.title}}</span>
            <span>{{item.price}} &#163;</span>
            <v-btn
            class="red white--text"
            fab
            width="20px"
            height="20px"
            @click="removeItem(index)"
            >
              x <!-- We now need to make this work. So, it should emit its id to "order, and we remove the item with that index from the cart array" -->
            </v-btn>
          </div>
          <span class="pl-5" v-if="item.extras">+ {{item.extras}}</span>
        <!-- the same card here goes which was used in the cart section for the large screen -->
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

    removeItem(index){ //problema
      // console.log('remove item: ' + index)
      this.$emit('remove-item', index)
    },

    emptyCart(){
      this.$emit('empty-cart')
    },

    checkout(){
      if(this.cart.length == 0){
        console.log('Your cart is empty !')
      } else {
        console.log(this.cart)
        this.$router.push('order/checkout') //redirect to the checkout page
        //ovde imas sve u cookie, i taj cookie ce da populise cart.
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

}
.innerBox {
  // width:600px;
  width:53%;
  margin:20px auto 0 auto;
  padding:30px;
  max-height:90%;
  overflow-y: scroll;
  img {
    width:65%;
    margin: 0 auto;
  }
  .checkbox-container {
    position:relative;
    input {
      position:absolute;
      left: 20px;
      top:10px;
      // display: none;

    }
    label {
      display:inline-block;
      padding:10px 40px;
      width:180px;
      margin-left: 7px; 
      // border:1px solid red;
    }
  }
}

@media (max-width: 791px){
  .innerBox {
    width:60%;
  }
}

@media (max-width: 575px){
  .innerBox {
    width:80%;
  }
}
</style>