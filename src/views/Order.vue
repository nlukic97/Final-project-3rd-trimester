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
          <v-card 
          v-for="(item, index) in items" :key="index"
          class="pt-5 pb-5 mb-15 ml-2 mr-2"
          id="item-card"
          >
            <h3>{{item.size}} {{item.title}}</h3>
            <div class="img-container d-flex align-center">
              <img :src="item.img" alt="">
            </div>
            <span><strong>Price: </strong>{{item.price}} £</span>
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
      <v-col 
      lg='3' md="3" sm="12" cols="12" 
      id="cart">
        <h2>Cart</h2>
        <div id="checkout-container">
          <v-btn id="clear-cart-btn"
          @click="clearCart"
          class="red white--text"
          fab
          
          >
            Clear<br>cart <!-- clear cart -->
          </v-btn>
            
          <v-card 
          v-for="(cartI, index) in cart" :key="index"
          >
            <span @click="cartItemDelete(index)">X</span>
            <h4> {{cartI.size}} {{cartI.title}}</h4>
            <li>{{cartI.price}} £</li>
            <li>{{cartI.extras}}</li>
          </v-card>

          <div id="button-container">
            <v-btn 
            id="checkout-btn"
            @click="checkout"
            class="red white--text"
            >
              Checkout
            </v-btn>
          </div>
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
        }
      ],
      cart:[
      ]
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
      
    },

    updatePrompt(){
      this.promptDisplay = 'false'
    },

    cartItemDelete(index){
      var answer = confirm('Are you sure you want to delete this item?')
      if(answer){
        this.cart.splice(index,1)
      }
    },

    clearCart(){
      if(this.cart.length > 0){
        var answer =confirm('Are you sure you want to delete all items from your cart?')
        if(answer == true){
          this.cart = []
        }
      }
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
// #availableFood {
//   display:flex;
//   justify-content: space-around;
//   // align-content: flex-start;
//   flex-wrap: wrap;
//   flex-direction: row;
//   ul {
//   width:240px;
//   padding:20px;
//   margin: 0 10px 10px 10px;
//   border:1px solid #333;
//     h3 {
//       text-align: left;
//     }
//     .img-container {
//       height:151px;
//       display: flex;
//       align-items: center;
//       img {
//       width:100%;
//       }
//     }
//     li {
//       list-style-type: none;
//       text-align: left;
//     }
//   }
// }

// #checkout-container {
//   border:1px solid #333;
//   min-height: 100px;
//   position: relative;
//   // padding-bottom: 36px;
//   padding-bottom:36px;
//   #clear-cart-btn {
//     // display: none;
//     position: absolute;
//     right: -10px;
//     top:-10px;
//   }
//   ul {
//     list-style-type: none;
//     text-align: left;
//     margin-bottom: 8px;
//   }
//   #button-container {
//     width:100%;
//     position: absolute;
//     bottom:0;
//     #checkout-btn {
//       margin: 0 auto;
//     }
//   }
// }
</style>
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
  #checkout-container {
  position: relative;
    #clear-cart-btn {
      position: absolute;
      top:-30px;
      right:-5px;
      z-index: 4;
      font-size: 12px;
    }
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
