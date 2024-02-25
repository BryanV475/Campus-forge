<template>
    <div class="flex flex-row justify-between items-center">
        <div
            v-for="n in 5"
            :key="n"
            :id="n.toString()"
            class="text-center chemstar"
            :class="{ active: n === activeRating }"
            @click="setRating(n)"
        >
            <span class="font-semibold mb-1">{{ n }}</span>
            <img
                :src="`/images/${n}.png`"
                :alt="`${n} star`"
                width="100"
                height="100"
            />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        rating: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            activeRating: this.rating,
        };
    },
    watch: {
        // Observa cambios en la prop 'rating' y actualiza 'activeRating' en consecuencia
        rating(newVal) {
            this.activeRating = newVal;
        },
    },
    methods: {
        setRating(n) {
            this.activeRating = n;
            console.log(n); // Muestra la calificación seleccionada en la consola
            this.$emit("update:rating", n); // Emite el evento 'update:rating' con la nueva calificación
        },
    },
};
</script>

<style>
.chemstar {
    transform: scale(1);
    margin: 0 12px;
    transition: transform 200ms ease-in;
}

.chemstar:hover {
    cursor: pointer;
    filter: drop-shadow(4px 4px 20px #ffd23f);
    transform: scale(1.1);
    transition: all 200ms ease-in;
    color: #f6416c;
}

.chemstar.active {
    transform: scale(1.2);
    color: #f6416c;
    background-color: aliceblue;
    border: 1px solid #ccc;
    border-radius: 10px;
    transition: all 200ms ease-in;
}

.chemstar.active:hover {
    box-shadow: 2px 2px 2px #ccc;
    transform: scale(1.2);
    color: #f6416c;
    transition: all 200ms ease-in;
}
</style>
