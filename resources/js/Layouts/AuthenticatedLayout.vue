<script setup>
import { ref, watch } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import { useDark, useToggle } from "@vueuse/core";
import { useServerThrottle } from "@/Composables/ServerThrottle";

const server = useServerThrottle();

const page = usePage();
const processing = ref(false);
// watch(
//     () => page.props.server.throttle_active,
//     () => {
//         processing.value = false;
//     }
// );

const showingNavigationDropdown = ref(false);

const showVideo = ref(false);

const handleOnBefore = (url, component) => {
    console.log(url);
    router.push({
        url: url,
        component: component,
        preserveState: true,
        clearHistory: true,
    });
    if (url == "/dashboard") {
        router.prefetch(url, { method: "get" });
    }
};
const isDark = useDark();
const toggleDark = useToggle(isDark);

const toggleVideo = () => {
    showVideo.value = !showVideo.value;
};

// const toggleServerThrottle = () => {
//     router.visit(route("server.throttle"), {
//         method: "post",
//         async: true,
//         data: {
//             component: page.component,
//         },
//     });
// };
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-900">
            <nav class="border-b border-gray-700 bg-gray-800">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-200"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                            >
                                <Link
                                    async
                                    :onBefore="
                                        () =>
                                            handleOnBefore(
                                                '/dashboard',
                                                'Dashboard'
                                            )
                                    "
                                    class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-400 hover:text-gray-300 hover:border-gray-700 focus:outline-none focus:text-gray-300 focus:border-gray-700 transition duration-150 ease-in-out"
                                    :href="route('dashboard')"
                                >
                                    Dashboard
                                </Link>
                                <Link
                                    class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-400 hover:text-gray-300 hover:border-gray-700 focus:outline-none focus:text-gray-300 focus:border-gray-700 transition duration-150 ease-in-out"
                                    prefetch
                                    preserve-state
                                    preserve-scroll
                                    :progress="false"
                                    async
                                    :onBefore="
                                        () =>
                                            handleOnBefore(
                                                route('posts'),
                                                'Posts',
                                                true
                                            )
                                    "
                                    :except="['user']"
                                    :href="route('posts')"
                                >
                                    Posts
                                </Link>
                                <Link
                                    class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-400 hover:text-gray-300 hover:border-gray-700 focus:outline-none focus:text-gray-300 focus:border-gray-700 transition duration-150 ease-in-out"
                                    prefetch
                                    :href="route('posts.better')"
                                >
                                    PostsBetter
                                </Link>
                                <Link
                                    class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-400 hover:text-gray-300 hover:border-gray-700 focus:outline-none focus:text-gray-300 focus:border-gray-700 transition duration-150 ease-in-out"
                                    :href="route('posts.bad')"
                                    progress
                                >
                                    PostsBad
                                </Link>
                                <button
                                    class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-400 hover:text-gray-300 hover:border-gray-700 focus:outline-none focus:text-gray-300 focus:border-gray-700 transition duration-150 ease-in-out"
                                    :href="route('posts.bad')"
                                    progress
                                >
                                    router
                                </button>
                            </div>
                        </div>
                        <div
                            class="h-16 justify-end space-x-8 w-full flex items-center"
                        >
                            <button
                                @click="toggleDark()"
                                class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300"
                            >
                                {{ isDark ? "Light" : "Dark" }}
                            </button>
                            <!-- <Link
                                async
                                method="put"
                                :onBefore="toggleThrottle"
                                :href="route('server.throttle')"
                                class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300"
                            >
                                Server Throttle
                                <span v-if="server" class="text-green-400">
                                    -on</span
                                >
                                <span v-else class="text-red-400">- off</span>
                            </Link> -->
                            <button
                                class="inline-flex items-center rounded-md border border-transparent px-4 py-2 text-xs font-semibold uppercase tracking-widest transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 bg-gray-200 text-gray-800 hover:bg-white focus:bg-white focus:ring-offset-gray-800 active:bg-gray-300"
                                @click="toggleVideo()"
                            >
                                {{ showVideo ? "Hide" : "Show" }} Video
                            </button>
                        </div>

                        <div class="hidden sm:ms-6 sm:flex sm:items-center">
                            <!-- Settings Dropdown -->
                            <div class="relative ms-3">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="-me-0.5 ms-2 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink
                                            :href="route('profile.edit')"
                                        >
                                            Profile
                                        </DropdownLink>
                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                        >
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div
                        class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600"
                    >
                        <div class="px-4">
                            <div
                                class="text-base font-medium text-gray-800 dark:text-gray-200"
                            >
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="text-sm font-medium text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')">
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header
                class="bg-white shadow dark:bg-gray-800"
                v-if="$slots.header"
            >
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>
            <div v-show="showVideo" class="">
                <!-- <iframe
                    class="mx-auto"
                    width="1080"
                    height="500"
                    src="https://www.youtube.com/embed/WSvFEsgS2pc?si=gqdZWOVstfkxA_DV"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen
                ></iframe> -->
            </div>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
