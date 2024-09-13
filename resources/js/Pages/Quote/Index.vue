<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import ModalStoreUpdate from './ModalStoreUpdate.vue';
import ModalStoreUpdateQD from './ModalStoreUpdateQD.vue';
import { useQuoteStore } from '@/Store/quote';
import ModalDelete from './ModalDelete.vue';

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
            <EasyDataTable :headers="store.headers" :rows-per-page="10" :items="quotes" border-cell buttons-pagination class="mt-5 " >
                <template #item-id="data">
                    {{ `${data.id}-${store.getYear}` }}
                </template>
                <template #item-report="data">
                    <font-awesome-icon :icon="['fas', 'file-pdf']" class="text-xl cursor-pointer text-red-500" />
                </template>
                <template #item-status="data">
                    <span class="bg-green-500 p-1 rounded-md">{{ data.status }}</span>
                </template>
                <template #item-options="options" class="flex justify-center">
                    <SecondaryButton class="mr-1" @click="store.editData(options)"><font-awesome-icon :icon="['fas', 'pen-to-square']" /></SecondaryButton>
                    <DangerButton @click="store.showDeleteModal(options)"><font-awesome-icon :icon="['fas', 'trash-can']" /></DangerButton>
                </template>
            </EasyDataTable>
        </div>
        <ModalStoreUpdate :show="store.openModal" :companies="companies" :users="users" :contacts="contacts"/>
        <ModalStoreUpdateQD :show="store.openModalQD" :quote="quote" :products="products"/>
        <ModalDelete :show="store.openDeleteModal"/>
    </AppLayout>
</template>
