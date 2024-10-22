<template>
    <Head :title="title" />
    <slot></slot>
</template>
<script>
import { defineComponent } from "vue";
import JetApplicationMark from "@/Components/ApplicationMark.vue";
import JetBanner from "@/Components/Banner.vue";
import JetDropdown from "@/Components/Dropdown.vue";
import JetDropdownLink from "@/Components/DropdownLink.vue";
import JetNavLink from "@/Components/NavLink.vue";
import JetResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import menu from "@/menu.js";
import NavBar from "@/Components/NavBar.vue";
import AsideMenu from "@/Components/AsideMenu.vue";
import FooterBar from "@/Components/FooterBar.vue";
import Overlay from "@/Components/Overlay.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { mapMutations, mapActions } from "vuex";

export default defineComponent({
    props: {
        title: String,
    },

    components: {
        Head,
        JetApplicationMark,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        Link,
        NavBar,
        AsideMenu,
        FooterBar,
        Overlay,
    },
    computed: {},

    data() {
        return {};
    },

    methods: {},
    mounted() {},
});
</script>
