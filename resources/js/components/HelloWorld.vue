<script setup>
import { ref } from 'vue'

defineProps({
   msg: String,
})

const count = ref(0)
</script>

<template>
   <div class="m-4">
      <h1 class="text-3xl font-semibold">
         {{ msg }}
         <span class="text-red-500">Laravel</span> + <span class="text-purple-500">Vite</span> +
         <span class="text-green-500">Vue 3</span> +
         <span class="text-blue-500">Tailwind CSS</span>
      </h1>

      <p class="my-4">
         Recommended IDE setup:
         <a href="https://code.visualstudio.com/" target="_blank">VSCode</a>
         +
         <a href="https://github.com/johnsoncodehk/volar" target="_blank">Volar</a>
      </p>

      <p class="my-4">
         Docs:
         <a href="https://laravel.com/docs" target="_blank">Laravel</a>
         |
         <a href="https://laravel-vite.dev/guide/quick-start.html" target="_blank">Vite</a>
         |
         <a href="https://vuejs.org/guide" target="_blank">Vue 3</a>
         |
         <a href="https://tailwindcss.com/docs" target="_blank">Tailwind CSS</a>
      </p>

      Click here:
      <button type="button" @click="count++">count is: {{ count }}</button>
      <p class="my-4">
         Edit
         <code class="text-amber-700">components/HelloWorld.vue</code> to test hot module
         replacement.
      </p>
   </div>
</template>

<style scoped>
a {
   @apply text-green-500 underline;
}
button {
   @apply px-1 bg-slate-400 border border-slate-600 rounded-sm;
}
</style>
