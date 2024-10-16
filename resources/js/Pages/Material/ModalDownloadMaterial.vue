<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Filepond from '@/Components/Filepond.vue';
import TextInput from '@/Components/TextInput.vue';
import { useMaterialStore } from '@/Store/material';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import WarningButton from '@/Components/WarningButton.vue';

let store = useMaterialStore();
defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    materials: {
        type: Object,
        default: ([]),
    },
    categories: {
        type: Object,
        default: ([]),
    },
});

</script>
<template>
    <DialogModal :show="show" @close="store.closeModal" :max-width="maxWidth">
        <template #title>
            Descarga ingreso de {{ categories.id != 1 ? store.isMessage : 'Tinta' }}
        </template>
        <template #content>
            <form action="">
                <div class="flex">
                    <div class="w-3/4 mr-2">
                        <InputLabel v-model="store.formDown.material_id" for="material_id" value="Material" />
                        <v-select :options="materials" :reduce="materials => materials.id" label="name">
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    No se ha encontrado resultados para <em>{{ search }}</em>.
                                </template>
                                <em v-else style="opacity: 0.5">Empieza a escribir para buscar un material</em>
                            </template>
                        </v-select>
                    </div>
                    <div class="w-1/4">
                        <InputLabel for="quantity" value="Cantidad" />
                        <TextInput v-model="store.formDown.quantity" class="w-full" type="text" />
                    </div>
                </div>
                <div class="flex justify-end mt-7">
                    <PrimaryButton @click.prevent="store.entryMaterial()">
                        <font-awesome-icon :icon="['fas', 'floppy-disk']" class="mr-1" />Guardar {{ store.isMessage }}
                    </PrimaryButton>
                </div>
            </form>
        </template>
    </DialogModal>
</template>