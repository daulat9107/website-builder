<template>
    <aside
        id="aside"
        class="w-60 top-0 z-40 bg-background-100 transition-position m:left-0 dark:border-r dark:border-background-800 dark:bg-background"
        :class="[
            isAsideMobileExpanded ? 'left-0' : '-left-60',
            isDemoAsideMenu ? '' : 'fixed h-screen',
        ]"
    >
        <div
            class="flex flex-row w-full text-text flex-1 h-14 items-center text-4xl"
        >
            <div class="flex-1 px-3"><b>Logo</b></div>
        </div>
        <div>
            <template v-for="(menuGroup, index) in menu">
                <p
                    v-if="typeof menuGroup === 'string'"
                    :key="`a-${index}`"
                    class="p-3 text-xs uppercase text-text-400"
                >
                    {{ menuGroup }}
                </p>
                <aside-menu-list
                    v-else
                    :key="`b-${index}`"
                    :menu="menuGroup"
                    @menu-click="menuClick"
                />
            </template>
        </div>
    </aside>
</template>
<script setup>
import { computed } from "vue";
import { useStore } from "vuex";
import AsideMenuList from "@/Components/AsideMenuList.vue";
defineProps({
    menu: {
        type: Array,
        default: () => [],
    },
    isDemoAsideMenu: false,
});

const store = useStore();

const isAsideMobileExpanded = computed(() => store.state.isAsideMobileExpanded);

const menuClick = (event, item) => {};
</script>
