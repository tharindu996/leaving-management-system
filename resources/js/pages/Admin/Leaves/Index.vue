<template>
    <Head title="Leaves" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <h2>Leave requests</h2>        

        <div class="mt-5 p-5">
            <HeadingSmall class="mb-5" title="List of product" />
            <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th>#</th>
                        <th>Employee name</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-center">
                    <tr class="*:py-3" v-for="(leave, index) in leaves" :key="index">
                     
                        <td>{{ ++index }}</td>
                        <td>{{ leave.user.name }}</td>
                        <td>{{ leave.date }}</td>
                        <td>{{ leave.description }}</td>
                        <td>
                            <div class="flex gap-2">
                                <button
                                    v-if="!leave.is_approved" :disabled="form.processing"
                                    class="cursor-pointer rounded bg-sky-500 px-2 py-1 text-sm hover:bg-sky-700"
                                    @click="approveLeave(leave)"
                                >
                                    Approve
                                </button>                               
                                <span v-else
                                    class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-green-600/20 ring-inset"
                                    >Approved</span
                                >
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
<script setup lang="ts">
import HeadingSmall from '@/components/HeadingSmall.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type SharedData, type User } from '@/types';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { toast } from 'vue3-toastify';

defineProps({
    leaves: Object,
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'leaves',
        href: '/admin/leaves',
    },
];

const page = usePage<SharedData>();
const user = page.props.auth.user as User;

const form = useForm({
    date: '',
    description: '',
});

const approveLeave = (leave : object) => {
    form.patch(route('admin.leaves.approve-leave', leave), {
        onSuccess: () => {
            form.reset();
            toast.success('Leave request is updated', {
                autoClose: 1000,
            });
        },
    });   
};
</script>
