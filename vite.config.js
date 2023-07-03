// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
const path = require('path');

export default defineConfig({
  resolve:{
    alias:{
      '@' : path.resolve(__dirname, './resources/js/')
    },
  },
  plugins: [
    vue(),
    laravel([
      'resources/js/app.js',
    ]),
  ],
});