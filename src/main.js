import Vue from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify';
import AgCookie from './cookie'

Vue.config.productionTip = false
Vue.prototype.$cookie = AgCookie

new Vue({
  router,
  vuetify,
  render: h => h(App)
}).$mount('#app')
