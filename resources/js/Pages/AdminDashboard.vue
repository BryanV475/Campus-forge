<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { Notyf } from "notyf";
import "notyf/notyf.min.css";
import AppLayout from "@/Layouts/AppLayout.vue";
import Footer from "@/Components/Footer.vue";
import FileLink from "@/Components/FileLink.vue";

// Crear una instancia de Notyf para las notificaciones
const notyf = new Notyf();

const unapprovedFilesWithCourse = ref([]);

// Método para cargar todos los archivos no aprobados
const fetchUnapprovedFiles = async () => {
    try {
        const response = await axios.get("/api/files/unapproved");
        unapprovedFilesWithCourse.value = response.data;
    } catch (error) {
        console.error("Error al cargar los archivos no aprobados:", error);
    }
};

const approveFile = async (fileId) => {
    try {
        await axios.put(`/api/files/approve/${fileId}`);
        // Eliminar el archivo aprobado del estado
        unapprovedFilesWithCourse.value =
            unapprovedFilesWithCourse.value.filter(
                (file) => file.id !== fileId
            );
        notyf.success("Archivo aprobado con éxito.");
    } catch (error) {
        console.error(`Error al aprobar el archivo ${fileId}:`, error);
        notyf.error("Error al aprobar el archivo.");
    }
};

onMounted(fetchUnapprovedFiles);
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl mx-2 text-gray-800 leading-tight">
                Panel Administrador
            </h2>
        </template>

        <div class="m-4 p-4 mx-2">
            <table class="min-w-full table-auto rounded-lg shadow-md bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left">Archivo (Curso)</th>
                        <th class="px-4 py-2 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="file in unapprovedFilesWithCourse"
                        :key="file.id"
                        class="border-b"
                    >
                        <td class="px-4 py-2">
                            <a
                                :href="`${file.path.replace(
                                    'public/',
                                    'storage/'
                                )}`"
                                target="_blank"
                                class="text-blue-600 hover:text-blue-800"
                            >
                                {{ file.name }} ({{ file.course.name }})
                            </a>
                        </td>
                        <td class="px-4 py-2 text-right">
                            <button
                                @click="approveFile(file.id)"
                                class="bg-green-600 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mx-1"
                            >
                                Aprobar
                            </button>
                            <button
                                @click="rejectFile(file.id)"
                                class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mx-1"
                            >
                                Rechazar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <Footer />
    </AppLayout>
</template>
