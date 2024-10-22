<script setup>
import { ref, reactive, computed, onMounted } from "vue";
import { useStore } from "vuex";
import AppLayout from "@/Layouts/AppLayoutV2.vue";
import AppSection from "@/Components/AppComponents/AppSection.vue";
import AppCard from "@/Components/AppComponents/AppCard.vue";
import AppTitle from "@/Components/AppComponents/AppTitle.vue";
import AppSearchOptions from "@/Components/AppComponents/AppSearchOptions.vue";
import ActionMessage from "@/Components/ActionMessage.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import JbButton from "@/Components/JbButton.vue";
import JbButtons from "@/Components/JbButtons.vue";
import FilePicker from "@/Components/FilePicker.vue";
import Level from "@/Components/Level.vue";
import AsideLink from "@/Components/AsideLink.vue";
import AsideMenu from "@/Components/AsideMenu.vue";
import Divider from "@/Components/AppComponents/Divider.vue";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import Banner from "@/Components/Banner.vue";
import CardClientBar from "@/Components/CardClientBar.vue";
import CardTransactionBar from "@/Components/CardTransactionBar.vue";
import CardWidget from "@/Components/CardWidget.vue";
import { mdiCog, mdiEye, mdiTrashCan } from "@mdi/js";
import { generateColorShades } from "@/Helpers/colors";
import menu from "@/menu.js";
import Checkbox from "@/Components/Checkbox.vue";
import CheckRadioPicker from "@/Components/CheckRadioPicker.vue";
import ClientsTable from "@/Components/ClientsTable.vue";
import DataTable from "@/Components/DataTable/DataTable.vue";
import CardComponent from "@/Components/CardComponent.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import Control from "@/Components/Control.vue";
import Field from "@/Components/Field.vue";
const store = useStore();

const darkMode = computed(() => store.state.darkMode);
/**
 * Pagination Buttons
 */
const perPage = ref(10);
const currentPage = ref(0);
const numPages = computed(() => Math.ceil(100 / perPage.value));

/**
 * Modal
 */
const isModalActive = ref(false);

const openModal = () => {
    isModalActive.value = true;
};

const isModalDangerActive = ref(false);

const currentPageHuman = computed(() => currentPage.value + 1);

const confirm = () => alert("confirm");

const cancel = () => alert("cancel");

const pagesList = computed(() => {
    const pagesList = [];

    for (let i = 0; i < numPages.value; i++) {
        pagesList.push(i);
    }

    return pagesList;
});
/** Form Fields */
const getCheckRadioPickerValues = (values) => {
    console.log(values);
};

const is_checkbox = ref(true);
const getCheckboxVal = (val) => {
    alert(val);
};
const form_field_one = ref(null);
const form_field_two = ref(null);
const has_form_field_one_error = ref(true);

const themeStyle = ref(document.documentElement.style);
const theme = reactive({
    text: [],
    background: [],
    accent: [],
    primary: [],
    secondary: [],
    success: [],
    danger: [],
    warning: [],
    info: [],
});
const themeHasValue = ref(false);
/* form */
const form = reactive({
    textColor: "#e4dcf1",
    backgroundColor: "#0f0916",
    accentColor: "#b7b350",
    primaryColor: "#b094d3",
    secondaryColor: "#72462f",
    successColor: "#047857",
    dangerColor: "#b91c1c",
    warningColor: "#a16207",
    infoColor: "#15803d",
});

const updateTheme = () => {
    for (let colorType in theme) {
        if (theme.hasOwnProperty(colorType)) {
            theme[colorType] = generateColorShades(
                form[`${colorType}Color`],
                11
            );
            theme[colorType].forEach((color) => {
                themeStyle.value.setProperty(
                    `--${colorType}-${color.code}`,
                    color.shade
                );
            });

            themeStyle.value.setProperty(
                `--${colorType}-default`,
                form[`${colorType}Color`]
            );
        }
    }

    themeHasValue.value = true;
    store.commit(
        "theme/setIconColor",
        getComputedStyle(document.documentElement).getPropertyValue(
            "--accent-default"
        )
    );
    store.commit(
        "theme/setInfoIconColor",
        getComputedStyle(document.documentElement).getPropertyValue(
            "--info-default"
        )
    );
};
onMounted(() => {
    for (let colorType in theme) {
        if (theme.hasOwnProperty(colorType)) {
            themeStyle.value.setProperty(
                `--${colorType}-default`,
                form[`${colorType}Color`]
            );
        }
    }
    store.state.isAsideMobileExpanded = true;
    store.state.isDemoAsideMenu = true;
});
</script>

