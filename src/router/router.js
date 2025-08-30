import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    component: () => import('../pages/index.vue'),
  },
  {
    path: '/insurance',
    component: () => import('../pages/insurance.vue'),
  },
  {
    path: '/insurance-cop',
    component: () => import('../pages/insurance-cop.vue'),
  },
  {
    path: '/osgop',
    component: () => import('../pages/osgop.vue'),
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

// Add a navigation guard to scroll to top on route changes
router.afterEach(() => {
  window.scrollTo(0, 0);
})

export default router
