<script setup lang="ts">
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import AppLayout from '../../layouts/AppLayout.vue';

defineProps({
    employeesCount: Number,
    approvedLeavesCount: Number,
    rejectedLeavesCount: Number,
    pendingLeavesCount: Number,
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="aspect-video rounded-lg border-1">
                    <div class="flex h-full flex-col items-center justify-center p-4">
                        <div class="box-value text-4xl font-bold">{{ employeesCount }}</div>
                        <div class="box-title text-md mt-3">Employees count</div>
                    </div>
                </div>
                <div class="aspect-video rounded-lg border-1">
                    <div class="flex h-full flex-col items-center justify-center p-4">
                        <div class="box-value text-4xl font-bold">{{ approvedLeavesCount }}</div>
                        <div class="box-title text-md mt-3">Approved leaves</div>
                    </div>
                </div>
                <div class="aspect-video rounded-lg border-1">
                    <div class="flex h-full flex-col items-center justify-center p-4">
                        <div class="box-value text-4xl font-bold">{{ rejectedLeavesCount }}</div>
                        <div class="box-title text-md mt-3">Rejected leaves</div>
                    </div>
                </div>
                <div class="aspect-video rounded-lg border-1">
                    <div class="flex h-full flex-col items-center justify-center p-4">
                        <div class="box-value text-4xl font-bold">{{ pendingLeavesCount }}</div>
                        <div class="box-title text-md mt-3">Pending leaves</div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
