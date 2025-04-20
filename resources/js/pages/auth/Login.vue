<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { useI18n } from 'vue-i18n';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const { t } = useI18n();

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AuthBase :title="t('login.login_header')" :description="t('login.login_subheader')">
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-green-600 text-sm text-center">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="gap-6 grid">
                <div class="gap-2 grid">
                    <Label for="email">{{ t('login.email_address') }}</Label>
                    <Input
                        id="email"
                        type="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        v-model="form.email"
                        placeholder="email@example.com"
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="gap-2 grid">
                    <div class="flex justify-between items-center">
                        <Label for="password">{{ t('login.password') }}</Label>
                        <TextLink v-if="canResetPassword" :href="route('password.request')" class="text-sm" :tabindex="5">
                            {{ t('login.forgot_password') }}
                        </TextLink>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        v-model="form.password"
                        :placeholder="t('login.password')"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="flex justify-between items-center" :tabindex="3">
                    <Label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" v-model="form.remember" :tabindex="4" />
                        <span>{{ t('login.remember_me') }}</span>
                    </Label>
                </div>

                <Button type="submit" class="mt-4 w-full" :tabindex="4" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="w-4 h-4 animate-spin" />
                    {{ t('login.login') }}
                </Button>
            </div>

            <div class="text-muted-foreground text-sm text-center">
                {{ t('login.dont_have_account') }}
                <TextLink :href="route('register')" :tabindex="5">{{t('login.sign_up')}}</TextLink>
            </div>
        </form>
    </AuthBase>
</template>
