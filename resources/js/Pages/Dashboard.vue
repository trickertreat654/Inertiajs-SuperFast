<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, Link, usePage, useForm } from "@inertiajs/vue3";
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
const page = usePage();

const form = useForm({
    title: null,
});

const submit = () => {
    form.post("/posts", {
        async: true,
        only: ["bobo"],
        onSuccess: () => {
            delete page.props.user2;
            delete page.props.userPosts;
            router.replace({
                url: "/posts",
                component: "Posts",
                preserveState: true,
                clearHistory: false,
            });
        },
    });
};

// const toggleThrottle = () => {
//     router.visit(
//         "/server.throttle",
//         {
//             method: "get",

//             // async: true,
//             showProgress: true,
//         },
//         {
//             cacheFor: "0s",
//         }
//     );
//     // page.props.server = !page.props.server;
// };

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
            {{ page.props }}
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
                    <!-- <button
                        @click="toggleThrottle"
                        class="inline-flex items-center rounded-md border border-transparent bg-gray-200 px-4 py-2 text-xs font-semibold tracking-widest text-gray-800 transition duration-150 ease-in-out hover:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-white dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300"
                    >
                        SERVER THROTTLE: 2s
                        <span v-if="server" class="text-md text-green-600">
                            --ON</span
                        >
                        <span v-else class="text-red-600">--OFF</span>
                    </button> -->
                    <Link
                        method="put"
                        href="/server.throttle"
                        async
                        :except="['user']"
                        :data="{
                            server: !server,
                        }"
                        :onFinish="(page) => console.log(page)"
                        class="inline-flex items-center rounded-md border border-transparent bg-gray-200 px-4 py-2 text-xs font-semibold tracking-widest text-gray-800 transition duration-150 ease-in-out hover:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-white dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300"
                    >
                        SERVER THROTTLE: 2s
                        <span v-if="server" class="text-md text-green-600">
                            --ON</span
                        >
                        <span v-else class="text-red-600">--OFF</span>
                    </Link>

                    <form @submit.prevent="submit">
                        <label for="server">Server</label>
                        <input
                            v-model="form.title"
                            type="text"
                            name="server"
                            class="border-gray-300 text-black focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        />
                        <button>submit</button>
                    </form>
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
