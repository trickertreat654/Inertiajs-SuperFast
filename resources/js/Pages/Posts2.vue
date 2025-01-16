<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Deferred, WhenVisible, router } from "@inertiajs/vue3";
import { onMounted } from "vue";
import { usePoll } from "@inertiajs/vue3";

// usePoll(10000)

defineProps({
    user: Object,
    userPosts: Array,
    type: String,
});

defineOptions({
    layout: AuthenticatedLayout,
});
</script>

<template>
    <div>
        <div class="shadow bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h2 class="text-xl font-semibold text-gray-200">Posts</h2>
            </div>
        </div>

        <div class="flex flex-col-2" v-if="type == 'ssr'">
            <div class="py-12 w-full">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="shadow-sm sm:rounded-lg bg-gray-800">
                        <p class="pl-6 pt-6 text-gray-100">
                            Delay on Server 3s
                        </p>
                        <Deferred data="user">
                            <template #fallback>
                                <div class="p-6 text-gray-100">
                                    Name-Loading...
                                </div>
                            </template>
                            <div class="p-6 text-gray-100">
                                {{ user.name }}
                            </div>
                        </Deferred>
                    </div>
                </div>
            </div>

            <div class="py-12 w-full">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="shadow-sm sm:rounded-lg bg-gray-800">
                        <p class="pl-6 pt-6 text-gray-100">
                            Delay on Server 7s
                        </p>
                        <Deferred data="user">
                            <template #fallback>
                                <div class="p-6 text-gray-100">
                                    Name-Loading...
                                </div>
                            </template>
                            <div class="p-6 text-gray-100">
                                {{ user.name }}
                            </div>
                        </Deferred>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col-2" v-else>
            <div class="py-12 w-full">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="shadow-sm sm:rounded-lg bg-gray-800">
                        <p class="pl-6 pt-6 text-gray-100">
                            Delay on Server 3s
                        </p>
                        <WhenVisible data="user">
                            <template #fallback>
                                <div class="p-6 text-gray-100">
                                    Name-Loading...
                                </div>
                            </template>
                            <div class="p-6 text-gray-100">
                                {{ user.name }}
                            </div>
                        </WhenVisible>
                    </div>
                </div>
            </div>

            <div class="py-12 w-full">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="shadow-sm sm:rounded-lg bg-gray-800">
                        <p class="pl-6 pt-6 text-gray-100">
                            Delay on Server 7s
                        </p>
                        <WhenVisible data="user">
                            <template #fallback>
                                <div class="p-6 text-gray-100">
                                    Name-Loading...
                                </div>
                            </template>
                            <div class="p-6 text-gray-100">
                                {{ user.name }}
                            </div>
                        </WhenVisible>
                    </div>
                </div>
            </div>
        </div>

        <Deferred :data="['user-posts']">
            <template #fallback>
                <div class="py-12">
                    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <div
                            class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                        >
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <div>Posts-Loading...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div
                        class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                    >
                        <div
                            v-for="post in userPosts"
                            class="p-6 text-gray-900 dark:text-gray-100"
                        >
                            {{ post.title }}
                        </div>
                    </div>
                </div>
            </div>
        </Deferred>
    </div>
</template>
