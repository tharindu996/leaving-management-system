<template>
    <Head title="Leaves" />

    <AdminLayout :breadcrumbs="breadcrumbs">
        <div class="mt-5 p-5">
            <HeadingSmall class="mb-5" title="List of leave requests" />
            <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th>#</th>
                        <th>Employee name</th>
                        <th>Leave date</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-center">
                    <tr class="*:py-3" v-for="(leave, index) in leaves" :key="index">
                        <td>{{ ++index }}</td>
                        <td>{{ leave.user.name }}</td>
                        <td>{{ leave.leave_date }}</td>
                        <td>{{ leave.description }}</td>
                        <td>
                            <div class="flex gap-2">
                                <div v-if="leave.status === 'pending'">
                                    <button
                                        :disabled="form.processing"
                                        class="cursor-pointer rounded bg-sky-500 px-2 py-1 text-sm hover:bg-sky-700 m-2"
                                        @click="approveLeave(leave)"
                                    >
                                        Approve
                                    </button>
                                    <button
                                        :disabled="form.processing"
                                        class="cursor-pointer rounded bg-red-500 px-2 py-1 text-sm hover:bg-red-700 m-2"
                                        @click="rejectLeave(leave)"
                                    >
                                        Reject
                                    </button>
                                </div>

                                <span v-if="leave.status === 'approved'"
                                    class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-green-600/20 ring-inset m-2"
                                    >Approved
                                </span>
                                <span v-if="leave.status === 'rejected'"
                                    class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-red-600/20 ring-inset m-2"
                                    >Rejected
                                </span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
<script setup lang="ts">
import HeadingSmall from '@/components/HeadingSmall.vue';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { type BreadcrumbItem, type SharedData, type User } from '@/types';
import { useForm, usePage } from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';

defineProps({
    leaves: Object,
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Leaves',
        href: '/admin/leaves',
    },
];

const page = usePage<SharedData>();
const user = page.props.auth.user as User;

const form = useForm({
    date: '',
    description: '',
});

const approveLeave = (leave: object) => {
    form.patch(route('admin.leaves.approve-leave', leave), {
        onSuccess: () => {
            form.reset();
            toast.success('Leave request is updated', {
                autoClose: 1000,
            });
        },
    });
};
const rejectLeave = (leave: object) => {
    form.patch(route('admin.leaves.reject-leave', leave), {
        onSuccess: () => {
            form.reset();
            toast.success('Leave request is updated', {
                autoClose: 1000,
            });
        },
    });
};
</script>
