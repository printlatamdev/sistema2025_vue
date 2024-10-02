<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AddButton from '@/Components/AddButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { useOrderStore } from '@/Store/order';

let store = useOrderStore();
defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    materials: {
        type: Object,
        default: ([]),
    },
    maxWidth: {
        type: String,
        default: '5xl',
    },
});
</script>
<template>
    <DialogModal :show="show" :max-width="maxWidth" @close="store.closeModal">
        <template #title>Detalles orden de compra</template>
        <template #content>
            <div class="mt-5">
                
                <form>
                    <div class="flex">
                        <div class="w-1/2">
                            <InputLabel for="material_id" value="Material" />
                            <div class="flex"> 
                                <v-select v-model="store.formOD.material_id" :options="materials" label="name" class="block  w-full">
                                    <slot name="no-options">No se han encontrado resultados</slot>
                                </v-select>
                                <AddButton v-tooltip="'Agregar nuevo material'" class="mr-2 self-center">
                                    <font-awesome-icon :icon="['fas', 'plus']" />
                                </AddButton>
                                <InputError class="" :message="store.form.errors.material_id" />
                            </div>
                        </div>
                        <div class="1/2 flex">
                            <div class="w-2/5 mr-1">
                                <InputLabel for="price" value="Precio" />
                                <TextInput v-model="store.formOD.price" class="w-full" type="text" />
                                <InputError class="" :message="store.formOD.errors.price" />
                            </div>
                            <div class="w-2/5 mr-1">
                                <InputLabel for="quantity" value="Cantidad" />
                                <TextInput v-model="store.formOD.quantity" class="w-full" type="text" />
                                <InputError class="" :message="store.formOD.errors.quantity" />
                            </div>
                            <div class="w-1/5 mr-1">
                                <InputLabel for="subtotal" value="Total" />
                                <TextInput disabled v-model="store.formOD.subtotal" :placeholder="store.getTotal"
                                    class="w-full" type="text" />
                            </div>
                        </div>
                    </div>
                    
                    <!--<div class="w-full mr-3 mt-5">
                        <EasyDataTable :headers="store.headersOD" :rows-per-page="5" :items="store.edit.materials"
                            border-cell buttons-pagination class="">
                            <template #empty-message>
                                <p>No se ha encontrado ningún resultado</p>
                            </template>
                        </EasyDataTable>
                    </div>-->
                </form>
            </div>
        </template>
    </DialogModal>
</template>