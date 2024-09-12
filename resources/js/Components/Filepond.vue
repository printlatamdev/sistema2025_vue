<script setup>
import vueFilePond from "vue-filepond";
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';


const FilePond = vueFilePond(
  FilePondPluginImagePreview
);
</script>
<template>
    <file-pond
        class-name="my-pond"
        label-idle="Seleccionar imagen"
        allow-multiple="false"
        class="cursor-pointer text-xs"
    />
</template>