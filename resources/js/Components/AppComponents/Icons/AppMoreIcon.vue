<script setup>
import { computed } from "vue";
import { useStore } from "vuex";
const store = useStore();
const fill = computed(() => store.getters["theme/getIconColor"]);
</script>
<template>
    <svg
        id="Group_1"
        data-name="Group 1"
        xmlns="http://www.w3.org/2000/svg"
        width="10"
        height="37"
        viewBox="0 0 10 37"
    >
        <circle
            id="Ellipse_1"
            data-name="Ellipse 1"
            cx="5"
            cy="5"
            r="5"
            :fill="fill"
        />
        <ellipse
            id="Ellipse_2"
            data-name="Ellipse 2"
            cx="5"
            cy="5.5"
            rx="5"
            ry="5.5"
            transform="translate(0 13)"
            :fill="fill"
        />
        <ellipse
            id="Ellipse_3"
            data-name="Ellipse 3"
            cx="5"
            cy="5.5"
            rx="5"
            ry="5.5"
            transform="translate(0 26)"
            :fill="fill"
        />
    </svg>
</template>
