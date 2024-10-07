<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { usePurchaseorderStore } from '@/Store/purchaseorder';
import ModalStoreUpdate from './ModalStoreUpdate.vue';
import ModalPivotOrderMaterial from './ModalPivotOrderMaterial.vue';

let store = usePurchaseorderStore();
defineProps({
    purchaseorders: {
        type: Object,
        default: ([]),
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
    requestedBy: {
        type: Object,
        default: ([]),
    },
    approvedBy: {
        type: Object,
        default: ([]),
    },
    payment_conditions: {
        type: Array,
        default: ([]),
    },
    orderTypes: {
        type: Array,
        default: ([]),
    },
});

</script>

<template>
    <AppLayout title="Ordenes de compra">
        <div class="w-full">
            <h2 class="text-3xl font-bold">Datos de {{ store.isMessage }}</h2>
            <div class="flex justify-end">
                <PrimaryButton @click="store.showStoreModal()">
                    <font-awesome-icon :icon="['fas', 'plus']" class="mr-1"/>Nueva {{ store.isMessage }}
                </PrimaryButton>
            </div>
            <EasyDataTable :headers="store.headers" :rows-per-page="10" :items="purchaseorders" border-cell buttons-pagination class="mt-5"> 
                <template #empty-message>
                    <p>No se ha encontrado ningún resultado</p>
                </template>
                <template #item-options="options" class="flex justify-center">
                    <SecondaryButton class="mr-1" @click="store.editData(options)" v-tooltip="'Actualizar orden'">
                        <font-awesome-icon :icon="['fas', 'pen-to-square']" />
                    </SecondaryButton>
                    <DangerButton @click="store.showDeleteModal(options)" v-tooltip="'Eliminar orden'">
                        <font-awesome-icon :icon="['fas', 'trash-can']" />
                    </DangerButton>
                </template>
            </EasyDataTable>
        </div>
        <ModalStoreUpdate :show="store.openModal" :providers="providers" :requestedBy="requestedBy" :approvedBy="approvedBy"  :payment_conditions="payment_conditions" :orderTypes="orderTypes"/>
        <ModalPivotOrderMaterial :show="store.openPivotModal" :materials="materials" :users="users" />
    </AppLayout>
</template>
