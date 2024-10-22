<template>
    <Head :title="title" />
    <nav-bar />
    <aside-menu :menu="menu" />
    <slot></slot>
    <footer-bar />
    <overlay
        v-show="isAsideLgActive"
        z-index="z-30"
        @overlay-click="overlayClick"
    />
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
    computed: {
        isAsideLgActive() {
            this.$store.state.isAsideLgActive;
        },
    },

    data() {
        return {
            showingNavigationDropdown: false,
            menu: menu,
        };
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(
                route("current-team.update"),
                {
                    team_id: team.id,
                },
                {
                    preserveState: false,
                }
            );
        },

        logout() {
            this.$inertia.post(route("logout"));
        },
        ...mapActions({
            asideLgToggle: "asideLgToggle",
        }),
        ...mapMutations(["user"]),
        overlayClick() {
            this.asideLgToggle(false);
        },
    },
    mounted() {
        this.user({
            name: this.$page.props.auth.user.name,
            email: this.$page.props.auth.user.email,
            avatar: this.$page.props.auth.user.profile_photo_url,
        });
    },
});
</script>
