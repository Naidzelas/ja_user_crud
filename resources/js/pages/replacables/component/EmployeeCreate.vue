<template>
    <form class="flex">
        <Dialog v-model:visible="visible" modal class="w-[40em]">
            <template #header>
                <div class="flex flex-col gap-4">
                    <h2 class="font-bold text-2xl">New employee</h2>
                    <p class="text-gray-600">Create a new employee.</p>
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
                    <InputMask v-model="form.phone" placeholder="000 00000" mask="999 99999"  />
                </InputGroup>
                <p v-if="er.phone" class="-mt-3 font-bold text-red-600 text-sm">{{ er.phone }}</p>

                <label for="birth_date">Birth Date</label>
                <DatePicker id="birth_date" v-model="form.birth_date" class="w-full" showIcon dateFormat="yy-mm-dd" :utc="true" :manualInput="false" />
                <p v-if="er.birth_date" class="-mt-3 font-bold text-red-600 text-sm">{{ er.birth_date }}</p>

            </div>
            <template #footer>
                <div class="flex justify-between">
                    <Button label="Save" severity="contrast" @click="createEmployee" autofocus />
                    <Button label="Cancel" outlined text severity="secondary" @click="visible = false" autofocus />
                </div>
            </template>
        </Dialog>
    </form>
</template>

<script setup lang="ts">
import { Button, DatePicker, Dialog, InputGroup, InputGroupAddon, InputMask } from 'primevue';
import { reactive, watch, ref, computed } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

const pageVariables = defineProps({
    toggle: Boolean,
});

const emit = defineEmits(['update:toggle']);
const visible = ref(pageVariables.toggle);
const page = usePage();
const er = computed(() => page.props.errors);

const form = reactive({
    first_name: null,
    last_name: null,
    phone: '',
    email: null,
    birth_date: null,
});

watch(() => pageVariables.toggle, (newVal) => {
    visible.value = newVal;
});

watch(visible, (newVal) => {
    emit('update:toggle', newVal);
});

function createEmployee() {
    router.post(route('employee.store'), form, {
        onSuccess: () => {
            visible.value = false;
        },
    });
}
</script>
