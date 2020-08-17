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
                  <span>{{item.title}} </span>
                  <span>{{item.price}} 	&#163;</span>
                </div>
                <p v-if="item.extras" class="pl-10 extras">+ {{item.extras}}</p>
              </div>
            </v-card>

          </v-card>
        </v-col>
      </v-row>
      
    </v-container>
  </div>
</template>
<script>
import axios from 'axios'
export default {
  name:'Checkout',
  data(){
    return {
      cart:[],
      name:'',
      address:'',
      email:'',
      phoneNumber:null,
      cardNumber:null,
      cvc:null,
      total:'0',
      valid:false,
      nameRules: [
        v => !!v || 'Name is required',
        v => (v && v.length <= 35) || 'Name must be less than 35 characters'
      ],
      addressRules: [
        v => !!v || 'Address is required'
      ],
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid' // /[^A-z0-9]+/;
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
    calcTotal(){
      var price = 0;
      for(var i = 0; i < this.cart.length; i++){
        price = price + parseFloat(this.cart[i].price)
      }
      this.total = price.toFixed(2).toString()
      console.log(this.total)
    },

    backToOrderPage(){
      this.$router.push('/order')
    },

    validation(){ //but try to implement vuetify validation in here. You have three different forms, that is one issue.s
      var a = this.$refs.form1.validate()
      var b = this.$refs.form2.validate()

      if(a == true && b == true){
        //ovde ide axios poziv. Ako je uspesan, onda ide router push. Ako ne, onda baca na error stranicu.
        this.submit()
        //axios zahtev ka api/items post metodi
        this.$router.push('../confirm')
      }
    },

    submit(){
      var today = new Date();
      var currentDate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate(); //heidi sql is not able to auto input dates
      var currentTime = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(); //heidi sql is not able to auto input dates

      axios.post('http://localhost:8087/api/items',{
        orderInfo: {
          name: this.name,
          address: this.address,
          email: this.email,
          phone: this.phoneNumber,
          total: this.total,
          date: currentDate,
          time: currentTime
        },
        cartInfo: {
          cart: this.cart
        }
      }, {
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      })
      .then(response=>{
        console.log(response.data)
        this.$store.state.cart = [];
      })
    }
  },
  beforeMount(){
    this.cart = this.$store.state.cart
  },
  mounted(){
    console.log(this.cart)
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