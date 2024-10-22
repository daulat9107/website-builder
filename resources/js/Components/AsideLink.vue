<template>
    <Link
        :href="href"
        class="flex cursor-pointer hover:bg-background-600 hover:bg-opacity-50 dark:hover:bg-background-700 dark:hover:bg-opacity-50 py-2 text-text"
    >
        <slot />
    </Link>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/vue3";

export default defineComponent({
    components: {
        Link,
    },
    props: ["href", "active"],
});
</script>
