<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid, FileClock, Users } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import { type User } from '@/types';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const user = page.props.auth.user as User;

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: route('employee.dashboard'),
        icon: LayoutGrid,
    },
    {
        title: 'Leaves',
        href: route('employee.leaves.index'),
        icon: FileClock,
    },
];

const mainAdminNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Leaves',
        href: '/admin/leaves',
        icon: FileClock,
    },   
    {
        title: 'Users',
        href: '/admin/users',
        icon: Users,
    },   
];

const footerNavItems: NavItem[] = [
   
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="user.role === 'admin' ? route('admin.dashboard') : route('employee.dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>                    
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="user.role === 'admin' ? mainAdminNavItems : mainNavItems" />
        </SidebarContent>

        <SidebarFooter>          
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
