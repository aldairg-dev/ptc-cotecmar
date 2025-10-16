<template>
    <AppLayout title="Registro de Minucia">
        <template #header>
            <div
                class="bg-gradient-to-r from-slate-900 via-blue-900 to-slate-900"
            >
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <h2
                        class="font-bold text-2xl text-white leading-tight flex items-center"
                    >
                        <svg
                            class="w-8 h-8 mr-3 text-blue-300"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                            />
                        </svg>
                        Registro de Minucia
                    </h2>
                    <p class="text-blue-200 mt-2">
                        Registrar nueva pieza en el sistema
                    </p>
                </div>
            </div>
        </template>

        <div
            class="py-12 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen"
        >
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white/80 backdrop-blur-sm border border-blue-200 overflow-hidden shadow-2xl sm:rounded-2xl"
                >
                    <div class="p-8">
                        <form @submit.prevent="submitForm" class="space-y-8">
                            <!-- Información de fecha y hora -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="block text-sm font-bold text-slate-700 mb-3"
                                    >
                                        <svg
                                            class="w-4 h-4 inline mr-2 text-blue-600"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                            />
                                        </svg>
                                        Fecha y Hora de Registro
                                    </label>
                                    <input
                                        type="text"
                                        :value="currentDateTime"
                                        readonly
                                        class="w-full px-4 py-3 border border-blue-200 rounded-xl bg-blue-50/50 text-slate-600 font-medium shadow-inner"
                                    />
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-bold text-slate-700 mb-3"
                                    >
                                        <svg
                                            class="w-4 h-4 inline mr-2 text-blue-600"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                            />
                                        </svg>
                                        Usuario
                                    </label>
                                    <input
                                        type="text"
                                        :value="$page.props.auth.user.name"
                                        readonly
                                        class="w-full px-4 py-3 border border-blue-200 rounded-xl bg-blue-50/50 text-slate-600 font-medium shadow-inner"
                                    />
                                </div>
                            </div>

                            <!-- Selección de proyecto -->
                            <div>
                                <label
                                    for="proyecto_id"
                                    class="block text-sm font-bold text-slate-700 mb-3"
                                >
                                    <svg
                                        class="w-4 h-4 inline mr-2 text-blue-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                                        />
                                    </svg>
                                    Proyecto *
                                </label>
                                <select
                                    id="proyecto_id"
                                    v-model="form.proyecto_id"
                                    @change="onProyectoChange"
                                    class="w-full px-4 py-3 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white shadow-sm transition-all duration-200 hover:border-blue-300"
                                    :class="{
                                        'border-red-400 focus:ring-red-500 focus:border-red-500':
                                            errors.proyecto_id,
                                    }"
                                >
                                    <option value="">
                                        Seleccione un proyecto
                                    </option>
                                    <option
                                        v-for="proyecto in proyectos"
                                        :key="proyecto.id"
                                        :value="proyecto.id"
                                    >
                                        {{ proyecto.codigo }} -
                                        {{ proyecto.nombre }}
                                    </option>
                                </select>
                                <p
                                    v-if="errors.proyecto_id"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ errors.proyecto_id }}
                                </p>
                            </div>

                            <!-- Selección de bloque -->
                            <div>
                                <label
                                    for="bloque_id"
                                    class="block text-sm font-bold text-slate-700 mb-3"
                                >
                                    <svg
                                        class="w-4 h-4 inline mr-2 text-blue-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                        />
                                    </svg>
                                    Bloque *
                                </label>
                                <select
                                    id="bloque_id"
                                    v-model="form.bloque_id"
                                    @change="onBloqueChange"
                                    :disabled="!bloques.length"
                                    class="w-full px-4 py-3 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white shadow-sm transition-all duration-200 hover:border-blue-300 disabled:bg-gray-100 disabled:cursor-not-allowed"
                                    :class="{
                                        'border-red-400 focus:ring-red-500 focus:border-red-500': errors.bloque_id,
                                    }"
                                >
                                    <option value="">
                                        {{ bloques.length ? 'Seleccione un bloque' : 'Primero seleccione un proyecto' }}
                                    </option>
                                    <option
                                        v-for="bloque in bloques"
                                        :key="bloque.id"
                                        :value="bloque.id"
                                    >
                                        {{ bloque.codigo }} -
                                        {{ bloque.nombre }}
                                    </option>
                                </select>
                                <p
                                    v-if="errors.bloque_id"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.bloque_id }}
                                </p>
                            </div>

                            <!-- Selección de pieza -->
                            <div>
                                <label
                                    for="pieza_id"
                                    class="block text-sm font-bold text-slate-700 mb-3"
                                >
                                    <svg
                                        class="w-4 h-4 inline mr-2 text-blue-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                    />
                                    </svg>
                                    Pieza *
                                </label>
                                <select
                                    id="pieza_id"
                                    v-model="form.pieza_id"
                                    @change="onPiezaChange"
                                    :disabled="!piezas.length"
                                    class="w-full px-4 py-3 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white shadow-sm transition-all duration-200 hover:border-blue-300 disabled:bg-gray-100 disabled:cursor-not-allowed"
                                    :class="{
                                        'border-red-400 focus:ring-red-500 focus:border-red-500': errors.pieza_id,
                                    }"
                                >
                                    <option value="">
                                        {{ piezas.length ? 'Seleccione una pieza' : 'Primero seleccione un bloque' }}
                                    </option>
                                    <option
                                        v-for="pieza in piezas"
                                        :key="pieza.id"
                                        :value="pieza.id"
                                    >
                                        {{ pieza.codigo }} -
                                        {{ pieza.nombre }} ({{
                                            pieza.peso_teorico
                                        }}
                                        kg)
                                    </option>
                                </select>
                                <p
                                    v-if="errors.pieza_id"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.pieza_id }}
                                </p>
                            </div>

                            <!-- Peso teórico (readonly) -->
                            <div>
                                <label
                                    class="block text-sm font-bold text-slate-700 mb-3"
                                >
                                    <svg
                                        class="w-4 h-4 inline mr-2 text-blue-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16l3-3m-3 3l-3-3"
                                    />
                                    </svg>
                                    Peso Teórico (kg)
                                </label>
                                <input
                                    type="text"
                                    :value="
                                        piezaSeleccionada
                                            ? piezaSeleccionada.peso_teorico
                                            : ''
                                    "
                                    readonly
                                    placeholder="Seleccione una pieza"
                                    class="w-full px-4 py-3 border border-blue-200 rounded-xl bg-blue-50/50 text-slate-600 font-medium shadow-inner"
                                />
                            </div>

                            <!-- Peso real -->
                            <div>
                                <label
                                    for="peso_real"
                                    class="block text-sm font-bold text-slate-700 mb-3"
                                >
                                    <svg
                                        class="w-4 h-4 inline mr-2 text-blue-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                        />
                                    </svg>
                                    Peso Real (kg) *
                                </label>
                                <input
                                    id="peso_real"
                                    type="number"
                                    step="0.001"
                                    min="0"
                                    v-model="form.peso_real"
                                    @input="calculateDifference"
                                    class="w-full px-4 py-3 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white shadow-sm transition-all duration-200 hover:border-blue-300"
                                    :class="{
                                        'border-red-400 focus:ring-red-500 focus:border-red-500': errors.peso_real,
                                    }"
                                    placeholder="Ingrese el peso real"
                                />
                                <p
                                    v-if="errors.peso_real"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.peso_real }}
                                </p>
                            </div>

                            <!-- Diferencia de peso (readonly) -->
                            <div>
                                <label
                                    class="block text-sm font-bold text-slate-700 mb-3"
                                >
                                    <svg
                                        class="w-4 h-4 inline mr-2 text-blue-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M7 21l3-3 3 3M7 3l3 3 3-3M12 6v12"
                                        />
                                    </svg>
                                    Diferencia de Peso (kg)
                                </label>
                                <input
                                    type="text"
                                    :value="diferenciaPeso"
                                    readonly
                                    class="w-full px-4 py-3 border border-blue-200 rounded-xl bg-blue-50/50 font-medium shadow-inner"
                                    :class="{
                                        'text-emerald-600': diferenciaPeso > 0,
                                        'text-red-600': diferenciaPeso < 0,
                                        'text-slate-600': diferenciaPeso === 0,
                                    }"
                                />
                            </div>

                            <!-- Observaciones -->
                            <div>
                                <label
                                    for="observaciones"
                                    class="block text-sm font-bold text-slate-700 mb-3"
                                >
                                    <svg
                                        class="w-4 h-4 inline mr-2 text-blue-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                        />
                                    </svg>
                                    Observaciones
                                </label>
                                <textarea
                                    id="observaciones"
                                    v-model="form.observaciones"
                                    rows="4"
                                    class="w-full px-4 py-3 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white shadow-sm transition-all duration-200 hover:border-blue-300 resize-none"
                                    placeholder="Observaciones adicionales (opcional)"
                                ></textarea>
                            </div>

                            <!-- Botones -->
                            <div class="flex justify-end space-x-4 pt-6">
                                <Link
                                    :href="route('minucia.index')"
                                    class="px-6 py-3 border border-slate-300 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-50 transition-all duration-200 hover:shadow-md"
                                >
                                    Cancelar
                                </Link>
                                <button
                                    type="submit"
                                    :disabled="processing"
                                    class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 border border-transparent rounded-xl text-sm font-bold text-white hover:from-blue-700 hover:to-blue-800 disabled:opacity-50 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                                >
                                    <span v-if="processing">
                                        <svg class="w-4 h-4 inline mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                        </svg>
                                        Guardando...
                                    </span>
                                    <span v-else>
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Guardar Registro
                                    </span>
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
import { ref, computed, onMounted } from "vue";
import { useForm, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    proyectos: Array,
    bloques: {
        type: Array,
        default: () => []
    },
    piezas: {
        type: Array,
        default: () => []
    },
    errors: Object,
});

