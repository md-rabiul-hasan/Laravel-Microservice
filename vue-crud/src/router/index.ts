import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import Main from '../pages/Main.vue'
import Admin from '../pages/admin/Admin.vue'
import Products from '../pages/admin/Products.vue'
import ProductCreate from '../pages/admin/ProductCreate.vue';
import ProductEdit from '../pages/admin/ProductEdit.vue';

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    component: Main
  },
  {
    path: '/admin',
    component: Admin,
    children:[
      {
        path: 'products',
        component: Products
      },
      {
        path: 'product/create',
        component: ProductCreate
      },
      {
        path: 'product/:id/edit',
        component: ProductEdit
      }
    ]
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
