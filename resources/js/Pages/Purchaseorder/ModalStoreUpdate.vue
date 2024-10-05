<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import AddButton from '@/Components/AddButton.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import { usePurchaseorderStore } from '@/Store/purchaseorder';
import { useProviderStore } from '@/Store/provider';
import ModalStoreProvider from '../Provider/ModalStoreProvider.vue';

let store = usePurchaseorderStore();
let store_provider = useProviderStore();
defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    materials: {
        type: Object,
        default: ([]),
    },
    providers: {
        type: Object,
        default: ([]),
    },
    users: {
        type: Object,
        default: ([]),
    },
    payment_conditions: {
        type: Array,
        default: ([]),
        //default: () => [],
    },
    maxWidth: {
        type: String,
        default: 'xl',
    },
});
</script>
<template>
    <DialogModal :show="show" :max-width="maxWidth" @close="store.closeModal">
        <template #title>{{ store.edit == '' ? 'Nuevo' : 'Actualizar' }} registro de {{store.isMessage }}</template>
        <template #content>
            <div class="mt-5">
                <form>
                    <div class="w-full">
                        <InputLabel for="name" value="Proveedor" />
                        <div class="flex">
                            <v-select v-model="store.form.provider_id" :options="providers" label="name" class="w-full">
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    No se ha encontrado resultados para <em>{{ search }}</em>.
                                </template>
                                <em v-else style="opacity: 0.5">Empieza a escribir para buscar un proveedor</em>
                            </template>
                        </v-select>
                        <AddButton v-tooltip="'Agregar nuevo material'" class="mr-2 self-center"
                            @click="store_provider.showStoreModal()">
                            <font-awesome-icon :icon="['fas', 'plus']" />
                        </AddButton>
                        </div>
                        <InputError class="" :message="store.form.errors.company_id" />
                    </div>
                    <div class="w-full mt-3">
                        <InputLabel for="name" value="Solicitado por" />
                        <v-select v-model="store.form.user_id" :options="users" label="name" :reduce="user => user.id">
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    No se ha encontrado resultados para <em>{{ search }}</em>.
                                </template>
                                <em v-else style="opacity: 0.5">Empieza a escribir para buscar quien solicita la orden
                                    de compra</em>
                            </template>
                        </v-select>
                        <InputError class="" :message="store.form.errors.name" />
                    </div>
                    <div class="w-full mt-3">
                        <InputLabel for="name" value="Autorizado por" />
                        <v-select v-model="store.form.user_id" :options="users" label="name" :reduce="user => user.id">
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    No se ha encontrado resultados para <em>{{ search }}</em>.
                                </template>
                                <em v-else style="opacity: 0.5">Empieza a escribir para buscar quien autoriza la orden
                                    de compra</em>
                            </template>
                        </v-select>
                        <InputError class="" :message="store.form.errors.name" />
                    </div>
                    <div class="mt-3">
                        <InputLabel for="description" value="Detalle de solicitud" />
                        <textarea v-model="store.form.description" rows="3"
                            class="block w-full border-gray-300 rounded-md text-sm"></textarea>
                    </div>
                    <div class="flex mt-3">
                        <div>
                            <label class="flex items-center">
                                <Checkbox />
                                <span class="ms-1 text-sm text-gray-700">PO</span>
                            </label>
                        </div>
                        <div class="ml-4">
                            <label class="flex items-center">
                                <Checkbox />
                                <span class="ms-1 text-sm text-gray-700">POP</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-end mt-3">
                        <PrimaryButton @click.prevent="store.showPivotModal()" :disabled="store.filledInputs">
                            <font-awesome-icon :icon="['fas', 'floppy-disk']" class="mr-1" />{{ store.edit == '' ?
                                'Guardar' : 'Actualizar' }} {{store.isMessage }}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </template>
    </DialogModal>
    <ModalStoreProvider :show="store_provider.openModal" :payment_conditions="payment_conditions" />
</template>