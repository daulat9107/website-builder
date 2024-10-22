import {
    mdiAccountCircle,
    mdiLock,
    mdiSquareEditOutline,
    mdiViewList,
    mdiTelevisionGuide,
} from "@mdi/js";
export default [
    "General",
    [
        {
            to: route("dashboard"),
            href: route("dashboard"),
            icon: mdiLock,
            label: "Dashboard",
        },
    ],
    "Masters",
    [
        {
            label: "Accounts",
            subLabel: "Accounts Details",
            icon: mdiViewList,
            menu: [
                {
                    to: route("accounts", { group_id: 3 }),
                    label: "Agencies",
                },
                {
                    to: route("accounts", { group_id: 2 }),
                    label: "Suppliers",
                },
                {
                    to: route("accounts", { group_id: 1 }),
                    label: "Purchasers",
                },
            ],
        },
        {
            label: "Addresses",
            subLabel: "Addresses Details",
            icon: mdiViewList,
            menu: [
                {
                    to: route("addresses", { group_id: 3 }),
                    label: "Agencies",
                },
                {
                    to: route("addresses", { group_id: 2 }),
                    label: "Suppliers",
                },
                {
                    to: route("addresses", { group_id: 1 }),
                    label: "Purchasers",
                },
            ],
        },
        {
            to: route("agencies"),
            label: "Agencies",
            icon: mdiSquareEditOutline,
        },
        {
            to: route("firms"),
            label: "Firms",
            icon: mdiSquareEditOutline,
        },
        {
            to: route("groups"),
            label: "Groups",
            icon: mdiSquareEditOutline,
        },
        {
            to: route("pages"),
            label: "Pages",
            icon: mdiSquareEditOutline,
        },
        {
            to: route("products"),
            label: "Products",
            icon: mdiSquareEditOutline,
        },
        {
            to: route("purchasers"),
            label: "Purchasers",
            icon: mdiTelevisionGuide,
        },
        {
            to: route("suppliers"),
            label: "Suppliers",
            icon: mdiSquareEditOutline,
        },
        {
            label: "Transports",
            subLabel: "Transports Details",
            icon: mdiViewList,
            menu: [
                {
                    to: route("transports", { group_id: 3 }),
                    label: "Agencies",
                },
                {
                    to: route("transports", { group_id: 2 }),
                    label: "Suppliers",
                },
                {
                    to: route("transports", { group_id: 1 }),
                    label: "Purchasers",
                },
            ],
        },
        {
            to: route("orders"),
            label: "Orders",
            icon: mdiSquareEditOutline,
        },
        {
            to: route("order-products"),
            label: "Order Products",
            icon: mdiSquareEditOutline,
        },
        {
            to: route("track-orders-status"),
            label: "Track Orders Status",
            icon: mdiSquareEditOutline,
        },

        {
            label: "Invoices",
            subLabel: "Invoices Details",
            icon: mdiViewList,
            menu: [
                {
                    to: route("invoice"),
                    label: "Invoice",
                },
            ],
        },
        // {
        //   to: '/register',
        //   label: 'Register',
        //   icon: mdiLock
        // }
    ],
    // 'About',
    // [
    //   {
    //     href: 'https://justboil.me/tailwind-admin-templates/vue-dashboard/',
    //     label: 'Premium version',
    //     icon: mdiMonitorShimmer,
    //     target: '_blank'
    //   },
    //   {
    //     href: 'https://github.com/justboil/admin-one-vue-tailwind',
    //     label: 'GitHub',
    //     icon: mdiGithub,
    //     target: '_blank'
    //   }
    // ]
];
