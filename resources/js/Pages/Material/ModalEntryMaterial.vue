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
    providers: {
        type: Object,
        default: ([]),
    },
    materials: {
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
            Nuevo ingreso de {{ store.isMessage }}
        </template>
        <template #content>
            <div class="mt-3">
                <form action="">
                    <div class="">
                        <InputLabel for="name" value="Orden de compra" />
                        <TextInput class="w-full" type="text" />
                    </div>
                    <div class="">
                        <InputLabel for="provider_id" value="Proveedor" />
                        <v-select :options="store.providers" :reduce="provider=>provider.id" label="name">
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    No se ha encontrado resultados para <em>{{ search }}</em>.
                                </template>
                                <em v-else style="opacity: 0.5">Empieza a escribir para buscar un proveedor</em>
                            </template>
                        </v-select>
                    </div>
                    <div class="">
                        <InputLabel for="material_id" value="Material" />
                        <v-select :options="store.materials" :reduce="providers=>providers.id" label="name">
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    No se ha encontrado resultados para <em>{{ search }}</em>.
                                </template>
                                <em v-else style="opacity: 0.5">Empieza a escribir para buscar un material</em>
                            </template>
                        </v-select>
                    </div>
                    <div class="">
                        <InputLabel for="quantity" value="Cantidad" />
                        <TextInput class="w-full" type="text" />
                    </div>
                    <div class="">
                        <InputLabel for="" value="Orden de compra" />
                        <TextInput class="w-full" type="text" />
                    </div>
                    <div class="">
                        <InputLabel for="" value="Factura" />
                        <TextInput class="w-full" type="text" />
                    </div>
                    <div class="">
                        <InputLabel for="description" value="Descripción" />
                        <textarea v-model="store.form.description" rows="3"
                            class="block w-full border-gray-300 rounded-md text-sm"></textarea>
                    </div>
                    <div class="flex justify-end mt-3">
                        <PrimaryButton @click.prevent="store.entryMaterial()">
                            <font-awesome-icon :icon="['fas', 'floppy-disk']" class="mr-1" />Guardar {{store.isMessage }}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </template>
    </DialogModal>
</template>