<script setup lang="ts">
import { useI18n } from 'vue-i18n';
import { i18n } from '@/i18n';

interface Props {
    class?: string;
}

const { class: containerClass = '' } = defineProps<Props>();

const { locale } = useI18n();

const updateLanguage = (lang: 'en' | 'lt') => {
    i18n.global.locale.value = lang;
    localStorage.setItem('locale', lang);
};

const tabs = [
    { value: 'lt', label: 'LT' },
    { value: 'en', label: 'EN' },
] as const;
</script>

<template>
    <div :class="['inline-flex gap-1 rounded-lg bg-neutral-100 p-1 dark:bg-neutral-800', containerClass]">
        <button
            v-for="{ value, label } in tabs"
            :key="value"
            @click="updateLanguage(value)"
            :class="[ 
                'flex items-center rounded-md px-3.5 py-1.5 transition-colors',
                locale === value
                    ? 'bg-white shadow-xs dark:bg-neutral-700 dark:text-neutral-100'
                    : 'text-neutral-500 hover:bg-neutral-200/60 hover:text-black dark:text-neutral-400 dark:hover:bg-neutral-700/60',
            ]"
        >
            <span class="text-sm">{{ label }}</span>
        </button>
    </div>
</template>