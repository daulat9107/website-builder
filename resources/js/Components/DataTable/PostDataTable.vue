<script setup>
import queryString from "query-string";
import { reactive, ref, computed, onMounted } from "vue";
import Divider from "@/Components/Divider.vue";
import Control from "@/Components/Control.vue";
import Field from "@/Components/Field.vue";
import SvgIcon from "@jamescoyle/vue-icon";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { mdiTrashCan } from "@mdi/js";

const props = defineProps({
    endpoint: {
        required: true,
    },
    name: {
        required: true,
    },
    clickable: {
        required: false,
        default: true,
    },
});
const path = ref(mdiTrashCan);
const creating = reactive({
    active: false,
    form: {},
    errors: [],
});
const editing = reactive({
    id: false,
    form: {},
    errors: [],
});
const sort = reactive({
    key: "id",
    order: "asc",
});
const search = reactive({
    column: "id",
    operator: "equals",
    value: null,
});
const quickSearchQuery = ref("");
const limit = ref(50);
let response = ref({
    table: null,
    records: [],
    displayable: [],
    updatable: [],
    allow: [],
});
const selected = ref([]);
const filteredRecords = computed(() => {
    let data = response.value.records;
    data = data.filter((row) => {
        return Object.keys(row).some((key) => {
            return (
                String(row[key])
                    .toLowerCase()
                    .indexOf(quickSearchQuery.value.toLowerCase()) > -1
            );
        });
    });
    if (sort.key) {
        data = _.orderBy(
            data,
            (i) => {
                let value = i[sort.key];

                if (!isNaN(parseFloat(value)) && isFinite(value)) {
                    return parseFloat(value);
                }

                return String(i[sort.key]).toLowerCase();
            },
            sort.order
        );
    }
    return data;
});

const canSelectItems = computed(() => filteredRecords.length <= 500);

const getRecords = async () => {
    let res = await axios.get(`${props.endpoint}?${getQueryParameters()}`);
    response.value = res.data.data;
};

const getQueryParameters = () => {
    return queryString.stringify({
        limit: limit.value,
        sort_key: sort.key,
        sort_value: sort.order,
        ...search,
    });
};
const sortBy = (key) => {
    sort.key = key;
    sort.order = sort.order === "asc" ? "desc" : "asc";
};
const edit = (record) => {
    editing.errors = [];
    editing.id = record.id;
    editing.form = _.pick(record, response.value.updatable);
};

const update = () => {
    axios
        .patch(`${props.endpoint}/${editing.id}`, editing.form)
        .then(() => {
            getRecords().then(() => {
                editing.id = null;
                editing.form = null;
            });
        })
        .catch((error) => {
            if (error.response.status === 422) {
                editing.errors = error.response.data;
            }
        });
};

const store = () => {
    axios
        .post(`${props.endpoint}`, creating.form)
        .then(() => {
            this.getRecords().then(() => {
                creating.active = false;
                creating.form = {};
                creating.errors = [];
            });
        })
        .catch((error) => {
            if (error.response.status === 422) {
                creating.errors = error.response.data.errors;
            }
        });
};

const destroy = (record) => {
    if (!window.confirm(`Are you sure you want to delete this?`)) {
        return;
    }

    axios.delete(`${props.endpoint}/${record}`).then(() => {
        getRecords();

        if (selected.value.length) {
            toggleSelectAll();
        }
    });
};

const isUpdatable = (column) => response.value.updatable.includes(column);

