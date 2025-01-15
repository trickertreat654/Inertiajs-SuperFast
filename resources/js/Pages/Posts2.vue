<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Deferred, WhenVisible, router } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { usePoll } from '@inertiajs/vue3'
import HeaderThing from '@/Components/HeaderThing.vue';

usePoll(10000)



defineProps({
    user: Object, 
    userPosts: Array,
    type: String,
}) 

defineOptions({
    layout: [AuthenticatedLayout],
    
})
</script>

<template>
   
    <div>
        <div
                class="bg-white shadow dark:bg-gray-800"
               
            >
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                  
                        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                            Posts
                        </h2>
                </div>
        </div>  

        <div v-if="type === 'ssr'">
            <Deferred   data="user">
                <template #fallback>
                    <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-green-200 shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div  class="p-6 text-gray-900 dark:text-gray-100">
                        
                        Name-Loading...
                    </div>
                </div>
            </div>
        </div>
                </template>
                <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-green-200 shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div  class="p-6 text-gray-900 dark:text-gray-100">
                        
                        {{ user.name }}
                    </div>
                </div>
            </div>
        </div>
            </Deferred>
        </div>
        <div v-else>
            <WhenVisible data="user">
                <template #fallback>
                    <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-green-200 shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div  class="p-6 text-gray-900 dark:text-gray-100">
                        
                        Name-Loading...
                    </div>
                </div>
            </div>
        </div>
                </template>
                <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-green-200 shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div  class="p-6 text-gray-900 dark:text-gray-100">
                        
                        {{ user.name }}
                    </div>
                </div>
            </div>
        </div>
            </WhenVisible>
        </div>

        <Deferred :data="['user-posts']">
            <template #fallback>
                <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div  class="p-6 text-gray-900 dark:text-gray-100">
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
                    <div v-for="post in userPosts" class="p-6 text-gray-900 dark:text-gray-100">
                        {{post.title }}
                    </div>
                </div>
            </div>
        </div>
        </Deferred>
    </div>
</template>