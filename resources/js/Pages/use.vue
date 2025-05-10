<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {router, useForm, usePage} from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { ref } from "vue";
import { Dialog, DialogOverlay, DialogTitle } from "@headlessui/vue";

const userData = ref(usePage().props.users);


const isModalOpen = ref(false);

const data = useForm({
    fullName: '',
    userName: '',
    phone: '',
    email: '',
    role: '',
    password: '',
});

const openModal = () => {
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
    data.reset();
};
const fetchUsers = () => {
    router.reload({
        only: ['users'],
        onSuccess: () => {
            userData.value = usePage().props.users;
        }
    });
};


const handleAddUser = () => {
    data.post('/dashboard/users', {
        onSuccess: () => {
            Swal.fire({
                title: "User Added Successfully",
                icon: "success"
            });

            data.reset();
            closeModal();
            fetchUsers();

        }
    });
};

const tableHeaders = [
    { text: 'Full Name', value: 'fullName' },
    { text: 'ID', value: 'id' },
    { text: 'User Name', value: 'userName' },
    { text: 'Phone', value: 'phone' },
    { text: 'Email', value: 'email' },
    { text: 'Role', value: 'role' },
    { text: "Operation", value: "operation"},
];

const handleEdit = (row) => {

    console.log(row)
    openModal();
};


const handleDelete = (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be undone.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(`/dashboard/users/${id}`, {
                onSuccess: () => {
                    Swal.fire("Deleted!", "The user has been deleted.", "success");
                    fetchUsers();
                },
            });
        }
    });
};

</script>

<template>
    <AdminLayout>
        <div>
            <!-- Trigger Button -->
            <button @click="openModal"
                    class="mb-4 text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg px-4 py-2">
                Add User
            </button>

            <!-- Modal -->
            <Dialog :open="isModalOpen" @close="closeModal" class="fixed z-50 inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen p-4 text-center">
                    <DialogOverlay class="fixed inset-0 bg-black opacity-30" />

                    <div class="relative bg-white w-full max-w-lg p-6 rounded-xl shadow-xl z-50">
                        <DialogTitle class="text-xl font-semibold mb-4">Add New User</DialogTitle>

                        <form @submit.prevent="handleAddUser" class="space-y-3">
                            <div>
                                <label for="fullName" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input v-model="data.fullName" id="fullName" type="text"
                                       class="w-full rounded-lg border-gray-300 p-2 text-sm" />
                                <div v-if="data.errors.fullName" class="text-red-500 text-sm mt-1">{{ data.errors.fullName }}</div>
                            </div>

                            <div>
                                <label for="userName" class="block text-sm font-medium text-gray-700">User Name</label>
                                <input v-model="data.userName" id="userName" type="text"
                                       class="w-full rounded-lg border-gray-300 p-2 text-sm" />
                                <div v-if="data.errors.userName" class="text-red-500 text-sm mt-1">{{ data.errors.userName }}</div>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input v-model="data.phone" id="phone" type="text"
                                       class="w-full rounded-lg border-gray-300 p-2 text-sm" />
                                <div v-if="data.errors.phone" class="text-red-500 text-sm mt-1">{{ data.errors.phone }}</div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input v-model="data.email" id="email" type="email"
                                       class="w-full rounded-lg border-gray-300 p-2 text-sm" />
                                <div v-if="data.errors.email" class="text-red-500 text-sm mt-1">{{ data.errors.email }}</div>
                            </div>

                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                <select v-model="data.role" id="role"
                                        class="w-full rounded-lg border-gray-300 p-2 text-sm">
                                    <option disabled value="">Select Role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Moderator">Moderator</option>
                                </select>
                                <div v-if="data.errors.role" class="text-red-500 text-sm mt-1">{{ data.errors.role }}</div>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input v-model="data.password" id="password" type="password"
                                       class="w-full rounded-lg border-gray-300 p-2 text-sm" />
                                <div v-if="data.errors.password" class="text-red-500 text-sm mt-1">{{ data.errors.password }}</div>
                            </div>
                            <div class="flex justify-end mt-4 space-x-2">
                                <button type="button" @click="closeModal"
                                        class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-sm">Cancel</button>
                                <button type="submit"
                                        class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </Dialog>

            <!-- Data Table -->
            <div class="rounded-xl ">
                <EasyDataTable
                    buttons-pagination
                    :headers="tableHeaders"
                    :items="userData"
                    :rows-per-page="5"
                    table-class-name="customize-table"
                    show-index
                >


                </EasyDataTable>

            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>
::v-deep(.customize-table) {
    --easy-table-header-font-size: 16px;
    --easy-table-body-row-font-size: 16px;
    --easy-table-header-font-color: #111827;
    --easy-table-body-row-font-color: #374151;
    --easy-table-border: 1px solid #e5e7eb;
}
</style>
