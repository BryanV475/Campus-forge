<script setup>
import { ref, defineEmits,watch, defineProps  } from "vue";
import Modal from "@/Components/Modal.vue";
import { Notyf } from "notyf";
import "notyf/notyf.min.css";

const props = defineProps({
    showUploadModal: {
        type: Boolean,
        default: false,
    },
    reset: {
        type: Boolean,
        default: false,
    }
});
const emits = defineEmits(["close", "fileSelected", "fileUploaded"]);
const selectedFile = ref(null);
const dragging = ref(false);
const fileInput = ref(null);
const isLoading = ref(false);

const handleDragOver = () => {
    dragging.value = true;
};

const handleDragLeave = () => {
    dragging.value = false;
};

const handleFileDrop = (e) => {
    dragging.value = false;
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        selectedFile.value = files[0];
    }
};

const handleFileChange = (e) => {
    const files = e.target.files;
    if (files.length > 0) {
        selectedFile.value = files[0];
        // Maneja la selección del archivo
    }
};

const removeSelectedFile = () => {
    selectedFile.value = null;
};

const handleClose = () => {
    emits("close");
};


const handleFileUploaded = () => {
    if (selectedFile.value instanceof File) { // Verificar si el archivo seleccionado es un objeto File
        emits("fileUploaded", selectedFile.value); // Pasar el archivo seleccionado como argumento
        
    } else {
        console.error("No se ha seleccionado ningún archivo.");
        notyf.error("Por favor, selecciona un archivo antes de subirlo.");
    }
};

const triggerFileInput = () => {
  if (fileInput.value) {
    fileInput.value.click(); // Simula un clic en el input de archivo
  }
};

watch(() => props.reset, (newVal) => {
    if (newVal) {
        selectedFile.value = null; // Resetea el archivo seleccionado
    }
});
</script>

<template>
    <Modal :show="showUploadModal">
        <div class="p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold">Subir Archivo</h3>
                <button
                    class="text-gray-400 hover:text-gray-500"
                    @click="handleClose"
                >
                    <span class="sr-only">Cerrar</span>
                    ×
                </button>
            </div>
            <div
                :class="[
                    'border-2 border-dashed rounded-lg text-center p-6 mt-4',
                    dragging
                        ? 'border-green-500 bg-green-100'
                        : 'border-gray-300',
                ]"
                @dragover.prevent="handleDragOver"
                @dragleave.prevent="handleDragLeave"
                @drop.prevent="handleFileDrop"
            >
                <p class="mb-3" v-if="!selectedFile">
                    {{
                        dragging
                            ? "Suelta el archivo"
                            : "Arrastra y suelta tu archivo aquí"
                    }}
                </p>
                <p v-if="selectedFile" class="selected-file">
                    <div class="filename">
                        {{ selectedFile.name }}
                    </div>
                    <button
                        @click="removeSelectedFile"
                        class="ml-2 text-red-500"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            x="0px"
                            y="0px"
                            width="20"
                            height="20"
                            viewBox="0,0,255.99431,255.99431"
                            style="fill: #000000"
                        >
                            <g
                                fill="#ff4b4b"
                                fill-rule="nonzero"
                                stroke="none"
                                stroke-width="1"
                                stroke-linecap="butt"
                                stroke-linejoin="miter"
                                stroke-miterlimit="10"
                                stroke-dasharray=""
                                stroke-dashoffset="0"
                                font-family="none"
                                font-weight="none"
                                font-size="none"
                                text-anchor="none"
                                style="mix-blend-mode: normal"
                            >
                                <g transform="scale(8.53333,8.53333)">
                                    <path
                                        d="M13,3c-0.26757,-0.00363 -0.52543,0.10012 -0.71593,0.28805c-0.1905,0.18793 -0.29774,0.44436 -0.29774,0.71195h-5.98633c-0.36064,-0.0051 -0.69608,0.18438 -0.87789,0.49587c-0.18181,0.3115 -0.18181,0.69676 0,1.00825c0.18181,0.3115 0.51725,0.50097 0.87789,0.49587h18c0.36064,0.0051 0.69608,-0.18438 0.87789,-0.49587c0.18181,-0.3115 0.18181,-0.69676 0,-1.00825c-0.18181,-0.3115 -0.51725,-0.50097 -0.87789,-0.49587h-5.98633c0,-0.26759 -0.10724,-0.52403 -0.29774,-0.71195c-0.1905,-0.18793 -0.44836,-0.29168 -0.71593,-0.28805zM6,8v16c0,1.105 0.895,2 2,2h14c1.105,0 2,-0.895 2,-2v-16z"
                                    ></path>
                                </g>
                            </g>
                        </svg>
                    </button>
                </p>
                <input
                    type="file"
                    @change="handleFileChange"
                    style="display: none"
                    ref="fileInput"
                />
                <button
                    v-if="!selectedFile"
                    class="btn"
                    @click="triggerFileInput"
                >
                    Selecciona un archivo
                </button>
                <button
                    v-if="selectedFile"
                    class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    @click="handleFileUploaded"
                >
                    Subir
                </button>
            </div>
        </div>
    </Modal>
</template>



<style>
.selected-file {
    width: 200px;
    display: flex;
    align-items: start;
    justify-content: space-around;
    background-color: white;
    padding: 10px;
    margin: 20px auto;
    border-radius: 5px;
    white-space: wrap; 
    overflow: hidden; 
    text-overflow: ellipsis; 
}

</style>