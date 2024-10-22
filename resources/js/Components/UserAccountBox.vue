<template>
	<div class="pl-2 shadow-2xl bg-gray-700">
		<label class="font-bold">{{ label }}</label>
		<ul class="p-2 bg-gray-800">
			<li><label class="font-bold">Name:</label> {{ account?.name }}</li>
			<li><label class="font-bold">Account No:</label> {{ account?.account_no }}</li>
			<li><label class="font-bold">IFSC Code:</label> {{ account?.ifsc_code }} </li>
			<li><label class="font-bold">Bank Name:</label> {{ account?.bank_name }}</li>
			<li><label class="font-bold">Branch Name: </label> {{ account?.branch_name }}</li>
		</ul>
	</div>
</template>
<script>
import { defineComponent } from 'vue';
export default defineComponent({
	props:['account','label']
});
</script>