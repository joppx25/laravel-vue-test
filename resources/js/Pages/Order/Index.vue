<script setup>
    import axios from 'axios';
    import OrderItem from './Item.vue';
    import { onMounted, ref } from 'vue';
    
    const orders = ref([]);
    const getOrders = async () => {
       await axios.get('order/getOrdersByUser')
        .then(response => {
            orders.value = response.data.data;
        })
        .catch(err => {
            console.log(err.message);
        });
    }

    onMounted( async () => {
        await getOrders();
    })

</script>

<template>
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="text-center">
            <h1 class="text-xl text-gray-900 font-bold">Past Orders</h1>
        </div>
        <div class="order-table-wrapper mt-10" id="accordion-colapse" data-accordion="open">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-md uppercase text-gray-900 bg-gray-50 border-b border-solid border-b-2 border-gray-900">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Delivery On
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Details
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Invoice
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <OrderItem v-for="order in orders" :order="order" :key="order.id" :order_id="order.id"/>
                </tbody>
            </table>
        </div>
    </div>
</template>
