import { createApp } from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './components/App.vue';

// Set Axios base URL
axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

const app = createApp(App);
app.use(VueAxios, axios);
app.config.globalProperties.$axios = axios;
app.mount('#app');