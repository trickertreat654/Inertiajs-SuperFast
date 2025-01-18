<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Deferred, WhenVisible, router } from "@inertiajs/vue3";
import { onMounted } from "vue";
import { usePoll } from "@inertiajs/vue3";

// usePoll(10000)

defineProps({
    userBad: Object,
    user2Bad: Object,
    userPostsBad: Array,
});
</script>

<template>
    <AuthenticatedLayout>
        <div>
            <div class="shadow bg-gray-800">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <h2 class="text-3xl font-semibold text-gray-200">Posts</h2>
                </div>
            </div>

            <div
                class="max-w-7xl py-12 grid gap-y-4 grid-rows-2 md:grid-rows-1 md:grid-cols-2 mx-auto"
            >
                <div class="w-full">
                    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <div class="shadow-sm sm:rounded-lg bg-gray-800">
                            <p class="pl-6 pt-6 text-2xl text-gray-100">
                                Delay on Server: 1s
                            </p>
                            <div class="p-6 text-xl text-green-400">
                                Username: {{ userBad.name }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full">
                    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <div class="shadow-sm sm:rounded-lg bg-gray-800">
                            <p class="pl-6 pt-6 text-2xl text-gray-100">
                                Delay on Server: 3s
                            </p>
                            <div class="p-6 text-xl text-green-400">
                                Username2: {{ user2Bad.name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <p class="pl-1 py-6 text-2xl text-gray-100">
                        Delay on Server: 2s
                    </p>
                    <div
                        class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg dark:bg-gray-800"
                    >
                        <div
                            v-for="post in userPostsBad"
                            class="p-6 text-lg text-green-400"
                        >
                            {{ post.title }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
