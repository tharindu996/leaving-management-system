<template>
    <Head title="Leaves" />

    <AdminLayout :breadcrumbs="breadcrumbs">
        <div class="mt-5 p-5">
            <HeadingSmall class="mb-5" title="List of users" />
            <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Leave Requests</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-center">
                    <tr class="*:py-3" v-for="(user, index) in users" :key="index">
                        <td>{{ ++index }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.leaves_count }}</td>                        
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
    users: Object,
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: '/admin/users',
    },
];

const page = usePage<SharedData>();
const user = page.props.auth.user as User;

</script>
