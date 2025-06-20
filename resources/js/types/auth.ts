import { FormDataConvertible } from '@inertiajs/core'

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
    created_at: string;
    updated_at: string;
}

export interface AuthErrors {
    name?: string;
    email?: string;
    password?: string;
    error?: string;
}

export interface RegisterFormData {
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
    [key: string]: FormDataConvertible;
}

export interface LoginFormData {
    email: string;
    password: string;
    remember: boolean;
    [key: string]: FormDataConvertible;
}

export interface AuthPageProps {
    auth: {
        user: User | null;
    };
    errors: AuthErrors;
    flash?: {
        message?: string;
    };
    status?: string;
    canResetPassword?: boolean;
}

export interface ValidationErrors {
    [key: string]: string[];
} 