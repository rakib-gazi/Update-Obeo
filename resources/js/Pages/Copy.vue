<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import logo from '../../images/logo.png';
import booking from '../../images/booking.png';
import obeologo from '../../images/obeologo.png';
</script>

<template>
    <AdminLayout>
        <div class="max-w-4xl mx-auto bg-gray-50 p-6 shadow-md rounded-lg">
            <!-- Header -->
            <div class=" p-4 rounded-2xl shadow-md mb-4  flex justify-between items-center bg-white">
                <img :src="obeologo" alt="Logo" class="h-24">
                <div class="text-right">
                    <div class="flex justify-end">
                        <img :src="booking" alt="Reservation Source" class="h-6">
                    </div>
                    <h1 class="text-3xl font-extrabold text-cyan-950">Hotel Reservation</h1>
                    <h3 class="text-xl font-bold text-cyan-950 py-1">Hotel Royal Raj International</h3>
                </div>
            </div>
            <!-- Reservation information -->
            <div class="rounded-2xl bg-white shadow-md mt-4">
                        <h1 class="bg-cyan-950 py-2 text-white text-center rounded-t-2xl text-xl font-semibold ">Reservation Information</h1>
                        <div class="p-4  flex justify-between">
                            <div>
                                <p class=" font-bold">Reservation #2229807022 </p>
                                <h2 class="text-2xl font-semibold mb-1 text-cyan-950">Mohammed Rakib Gazi</h2>
                                <p>Jun 26, 2025 - Jun 28, 2025 </p>
                            </div>
                            <div class="flex flex-col justify-end">
                                <p class=" font-bold">Obeo Sl #2229807022 </p>
                                <h2 class="text-2xl font-semibold mb-1 text-cyan-950">3 Rooms & 2 Nights</h2>
                                <p>Booked on - Jun 28, 2025 </p>
                            </div>
                        </div>
                    </div>
            <!--payment & Pricing  -->
            <div class="rounded-2xl bg-white shadow-md mt-4">
                        <h1 class="bg-cyan-950 py-2 text-white text-center rounded-t-2xl text-xl font-semibold ">Payment & Pricing </h1>
                        <div class="p-4  grid grid-cols-3  gap-4">
                            <div>
                                <p class="text-sm font-bold">Price (USD) </p>
                                <h2 class="text-2xl font-semibold mb-1 text-cyan-950">$37.00</h2>
                            </div>
                            <div class="flex flex-col justify-end">
                                <p class="text-sm font-bold">Exchange Rate </p>
                                <h2 class="text-2xl font-semibold mb-1 text-cyan-950">122.00 TK</h2>
                            </div>
                            <div class="flex flex-col justify-end">
                                <p class="text-sm font-bold">Total Price (BDT) </p>
                                <h2 class="text-2xl font-semibold mb-1 text-cyan-950">12200.00 TK</h2>
                            </div>
                            <div class="flex flex-col justify-end">
                                <p class="text-sm font-bold">Total Advance </p>
                                <h2 class="text-2xl font-semibold mb-1 text-cyan-950">12200.00 TK</h2>
                            </div>
                            <div class="flex flex-col justify-end">
                                <p class="text-sm font-bold">Total Pay In Hotel</p>
                                <h2 class="text-2xl font-semibold mb-1 text-cyan-950">12200.00 TK</h2>
                            </div>
                            <div class="flex flex-col justify-end">
                                <p class="text-sm font-bold">Payment Method</p>
                                <h2 class="text-2xl font-semibold mb-1 text-cyan-950">Hotel Collects</h2>
                            </div>
                        </div>
                    </div>
            <!-- Contact information -->
            <div class="rounded-2xl bg-white shadow-md mt-4">
                <h1 class="bg-cyan-950 py-2 text-white text-center rounded-t-2xl text-xl font-semibold ">Contact Information</h1>
                <div class="p-4  flex justify-between">
                    <div>
                        <p class="text-sm font-bold">Phone </p>
                        <h2 class="text-xl font-semibold mb-1 text-cyan-950">01876987622</h2>
                    </div>
                    <div>
                        <p class="text-sm font-bold">Email </p>
                        <h2 class="text-xl font-semibold mb-1 text-cyan-950">webobeorooms@gmail.com</h2>
                    </div>
                </div>
            </div>
            <!-- Room Wise Payment Details -->
            <div class="rounded-2xl bg-white shadow-md mt-4">
                <h1 class="bg-cyan-950 py-2 text-white text-center rounded-t-2xl text-xl font-semibold ">Room Wise Information & Price Details</h1>
                <div class="p-4  flex justify-between">
                    <div>
                        <p class="text-sm font-bold">Room Name </p>
                        <h2 class="text-xl font-semibold mb-1 text-cyan-950">Deluxe Single Room</h2>
                    </div>
                    <div>
                        <p class="text-sm font-bold">Total Room & Nights </p>
                        <h2 class="text-xl font-semibold mb-1 text-cyan-950">3 Rooms & 2 Nights</h2>
                    </div>
                    <div>
                        <p class="text-sm font-bold">Price Per Night </p>
                        <h2 class="text-xl font-semibold mb-1 text-cyan-950">7000.00 Tk</h2>
                    </div>
                </div>
            </div>
            <!-- Comments & Special Request -->
            <div class="rounded-2xl bg-white shadow-md mt-4">
                <h1 class="bg-cyan-950 py-2 text-white text-center rounded-t-2xl text-xl font-semibold ">Comments & Requests</h1>
                <div class="p-4">
                    <div>
                        <p class="text-sm font-bold">Special Request </p>
                        <h2 class="text-xl font-bold mb-1 text-cyan-950">Please Provide non smoking room</h2>
                    </div>
                    <div>
                        <p class="text-sm font-bold">Comments </p>
                        <h2 class="text-xl font-bold mb-1 text-cyan-950">This guest is our vip guest</h2>
                    </div>
                </div>
            </div>




            <!-- Footer -->

            <div class="bg-cyan-950 px-4 py-8 rounded-b-lg my-4 shadow shadow-black flex items-center">
                <p class="flex-1 text-center text-white font-semibold text-lg">&copy;  Obeo Limited.
                    All rights reserved.</p>
                <p class="text-end text-white font-semibold text-sm"></p>
            </div>

        </div>
    </AdminLayout>
</template>

<style scoped>

</style>
