<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Deferred, WhenVisible, router } from "@inertiajs/vue3";
import { onMounted } from "vue";
import { usePoll } from "@inertiajs/vue3";

// usePoll(10000)

defineProps({
    userBetter: Object,
    user2Better: Object,
    userPostsBetter: Array,
});

defineOptions({
    layout: AuthenticatedLayout,
});
</script>

<template>
    <div>
        <div class="shadow bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-semibold text-gray-200">
                    Posts -- Prefetched
                </h2>
            </div>
        </div>

        <div
            class="max-w-7xl py-12 grid grid-rows-2 md:grid-rows-1 md:grid-cols-2 mx-auto"
        >
            <div class="w-full">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="shadow-sm sm:rounded-lg bg-gray-800">
                        <p class="pl-6 pt-6 text-2xl text-gray-100">
                            Delay on Server: 3s
                        </p>
                        <Deferred data="user-better">
                            <template #fallback>
                                <div class="p-6 text-xl text-red-400">
                                    Username: Loading...
                                </div>
                            </template>
                            <div class="p-6 text-xl text-green-400">
                                Username: {{ userBetter.name }}
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
                        <Deferred data="user2-better">
                            <template #fallback>
                                <div class="p-6 text-xl text-red-400">
                                    Username2: Loading...
                                </div>
                            </template>
                            <div class="p-6 text-xl text-green-400">
                                Username2: {{ user2Better.name }}
                            </div>
                        </Deferred>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <p class="pl-1 py-6 text-2xl text-gray-100">
                    Delay on Server: 5s
                </p>
                <div
                    class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <Deferred :data="['user-posts-better']">
                        <template #fallback>
                            <div class="p-6 text-lg text-red-400">
                                <div>Posts-Loading...</div>
                            </div>
                        </template>
                        <div
                            v-for="post in userPostsBetter"
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