const form = useForm({
    proyecto_id: "",
    bloque_id: "",
    pieza_id: "",
    peso_real: "",
    observaciones: "",
});

const bloques = ref(props.bloques || []);
const piezas = ref(props.piezas || []);
const processing = ref(false);

const currentDateTime = computed(() => {
    return new Intl.DateTimeFormat("es-CO", {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
    }).format(new Date());
});

const piezaSeleccionada = computed(() => {
    return piezas.value.find((pieza) => pieza.id == form.pieza_id);
});

const diferenciaPeso = computed(() => {
    if (!form.peso_real || !piezaSeleccionada.value) return "";
    const diferencia =
        parseFloat(form.peso_real) -
        parseFloat(piezaSeleccionada.value.peso_teorico);
    return diferencia.toFixed(3);
});

const onProyectoChange = async () => {
    form.bloque_id = "";
    form.pieza_id = "";
    bloques.value = [];
    piezas.value = [];

    if (form.proyecto_id) {
        try {
            const response = await axios.get(
                `/api/bloques/proyecto/${form.proyecto_id}`
            );
            bloques.value = response.data;
        } catch (error) {
            console.error("Error cargando bloques:", error);
        }
    }
};

const onBloqueChange = async () => {
    form.pieza_id = "";
    piezas.value = [];

    if (form.bloque_id) {
        try {
            const response = await axios.get(
                `/api/piezas/bloque/${form.bloque_id}`
            );
            piezas.value = response.data;
        } catch (error) {
            console.error("Error cargando piezas:", error);
        }
    }
};

