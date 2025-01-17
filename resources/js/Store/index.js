import { createStore } from "vuex";
import axios from "axios";
import { darkModeKey } from "@/config.js";
import theme from "./Modules/theme";
import storage from "@/storage";

export default createStore({
    state: {
        /* User */
        userName: null,
        userEmail: null,
        userAvatar: null,
        /* Aside */
        isAsideMobileExpanded: false,
        isFullScreen: false,

        /* Dark mode */
        darkMode: true,

        /* Field focus with ctrl+k (to register only once) */
        isFieldFocusRegistered: false,

        /* Sample data (commonly used) */
        clients: [
            {
                name: "Daulat",
                company: "Comapny name",
                city: "City one",
                progress: 20,
                created: "at date",
            },
            {
                name: "Daulat 2",
                company: "Comapny 2",
                city: "City two",
                progress: 30,
                created: "at date 2",
            },
        ],
        history: [],

        /* Buttons */
        themes: {
            primary:
                "bg-blue-800 hover:bg-indigo-700 active:bg-purple-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 text-white",
            default:
                "bg-gray-200 hover:bg-gray-100 active:bg-gray-300 focus:outline-none focus:border-gray-300 focus:ring focus:ring-gray-100 dark:text-gray-900",
            danger: "",
        },
        sizes: {
            normal: "px-4 py-2",
            large: "px-4 py-4",
        },
    },
    getters: {
        getThemes(state) {
            return state.themes;
        },
        getSizes(state) {
            return state.sizes;
        },
    },
    mutations: {
        /* A fit-them-all commit */
        basic(state, payload) {
            state[payload.key] = payload.value;
        },

        /* User */
        user(state, payload) {
            if (payload.name) {
                state.userName = payload.name;
            }
            if (payload.email) {
                state.userEmail = payload.email;
            }
            if (payload.avatar) {
                state.userAvatar = payload.avatar;
            }
        },
    },
    actions: {
        asideMobileToggle({ commit, state }, payload = null) {
            const isShow =
                payload !== null ? payload : !state.isAsideMobileExpanded;

            document
                .getElementById("app")
                .classList[isShow ? "add" : "remove"]("ml-60", "m:ml-0");

            document.documentElement.classList[isShow ? "add" : "remove"](
                "m-clipped"
            );

            storage.put("isAsideMobileExpanded", isShow);

            commit("basic", {
                key: "isAsideMobileExpanded",
                value: isShow,
            });
        },
        fullScreenToggle({ commit, state }, value) {
            commit("basic", { key: "isFullScreen", value });

            document.documentElement.classList[value ? "add" : "remove"](
                "full-screen"
            );
        },
        darkMode({ commit, state }) {
            const value = !state.darkMode;

            document.documentElement.classList[value ? "add" : "remove"](
                "dark"
            );

            localStorage.setItem(darkModeKey, value ? "1" : "0");

            commit("basic", {
                key: "darkMode",
                value,
            });
        },

        fetch({ commit }, payload) {
            axios
                .get(`data-sources/${payload}.json`)
                .then((r) => {
                    if (r.data && r.data.data) {
                        commit("basic", {
                            key: payload,
                            value: r.data.data,
                        });
                    }
                })
                .catch((error) => {
                    alert(error.message);
                });
        },
    },
    modules: {
        theme,
    },
});
