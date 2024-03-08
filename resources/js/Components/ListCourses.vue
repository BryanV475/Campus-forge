<script setup>
import { onMounted, ref, watch, defineEmits } from "vue";
import axios from "axios";
import CourseCard from "@/Components/CourseCard.vue";

// Define 'level' como una prop
const props = defineProps({
    level: String,
});

const emit = defineEmits(["load"]);
const courses = ref([]);

onMounted(async () => {
    try {
        const response = await axios.get("http://localhost:8000/api/courses");
        // Filtra los cursos basándote en el nivel, si se ha proporcionado 'level'
        courses.value = props.level
            ? response.data.filter((course) => course.level === props.level)
            : response.data;
        emit("load", courses.value);
    } catch (error) {
        console.error("There was an error fetching the courses:", error);
    }
});

// Reactiva a los cambios en 'level' para refiltrar los cursos
watch(
    () => props.level,
    async () => {
        try {
            const response = await axios.get(
                "http://localhost:8000/api/courses"
            );
            courses.value = props.level
                ? response.data.filter((course) => course.level === props.level)
                : response.data;
            emit("load", courses.value);
        } catch (error) {
            console.error("There was an error re-fetching the courses:", error);
        }
    }
);
</script>

<template>
    <div class="container mx-10 px-4 my-4">
        <div class="flex flex-wrap -mx-2">
            <div
                v-for="course in courses"
                :key="course.id"
                class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/4 2xl:w-1/4 px-2 mb-4"
            >
                <CourseCard
                    :title="course.name"
                    :description="course.description"
                    :rating="course.average_rating"
                    :image="course.image_url"
                    :level="course.level"
                    :courseId="course.id"
                />
            </div>
        </div>
    </div>
</template>
