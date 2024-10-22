<template>
  <app-layout title="order-products">
    <title-bar :title-stack="['Order Products Page']" />
    <hero-bar>Order Products</hero-bar>
    <main-section>
      <card-component title="order-products">
        <order-products-data-table :order-id="order_id" endpoint="datatable\order-products" name="Order Products"></order-products-data-table>
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
import OrderProductsDataTable from '@/Components/DataTable/OrderProductsDataTable.vue';

export default defineComponent({
  components: {
    AppLayout,
    MainSection,
    HeroBar,
    CardComponent,
    TitleBar,
    OrderProductsDataTable
  },
  props: {
    order_id: {
      required: false
    }
  }
});
</script>
