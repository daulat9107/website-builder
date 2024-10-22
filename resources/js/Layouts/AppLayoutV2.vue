<script setup>
import AppAside from "@/Components/AppComponents/AppAside.vue";
import AppNav from "@/Components/AppComponents/AppNav.vue";
</script>
<template>
    <div class="flex gap-2 mb-2">
        <app-aside class="w-1/5 min-h-screen"></app-aside>
        <main class="w-4/5 bg-background-900 min-h-screen">
            <header>
                <app-nav></app-nav>
            </header>
            <main class="space-y-4" @theme-changed="doSomething()">
                <slot name="main"></slot>
            </main>
        </main>
    </div>
</template>
