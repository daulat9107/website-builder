<template>
    <footer class="bg-white py-2 px-6 dark:bg-gray-900">
        <level>
            <div class="text-center md:text-left text-white">
                <b>&copy; {{ year }}, <a href="#" target="_blank">DMTC</a>.</b>
            </div>
        </level>
    </footer>
</template>
<script setup>
import { computed } from "vue";
import { useStore } from "vuex";
import Level from "@/Components/Level.vue";

const store = useStore();

const year = computed(() => new Date().getFullYear());
</script>
