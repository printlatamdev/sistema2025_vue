<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import FilepondImage from '@/Components/FilepondImage.vue';
import { useCountryStore } from '@/Store/country';

let store = useCountryStore();
defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: 'md',
    },
});

</script>
<template>
    <DialogModal :show="show" @close="store.closeModal" :max-width="maxWidth">
        <template #title>
            Nuevo registro de  {{store.isMessage }}
        </template>
        <template #content>
            {{ store.form }}
            <div class="">
                <form action="" enctype="multipart/form-data">
                    <div class="w-full">
                        <InputLabel for="name" value="Nombre" />
                        <TextInput v-model="store.form.name" class="w-full" type="text" />
                        <InputError class="" :message="store.form.errors.name" />
                    </div>
                    <div class="w-full mt-3">
                        <InputLabel for="acronym" value="Siglas" />
                        <TextInput v-model="store.form.acronym" class="w-full" type="text" />
                        <InputError class="" :message="store.form.errors.acronym" />
                    </div>
                    <div class="w-full mt-3">
                        <InputLabel for="image" value="Subir imagen" />
                        <FilepondImage v-model="store.form.image" @change="store.handleFile($event)"
                            allow-multiple="false" max-files="1" />
                        <InputError class="" :message="store.form.errors.image" />
                    </div>
                    <div class="flex justify-end mt-3">
                        <PrimaryButton @click.prevent="store.storeCountry()" :disabled="store.filledInputs">
                            <font-awesome-icon :icon="['fas', 'floppy-disk']" class="mr-1" />Guardar {{store.isMessage }}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </template>
    </DialogModal>
</template>