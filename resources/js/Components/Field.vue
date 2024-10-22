<script setup>
import { computed, useSlots } from "vue";

const props = defineProps({
    label: {
        type: String,
        default: null,
    },
    help: {
        type: String,
        default: null,
    },
    hasError: {
        type: Boolean,
        default: false,
    },
});

const slots = useSlots();

const emit = defineEmits("[reset-has-error]");

const wrapperClass = computed(() => {
    const base = [];
    const slotsLength = slots.default().length;

    if (slotsLength > 1) {
        base.push("grid grid-cols-1 gap-3");
    }

    if (slotsLength === 2) {
        base.push("md:grid-cols-2");
    }
    if (props.hasError) {
        base.push("border border-danger-950 dark:border-danger");
    }

    return base;
});
const helpClass = computed(() => {
    const base = [];
    if (props.hasError) {
        base.push("text-danger-950 dark:text-danger");
    } else {
        base.push("text-text-500 dark:text-text-400");
    }
    return base;
});
const labelClass = computed(() => {
    const base = [];
    if (props.hasError) {
        base.push("text-danger-950 dark:text-danger");
    } else {
        base.push("text-text-500 dark:text-text-400");
    }
    return base;
});
</script>

<template>
    <div class="mb-6 last:mb-0">
        <label
            v-if="label"
            :class="labelClass"
            class="block font-bold mb-2 text-text-950 dark:text-text"
            >{{ label }}</label
        >
        <div :class="wrapperClass">
            <slot />
        </div>
        <div v-if="help" :class="helpClass" class="text-xs mt-1">
            {{ help }}
        </div>
    </div>
</template>
