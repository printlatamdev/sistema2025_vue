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
    requestedBy: {
        type: Object,
        default: ([]),
    },
    approvedBy: {
        type: Object,
        default: ([]),
    },
    orderTypes: {
        type: Array,
        default: ([]),
    },
    payment_conditions: {
        type: Array,
        default: ([]),
    },
    maxWidth: {
        type: String,
        default: 'xl',
    },
});
</script>
<template>
    <DialogModal :show="show" :max-width="maxWidth" @close="store.closeModal">
        <template #title>{{ store.edit == '' ? 'Nuevo' : 'Actualizar' }} registro de {{ store.isMessage }}</template>
        <template #content>
            <div class="">
                <form>
                    <div class="w-full">
                        <InputLabel for="name" value="Proveedor" />
                        <div class="flex">
                            <v-select v-model="store.form.provider_id" :options="providers" label="name"
                                :reduce="providers => providers.id" class="w-full">
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
                    <div class="flex">
                        <div class="w-full mt-3 mr-2">
                            <InputLabel for="name" value="Solicitado por" />
                            <v-select v-model="store.form.requestedBy" :options="requestedBy" label="name"
                                :reduce="user => user">
                                <template v-slot:no-options="{ search, searching }">
                                    <template v-if="searching">
                                        No se ha encontrado resultados para <em>{{ search }}</em>.
                                    </template>
                                    <em v-else style="opacity: 0.5">Empieza a escribir para buscar quien solicita la
                                        orden de compra</em>
                                </template>
                            </v-select>
                            <InputError class="" :message="store.form.errors.name" />
                        </div>
                        <div class="w-full mt-3">
                            <InputLabel for="name" value="Autorizado por" />
                            <v-select v-model="store.form.approvedBy" :options="approvedBy" label="name"
                                :reduce="user => user">
                                <template v-slot:no-options="{ search, searching }">
                                    <template v-if="searching">
                                        No se ha encontrado resultados para <em>{{ search }}</em>.
                                    </template>
                                    <em v-else style="opacity: 0.5">Empieza a escribir para buscar quien autoriza la
                                        orden de compra</em>
                                </template>
                            </v-select>
                            <InputError class="" :message="store.form.errors.name" />
                        </div>
                    </div>
                    <div class="mt-3">
                        <InputLabel for="details" value="Detalle de solicitud" />
                        <textarea v-model="store.form.details" rows="3"
                            class="block w-full border-gray-300 rounded-md text-sm"></textarea>
                    </div>
                    <div class="flex mt-3">
                        <label class="flex items-center">
                            <span v-for="item in orderTypes" :key="item.id" class="mr-3">
                                <input type="radio" :value="item" v-model="store.form.ordertype"
                                    class="cursor-pointer w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 focus:ring-gray-500" />
                                <span class="ms-1 text-sm text-gray-700">{{ item }}</span>
                            </span>
                        </label>
                    </div>
                    <div class="flex justify-end mt-3">
                        <PrimaryButton @click.prevent="store.storeOrder(store.edit.id)" :disabled="store.filledInputs">
                            <font-awesome-icon :icon="['fas', 'floppy-disk']" class="mr-1" />{{ store.edit == '' ?
                                'Guardar' : 'Actualizar' }} {{ store.isMessage }}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </template>
    </DialogModal>
    <ModalStoreProvider :show="store_provider.openModal" :payment_conditions="payment_conditions" />
</template>