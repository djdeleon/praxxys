import { createRouter, createWebHistory } from "vue-router";
import store from '../store';

import Login from '../../views/auth/Login.vue';
import DefaultLayout from '../components/pages/DefaultLayout.vue'
import ProductCreate from '../../views/products/create.vue';
import ProductIndex from '../../views/products/index.vue';
import ProductEdit from '../../views/products/edit.vue';

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: Login,
  },
  {
    path: '/',
    name: 'Home',
    component: DefaultLayout,
    meta: { requiresAuth: true },
    children: [
      {
        path: '/',
        name: 'ProductIndex',
        component: ProductIndex
      },
      {
        path: '/products/create',
        name: 'ProductCreate',
        component: ProductCreate
      },
      {
        path: '/products/edit/:id',
        name: ProductEdit,
        component: ProductEdit
      },
    ]
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.user.token) {
    next({name: 'Login'});
  } else if (store.state.user.token && to.meta.isGuest || (to.meta.isAdmin && store.state.user.data.is_admin === 0)) {
    next({name: 'Welcome'});
  } else {
    next();
  }
})

export default router;
