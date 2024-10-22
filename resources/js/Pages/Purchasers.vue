<template>
  <app-layout title="Purchasers">
    <title-bar :title-stack="['Purchaser Page']" />
    <hero-bar>Purchasers</hero-bar>
    <main-section>
      <card-component title="Purchasers">
        <data-table endpoint="datatable\purchasers" name="Purchaser"></data-table>
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
import DataTable from '@/Components/DataTable/PurchaserDataTable.vue';

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
