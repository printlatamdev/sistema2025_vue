<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AddButton from '@/Components/AddButton.vue';
import SuccessButton from '@/Components/SuccessButton.vue';
import Filepond from '@/Components/Filepond.vue';
import ModalStoreUpdate from '../Product/ModalStoreUpdate.vue';
import InputError from '@/Components/InputError.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import { useQuoteStore } from '@/Store/quote';
import { useProductStore } from '@/Store/product';

let store_product = useProductStore();
let store = useQuoteStore();
defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '5xl',
    },
    quote: {
        type: Object,
        default: ([]),
    },
    products: {
        type: Object,
        default: ([]),
    },
});
</script>
<template>
    <DialogModal :show="show" :max-width="maxWidth" @close="store.closeModal">
        <template #title>
            <ActionMessage :on="store.formQD.recentlySuccessful || store.formTotal.recentlySuccessful" class="me-3">
                Agregado satisfactoriamente.
            </ActionMessage>
            <span v-if="store.edit != ''" class="p-1 bg-sky-500 rounded-md">#{{ `${store.edit.id}-${store.getYear}`
                }}</span>
            Detalle de Cotización
        </template>
        <template #content>
            <div class="w-1/2 flex justify-center mx-auto ">
                <ol
                    class="flex items-center justify-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg sm:text-base sm:p-4 sm:space-x-4 rtl:space-x-reverse">
                    <li class="flex items-center text-gray-600">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 border rounded-full shrink-0 border-gray-600">
                            1
                        </span>
                        Información <span class="hidden sm:inline-flex sm:ms-2">general</span>
                        <!--icon arrow here-->
                    </li>
                    <font-awesome-icon :icon="['fas', 'angles-left']" />
                    <li class="flex items-center text-blue-600">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 border rounded-full shrink-0 border-blue-600">
                            2
                        </span>
                        Detalle de cotización
                    </li>
                </ol>
            </div>
            <div class="mt-5">
                <form enctype="multipart/form-data">
                    <!--QUOTEDETAIL FORM-->
                    <div class="flex">
                        <div class="w-1/2">
                            <InputLabel for="product_id" value="Producto" />
                            <div class="flex"> 
                                <v-select v-model="store.formQD.product_id" :options="products" label="name" class="block  w-full"></v-select>
                                <AddButton v-tooltip="'Agregar nuevo producto'" class="mr-2 self-center"
                                    @click.prevent="store_product.showStoreModal()">
                                    <font-awesome-icon :icon="['fas', 'plus']" />
                                </AddButton>
                                <InputError class="" :message="store.form.errors.brand_id" />
                            </div>
                            <!--<select v-model="store.formQD.product_id"
                                class="block  w-full border-gray-300 rounded-l-md text-xs">
                                <option class="text-gray-500" disabledmount>Seleccione una opción</option>
                                <option v-for="product in products" :key="product.id" :value="product.id">
                                    {{ product.name }}
                                </option>
                            </select>-->
                        </div>
                        <div class="1/2 flex">
                            <div class="w-2/5 mr-1">
                                <InputLabel for="price" value="Precio" />
                                <TextInput v-model="store.formQD.price" class="w-full" type="text" />
                                <InputError class="" :message="store.formQD.errors.price" />
                            </div>
                            <div class="w-2/5 mr-1">
                                <InputLabel for="quantity" value="Cantidad" />
                                <TextInput v-model="store.formQD.quantity" class="w-full" type="text" />
                                <InputError class="" :message="store.formQD.errors.quantity" />
                            </div>
                            <div class="w-1/5 mr-1">
                                <InputLabel for="subtotal" value="Total" />
                                <TextInput disabled v-model="store.formQD.subtotal" :placeholder="store.getTotal"
                                    class="w-full" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="w-full mt-3 flex">
                        <div class="w-2/3 mr-3">
                            <InputLabel for="url" value="Descripción" />
                            <textarea v-model="store.formQD.details" rows="4"
                                class="block w-full border-gray-300 rounded-md"></textarea>
                        </div>
                        <div class="w-1/3">
                            <InputLabel for="image" value="Subir imagen" />
                            <Filepond v-model="store.formQD.image" @change="store.handleFile($event)"
                                allow-multiple="false" max-files="1" />
                            <InputError class="" :message="store.formQD.errors.image" />
                            <div class="flex justify-end mt-1">
                                <SuccessButton @click.prevent="store.storePivot(store.edit.id)">
                                    <font-awesome-icon :icon="['fas', 'plus']" class="mr-1" />Agregar ítem
                                </SuccessButton>
                            </div>
                        </div>
                    </div>
                </form>
                <hr class="my-5">
                <div class="w-full flex">
                    <div class="w-2/3 mr-3 mt-5">
                        <EasyDataTable :headers="store.headersQD" :rows-per-page="5" :items="store.edit.products"
                            border-cell buttons-pagination class="">
                            <template #item-name="data">
                                <img :src="data.image" class="w-12 h-10 rounded-md mt-1" />
                                {{ data.name }}
                            </template>
                        </EasyDataTable>
                    </div>
                    <div class="w-1/3 mt-5">
                        <form action="">
                            <div class="w-full mt-5">
                                <InputLabel for="iva" value="IVA" />
                                <select v-model="store.formTotal.iva" class="block w-full border-gray-300 rounded-md text-xs">
                                    <option class="text-gray-500" disabled>Seleccione una opción</option>
                                    <option v-for="i in store.iva" :key="i.id" :value="i.value">
                                        {{ i.name }}
                                    </option>
                                </select>
                                <div v-if="store.formTotal.iva == 'Other'" class="mt-3">
                                    <InputLabel for="iva" value="Asignar IVA" />
                                    <TextInput v-model="store.formTotal.iva2" class="w-full" type="text" />
                                </div>
                                <div class="border border-gray-300 bg-gray-50 mt-3 rounded-md p-5">
                                    <p><span class="font-semibold">Total parcial: </span>${{
                                        store.getCalc.total_pr.toFixed(2) }}</p>
                                    <p><span class="font-semibold">IVA:</span> ({{ store.formTotal.iva }}%) ${{
                                        store.getParcialSubtotal.toFixed(2) }}</p>
                                    <hr>
                                    <p class="mt-2"><span class="font-semibold">Total final: </span>${{
                                        store.getTotalIva.toFixed(2) }}</p>
                                </div>
                            </div>
                            <div class="flex justify-end mt-10">
                                <SecondaryButton class="mr-2" @click="store.editData(store.edit)">
                                    <font-awesome-icon :icon="['fas', 'arrow-left']" />Anterior
                                </SecondaryButton>
                                <PrimaryButton @click.prevent="store.storeQuoteDetail()">
                                    <font-awesome-icon :icon="['fas', 'floppy-disk']" class="mr-1" />Finalizar
                                    cotización
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </DialogModal>
    <ModalStoreUpdate :show="store_product.openModal" />
</template>