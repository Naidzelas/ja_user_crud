<script setup lang="ts">
import { FilterMatchMode, FilterOperator } from '@primevue/core/api';
import { Button, Column, DataTable, DatePicker, Dialog, InputGroup, InputGroupAddon, InputMask, InputText } from 'primevue';
import { ref } from 'vue';
const date = ref();
const visible = ref(false);
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    name: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
});
const products = ref({
    data: [
        {
            code: 'P1000',
            name: 'Product 1',
            category: 'Category 1',
            quantity: 10,
        },
        {
            code: 'P1001',
            name: 'Product 2',
            category: 'Category 2',
            quantity: 20,
        },
        {
            code: 'P1002',
            name: 'Product 3',
            category: 'Category 3',
            quantity: 30,
        },
    ],
});
</script>

<template>
    <div class="justify-items-center gap-4 grid grid-col-3">
        <section class="col-span-1 p-20">
            <div class="flex flex-col gap-4">
                <h2 class="font-bold text-2xl">Dashboard</h2>
                <p class="text-gray-600">Welcome to your dashboard. Here you can manage your products.</p>
            </div>
        </section>
        <section class="col-span-1 p-20">
            <div class="flex flex-col gap-4">
                <h2 class="font-bold text-2xl">Products</h2>
                <p class="text-gray-600">Manage your products here.</p>
            </div>
        </section>
        <section class="col-span-1 p-20">
            <div class="flex flex-col gap-4">
                <h2 class="font-bold text-2xl">Settings</h2>
                <p class="text-gray-600">Manage your settings here.</p>
            </div>
        </section>
        <section class="col-span-3 mt-10 px-30 w-full">
            <div class="flex">
                <Button label="New employee" @click="visible = true"></Button>
                <Dialog v-model:visible="visible" modal class="w-[40em]">
                    <template #header>
                        <div class="flex flex-col gap-4">
                            <h2 class="font-bold text-2xl">New employee</h2>
                            <p class="text-gray-600">Create a new employee.</p>
                        </div>
                    </template>
                    <div class="flex flex-col gap-4">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="p-2 border border-gray-300 rounded" />
                        <label for="email">Surname</label>
                        <input type="email" id="email" class="p-2 border border-gray-300 rounded" />
                        <label for="phone">Phone Number</label>
                        <InputGroup id="phone">
                            <InputGroupAddon>+370</InputGroupAddon>
                            <InputMask placeholder="000 00000" mask="999 99999" />
                        </InputGroup>
                        <label for="email">Email</label>
                        <input type="text" id="email" class="p-2 border border-gray-300 rounded" />
                        <label for="birthDate">Birth Date</label>
                        <DatePicker id="birthDate" v-model="date" class="w-full" showIcon dateFormat="yy-mm-dd" />
                    </div>
                    <template #footer>
                        <div class="flex justify-between">
                            <Button label="Save" severity="contrast" @click="visible = false" autofocus />
                            <Button label="Cancel" outlined text severity="secondary" @click="visible = false" autofocus />
                        </div>
                    </template>
                </Dialog>
            </div>
            <DataTable
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
            </DataTable>
        </section>
    </div>
</template>
