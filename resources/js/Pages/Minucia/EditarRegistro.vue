<template>
    <AppLayout title="Editar Registro">
        <template #header>
            <div class="bg-gradient-to-r from-slate-900 via-blue-900 to-slate-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
                        <svg class="w-8 h-8 mr-3 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Editar Registro de Minucia
                    </h2>
                    <p class="text-blue-200 mt-2">
                        Modificar información del registro
                    </p>
                </div>
            </div>
        </template>

        <div class="py-12 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white/80 backdrop-blur-sm border border-blue-200 overflow-hidden shadow-2xl sm:rounded-2xl">
                    <div class="p-8">
                        <form @submit.prevent="submitForm" class="space-y-8">
                            <!-- Información de fecha y hora -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-3">
                                        <svg class="w-4 h-4 inline mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Fecha de Registro
                                    </label>
                                    <input
                                        type="text"
                                        :value="formatDate(registro.fecha_registro)"
                                        readonly
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-100 cursor-not-allowed"
                                    />
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-3">
                                        <svg class="w-4 h-4 inline mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        Usuario
                                    </label>
                                    <input
                                        type="text"
                                        :value="registro.user?.name || 'Sistema'"
                                        readonly
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-100 cursor-not-allowed"
                                    />
                                </div>
                            </div>

                            <!-- Información del proyecto (solo lectura) -->
                            <div class="space-y-6">
                                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-200">
                                    <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        Información del Proyecto (Solo lectura)
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-slate-600">Proyecto</label>
                                            <p class="text-lg font-semibold text-slate-800 bg-white p-2 rounded border">{{ registro.proyecto?.nombre || 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-600">Bloque</label>
                                            <p class="text-lg font-semibold text-slate-800 bg-white p-2 rounded border">{{ registro.bloque?.nombre || 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-600">Pieza</label>
                                            <p class="text-lg font-semibold text-slate-800 bg-white p-2 rounded border">{{ registro.nombre || 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Peso Real (campo editable) -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-3">
                                    <svg class="w-4 h-4 inline mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                                    </svg>
                                    Peso Real (kg) *
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs text-slate-500 mb-1">Peso Teórico</label>
                                        <input
                                            type="text"
                                            :value="registro.peso_teorico + ' kg'"
                                            readonly
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-100 cursor-not-allowed"
                                        />
                                    </div>
                                    <div>
                                        <label class="block text-xs text-slate-500 mb-1">Peso Real</label>
                                        <input
                                            v-model="form.peso_real"
                                            type="number"
                                            step="0.001"
                                            min="0"
                                            required
                                            placeholder="Ingrese el peso real"
                                            class="w-full px-4 py-3 border border-green-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-300 shadow-sm"
                                            :class="{ 'border-red-500': form.errors.peso_real }"
                                        />
                                        <span v-if="form.errors.peso_real" class="text-red-500 text-sm mt-1 block">{{ form.errors.peso_real }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Observaciones -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-3">
                                    <svg class="w-4 h-4 inline mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Observaciones
                                </label>
                                <textarea
                                    v-model="form.observaciones"
                                    rows="4"
                                    placeholder="Ingrese observaciones adicionales..."
                                    class="w-full px-4 py-3 border border-amber-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition duration-300 shadow-sm resize-none"
                                    :class="{ 'border-red-500': form.errors.observaciones }"
                                />
                                <span v-if="form.errors.observaciones" class="text-red-500 text-sm mt-1 block">{{ form.errors.observaciones }}</span>
                            </div>

                            <!-- Botones -->
                            <div class="flex justify-between pt-6 border-t border-slate-200">
                                <Link
                                    :href="route('minucia.ver', registro.id)"
                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-xl transition duration-300 flex items-center shadow-lg"
                                >
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                    </svg>
                                    Cancelar
                                </Link>

                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-8 rounded-xl transition duration-300 flex items-center shadow-lg disabled:opacity-50"
                                >
                                    <svg v-if="form.processing" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <svg v-else class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    {{ form.processing ? 'Actualizando...' : 'Actualizar Registro' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';

// Props
const props = defineProps({
    registro: {
        type: Object,
        required: true
    }
});

// Form data
const form = useForm({
    peso_real: props.registro.peso_real || '',
    observaciones: props.registro.observaciones || ''
});

// Métodos
const formatDate = (dateString) => {
    if (!dateString) return 'N/A';

    try {
        const date = new Date(dateString);
        return date.toLocaleString('es-ES', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
    } catch (error) {
        return dateString;
    }
};

const submitForm = () => {
    form.put(route('minucia.actualizar', props.registro.id), {
        onSuccess: () => {
            // Redireccionar a la vista del registro
        },
        onError: (errors) => {
            console.error('Errores de validación:', errors);

            // Manejar error 419 CSRF
            if (errors[419] || (typeof errors === 'object' && Object.keys(errors).length === 0)) {
                alert('Su sesión ha expirado. Por favor, recargue la página.');
                window.location.reload();
            }
        }
    });
};
</script>
