
import { createApp, h } from "vue";
import Router from './routes';
import BootstrapVue3 from 'bootstrap-vue-3'
import ToastPlugin from 'vue-toast-notification';

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-3/dist/bootstrap-vue-3.css'
import 'vue-toast-notification/dist/theme-sugar.css';


const app = createApp({})

app.use(Router);
app.use(BootstrapVue3);
app.use(ToastPlugin,{
    position: 'bottom-right'
});


app.mount('#app');
