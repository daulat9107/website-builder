<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-text-100 uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
