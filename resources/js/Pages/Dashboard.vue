<script setup>
    import BreezeAuthenticatedLayout from '../Layouts/Authenticated.vue';
    import Order from '../Pages/Order/Index.vue';
    import {
        Head
    } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Dashboard" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight order-history">
                Order History
            </h2>
            <p class="text-lg head-description">View past orders and download tax invoices</p>
        </template>

        <div class="mt-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <Order />
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
