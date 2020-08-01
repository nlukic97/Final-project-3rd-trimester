import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Faq from '../views/Faq.vue'
import Order from '../views/Order.vue'
import Error404 from '../views/Error404.vue'

Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
  {
    path:'/faq',
    name: 'Faq',
    component: Faq
  },
  {
    path:'/order',
    name: 'Order',
    component: Order
  },
  {
    path:'*',
    name: 'Error404',
    component: Error404
  }
]

const router = new VueRouter({
  routes
})

export default router
