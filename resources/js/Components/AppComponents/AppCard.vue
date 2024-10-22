<script setup>
import { computed } from "vue";
import { useStore } from "vuex";
const store = useStore();
const stroke = computed(() => store.getters["theme/getInfoIconColor"]);
</script>
<template>
    <div
        class="hover:animate-pulse transition-all ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 hover:bg-primary-800 duration-300 relative bg-primary-800 w-full text-text p-4"
    >
        <header class="p-4">
            <svg
                id="Icon_with_Circle"
                data-name="Icon with Circle"
                xmlns="http://www.w3.org/2000/svg"
                width="62.271"
                height="62.271"
                viewBox="0 0 62.271 62.271"
            >
                <circle
                    id="Circle"
                    cx="31.135"
                    cy="31.135"
                    r="31.135"
                    fill="#ebc07a"
                />
                <g id="sale_icon" transform="translate(8.931 12.12)">
                    <g
                        id="Group_40"
                        data-name="Group 40"
                        transform="translate(28.667 7.677)"
                    >
                        <path
                            id="Path_21"
                            data-name="Path 21"
                            d="M40.125,15.656c.229,1.328.457,3.113-1.314,3.358A3.508,3.508,0,0,1,35.9,17.841c-2.336-2.15,3.705-4.769,4.136-2.437.231,1.252,2.141.722,1.91-.527-.907-4.908-10.609-1.359-8.229,3.454a6.649,6.649,0,0,0,2.792,2.359,5.033,5.033,0,0,0,3.159.173c2.687-.692,2.757-3.479,2.368-5.734-.217-1.254-2.126-.722-1.91.527Z"
                            transform="translate(-33.341 -12.521)"
                            fill="#012128"
                        />
                    </g>
                    <g
                        id="Group_41"
                        data-name="Group 41"
                        transform="translate(6.373 0)"
                    >
                        <path
                            id="Path_22"
                            data-name="Path 22"
                            d="M42.628,12.253c2.809,3.052,1.021,9.065-1.526,11.281-1.638,1.425-3.235,2.111-4.6,3.888-3.814,4.964-8.426,9.286-12.79,13.776l1.555.2c-2.554-3.976-6.624-6.376-9.312-10.222a51.625,51.625,0,0,0-3.31-4.224c-1.159-1.354-1.077.926-1.291-2.039-.163-2.27,1.234-2.708,2.867-4.153,4.29-3.8,7.981-8.193,12.208-12.021,3.01-2.726,9.236-4.454,12.779-1.366,1.809,1.577,2.745,4.259,4.283,6.12.813.983,2.207-.425,1.4-1.4C43.032,9.842,42.04,6.66,39.447,5.066c-2.262-1.39-5.635-1.453-8.156-1.051-6.5,1.036-11,8.478-15.5,12.662-2.522,2.343-10.52,6.715-6.8,10.768,1.267,1.382,3.3,2.069,4.565,3.649.857,1.074,1.513,2.273,2.426,3.316,2.479,2.829,5.509,4.762,7.582,7.988a1,1,0,0,0,1.555.2c3.311-3.406,6.677-6.766,9.934-10.223,1.143-1.213,2.057-2.559,3.137-3.812,1.557-1.807,3.732-2.65,5.342-4.362,3.02-3.211,3.513-10.081.505-13.349-.865-.94-2.263.463-1.4,1.4Z"
                            transform="translate(-8.015 -3.8)"
                            fill="#012128"
                        />
                    </g>
                    <g
                        id="Group_42"
                        data-name="Group 42"
                        transform="translate(0 0.654)"
                    >
                        <path
                            id="Path_23"
                            data-name="Path 23"
                            d="M19.743,38.48a12.174,12.174,0,0,0-2.483,2.95l1.555-.2c-3.036-2.97-5.762-6.129-8.954-8.984C8.7,31.2,4.069,28.194,3.7,26.736c-.485-1.915,2.505-3.677,3.618-4.727,3.108-2.934,5.669-6.366,8.5-9.556,1.3-1.464,2.8-3.541,4.509-4.505,2.74-1.548,5.915-1.3,8.935-1.4,1.271-.041,1.277-2.022,0-1.981-2.595.084-5.869-.367-8.325.647-2.6,1.073-4.711,3.795-6.52,5.833-2.359,2.659-4.513,5.5-6.984,8.06C5.241,21.379,2.7,23.208.912,25.834a1,1,0,0,0,.155,1.2C6.729,32.1,12.016,37.348,17.415,42.63a1,1,0,0,0,1.555-.2,7.454,7.454,0,0,1,2.173-2.55c.961-.841-.445-2.238-1.4-1.4Z"
                            transform="translate(-0.776 -4.543)"
                            fill="#012128"
                        />
                    </g>
                </g>
            </svg>
        </header>
        <main class="p-4 text-center">
            <div class="text-lg">Sale</div>
            <div class="text-sm text-text-400">20K</div>
        </main>
        <footer class="p-4 text-end text-info-400">
            20%
            <svg
                id="Arrow"
                class="inline-block"
                xmlns="http://www.w3.org/2000/svg"
                width="7.985"
                height="20.777"
                viewBox="0 0 7.985 20.777"
            >
                <g id="Group_12" data-name="Group 12">
                    <line
                        id="Line_1"
                        data-name="Line 1"
                        y2="19.628"
                        transform="translate(3.993 1.149)"
                        fill="none"
                        :stroke="stroke"
                        stroke-width="1"
                    />
                    <g
                        id="Path_1"
                        data-name="Path 1"
                        fill="none"
                        stroke-linecap="square"
                        stroke-linejoin="bevel"
                    >
                        <path d="M3.993,0,7.985,9.189H0Z" stroke="none" />
                        <path
                            d="M 3.992635726928711 -2.86102294921875e-06 L 7.985275745391846 9.189057350158691 L -4.291534423828125e-06 9.189057350158691 L 3.992635726928711 -2.86102294921875e-06 Z"
                            stroke="none"
                            :fill="stroke"
                        />
                    </g>
                </g>
            </svg>
        </footer>
    </div>
</template>
