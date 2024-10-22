<template>
    <nav-bar guest />
    <main-section :class="componentClass">
        <slot
            card-class="w-11/12 md:w-7/12 lg:w-6/12 xl:w-4/12 shadow-2xl"
            card-rounded="rounded-lg"
        />
    </main-section>
</template>
<script setup>
import { computed } from "vue";
import { useStore } from "vuex";
import MainSection from "@/Components/MainSection.vue";
import NavBar from "@/Components/NavBar.vue";

const props = defineProps({
    bg: {
        type: String,
        required: true,
        validator: (value) => ["login", "error"].includes(value),
    },
});

const store = useStore();

const darkMode = computed(() => store.state.darkMode);

const componentClass = computed(() => {
    const bgs = {
        login: "px-0 md:px-6 flex h-screen items-center justify-center bg-gradient-to-br from-cyan-500 via-blue-500 to-violet-400",
        loginDark:
            "px-0 md:px-6 flex h-screen items-center justify-center bg-gradient-to-br from-sky-800 via-blue-900 to-violet-800",
        error: "bg-gradient-to-br from-sky-400 via-blue-500 to-violet-400",
        errorDark: "bg-gradient-to-br from-sky-800 via-blue-900 to-violet-800",
    };

    const bgKey = darkMode.value ? `${props.bg}Dark` : props.bg;

    return bgs[bgKey] ?? "";
});

store.dispatch("asideMobileToggle", false);
</script>
