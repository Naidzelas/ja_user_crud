<script setup lang="ts">
import { FilterMatchMode, FilterOperator } from '@primevue/core/api';
import { Button } from 'primevue';
import { inject, ref } from 'vue';
import EmployeeCreate from './component/EmployeeCreate.vue';
const employees = inject('employees');
const visible = ref(false);

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    name: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
});
const products = ref(employees);
</script>

<template>
    <div class="justify-items-center gap-4 grid grid-col-3">
        <section class="col-span-3 mt-10 px-30 w-full">
            <Button label="New employee" @click="visible = true"></Button>
            <EmployeeCreate :toggle="visible" @update:toggle="visible = $event" />
            <!-- <DataTable
                :value="products.data"
                v-model:filters="filters"
                removableSort
                class="w-full"
                :globalFilterFields="['name', 'code', 'category', 'quantity']"
            >
                <template #header>
                    <div class="flex flex-wrap justify-between items-center gap-2">
                        <h4 class="m-0">Manage Employees</h4>
                        <InputText v-model="filters['global'].value" placeholder="Search..." />
                    </div>
                </template>
                <template #empty> No employees found. </template>
                <template #loading> Loading employee data. Please wait. </template>
                <Column field="name" header="Name" filterField="name" sortable style="width: 25%">
                    <template #body="{ data }">
                        <span class="font-bold">{{ data.name }}</span>
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
                    </template>
                </Column>
                <Column field="code" header="Code" filterField="code" sortable style="width: 25%">
                    <template #body="{ data }">
                        <span class="font-bold">{{ data.code }}</span>
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by code" />
                    </template>
                </Column>
                <Column field="category" header="Category" filterField="category" sortable style="width: 25%">
                    <template #body="{ data }">
                        <span class="font-bold">{{ data.category }}</span>
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by category" />
                    </template>
                </Column>
                <Column field="quantity" header="Quantity" filterField="quantity" sortable style="width: 25%">
                    <template #body="{ data }">
                        <span class="font-bold">{{ data.quantity }}</span>
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by quantity" />
                    </template>
                </Column>
            </DataTable> -->
        </section>
    </div>
</template>
