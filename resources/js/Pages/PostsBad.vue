<script setup>
import { usePrefetch, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

// const { lastUpdatedAt, isPrefetching, isPrefetched } = usePrefetch(
//     "/posts",
//     { method: "get" }, // Request options
//     { cacheFor: "10s" } // Prefetch options
// );
function prefetchUsers() {
    router.push({
        url: "/posts",
        component: "Posts",
        preserveState: false,
        clearHistory: false,
    });

    // router.replace({
    //     url: "/posts",
    //     component: "Posts",
    //     preserveState: false,
    //     clearHistory: false,
    // });

    router.prefetch(
        "/posts",
        {
            method: "get",

            onPrefetching: () => {
                console.log(lastUpdatedAt.value);
                console.log(isPrefetching.value);
                console.log(isPrefetched.value);
                // router.reload({ only: ["user", "suer2"] });
            },
        },
        { cacheFor: "2m" }
    );
    console.log(lastUpdatedAt.value);
    console.log(isPrefetching.value);
    console.log(isPrefetched.value);
}

// lastUpdatedAt: The timestamp of the last successful prefetch.
// isPrefetching: Boolean indicating if the prefetch is in progress.
// isPrefetched: Boolean indicating if the data has been successfully prefetched.

// defineOptions({
//     layout: AuthenticatedLayout,
// });
</script>

<template>
    <div>
        <button @click="prefetchUsers">Hover to Prefetch posts</button>
        <p v-if="isPrefetching">Prefetching...</p>
        <p v-if="isPrefetched">Users data prefetched!</p>
        <p>Last updated: {{ lastUpdatedAt }}</p>
    </div>
</template>
