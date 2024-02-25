<script setup>
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiStar } from "@mdi/js";
import { Link } from "@inertiajs/vue3";
</script>
<template>
    <Link
        class="bg-[#F8F3D4] p-4 border border-transparent mb-2 rounded cursor-pointer hover:bg-opacity-75"
        :href="route('courses.show', { id: courseId })"
    >
        <img
            :src="image"
            alt="Course image"
            class="w-full h-48 object-cover rounded-md"
        />
        <div class="py-4 flex justify-between items-center">
            <h2 class="font-semibold text-lg">{{ title }}</h2>
            <div class="flex items-center">
                <span class="text-yellow-500 text-md">{{ rating }}</span>
                <span class="stars ml-2">
                    <svg-icon
                        type="mdi"
                        style="
                            color: #ffd23f;
                            filter: drop-shadow(1px 1px 1px #ccc);
                        "
                        :path="path1"
                    ></svg-icon>
                </span>
            </div>
        </div>
        <p class="text-gray-700 text-base mb-4">{{ description }}</p>
    </Link>
</template>

<script>
export default {
    name: "CourseCard",
    props: {
        courseId: Number,
        title: String,
        description: String,
        rating: Number,
        image: String, // Prop para la imagen
    },
    components: {
        SvgIcon,
    },
    data() {
        return {
            path1: mdiStar,
        };
    },
};
</script>
