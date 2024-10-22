<template>
  <app-layout title="Suppliers">
    <title-bar :title-stack="['Supplier Page']" />
    <hero-bar>Purchasers</hero-bar>
    <main-section>
      <card-component title="Suppliers">
        <data-table endpoint="datatable\suppliers" name="Suppliers"></data-table>
      </card-component>
    </main-section>
  </app-layout>
</template>

<script>
import { defineComponent } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import MainSection from '@/Components/MainSection.vue';
import HeroBar from '@/Components/HeroBar.vue';
import TitleBar from '@/Components/TitleBar.vue';
import CardComponent from '@/Components/CardComponent.vue';
import DataTable from '@/Components/DataTable/DataTable.vue';

export default defineComponent({
  components: {
    AppLayout,
    MainSection,
    HeroBar,
    CardComponent,
    TitleBar,
    DataTable
  }
});
</script>
