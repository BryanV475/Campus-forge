<script setup>
import { Link } from "@inertiajs/vue3";
import { onMounted, ref, computed } from "vue";
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiArrowLeft, mdiStar } from "@mdi/js";
import ReviewRatingModal from "@/Components/ReviewRatingModal.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Footer from "@/Components/Footer.vue";
import Modal from "@/Components/Modal.vue";
import DialogModal from "@/Components/DialogModal.vue";
import UploadModal from "@/Components/UploadModal.vue";
import FileLink from "@/Components/FileLink.vue";
import { Notyf } from "notyf";
import "notyf/notyf.min.css";
import axios from "axios";

const notyf = new Notyf();

const props = defineProps({
    course: {
        type: Object,
        default: () => ({}), // Proporciona un objeto vacío como valor predeterminado
    },
    user: {
        type: Object,
        default: () => ({}), // Proporciona un objeto vacío como valor predeterminado
    },
});

const rating = ref(0);
const ratings = ref([]);
const files = ref([]);
const comment = ref("");
const courseId = computed(() => props.course.id);
const userId = computed(() => props.user.id);
const isModalVisible = ref(false);
const isUploadModalVisible = ref(false);
const uploadSuccess = ref(false);
const averageRating = ref(parseFloat(props.course.avg_rating).toFixed(2));

const openModal = () => {
    isUploadModalVisible.value = true;
};

const handleCloseModal = () => {
    isUploadModalVisible.value = false;
};

const handleFileUploaded = async (file) => {
    try {
        if (!(file instanceof File)) {
            throw new Error(
                "El parámetro file debe ser un objeto de tipo File"
            );
        }

        const formData = new FormData();
        formData.append("file", file);
        formData.append("course_id", courseId.value);

        const response = await axios.post("/api/files", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });

        if (response.status === 200) {
            notyf.success("¡Archivo cargado exitosamente!");
            handleCloseModal();
            uploadSuccess.value = !uploadSuccess.value;
            getApprovedFiles();
        }
    } catch (error) {
        if (error.response && error.response.data) {
            console.error("Error al cargar el archivo:", error.response.data);
            notyf.error(
                "Error al cargar el archivo: " + error.response.data.message
            );
        } else if (error.request) {
            console.error("Error de conexión:", error.request);
            notyf.error(
                "Error de conexión. Por favor, intenta de nuevo más tarde."
            );
        } else {
            console.error("Error al cargar el archivo:", error.message);
            notyf.error(
                "Ocurrió un error. Por favor, intenta de nuevo más tarde."
            );
        }
    }
};

const resetForm = () => {
    // Resetear los modelos que estás usando en tu formulario
    rating.value = 0; // Asume que el rating por defecto es 0
    comment.value = ""; // Asume que el comentario se limpia con una cadena vacía
    // Reinicia cualquier otra variable del estado que necesites aquí
};

const getApprovedFiles = async () => {
    try {
        const response = await axios.get(
            `/api/files/approved/${courseId.value}`
        );
        if (response.data && Array.isArray(response.data)) {
            files.value = response.data;
        } else {
            console.error("La respuesta no es un array", response);
        }
    } catch (error) {
        console.error("Error al cargar los archivos:", error);
        // Aquí puedes manejar el error, por ejemplo, mostrando un mensaje al usuario.
    }
};

const submitRating = async () => {
    if (rating.value === 0) {
        notyf.error("Por favor, proporcione una calificación antes de enviar.");
        return; // Termina la ejecución de la función aquí
    }
    try {
        const response = await axios.post("http://localhost:8000/api/ratings", {
            user_id: userId.value,
            course_id: courseId.value,
            rating: rating.value,
            comment: comment.value,
        });

        console.log(response.data); // Procesa la respuesta del servidor
        notyf.success("Reseña agregada exitosamente!");
        fetchRatings();
        averageRating.value = await getAverageRating(courseId.value);
        isModalVisible.value = false;
        resetForm();
    } catch (error) {
        // Maneja el error aquí
        if (
            error.response &&
            error.response.data &&
            error.response.data.error
        ) {
            // Aquí se maneja la respuesta de error personalizada desde el backend
            notyf.error(error.response.data.error);
        } else {
            // Si la respuesta de error no tiene el formato esperado, muestra un mensaje genérico
            notyf.error("Ocurrió un error al enviar la reseña.");
        }
        console.error(error);
    }
};

const getAverageRating = async (courseId) => {
    try {
        const response = await axios.get(
            `http://localhost:8000/api/courses/${courseId}/average-rating`
        );
        console.log("Promedio de calificaciones:", response.data.averageRating);
        return parseFloat(response.data.averageRating).toFixed(2);
    } catch (error) {
        // Maneja el error en caso de que la petición falle
        console.error("Error al obtener el promedio de calificaciones:", error);
        return null; // Retorna null o maneja el error de manera adecuada
    }
};

const fetchRatings = async () => {
    try {
        const response = await axios.get(
            `http://localhost:8000/api/ratings/${courseId.value}`
        );
        console.log(response.data); // Procesa la respuesta del servidor
        ratings.value = response.data;
    } catch (error) {
        console.error(error); // Maneja el error aquí
    }
};

const updateRating = (newRating) => {
    rating.value = newRating;
};

