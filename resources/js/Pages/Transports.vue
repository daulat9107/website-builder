<template>
  <app-layout title="transports">
    <title-bar :title-stack="['Transport Page']" />
    <hero-bar>Transports</hero-bar>
    <main-section>
      <card-component title="Transports">
        <data-table :group-id="group_id" endpoint="datatable\transports" name="Transports">
        </data-table>
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
  },
  props: {
    group_id: {
      required: true
    }
  }
});
</script>
