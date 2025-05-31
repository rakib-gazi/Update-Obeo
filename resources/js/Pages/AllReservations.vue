<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { router, useForm, usePage,Link } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { ref } from "vue";
import { Dialog, DialogOverlay, DialogTitle } from "@headlessui/vue";
// State
const userData = ref(usePage().props.reservations);

const isModalOpen = ref(false);
const isEditMode = ref(false);
const isSubmitting = ref(false);
let editingUserId = null;
// Modal Control
const openModal = () => {
    isModalOpen.value = true;
};
const closeModal = () => {
    if (document.activeElement instanceof HTMLElement) {
        document.activeElement.blur();
    }
    isModalOpen.value = false;
    isEditMode.value = false;
    editingUserId = null;
    data.reset();
};
// Form
const data = useForm({
    payment: '',
});
// Refresh User List
const fetchUsers = () => {
    router.reload({
        only: ['payments'],
        onSuccess: () => {
            userData.value = usePage().props.reservations ;
        }
    });
};

// Add or Update User
const handleSubmit = () => {
    isSubmitting.value = true;
    if (isEditMode.value) {
        data.put(`/dashboard/settings/update-payment-method/${editingUserId}`, {
            onSuccess: () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Payment Method updated successfully',
                    showConfirmButton: false,
                    timer: 1000
                });
                closeModal();
                fetchUsers();
            },
            onFinish: () => isSubmitting.value = false
        });
    } else {
        data.post('/dashboard/settings/add-payment-method', {
            onSuccess: () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Payment Method added successfully',
                    showConfirmButton: false,
                    timer: 1000
                });
                closeModal();
                fetchUsers();
            },
            onFinish: () => isSubmitting.value = false
        });
    }
};

// Prepare Edit
const handleEdit = (item) => {
    editingUserId = item.id;
    // data.payment = payment;
    openModal();

};
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});

// Delete
const handleDelete = (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "This Payment Method will be deleted permanently!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            router.get(`/dashboard/settings/delete-payment-method/${id}`)
            Toast.fire({
                icon: "warning",
                title: "Payment Method Deleted successfully"
            });
        }
    });
};

// Table Headers
const tableHeaders = [
    { text: 'Booking No', value: 'reservation_no' },
    { text: 'C/IN', value: 'check_in' },
    { text: 'C/OUT', value: 'check_out' },
    { text: 'Name', value: 'guest_name' },
    { text: 'Hotel', value: 'hotel.hotelName' },
    { text: 'Room', value: 'rooms' },
    { text: 'Total Price',  value: 'total_price_bdt' },
    { text: 'Status',  value: 'status_id' },
    { text: 'Actions', value: 'actions' },
];
function getTotalPriceInBDT(rooms, rate) {
    let total = 0;
    rooms.forEach(room => {
        const price = parseFloat(room.total_price) || 0;
        const currency = room.currency?.currency;

        if (currency === 'USD') {
            total += price * parseFloat(rate || 0);
        } else {
            total += price;
        }
    });
    return total.toFixed(2);
}


</script>

