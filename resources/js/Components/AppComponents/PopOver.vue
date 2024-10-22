<script setup>
import { ref } from "vue";
import AppThemeIcon from "@/Components/AppComponents/Icons/AppThemeIcon.vue";
import ColorPicker from "@/Components/AppComponents/ColorPicker.vue";
let toggleClasses = ref("hidden");
const togglePopOver = () => {
    if (toggleClasses.value == "inline-block") {
        toggleClasses.value = "hidden";
    } else {
        toggleClasses.value = "inline-block";
    }
};
</script>
<template>
    <div class="relative">
        <a href="#" @click="togglePopOver()"><app-theme-icon /></a>
        <div :class="toggleClasses" class="app-popover top-8 -right-5">
            <div class="app-popover-triangle -top-5 right-0"></div>
            <div class="flex gap-4">
                <div class="w-1/2 text-text font-bold">
                    Primary Color
                    <color-picker default-color="#f0f0f0" />
                </div>
                <div class="rounded w-1/2 text-text font-bold">
                    Secondary Color
                    <color-picker />
                </div>
            </div>
        </div>
    </div>
</template>
