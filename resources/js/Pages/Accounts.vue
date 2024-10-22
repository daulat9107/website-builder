<template>
    <app-layout title="Accounts">
        <title-bar :title-stack="['Account Page']" />
        <hero-bar>Accounts</hero-bar>
        <main-section>
            <card-component title="Accounts">
                <data-table
                    :group-id="group_id"
                    endpoint="datatable/accounts"
                    name="Accounts"
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
    props: {
        group_id: {
            required: true,
        },
    },
});
</script>
