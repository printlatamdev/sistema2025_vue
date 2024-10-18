<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AddButton from '@/Components/AddButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import SuccessButton from '@/Components/SuccessButton.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import ModalStoreUpdateMaterial from '../Material/ModalStoreUpdateMaterial.vue';
import { usePurchaseorderStore } from '@/Store/purchaseorder';
import { useMaterialStore } from '@/Store/material';

let store_material = useMaterialStore();
let store = usePurchaseorderStore();
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
        <template #title>Detalles orden de compra <span class="bg-teal-200 rounded-md px-2">#{{ store.edit.id }}</span></template>
        <template #alert>
            <ActionMessage :on="store.formOD.recentlySuccessful || store.formMail.recentlySuccessful">
                <font-awesome-icon :icon="['fas', 'circle-check']" class="mr-2"/>{{ store.formOD.recentlySuccessful ? 'Material agregado satisfactoriamente' : 'Se ha envíado el correo satisfactoriamente' }}
            </ActionMessage>
        </template>
        <template #content>
            <div class="">
                <form>
                    <div class="flex">
                        <div class="w-2/5">
                            <InputLabel for="material_id" value="Material" />
                            <div class="w-full flex">
                                <v-select v-model="store.formOD.material_id" class="w-full" :options="materials"
                                    label="name" :reduce="materials => materials.id">
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
                            <div class="w-1/3 mr-2">
                                <InputLabel for="price" value="Precio" />
                                <TextInput v-model="store.formOD.price" class="w-full" type="text" />
                                <InputError class="" :message="store.formOD.errors.price" />
                            </div>
                            <div class="w-1/3 mr-2">
                                <InputLabel for="quantity" value="Cantidad" />
                                <TextInput v-model="store.formOD.quantity" class="w-full" type="text" />
                                <InputError class="" :message="store.formOD.errors.quantity" />
                            </div>
                            <div class="w-1/3 mr-2">
                                <InputLabel for="subtotal" value="Total" />
                                <TextInput disabled v-model="store.formOD.subtotal" :placeholder="store.getTotal"
                                    class="w-full" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mt-3 w-2/3 mr-3">
                            <InputLabel for="details" value="Detalles de orden" />
                            <textarea v-model="store.formOD.details" rows="3"
                                class="block w-full border-gray-300 rounded-md text-sm"></textarea>
                        </div>
                        <div class="mt-5 w-1/3">
                            <InputLabel for="iva" value="IVA" />
                            <select v-model="store.formOD.iva" class="block w-full border-gray-300 rounded-md text-xs">
                                <option class="text-gray-500" disabled>Seleccione una opción</option>
                                <option v-for="i in store.iva" :key="i.id" :value="i.value">
                                    {{ i.name }}
                                </option>
                            </select>
                            <div class="mt-3">
                                <PrimaryButton class="w-full" @click.prevent="store.storePivot(store.edit.id)"
                                    :disabled="store.filledInputsOD">
                                    <font-awesome-icon :icon="['fas', 'plus']" class="mr-1" /> Agregar ítem
                                </PrimaryButton>
                            </div>
                        </div>
                    </div>
                </form>
                <hr class="mt-7">
                <div class="w-full flex mt-7">
                    <div class="w-3/5 mr-3">
                        <EasyDataTable :headers="store.headersOD" :rows-per-page="9" :items="store.edit.materials"
                            border-cell buttons-pagination hide-footer class="">
                            <template #empty-message>
                                <p>No se ha encontrado ningún resultado</p>
                            </template>
                        </EasyDataTable>
                        <div class="border py-1 px-2 border-y-0 flex justify-end">
                            <div class="text-sm">
                                <p><span class="font-semibold">Subtotal:</span> ${{
                                    store.purchaseorder.total_materials }}</p>
                                <p><span class="font-semibold">IVA:</span> ${{ store.purchaseorder.iva }}</p>
                                <p><span class="font-semibold">Costo total:</span> ${{
                                    store.purchaseorder.total }}</p>
                            </div>
                        </div>
                        <div class="border text-xs p-1"><span class="font-semibold">*Nota: </span>No se podrán
                            ingresar
                            más de 9 ítems</div>

                        <div class="flex justify-end mt-5">
                            <SuccessButton @click="">
                                <font-awesome-icon :icon="['fas', 'file-pdf']" /> Generar reporte para la orden #{{ store.edit.id }}
                            </SuccessButton>
                            <!--<SecondaryButton class="mr-1" @click="">
                                <font-awesome-icon :icon="['fas', 'file-pdf']" /> Generar orden sin IVA
                            </SecondaryButton>-->
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg ml-3 w-2/5 p-7">
                        <h3 class="text-lg font-semibold">Detalle de correo de notificación</h3>
                        <form action="">
                            <div class="mt-5">
                                <InputLabel for="user_id" value="Seleccionar destinatarios" />
                                <div style="background: white;">
                                    <v-select v-model="store.formMail.users" :options="users" label="email"
                                        class="block w-full" multiple :reduce="user => user.email">
                                        <template v-slot:no-options="{ search, searching }">
                                            <template v-if="searching">
                                                No se ha encontrado resultados para <em>{{ search }}</em>.
                                            </template>
                                            <em v-else style="opacity: 0.5">Empieza a escribir para buscar el o los
                                                destinatarios</em>
                                        </template>
                                    </v-select>
                                </div>
                            </div>
                            <div class="mt-3">
                                <InputLabel for="title" value="Título de correo" />
                                <TextInput v-model="store.formMail.title" class="w-full" type="text" />
                            </div>
                            <div class="mt-3">
                                <InputLabel for="body" value="Cuerpo de correo" />
                                <ckeditor v-model="store.formMail.body" :editor="store.editor"
                                    :config="store.editorConfig" />
                            </div>
                            <div class="flex justify-end mt-7">
                                <PrimaryButton class="mr-1 w-full" :disabled="store.purchaseorder.report==null" @click.prevent="store.sendPurchaseOrder(store.edit.id)"
                                    v-tooltip="'Debe generar la orden para habilitar el envío de correo electrónico'">
                                    <font-awesome-icon :icon="['fas', 'envelope']" class="mr-1" /> Envíar correo
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div><br>
            </div>
        </template>
    </DialogModal>
    <ModalStoreUpdateMaterial :show="store_material.openModal" />
</template>