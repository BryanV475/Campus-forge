<script setup>
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import ListCourses from "@/Components/ListCourses.vue";
import Footer from "@/Components/Footer.vue";

// Estado reactivo para la selección del nivel y la carga
const selectedLevel = ref("");
const isLoading = ref(false);

// Manejador para el evento 'load' emitido por ListCourses
const handleLoad = (coursesLoaded) => {
    isLoading.value = !coursesLoaded; // Actualiza el estado de carga
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl mx-2 text-gray-800 leading-tight">
                Lista de Cursos
            </h2>
            <div class="flex justify-end">
                <select
                    v-model.number="selectedLevel"
                    name="levels"
                    id="levels"
                    class="mt-1 block pl-3 pr-10 py-1 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                    style="width: 200px"
                >
                    <option value="">Seleccione un nivel</option>
                    <option value="1">Primero</option>
                    <option value="2">Segundo</option>
                    <option value="3">Tercero</option>
                    <option value="4">Cuarto</option>
                    <option value="5">Quinto</option>
                    <option value="6">Sexto</option>
                    <option value="7">Séptimo</option>
                    <option value="8">Octavo</option>
                </select>
            </div>
        </template>

        <div v-if="isLoading" class="flex justify-center items-center min-h-50">
            <div
                class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-purple-500"
            ></div>
        </div>
        <div v-else class="min-h-screen">
            <ListCourses :level="selectedLevel" @load="handleLoad" />
        </div>
        <Footer />
    </AppLayout>
</template>
