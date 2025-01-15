<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';


defineOptions({
    layout: AuthenticatedLayout,
})
</script>

<template>

<div
                class="bg-white shadow dark:bg-gray-800"
               
            >
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                  
                        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                            Posts
                        </h2>
                </div>
        </div>  
    
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
</template>
