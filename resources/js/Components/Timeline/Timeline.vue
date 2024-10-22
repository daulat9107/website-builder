<template>
    <main
        class="relative min-h-screen flex flex-col justify-center dark:bg-slate-800 bg-slate-50 overflow-hidden"
    >
        <div class="w-full max-w-6xl mx-auto px-4 md:px-6 py-24">
            <div
                class="flex flex-col justify-center divide-y divide-slate-200 dark:divide-slate-800 [&>*]:py-16"
            >
                <div class="w-full max-w-3xl mx-auto">
                    <div
                        class="space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-300 before:to-transparent"
                    >
                        <template v-if="items.length > 0">
                            <TimelineBox
                                v-for="(item, index) in items"
                                :key="index"
                                :item-is-active="item.is_active"
                            >
                                <template #itemStatus>{{
                                    item.status
                                }}</template>
                                <template #itemDate>{{ item.date }}</template>
                                <template #itemDescription>{{
                                    item.description
                                }}</template>
                            </TimelineBox>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import { defineComponent } from "vue";
import TimelineBox from "@/Components/Timeline/TimelineBox.vue";
export default defineComponent({
    components: {
        TimelineBox,
    },
    props: {
        items: {
            required: false,
            default: [
                {
                    is_active: true,
                    status: "Pending",
                    date: "Exp. 12/08/2023",
                    description:
                        "mply dummy text of the printing and typesetting industry. Lorem Ipsum has.",
                },
                {
                    is_active: true,
                    status: "Pending 1",
                    date: "Exp. 12/08/2023",
                    description:
                        "mply dummy text of the printing and typesetting industry. Lorem Ipsum has.",
                },
                {
                    is_active: false,
                    status: "Done",
                    date: "Exp. 12/08/2023",
                    description:
                        "mply dummy text of the printing and typesetting industry. Lorem Ipsum has.",
                },
            ],
        },
    },
});
</script>
