<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { router, useForm, usePage,Link } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { ref } from "vue";
import { Dialog, DialogOverlay, DialogTitle } from "@headlessui/vue";
// State
const userData = ref(usePage().props.rates);
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
    rate: '',
});
// Refresh User List
const fetchUsers = () => {
    router.reload({
        only: ['rates'],
        onSuccess: () => {
            userData.value = usePage().props.rates;
        }
    });
};

// Add or Update User
const handleSubmit = () => {
    isSubmitting.value = true;
    if (isEditMode.value) {
        data.put(`/dashboard/settings/update-rate/${editingUserId}`, {
            onSuccess: () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Exchange Rate updated successfully',
                    showConfirmButton: false,
                    timer: 1000
                });
                closeModal();
                fetchUsers();
            },
            onFinish: () => isSubmitting.value = false
        });
    } else {
        data.post('/dashboard/settings/add-rate', {
            onSuccess: () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Exchange Rate added successfully',
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
const handleEdit = (id,rate) => {
    editingUserId = id;
    isEditMode.value = true;
    data.rate = rate;
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
        text: "This Exchange Rate will be deleted permanently!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            router.get(`/dashboard/settings/delete-rate/${id}`)
            Toast.fire({
                icon: "warning",
                title: "Exchange Rate Deleted successfully"
            });
        }
    });
};

// Table Headers
const tableHeaders = [
    { text: 'Exchange Rate', value: 'rate' },
    { text: 'Actions', value: 'actions' },
];
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                    </svg>

                    Add Exchange Rate
                </button>
            </div>

            <!-- Modal -->
            <Dialog :open="isModalOpen" @close="closeModal" class="fixed z-50 inset-0 overflow-y-auto" aria-hidden="false">
                <div class="flex items-center justify-center min-h-screen p-4 text-center">
                    <DialogOverlay class="fixed inset-0 bg-black opacity-30" />
                    <div class="relative bg-white w-full max-w-lg p-6 rounded-xl shadow-xl z-50">
                        <DialogTitle class="text-xl font-semibold mb-4">
                            {{ isEditMode ? 'Edit Exchange Rate' : 'Add Exchange Rate' }}
                        </DialogTitle>

                        <form @submit.prevent="handleSubmit" class="space-y-3">
                            <div>
                                <label for="rate" class="block text-sm font-medium">Exchange Rate</label>
                                <input v-model="data.rate" type="text" class="w-full border p-2 rounded" />
                                <div v-if="data.errors.rate" class="text-red-500 text-sm">{{ data.errors.rate }}</div>
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
                                    {{ isSubmitting ? (isEditMode ? 'Updating...' : 'Submitting...') : (isEditMode ? 'Update' : 'Submit ') }}
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
                <template #item-actions="{ id,rate}">
                    <div class="flex gap-2">
                        <button @click="handleEdit(id,rate)" class="bg-yellow-400 text-white px-2 py-1 rounded text-sm hover:bg-yellow-500">
                            Edit
                        </button>
                        <button @click="handleDelete(id)" class="bg-red-500 text-white px-2 py-1 rounded text-sm hover:bg-red-600">
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
