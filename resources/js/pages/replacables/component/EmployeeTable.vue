<script setup lang="ts">
import { FilterMatchMode, FilterOperator } from '@primevue/core/api';
import { Column, DataTable, InputText, Button, useToast } from 'primevue';
import { inject, ref } from 'vue';
import EmployeeEdit from './EmployeeEdit.vue';
import Confirmation from './Confirmation.vue';
import { useI18n } from 'vue-i18n';

// Define props for the component
const employees:any = inject('employees');
const { t } = useI18n();
const editVisible = ref(false);
const confirmation = ref(false);
const selectedEmployee = ref(undefined);
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    name: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
});

// Methods
function editEmployee(employee: any): void {
    selectedEmployee.value = { ...employee }; 
    editVisible.value = true;
};

function terminateEmployee(employee: any): void {
    selectedEmployee.value = { ...employee }; 
    confirmation.value = true;
};

</script>

<template>
    <DataTable
        :value="employees"
        v-model:filters="filters"
        removableSort
        class="w-full"
        :globalFilterFields="['first_name', 'last_name', 'role', 'phone', 'email']"
        stripedRows
        paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]"
    >
        <template #header>
            <div class="flex flex-wrap justify-between items-center gap-2">
                <h4 class="m-0">{{ t('employee_register.manage_employees') }}</h4>
                <InputText v-model="filters['global'].value" :placeholder="t('general.search')" />
            </div>
        </template>

        <template #empty> {{ t('employee_register.no_empoyee_found') }} </template>

        <template #loading> {{ t('employee_register.loading_empoyee_data')}} </template>

        <Column field="first_name" :header="t('employee_register.first_name')" filterField="first_name" sortable class="w-[15%]">
            <template #body="{ data }">
                <span class="font-bold">{{ data.first_name }}</span>
            </template>
            <template #filter="{ filterModel }">
                <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
            </template>
        </Column>
        <Column field="last_name" :header="t('employee_register.last_name')" filterField="last_name" sortable class="w-[15%]">
            <template #body="{ data }">
                <span class="font-bold">{{ data.last_name }}</span>
            </template>
            <template #filter="{ filterModel }">
                <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
            </template>
        </Column>
        <Column field="role" :header="t('employee_register.role')" filterField="role" sortable class="w-[15%]">
            <template #body="{ data }">
                <span class="font-bold">{{ data.role }}</span>
            </template>
            <template #filter="{ filterModel }">
                <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
            </template>
        </Column>
        <Column field="phone" :header="t('employee_register.phone')" filterField="phone" sortable class="w-[15%]">
            <template #body="{ data }">
                <span class="font-bold">{{ '+370 ' + data.phone }}</span>
            </template>
            <template #filter="{ filterModel }">
                <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
            </template>
        </Column>
        <Column field="email" :header="t('employee_register.email')" filterField="email" sortable class="w-fit">
            <template #body="{ data }">
                <span class="font-bold">{{ data.email }}</span>
            </template>
            <template #filter="{ filterModel }">
                <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
            </template>
        </Column>
        <Column field="birth_date" :header="t('employee_register.birth_date')" filterField="birth_date" sortable class="w-[15%]">
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
                    <Button icon="pi pi-trash" severity="danger" outlined rounded class="mr-2" @click="terminateEmployee(data)" />
                </div>
            </template>
        </Column>
    </DataTable>
    <EmployeeEdit 
        :employee="selectedEmployee" 
        :edit="editVisible" 
        @update:edit="editVisible = $event" 
        @update:employee="selectedEmployee = $event" 
    />
    <Confirmation 
        :confirmation="confirmation" 
        :employee="selectedEmployee"
        @update:employee="selectedEmployee = $event"
        @update:confirmation="confirmation = $event" 
    />
</template>