<template>
    <app-layout title="Themes">
        <template #main>
            <section class="p-4 pb-0 flex items-center">
                <h2 class="w-1/2 text-2xl text-text-100">Themes</h2>
                <app-search-options />
            </section>

            <app-section>
                <template #header>
                    <app-title>
                        <template #title> Charts: </template>
                    </app-title>
                </template>
                <template #main>
                    <app-card></app-card>
                    <app-card></app-card>
                    <app-card></app-card>
                </template>
            </app-section>
            <app-section classes="p-4 gap-2">
                <template #header>
                    <app-title>
                        <template #title> Buttons: </template>
                    </app-title>
                </template>
                <template #main>
                    <ul>
                        <li class="p-2">
                            <div class="text-text-100 pb-2">Primary Button</div>
                            <action-message :on="true">Created</action-message>
                            <primary-button>Create</primary-button>
                        </li>
                        <li class="p-2">
                            <div class="text-text-100 pb-2">
                                Settings Button:
                            </div>
                            <jb-button
                                :icon="mdiCog"
                                icon-w="w-4"
                                icon-h="h-4"
                                :color="darkMode ? 'white' : 'light'"
                                :outline="darkMode"
                                small
                            />
                        </li>
                        <li class="p-2">
                            <div class="text-text-100 pb-2">Pagination:</div>
                            <div class="table-pagination">
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
                                    <small class="text-text-100"
                                        >Page {{ currentPageHuman }} of
                                        {{ numPages }}</small
                                    >
                                </level>
                            </div>
                        </li>
                        <li>
                            <div class="text-text-100 pb-2">
                                Warning and Danger Buttons:
                            </div>
                            <jb-buttons>
                                <jb-button
                                    color="warning"
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
                        </li>
                        <li>
                            <div class="text-text-100 pb-2">File Uploader:</div>
                            <file-picker />
                        </li>
                        <li>
                            <div class="text-text-100 pb-2">
                                Confirm and Cancel buttons:
                            </div>
                            <jb-buttons>
                                <jb-button
                                    label="Done"
                                    color="info"
                                    @click="confirm"
                                />
                                <jb-button
                                    v-if="true"
                                    label="Cancel"
                                    color="info"
                                    outline
                                    @click="cancel"
                                />
                            </jb-buttons>
                        </li>
                        <li>
                            <div class="text-text-100 pb-2">Dashboard Link</div>
                            <aside-link href="/dashboard">
                                Dashboard</aside-link
                            >
                        </li>
                        <li>
                            <divider />
                            <div class="text-text-100 pb-2">Dashboard Menu</div>
                            <div class="bg-background-800 pl-4 pt-4">
                                <aside-menu
                                    :isAsideMobileExpanded="false"
                                    :isDemoAsideMenu="true"
                                    :menu="menu"
                                />
                            </div>
                        </li>
                        <li>
                            <div class="text-text-100 p-4">
                                Authentication Card
                            </div>
                            <authentication-card
                                >Authentication Card</authentication-card
                            >
                        </li>
                        <li>
                            <banner>banner</banner>
                        </li>
                    </ul>
                </template>
            </app-section>
            <app-section classes="p-4 gap-2">
                <template #header>
                    <app-title>
                        <template #title> More components: </template>
                    </app-title>
                </template>
                <template #main>
                    <ul>
                        <li>
                            <div class="text-text-100 p-4">Card Client Bar</div>
                            <card-client-bar
                                login="gmail.com"
                                name="Daulat"
                                :progress="40"
                                date="20 - 10 - 2024"
                                text="Something went wrong!"
                            />
                        </li>
                        <li>
                            <div class="text-text-100 p-4">
                                Card Transaction Bar
                            </div>
                            <card-transaction-bar
                                :amount="200"
                                type="withdrawal"
                                name="Daulat"
                                date="20 - 10 - 2024"
                                business="LuckyMe"
                                account="Kotak Bank Account"
                            />
                        </li>

                        <li>
                            <div class="text-text-100 p-4">Card Widget</div>
                            <card-widget
                                :number="200"
                                :icon="mdiTrashCan"
                                prefix="$"
                                color="red"
                                trend="down"
                                type="down"
                            />
                        </li>
                        <li>
                            <div class="text-text-100 p-4">Checkbox:</div>

                            <checkbox
                                @update:checked="getCheckboxVal"
                                :checked="is_checkbox"
                            />
                        </li>
                        <li>
                            <div class="text-text-100 p-4">
                                CheckRadioPicker:
                            </div>

                            <check-radio-picker
                                name="radio_picker"
                                @update:modelValue="getCheckRadioPickerValues"
                                type="radio"
                                :options="{ a: 'A', b: 'B', c: 'C' }"
                            />
                            <check-radio-picker
                                name="radio_picker"
                                type="checkbox"
                                @update:modelValue="getCheckRadioPickerValues"
                                :options="{ a: 'A', b: 'B', c: 'C' }"
                            />
                        </li>
                    </ul>
                </template>
            </app-section>
            <app-section classes="p-4 gap-2">
                <template #header>
                    <app-title>
                        <template #title> Table: </template>
                    </app-title>
                </template>
                <template #main> <clients-table checkable /></template>
            </app-section>
            <app-section>
                <template #header>
                    <app-title>
                        <template #title> DataTable: </template>
                    </app-title>
                </template>
                <template #main>
                    <card-component title="Accounts">
                        <data-table
                            group-id="1"
                            endpoint="datatable/accounts"
                            name="Accounts"
                        ></data-table>
                    </card-component>
                </template>
            </app-section>
            <app-section>
                <app-title>
                    <template #title> Modals: </template>
                </app-title>
                <template #main>
                    <div>
                        <a
                            class="text-text-950 dark:text-text"
                            href="#"
                            @click.prevent="openModal()"
                            >Confirmation modal</a
                        >
                    </div>
                    <confirmation-modal
                        @close="isModalActive = false"
                        closeable
                        :show="isModalActive"
                    >
                        <template #title>Confirmation modal title</template>
                        <template #content>
                            <p>Confirmation modal content</p>
                        </template>
                        <template #footer>
                            <p>Confirmation modal footer</p>
                        </template>
                    </confirmation-modal>
                </template>
            </app-section>
            <app-section classes="p-4 gap-2">
                <app-title>
                    <template #title> Form Elements: </template>
                </app-title>
                <template #main>
                    <div class="flex gap-2">
                        <div class="flex-1">
                            <field
                                label="Form field one"
                                :has-error="has_form_field_one_error"
                                help="helper"
                            >
                                <control
                                    v-model="form_field_one"
                                    type="text"
                                    name="form_field_one"
                                    placeholder="Form Field one placeholder"
                                    autocomplete="form_field_one"
                                    :required="true"
                                    @update:modelValue="
                                        has_form_field_one_error = false
                                    "
                                />
                            </field>
                        </div>
                        <div class="flex-1">
                            <field label="Form field two" help="helper 2">
                                <control
                                    v-model="form_field_two"
                                    type="text"
                                    name="form_field_two"
                                    placeholder="Form Field two placeholder"
                                    autocomplete="form_field_two"
                                />
                            </field>
                        </div>
                    </div>
                </template>
            </app-section>
            <section class="p-10 rounded shadow bg-background-700 h-max">
                <div class="gap-4">
                    <div class="text-white">
                        <label for="textColor">Text:</label>
                        <input
                            type="color"
                            name="textColor"
                            v-model="form.textColor"
                        />
                    </div>
                    <div class="text-white">
                        <label for="backgroundColor">Background:</label>
                        <input
                            type="color"
                            name="backgroundColor"
                            v-model="form.backgroundColor"
                        />
                    </div>
                    <div class="text-white">
                        <label for="accentColor">Accent:</label>
                        <input
                            type="color"
                            name="accentColor"
                            v-model="form.accentColor"
                        />
                    </div>
                    <div class="text-white">
                        <label for="primaryColor">Primary:</label>
                        <input
                            type="color"
                            name="primaryColor"
                            v-model="form.primaryColor"
                        />
                    </div>
                    <div class="text-white">
                        <label for="secondaryColor">Secondary:</label>
                        <input
                            type="color"
                            name="secondaryColor"
                            v-model="form.secondaryColor"
                        />
                    </div>
                    <div class="text-white">
                        <label for="successColor">Success:</label>
                        <input
                            type="color"
                            name="successColor"
                            v-model="form.successColor"
                        />
                    </div>
                    <div class="text-white">
                        <label for="dangerColor">Danger:</label>
                        <input
                            type="color"
                            name="dangerColor"
                            v-model="form.dangerColor"
                        />
                    </div>
                    <div class="text-white">
                        <label for="warningColor">Warning:</label>
                        <input
                            type="color"
                            name="warningColor"
                            v-model="form.warningColor"
                        />
                    </div>
                    <div class="text-white">
                        <label for="infoColor">Info:</label>
                        <input
                            type="color"
                            name="infoColor"
                            v-model="form.infoColor"
                        />
                    </div>
                    <button
                        class="text-white bg-primary-900 p-2"
                        @click="updateTheme()"
                    >
                        Update Theme
                    </button>
                    <template v-if="themeHasValue">
                        <div
                            class="text-white"
                            v-for="(colors, colorType) in theme"
                        >
                            <div class="flex flex-col m-4">
                                <div class="flex">
                                    <div
                                        v-for="color in colors"
                                        class="p-2 bg-blue-900 w-12 h-12 rounded shadow"
                                        :style="{
                                            backgroundColor: color.shade,
                                        }"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </section>
        </template>
    </app-layout>
</template>
