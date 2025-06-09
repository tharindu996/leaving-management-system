<template>
    <Head title="Leaves" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex-1 md:max-w-lg">
            <div class="mt-5 flex flex-col space-y-6">
                <HeadingSmall title="Leave form" />

                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-2">
                        <Label for="leave_date">Leaving date</Label>
                        <Input
                            id="leave_date"
                            type="date"
                            class="mt-1 block w-full cursor-pointer"
                            v-model="form.leave_date"
                            :min="todayFormatted"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.leave_date" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="price">Description</Label>
                        <textarea
                            class="w-full resize-y rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-700 focus:border-transparent focus:ring-2 focus:ring-blue-500 focus:outline-none dark:border-gray-600 dark:bg-[#262626] dark:text-gray-200"
                            rows="4"
                            placeholder="Description"
                            v-model="form.description"
                            required
                        ></textarea>
                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>

                    <div class="flex items-center gap-4">
                        <Button class="m-2 cursor-pointer bg-sky-500 text-sm hover:bg-sky-700" type="button" @click="updateProduct" v-if="isEditing"
                            >Edit</Button
                        >
                        <Button v-else class="m-2 cursor-pointer bg-sky-500 text-sm hover:bg-sky-700" :disabled="form.processing">Save</Button>

                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p v-show="form.recentlySuccessful" class="text-sm text-neutral-600">Saved.</p>
                        </Transition>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-5 p-5">
            <HeadingSmall class="mb-5" title="List of leave requests" />
            <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th>#</th>
                        <th>Leave date</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-center">
                    <tr class="*:py-3" v-for="(leave, index) in leaves" :key="index">
                        <td>{{ ++index }}</td>
                        <td>{{ leave.leave_date }}</td>
                        <td>{{ leave.description }}</td>
                        <td>
                            <div class="flex gap-2">
                                <div v-if="leave.status === 'pending'">
                                    <button
                                        :disabled="form.processing"
                                        v-if="leave.status === 'pending'"
                                        class="m-2 cursor-pointer rounded bg-sky-500 px-2 py-1 text-sm hover:bg-sky-700"
                                        @click="editProduct(leave)"
                                    >
                                        Edit
                                    </button>
                                    <button
                                        :disabled="form.processing"
                                        v-if="leave.status === 'pending'"
                                        class="m-2 cursor-pointer rounded bg-red-500 px-2 py-1 text-sm hover:bg-red-700"
                                        @click="deleteLeave(leave)"
                                    >
                                        Delete
                                    </button>
                                </div>

                                <span
                                    v-if="leave.status === 'approved'"
                                    class="m-2 inline-flex items-center rounded-md bg-sky-50 px-2 py-1 text-xs font-medium text-sky-700 ring-1 ring-sky-600/20 ring-inset"
                                    >Approved
                                </span>
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
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type SharedData, type User } from '@/types';
import { useForm, usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { toast } from 'vue3-toastify';

defineProps({
    leaves: Object,
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Leaves',
        href: '/employee/leaves',
    },
];

const page = usePage<SharedData>();
const user = page.props.auth.user as User;
let leaveId = ref('');
let isEditing = false;

const todayFormatted = ref('');

const getTodayFormatted = () => {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Month is 0-indexed
    const day = String(today.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
};

onMounted(() => {
    // Set the min date when the component is mounted
    todayFormatted.value = getTodayFormatted();
});

const form = useForm({
    leave_date: '',
    description: '',
});

const submit = () => {
    form.post(route('employee.leaves.store'), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success('Leave request submitted successfully');
            form.reset();
        },
        onError: () => {
            toast.error('Failed to submit leave request');
        },
    });
};

const deleteLeave = (leave: any) => {
    if (confirm('Are you sure you want to delete this leave request?')) {
        form.delete(route('employee.leaves.destroy', leave.id), {
            preserveScroll: true,
            onSuccess: () => {
                toast.success('Leave request deleted successfully');
            },
            onError: () => {
                toast.error('Failed to delete leave request');
            },
        });
    }
};

// This function is used to load the leave data into the form for editing
const editProduct = (leave: any) => {
    isEditing = true;
    form.leave_date = leave.leave_date;
    form.description = leave.description;
    leaveId.value = leave.id;  
};

//This function is used to update the leave request
const updateProduct = () => {
    form.put(route('employee.leaves.update', leaveId.value), {
        onSuccess: () => {
            form.reset();
            toast.success('Leaves updated', {
                autoClose: 1000,
            });
            isEditing = false;
        },
    });
};
</script>
