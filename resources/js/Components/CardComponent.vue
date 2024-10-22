<template>
    <component
        :is="is"
        :class="componentClass"
        class="bg-background-100 border border-background-100 dark:bg-background-950 dark:border-background-900"
        @submit="submit"
    >
        <header
            v-if="title"
            class="flex items-stretch border-b border-background-100 dark:border-background-700 text-text-950 dark:text-text"
        >
            <p
                class="flex items-center py-3 grow font-bold"
                :class="[icon ? 'px-4' : 'px-6']"
            >
                <icon v-if="icon" :path="icon" class="mr-3" />
                {{ title }}
            </p>
            <a
                v-if="computedHeaderIcon"
                href="#"
                class="flex items-center py-3 px-4 justify-center ring-primary-700 focus:ring"
                aria-label="more options"
                @click.prevent="headerIconClick"
            >
                <icon :path="computedHeaderIcon" />
            </a>
        </header>
        <div
            v-if="empty"
            class="text-center py-24 text-text-500 dark:text-text-400"
        >
            <p>Nothing's here…</p>
        </div>
        <div
            v-else
            :class="{ 'p-6': !hasTable }"
            class="text-text-950 dark:text-text"
        >
            <slot />
        </div>
    </component>
</template>
<script setup>
import { mdiCog } from "@mdi/js";
import { computed } from "vue";
import Icon from "@/Components/Icon.vue";

const props = defineProps({
    title: {
        type: String,
        default: null,
    },
    icon: {
        type: String,
        default: null,
    },
    headerIcon: {
        type: String,
        default: null,
    },
    rounded: {
        type: String,
        default: "md:rounded",
    },
    hasTable: Boolean,
    empty: Boolean,
    form: Boolean,
    hoverable: Boolean,
});

const emit = defineEmits(["header-icon-click", "submit"]);

const is = computed(() => (props.form ? "form" : "div"));

const componentClass = computed(() => {
    const base = [props.rounded];

    if (props.hoverable) {
        base.push("hover:shadow-lg transition-shadow duration-500");
    }

    return base;
});

const computedHeaderIcon = computed(() => props.headerIcon ?? mdiCog);

const headerIconClick = () => {
    emit("header-icon-click");
};

const submit = (e) => {
    emit("submit", e);
};
</script>
