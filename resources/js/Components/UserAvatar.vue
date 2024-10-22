<script setup>
const props = defineProps({
    username: {
        type: String,
        default: null,
    },
    bg: {
        type: String,
        default: "bg-background-100 dark:bg-background-800",
    },
    api: {
        type: String,
        default: "api/avataaars",
    },
});
</script>

<template>
    <div>
        <img
            :src="$page.props.auth.user.profile_photo_url"
            :alt="$page.props.auth.user.name"
            class="rounded-full block h-auto w-full max-w-full"
            :class="bg"
        />
    </div>
</template>
