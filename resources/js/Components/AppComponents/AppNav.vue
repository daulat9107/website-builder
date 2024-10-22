<script setup>
import AppUserIcon from "@/Components/AppComponents/Icons/AppUserIcon.vue";
import AppDropDownIcon from "@/Components/AppComponents/Icons/AppDropDownIcon.vue";
import AppBellIcon from "@/Components/AppComponents/Icons/AppBellIcon.vue";
import PopOver from "@/Components/AppComponents/PopOver.vue";
</script>
<template>
    <nav
        class="flex text-sm justify-end bg-background text-text items-center gap-6 h-14 shadow pr-4"
    >
        <pop-over />
        <a href="#"> <app-bell-icon /></a>
        <a href="#" class="flex items-center">
            <div class="flex items-center capitalize">
                <app-user-icon class="pr-2" />
                <span class="pr-2">{{ $page.props.auth.user.name }}</span>
                <app-drop-down-icon />
            </div>
        </a>
    </nav>
</template>
