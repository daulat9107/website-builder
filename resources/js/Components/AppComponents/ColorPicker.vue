<script setup>
import { defineProps } from "vue";
defineProps({
    defaultColor: "#ffffff",
});
</script>
<template>
    <div class="color-picker">
        <input
            type="color"
            class="w-full"
            :value="defaultColor"
            name="colorInput"
        />
    </div>
</template>
<style scoped></style>
