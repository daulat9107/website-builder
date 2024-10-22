<script setup>
import { computed, ref } from "vue";
import { useStore } from "vuex";
import { mdiEye, mdiTrashCan } from "@mdi/js";
import ModalBox from "@/Components/ModalBox.vue";
import CheckboxCell from "@/Components/CheckboxCell.vue";
import Level from "@/Components/Level.vue";
import JbButtons from "@/Components/JbButtons.vue";
import JbButton from "@/Components/JbButton.vue";
import UserAvatar from "@/Components/UserAvatar.vue";

defineProps({
    checkable: Boolean,
});

const store = useStore();

const darkMode = computed(() => store.state.darkMode);

const items = computed(() => store.state.clients);

const isModalActive = ref(false);

const isModalDangerActive = ref(false);

const perPage = ref(10);

const currentPage = ref(0);

const checkedRows = ref([]);

const itemsPaginated = computed(() =>
    items.value.slice(
        perPage.value * currentPage.value,
        perPage.value * (currentPage.value + 1)
    )
);

const numPages = computed(() => Math.ceil(items.value.length / perPage.value));

const currentPageHuman = computed(() => currentPage.value + 1);

const pagesList = computed(() => {
    const pagesList = [];

    for (let i = 0; i < numPages.value; i++) {
        pagesList.push(i);
    }

    return pagesList;
});

const remove = (arr, cb) => {
    const newArr = [];

    arr.forEach((item) => {
        if (!cb(item)) {
            newArr.push(item);
        }
    });

    return newArr;
};

const checked = (isChecked, client) => {
    if (isChecked) {
        checkedRows.value.push(client);
    } else {
        checkedRows.value = remove(
            checkedRows.value,
            (row) => row.id === client.id
        );
    }
};
</script>

<template>
    <modal-box v-model="isModalActive" title="Sample modal">
        <p>Lorem ipsum dolor sit amet <b>adipiscing elit</b></p>
        <p>This is sample modal</p>
    </modal-box>

    <modal-box
        v-model="isModalDangerActive"
        large-title="Please confirm"
        button="danger"
        has-cancel
    >
        <p>Lorem ipsum dolor sit amet <b>adipiscing elit</b></p>
        <p>This is sample modal</p>
    </modal-box>

    <div
        v-if="checkedRows.length"
        class="bg-background-50 p-3 dark:bg-background-800"
    >
        <span
            v-for="checkedRow in checkedRows"
            :key="checkedRow.id"
            class="inline-block bg-background-100 px-2 py-1 rounded-sm mr-2 text-sm dark:bg-background-700"
        >
            {{ checkedRow.name }}
        </span>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table
            class="w-full text-sm text-left rtl:text-right text-text-500 dark:text-text-400"
        >
            <thead
                class="text-xs text-text-700 uppercase bg-background-50 dark:bg-background-700 dark:text-text-400"
            >
                <tr>
                    <th scope="col" class="px-6 py-3" v-if="checkable" />
                    <th scope="col" class="px-6 py-3" />
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Company</th>
                    <th scope="col" class="px-6 py-3">City</th>
                    <th scope="col" class="px-6 py-3">Progress</th>
                    <th scope="col" class="px-6 py-3">Created</th>
                    <th scope="col" class="px-6 py-3" />
                </tr>
            </thead>
            <tbody>
                <tr
                    class="odd:bg-background-50 odd:dark:bg-background-900 even:bg-background-50 even:dark:bg-background-800 border-b dark:border-background-700"
                    v-for="client in itemsPaginated"
                    :key="client.id"
                >
                    <checkbox-cell
                        class="p-4"
                        v-if="checkable"
                        @checked="checked($event, client)"
                    />
                    <th
                        scope="row"
                        class="px-6 py-4 font-medium text-text-900 whitespace-nowrap dark:text-text"
                    >
                        <user-avatar :username="client.name" class="image" />
                    </th>
                    <td class="px-6 py-4" data-label="Name">
                        {{ client.name }}
                    </td>
                    <td class="px-6 py-4" data-label="Company">
                        {{ client.company }}
                    </td>
                    <td class="px-6 py-4" data-label="City">
                        {{ client.city }}
                    </td>
                    <td data-label="Progress" class="px-6 py-4 progress-cell">
                        <progress max="100" :value="client.progress">
                            {{ client.progress }}
                        </progress>
                    </td>
                    <td class="px-6 py-4" data-label="Created">
                        <small
                            class="text-text-500 dark:text-text-400"
                            :title="client.created"
                            >{{ client.created }}</small
                        >
                    </td>
                    <td class="actions-cell px-6 py-4">
                        <jb-buttons type="justify-start lg:justify-end" no-wrap>
                            <jb-button
                                color="success"
                                :icon="mdiEye"
                                small
                                @click="isModalActive = true"
                            />
                            <jb-button
                                color="danger"
                                :icon="mdiTrashCan"
                                small
                                @click="isModalDangerActive = true"
                            />
                        </jb-buttons>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="table-pagination m-4">
        <level>
            <jb-buttons>
                <jb-button
                    v-for="page in pagesList"
                    :key="page"
                    :active="page === currentPage"
                    :label="page + 1"
                    :outline="darkMode"
                    small
                    @click="currentPage = page"
                />
            </jb-buttons>
            <small>Page {{ currentPageHuman }} of {{ numPages }}</small>
        </level>
    </div>
</template>
