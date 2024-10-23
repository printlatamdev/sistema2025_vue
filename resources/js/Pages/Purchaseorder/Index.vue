<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { usePurchaseorderStore } from '@/Store/purchaseorder';
import ModalStoreUpdate from './ModalStoreUpdate.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import WarningButton from '@/Components/WarningButton.vue';
import ModalPivotOrderMaterial from './ModalPivotOrderMaterial.vue';

let store = usePurchaseorderStore();
defineProps({
    purchaseorders: {
        type: Object,
        default: ([]),
    },
    purchaseorderdetails: {
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
            <div class="mt-3 flex justify-between">
                <div class="flex w-1/2">
                    <div class="w-1/3 mr-2">
                    <InputLabel for="name" value="Buscar" />
                    <TextInput v-model="store.search" class="w-full" type="text" />
                </div>
                    <div class="self-end">
                        <WarningButton class="mr-2">
                            <font-awesome-icon :icon="['fas', 'filter']" class="mr-1" />Filtrar
                        </WarningButton>
                    </div>
            </div>
                <div class="self-end">
                    <PrimaryButton @click="store.showStoreModal()">
                        <font-awesome-icon :icon="['fas', 'plus']" class="mr-1" />Nueva {{ store.isMessage }}
                    </PrimaryButton>
                </div>
            </div>
            <EasyDataTable :headers="store.headers" :rows-per-page="10" :items="purchaseorderdetails" border-cell
                buttons-pagination class="mt-2" table-class-name="customize-table" theme-color="#0D7C66"
                header-text-direction="center" body-text-direction="center" :search-value="store.search">
                <template #empty-message>
                    <p>No se ha encontrado ningún resultado</p>
                </template>
                <template #item-report="data">
                    <a target="_blank" :href="route('report.purchaseorder', data.id)">
                        <font-awesome-icon v-tooltip="'Generar reporte de orden de compra'" :icon="['fas', 'file-pdf']"
                            class="text-xl cursor-pointer text-red-500" />
                    </a>
                </template>
                <template #item-options="options" class="flex justify-center">
                    <SecondaryButton class="mr-1" @click="store.editData(options.purchaseorder)" v-tooltip="'Actualizar orden'">
                        <font-awesome-icon :icon="['fas', 'pen-to-square']" />
                    </SecondaryButton>
                    <DangerButton @click="store.showDeleteModal(options)" v-tooltip="'Eliminar orden'">
                        <font-awesome-icon :icon="['fas', 'trash-can']" />
                    </DangerButton>
                </template>
            </EasyDataTable>
        </div>
        <ModalStoreUpdate :show="store.openModal" :providers="providers" :requestedBy="requestedBy"
            :approvedBy="approvedBy" :payment_conditions="payment_conditions" :orderTypes="orderTypes" />
        <ModalPivotOrderMaterial :show="store.openPivotModal" :materials="materials" :users="users" />
    </AppLayout>
</template>
