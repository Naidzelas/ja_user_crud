import { createI18n } from 'vue-i18n';
import en from '../../lang/en.json';
import lt from '../../lang/lt.json';

// Explicitly declare or import JSON modules
import type { default as EnMessages } from '../../lang/en.json';
import type { default as LtMessages } from '../../lang/lt.json';

export const i18n = createI18n({
    legacy: false, // Use Composition API mode
    locale: localStorage.getItem('locale') || 'en', // Default locale
    fallbackLocale: 'en', // Fallback locale
    messages: {
        en: en as typeof EnMessages,
        lt: lt as typeof LtMessages,
    },
});