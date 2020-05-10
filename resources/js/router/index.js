import Home from '../views/Home.vue'
import About from '../views/About.vue'
import SingleEmployee from '../views/SingleEmployee.vue'
import SingleDepartment from '../views/SingleDepartment.vue'

export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/about',
            name: 'about',
            component: About,
        },
        {
          path: '/employee/:id',
          name: 'single-employee',
          component: SingleEmployee,
          props: true
        },
        {
          path: '/department/:id',
          name: 'single-department',
          component: SingleDepartment,
          props: true
        }
    ]
}
