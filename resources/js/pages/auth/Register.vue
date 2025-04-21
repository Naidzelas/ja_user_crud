<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthBase :title="t('login.sign_up')" :description="t('login.login_subheader')">
        <Head :title="t('login.sign_up')" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="gap-6 grid">
                <div class="gap-2 grid">
                    <Label for="name">{{ t('login.username') }}</Label>
                    <Input id="name" type="text" required autofocus :tabindex="1" autocomplete="name" v-model="form.name" :placeholder="t('login.username')" />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="gap-2 grid">
                    <Label for="email">{{ t('login.email_address') }}</Label>
                    <Input id="email" type="email" required :tabindex="2" autocomplete="email" v-model="form.email" :placeholder="t('login.email_address')" />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="gap-2 grid">
                    <Label for="password">{{ t('login.password') }}</Label>
                    <Input
                        id="password"
                        type="password"
                        required
                        :tabindex="3"
                        autocomplete="new-password"
                        v-model="form.password"
                        :placeholder="t('login.password')"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="gap-2 grid">
                    <Label for="password_confirmation">{{ t('login.password') }} {{ t('login.confirm') }}</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        required
                        :tabindex="4"
                        autocomplete="new-password"
                        v-model="form.password_confirmation"
                        :placeholder="t('login.password') + ' ' + t('login.confirm')"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="w-4 h-4 animate-spin" />
                    {{ t('login.sign_up') }}
                </Button>
            </div>

            <div class="text-muted-foreground text-sm text-center">
                {{ t('login.dont_have_account') }}
                <TextLink :href="route('login')" class="underline underline-offset-4" :tabindex="6">{{ t('login.login') }}</TextLink>
            </div>
        </form>
    </AuthBase>
</template>
