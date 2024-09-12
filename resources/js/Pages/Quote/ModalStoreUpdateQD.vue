<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Filepond from '@/Components/Filepond.vue';
import { useQuoteStore } from '@/Store/quote';

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
            <span v-if=" store.edit != ''" class="p-1 bg-sky-500 rounded-md">#{{ `${store.edit.id}-${store.getYear}` }}</span> 
            Nuevo registro de Cotización
        </template>
        <template #content>
            <div class="w-1/2 flex justify-center mx-auto ">
                <ol
                    class="flex items-center justify-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg sm:text-base sm:p-4 sm:space-x-4 rtl:space-x-reverse">
                    <li class="flex items-center text-gray-600">
                        <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border rounded-full shrink-0 border-gray-600">
                            1
                        </span>
                        Información <span class="hidden sm:inline-flex sm:ms-2">general</span>
                        <!--icon arrow here-->
                    </li>
                    <font-awesome-icon :icon="['fas', 'angles-left']" />
                    <li class="flex items-center text-blue-600">
                        <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border rounded-full shrink-0 border-blue-600">
                            2
                        </span>
                        Detalle de cotización
                    </li>
                </ol>
            </div>
            <div class="mt-5">
                <form @submit.prevent="store.storeQuote()">
                    <!--QUOTEDETAIL FORM-->
                    <form action="">
                        <div class="flex">
                            <div class="w-1/2 mr-1">
                                <InputLabel for="product_id" value="Producto" />
                                <select v-model="store.formQD.product_id"
                                    class="text-xs block  w-full border-gray-300 rounded-md">
                                    <option class="text-gray-500">Seleccione una opción</option>
                                    <option v-for="product in products" :key="product.id" :value="product.id">
                                        {{ product.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="1/2 flex">
                                <div class="w-2/5 mr-1">
                                    <InputLabel for="price" value="Precio" />
                                    <TextInput v-model="store.formQD.price" class="w-full" type="text" />
                                </div>
                                <div class="w-2/5 mr-1">
                                    <InputLabel for="quantity" value="Cantidad" />
                                    <TextInput v-model="store.formQD.quantity" class="w-full" type="text" />
                                </div>
                                <div class="w-1/5 mr-1">
                                    <InputLabel for="subtotal" value="Total" />
                                    <TextInput disabled v-model="store.formQD.subtotal" :placeholder="store.getSubtotal"
                                        class="w-full" type="text" />
                                </div>
                                <div class="flex justify-end mt-3" @click="store.storeInLS()">
                                    <SecondaryButton>+</SecondaryButton>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <InputLabel for="url" value="Descripción" />
                            <textarea v-model="store.formQD.details" rows="3"
                                class="block text-xs w-full border-gray-300 rounded-md"></textarea>
                        </div>
                        <div class="w-full mt-3 flex items-center">
                            <div class="w-1/3">
                                <InputLabel for="url" value="Subir imagen" />
                                <Filepond v-model="store.formQD.url" @change="handleFile($event)" allow-multiple="false"
                                    max-files="1" />
                            </div>
                            <div class="w-2/3 ml-2">
                                <EasyDataTable :headers="store.headersQD" :rows-per-page="5" :items="store.tempQuotedetails" border-cell
                                    buttons-pagination class="mt-5" />
                            </div>
                        </div>
                    </form>
                    <div class="flex justify-end mt-3">
                        <SecondaryButton class="mr-2" @click="store.editData()">
                            <font-awesome-icon :icon="['fas', 'arrow-left']" />Anterior
                        </SecondaryButton>
                        <PrimaryButton>Guardar</PrimaryButton>
                    </div>
                </form>
            </div>
        </template>
    </DialogModal>
</template>