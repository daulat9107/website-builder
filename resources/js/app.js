import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import store from "./Store";
import storage from "@/storage.js";
import { darkModeKey } from "@/config.js";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

/* Dark mode */
const localStorageDarkModeValue = localStorage.getItem(darkModeKey);

if (
    (localStorageDarkModeValue === null &&
        window.matchMedia("(prefers-color-scheme: dark)").matches) ||
    localStorageDarkModeValue === "1"
) {
    store.dispatch("darkMode");
}
store.dispatch("fullScreenToggle", true);

storage
    .get("isAsideMobileExpanded")
    .then((value) => {
        store.dispatch("asideMobileToggle", value);
    })
    .catch((error) => {
        console.log(error);
    });

store.dispatch("theme/theme");

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(store)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
