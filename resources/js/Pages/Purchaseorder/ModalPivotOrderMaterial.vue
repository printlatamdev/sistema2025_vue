<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AddButton from '@/Components/AddButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import SuccessButton from '@/Components/SuccessButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import ModalStoreUpdateMaterial from '../Material/ModalStoreUpdateMaterial.vue';
import { useOrderStore } from '@/Store/order';
import { useMaterialStore } from '@/Store/material';

let store_material = useMaterialStore();
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
    users: {
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
                        <div class="w-2/5">
                            <InputLabel for="material_id" value="Material" />
                            <div class="w-full flex">
                                <v-select v-model="store.formOD.material_id" class="w-full" :options="materials"
                                    label="name" :reduce="material => material.id">
                                    <template v-slot:no-options="{ search, searching }">
                                        <template v-if="searching">
                                            No se ha encontrado resultados para <em>{{ search }}</em>.
                                        </template>
                                        <em v-else style="opacity: 0.5">Empieza a escribir para buscar un material</em>
                                    </template>
                                </v-select>
                                <AddButton v-tooltip="'Agregar nuevo material'" class="mr-2 self-center"
                                    @click="store_material.showStoreModal()">
                                    <font-awesome-icon :icon="['fas', 'plus']" />
                                </AddButton>
                                <InputError class="" :message="store.form.errors.material_id" />
                            </div>
                        </div>
                        <div class="w-3/5 flex">
                            <div class="w-1/4 mr-1">
                                <InputLabel for="price" value="Precio" />
                                <TextInput v-model="store.formOD.price" class="w-full" type="text" />
                                <InputError class="" :message="store.formOD.errors.price" />
                            </div>
                            <div class="w-1/4 mr-1">
                                <InputLabel for="quantity" value="Cantidad" />
                                <TextInput v-model="store.formOD.quantity" class="w-full" type="text" />
                                <InputError class="" :message="store.formOD.errors.quantity" />
                            </div>
                            <div class="w-1/4 mr-1">
                                <InputLabel for="subtotal" value="Total" />
                                <TextInput disabled v-model="store.formOD.subtotal" :placeholder="store.getTotal"
                                    class="w-full" type="text" />
                            </div>
                            <div class="w-1/4 self-end">
                                <PrimaryButton class="mr-1" @click="store.editData(options)">
                                    <font-awesome-icon :icon="['fas', 'envelope']" class="mr-1" /> Agregar ítem
                                </PrimaryButton>
                            </div>
                        </div>
                    </div>

                    <div class="w-full flex">
                        <div class="w-3/5 mr-3 mt-5">
                            <p>lorem</p>
                            <EasyDataTable :headers="store.headersOD" :rows-per-page="5" :items="store.edit.materials"
                            border-cell buttons-pagination class="">
                            <template #empty-message>
                                <p>No se ha encontrado ningún resultado</p>
                            </template>
                        </EasyDataTable>
                        </div>
                        <div class="bg-gray-50 rounded-lg mt-7 w-2/5 p-5">
                            <h3 class="text-lg font-semibold">Detalle de correo de notificación</h3>
                            <div class="mt-5">
                                <InputLabel for="user_id" value="Seleccionar destinatarios" />

                                <div style="background: white;">
                                    <v-select v-model="store.formOD.user_id" :options="users" label="email"
                                        class="block w-full" multiple :reduce="user => user.id">
                                        <template v-slot:no-options="{ search, searching }">
                                            <template v-if="searching">
                                                No se ha encontrado resultados para <em>{{ search }}</em>.
                                            </template>
                                            <em v-else style="opacity: 0.5">Empieza a escribir para buscar el o los destinatarios</em>
                                        </template>
                                    </v-select>
                                </div>
                            </div>
                            <div class="mt-3">
                                <InputLabel for="subject" value="Título de correo" />
                                <TextInput v-model="store.formOD.subject" class="w-full" type="text" />
                            </div>
                            <div class="mt-3">
                                <InputLabel for="user_id" value="Cuerpo de correo" />
                                <ckeditor v-model="store.editorData" :editor="store.editor"
                                    :config="store.editorConfig" />
                            </div>
                            <div class="flex justify-end mt-7">
                                <SuccessButton class="mr-1" @click="">
                                    <font-awesome-icon :icon="['fas', 'file-pdf']" /> Generar orden
                                </SuccessButton>
                                <SecondaryButton class="mr-1" @click="">
                                    <font-awesome-icon :icon="['fas', 'file-pdf']" /> Generar orden sin IVA
                                </SecondaryButton>
                                <PrimaryButton class="mr-1" @click="store.editData(options)" disabled
                                    v-tooltip="'Debe generar la orden para habilitar el envío de correo electrónico'">
                                    <font-awesome-icon :icon="['fas', 'envelope']" class="mr-1" /> Envíar correo
                                </PrimaryButton>
                            </div>
                        </div>
                    </div>
                </form><br>
            </div>
        </template>
    </DialogModal>
    <ModalStoreUpdateMaterial :show="store_material.openModal" />
</template>