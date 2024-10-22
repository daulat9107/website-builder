<template>
    <section
        class="bg-gradient-to-r from-blue-500 via-blue-900 to-violet-900 text-gradientbg-white border-t border-b border-gray-100 p-6 dark:bg-gray-900 dark:border-gray-900 text-white"
    >
        <level>
            <h1 class="text-3xl font-semibold leading-tight">
                <slot />
            </h1>
        </level>
    </section>
</template>
<script setup>
import { useStore } from "vuex";
import { computed } from "vue";
import Level from "@/Components/Level.vue";

const store = useStore();

const darkMode = computed(() => store.state.darkMode);

const darkModeToggle = () => {
    store.dispatch("darkMode");
};
</script>
