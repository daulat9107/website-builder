import axios from "axios";
import storage from "@/storage.js";

const state = () => ({
    iconColor: "#b7b350",
    infoIconColor: "#22c55e",
    themeStyle: document.documentElement.style,
});

// getters
const getters = {
    getIconColor: (state) => {
        return state.iconColor;
    },
    getInfoIconColor: (state) => {
        return state.infoIconColor;
    },
};

// actions
const actions = {
    /**
     *
     * Local storage is not working, so I'm searching for a fake key in
     * local storage to trigger the catch block. This is currently functioning.
     * We have to fix local storage theme issue
     */
    theme({ state, commit }) {
        storage
            .get("theme1")
            .then((response) => {
                commit("SET_THEME_IN_STORAGE", response);
                commit(
                    "setIconColor",
                    getComputedStyle(document.documentElement).getPropertyValue(
                        "--accent-default"
                    )
                );
                commit(
                    "setInfoIconColor",
                    getComputedStyle(document.documentElement).getPropertyValue(
                        "--info-default"
                    )
                );
                console.log(
                    getComputedStyle(document.documentElement).getPropertyValue(
                        "--primary-default"
                    )
                );
                document.documentElement.style.setProperty(
                    "--primary-default",
                    "#000000"
                );
            })
            .catch(() => {
                console.log("not found");
                axios.get("theme").then((response) => {
                    storage.put("theme", response.data.theme);
                    commit(
                        "SET_THEME_IN_STORAGE",
                        JSON.parse(response.data.theme)
                    );
                    commit(
                        "setIconColor",
                        getComputedStyle(
                            document.documentElement
                        ).getPropertyValue("--accent-default")
                    );
                    commit(
                        "setInfoIconColor",
                        getComputedStyle(
                            document.documentElement
                        ).getPropertyValue("--info-default")
                    );
                });
            });
    },
};

// mutations
const mutations = {
    setIconColor(state, color) {
        state.iconColor = color;
    },
    SET_THEME_IN_STORAGE(state, theme) {
        for (let colorType in theme) {
            if (theme.hasOwnProperty(colorType)) {
                theme[colorType].forEach((color) => {
                    state.themeStyle.setProperty(
                        `--${colorType}-${color.code}`,
                        color.shade
                    );
                });
            }
        }
    },
    setInfoIconColor(state, color) {
        state.infoIconColor = color;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
