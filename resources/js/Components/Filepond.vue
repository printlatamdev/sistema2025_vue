<script>
// Import Vue FilePond
import vueFilePond from "vue-filepond";

// Import FilePond styles
import "filepond/dist/filepond.min.css";

// Import FilePond plugins
// Please note that you need to install these plugins separately

// Import image preview plugin styles
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";

// Import image preview and file type validation plugins
import FilePondPluginImagePreview from "filepond-plugin-image-preview";

// Create component
const FilePond = vueFilePond(
    FilePondPluginImagePreview
);

export default {
    name: "app",
    methods: {
        handleFilePondInit: function () {
            console.log("FilePond has initialized");

            // FilePond instance methods are available on `this.$refs.pond`
        },
    },
    components: {
        FilePond,
    },
};
</script>
<template>
    <div id="app">
        <file-pond name="test" ref="pond" label-idle="Seleccione la imagen" v-bind:allow-multiple="true"
            accepted-file-types="image/jpeg, image/png" server="/api" v-bind:files="myFiles"
            v-on:init="handleFilePondInit" />
    </div>
</template>