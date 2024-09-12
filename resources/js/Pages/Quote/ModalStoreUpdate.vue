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
    companies: {
        type: Object,
        default: ([]),
    },
    users: {
        type: Object,
        default: ([]),
    },
    contacts: {
        type: Object,
        default: ([]),
    },
});
</script>
<template>

    <DialogModal :show="show" :max-width="maxWidth" @close="store.closeModal">
        <template #title>Nuevo registro de Cotización</template>
        <template #content>
            <div class="w-1/2 flex justify-center mx-auto ">
                <ol
                    class="flex items-center justify-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg sm:text-base sm:p-4 sm:space-x-4 rtl:space-x-reverse">
                    <li class="flex items-center text-blue-600">
                        <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border rounded-full shrink-0 border-blue-600">
                            1
                        </span>
                        Información <span class="hidden sm:inline-flex sm:ms-2">general</span>
                    </li>
                    <font-awesome-icon :icon="['fas', 'angles-right']" />
                    <li class="flex items-center text-gray-600">
                        <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border rounded-full shrink-0 border-gray-600">
                            2
                        </span>
                        Detalle de cotización
                    </li>
                </ol>
            </div>
            <div class="mt-5">
                <form @submit.prevent="store.storeQuote()">
                    <!--QUOTE FORM-->
                        <div class="flex">
                            <div class="w-1/3 mr-1">
                                <InputLabel for="company_id" value="Cliente" />
                                <select v-model="store.form.company_id"
                                    class="text-xs block  w-full border-gray-300 rounded-md">
                                    <option class="text-gray-500"> Seleccione una opción</option>
                                    <option v-for="company in companies" :key="company.id" :value="company.id">
                                        {{ company.social_reason }}
                                    </option>
                                </select>
                            </div>
                            <div class="w-1/3">
                                <InputLabel for="contact_id" value="Contacto" />
                                <select v-model="store.form.contact_id"
                                    class="text-xs block  w-full border-gray-300 rounded-md">
                                    <option class="text-gray-500"> Seleccione una opción</option>
                                    <option v-for="contact in contacts" :key="contact.id" :value="contact.id">
                                        {{ contact.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="w-1/3">
                                <InputLabel for="user_id" value="Vendedor" />
                                <select v-model="store.form.user_id"
                                    class="text-xs block  w-full border-gray-300 rounded-md">
                                    <option class="text-gray-500"> Seleccione una opción</option>
                                    <option v-for="user in users" :key="user.id" :value="user.id">
                                        {{ user.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!--second form-->
                        <div class="flex mt-3">
                            <div class="w-1/4 mr-1">
                                <InputLabel for="payment_condition" value="Condiciones de pago" />
                                <select v-model="store.form.payment_condition"
                                    class="text-xs block  w-full border-gray-300 rounded-md">
                                    <option class="text-gray-500"> Seleccione una opción</option>
                                    <option v-for="payment in store.payment_condition" :key="payment.id"
                                        :value="payment.value">
                                        {{ payment.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="w-1/4 mr-1">
                                <InputLabel for="offer_validity" value="Validez de oferta" />
                                <select v-model="store.form.offer_validity"
                                    class="text-xs block  w-full border-gray-300 rounded-md">
                                    <option class="text-gray-500"> Seleccione una opción</option>
                                    <option v-for="offer in store.offer_validity" :key="offer.id" :value="offer.value">
                                        {{ offer.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="w-1/4 mr-1">
                                <InputLabel for="currency" value="Moneda" />
                                <select v-model="store.form.currency"
                                    class="text-xs block  w-full border-gray-300 rounded-md">
                                    <option class="text-gray-500"> Seleccione una opción</option>
                                    <option v-for="currency in store.currency" :key="currency.id"
                                        :value="currency.value">
                                        {{ currency.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="w-1/4 mr-1">
                                <InputLabel for="incoterm" value="Términos de comercio" />
                                <select v-model="store.form.incoterm"
                                    class="text-xs block  w-full border-gray-300 rounded-md">
                                    <option class="text-gray-500"> Seleccione una opción</option>
                                    <option v-for="incoterm in store.incoterm" :key="incoterm.id"
                                        :value="incoterm.value">
                                        {{ incoterm.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-3">
                            <InputLabel for="address" value="Observaciones" />
                            <textarea rows="4" class="block w-full border-gray-300 text-gray-500 rounded-md text-xs"
                                disabled>
                                Los Impuestos, seguros y operaciones están sujetos a cambios | Precio no incluye: custodio, cuadrilla de descarga, revisiones en frontera, almacenajes. | Estadías por retraso, error en dirección de entrega, y/o entregas adicionales serán facturadas al finalizar el servicio | Recargos por demoras del tramitador del cliente serán facturados al cliente.
                            </textarea>
                        </div>
                    <div class="flex justify-end mt-3">
                        <PrimaryButton>Guardar datos</PrimaryButton>
                    </div>
                </form>
            </div>
        </template>
    </DialogModal>
</template>