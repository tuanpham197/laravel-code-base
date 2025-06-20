<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { watch, onMounted } from 'vue';
import AuthSplitLayout from '@/layouts/auth/AuthSplitLayout.vue';
import type { AuthPageProps, RegisterFormData } from '@/types/auth';

const props = defineProps<AuthPageProps>();

const form = useForm<RegisterFormData>({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    
    form.post(route('postregister'), {
        preserveScroll: true,
        onFinish: () => {
            form.reset(('password' as keyof typeof form.data), ('password_confirmation' as keyof typeof form.data));
        },
    });
};
</script>

<template>
    <AuthSplitLayout>
        <template #header>
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                Đăng ký tài khoản
            </h2>
        </template>

        <form @submit.prevent="submit" class="space-y-6">
            <div>
                <Label for="name">Họ và tên</Label>
                <div class="mt-2">
                    <Input
                        id="name"
                        v-model="form.name"
                        type="text"
                        name="name"
                        required
                    />
                    <InputError :message="errors.name" class="mt-2" />
                </div>
            </div>

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

            <div>
                <Label for="password_confirmation">Xác nhận mật khẩu</Label>
                <div class="mt-2">
                    <Input
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                    />
                </div>
            </div>

            <div>
                <Button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Đăng ký
                </Button>
            </div>

            <div class="flex items-center justify-between">
                <div class="text-sm leading-6">
                    <TextLink :href="route('login')">
                        Đã có tài khoản? Đăng nhập
                    </TextLink>
                </div>
            </div>
        </form>
    </AuthSplitLayout>
</template>
