<script setup>
import vueFilePond from "vue-filepond";
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";

/**const FilePond = vueFilePond(
  FilePondPluginImagePreview
); */
const FilePond = vueFilePond(
  FilePondPluginFileValidateType,
);
</script>
<template>
    <file-pond
        class-name="my-pond"
        label-idle="Seleccionar un archivo"
        allow-multiple="false"
        accepted-file-types="image/jpeg, image/png, application/pdf"
        class="cursor-pointer text-xs"
        instant-upload="false"
    />
</template>