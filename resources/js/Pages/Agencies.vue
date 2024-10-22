<template>
    <app-layout title="Agencies">
        <title-bar :title-stack="['Agency Page']" />
        <hero-bar>Agencies</hero-bar>
        <main-section>
            <card-component title="agencies">
                <data-table
                    endpoint="datatable\agencies"
                    name="Agencies"
                ></data-table>
            </card-component>
        </main-section>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import MainSection from "@/Components/MainSection.vue";
import HeroBar from "@/Components/HeroBar.vue";
import TitleBar from "@/Components/TitleBar.vue";
import CardComponent from "@/Components/CardComponent.vue";
import DataTable from "@/Components/DataTable/DataTable.vue";

export default defineComponent({
    components: {
        AppLayout,
        MainSection,
        HeroBar,
        CardComponent,
        TitleBar,
        DataTable,
    },
});
</script>
