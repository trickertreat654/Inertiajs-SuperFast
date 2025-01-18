<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, Link, usePage } from "@inertiajs/vue3";
import { watch, ref, onMounted } from "vue";
import { useServerThrottle } from "@/Composables/ServerThrottle";

defineOptions({
    layout: AuthenticatedLayout,
});

// defineProps({
//     server: Number,
// });

const flushCache = () => {
    router.flushAll();
};

const toggleThrottle = () => {
    // router.visit(route("server.throttle"), {
    //     method: "post",
    //     preserveState: true,
    //     async: true,
    //     showProgress: true,
    // });
    // page.props.server = !page.props.server;
    router.flushAll();
};

const server = useServerThrottle();

// const serverState = ref(page.props.custom.server);
// serverState.value = page.props.server;
// console.log(serverState.value);
// console.log(page.props.server);

// watch(serverState, (value) => {
//     serverState.value = value;
// });
</script>

<template>
    <div class="shadow bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-semibold text-gray-200">Dashboard</h2>
        </div>
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div
                class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg dark:bg-gray-800"
            >
                <div
                    class="p-6 flex space-x-4 text-gray-900 dark:text-gray-100"
                >
                    <!-- You're logged in! -->
                    <button
                        class="inline-flex items-center rounded-md border border-transparent bg-gray-200 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-800 transition duration-150 ease-in-out hover:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-white dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300"
                        @click="flushCache"
                    >
                        Flush Cache
                    </button>
                    <Link
                        async
                        method="put"
                        :href="route('server.throttle')"
                        class="inline-flex items-center rounded-md border border-transparent bg-gray-200 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-800 transition duration-150 ease-in-out hover:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-white dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300"
                    >
                        Server Throttle
                        <span v-if="server" class="text-green-400"> -on</span>
                        <span v-else class="text-red-400">- off</span>
                    </Link>
                    <!-- <Link
                        async
                        method="post"
                        :href="route('server.throttle')"
                        class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300"
                    >
                        Server Throttle
                        <span v-if="server" class="text-green-400"> -on</span>
                        <span v-else class="text-red-400">- off</span>
                    </Link> -->
                </div>
            </div>
        </div>
    </div>
</template>
