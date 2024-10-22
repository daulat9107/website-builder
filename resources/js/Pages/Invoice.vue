<template>
  <app-layout title="Groups">
    <title-bar :title-stack="['Group Page']" />
    <hero-bar>Invoice</hero-bar>
    <main-section>
      <card-component title="create invoice">
      	<div class="flex">
      		<div class="flex-1 mr-2">
		        <field label="Suppliers" help="Select supplier">
			        <control
			          v-model="form.supplier_id"
			          type="select"
			          name="supplier_id"
			          placeholder="Supplier"
			          @change ="setSupplier()"
			          :options="suppliersDropDown"
			        />
		        </field>
		        
		        <SupplierDetails :supplier="supplier" label="View Supplier Details" />
      		</div>
      		<div class="flex-1">
		        <field label="Purchasers" help="Select Purchaser">
			        <control
			          v-model="form.purchaser_id"
			          type="select"
			          name="purchaser_id"
			          placeholder="Purchaser"
			          @change ="setPurchaser()"
			          :options="purchasersDropDown"
			        />
		        </field>
		        <PurchaserDetails :purchaser="purchaser" label="View Purchaser Details" />
      		</div>
      	</div>
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
import Control from '@/Components/Control.vue';
import Field from '@/Components/Field.vue';
import SupplierDetails from '@/Components/Supplier/SupplierDetails.vue';
import PurchaserDetails from '@/Components/Purchaser/PurchaserDetails.vue';
import AgencyDetails from '@/Components/Agency/AgencyDetails.vue';

export default defineComponent({
	props:[
		'suppliers',
		'suppliersDropDown',
		'purchasers',
		'purchasersDropDown',
		'agencies',
		'agenciesDropDown'
	],
  components: {
    AppLayout,
    MainSection,
    HeroBar,
    CardComponent,
    TitleBar,
    Control,
    Field,
    SupplierDetails,
    PurchaserDetails,
    AgencyDetails
  },
  data() {
	    return {
	    	form:{
	    		supplier_id:null,
	    		purchaser_id:null,
	    	},
	    	supplier: null,
	    	purchaser: null
	    }
	},
methods: {
	setSupplier(){
		this.supplier = this.suppliers.find((supplier) => {
			 return this.form.supplier_id === supplier.id 
		});
	},
	setPurchaser(){
		this.purchaser = this.purchasers.find((purchaser) => {
			return this.form.purchaser_id === purchaser.id;
		});
	}
}
});
</script>
