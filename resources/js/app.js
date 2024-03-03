import './bootstrap';

import { createApp } from 'vue';

import navBar from './components/navBar.vue';

import app from './components/app.vue';

createApp(navBar).mount('#navBar');

createApp(app).mount('#app');

