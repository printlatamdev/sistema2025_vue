<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import ModalStoreUpdate from './ModalStoreUpdate.vue';
import ModalStoreUpdateQD from './ModalStoreUpdateQD.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import WarningButton from '@/Components/WarningButton.vue';
import ModalDelete from './ModalDelete.vue';
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
            <EasyDataTable :headers="store.headerMain" :rows-per-page="10" :items="quotedetails" border-cell
                buttons-pagination class="mt-2" table-class-name="customize-table" theme-color="#0D7C66"
                header-text-direction="center" body-text-direction="center" :search-value="store.search">
                <template #empty-message>
                    <p>No se ha encontrado ningún resultado</p>
                </template>
                <template #item-quote.id="data">
                    {{ `${data.quote.id}-${store.getYear}` }}
                </template>
                <template #item-quote.contact.name="data">
                    {{ data.quote.contact.name }} {{ data.quote.contact.lastname }}
                </template>
                <template #item-report="data">
                    <a target="_blank" :href="route('report.quote', data.id)">
                        <font-awesome-icon v-tooltip="'Generar reporte de cotización'" :icon="['fas', 'file-pdf']"
                            class="text-xl cursor-pointer text-red-500" />
                    </a>
                </template>
                <template #item-options="options" class="flex justify-center">
                    <SecondaryButton class="mr-1" @click="store.editData(options.quote)"
                        v-tooltip="'Editar cotización'">
                        <font-awesome-icon :icon="['fas', 'pen-to-square']" />
                    </SecondaryButton>
                    <DangerButton @click="store.showDeleteModal(options.quote)" v-tooltip="'Eliminar cotización'">
                        <font-awesome-icon :icon="['fas', 'trash-can']" />
                    </DangerButton>
                </template>
            </EasyDataTable>
        </div>
        <ModalStoreUpdate :show="store.openModal" :companies="companies" :users="users" :contacts="contacts" />
        <ModalStoreUpdateQD :show="store.openModalQD" :quote="quote" :products="products" />
        <ModalDelete :show="store.openDeleteModal" />
    </AppLayout>
</template>
