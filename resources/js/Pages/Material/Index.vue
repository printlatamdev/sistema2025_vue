<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import ModalStoreUpdate from './ModalStoreUpdate.vue';
import ModalDelete from './ModalDelete.vue';
import { useOrderStore } from '@/Store/order';

let store = useOrderStore();
defineProps({
    materials: {
        type: Object,
        default: ([]),
    },
    maxWidth: {
        type: String,
        default: 'md',
    },
});

</script>

<template>
    <AppLayout title="Ordenes de compra">
        <div class="w-full">
            <h2 class="text-3xl font-bold">Datos de Ordenes de compra</h2>
            <div class="flex justify-end">
                <PrimaryButton @click="store.showStoreModal()">
                    <font-awesome-icon :icon="['fas', 'plus']" class="mr-1"/>Nueva orden de compra
                </PrimaryButton>
            </div>
            <EasyDataTable :headers="store.headers" :rows-per-page="10" :items="orders" border-cell buttons-pagination class="mt-5">
                <template #item-options="options" class="flex justify-center">
                    <SecondaryButton class="mr-1" @click="store.editData(options)" v-tooltip="'Actualizar cliente'">
                        <font-awesome-icon :icon="['fas', 'pen-to-square']" />
                    </SecondaryButton>
                    <DangerButton @click="store.showDeleteModal(options)" v-tooltip="'Eliminar cliente'">
                        <font-awesome-icon :icon="['fas', 'trash-can']" />
                    </DangerButton>
                </template>
            </EasyDataTable>
        </div>
    </AppLayout>
</template>
