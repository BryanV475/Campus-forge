<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Inicio" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center main-window"
    >
        <div
            v-if="canLogin"
            class="sm:fixed sm:top-0 sm:end-0 p-6 text-end z-10"
        >
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Dashboard</Link
            >

            <template v-else>
                <Link :href="route('login')" class="font-semibold navlink"
                    >Ingresar</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ms-4 font-semibold navlink"
                    >Registrar</Link
                >
            </template>
        </div>

        <div class="mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <!-- Your Logo Here -->
            </div>

            <div class="mt-16 flex flex-wrap justify-between items-center">
                <div class="flex-1 pr-6">
                    <img src="/images/logo.png" alt="logo" width="450" />
                    <p class="text-2xl text-gray-700 my-4">
                        Crea tu viaje educativo con Campus Forge Enciende el
                        aprendizaje, forja el éxito.
                    </p>
                    <br />
                    <a href="#more" class="btn-green"> Saber más </a>
                </div>
                <div class="flex-1 p-4">
                    <div class="circle-container">
                        <img
                            src="/images/port.png"
                            alt="Grupo de estudiantes"
                            class="main-img"
                        />
                    </div>
                    <!-- Asegúrate de cambiar la ruta de la imagen -->
                </div>
            </div>

            <div
                class="flex justify-center mt-16 px-6 sm:items-center sm:justify-between"
            >
                <!-- Footer Content -->
            </div>
        </div>
    </div>
    <div class="bg-white w-full info-cards" id="more">
        <div class="flex justify-around items-center">
            <!-- Tarjeta 1 -->
            <div class="text-center p-4">
                <div class="mb-5">
                    <img
                        src="/images/image1.png"
                        alt="Explorar cursos"
                        class="rounded-full w-56 h-56 mx-auto"
                    />
                    <!-- Reemplazar con la ruta correcta -->
                </div>
                <h3 class="text-xl font-semibold mb-5">Explorar cursos</h3>
                <p class="text-xl text-gray-600 mx-2 px-4">
                    Sumérjase en una amplia gama de cursos de diversas
                    disciplinas. Encuentre el curso que se ajuste a sus con
                    descripciones detalladas.
                </p>
            </div>

            <!-- Tarjeta 2 -->
            <div class="text-center p-4">
                <div class="mb-5">
                    <img
                        src="/images/image2.png"
                        alt="Calificar y revisar"
                        class="rounded-full w-56 h-56 mx-auto"
                    />
                    <!-- Reemplazar con la ruta correcta -->
                </div>
                <h3 class="text-xl font-semibold mb-5">Calificar y revisar</h3>
                <p class="text-xl text-gray-600 px-4">
                    Comparta su experiencia y ayude a la comunidad puntuando y
                    cursos que hayas realizado. Sus comentarios marcan
                    ¡diferencia!
                </p>
            </div>

            <!-- Tarjeta 3 -->
            <div class="text-center p-4">
                <div class="mb-5">
                    <img
                        src="/images/image3.png"
                        alt="Unirse a nuestra comunidad"
                        class="rounded-full w-56 h-56 mx-auto"
                    />
                    <!-- Reemplazar con la ruta correcta -->
                </div>
                <h3 class="text-xl font-semibold mb-5">
                    Unirse a nuestra comunidad
                </h3>
                <p class="text-xl text-gray-600 px-4">
                    Forme parte de una creciente comunidad de estudiantes y
                    educadores. educadores. Participe en debates, comparta ideas
                    y con sus compañeros.
                </p>
            </div>
        </div>

        <div class="flex justify-center space-x-4 footer">
            <a href="#" class="footerlink">Github</a>
            <a href="#" class="footerlink">Twitter</a>
            <a href="#" class="footerlink">Facebook</a>
        </div>

        <div class="text-center text-gray-600 mt-4">
            <p>Derechos reservados © tellxmaster & BryanV475 2024.</p>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
