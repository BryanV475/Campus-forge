<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ListCourses from "@/Components/ListCourses.vue";
import Footer from "@/Components/Footer.vue";
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl mx-2 text-gray-800 leading-tight">
                Lista Cursos
            </h2>
        </template>

        <ListCourses />
        <Footer />
    </AppLayout>
</template>
