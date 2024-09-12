<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ModalStoreUpdate from './ModalStoreUpdate.vue';
import ModalStoreUpdateQD from './ModalStoreUpdateQD.vue';
import { useQuoteStore } from '@/Store/quote';

let store = useQuoteStore();
defineProps({
    quotes: {
        type: Object,
        default: ([]),
    },
    quotedetails: {
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
    companies: {
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
    <AppLayout title="Cotizaciones">
        <div class="w-full">
            <h2 class="text-2xl font-semibold">Datos de Cotizaciones</h2>
            <div class="flex justify-end">
                <PrimaryButton @click="store.showStoreModal()">Nueva Cotización</PrimaryButton>
            </div>
            <EasyDataTable :headers="store.headers" :items="quotes" border-cell buttons-pagination class="mt-5" />
        </div>
        <ModalStoreUpdate :show="store.openModal" :companies="companies" :users="users" :contacts="contacts"/>
        <ModalStoreUpdateQD :show="store.openModalQD" :quote="quote" :products="products"/>
    </AppLayout>
</template>