onMounted(() => {
    fetchRatings();
    getApprovedFiles();
});
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="flex flex-col md:flex-row justify-between mx-10">
            <div class="w-full sm:w-full md:w-full lg:w-50 xl:w-50 p-4">
                <div class="flex items-center">
                    <Link :href="route('dashboard')" class="mr-2">
                        <svg-icon type="mdi" :path="path1"></svg-icon>
                    </Link>
                    <h3 class="font-bold text-xl text-gray-800 py-4">
                        Vista del Curso
                    </h3>
                </div>

                <img
                    :src="course.image_url"
                    alt="Course Image"
                    class="w-full h-40 object-cover rounded-lg"
                />
                <!-- Título del Curso -->
                <h1 class="mt-4 font-bold text-xl text-gray-800">
                    {{ course.name }}
                </h1>
                <!-- Descripción del Curso -->
                <p class="mt-2 text-gray-600">{{ course.description }}</p>
                <!-- Controles: Calificación y Botón -->
                <div class="mt-4 flex items-center space-x-2">
                    <button
                        class="bg-[#00B8A9] text-white py-2 px-4 rounded hover:bg-green-600"
                        @click="isModalVisible = true"
                    >
                        Calificar
                    </button>
                    <div
                        class="flex items-center text-[#F6416C] text-lg font-semibold"
                    >
                        <div class="pl-4 pr-1">
                            {{ averageRating || averageRating.value || "0.0" }}
                        </div>
                        <svg-icon
                            type="mdi"
                            style="
                                color: #ffd23f;
                                filter: drop-shadow(1px 1px 1px #ccc);
                            "
                            :path="path2"
                        ></svg-icon>
                    </div>
                </div>
                <!-- Recursos -->

                <h3 class="mt-6 font-bold text-gray-800">Recursos</h3>
                <div class="files-container flex flex-wrap items-start">
                    <!-- Item por defecto para el sílabo -->
                    <FileLink
                        title="Sílabo"
                        :file-path="`/storage/${course.syllabus_url}`"
                        class="mr-2 mb-2"
                    />

                    <!-- Bucle para otros archivos -->
                    <FileLink
                        v-for="file in files"
                        :key="file.id"
                        :title="file.name"
                        :file-path="`${file.path
                            .replace('public/', 'storage/')
                            .replace('/courses', '')}`"
                        class="mr-2 mb-2"
                    />
                </div>
                <button
                    @click="openModal"
                    class="text-blue-600 hover:text-blue-800 underline font-semibold py-2 px-4 rounded focus:outline-none focus:underline"
                >
                    + Agregar Recurso
                </button>
            </div>

            <div
                class="w-full sm:w-full md:w-1/2 lg:w-1/2 xl:w-1/2 2xl:w-1/2 p-4"
            >
                <h3 class="font-bold text-xl text-gray-800">Comentarios</h3>
                <!-- Lista de Comentarios -->
                <div id="comentarios" class="mt-4 flex flex-col space-y-2">
                    <div
                        v-for="rating in ratings"
                        :key="rating.id"
                        class="bg-[#F3F1E1] border-1 border-gray shadow-lg overflow-hidden rounded-md p-4"
                    >
                        <div class="flex items-center justify-between">
                            <div class="text-sm font-medium text-gray-900">
                                {{ rating.user.name }}
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ rating.rating }} estrellas
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-gray-700">
                            {{ rating.comment }}
                        </div>
                        <div class="mt-2">
                            <img
                                :src="rating.user.profile_photo_url"
                                alt="Profile photo"
                                class="h-10 w-10 rounded-full"
                            />
                        </div>
                    </div>
                </div>
                <button
                    class="mt-4 bg-[#00B8A9] text-white py-2 px-4 rounded hover:bg-green-600"
                    @click="isModalVisible = true"
                >
                    Nuevo
                </button>
            </div>
        </div>
        <Modal :show="isModalVisible" v-if="typeof rating !== 'undefined'">
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <div class="flex-1 text-center">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">
                            ¿Qué opinas de la asignatura?
                        </h2>
                    </div>

                    <button
                        class="text-gray-400 hover:text-gray-500"
                        @click="isModalVisible = false"
                    >
                        <span class="sr-only">Cerrar</span>
                        ×
                    </button>
                </div>

                <form @submit.prevent="submitRating" class="space-y-4">
                    <p class="text-center text-md text-gray-900 mb-4">
                        Tu feedback es super importante para mejorar. Califica
                        del 1 al 5, donde 1 es "no me gustó" y 5 es "me
                        encantó". ¡Gracias por compartir tu punto de vista!
                    </p>
                    <div class="flex items-center py-10 justify-center">
                        <ReviewRatingModal
                            :rating="rating.value"
                            @update:rating="updateRating"
                        />
                        <!-- Asumiendo que star-rating es un componente que puede recibir una clase para estilos -->
                    </div>
                    <div class="flex items-center">
                        <h3 class="font-semibold text-gray-900 mr-2">
                            Comentario
                        </h3>
                        <small>({{ rating }} estrellas ★)</small>
                    </div>
                    <input type="hidden" v-model="user.id" />
                    <input type="hidden" v-model="course.id" />
                    <textarea
                        v-model="comment"
                        rows="4"
                        class="w-full p-2 border border-gray-300 rounded-md shadow-sm"
                        placeholder="(Opcional)"
                    >
                    </textarea>
                    <button
                        type="submit"
                        class="w-full bg-[#00B8A9] px-4 py-2 text-white rounded-md hover:bg-green-600 focus:outline-none focus:bg-[#009588]"
                    >
                        Enviar
                    </button>
                </form>
            </div>
        </Modal>
        <UploadModal
            :show-upload-modal="isUploadModalVisible"
            :reset="uploadSuccess"
            @close="handleCloseModal"
            @file-uploaded="handleFileUploaded"
        />

        <Footer />
    </AppLayout>
</template>

<script>
export default {
    name: "CourseOverview",
    components: {
        SvgIcon,
        ReviewRatingModal,
    },
    data() {
        return {
            path1: mdiArrowLeft,
            path2: mdiStar,
        };
    },
};
</script>
