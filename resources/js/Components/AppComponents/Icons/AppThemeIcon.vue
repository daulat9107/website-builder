<script setup>
import { computed } from "vue";
import { useStore } from "vuex";
const store = useStore();
const fill = computed(() => store.getters["theme/getIconColor"]);
</script>
<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="27"
        height="27"
        viewBox="0 0 27 27"
    >
        <g id="color_palette_outline_icon" transform="translate(-62.485 -62.5)">
            <path
                id="Path_48"
                data-name="Path 48"
                d="M86.866,81.744a2.918,2.918,0,0,0-1.537-.562,2.288,2.288,0,0,1-1.412-.625,1.733,1.733,0,0,1,0-2.737l1.894-1.681a6.085,6.085,0,0,0,0-9.325A12.015,12.015,0,0,0,77.823,64,15.108,15.108,0,0,0,67.9,67.756a10.951,10.951,0,0,0,0,16.781A14.631,14.631,0,0,0,77.454,88h.106a14.064,14.064,0,0,0,9.3-3.275A2.111,2.111,0,0,0,86.866,81.744Z"
                transform="translate(0)"
                fill="none"
                :stroke="fill"
                stroke-miterlimit="10"
                stroke-width="3"
            />
            <circle
                id="Ellipse_12"
                data-name="Ellipse 12"
                cx="2.171"
                cy="2.171"
                r="2.171"
                transform="translate(67.242 70.881)"
                :fill="fill"
            />
            <circle
                id="Ellipse_13"
                data-name="Ellipse 13"
                cx="2.171"
                cy="2.171"
                r="2.171"
                transform="translate(67.635 77.208)"
                :fill="fill"
            />
            <circle
                id="Ellipse_14"
                data-name="Ellipse 14"
                cx="2.171"
                cy="2.171"
                r="2.171"
                transform="translate(71.849 67.256)"
                :fill="fill"
            />
            <circle
                id="Ellipse_15"
                data-name="Ellipse 15"
                cx="3.256"
                cy="3.256"
                r="3.256"
                transform="translate(72.729 79.249)"
                :fill="fill"
            />
            <circle
                id="Ellipse_16"
                data-name="Ellipse 16"
                cx="2.171"
                cy="2.171"
                r="2.171"
                transform="translate(78.237 67.256)"
                :fill="fill"
            />
        </g>
    </svg>
</template>
