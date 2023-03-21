<script setup>
    import { ref } from "vue"

    const props = defineProps({
        order: Object,
        order_id: Number,
    });
    const active_pane = ref(null);

    const details = ref({});
    const getOrderDetails = async (order_id) => {
        active_pane.value = active_pane.value === order_id ? null : order_id;
        await axios.get('order/getOrderDetails/' + order_id)
            .then(response => {
                let temp = {};
                for (let meal in response.data) {
                    if (meal === 'lunch' || meal === 'dinner') {
                        details.value['Dinner and lunch'] = response.data[meal];
                    } else {
                        let meal_key = meal.charAt(0).toUpperCase() + meal.slice(1);
                        temp[meal_key] = response.data[meal];
                    }

                    details.value = {...details.value, ...temp}
                }
            })
            .catch(err => {
                console.log(err.message);
            });
    }

    const downloadOrder = (order_id) => {
        window.location.href = `order/export/${order_id}`;
    }
</script>

<template>
    <tr class="border-b border-dotted bg-gray-50 border-gray-900">
        <th scope="row"
            class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
            {{ props.order.delivery_date }}
        </th>
        <td class="px-6 py-4 font-bold text-gray-900">
            ${{ props.order.price }}
        </td>
        <td class="px-6 py-4">
            <h2 :id="'accordion-flush-heading-' + props.order.id">
                <button type="button"
                    ref="toggle"
                    @click="getOrderDetails(props.order.id)"
                    class="flex justify-between items-center py-5 w-full font-bold text-left text-gray-900"
                    :data-accordion-target="'#accordion-flush-body-' + props.order.id"
                    :aria-controls="'accordion-flush-body-' + props.order.id">
                    <span>{{ (active_pane === props.order.id) ? 'Hide Details' : 'View Details' }}</span>
                </button>
            </h2>
        </td>
        <td class="px-6 py-4">
            <a href="#" @click.prevent="downloadOrder(props.order.id)">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859M12 3v8.25m0 0l-3-3m3 3l3-3"></path>
                </svg>
            </a>
        </td>
    </tr>
    <tr :id="'accordion-flush-body-' + props.order.id" :aria-labelledby="'accordion-flush-heading-' + props.order.id" class="hidden order-details">
        <td class="px-6 py-4" colspan="3">
            <div class="py-5">
                <h3 class="font-bold text-lg text-gray-900">Build Your Own Meal Plan - Vegan</h3>
                <ul class="mb-2 mt-3 ml-6 space-y-4 list-inside">
                    <li v-for="detail, meal in details">
                        <span class="font-bold text-md text-orange-800">{{ meal }}</span>
                        <ul class="pl-5 mt-2 space-y-1 list-inside">
                            <li class="text-gray-900 font-bold" v-for="list in detail">
                                <p>
                                    x{{ list.occurrence }} {{ list.meal_name }}
                                    <span class="inline-flex items-baseline">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                        </svg>
                                    </span>
                                </p>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </td>
        <td class="px-6 py-4 text-gray-900 font-bold">
            ${{ props.order.price }}
        </td>
    </tr>
</template>