<template>
    <div
        class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group"
        :class="{ 'is-active': itemIsActive }"
    >
        <div
            class="flex items-center justify-center w-10 h-10 rounded-full border border-white dark:border-slate-700 dark:bg-slate-700 bg-slate-300 group-[.is-active]:bg-emerald-500 text-slate-500 dark:text-slate-300 group-[.is-active]:text-emerald-50 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2"
        >
            <template v-if="itemIsActive">
                <svg-icon type="mdi" :path="checkBold"></svg-icon>
            </template>
            <template v-else>
                <svg-icon type="mdi" :path="home"></svg-icon>
            </template>
        </div>
        <div
            class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white dark:bg-slate-900 p-4 rounded border border-slate-200 dark:border-slate-800 shadow"
        >
            <div class="flex items-center justify-between space-x-2 mb-1">
                <div class="font-bold text-slate-900 dark:text-white">
                    <slot name="itemStatus"></slot>
                </div>
                <time class="font-caveat font-medium text-indigo-500">
                    <slot name="itemDate"></slot>
                </time>
            </div>
            <div class="text-slate-500 dark:text-white">
                <slot name="itemDescription"></slot>
            </div>
        </div>
    </div>
</template>
<script>
import { defineComponent } from "vue";
import { mdiCheckBold, mdiHome } from "@mdi/js";
import SvgIcon from "@jamescoyle/vue-icon";
export default defineComponent({
    components: {
        SvgIcon,
    },
    data() {
        return {
            checkBold: mdiCheckBold,
            home: mdiHome,
        };
    },
    props: {
        itemIsActive: {
            required: false,
            default: false,
        },
    },
});
</script>
