<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useProductStore } from '@/Store/product';

let store = useProductStore();
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
            Nuevo registro de {{store.isMessage }}
        </template>
        <template #content>
            <div class="">
                <form action="">
                    <div class="w-full">
                        <InputLabel for="name" value="Nombre" />
                        <TextInput v-model="store.form.name" class="w-full" type="text" />
                    </div>
                    <div class="mt-3">
                        <InputLabel for="name" value="Descripción" />
                        <textarea v-model="store.form.description" rows="3" class="block w-full border-gray-300 rounded-md text-sm"></textarea>
                    </div>
                    <div class="flex justify-end mt-3">
                        <PrimaryButton @click.prevent="store.storeProduct()">
                            <font-awesome-icon :icon="['fas', 'floppy-disk']" class="mr-1" />Guardar {{store.isMessage }}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </template>
    </DialogModal>
</template>