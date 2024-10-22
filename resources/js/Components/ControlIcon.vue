<script setup>
import Icon from "@/Components/Icon.vue";

defineProps({
    icon: {
        type: String,
        default: null,
    },
    h: {
        type: String,
        default: null,
    },
});
</script>

<template>
    <icon
        :path="icon"
        w="w-10"
        :h="h"
        class="absolute top-0 left-0 z-10 pointer-events-none text-text-500 dark:text-text-400"
    />
</template>
