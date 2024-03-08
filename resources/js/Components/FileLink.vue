<template>
    <div class="file-link" @click="openFile">
        <img src="/images/pdf_icon.png" alt="PDF Icon" />
        <span class="file-title">{{ title }}</span>
    </div>
</template>

<script>
export default {
    name: "FileLink",
    props: {
        title: String,
        filePath: String,
    },
    methods: {
        openFile() {
            let fullPath = this.filePath.startsWith("/")
                ? this.filePath
                : "/" + this.filePath;
            fullPath = fullPath.replace("public/", "storage/"); // Ejemplo de reemplazo adicional
            window.open(fullPath, "_blank");
        },
    },
};
</script>

<style scoped>
.file-link {
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 15px 15px;
}

.file-link img {
    width: 60px;
}

.file-title {
    color: #f6416c;
    font-weight: bold;
    white-space: nowrap; /* Asegura que el texto no se ajuste a una nueva línea */
    overflow: hidden; /* Oculta el contenido que desborde el contenedor */
    text-overflow: ellipsis; /* Añade puntos suspensivos cuando hay desbordamiento */
    max-width: 120px; /* Ajusta esto según el tamaño de tu contenedor */
    display: inline-block; /* O block, dependiendo de tu layout */
}

/* Add additional styling as needed */
</style>
