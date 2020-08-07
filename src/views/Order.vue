<template>
<div class="order">
  <v-container>
    <Prompt id="prompt" 
      @update-prompt="updatePrompt"
      @adding-to-cart="cartAdd"
      msg="Are you sure you would like to order this?" :displayPrompt='promptDisplay' 
      :title="promptedItem.title"
      :img="promptedItem.img"
      :size="promptedItem.size"
      :price="promptedItem.price"
      :extras="promptedItem.extras"
    />
    <v-row class="pb-10">
      <v-col lg='9' md="9" sm="12" cols="12">
        <h2>Menu</h2>
        <div id="availableFood" class="d-flex flex-wrap justify-center">

          <v-card v-for="(item, index) in items" :key="index"
          class="pt-5 pb-5 mb-15 ml-2 mr-2"
          id="item-card"
          >
            <h3>{{item.size}} {{item.title}}</h3>
            <div class="img-container d-flex align-center">
              <img :src="item.img" alt="">
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
<!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->
        <v-card>
          <div class="d-flex justify-space-between align-center">
            <v-btn id="open-cart-btn"
            class="red white--text ml-4 mr-4"
            fab
            @click="cartViewToggle()"
            >
              V
            </v-btn>
            <h2>Cart</h2>
            <v-btn id="clear-cart-btn"
            @click="clearCart"
            class="red white--text mr-4"
            >
              Empty
            </v-btn>
          </div>
          <!-- how to make this inderneath conditional ?? -->
          <div :class="cartClass" class="checkout-container"> <!--    or       #checkout-container-closed    -->
            <!-- ovo ovde pravi problem. Imas scroll y -->
              
            <v-card 
            v-for="(cartItem, index) in cart" :key="index"
            class="cartItemCard"
            >
              <div class="d-flex justify-space-between">
                <h4> {{cartItem.size}} {{cartItem.title}}</h4>
                <div>
                  <span class="mr-3">{{cartItem.price}} &#163;</span>
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
                <!-- <div>{{cartItem.price}} £</div> -->
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
              >
                Checkout
              </v-btn>
            </div>
      </v-col>
    </v-row>
  </v-container>
</div>
</template>
<script>
import Prompt from '../components/Prompt.vue'
export default {
  name: 'Order',
  components: {
    Prompt
  },
  data(){
    return {
      promptDisplay:'true',
      promptedItem:{
        title: '',
        size: '',
        price:'' ,
        extras: ''
      },
      items: [
        {
          title: 'Cod',
          img:'https://www.thesprucepets.com/thmb/FOLwbR72UrUpF9sZ45RYKzgO8dg=/3072x2034/filters:fill(auto,1)/yellow-tang-fish-508304367-5c3d2790c9e77c000117dcf2.jpg',
          size: 'Regular',
          price: 4.30,
          extras: 'salt, vinager'
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
        },
        {
          title: 'Cod',
          img: 'https://cdn0.wideopenpets.com/wp-content/uploads/2019/10/Fish-Names-770x405.png',
          size: 'Large',
          price: 5.29,
          extras:'salt, vinager'
        },
        {
          title: 'Burger',
          img: 'https://media-cdn.tripadvisor.com/media/photo-s/17/ba/a6/31/burger.jpg',
          size: 'Regular',
          price: 2.30,
          extras: 'mayo, burger sauce, BH sauce, ketchup'
        },
        {
          title: 'Cod',
          img: 'https://cdn.pixabay.com/photo/2014/03/24/13/49/trout-294469__340.png',
          size: 'Large',
          price: 5.24,
          extras: 'salt, vinager'
        },
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
        },
        {
          title: 'Cod',
          img: 'https://cdn0.wideopenpets.com/wp-content/uploads/2019/10/Fish-Names-770x405.png',
          size: 'Large',
          price: 5.29,
          extras:'salt, vinager'
        },
        {
          title: 'Burger',
          img: 'https://media-cdn.tripadvisor.com/media/photo-s/17/ba/a6/31/burger.jpg',
          size: 'Regular',
          price: 2.30,
          extras: 'mayo, burger sauce, BH sauce, ketchup'
        },
        {
          title: 'Cod',
          img: 'https://cdn.pixabay.com/photo/2014/03/24/13/49/trout-294469__340.png',
          size: 'Large',
          price: 5.24,
          extras: 'salt, vinager'
        }
      ],
      cart:[
      ],
      totalPrice:0,
      cartClass:'checkout-container'
    }
  },
  methods: {
    priceDecimals(){
      for(var a = 0; a < this.items.length; a++){
        var check = this.items[a].price.toString();

        if(check[check.length-2] == '.'){
          this.items[a].price = check + '0';
        } else {
          this.items[a].price = this.items[a].price.toString()
        }
      }
    },

    cartPrompt(index){
      this.promptedItem = {
        title: this.items[index].title,
        size: this.items[index].size,
        img: this.items[index].img,
        price: this.items[index].price,
        extras: this.items[index].extras //this is changed later when we add to cart. ovo jos uvek predstavlja problem 
      }

      this.promptDisplay = 'true'
    },

    cartAdd(response){
      console.log('Added to cart: ')
      // console.log(response)

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

      // console.log(response)


      this.cart.push(this.promptedItem)
      console.log(this.cart)
      // console.log(this.cart)
      this.updatePrompt()
      //console.log(this.cart) //ovo kasnije dodajes u cookie
      this.promptedItem = {}; //ovo iznad sad i ne moras ali sto da ne iz predostroznosti
      this.calcCartTotal()
      
    },

    cartViewToggle(){
      if(this.cartClass == 'checkout-container-open'){
        this.cartClass = 'checkout-container-closed'
      } else {
        this.cartClass = 'checkout-container-open'
      }
    },

    cartExtraDisplay(index){
      if(this.cart[index].extras != '' && this.cart[index].extras != null ){
        return true;
      } else {
        return false;
      }
    },

    updatePrompt(){
      this.promptDisplay = 'false'
    },

    cartItemDelete(index){
      var answer = confirm('Are you sure you want to delete this item?')
      if(answer){
        this.cart.splice(index,1)
      }
      this.calcCartTotal()
    },

    clearCart(){
      if(this.cart.length > 0){
        var answer =confirm('Are you sure you want to delete all items from your cart?')
        if(answer == true){
          this.cart = []
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

      if(priceString[priceString.length-2] == '.'){
          this.totalPrice = priceString + '0';
        } else {
          this.totalPrice = priceString
        }
      //this.totalPrice = price // round this so that only 2 digits remain after -------------------------------------------------
      console.log('Totalcart price: ' + this.totalPrice)
    },

    checkout(){
      if(this.cart.length == 0){
        console.log('Your cart is empty !')
      } else {
        console.log(this.cart)
      }
    }
  },
  beforeMount(){
    document.body.style.opacity="0%"
  },
  mounted(){
    document.body.style.opacity="100%"
    this.priceDecimals()
    this.promptDisplay = 'false'
  },
  updated(){
    this.priceDecimals()
  }
}
</script>
<style scoped lang="scss">
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
  // border:1px solid red;
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

@media screen and (max-width: '959px'){
  #cart {
    position:fixed;
    bottom:0;
    z-index:0;
    background-color: #fff;
    border-top:1px solid black;
    border-bottom: 1px solid black;
    height:98px;
  }
}

@media (max-width: 575px){
  #item-card {
  max-width: 240px;
  min-width: 90%;
  }
};

</style>
