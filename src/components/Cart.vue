<template>
  <div id="Prompt" v-if="displayMobileCart">
    <div id="overlay"></div>

    <div class="promptContainer">
      <v-card class="innerBox">
        <span id="x" @click="closeMobileCart()">X</span>
        <h2>Cart</h2>
        <p>{{checkoutPrice}} &#163;</p>

        <v-card
          v-for="(item, index) in cart" :key="index"
        >
        <!-- the same card here goes which was used in the cart section for the large screen -->
        </v-card>

        <v-btn 
          class="red white--text mb-5 mt-5"
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

#x {
  // float:right;
  padding:2px 10px;
  border-radius:50%;
  background-color: red;
  color:#fff;
  position:absolute;
  right:25px;
}

#x:hover {
  background-color:rgb(248, 47, 47);
  cursor: pointer;
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