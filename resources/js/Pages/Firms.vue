<template>
  <app-layout title="Firms">
    <title-bar :title-stack="['Firm Page']" />
    <hero-bar>Firms</hero-bar>
    <main-section>
      <card-component title="firms">
        <data-table-without-group endpoint="datatable\firms" name="Firms"></data-table-without-group>
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
import DataTableWithoutGroup from '@/Components/DataTable/DataTableWithoutGroup.vue';

export default defineComponent({
  components: {
    AppLayout,
    MainSection,
    HeroBar,
    CardComponent,
    TitleBar,
    DataTableWithoutGroup
  }
});
</script>
