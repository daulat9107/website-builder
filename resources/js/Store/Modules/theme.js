const state = () => ({
    iconColor: "#b7b350",
    infoIconColor: "#22c55e",
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
const actions = {};

// mutations
const mutations = {
    setIconColor(state, color) {
        state.iconColor = color;
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
