<template>
<div class="supplier-details">
	<a href="#" class="text-red-800 underline" v-if="supplier" @click="toggleData()" > {{ label }}</a>
	<div v-if="supplier && toggle" class="p-2">
		<label class="font-bold">Group: </label> {{ supplier.group.name }} <br>
		<label class="font-bold">Added By:</label> {{ supplier.user.name }} / {{ supplier.user.email }}
	    <div class="flex">
	    	<div class="flex-1">
	        	<UserDetailBox 
		        	:user="supplier" 
		        	label="Supplier"
	        	/>
	    	</div>
	    </div>
	    <div class="flex">
	    	<div class="flex-1">
	        	<UserDetailBox 
		        	:user="supplier.firm" 
		        	label="Supplier Firm"
	        	/>
	        	<UserAddressBox 
		        	:address="supplier.addresses[0]" 
		        	label="Supplier Address"
	        	/>
	        	<UserAccountBox 
		        	:account="supplier.accounts[0]" 
		        	label="Supplier Account"
	        	/>
	    	</div>
	    	<div class="flex-1">
	        	<UserDetailBox 
		        	:user="supplier.agency" 
		        	label="Supplier Agency"
	        	/>
	        	<UserDetailBox 
		        	:user="supplier.agency.firm" 
		        	label="Supplier Agency Firm"
	        	/>
	        	<UserAddressBox 
		        	:address="supplier.agency.addresses[0]" 
		        	label="Supplier Agency Address"
	        	/>
	        	<UserAccountBox 
		        	:account="supplier.agency.accounts[0]" 
		        	label="Supplier Agency Account"
	        	/>
	    	</div>
	    </div>
	</div>
</div>
</template>

<script>
	import { defineComponent } from 'vue';
	import UserDetailBox from '@/Components/UserDetailBox.vue';
	import UserAddressBox from '@/Components/UserAddressBox.vue';
	import UserAccountBox from '@/Components/UserAccountBox.vue';
	export default defineComponent({
		props:['supplier','label'],
		components: {
		    UserDetailBox,
		    UserAddressBox,
		    UserAccountBox
		},
		data() {
			return {
				toggle: false
			}
		},
		methods:{
			toggleData() {
				this.toggle = !this.toggle
			}
		}
	});

</script>