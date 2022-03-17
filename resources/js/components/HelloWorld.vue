<script setup>
import { ref } from 'vue'

defineProps({
   msg: String,
})

const count = ref(0)
</script>

<template>
   <div class="m-4">
      <h1 class="text-3xl font-semibold">{{ msg }}</h1>

      <p class="my-4">
         Recommended IDE setup:
         <a href="https://code.visualstudio.com/" target="_blank">VSCode</a>
         +
         <a href="https://github.com/johnsoncodehk/volar" target="_blank">Volar</a>
      </p>

      <p class="my-4">
         <a href="https://vitejs.dev/guide/features.html" target="_blank">Vite Documentation</a>
         |
         <a href="https://v3.vuejs.org/" target="_blank">Vue 3 Documentation</a>
         |
         <a href="https://tailwindcss.com/" target="_blank">Tailwind CSS</a>
      </p>

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
