<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import ModalStoreUpdate from './ModalStoreUpdate.vue';
import ModalDelete from './ModalDelete.vue';
import { useCompanyStore } from '@/Store/company';

let store = useCompanyStore();
defineProps({
    companies: {
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
    <AppLayout title="Clientes">
        <div class="w-full">
            <h2 class="text-3xl font-bold">Datos de Clientes</h2>
            <div class="flex justify-end">
                <PrimaryButton @click="store.showStoreModal()">
                    <font-awesome-icon :icon="['fas', 'plus']" class="mr-1"/>Nueva compañia
                </PrimaryButton>
            </div>
            <EasyDataTable :headers="store.headers" :rows-per-page="10" :items="companies" border-cell buttons-pagination class="mt-5">
                <template #empty-message>
                    <p>No se ha encontrado ningún resultado</p>
                </template>
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
        <ModalStoreUpdate :show="store.openModal" />
        <ModalDelete :show="store.openDeleteModal" />

        
    </AppLayout>
</template>
