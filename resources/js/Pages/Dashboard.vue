<script setup>
import AppLayout from "@/Layouts/AppLayoutV2.vue";
import AppSection from "@/Components/AppComponents/AppSection.vue";
import AppCard from "@/Components/AppComponents/AppCard.vue";
import AppTitle from "@/Components/AppComponents/AppTitle.vue";
import AppSearchOptions from "@/Components/AppComponents/AppSearchOptions.vue";
</script>

<template>
    <app-layout title="Dashboard">
        <template #main>
            <section class="p-4 pb-0 flex items-center justify-evenly">
                <h2 class="w-1/2 text-2xl text-text">Dashboard</h2>
                <app-search-options />
            </section>
            <app-section>
                <template #header>
                    <app-title>
                        <template #title> Product Total Results: </template>
                    </app-title>
                </template>
                <template #main>
                    <app-card></app-card>
                    <app-card></app-card>
                    <app-card></app-card>
                </template>
            </app-section>
            <app-section>
                <template #header>
                    <app-title>
                        <template #title> Top Results: </template>
                    </app-title>
                </template>
                <template #main>
                    <app-card></app-card>
                    <app-card></app-card>
                </template>
            </app-section>
            <app-section>
                <template #header>
                    <app-title>
                        <template #title> Charts: </template>
                    </app-title>
                </template>
                <template #main>
                    <app-card></app-card>
                    <app-card></app-card>
                    <app-card></app-card>
                    <app-card></app-card>
                    <app-card></app-card>
                </template>
            </app-section>
        </template>
    </app-layout>
</template>
