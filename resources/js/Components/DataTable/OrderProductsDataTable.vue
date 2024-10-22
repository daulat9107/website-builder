<script>
import queryString from "query-string";
import { defineComponent } from "vue";
import Divider from "@/Components/Divider.vue";
import Control from "@/Components/Control.vue";
import Field from "@/Components/Field.vue";
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiTrashCan } from "@mdi/js";
import { Link } from "@inertiajs/vue3";

export default defineComponent({
    components: {
        Divider,
        SvgIcon,
        Control,
        Field,
        Link,
    },
    props: {
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
        orderId: {
            required: false,
        },
    },
    data() {
        return {
            path: mdiTrashCan,
            creating: {
                active: false,
                form: {},
                errors: [],
            },
            editing: {
                id: null,
                form: {},
                errors: [],
            },
            sort: {
                key: "id",
                order: "asc",
            },
            search: {
                column: "id",
                operator: "equals",
                value: null,
            },
            quickSearchQuery: "",
            limit: 50,
            response: {
                table: null,
                records: [],
                displayable: [],
                updatable: [],
                allow: [],
            },
            selected: [],
        };
    },
    computed: {
        filteredRecords() {
            let data = this.response.records;

            data = data.filter((row) => {
                return Object.keys(row).some((key) => {
                    return (
                        String(row[key])
                            .toLowerCase()
                            .indexOf(this.quickSearchQuery.toLowerCase()) > -1
                    );
                });
            });

            if (this.sort.key) {
                data = _.orderBy(
                    data,
                    (i) => {
                        let value = i[this.sort.key];

                        if (!isNaN(parseFloat(value)) && isFinite(value)) {
                            return parseFloat(value);
                        }

                        return String(i[this.sort.key]).toLowerCase();
                    },
                    this.sort.order
                );
            }

            return data;
        },
        canSelectItems() {
            return this.filteredRecords.length <= 500;
        },
    },
    methods: {
        getRecords() {
            return axios
                .get(`${this.endpoint}?${this.getQueryParameters()}`)
                .then((response) => {
                    this.response = response.data.data;
                    console.log(this.response);
                });
        },
        getQueryParameters() {
            if (this.orderId != null) {
                this.search.column = "order_id";
                this.search.value = this.orderId;
            }
            return queryString.stringify({
                limit: this.limit,
                sort_key: this.sort.key,
                sort_value: this.sort.order,
                ...this.search,
            });
        },
        sortBy(key) {
            this.sort.key = key;
            this.sort.order = this.sort.order === "asc" ? "desc" : "asc";
        },
        edit(record) {
            this.editing.errors = [];
            this.editing.id = record.id;
            this.editing.form = _.pick(record, this.response.updatable);
        },
        update() {
            axios
                .patch(`${this.endpoint}/${this.editing.id}`, this.editing.form)
                .then(() => {
                    this.getRecords().then(() => {
                        this.editing.id = null;
                        this.editing.form = null;
                    });
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.editing.errors = error.response.data;
                    }
                });
        },
        store() {
            axios
                .post(`${this.endpoint}`, this.creating.form)
                .then(() => {
                    this.getRecords().then(() => {
                        this.creating.active = false;
                        this.creating.form = {};
                        this.creating.errors = [];
                    });
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.creating.errors = error.response.data.errors;
                    }
                });
        },
        destroy(record) {
            if (!window.confirm(`Are you sure you want to delete this?`)) {
                return;
            }

            axios.delete(`${this.endpoint}/${record}`).then(() => {
                this.getRecords();

                if (this.selected.length) {
                    this.toggleSelectAll();
                }
            });
        },
        isUpdatable(column) {
            return this.response.updatable.includes(column);
        },
        toggleSelectAll() {
            if (this.selected.length > 0) {
                this.selected = [];
                return;
            }

            this.selected = _.map(this.filteredRecords, "id");
        },
        show(id) {
            if (!this.clickable) {
                return false;
            }
            window.location = `${this.endpoint}/${id}`;
        },
    },
    mounted() {
        this.getRecords();
    },
});
</script>
<template>
    <div>
        <div class="panel panel-default">
            <div class="m-4 float-right">
                <a
                    v-if="response.allow.creation"
                    href="#"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    @click.prevent="creating.active = !creating.active"
                    >{{ creating.active ? "Hide" : "New record" }}</a
                >
            </div>
            <divider />
            <div
                class="border p-10 shadow-xl mb-10 dark:border-slate-800"
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
                                'text-rose-600': creating.errors[column],
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
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="relative">
                <form action="#" @submit.prevent="getRecords">
                    <div class="flex gap-2 justify-around">
                        <div class="flex-1">
                            <select
                                class="px-3 py-2 max-w-full dark:bg-slate-800 focus:ring focus:outline-none border-gray-700 rounded w-full dark:placeholder-gray-400 text-white"
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
                                class="px-3 py-2 max-w-full dark:bg-slate-800 focus:ring focus:outline-none border-gray-700 rounded w-full dark:placeholder-gray-400 text-white"
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
                                    class="px-3 py-2 max-w-full dark:bg-slate-800 focus:ring focus:outline-none border-gray-700 rounded w-full dark:placeholder-gray-400 text-white"
                                    :id="`search_${name}`"
                                    v-model="search.value"
                                    placeholder="search..."
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex m-10 float-right">
                        <div class="flex-1">
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                type="submit"
                            >
                                Search
                            </button>
                        </div>
                    </div>
                    <divider />
                </form>
                <div class="flex justify-between my-10">
                    <div class="flex-1">
                        <label :for="`filter_${name}`"
                            >Quick search current results</label
                        >
                        <input
                            type="text"
                            class="px-3 py-2 max-w-full dark:bg-slate-800 focus:ring focus:outline-none border-gray-700 rounded w-full dark:placeholder-gray-400"
                            :id="`filter_${name}`"
                            v-model="quickSearchQuery"
                        />
                    </div>
                    <div class="flex-2">
                        <label for="limit">Display records</label>
                        <select
                            class="px-3 py-2 max-w-full dark:bg-slate-800 focus:ring focus:outline-none border-gray-700 rounded w-full dark:placeholder-gray-400"
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
                        class="table-auto w-full text-sm text-left text-gray-500 dark:text-white"
                        id="question_bank"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
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
                                        class="dark:bg-slate-800"
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
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                v-for="record in filteredRecords"
                            >
                                <td
                                    class="px-6 py-4"
                                    v-if="
                                        canSelectItems &&
                                        response.allow.deletion
                                    "
                                >
                                    <input
                                        type="checkbox"
                                        class="dark:bg-slate-800"
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
                                                class="px-3 py-2 max-w-full dark:bg-slate-800 focus:ring focus:outline-none border-gray-700 rounded w-full dark:placeholder-gray-400"
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
                                        <template v-if="column == 'order_id'">
                                            <Link
                                                :href="`/orders?id=${columnValue}`"
                                                >{{ columnValue }}</Link
                                            >
                                        </template>
                                        <template v-else>
                                            {{ columnValue }}
                                        </template>
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
