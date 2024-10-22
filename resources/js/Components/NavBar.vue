<script setup>
import { computed, ref } from "vue";
import { useStore } from "vuex";
import {
    mdiForwardburger,
    mdiBackburger,
    mdiClose,
    mdiDotsVertical,
    mdiAccount,
    mdiCogOutline,
    mdiLogout,
    mdiThemeLightDark,
} from "@mdi/js";
import NavBarItem from "@/Components/NavBarItem.vue";
import NavBarItemLabel from "@/Components/NavBarItemLabel.vue";
import NavBarMenu from "@/Components/NavBarMenu.vue";
import NavBarMenuDivider from "@/Components/NavBarMenuDivider.vue";
import UserAvatar from "@/Components/UserAvatar.vue";
import Icon from "@/Components/Icon.vue";
import NavBarSearch from "@/Components/NavBarSearch.vue";
import { router } from "@inertiajs/vue3";
const store = useStore();

defineProps({
    guest: {
        type: Boolean,
        default: false,
    },
});

const toggleLightDark = () => {
    store.dispatch("darkMode");
};

const logout = () => {
    router.post(route("logout"));
};
const switchToTeam = (team) => {
    router.put(
        route("current-team.update"),
        {
            team_id: team.id,
        },
        {
            preserveState: false,
        }
    );
};

const isAsideMobileExpanded = computed(() => store.state.isAsideMobileExpanded);

const userName = computed(() => store.state.userName);

const menuToggleMobileIcon = computed(() =>
    isAsideMobileExpanded.value ? mdiBackburger : mdiForwardburger
);

const menuToggleMobile = () => store.dispatch("asideMobileToggle");

const isMenuNavBarActive = ref(false);

const menuNavBarToggleIcon = computed(() =>
    isMenuNavBarActive.value ? mdiClose : mdiDotsVertical
);

const menuNavBarToggle = () => {
    isMenuNavBarActive.value = !isMenuNavBarActive.value;
};
</script>
<template>
    <nav
        class="top-0 left-0 right-0 fixed flex h-14 border-gray-100 z-30 w-screen transition-position m:pl-60 lg:w-auto lg:items-stretch dark:border-gray-800"
        :class="{
            'ml-60 m:ml-0': isAsideMobileExpanded,
            'backdrop-blur-sm backdrop-brightness-150 dark:backdrop-brightness-50 border-b':
                !guest,
        }"
    >
        <div class="flex-1 items-stretch flex h-14" v-if="!guest">
            <nav-bar-item type="flex" @click.prevent="menuToggleMobile">
                <icon :path="menuToggleMobileIcon" size="24" />
            </nav-bar-item>

            <nav-bar-item>
                <nav-bar-search />
            </nav-bar-item>
        </div>
        <div class="flex-none items-stretch flex h-14 lg:hidden" v-if="!guest">
            <nav-bar-item @click.prevent="menuNavBarToggle">
                <icon :path="menuNavBarToggleIcon" size="24" />
            </nav-bar-item>
        </div>
        <div
            class="absolute w-screen top-14 left-0 shadow lg:w-auto lg:items-stretch lg:flex lg:grow lg:static lg:overflow-visible lg:shadow-none"
            :class="[
                isMenuNavBarActive ? 'block' : 'hidden',
                !guest
                    ? 'backdrop-blur-sm backdrop-brightness-150 dark:backdrop-brightness-50 lg:border-b-0'
                    : '',
            ]"
        >
            <div
                class="max-h-screen-menu overflow-y-auto lg:overflow-visible lg:flex lg:items-stretch lg:justify-end lg:ml-auto"
            >
                <nav-bar-menu v-if="!guest" has-divider>
                    <user-avatar class="w-6 h-6 mr-3 inline-flex" />
                    <div>
                        <span>{{ $page.props.auth.user.name }}</span>
                    </div>

                    <template #dropdown>
                        <nav-bar-item :href="route('profile.show')">
                            <nav-bar-item-label
                                :icon="mdiAccount"
                                label="My Profile"
                            />
                        </nav-bar-item>
                        <nav-bar-item
                            :href="route('api-tokens.index')"
                            v-if="$page.props.jetstream.hasApiFeatures"
                        >
                            <nav-bar-item-label
                                :icon="mdiCogOutline"
                                label="API Tokens"
                            />
                        </nav-bar-item>
                        <nav-bar-menu-divider />
                        <nav-bar-item @click.prevent="logout">
                            <nav-bar-item-label
                                :icon="mdiLogout"
                                label="Log Out"
                            />
                        </nav-bar-item>
                    </template>
                </nav-bar-menu>
                <nav-bar-item
                    has-divider
                    is-desktop-icon-only
                    v-if="!guest"
                    @click.prevent="toggleLightDark"
                >
                    <nav-bar-item-label
                        :icon="mdiThemeLightDark"
                        label="Light/Dark"
                        is-desktop-icon-only
                    />
                </nav-bar-item>

                <nav-bar-item
                    @click.prevent="logout"
                    v-if="!guest"
                    is-desktop-icon-only
                    as="button"
                >
                    <nav-bar-item-label
                        :icon="mdiLogout"
                        label="Log out"
                        is-desktop-icon-only
                    />
                </nav-bar-item>
                <nav-bar-item
                    v-if="guest"
                    :href="route('login')"
                    class="text-white hover:text-gray-600"
                >
                    <nav-bar-item-label :icon="mdiAccount" label="Login" />
                </nav-bar-item>
            </div>
        </div>
    </nav>
</template>
