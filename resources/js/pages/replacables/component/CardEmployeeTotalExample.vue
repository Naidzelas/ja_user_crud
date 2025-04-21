<script setup lang="ts">
import { Card } from 'primevue';
import { useI18n } from 'vue-i18n';
const { t } = useI18n();
</script>
<template>
    <Card class="shadow-xl w-full h-full">
        <template #header>
            <h4 class="mt-5 ml-5">{{ t('employee_register.number_example') }}</h4>
        </template>
        <template #content>
            <div class="text-center">
                <h4 class="mb-4 font-bold text-2xl">{{ t('employee_register.total_employees_current') }}</h4>
                <div class="flex flex-col justify-center items-center mt-10 h-full">
                    <div class="font-bold text-[6em]">150</div>
                    <span class="-mt-6 text-gray-500 text-sm"> {{ t('employee_register.employees') }}</span>
                </div>
            </div>
        </template>
    </Card>
</template>
