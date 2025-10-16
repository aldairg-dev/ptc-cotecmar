<template>
    <AppLayout title="Ver Registro">
        <template #header>
            <div class="bg-gradient-to-r from-slate-900 via-blue-900 to-slate-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
                        <svg class="w-8 h-8 mr-3 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Ver Registro de Minucia
                    </h2>
                    <p class="text-blue-200 mt-2">
                        Detalles del registro de pieza
                    </p>
                </div>
            </div>
        </template>

        <div class="py-12 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white/80 backdrop-blur-sm border border-blue-200 overflow-hidden shadow-2xl sm:rounded-2xl">
                    <div class="p-8">
                        <!-- Botones de acción -->
                        <div class="flex justify-between items-center mb-8">
                            <Link
                                :href="route('minucia.listado')"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 flex items-center"
                            >
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Volver al Listado
                            </Link>

                            <div class="flex space-x-3">
                                <Link
                                    :href="route('minucia.editar', registro.id)"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 flex items-center"
                                >
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Editar
                                </Link>
                            </div>
                        </div>

                        <!-- Información principal -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                            <!-- Fecha y Usuario -->
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-200">
                                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Información de Registro
                                </h3>
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600">Fecha de Registro</label>
                                        <p class="text-lg font-semibold text-slate-800">{{ formatDate(registro.fecha_registro) }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600">Registrado por</label>
                                        <p class="text-lg font-semibold text-slate-800">{{ registro.user?.name || 'Sistema' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Información del Proyecto -->
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-xl border border-green-200">
                                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    Información del Proyecto
                                </h3>
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600">Proyecto</label>
                                        <p class="text-lg font-semibold text-slate-800">{{ registro.proyecto?.nombre || 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600">Bloque</label>
                                        <p class="text-lg font-semibold text-slate-800">{{ registro.bloque?.nombre || 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600">Pieza</label>
                                        <p class="text-lg font-semibold text-slate-800">{{ registro.nombre || 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Información de pesos -->
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-6 rounded-xl border border-purple-200 mb-8">
                            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                                </svg>
                                Información de Pesos
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="bg-white p-4 rounded-lg border border-purple-100">
                                    <label class="block text-sm font-medium text-slate-600">Peso Teórico</label>
                                    <p class="text-2xl font-bold text-purple-600">{{ registro.peso_teorico }} kg</p>
                                </div>
                                <div class="bg-white p-4 rounded-lg border border-purple-100">
                                    <label class="block text-sm font-medium text-slate-600">Peso Real</label>
                                    <p class="text-2xl font-bold text-green-600">{{ registro.peso_real || 'N/A' }} kg</p>
                                </div>
                                <div class="bg-white p-4 rounded-lg border border-purple-100">
                                    <label class="block text-sm font-medium text-slate-600">Diferencia</label>
                                    <p class="text-2xl font-bold" :class="getDiferenciaClass()">
                                        {{ calcularDiferencia() }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Estado -->
                        <div class="bg-gradient-to-r from-amber-50 to-orange-50 p-6 rounded-xl border border-amber-200 mb-8">
                            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Estado y Observaciones
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-slate-600">Estado</label>
                                    <span :class="getEstadoClass()" class="inline-flex px-3 py-1 rounded-full text-sm font-medium">
                                        {{ registro.estado || 'N/A' }}
                                    </span>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-600">Material</label>
                                    <p class="text-lg font-semibold text-slate-800">{{ registro.material || 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-slate-600 mb-2">Observaciones</label>
                                <div class="bg-white p-4 rounded-lg border border-amber-100">
                                    <p class="text-slate-700 whitespace-pre-wrap">{{ registro.observaciones || 'Sin observaciones registradas' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Información de auditoría -->
                        <div class="mt-8 pt-6 border-t border-slate-200">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-500">
                                <div>
                                    <strong>Creado:</strong> {{ formatDate(registro.created_at) }}
                                </div>
                                <div>
                                    <strong>Actualizado:</strong> {{ formatDate(registro.updated_at) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

// Props
const props = defineProps({
    registro: {
        type: Object,
        required: true
    }
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

const calcularDiferencia = () => {
    if (!props.registro.peso_real || !props.registro.peso_teorico) return 'N/A';

    const diferencia = props.registro.peso_real - props.registro.peso_teorico;
    const porcentaje = ((diferencia / props.registro.peso_teorico) * 100).toFixed(2);

    if (diferencia > 0) {
        return `+${diferencia.toFixed(3)} kg (+${porcentaje}%)`;
    } else if (diferencia < 0) {
        return `${diferencia.toFixed(3)} kg (${porcentaje}%)`;
    } else {
        return '0.000 kg (0%)';
    }
};

const getDiferenciaClass = () => {
    if (!props.registro.peso_real || !props.registro.peso_teorico) return 'text-gray-500';

    const diferencia = props.registro.peso_real - props.registro.peso_teorico;
    const porcentaje = Math.abs((diferencia / props.registro.peso_teorico) * 100);

    if (porcentaje <= 5) return 'text-green-600'; // Dentro del rango aceptable
    else if (porcentaje <= 10) return 'text-yellow-600'; // Advertencia
    else return 'text-red-600'; // Fuera del rango
};

const getEstadoClass = () => {
    switch (props.registro.estado) {
        case 'Fabricado':
            return 'bg-green-100 text-green-800';
        case 'Pendiente':
            return 'bg-yellow-100 text-yellow-800';
        default:
            return 'bg-gray-100 text-gray-800';
    }
};
</script>
