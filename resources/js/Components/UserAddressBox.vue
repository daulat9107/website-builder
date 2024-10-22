<template>
	<div class="pl-2 shadow-2xl bg-gray-700">
		<label class="font-bold">{{ label }}</label>
		<ul class="p-2 bg-gray-800">
			<li><label class="font-bold">Name:</label> {{ address?.name }}</li>
			<li><label class="font-bold">Address:</label> {{ address?.address }}</li>
			<li><label class="font-bold">State:</label> {{ address?.city?.state.name }} </li>
			<li><label class="font-bold">City:</label> {{ address?.city?.name }}</li>
			<li><label class="font-bold">Pincode: </label> {{ address?.pincode }}</li>
		</ul>
	</div>
</template>
<script>
import { defineComponent } from 'vue';
export default defineComponent({
	props:['address','label']
});
</script>