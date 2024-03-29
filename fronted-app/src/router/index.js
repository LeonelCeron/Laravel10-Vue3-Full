import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ExampleView from '../views/ExampleView.vue'
import CreateProduct from '@/views/products/CreateProduct.vue'
import EditProduct from '../views/products/EditProduct.vue'
import ShowProducts from '../views/products/ShowProducts.vue'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/example',
      name: 'example',
      component: ExampleView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/showProducts',
      name: 'showProducts',
      component: ShowProducts
    },
    {
      path: '/createProduct',
      name: 'createProduct',
      component: CreateProduct
    },
    {
      path: '/editProduct/:id',
      name: 'editProduct',
      component: EditProduct
    },

  ]
})

export default router
