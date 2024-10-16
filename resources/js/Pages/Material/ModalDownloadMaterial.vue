<script setup>
import { computed, defineProps } from 'vue';
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
    purchaseorders: {
        type: Object,
        default: ([]),
    },
    orderTypes: {
        type: Array,
        default: ([]),
    },
    localCompanies: {
        type: Array,
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
                <div class="flex mt-3">
                    <div class="w-2/4 mr-2">
                        <InputLabel for="quantity" value="Orden de compra" />
                        <v-select v-model="store.formDown.purchaseorder_id" :options="purchaseorders" label="id" :reduce="purchaseorders => purchaseorders.id">
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    No se ha encontrado resultados para <em>{{ search }}</em>.
                                </template>
                                <em v-else style="opacity: 0.5">Empieza a escribir para buscar una orden de compra</em>
                            </template>
                        </v-select>
                    </div>
                    <div class="w-2/4 mr-2">
                        <InputLabel for="quantity" value="Empresa" />
                        <v-select v-model="store.formDown.purchaseorder_id" :options="localCompanies" label="name">
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    No se ha encontrado resultados para <em>{{ search }}</em>.
                                </template>
                                <em v-else style="opacity: 0.5">Empieza a escribir para buscar una orden de compra</em>
                            </template>
                        </v-select>
                    </div>
                </div>
                <div class="flex w-full mt-3">
                    <div class="w-1/2 mr-2">
                        <InputLabel for="" value="Subir comprobante" />
                        <Filepond @change="store.handleFile($event, 1)" allow-multiple="false" max-files="1" />
                    </div>
                    <div class="w-1/2">
                        <InputLabel for="" value="Fotografía de salida" />
                        <Filepond @change="store.handleFile($event, 2)" allow-multiple="false" max-files="1" />
                    </div>
                </div>
                <div class=" mt-3">
                    <InputLabel for="ordertype" value="Tipo de orden" />
                    <div class="flex bg-gray-50 p-1 rounded-md">
                        <label class="flex items-center">
                            <span v-for="item in orderTypes" :key="item.id" class="mr-3">
                                <input type="radio" :value="item" v-model="store.formDown.ordertype"
                                    class="cursor-pointer w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 focus:ring-gray-500" />
                                <span class="ms-1 text-sm text-gray-700">{{ item }}</span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="mt-3">
                    <InputLabel for="description" value="Nota" />
                    <textarea v-model="store.formDown.description" rows="3"
                        class="block w-full border-gray-300 rounded-md text-sm"></textarea>
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