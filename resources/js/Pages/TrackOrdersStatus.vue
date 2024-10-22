<template>
  <app-layout title="Track Orders Status">
    <title-bar :title-stack="['Order Track Orders Status']" />
    <hero-bar>Track Orders</hero-bar>
    <main-section>
      <card-component title="track-orders-status">
        <order-track-status-data-table endpoint="datatable\track-orders-status" name="track-orders-statu"></order-track-status-data-table>
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
import OrderTrackStatusDataTable from '@/Components/DataTable/OrderTrackStatusDataTable.vue';

export default defineComponent({
  components: {
    AppLayout,
    MainSection,
    HeroBar,
    CardComponent,
    TitleBar,
    OrderTrackStatusDataTable
  }
});
</script>