const toggleSelectAll = () => {
    if (selected.value.length > 0) {
        selected.value = [];
        return;
    }

    selected.value = _.map(filteredRecords, "id");
};
const show = (id) => {
    if (!props.clickable) {
        return false;
    }
    window.location = `${props.endpoint}/${id}`;
};
onMounted(() => {
    getRecords();
});
</script>
<template>
    <div>
        <div class="panel panel-default">
            <div class="m-4 float-right">
                {{ creating }}
                <primary-button
                    v-if="response.allow.creation"
                    @click.prevent="creating.active = !creating.active"
                    >{{
                        creating.active ? "Hide" : "New record"
                    }}</primary-button
                >
            </div>
            <divider />
            <div
                class="border p-10 shadow-xl mb-10 dark:border-background-900"
                v-if="response.allow.creation && creating.active"
            >
                <form action="#" @submit.prevent="store">
                    <div
                        class="flex gap-4"
                        v-for="form_data_chunk in response.formData"
                    >
                        <div
                            class="flex-1 mb-4"
                            v-for="column in form_data_chunk"
                            :class="{
                                'text-danger-600': creating.errors[column],
                            }"
                        >
                            <field :label="column.label" help="">
                                <control
                                    v-model="creating.form[column.name]"
                                    :type="column.type"
                                    :name="column.name"
                                    :placeholder="column.placeholder"
                                    :autocomplete="column.name"
                                    :options="column.data"
                                    :selected="column.selected"
                                />
                            </field>
                        </div>
                    </div>
                    <divider />
                    <div class="flex">
                        <div class="flex-1">
                            <primary-button type="submit">
                                Create
                            </primary-button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="relative">
                <form action="#" @submit.prevent="getRecords">
                    <div class="flex gap-2 justify-around">
                        <div class="flex-1">
                            <select
                                class="px-3 py-2 max-w-full dark:bg-background-800 focus:ring focus:outline-none border-background-700 rounded w-full dark:placeholder-gray-400 text-text"
                                v-model="search.column"
                            >
                                <option
                                    :value="column"
                                    v-for="column in response.displayable"
                                >
                                    {{ column }}
                                </option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <select
                                class="px-3 py-2 max-w-full dark:bg-background-800 focus:ring focus:outline-none border-background-700 rounded w-full dark:placeholder-gray-400 dark:text-text"
                                v-model="search.operator"
                            >
                                <option value="equals">=</option>
                                <option value="contains">contains</option>
                                <option value="starts_with">starts with</option>
                                <option value="ends_with">ends with</option>
                                <option value="greater_than">></option>
                                <option value="less_than">&lt;</option>
                                <option value="greater_than_or_equal_to">
                                    >=
                                </option>
                                <option value="less_than_or_equal_to">
                                    &lt;=
                                </option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <div>
                                <input
                                    type="text"
                                    class="px-3 py-2 max-w-full dark:text-text dark:bg-background-800 focus:ring focus:outline-none border-background-700 rounded w-full dark:placeholder-gray-400"
                                    :id="`search_${props.name}`"
                                    v-model="search.value"
                                    placeholder="search..."
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex m-10 float-right">
                        <div class="flex-1">
                            <primary-button type="submit">
                                Search
                            </primary-button>
                        </div>
                    </div>
                    <divider />
                </form>
                <div class="flex justify-between my-10">
                    <div class="flex-1">
                        <label :for="`filter_${props.name}`"
                            >Quick search current results</label
                        >
                        <input
                            type="text"
                            class="px-3 py-2 max-w-full dark:bg-background-800 focus:ring focus:outline-none border-background-700 rounded w-full dark:placeholder-gray-400 dark:text-text"
                            :id="`filter_${props.name}`"
                            v-model="quickSearchQuery"
                        />
                    </div>
                    <div class="flex-2">
                        <label for="limit">Display records</label>
                        <select
                            class="px-3 py-2 max-w-full dark:bg-background-800 focus:ring focus:outline-none border-background-700 rounded w-full dark:placeholder-gray-400"
                            id="limit"
                            v-model="limit"
                            @change="getRecords"
                        >
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="1000">1000</option>
                            <option value="">All</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" v-if="selected.length">
                <div class="btn-group">
                    <a href="#" data-toggle="dropdown">
                        With selected <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" @click.prevent="destroy(selected)"
                                >Delete</a
                            >
                        </li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <div
                    class="relative overflow-x-auto"
                    v-if="filteredRecords.length"
                    style="height: 450px; overflow-y: scroll"
                >
                    <table
                        class="table-auto w-full text-sm text-left text-text-500 dark:text-text"
                        id="question_bank"
                    >
                        <thead
                            class="text-xs text-text-700 uppercase bg-background-50 dark:bg-background-700 dark:text-text-400"
                        >
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3"
                                    v-if="
                                        canSelectItems &&
                                        response.allow.deletion
                                    "
                                >
                                    <input
                                        type="checkbox"
                                        class="dark:bg-background-800"
                                        @change="toggleSelectAll"
                                        :checked="
                                            filteredRecords.length ===
                                            selected.length
                                        "
                                    />
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3"
                                    v-for="column in response.displayable"
                                >
                                    <span
                                        class="cursor-pointer"
                                        @click="sortBy(column)"
                                        >{{
                                            response.column_map[column] ||
                                            column
                                        }}</span
                                    >
                                    <span
                                        v-if="sort.key === column"
                                        class="arrow"
                                        :class="{
                                            'arrow--asc': sort.order === 'asc',
                                            'arrow--desc':
                                                sort.order === 'desc',
                                        }"
                                    ></span>
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3"
                                    v-if="response.allow.updation"
                                >
                                    &nbsp;
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3"
                                    v-if="response.allow.deletion"
                                >
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="bg-white border-b dark:bg-background-800 dark:border-background-700"
                                v-for="record in filteredRecords"
                            >
                                <!-- <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium" :class="{ 'bg-green-100 text-green-800': post.published, 'bg-gray-100 text-gray-800': !post.published }">
                            {{ !post.published ? 'Unpublished': 'Published' }}
                        </span> -->
                                <td
                                    class="px-6 py-4"
                                    v-if="
                                        canSelectItems &&
                                        response.allow.deletion
                                    "
                                >
                                    <input
                                        type="checkbox"
                                        class="dark:bg-background-800"
                                        :value="record.id"
                                        v-model="selected"
                                    />
                                </td>
                                <td
                                    class="px-6 py-4"
                                    v-for="(columnValue, column) in record"
                                >
                                    <template
                                        v-if="
                                            editing.id === record.id &&
                                            isUpdatable(column)
                                        "
                                    >
                                        <div
                                            class="form-group"
                                            :class="{
                                                'has-error':
                                                    editing.errors[column],
                                            }"
                                        >
                                            <input
                                                type="text"
                                                class="px-3 py-2 max-w-full dark:bg-background-800 focus:ring focus:outline-none border-background-700 rounded w-full dark:placeholder-gray-400"
                                                v-model="editing.form[column]"
                                            />
                                            <span
                                                class="help-block"
                                                v-if="editing.errors[column]"
                                            >
                                                <strong>{{
                                                    editing.errors[column][0]
                                                }}</strong>
                                            </span>
                                        </div>
                                    </template>
                                    <template v-else>
                                        {{ columnValue }}
                                    </template>
                                </td>
                                <td
                                    class="px-6 py-4"
                                    v-if="response.allow.updation"
                                >
                                    <a
                                        v-if="editing.id !== record.id"
                                        href="#"
                                        @click.prevent="edit(record)"
                                        >Edit</a
                                    >
                                    <template v-if="editing.id === record.id">
                                        <a href="#" @click.prevent="update"
                                            >Save</a
                                        ><br />
                                        <a
                                            href="#"
                                            @click.prevent="editing.id = null"
                                            >Cancel</a
                                        >
                                    </template>
                                </td>
                                <td class="px-6 py-4">
                                    <a
                                        href="#"
                                        @click.prevent="destroy(record.id)"
                                        v-if="response.allow.deletion"
                                    >
                                        <svg-icon
                                            type="mdi"
                                            :path="path"
                                        ></svg-icon>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p v-else>No results</p>
            </div>
        </div>
    </div>
</template>
