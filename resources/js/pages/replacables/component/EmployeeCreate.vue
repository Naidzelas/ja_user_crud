<script setup lang="ts">
import { router, usePage } from '@inertiajs/vue3';
import { Button, DatePicker, Dialog, InputGroup, InputGroupAddon, InputMask, Select } from 'primevue';
import { computed, reactive, ref, watch, inject } from 'vue';
import { useI18n } from 'vue-i18n';

const pageVariables = defineProps({
    toggle: Boolean,
});

const emit = defineEmits(['update:toggle']);
const { t } = useI18n();
const visible = ref(pageVariables.toggle);
const page = usePage();
const er = computed(() => page.props.errors);
let roles:any = inject('roles');

const form = reactive({
    first_name: null,
    last_name: null,
    role: null,
    phone: '',
    email: null,
    birth_date: null,
});

watch(
    () => pageVariables.toggle,
    (newVal) => {
        visible.value = newVal;
    },
);

watch(visible, (newVal) => {
    emit('update:toggle', newVal);
});

function createEmployee() {
    router.post(route('employee.store'), form, {
        onSuccess: () => {
            visible.value = false;
            router.visit(route('employee.index'));
        },
    });
}
</script>

<template>
    <form class="flex">
        <Dialog v-model:visible="visible" modal class="w-[40em]">
            <template #header>
                <div class="flex flex-col gap-4 mb-8">
                    <h2 class="font-bold text-2xl">{{ t('employee_register.new_employee') }}</h2>
                    <p class="text-gray-600">{{ t('employee_register.create_new_employee') }}</p>
                </div>
            </template>
            <div class="flex flex-col gap-4">
                <label for="first_name">{{ t('employee_register.first_name') }}</label>
                <input type="text" v-model="form.first_name" id="first_name" class="p-2 border border-gray-300 rounded" />
                <p v-if="er.first_name" class="-mt-3 font-bold text-red-600 text-sm">{{ er.first_name }}</p>

                <label for="last_name">{{ t('employee_register.last_name') }}</label>
                <input type="text" v-model="form.last_name" id="last_name" class="p-2 border border-gray-300 rounded" />
                <p v-if="er.last_name" class="-mt-3 font-bold text-red-600 text-sm">{{ er.last_name }}</p>

                <label for="role">{{ t('employee_register.role') }}</label>
                <Select id="role" v-model="form.role" :options="roles" optionLabel="name" :placeholder="t('employee_register.select_role')" class="w-full" />
                <p v-if="er.role" class="-mt-3 font-bold text-red-600 text-sm">{{ er.role }}</p>

                <label for="email">{{ t('employee_register.email') }}</label>
                <input type="email" v-model="form.email" id="email" class="p-2 border border-gray-300 rounded" />
                <p v-if="er.email" class="-mt-3 font-bold text-red-600 text-sm">{{ er.email }}</p>

                <label for="phone">{{ t('employee_register.phone') }}</label>
                <InputGroup id="phone">
                    <InputGroupAddon>+370</InputGroupAddon>
                    <InputMask v-model="form.phone" placeholder="000 00000" mask="999 99999" />
                </InputGroup>
                <p v-if="er.phone" class="-mt-3 font-bold text-red-600 text-sm">{{ er.phone }}</p>

                <label for="birth_date">{{ t('employee_register.birth_date') }}</label>
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
                <div class="flex justify-between mt-8">
                    <Button :label="t('general.save')" icon="pi pi-check" severity="contrast" @click="createEmployee" autofocus />
                    <Button :label="t('general.cancel')" icon="pi pi-times" outlined text severity="secondary" @click="visible = false" autofocus />
                </div>
            </template>
        </Dialog>
    </form>
</template>
