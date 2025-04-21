<script setup lang="ts">
import { Button } from 'primevue';
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import EmployeeCreate from './component/EmployeeCreate.vue';
import EmployeeTable from './component/EmployeeTable.vue';
import Statistics from './component/Statistics.vue';
import CardEmployeeTotalExample from './component/CardEmployeeTotalExample.vue';
const { t } = useI18n();

const visible = ref(false);
</script>

<template>
    <div class="justify-items-center gap-4 grid grid-col-3 mt-30">
        <section class="col-span-3 mt-4 px-30 w-full">
            <div class="flex gap-x-6">
                <div class=flex-1>
                    <CardEmployeeTotalExample />
                </div>
                <div class="flex-2">
                    <Statistics />
                </div>
            </div>
        </section>
        <section class="col-span-3 mt-10 px-30 w-full">
            <Button :label="t('employee_register.new_employee')" severity="contrast" @click="visible = true"></Button>
            <EmployeeCreate :toggle="visible" @update:toggle="visible = $event" />
            <EmployeeTable />
        </section>
    </div>
</template>
