<template>
<div class="order">
  <v-container>

   <!-- Only viewable on small width devices when cart button is visible and pressed -->
    <Cart 
      id="mobile-cart-prompt" 
      @close-mobile-cart="updateMobileCart"
      @remove-item="cartItemDelete"
      @empty-cart="clearCart"
      :checkoutCart="cart" 
      :checkoutPrice="totalPrice" 
      :displayMobileCart="mobileCartDisplay"
    /> 

    <!-- Opens when user clicks on food item -->
    <Prompt id="prompt" 
      @update-prompt="updatePrompt"
      @adding-to-cart="cartAdd"
      msg="Are you sure you would like to order this?" :displayPrompt='promptDisplay' 
      :title="promptedItem.title"
      :img="imgUrlSetup(promptedItem.img)" 
      :price="promptedItem.price"
      :extras="promptedItem.extras"
    />

    <!-- -------------------- Food menu -------------------- -->
    <v-row class="pb-10">
      <v-col lg='9' md="9" sm="12" cols="12">
        <h2>Menu</h2>
        <div id="availableFood" class="d-flex flex-wrap justify-center">

          <v-card v-for="(item, index) in items" :key="index"
          class="pt-5 pb-5 mb-15 ml-2 mr-2"
          id="item-card"
          >
            <h3>{{item.title}}</h3>
            <div class="img-container d-flex align-center">
              <img :src="imgUrlSetup(item.img)" alt="">
            </div>
            <span><strong>Price: </strong>{{item.price}} &#163;</span>
            <div class="text-center">
              <v-btn
              class="red white--text"
              @click="cartPrompt(index)"
              >
              Add to cart
              </v-btn>
            </div>
          </v-card>

        </div>
      </v-col>
      <v-col lg='3' md="3" sm="12" cols="12" id="cart">

<!-- ---------------------    desktop/ large screen navigation ----------------------  -->
        <v-card>
          <div class="d-flex justify-space-between align-center">
            <v-btn id="open-cart-btn"
            class="red white--text ml-4 mr-4"
            :class="rotationClass"
            fab
            @click="cartViewToggle()"
            >
              V
            </v-btn>
            <h2>Cart</h2>
            <v-btn id="clear-cart-btn"
            @click="clearCart"
            class="red white--text mr-4"
            v-if="cart.length != 0"
            >
              Empty
            </v-btn>
            <div
            class="clear-cart-btn pr-15"
            v-if="cart.length == 0">
            </div>
          </div>
          
          <div :class="cartClass" class="checkout-container">
            <v-card 
            v-for="(cartItem, index) in cart" :key="index"
            class="cartItemCard"
            >
              <div class="d-flex justify-space-between">
                <h4>{{cartItem.title}}</h4>
                <div class="d-flex">
                  <span class="pr-4">{{cartItem.price}}&#163;</span>
                  <v-btn
                    class="red white--text"
                    @click="cartItemDelete(index)"
                    width="20px"
                    height="20px"
                    fab
                  >
                    X
                  </v-btn>
                </div>
              </div>

              <div class="pl-5">
                <div v-if="cartExtraDisplay(index)"> + {{cartItem.extras}}</div>
              </div>
            </v-card>
          </div>
        </v-card>
            <div class="d-flex justify-space-between align-center pl-5">
              <h3>{{totalPrice}} &#163;</h3>
              <v-btn 
              id="checkout-btn"
              @click="checkout"
              class="red white--text mt-3"
              v-if="cart.length != 0"
              >
                Checkout
              </v-btn>
            </div>
      </v-col>

<!-- ---------------------    mobile/ tablet cart button ----------------------  -->
      <v-btn
      class="red white--text"
      id="cart2-btn"
      fab
      @click="mobileCartToggle"
      >
      <i class="fas fa-shopping-cart"></i>
      </v-btn>
    </v-row>
  </v-container>
</div>
</template>
<script>
import Prompt from '../components/Prompt.vue';
import Cart from '../components/Cart.vue';
import axios from 'axios';

