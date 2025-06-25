<script setup>

import AdminLayout from "@/Layouts/AdminLayout.vue";
</script>

<template>
    <AdminLayout>
        <div class="max-w-4xl mx-auto bg-white px-4 pt-4 shadow-md rounded-lg">
            <!-- Header -->
            <div class="bg-cyan-950 p-4 rounded-t-lg mb-4  flex justify-between items-center">
                <img src="" alt="Logo" class="h-16">
                <h1 class="text-3xl font-semibold text-white font-obeo">Hotel Reservation</h1>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <!-- Left Column -->
                <div>
                    <!-- Booking Source -->
                    <div class="p-4 rounded-lg flex justify-center items-center border-2 border-cyan-950">
                        Booking.com
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg mt-4 shadow shadow-black min-h-[347px]">
                        <h2 class="text-xl font-semibold mb-1 text-cyan-950 font-obeo">Reservation Information</h2>
                        <hr class="border border-black">
                        <table class="w-full mt-2  ">
                            <tr class=" ">
                                <th class="w-1/2 font-serif text-left">Booking Number</th>
                                <td class="w-1/2 text-black font-rflex text-left"></td>
                            </tr>
                            <tr class="">
                                <th class="w-1/2 font-serif text-left">Check In</th>
                                <td class="w-1/2 text-black font-rflex text-left"></td>
                            </tr>
                            <tr class="">
                                <th class="w-1/2 font-serif text-left">Check Out</th>
                                <td class="w-1/2 text-black font-rflex text-left"></td>
                            </tr>
                            <tr class="">
                                <th class="w-1/2 font-seri text-left">Booking Date</th>
                                <td class="w-1/2 text-black font-rflex text-left"></td>
                            </tr>
                            <tr class="">
                                <th class="w-1/2 font-serif text-left align-top">Guest Name</th>
                                <td class="w-1/2 text-black font-serif text-left align-top"></td>
                            </tr>
                            <tr class="">
                                <th class="w-1/2 font-serif text-left align-top">Room Name</th>
                                <td class="w-1/2 text-black font-serif text-left align-top"></td>
                            </tr>
                            <tr class="">
                                <th class="w-1/2 font-serif text-left">Total Room</th>
                                <td class="w-1/2 text-black font-rflex text-left"></td>
                            </tr>
                            <tr class="">
                                <th class="w-1/2 font-serif text-left">Total Night</th>
                                <td class="w-1/2 text-black font-rflex text-left"></td>
                            </tr>
                            <tr class="">
                                <th class="w-1/2 font-serif text-left">Booking Source</th>
                                <td class="w-1/2 text-black font-serif text-left"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- Right Column -->
                <div>
                    <!-- Hotel Name -->
                    <div class="bg-cyan-950 p-4 rounded-lg mb-4">
                        <h3 class="text-xl font-serif text-center font-bold text-white py-1"></h3>
                    </div>
                    <div class="bg-gray-100 p-4 mt-4 rounded-lg shadow shadow-black">
                        <h2 class="text-xl font-semibold mb-1 text-cyan-950 font-obeo">Payment & Pricing</h2>
                        <hr class="border border-black">
                        <table class="w-full mt-2">
                            <tr class="text-left">
                                <th class="w-1/2 font-serif">Price (USD)</th>
                                <td class="w-1/2 text-black font-rflex"> USD</td>
                            </tr>
                            <tr class="text-left">
                                <th class="w-1/2">Exchange Rate</th>
                                <td class="w-1/2 text-black font-rflex">
                                    TK
                                </td>
                            </tr>
                            <tr class="text-left">
                                <th class="w-1/2 font-serif">Total Price (BDT)</th>
                                <td class="w-1/2 text-black font-rflex">TK
                                </td>
                            </tr>
                            <tr class="text-left">
                                <th class="w-1/2 font-serif">Total Advance</th>
                                <td class="w-1/2 text-black font-rflex">TK
                                </td>
                            </tr>
                            <tr class="text-left">
                                <th class="w-1/2 font-serif">Total Pay In Hotel</th>
                                <td class="w-1/2 text-black font-rflex"> TK</td>
                            </tr>
                            <tr class="text-left">
                                <th class="w-1/2 font-serif">Payment Method</th>
                                <td class="w-1/2 text-black font-serif"></td>
                            </tr>
                        </table>
                    </div>
                    <!-- Contact Information -->
                    <div class="mt-4 bg-gray-100 p-4 rounded-lg shadow shadow-black">
                        <h2 class="text-xl font-semibold mb-1 text-cyan-950 font-obeo">Contact Information</h2>
                        <hr class="border border-black">
                        <table class="w-full mt-2">
                            <tr class="">
                                <th class="w-3/5 font-serif text-left text-medium">Phone Number</th>
                                <td class="w-2/5 text-black font-rflex text-center text-sm"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Room Wise Payment Details -->
            <div class="mt-4 bg-gray-100 px-4 py-2 rounded-lg shadow shadow-black">
                <h2 class="text-xl font-semibold  text-cyan-950 font-obeo">Room Wise Information & Price Details</h2>
            </div>

            <div class="mt-4 grid grid-cols-2  gap-4">

                <div class="bg-gray-100 px-4 py-2 rounded-lg shadow shadow-black">
                    <table class="w-full mt-2">
                        <tr class="text-left">
                            <th class="w-2/3 font-serif"></th>
                            <td class="w-1/3 text-black font-rflex"></td>
                        </tr>
                        <tr class="text-left">
                            <th class="w-2/3 font-serif">Total Night</th>
                            <td class="w-1/3 text-black font-rflex"></td>
                        </tr>
                        <tr class="text-left">
                            <th class="w-2/3 font-serif">Price Per Night</th>
                            <td class="w-1/3 text-black font-rflex"> TK</td>
                        </tr>
                    </table>
                </div>

            </div>

            <div class="bg-gray-100 px-4 py-2 rounded-lg mt-4 shadow shadow-black">
                <table class="w-full mt-2">
                    <tr class="">
                        <th class="w-1/2 font-serif text-start"></th>
                        <td class="w-1/2 text-black font-rflex text-start"></td>
                    </tr>
                    <tr class="">
                        <th class="w-1/2 font-serif text-start">Price Per Night (<span class="font-rflex">1</span> Room)
                        </th>
                        <td class="w-1/2 text-black font-rflex text-start">

                        </td>
                    </tr>

                    <tr class="">
                        <th class="w-1/2 font-serif text-start">Price Per Night (<span class="font-rflex"></span>
                            Room)
                        </th>
                        <td class="w-1/2 text-black font-rflex text-start">
                        </td>
                    </tr>

                    <tr class="">
                        <th class="w-1/2 font-serif text-start">Total (<span
                            class="font-rflex"></span> Room <span
                            class="font-rflex"></span> Night)
                        </th>
                        <td class="w-1/2 text-black font-rflex text-start">
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Comments -->
            <div class="bg-gray-200 p-4 rounded-lg mt-4 shadow shadow-black">
                <table class="w-full mt-2">
                    <tr class="flex justify-center items-start">
                        <th class="w-1/6 font-serif">Comments</th>
                        <td class="w-5/6 text-black font-serif"></td>
                    </tr>
                </table>
            </div>

            <!-- Reservation Details -->
            <div class="grid grid-cols-2 gap-4">
                <!-- Left Column -->
                <div>
                    <!-- Booking Source -->
                    <div class="p-4 rounded-lg flex justify-center items-center border-2 border-cyan-950">

                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg mt-4 shadow shadow-black min-h-[347px]">
                        <h2 class="text-xl font-semibold mb-1 text-cyan-950 font-obeo">Reservation Information</h2>
                        <hr class="border border-black">
                        <table class="w-full mt-2  ">
                            <tr class=" ">
                                <th class="w-1/2 font-serif text-left">Booking Number</th>
                                <td class="w-1/2 text-black font-rflex text-left"></td>
                            </tr>
                            <tr class="">
                                <th class="w-1/2 font-serif text-left">Check In</th>
                                <td class="w-1/2 text-black font-rflex text-left"></td>
                            </tr>
                            <tr class="">
                                <th class="w-1/2 font-serif text-left">Check Out</th>
                                <td class="w-1/2 text-black font-rflex text-left"></td>
                            </tr>
                            <tr class="">
                                <th class="w-1/2 font-seri text-left">Booking Date</th>
                                <td class="w-1/2 text-black font-rflex text-left"></td>
                            </tr>
                            <tr class="">
                                <th class="w-1/2 font-serif text-left align-top">Guest Name</th>
                                <td class="w-1/2 text-black font-serif text-left align-top"></td>
                            </tr>
                            <tr class="">
                                <th class="w-1/2 font-serif text-left align-top">Room Name</th>
                                <td class="w-1/2 text-black font-serif text-left align-top"></td>
                            </tr>
                            <tr class="">
                                <th class="w-1/2 font-serif text-left">Total Room</th>
                                <td class="w-1/2 text-black font-rflex text-left"></td>
                            </tr>
                            <tr class="">
                                <th class="w-1/2 font-serif text-left">Total Night</th>
                                <td class="w-1/2 text-black font-rflex text-left"></td>
                            </tr>
                            <tr class="">
                                <th class="w-1/2 font-serif text-left">Booking Source</th>
                                <td class="w-1/2 text-black font-serif text-left"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- Right Column -->
                <div>
                    <!-- Hotel Name -->
                    <div class="bg-cyan-950 p-4 rounded-lg mb-4">
                        <h3 class="text-xl font-serif text-center font-bold text-white py-1"></h3>
                    </div>
                    <div class="bg-gray-100 p-4 mt-4 rounded-lg shadow shadow-black">
                        <h2 class="text-xl font-semibold mb-1 text-cyan-950 font-obeo">Payment & Pricing</h2>
                        <hr class="border border-black">
                        <table class="w-full mt-2">
                            <tr class="text-left">
                                <th class="w-1/2 font-serif">Price (USD)</th>
                                <td class="w-1/2 text-black font-rflex"></td>
                            </tr>
                            <tr class="text-left">
                                <th class="w-1/2">Exchange Rate</th>
                                <td class="w-1/2 text-black font-rflex">
                                    TK
                                </td>
                            </tr>
                            <tr class="text-left">
                                <th class="w-1/2 font-serif">Total Price (BDT)</th>
                                <td class="w-1/2 text-black font-rflex">TK
                                </td>
                            </tr>
                            <tr class="text-left">
                                <th class="w-1/2 font-serif">Total Advance</th>
                                <td class="w-1/2 text-black font-rflex">TK
                                </td>
                            </tr>
                            <tr class="text-left">
                                <th class="w-1/2 font-serif">Total Pay In Hotel</th>
                                <td class="w-1/2 text-black font-rflex"> TK</td>
                            </tr>
                            <tr class="text-left">
                                <th class="w-1/2 font-serif">Payment Method</th>
                                <td class="w-1/2 text-black font-serif"></td>
                            </tr>
                        </table>
                    </div>
                    <!-- Contact Information -->
                    <div class="mt-4 bg-gray-100 p-4 rounded-lg shadow shadow-black">
                        <h2 class="text-xl font-semibold mb-1 text-cyan-950 font-obeo">Contact Information</h2>
                        <hr class="border border-black">
                        <table class="w-full mt-2">
                            <tr class="">
                                <th class="w-3/5 font-serif text-left text-medium">Phone Number</th>
                                <td class="w-2/5 text-black font-rflex text-center text-sm"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Room Wise Payment Details -->
            <div class="mt-4 bg-gray-100 px-4 py-2 rounded-lg shadow shadow-black">
                <h2 class="text-xl font-semibold  text-cyan-950 font-obeo">Room Wise Information & Price Details</h2>
            </div>
            <div class="mt-4 grid grid-cols-2  gap-4">
                <div class="bg-gray-100 px-4 py-2 rounded-lg shadow shadow-black">
                    <table class="w-full mt-2">
                        <tr class="text-left">
                            <th class="w-2/3 font-serif"></th>
                            <td class="w-1/3 text-black font-rflex"></td>
                        </tr>
                        <tr class="text-left">
                            <th class="w-2/3 font-serif">Total Night</th>
                            <td class="w-1/3 text-black font-rflex"></td>
                        </tr>
                        <tr class="text-left">
                            <th class="w-2/3 font-serif">Price Per Night</th>
                            <td class="w-1/3 text-black font-rflex"> TK</td>
                        </tr>
                    </table>
                </div>

            </div>

            <div class="bg-gray-100 px-4 py-2 rounded-lg mt-4 shadow shadow-black">
                <table class="w-full mt-2">
                    <tr class="">
                        <th class="w-1/2 font-serif text-start">'.$row["room"] .'</th>
                        <td class="w-1/2 text-black font-rflex text-start">'.$room_format.'</td>
                    </tr>
                    <tr class="">
                        <th class="w-1/2 font-serif text-start">Price Per Night (<span class="font-rflex">1</span> Room)
                        </th>
                        <td class="w-1/2 text-black font-rflex text-start">
                            '.number_format($price_one_single_type_room_one_night,2).'TK
                        </td>
                    </tr>

                    <tr class="">
                        <th class="w-1/2 font-serif text-start">Price Per Night (<span class="font-rflex">'.$row['total_room'].'</span>
                            Room)
                        </th>
                        <td class="w-1/2 text-black font-rflex text-start">'.number_format(
                            $price_one_single_type_room_one_night*$row['total_room'] ,2).'TK
                        </td>
                    </tr>

                    <tr class="">
                        <th class="w-1/2 font-serif text-start">Total (<span
                            class="font-rflex">'.$row['total_room'].'</span> Room <span
                            class="font-rflex">'.$row['night'].'</span> Night)
                        </th>
                        <td class="w-1/2 text-black font-rflex text-start">'.number_format(
                            $total_full_price_single_type_room ,2).'TK
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Comments -->
            <div class="bg-gray-200 p-4 rounded-lg mt-4 shadow shadow-black">
                <table class="w-full mt-2">
                    <tr class="flex justify-center items-start">
                        <th class="w-1/6 font-serif">Comments</th>
                        <td class="w-5/6 text-black font-serif"></td>
                    </tr>
                </table>
            </div>




            <!-- Footer -->

            <div class="bg-cyan-950 px-4 py-8 rounded-b-lg my-4 shadow shadow-black flex items-center">
                <p class="flex-1 text-center text-white font-semibold text-lg">&copy;  Obeo Limited.
                    All rights reserved.</p>
                <p class="text-end text-white font-semibold text-sm"></p>
            </div>

            <div class="bg-cyan-950 p-4 rounded-b-lg my-4 shadow shadow-black flex items-center">
                <p class="flex-1 text-center text-white font-semibold text-lg">&copy;  Obeo Limited.
                    All rights reserved.</p>
                <p class="text-end text-white font-semibold text-sm"></p>
            </div>

            <div class="bg-cyan-950 px-4 py-2 rounded-b-lg mt-2 shadow shadow-black flex items-center">
                <p class=" flex-1 text-center text-white font-semibold text-lg">&copy;  Obeo
                    Limited. All rights reserved.</p>
                <p class="text-end text-white font-semibold text-sm">   </p>
            </div>

        </div>
    </AdminLayout>
</template>

<style scoped>

</style>
