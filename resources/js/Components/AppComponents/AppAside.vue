<script setup>
import ApplicationLogo from "@/Components/AppComponents/ApplicationLogo.vue";
import Divider from "@/Components/AppComponents/Divider.vue";
import AppHomeIcon from "@/Components/AppComponents/Icons/AppHomeIcon.vue";
import AppThemeIcon from "@/Components/AppComponents/Icons/AppThemeIcon.vue";
import AppUserIcon from "@/Components/AppComponents/Icons/AppUserIcon.vue";
import PopOver from "@/Components/AppComponents/PopOver.vue";
</script>
<template>
    <aside class="w-1/5 bg-background min-h-screen">
        <div class="flex flex-col justify-center items-center">
            <application-logo />
            <div class="rounded-full w-12 h-12 bg-background-400"></div>
            <h3 class="text-accent-400 text-lg">Welcome back</h3>
            <div class="text-text text-lg">Daulat Wadhwani</div>
        </div>
        <divider />
        <menu class="flex flex-col gap-2 pt-4 text-text text-lg">
            <li class="bg-background-700 py-2 pl-4 font-bold">
                <a class="flex gap-2" href="http://localhost/dashboard"
                    ><app-home-icon /><span>Dashboard</span></a
                >
            </li>
            <li class="py-2 pl-4">
                <a class="flex gap-2" href="http://localhost/themes"
                    ><app-theme-icon /><span>Themes</span></a
                >
            </li>
            <li class="py-2 pl-4">
                <a class="flex gap-2" href="http://localhost/themes"
                    ><app-user-icon /><span>Other</span></a
                >
            </li>
        </menu>
    </aside>
</template>
