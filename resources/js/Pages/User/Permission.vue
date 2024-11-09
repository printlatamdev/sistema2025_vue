<script setup>
import { useUserStore } from '@/Store/user';

let store = useUserStore();
defineProps({
    permissions: {
        type: Object,
        default: ([]),
    },
});

</script>
<template>
    <div class="mt-7">
        <EasyDataTable :headers="store.headerPermission" :rows-per-page="10" :items="permissions" border-cell
            buttons-pagination class="mt-2" table-class-name="customize-table" theme-color="#0D7C66"
            header-text-direction="center" body-text-direction="center" :search-value="store.search">
            <template #empty-message>
                <p>No se ha encontrado ningún resultado</p>
            </template>
            <template #item-options="options" class="flex justify-center">
                <SecondaryButton class="mr-1" @click="store.editData(options.quote)" v-tooltip="'Editar cotización'">
                    <font-awesome-icon :icon="['fas', 'pen-to-square']" />
                </SecondaryButton>
                <DangerButton @click="store.showDeleteModal(options.quote)" v-tooltip="'Eliminar cotización'">
                    <font-awesome-icon :icon="['fas', 'trash-can']" />
                </DangerButton>
            </template>
        </EasyDataTable>
    </div>
</template>
