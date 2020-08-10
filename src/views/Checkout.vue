<template>
  <div id="Checkout">
    <v-container>
      <v-row>
        <v-col cols="12" class="text-left">
          <v-btn
            class="red white--text"
            @click="backToOrderPage"
          >
            Back
          </v-btn>
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
          <h3>Address</h3>
          <v-card>
            <v-col>
              <v-form
                ref="form1"
                v-model="valid"
                lazy-validation
              >
                <v-text-field label="name" outlined dense v-model="name" :rules="nameRules"></v-text-field>
                <v-text-field label="address" outlined dense v-model="address" :rules="addressRules"></v-text-field>
                <v-text-field label="email" outlined dense v-model="email" :rules="emailRules"></v-text-field>
                <v-text-field label="Phone number" type="number" outlined dense v-model="phoneNumber" :rules="phoneNumberRules"></v-text-field>
              </v-form>
            </v-col>
          </v-card>
        </v-col >

        <!-- payment info -->
        <v-col cols="12" sm="12" md="4">
          <h3>Payment</h3>
          <v-card>
            <v-col> <!-- treba li ovo ? -->
              <v-form
                ref="form2"
                v-model="valid"
                lazy-validation
              >
                <v-text-field label="Card Number" type="number" outlined dense v-model="cardNumber" :rules="cardNumberRules"></v-text-field>
                <v-text-field label="CVC-code" type="number" outlined dense v-model="cvc" :rules="cvcRules"></v-text-field>
              </v-form>
            </v-col> <!-- treba li ovo ? -->
          </v-card>
        </v-col>

        <!-- order info -->
        <v-col cols="12" sm="12" md="4"
        >
          <h3>Order</h3>
          <v-card>

            <div class="d-flex justify-space-around pb-3 pt-8">
              <h3>Total:</h3>
              <h3>{{this.total}} &#163;</h3>
            </div>
            
            <!-- ne umem kako da validiramo ovo -->
            <v-btn
            class="red white--text mb-7"
            width="60%"
            @click="validation()"
            >
              Order now
            </v-btn>

            <v-card>
              <div 
              v-for="(item, index) in cart" :key="index"
              class="pb-2 pt-2 text-left cartItems"
              >
                <div class="d-flex justify-space-between pl-7 pr-7">
                  <span>{{item.size}} {{item.title}} </span>
                  <span>{{item.price}} 	&#163;</span>
                </div>
                <span v-if="item.extras" class="pl-10 extras">+ {{item.extras}}</span>
              </div>
            </v-card>

          </v-card>
        </v-col>
      </v-row>
      
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
      ],
      name:'',
      address:'',
      email:'',
      phoneNumber:'',
      cardNumber:'',
      cvc:'',
      total:0,
      valid:false,
      nameRules: [
        v => !!v || 'Name is required',
        v => (v && v.length <= 35) || 'Name must be less than 35 characters',
      ],
      addressRules: [
        v => !!v || 'Address is required'
      ],
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      phoneNumberRules:[
        v => !!v || 'Phone number is required'
      ],
      cardNumberRules:[
        v => !!v || 'Card number is required'
      ],
      cvcRules:[
        v => !!v || 'CVC number is required',
      ]
    }
  },
  methods:{
    finalCart(){
      //nesto sto ce da strpa sve iz cookie-a u this.cart. Ovo je final cart pred purchase.
      //prvo bi ocistio ovaj array da bude prazan, i onda populisao iz cookie-a
    },
    
    calcTotal(){
      var price = 0;
      for(var i = 0; i < this.cart.length; i++){
        price = price + parseFloat(this.cart[i].price)
      }
      this.total = price;
      console.log(this.total)
    },

    backToOrderPage(){
      this.$router.push('/order')
    },

    validation(){ //but try to implement vuetify validation in here. You have three different forms, that is one issue.s
      var a = this.$refs.form1.validate()
      var b = this.$refs.form2.validate()

      if(a == true && b == true){
        this.$router.push('../confirm')
      }
    },

    submit(){
      console.log(this.cart)
    }
  },
  beforeMount(){
    //ovde bi pozivao finalCart()
  },
  mounted(){
    if(this.cart.length == 0){
      this.backToOrderPage()
    }

    this.calcTotal()
  }
}
</script>
<style lang="scss" scoped>
.cartItems {
  color: #3f3e3e;
  border-top:1px solid rgb(117, 107, 107);
  .extras {
    color: #797878;
  }
}
</style>