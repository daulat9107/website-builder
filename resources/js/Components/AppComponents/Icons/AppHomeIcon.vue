<script setup>
import { computed } from "vue";
import { useStore } from "vuex";
const store = useStore();
const fill = computed(() => store.getters["theme/getIconColor"]);
</script>
<template>
    <svg
        id="Home_icon"
        data-name="Home icon"
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
    >
        <g id="Core">
            <g id="home">
                <path
                    id="Shape"
                    d="M9.6,24V15.529h4.8V24h6V12.706H24L12,0,0,12.706H3.6V24Z"
                    :fill="fill"
                    fill-rule="evenodd"
                />
            </g>
        </g>
    </svg>
</template>
