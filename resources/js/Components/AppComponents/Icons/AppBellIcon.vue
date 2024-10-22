<script setup>
import { computed } from "vue";
import { useStore } from "vuex";
const store = useStore();
const stroke = computed(() => store.getters["theme/getIconColor"]);
</script>
<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="27"
        height="27"
        viewBox="0 0 27 27"
    >
        <g id="bell_notification_icon" transform="translate(1.5 1.5)">
            <path
                id="Path_3"
                data-name="Path 3"
                d="M22.056,14.007c.733,7.171,3.609,9.339,3.609,9.339H3S6.778,20.5,6.778,10.538A9.133,9.133,0,0,1,8.991,4.5,7.143,7.143,0,0,1,14.333,2a6.708,6.708,0,0,1,1.259.119"
                transform="translate(-3 -2)"
                fill="none"
                :stroke="stroke"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="3"
            />
            <path
                id="Path_4"
                data-name="Path 4"
                d="M20,10a4,4,0,1,0-4-4A4,4,0,0,0,20,10Z"
                transform="translate(-0.005 -2)"
                fill="none"
                :stroke="stroke"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="3"
            />
            <path
                id="Path_5"
                data-name="Path 5"
                d="M14.886,21a2.668,2.668,0,0,1-4.616,0"
                transform="translate(-1.202 1.671)"
                fill="none"
                :stroke="stroke"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="3"
            />
        </g>
    </svg>
</template>
