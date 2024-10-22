<template>
  <app-layout title="Orders">
    <title-bar :title-stack="['Order Page']" />
    <hero-bar>Orders</hero-bar>
    <main-section>
      <card-component title="firms">
        <orders-data-table :id="id" endpoint="datatable\orders" name="Orders"></orders-data-table>
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
import OrdersDataTable from '@/Components/DataTable/OrdersDataTable.vue';

export default defineComponent({
  components: {
    AppLayout,
    MainSection,
    HeroBar,
    CardComponent,
    TitleBar,
    OrdersDataTable
  },
  props: {
   id: {
      required: false
    }
  }
});
</script>
