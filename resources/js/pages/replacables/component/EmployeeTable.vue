<script setup lang="ts">
import { FilterMatchMode, FilterOperator } from '@primevue/core/api';
import { Column, DataTable, InputText, Button } from 'primevue';
import { inject, ref } from 'vue';
import EmployeeEdit from './EmployeeEdit.vue';

const employees:any = inject('employees');
const editVisible = ref(false);
const selectedEmployee = ref(undefined);
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    name: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
});

function editEmployee(employee: any): void {
    selectedEmployee.value = { ...employee }; 
    editVisible.value = true;
};
</script>

<template>
    {{ employees }}
    <DataTable
        :value="employees"
        v-model:filters="filters"
        removableSort
        class="w-full"
        :globalFilterFields="['first_name', 'last_name', 'role', 'phone', 'email']"
    >
        <template #header>
            <div class="flex flex-wrap justify-between items-center gap-2">
                <h4 class="m-0">Manage Employees</h4>
                <InputText v-model="filters['global'].value" placeholder="Search..." />
            </div>
        </template>

        <template #empty> No employees found. </template>

        <template #loading> Loading employee data. Please wait. </template>

        <Column field="first_name" header="First Name" filterField="first_name" sortable class="w-[15%]">
            <template #body="{ data }">
                <span class="font-bold">{{ data.first_name }}</span>
            </template>
            <template #filter="{ filterModel }">
                <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
            </template>
        </Column>
        <Column field="last_name" header="Last Name" filterField="last_name" sortable class="w-[15%]">
            <template #body="{ data }">
                <span class="font-bold">{{ data.last_name }}</span>
            </template>
            <template #filter="{ filterModel }">
                <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
            </template>
        </Column>
        <Column field="role" header="Role" filterField="role" sortable class="w-[15%]">
            <template #body="{ data }">
                <span class="font-bold">{{ data.role }}</span>
            </template>
            <template #filter="{ filterModel }">
                <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
            </template>
        </Column>
        <Column field="phone" header="Phone" filterField="phone" sortable class="w-[15%]">
            <template #body="{ data }">
                <span class="font-bold">{{ data.phone }}</span>
            </template>
            <template #filter="{ filterModel }">
                <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
            </template>
        </Column>
        <Column field="email" header="Email" filterField="email" sortable class="w-fit">
            <template #body="{ data }">
                <span class="font-bold">{{ data.email }}</span>
            </template>
            <template #filter="{ filterModel }">
                <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
            </template>
        </Column>
        <Column field="birth_date" header="Birth Date" filterField="birth_date" sortable class="w-[15%]">
            <template #body="{ data }">
                <span class="font-bold">{{ data.birth_date }}</span>
            </template>
            <template #filter="{ filterModel }">
                <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
            </template>
        </Column>
        <Column  header="" class="w-fit">
            <template #body="{ data }">
                <div class="flex gap-2">
                    <Button icon="pi pi-pencil" outlined rounded class="mr-2" @click="editEmployee(data)" />
                </div>
            </template>
        </Column>
    </DataTable>
    <EmployeeEdit :employee="selectedEmployee" :edit="editVisible" @update:edit="editVisible = $event" />
</template>
