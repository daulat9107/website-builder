<script setup>
const props = defineProps({
    classes: {
        type: String,
        default: "flex gap-2",
    },
});
</script>
<template>
    <section class="p-4 rounded shadow bg-background h-max">
        <slot name="header" />
        <div :class="classes">
            <slot name="main" />
        </div>
    </section>
</template>
