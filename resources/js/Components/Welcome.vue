<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    website_type: "",
    pages: "",
    template: "",
});
const submit = () => {
    console.log("add");
};
</script>

<template>
    <div class="m-4">
        <h2 class="p-4">Websites</h2>
        <hr />
        <form class="p-4" @submit.prevent="submit">
            <div>
                <InputLabel for="website_type" value="Website Type" />
                <TextInput
                    id="website_type"
                    v-model="form.website_type"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.website_type" />
            </div>

            <div class="mt-4">
                <InputLabel for="pages" value="Default Pages" />
                <TextInput
                    id="pages"
                    v-model="form.pages"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.pages" />
            </div>

            <div class="mt-4">
                <InputLabel for="template" value="Template" />
                <TextInput
                    id="pages"
                    v-model="form.template"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.template" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Add
                </PrimaryButton>
            </div>
        </form>
    </div>
</template>
