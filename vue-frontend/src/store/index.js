import Vue from "vue"
import Vuex from "vuex"

Vue.use(Vuex)
export default new Vuex.Store({
  state: {
    cart: [],
    cartClass: 'checkout-container-closed',
    animationPlayed:false
  }, 
  getters: {
    cartUpdate(items){
      this.state.cart = items;
    }
  }
})