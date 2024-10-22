<script setup>
import { computed } from "vue";
import { useStore } from "vuex";
const store = useStore();
const fill = computed(() => store.getters["theme/getIconColor"]);
</script>
<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24.891"
        height="24.891"
        viewBox="0 0 24.891 24.891"
    >
        <path
            id="_8726390_user_icon"
            data-name="8726390_user_icon"
            d="M19.131,15.323a7.493,7.493,0,1,0-9.28,0A12.448,12.448,0,0,0,2.072,25.5a1.258,1.258,0,0,0,2.5.274,10.012,10.012,0,0,1,19.886,0,1.248,1.248,0,0,0,1.251,1.107h.138a1.245,1.245,0,0,0,1.1-1.368,12.448,12.448,0,0,0-7.817-10.187Zm-4.64-.883a4.975,4.975,0,1,1,5-4.975A4.989,4.989,0,0,1,14.491,14.439Z"
            transform="translate(-2.064 -1.995)"
            :fill="fill"
        />
    </svg>
</template>