const onPiezaChange = () => {
    form.peso_real = "";
};

const calculateDifference = () => {
};

const submitForm = () => {
    if (
        !form.proyecto_id ||
        !form.bloque_id ||
        !form.pieza_id ||
        !form.peso_real
    ) {
        alert("Por favor complete todos los campos obligatorios.");
        return;
    }

    if (isNaN(form.peso_real) || parseFloat(form.peso_real) < 0) {
        alert("El peso real debe ser un número válido mayor o igual a 0.");
        return;
    }

    processing.value = true;

    form.post(route("minucia.store"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            bloques.value = [];
            piezas.value = [];
            alert("¡Registro guardado exitosamente!");
        },
        onError: (errors) => {
            console.error('Errores del formulario:', errors);

            // Manejo específico para error 419 (CSRF)
            if (errors.message && errors.message.includes('419')) {
                alert("Su sesión ha expirado. La página se recargará para renovar la sesión.");
                window.location.reload();
            } else {
                let errorMessage = "Error al guardar el registro.\n\n";
                Object.keys(errors).forEach(key => {
                    errorMessage += `${key}: ${errors[key]}\n`;
                });
                alert(errorMessage);
            }
        },
        onFinish: () => {
            processing.value = false;
        },
    });
};

onMounted(() => {
    setInterval(() => {
    }, 1000);
});
</script>
