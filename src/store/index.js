import Vue from "vue"
import Vuex from "vuex"

Vue.use(Vuex)
export default new Vuex.Store({
  state: {
    cart: 2 //whenever cart is changed, it needs to emit a function to change this data.
  }, 
  getters: {
    cartUpdate(items){
      this.state.cart = items;
    }
  }
})