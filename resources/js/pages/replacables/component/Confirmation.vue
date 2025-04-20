<script setup lang="ts">
import { Button, Dialog } from 'primevue';
import { computed, reactive, ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';

// Define props for the component
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
                <h2 class="font-bold text-2xl">Confirmation</h2>
                <p class="text-gray-600">Are you sure you want to terminate {{ terminatedEmployee?.first_name }} {{ terminatedEmployee?.last_name }} employment?</p>
            </div>
        </template>
        <div class="flex justify-end gap-4">
            <Button icon="pi pi-times" label="Cancel" @click="confirmation = false" class="p-button-secondary" />
            <Button icon="pi pi-exclamation-triangle" label="Terminate" @click="terminateEmployee" class="p-button-danger" />
        </div>
    </Dialog>
</template>