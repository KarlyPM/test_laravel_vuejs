
  import { createRouter, createWebHistory, RouteRecordRaw} from "vue-router";
  import { defineAsyncComponent } from 'vue';
  import UsersTableView from './views/UsersTableView.vue'
  import UsersFormsView from './views/UsersFormsView.vue'


  const routes: Array<RouteRecordRaw> = [
    {
        path: "/",
        name: "user-table",
        component: UsersTableView
    },
      {
        path: "/user/update/:id",
        name: "user-update",
        component: UsersFormsView
    },
    {
        path: "/user/new",
        name: "user-new",
        component: UsersFormsView
    }
  ];
  
  const router = createRouter({
    history: createWebHistory(),
    routes,
  });
  
  export default router;