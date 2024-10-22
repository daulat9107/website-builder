<script setup>
import { computed } from "vue";
import { useStore } from "vuex";
const store = useStore();
const fill = computed(() => store.getters["theme/getIconColor"]);
</script>
<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        width="220"
        height="96"
        viewBox="0 0 220 96"
    >
        <defs>
            <filter
                id="JexLify"
                x="0"
                y="0"
                width="220"
                height="96"
                filterUnits="userSpaceOnUse"
            >
                <feOffset dx="9" dy="10" input="SourceAlpha" />
                <feGaussianBlur stdDeviation="6.5" result="blur" />
                <feFlood flood-opacity="0.161" />
                <feComposite operator="in" in2="blur" />
                <feComposite in="SourceGraphic" />
            </filter>
        </defs>
        <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#JexLify)">
            <text
                id="JexLify-2"
                data-name="JexLify"
                transform="translate(10.5 54.5)"
                :fill="fill"
                font-size="48"
                font-family="Roboto-Bold, Roboto"
                font-weight="700"
                opacity="0.997"
            >
                <tspan x="0" y="0">JEXLIFY</tspan>
            </text>
        </g>
    </svg>
</template>
