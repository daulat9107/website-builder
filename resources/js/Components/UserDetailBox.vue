<template>
	<div class="pl-2 shadow-2xl bg-gray-700">
		<label class="font-bold">{{ label }}</label>
		<ul class="p-2 bg-gray-800">
			<li><label class="font-bold">Name:</label> {{ user?.name }}</li>
			<li><label class="font-bold">Pan:</label> {{ user?.pan }}</li>
			<li><label class="font-bold">GSTIN:</label> {{ user?.gstin }}</li>
			<li><label class="font-bold">Mobile: </label> {{ user?.mobile }}</li>
			<li><label class="font-bold">Alternative Mobile:</label> {{ user?.alternative_mobile }}</li>
		</ul>
	</div>
</template>

<script>
import { defineComponent } from 'vue';
export default defineComponent({
	props:['user','label']
});
</script>