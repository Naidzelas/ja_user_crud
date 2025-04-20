<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import EmployeeRegister from './replacables/EmployeeRegister.vue';
import { provide } from 'vue';

const pageVariables = defineProps({
    employees: Object,
    roles: Object,
});

provide('employees', pageVariables.employees);
provide('roles', pageVariables.roles);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <EmployeeRegister />
    </AppLayout>
</template>
