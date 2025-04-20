<script setup lang="ts">
import { router, usePage } from '@inertiajs/vue3';
import { rand } from '@vueuse/core';
import { Button, DatePicker, Dialog, Image, InputGroup, InputGroupAddon, InputMask } from 'primevue';
import { computed, reactive, ref, watch } from 'vue';

const pageVariables = defineProps({
    edit: Boolean,
    employee: Object,
});

const emit = defineEmits(['update:edit', 'update:employee']);
const editVisible = ref(pageVariables.edit);
const page = usePage();
const er = computed(() => page.props.errors);

let form = reactive({
    first_name: pageVariables.employee?.first_name,
    last_name: pageVariables.employee?.last_name,
    phone: pageVariables.employee?.phone,
    email: pageVariables.employee?.email,
    birth_date: pageVariables.employee?.birth_date,
});

watch(
    () => pageVariables.edit,
    (newVal) => {
        editVisible.value = newVal;
    },
);

watch(
    () => pageVariables.employee,
    (newVal) => {
        Object.assign(form, newVal);
    },
    { immediate: true },
);

watch(
    form,
    (newVal) => {
        emit('update:employee', newVal);
    },
    { deep: true },
);

watch(editVisible, (newVal) => {
    emit('update:edit', newVal);
});

function createEmployee() {
    router.patch(route('employee.update', pageVariables.employee?.id), form, {
        onSuccess: () => {
            editVisible.value = false;
            router.visit(route('employee.index'));
        },
    });
}
</script>

<!-- TODO fix profile image preview mask to rounded -->
<template>
    <form class="flex">
        <Dialog v-model:visible="editVisible" modal class="w-[40em]">
            <template #header>
                <div class="flex flex-col gap-4">
                    <div class="flex">
                        <Image
                            src="/images/random_person.png"
                            alt="Employee Image"
                            class="mr-4 rounded-full"
                            preview
                        >
                            <template #previewicon>
                                <i class="rounded-full pi pi-eye"></i>
                            </template>
                            <template #image>
                                <img src="/images/random_person.png" alt="Employee Image" class="rounded-full w-12 h-12" />
                            </template>
                        </Image>
                        <h2 class="font-bold text-3xl">{{ employee?.first_name }} {{ employee?.last_name }}</h2>
                    </div>
                    <p class="text-gray-600">Update employee information.</p>
                </div>
            </template>
            <div class="flex flex-col gap-4">
                <label for="first_name">First name</label>
                <input type="text" v-model="form.first_name" id="first_name" class="p-2 border border-gray-300 rounded" />
                <p v-if="er.first_name" class="-mt-3 font-bold text-red-600 text-sm">{{ er.first_name }}</p>

                <label for="last_name">Last name</label>
                <input type="text" v-model="form.last_name" id="last_name" class="p-2 border border-gray-300 rounded" />
                <p v-if="er.last_name" class="-mt-3 font-bold text-red-600 text-sm">{{ er.last_name }}</p>

                <label for="email">Email</label>
                <input type="email" v-model="form.email" id="email" class="p-2 border border-gray-300 rounded" />
                <p v-if="er.email" class="-mt-3 font-bold text-red-600 text-sm">{{ er.email }}</p>

                <label for="phone">Phone Number</label>
                <InputGroup id="phone">
                    <InputGroupAddon>+370</InputGroupAddon>
                    <InputMask v-model="form.phone" placeholder="000 00000" mask="999 99999" />
                </InputGroup>
                <p v-if="er.phone" class="-mt-3 font-bold text-red-600 text-sm">{{ er.phone }}</p>

                <label for="birth_date">Birth Date</label>
                <DatePicker
                    id="birth_date"
                    v-model="form.birth_date"
                    class="w-full"
                    showIcon
                    dateFormat="yy-mm-dd"
                    :utc="true"
                    :manualInput="false"
                />
                <p v-if="er.birth_date" class="-mt-3 font-bold text-red-600 text-sm">{{ er.birth_date }}</p>
            </div>
            <template #footer>
                <div class="flex justify-between">
                    <Button label="Save" severity="contrast" @click="createEmployee" autofocus />
                    <Button label="Cancel" outlined text severity="secondary" @click="editVisible = false" autofocus />
                </div>
            </template>
        </Dialog>
    </form>
</template>
