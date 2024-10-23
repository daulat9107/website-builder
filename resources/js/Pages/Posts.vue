<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import MainSection from "@/Components/MainSection.vue";
import HeroBar from "@/Components/HeroBar.vue";
import TitleBar from "@/Components/TitleBar.vue";
import CardComponent from "@/Components/CardComponent.vue";
import DataTable from "@/Components/DataTable/PostDataTable.vue";
</script>

<template>
    <app-layout title="Posts">
        <title-bar :title-stack="['Post Page']" />
        <hero-bar>Posts</hero-bar>
        <main-section>
            <card-component title="Posts">
                <data-table
                    endpoint="datatable/posts"
                    name="Posts"
                ></data-table>
            </card-component>
        </main-section>
    </app-layout>
</template>