<template>
    <AdminLayout>
        <div>
            <div class="flex justify-between items-center">
                <Link href="/dashboard/settings" class="mb-4 text-white bg-cyan-950 hover:bg-blue-700 font-medium rounded-lg px-4 py-2 flex justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                    </svg>

                    Go Back
                </Link>

                <button @click="openModal" class="mb-4 text-white bg-cyan-950 hover:bg-blue-700 font-medium rounded-lg px-4 py-2 flex justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                    </svg>
                    Add Payment Method
                </button>
            </div>

            <!-- Modal -->
            <Dialog :open="isModalOpen" @close="closeModal" class="fixed z-50 inset-0 overflow-y-auto" aria-hidden="false">
                <div class="flex items-center justify-center min-h-screen p-4 text-center">
                    <DialogOverlay class="fixed inset-0 bg-black opacity-30" />
                    <div class="relative bg-white w-full max-w-lg p-6 rounded-xl shadow-xl z-50">
                        <DialogTitle class="text-xl font-semibold mb-4">
                            Edit Reservation
                        </DialogTitle>
                        <form @submit.prevent="handleSubmit" class="space-y-3">
                            <div>
                                <label for="payment" class="block text-sm font-medium">Payment Method</label>
                                <input v-model="data.payment" type="text" class="w-full border p-2 rounded" />
                                <div v-if="data.errors.payment" class="text-red-500 text-sm">{{ data.errors.payment }}</div>
                            </div>
                            <div class="flex justify-end space-x-2 mt-4">
                                <button type="button" @click="closeModal" class="px-4 py-2 bg-red-600 rounded hover:bg-red-700 text-sm text-white">Cancel</button>
                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-cyan-950 text-white rounded hover:bg-blue-700 text-sm flex items-center justify-center min-w-[120px]"
                                    :disabled="isSubmitting"
                                >
                                    <svg v-if="isSubmitting" class="animate-spin h-4 w-4 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                    </svg>
                                    {{ isSubmitting ?  'Updating...' : 'Update'}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </Dialog>

            <!-- Table -->
            <EasyDataTable
                buttons-pagination
                :headers="tableHeaders"
                :items="userData"
                :rows-per-page="5"
                table-class-name="customize-table"
                show-index
            >
                <template #item-rooms="{ rooms }">
                    <div class="space-y-1">
                        <div v-for="(room, index) in rooms" :key="index" class="text-sm text-gray-700">
                            <strong>{{ room.name }}</strong>
                            <p class="flex justify-start items-center gap-1">R*{{ room.total_room }}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                </svg>
                                N*{{ room.total_night }}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                </svg>
                                {{ room.total_price }} {{ room.currency?.currency ?? '' }}
                            </p>
                        </div>
                    </div>
                </template>
                <template #item-total_price_bdt="item">
                    <div class="text-sm font-semibold text-green-700">
                        {{ getTotalPriceInBDT(item.rooms,item.rate.rate) }} BDT
                    </div>
                </template>
                <template #item-status_id="item">
                    <div class="text-sm font-semibold" :class="item.status_id ? 'text-green-700' : 'text-gray-500'">
                        {{ item.status_id || 'N/A' }}
                    </div>
                </template>
                <template #expand="item">
                    <div class="p-4 grid grid-cols-4 gap -2">
                        <div>
                            <p><strong>Oboe Sl:</strong> {{ item.obeo_sl }}</p>
                            <p><strong>Booking No:</strong> {{ item.reservation_no }}</p>
                            <p><strong>Check-in:</strong> {{ item.check_in }}</p>
                            <p><strong>Check-out:</strong> {{ item.check_out }}</p>
                            <p><strong>Reservation Date:</strong> {{ item.reservation_date }}</p>

                        </div>
                        <div>
                            <p><strong>Guest Name:</strong> {{ item.guest_name }}</p>
                            <p><strong>Hotel Name:</strong> {{ item.hotel?.hotelName }}</p>
                            <p><strong>Email:</strong> {{ item.email }}</p>
                            <p><strong>Phone:</strong> {{ item.phone }}</p>
                            <p><strong>Request:</strong> {{ item.request }}</p>
                            <p><strong>Comment:</strong> {{ item.comment }}</p>

                        </div>
                        <div>
                            <strong>Rooms ({{item.rooms.length}}):</strong>
                            <ul class="list-disc ml-5">
                                <li v-for="room in item.rooms" :key="room.id">
                                    <p class="font-semibold-semibold">{{ room.name }}</p>
                                    <p>
                                        {{ room.total_room }} room(s), {{ room.total_night }} night(s), {{ room.total_price }} {{ room.currency?.currency }}
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <p><strong>Total Adult:</strong> {{ item.total_adult }}</p>
                            <div v-if="item.children?.length">
                               <p> <strong>Children ({{item.children.length}}):</strong > (<span v-for="child in item.children" :key="child.id"> {{ child.age }}, </span>)</p>
                            </div>
                            <p><strong>Total Advance:</strong> {{ item.total_advance }}</p>
                            <p><strong>Exchange Rate:</strong> {{ item.rate?.rate }} {{ item.currency?.currency }}</p>
                            <p><strong>Payment Method:</strong>  {{ item.payment_method.payment }}</p>
                            <p><strong>Source:</strong> {{ item.source.source }}</p>
                        </div>

                    </div>
                </template>
                <template #item-actions="item">
                    <div class="flex gap-2">
                        <button @click="handleEdit(item)" class="bg-yellow-400 text-white px-2 py-1 rounded text-sm hover:bg-yellow-500">
                            Edit
                        </button>
                        <button @click="handleDelete(item.id)" class="bg-red-500 text-white px-2 py-1 rounded text-sm hover:bg-red-600">
                            Delete
                        </button>
                    </div>
                </template>
            </EasyDataTable>
        </div>
    </AdminLayout>
</template>

<style scoped>
::v-deep(.customize-table) {
    --easy-table-header-font-size: 16px;
    --easy-table-body-row-font-size: 14px;
    --easy-table-header-font-color: #111827;
    --easy-table-body-row-font-color: #374151;
    --easy-table-border: 1px solid #e5e7eb;
}
::v-deep(.customize-table thead th:nth-child(3)),
::v-deep(.customize-table tbody td:nth-child(3)) {
    max-width: 200px;
    word-wrap: break-word;
    word-break: break-word;
    white-space: normal;
}
</style>
