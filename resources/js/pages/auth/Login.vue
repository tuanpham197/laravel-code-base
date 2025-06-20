<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthSplitLayout from '@/layouts/auth/AuthSplitLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import type { AuthPageProps, LoginFormData } from '@/types/auth';

const props = defineProps<AuthPageProps>();

const form = useForm<LoginFormData>({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('auth.login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AuthSplitLayout>
        <template #header>
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                Đăng nhập
            </h2>
        </template>

        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-6">
            <div>
                <Label for="email">Email</Label>
                <div class="mt-2">
                    <Input
                        id="email"
                        v-model="form.email"
                        type="email"
                        name="email"
                        required
                    />
                    <InputError :message="errors.email" class="mt-2" />
                </div>
            </div>

            <div>
                <Label for="password">Mật khẩu</Label>
                <div class="mt-2">
                    <Input
                        id="password"
                        v-model="form.password"
                        type="password"
                        name="password"
                        required
                    />
                    <InputError :message="errors.password" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <Checkbox
                        id="remember"
                        v-model:checked="form.remember"
                        name="remember"
                    />
                    <Label for="remember" class="ml-3 block text-sm leading-6">
                        Ghi nhớ đăng nhập
                    </Label>
                </div>

                <div class="text-sm leading-6">
                    <TextLink 
                        v-if="canResetPassword"
                        :href="route('password.request')"
                    >
                        Quên mật khẩu?
                    </TextLink>
                </div>
            </div>

            <div>
                <Button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Đăng nhập
                </Button>
            </div>

            <div class="flex items-center justify-between">
                <div class="text-sm leading-6">
                    <TextLink :href="route('register')">
                        Chưa có tài khoản? Đăng ký
                    </TextLink>
                </div>
            </div>
        </form>
    </AuthSplitLayout>
</template>
