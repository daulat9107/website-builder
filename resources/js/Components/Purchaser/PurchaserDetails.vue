<template>
<div class="purchaser-details">
	<a href="#" class="text-red-800 underline" v-if="purchaser" @click="toggleData()" > {{ label }}</a>
	<div v-if="purchaser && toggle" class="p-2">
		<label class="font-bold">Group: </label> {{ purchaser.group.name }} <br>
		<label class="font-bold">Added By:</label> {{ purchaser.user.name }} / {{ purchaser.user.email }}
	    <div class="flex">
	    	<div class="flex-1">
	        	<UserDetailBox 
		        	:user="purchaser" 
		        	label="Purchaser"
	        	/>
	    	</div>
	    </div>
	    <div class="flex">
	    	<div class="flex-1">
	        	<UserDetailBox 
		        	:user="purchaser.firm" 
		        	label="Firm"
	        	/>
	    	</div>
	    	<div class="flex-1">
	        	<UserDetailBox 
		        	:user="purchaser.agency" 
		        	label="Agency"
	        	/>
	    	</div>
	    </div>
	</div>
</div>
</template>

<script>
	import { defineComponent } from 'vue';
	import UserDetailBox from '@/Components/UserDetailBox.vue';
	export default defineComponent({
		props:['purchaser','label'],
		components: {
		    UserDetailBox
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