<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useMaterialStore } from '@/Store/material';

let store = useMaterialStore();
defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    categories: {
        type: Object,
        default: ([]),
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
            Nuevo registro de tipo de material
        </template>
        <template #content>
            <div class="mt-3">
                <form action="">
                    <div class="w-full">
                        <InputLabel for="name" value="Nombre" />
                        <TextInput v-model="store.formType.name" class="w-full" type="text" />
                    </div>
                        <div class="w-full mt-3">
                            <InputLabel for="materialcategory_id" value="Categoría" />
                            <select v-model="categories.id" 
                                class="block w-full border-gray-300 rounded-l-md" disabled>
                                <option :value="categories.id">
                                    {{ categories.name }}
                                </option>
                            </select>
                        </div>
                    <div class="mt-3">
                        <InputLabel for="name" value="Descripción" />
                        <textarea v-model="store.formType.description" rows="3"
                            class="block w-full border-gray-300 rounded-md"></textarea>
                    </div>
                    <div class="flex justify-end mt-3">
                        <PrimaryButton @click.prevent="store.storeType(categories.id)">
                            <font-awesome-icon :icon="['fas', 'floppy-disk']" class="mr-1" />Guardar
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </template>
    </DialogModal>
</template>