import { resolve } from 'path'
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig(({ command }) => {
   return {
      plugins: [vue()],

      root: 'resources',
      base: command === 'build' ? '/dist/' : '',
      publicDir: false,
      build: {
         manifest: true,
         outDir: resolve(__dirname, 'public/dist'),
         emptyOutDir: true,
         rollupOptions: {
            input: 'resources/js/app.js',
         },
      },

      server: {
         strictPort: true,
         port: 3000,
      },

      resolve: {
         alias: {
            '@': resolve(__dirname, 'resources/js'),
         },
      },

      optimizeDeps: {
         include: ['vue', 'axios'],
      },
   }
})