export default {
  name: 'Order',
  components: {
    Prompt,
    Cart
  },
  data(){
    return {
      imgPath:'http://localhost:8087/public/item-images/',
      promptDisplay:'true',
      mobileCartDisplay:false,
      promptedItem:{
        title: '',
        price:'' ,
        extras: ''
      },
      items: [],
      cart:[
      ],
      totalPrice:'0',
      cartClass:'checkout-container-closed',
      rotationClass:'rotate180'
    }
  },
  methods: {
    imgUrlSetup(img){
      var fullUrl = this.imgPath + img;
      console.log(fullUrl)
      return (fullUrl)
    },
    
    priceDecimals(){
      for(var a = 0; a < this.items.length; a++){
        var check = parseFloat((this.items[a].price));
        var strCheck = check.toFixed(2).toString()
        this.items[a].price = strCheck;
      }
    },

    cartPrompt(index){
      this.promptedItem = {
        title: this.items[index].title,
        img: this.items[index].img,
        price: this.items[index].price,
        extras: this.items[index].extras
      }
      this.promptDisplay = 'true'
    },

    cartAdd(response){
      this.promptedItem.extras = ''; //clearing up the extras array to be populated with selected which will be pushed to the cart and re-cleared again

      //creating a string to store the chosen extras
      if(response.length > 0 && response.length < 2){
        this.promptedItem.extras = response[0]
      } else if (response.length >= 2){
        for(var e = 0; e < response.length; e++){
          if(e != response.length - 1){
            this.promptedItem.extras = this.promptedItem.extras + response[e] + ', '
          } else {
            this.promptedItem.extras = this.promptedItem.extras + response[e]
          }
        }
      } else if (response.length == 0){
        this.promptedItem.extras = '';
      }

      delete this.promptedItem.img; //to delete the image before adding the item to the cart. We do not need this is the checkout process
      
      this.cart.push(this.promptedItem)
      this.$store.state.cart = this.cart
      
      this.updatePrompt()
      this.promptedItem = {}; //precaution for when we load the next item props
      this.calcCartTotal() //calculating final price
      
    },

    playCartAnimation(){ //just to show the user that they can open and close their cart view
      setTimeout(()=>{
        this.$store.state.cartClass = 'checkout-container-open'
        this.cartClass = this.$store.state.cartClass
        this.rotationClass = 'rotate0'
      },1000)

      setTimeout(()=>{
        this.$store.state.cartClass = 'checkout-container-closed'
        this.cartClass = this.$store.state.cartClass
        this.rotationClass = 'rotate180'
      }, 2000)
    },

    cartViewCheck(){ //it will check if the animation has been played, and the state in which the user left the cart (open/ closed), and will re-adjust accordingly.
      if(this.$store.state.animationPlayed == false){
        this.playCartAnimation()
        this.$store.state.animationPlayed = true;
      } else if(this.$store.state.animationPlayed == true) {
        this.cartClass = this.$store.state.cartClass;
        if(this.cartClass == 'checkout-container-open'){
          this.rotationClass = 'rotate0'
        } else if(this.cartClass == 'checkout-container-closed') {
          this.rotationClass = 'rotate180'
        }
      }
    },

    cartViewToggle(){
      if(this.$store.state.cartClass == 'checkout-container-open'){
        this.cartClass = 'checkout-container-closed'
        this.$store.state.cartClass = 'checkout-container-closed'
        this.rotationClass = 'rotate180'
      } 
      else if(this.$store.state.cartClass == 'checkout-container-closed') {
        this.cartClass = 'checkout-container-open'
        this.$store.state.cartClass = 'checkout-container-open'
        this.rotationClass = ''
      }
    },

    cartExtraDisplay(index){
      if(this.cart[index].extras != '' && this.cart[index].extras != null ){
        return true;
      } else {
        return false;
      }
    },

    mobileCartToggle(){
      if(this.mobileCartDisplay == false){
        this.mobileCartDisplay = true
      } else {
        this.mobileCartDisplay = false
      }
    },

    updatePrompt(){
      this.promptDisplay = 'false'
    },

    updateMobileCart(){
      this.mobileCartDisplay = false;
    },

    cartItemDelete(index){
      var answer = confirm('Are you sure you want to delete this item?')
      if(answer){
        this.cart.splice(index,1)
        this.$store.state.cart = this.cart
      }
      this.calcCartTotal()
    },

    clearCart(){
      if(this.cart.length > 0){
        var answer =confirm('Are you sure you want to delete all items from your cart?')
        if(answer == true){
          this.cart = []
          this.$store.state.cart = this.cart
        }
      }
      this.calcCartTotal()
    },

    calcCartTotal(){
      var price = 0;
      for(var i = 0; i < this.cart.length; i++){
        price = price + parseFloat(this.cart[i].price)
      }
      var priceString = price.toFixed(2).toString()
      this.totalPrice = priceString;
    },

    checkout(){
      if(this.cart.length == 0){
        console.log('Your cart is empty !')
      } else {
        console.log(this.cart)
        this.$router.push('order/checkout') //redirect to the checkout page. Only happens if there is anything in the cart
      }
    }
  },
  beforeMount(){
    axios.get('http://localhost:8087/api/items')
    .then(response=>{
      this.items = response.data
    })
  },
  mounted(){
    this.cartViewCheck()
    this.cart = this.$store.state.cart

    this.calcCartTotal()
    this.priceDecimals()

    this.promptDisplay = 'false'
    this.mobileCartDisplay = false;
  },
  updated(){
    this.priceDecimals()
  }
}
</script>
<style scoped lang="scss">
.order {
  background-color: #f1efef;
  #item-card {
    max-width: 240px;
    .img-container {
      width:80%;
      margin:7px auto;
      height:151px;
      overflow: hidden;
      img {
        width:100%;
      }
    }
  }
  #cart {
    position:relative;
    padding:0;
    #clear-cart-btn {
      z-index: 4;
      font-size: 10px;
      height:25px;
      width:10px;
    }
    #open-cart-btn {
      width:20px;
      height:20px;
    }
    .checkout-container {
      padding:5px;
      transition: height 1s;   
      .cartItemCard {
        text-align: left;
        padding:10px 10px 20px;
        margin-bottom:10px;
        h4 {
          display:inline;
        }
      }
    }

    //on desktops and larger screens, this is used to toggle the visibility of the cart items
    .checkout-container-open {
      max-height:60vh;
      height:300px;
      transition: height 0.4s;
      overflow:hidden;
      overflow-y:scroll;
    }
    .checkout-container-closed {
      height:0px;
      overflow:hidden;
      overflow-y: hidden;
      transition: height 0.4s;
    }
  }
}


#cart2-btn {
  display: none;
}

#mobile-cart-prompt { //for it to be closed under normal conditions
    display:none;
  }

.rotate0 {
   transform: rotate(0deg);
  }

.rotate180 {
  transform: rotate(-180deg);
}

@media screen and (max-width: '959px'){
  #cart {
    display: none;
  }

  //on mobiles and tables, a button appears which opens the "cart" prop
  #cart2-btn {
    display: block;
    position: fixed;
    bottom:5%;
    left:5%;
    width:70px;
    height:70px;
    z-index: 23;
    i {
      font-size:25px;
    }
  }

  #mobile-cart-prompt { 
    display:block;
  }
}

@media (max-width: 575px){
  #item-card {
  max-width: 240px;
  min-width: 90%;
  }
};

</style>
