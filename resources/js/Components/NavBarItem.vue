<template>
    <component
        :is="is"
        :class="componentClass"
        :to="to"
        :href="href"
        :exact-active-class="activeClass"
    >
        <slot />
    </component>
</template>
<script>
import { defineComponent, computed } from "vue";
import JetNavLink from "@/Components/NavLink.vue";

export default defineComponent({
    props: {
        href: {
            type: String,
            default: null,
        },
        to: {
            type: String,
            default: null,
        },
        type: {
            type: String,
            default: "flex",
        },
        activeColor: {
            type: String,
            default: "text-blue-600",
        },
        hasDivider: Boolean,
        isDesktopIconOnly: Boolean,
        dropdown: Boolean,
        active: Boolean,
    },

    components: {
        JetNavLink,
    },
    computed: {
        is() {
            if (this.href) {
                return "jet-nav-link";
            }

            if (this.to) {
                return "a";
            }

            return "div";
        },
        componentClass() {
            const base = [
                this.type,
                "items-center",
                "grow-0",
                "shrink-0",
                "relative",
                "cursor-pointer",
                "hover:text-blue-500",
                this.active
                    ? this.activeColor
                    : "text-black dark:text-white dark:hover:text-gray-400",
            ];

            if (this.type === "block") {
                base.push("lg:flex");
            }

            if (!this.dropdown) {
                base.push("py-2", "px-3");
            } else {
                base.push("p-0", "lg:py-2", "lg:px-3");
            }

            if (this.hasDivider) {
                base.push(
                    "lg:border-r",
                    "lg:border-gray-100",
                    "lg:dark:border-gray-800"
                );
            }

            if (this.isDesktopIconOnly) {
                base.push("lg:w-16", "lg:justify-center");
            }

            return base;
        },
        activeClass() {
            return this.is === "jet-nav-link" ? this.activeColor : null;
        },
    },
});
</script>
