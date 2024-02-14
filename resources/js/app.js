import './bootstrap';

import { createApp } from 'vue';

import app from './components/app.vue';

import navBar from './components/navBar.vue';

createApp(app).mount('#app');

createApp(navBar).mount('#navBar');