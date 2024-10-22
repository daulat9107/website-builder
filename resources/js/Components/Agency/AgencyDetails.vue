<template>
    <div class="agency-details">
        <a
            href="#"
            class="text-red-800 underline"
            v-if="agency"
            @click="toggleData()"
        >
            {{ label }}</a
        >
        <div v-if="agency && toggle" class="p-2">
            <label class="font-bold">Group: </label> {{ agency.group.name }}
            <br />
            <label class="font-bold">Added By:</label> {{ agency.user.name }} /
            {{ agency.user.email }}
            <div class="flex">
                <div class="flex-1">
                    <UserDetailBox :user="agency" label="Agency" />
                </div>
            </div>
            <div class="flex">
                <div class="flex-1">
                    <UserDetailBox :user="agency.firm" label="Firm" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import UserDetailBox from "@/Components/UserDetailBox.vue";
export default defineComponent({
    props: ["agency", "label"],
    components: {
        UserDetailBox,
    },
    data() {
        return {
            toggle: false,
        };
    },
    methods: {
        toggleData() {
            this.toggle = !this.toggle;
        },
    },
});
</script>
