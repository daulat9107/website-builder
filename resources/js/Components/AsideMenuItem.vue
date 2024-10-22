<template>
    <li>
        <component
            :is="componentIs"
            v-slot="vSlot"
            :href="itemTo"
            :target="itemTarget"
            class="flex cursor-pointer hover:bg-background-600 hover:bg-opacity-50 dark:hover:bg-background-700 dark:hover:bg-opacity-50"
            :class="[isSubmenuList ? 'p-3 text-sm' : 'py-2']"
            @click="menuClick"
        >
            <icon
                v-if="item.icon"
                :path="item.icon"
                class="flex-none"
                :class="[
                    vSlot && vSlot.isExactActive ? styleActive : styleInactive,
                ]"
                w="w-12"
            />
            <span
                class="grow"
                :class="[
                    vSlot && vSlot.isExactActive ? styleActive : styleInactive,
                ]"
                >{{ item.label }}</span
            >
            <icon
                v-if="hasDropdown"
                :path="dropdownIcon"
                class="flex-none"
                :class="[
                    vSlot && vSlot.isExactActive ? styleActive : styleInactive,
                ]"
                w="w-12"
            />
        </component>
        <aside-menu-list
            v-if="hasDropdown"
            :menu="item.menu"
            :class="{
                hidden: !isDropdownActive,
                'block bg-background-700 bg-opacity-50 dark:bg-background-800 dark:bg-opacity-50':
                    isDropdownActive,
            }"
            is-submenu-list
        />
    </li>
</template>
<script setup>
import { ref, computed, defineComponent } from "vue";
import { mdiMinus, mdiPlus } from "@mdi/js";
import Icon from "@/Components/Icon.vue";
import AsideMenuList from "@/Components/AsideMenuList.vue";
import AsideLink from "@/Components/AsideLink.vue";

const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
    isSubmenuList: Boolean,
});

const emit = defineEmits(["menu-click"]);

const isDropdownActive = ref(false);

const componentIs = computed(() => (props.item.to ? "aside-link" : "a"));

const hasDropdown = computed(() => !!props.item.menu);

const dropdownIcon = computed(() =>
    isDropdownActive.value ? mdiMinus : mdiPlus
);

const itemTo = computed(() => props.item.to || null);

const itemHref = computed(() => props.item.href || null);

const itemTarget = computed(() =>
    componentIs.value === "a" && props.item.target ? props.item.target : null
);

const menuClick = (event) => {
    emit("menu-click", event, props.item);
    console.log(props.item);

    if (hasDropdown.value) {
        isDropdownActive.value = !isDropdownActive.value;
    }
};

const styleActive = "font-bold text-text";

const styleInactive = "text-text-300";
</script>
<script>
export default defineComponent({
    components: {
        AsideLink,
    },
});
</script>
