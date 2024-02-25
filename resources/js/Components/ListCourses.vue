<script setup>
import { onMounted, ref } from "vue";
import axios from "axios";
import CourseCard from "@/Components/CourseCard.vue";

const courses = ref([]); // Inicializa courses como un array reactivo vacío

onMounted(async () => {
    try {
        const response = await axios.get("http://localhost:8000/api/courses");
        courses.value = response.data; // Asigna la respuesta de la API a courses
    } catch (error) {
        console.error("There was an error fetching the courses:", error);
    }
});
</script>

<template>
    <div class="container mx-10 px-4 my-4">
        <div class="flex flex-wrap -mx-2">
            <div
                v-for="course in courses"
                :key="course.id"
                class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 px-2 mb-4"
            >
                <CourseCard
                    :title="course.name"
                    :description="course.description"
                    :rating="course.average_rating"
                    :image="course.image_url"
                    :courseId="course.id"
                />
            </div>
        </div>
    </div>
</template>
