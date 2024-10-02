<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Filepond from '@/Components/Filepond.vue';
import { useMaterialStore } from '@/Store/material';

let store = useMaterialStore();
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
            Nuevo registro de {{store.isCatMessage }}
        </template>
        <template #content>
            <div class="mt-5">
                <form action="">
                    <div class="w-full">
                        <InputLabel for="name" value="Nombre" />
                        <TextInput v-model="store.formCat.name" class="w-full" type="text" />
                    </div>
                    <div class="w-full mt-3">
                        <InputLabel for="image" value="Subir imagen" />
                        <Filepond v-model="store.formCat.image" @change="store.handleFile($event)"
                            allow-multiple="false" max-files="1" />
                        <InputError class="" :message="store.formCat.errors.image" />
                    </div>
                    <div class="mt-3">
                        <InputLabel for="name" value="Descripción" />
                        <textarea v-model="store.formCat.description" rows="3"
                            class="block w-full border-gray-300 rounded-md text-sm"></textarea>
                    </div>
                    <div class="flex justify-end mt-3">
                        <PrimaryButton @click.prevent="store.storeCategory()">
                            <font-awesome-icon :icon="['fas', 'floppy-disk']" class="mr-1" />Guardar {{store.isCatMessage }}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </template>
    </DialogModal>
</template>