<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import { reactive } from "vue";
import CreateBotForm from "@/Components/CRUD/Bot/CreateForm.vue";
import { router } from "@inertiajs/vue3";
</script>

<template>
    <AppLayout title="Create a Bot">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Create a Bot
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg"
                >
                    <CreateBotForm></CreateBotForm>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
