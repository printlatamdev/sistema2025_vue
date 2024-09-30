<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useMaterialStore } from '@/Store/material';
import ModalStoreUpdateMaterial from './ModalStoreUpdateMaterial.vue';

let store = useMaterialStore();
defineProps({
    materials: {
        type: Object,
        default: ([]),
    },
    types: {
        type: Object,
        default: ([]),
    },
    brands: {
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
    <AppLayout title="Materiales">
        <div class="w-full">
            <h2 class="text-3xl font-bold">Datos de materiales <span class="border-b-2 border-green-200">{{ store.title
                    }}</span></h2>
            <!--tabs-->
            <div class=" mt-5">
                <ul class='flex justify-start cursor-pointer'>
                    <li class='py-2 px-6 rounded-t-lg text-gray-700 bg-gray-100 border'
                        :class="{ 'bg-gray-700 text-white': store.activeTab == 0 }" @click="store.resetToZero()">
                        Opciones
                    </li>
                    <span v-for="item in types" :key="item.id">
                        <li class='py-2 px-6 rounded-t-lg text-gray-700 bg-gray-100 border'
                            :class="{ 'bg-gray-700 text-white': store.activeTab == item.id }"
                            @click="store.getMaterialByTypes(item.id)">
                            {{ item.name }}
                        </li>
                    </span>
                </ul>
            </div>
            <!--form-->
            <div v-if="store.activeTab == 0" class="w-1/3">
                lorem i
            </div>
            <!--table-->
            <div v-else>
                <div class="mt-5 p-2 bg-green-200 flex justify-between">
                    <h3 class="text-lg">Existencias {{ types[0].category.name }}</h3>
                    <PrimaryButton @click.prevent="store.showStoreModal()">
                        <font-awesome-icon :icon="['fas', 'plus']" class="mr-1" />Nuevo material
                    </PrimaryButton>
                </div>
                <EasyDataTable :headers="store.headers" :rows-per-page="10" :items="store.materials" border-cell
                    buttons-pagination>
                    <template #item-measures="data">
                        {{ `${data.measures.width} ancho x ${data.measures.lenght} largo` }}
                    </template>
                </EasyDataTable>
            </div>
        </div>
        <ModalStoreUpdateMaterial :show="store.openModal" :brands="brands" />
    </AppLayout>
</template>