<script setup>
import { computed } from "vue";
import { useStore } from "vuex";
const store = useStore();
const fill = computed(() => store.getters["theme/getIconColor"]);
</script>
<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="16.173"
        viewBox="0 0 24 16.173"
    >
        <path
            id="down_b_arrow_icon"
            d="M96.218,162.082l.135.177,10.2,13.19a1.815,1.815,0,0,0,1.44.725,1.84,1.84,0,0,0,1.44-.725l10.192-13.165.173-.219a1.417,1.417,0,0,0,.2-.733A1.29,1.29,0,0,0,118.755,160H97.245A1.29,1.29,0,0,0,96,161.332,1.4,1.4,0,0,0,96.218,162.082Z"
            transform="translate(-96 -160)"
            :fill="fill"
        />
    </svg>
</template>
