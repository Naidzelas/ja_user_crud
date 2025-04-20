<script setup lang="ts">
import { Button } from 'primevue';
import { ref } from 'vue';
import EmployeeCreate from './component/EmployeeCreate.vue';
import EmployeeTable from './component/EmployeeTable.vue';

const visible = ref(false);
</script>

<template>
    <div class="justify-items-center gap-4 grid grid-col-3 mt-30">
        <section class="col-span-3 mt-10 px-30 w-full">
            <Button label="New employee" severity="contrast" @click="visible = true"></Button>
            <EmployeeCreate :toggle="visible" @update:toggle="visible = $event" />
            <EmployeeTable />
        </section>
    </div>
</template>
