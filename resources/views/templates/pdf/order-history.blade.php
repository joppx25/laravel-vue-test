<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Order History #{{ $orderId }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Page Content -->
            <main>
                <h1>Order History #{{ $orderId }}</h1>
                <div class="order-table-wrapper mt-10 print-only">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-md uppercase text-gray-900 bg-gray-50 border-b border-solid border-b-2 border-gray-900">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                </th>
                                <th scope="col" class="px-6 py-3">
                                </th>
                                <th scope="col" class="px-6 py-3">
                                </th>
                                <th scope="col" class="px-6 py-3">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="order-details">
                                <td class="px-6 py-4" colspan="3">
                                    <div class="py-5">
                                        <h3 class="font-bold text-lg text-gray-900">Build Your Own Meal Plan - Vegan</h3>
                                        <ul class="mb-2 mt-3 ml-6 space-y-4 list-inside">
                                            @foreach ($details as $mealKey => $meals)
                                            <li v-for="detail, meal in details">
                                                <span class="font-bold text-md text-orange-800">{{ $mealKey }}</span>
                                                <ul class="pl-5 mt-2 space-y-1 list-inside">
                                                    @foreach ($meals as $list)
                                                        <li class="text-gray-900 font-bold">x{{ $list->occurrences }} {{ $list->meal_name }}</li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-900 font-bold" style="width: 100%; text-align: right;">
                                   ${{ $orderPrice }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </body>
</html>
