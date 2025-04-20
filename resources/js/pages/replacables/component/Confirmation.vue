<script setup lang="ts">
import { Button, Dialog } from 'primevue';
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import { useI18n } from 'vue-i18n';

// Define props for the component
const { t } = useI18n();
const emit = defineEmits(['update:confirmation', 'update:employee']);
const pageVariables = defineProps({
    confirmation: Boolean,
    employee: Object,
});
const confirmation = ref(pageVariables.confirmation);
const terminatedEmployee = ref(pageVariables.employee);

// Methods
watch(() => pageVariables.confirmation, (newVal) => {
    confirmation.value = newVal;
});

watch(confirmation, (newVal) => {
    emit('update:confirmation', newVal);
});
watch(
    () => pageVariables.employee,
    (newVal) => {
        terminatedEmployee.value = newVal;
    },
    { immediate: true }
);

function terminateEmployee() {
    router.delete(route('employee.destroy', terminatedEmployee.value?.id), {
        onSuccess: () => {
            confirmation.value = false;
            router.visit(route('employee.index'));
        },
    });
}

</script>

<template>
    <Dialog v-model:visible="confirmation" header="Confirmation" modal class="w-[40em]">
        <template #header>
            <div class="flex flex-col gap-4 mb-8">
                <h2 class="font-bold text-2xl">{{t('general.confirm')}}</h2>
                <p class="text-gray-600">{{t('employee_register.terminate_question')}} {{ terminatedEmployee?.first_name }} {{ terminatedEmployee?.last_name }} {{t('employee_register.employment').toLowerCase()}}?</p>
            </div>
        </template>
        <div class="flex justify-end gap-4">
            <Button icon="pi pi-times" :label="t('general.cancel')" @click="confirmation = false" class="p-button-secondary" />
            <Button icon="pi pi-exclamation-triangle" :label="t('employee_register.terminate')" @click="terminateEmployee" class="p-button-danger" />
        </div>
    </Dialog>
</template>