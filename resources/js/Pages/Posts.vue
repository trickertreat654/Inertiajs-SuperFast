<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Deferred, WhenVisible, router } from "@inertiajs/vue3";
import { onMounted, ref, watch } from "vue";
import { usePoll } from "@inertiajs/vue3";

// usePoll(10000, {
//     only: ["user"],
// });

// usePoll(10000, {
//     only: ["user2"],
// });

// usePoll(10000, {
//     only: ["user-posts"],
// });

const props = defineProps({
    user: Object,
    user2: Object,
    userPosts: Array,

    type: String,
});
const isFetching = ref(false);

onMounted(() => {
    if (!props.user2 || props.user2 == null) {
        router.reload({
            only: ["user2"],
            async: true,
        });
    }
    if (!props.user || props.user == null) {
        router.reload({
            only: ["user"],
            async: true,
        });
    }
    if (!props.userPosts || props.userPosts == null) {
        router.reload({
            only: ["user-posts"],
            async: true,
        });
    }
});

watch(isFetching, (newValue) => {
    console.log("Fetching started! Triggering logic...");
    // Add your custom logic here
});

const whenFetching = () => {
    console.log("Fetching started! Triggering logic...");
    // Add your custom logic here};
};
defineOptions({
    layout: AuthenticatedLayout,
});
</script>

<template>
    <!-- <Deferred data="server">
        <template #fallback>
            <span class="text-red-400"
            >Server-Loading...</span
            >
        </template>
        {{ server }}
    </Deferred> -->
    <div>
        <div class="shadow bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-semibold text-gray-200">
                    Posts -- ClientSide Navigation
                    <span> </span>
                </h2>
            </div>
        </div>

        <div
            class="max-w-7xl py-12 grid grid-rows-2 md:grid-rows-1 md:grid-cols-2 mx-auto"
            v-if="type == 'ssr'"
        >
            <div class="w-full">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="shadow-sm sm:rounded-lg bg-gray-800">
                        <p class="pl-6 pt-6 text-2xl text-gray-100">
                            Delay on Server: 3s
                        </p>
                        <Deferred data="user">
                            <template #fallback>
                                <div class="p-6 text-red-500">
                                    Name-Loading...
                                </div>
                            </template>
                            <div class="p-6 text-xl text-green-400">
                                Username: {{ user.name }}
                            </div>
                        </Deferred>
                    </div>
                </div>
            </div>

            <div class="w-full">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="shadow-sm sm:rounded-lg bg-gray-800">
                        <p class="pl-6 pt-6 text-2xl text-gray-100">
                            Delay on Server: 7s
                        </p>
                        <Deferred data="user2">
                            <template #fallback>
                                <div class="p-6 text-xl text-red-500">
                                    Name-Loading...
                                </div>
                            </template>
                            <div class="p-6 text-xl text-green-400">
                                Username2: {{ user2.name }}
                            </div>
                        </Deferred>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="max-w-7xl py-12 grid grid-rows-2 gap-y-2 md:grid-rows-1 md:grid-cols-2 mx-auto"
            v-else
        >
            <div class="w-full">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="shadow-sm sm:rounded-lg bg-gray-800">
                        <p class="pl-6 pt-6 text-2xl text-gray-100">
                            Delay From Database: 3s
                        </p>
                        <Deferred data="user">
                            <template #fallback>
                                <div class="p-6 text-xl text-red-400">
                                    Username: Loading...
                                </div>
                            </template>
                            <div class="p-6 text-xl text-green-400">
                                Username: {{ user.name }}
                            </div>
                        </Deferred>
                    </div>
                </div>
            </div>

            <div class="w-full">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="shadow-sm sm:rounded-lg bg-gray-800">
                        <p class="pl-6 pt-6 text-2xl text-gray-100">
                            Delay From Database: 7s
                        </p>
                        <Deferred data="user2">
                            <template #fallback>
                                <div class="p-6 text-xl text-red-400">
                                    Username2: Loading...
                                </div>
                            </template>
                            <div class="p-6 text-xl text-green-400">
                                Username2: {{ user2.name }}
                            </div>
                        </Deferred>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <p class="pl-1 py-6 text-2xl text-gray-100">
                    Delay From Database: 5s
                </p>
                <div
                    class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <Deferred :data="['user-posts']">
                        <template #fallback>
                            <div class="p-6 text-lg text-red-400">
                                <div>Posts-Loading...</div>
                            </div>
                        </template>
                        <div
                            v-for="post in userPosts"
                            class="p-6 text-lg text-green-400"
                        >
                            {{ post.title }}
                        </div>
                    </Deferred>
                </div>
            </div>
        </div>
    </div>
</template>
