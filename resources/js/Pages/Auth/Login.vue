<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Iniciar Sesión - Cotecmar" />

    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white mb-2">Sistema de Minucia</h1>
                <h2 class="text-xl text-blue-200 mb-8">Cotecmar - Control Naval</h2>
                <div class="w-24 h-24 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl flex items-center justify-center mx-auto mb-8">
                    <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white/10 backdrop-blur-md border border-white/20 py-8 px-6 shadow-2xl sm:rounded-2xl sm:px-10">
                <div v-if="status" class="mb-4 font-medium text-sm text-emerald-300 bg-emerald-900/20 p-3 rounded-xl border border-emerald-400/30">
                    {{ status }}
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-bold text-white mb-2">
                            <svg class="w-4 h-4 inline mr-2 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                            Correo Electrónico
                        </label>
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="appearance-none relative block w-full px-4 py-3 border border-white/30 placeholder-slate-400 text-slate-900 rounded-xl bg-white/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:z-10 transition-all duration-200"
                            placeholder="tu@correo.com"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <div v-if="form.errors.email" class="mt-2 text-sm text-red-300">
                            {{ form.errors.email }}
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-bold text-white mb-2">
                            <svg class="w-4 h-4 inline mr-2 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Contraseña
                        </label>
                        <input
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="appearance-none relative block w-full px-4 py-3 border border-white/30 placeholder-slate-400 text-slate-900 rounded-xl bg-white/90 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:z-10 transition-all duration-200"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                        />
                        <div v-if="form.errors.password" class="mt-2 text-sm text-red-300">
                            {{ form.errors.password }}
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input
                                id="remember"
                                v-model="form.remember"
                                name="remember"
                                type="checkbox"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-white/30 rounded bg-white/20"
                            />
                            <label for="remember" class="ml-2 block text-sm text-blue-200">
                                Recordarme
                            </label>
                        </div>

                        <div class="text-sm" v-if="canResetPassword">
                            <Link
                                :href="route('password.request')"
                                class="font-medium text-blue-300 hover:text-blue-200 transition-colors duration-200"
                            >
                                ¿Olvidaste tu contraseña?
                            </Link>
                        </div>
                    </div>

                    <div>
                        <button
                            type="submit"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                        >
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-blue-300 group-hover:text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013 3v1"/>
                                </svg>
                            </span>
                            {{ form.processing ? 'Iniciando sesión...' : 'Iniciar Sesión' }}
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-blue-200">
                        Desarrollado por: <span class="font-bold text-white">Aldair Gutiérrez</span>
                    </p>
                    <p class="text-xs text-blue-300 mt-1">
                        Prueba Técnica - Cotecmar 2025
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
