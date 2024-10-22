<template>
  <section class="p-6 mt-12">
    <level>
      <ul>
        <li
          v-for="(title, index) in titleStack"
          :key="index"
          class="title-stack-item inline-block pr-3 text-2xl text-gray-500 dark:text-gray-400 last:pr-0 last:font-black last:text-black dark:text-white-100"
        >
          {{ title }}
        </li>
      </ul>
    </level>
  </section>
</template>

<style scoped>
li.title-stack-item:not(:last-child):after {
  content: '/';
  @apply inline-block pl-3;
}
</style>
<script setup>
import Level from '@/Components/Level.vue';

defineProps({
  titleStack: {
    type: Array,
    default: () => []
  }
});
</script>
