<script setup>
import { onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ModalStoreUpdateMaterial from './ModalStoreUpdateMaterial.vue';
import ModalStoreType from './ModalStoreType.vue';
import ModalEntryMaterial from './ModalEntryMaterial.vue';
import { useMaterialStore } from '@/Store/material';

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
    categories: {
        type: Object,
        default: ([]),
    },
    providers: {
        type: Object,
        default: ([]),
    },
    colors: {
        type: Array,
        default: ([]),
    },
});
onMounted(() => {
    store.resetToZero();
});

</script>
<template>
    <AppLayout title="Materiales">
        <div class="w-full">
            <h2 class="text-3xl font-bold">Datos de {{ store.isMessage }}: <span class="border-b-2 border-green-200">{{
                categories.name }}</span></h2>
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
                            @click="store.getMaterialByTypes(item)">
                            {{ item.name }}
                        </li>
                    </span>
                </ul>
            </div>
            <!--cards-->
            <div v-if="store.activeTab == 0" class="w-full mt-7">
                <div class="mt-12 grid grid-cols-2 xl:grid-cols-6 md:grid-cols-3 gap-3">
                    <div class="border text-center p-3 bg-blue-50 cursor-pointer rounded-lg transform hover:scale-105 transition duration-500"
                        @click.prevent="store.showTypeModal()">
                        <span class="py-1 px-2 rounded-full">
                            <font-awesome-icon :icon="['fas', 'plus']" class="text-2xl text-gray-700" />
                        </span>
                        <p class="mt-1">Nuevo tipo de material</p>
                    </div>
                    <div class="border text-center p-3 bg-blue-50 cursor-pointer rounded-lg transform hover:scale-105 transition duration-500"
                        @click.prevent="store.showModalStock()">
                        <span class="py-1 px-2 rounded-full">
                            <font-awesome-icon :icon="['fas', 'folder-plus']" class="text-2xl text-gray-700" />
                        </span>
                        <p class="mt-1">Ingreso de material</p>
                    </div>
                    <div
                        class="border text-center p-3 bg-sky-50 cursor-pointer rounded-lg transform hover:scale-105 transition duration-500">
                        <span class="py-1 px-2 rounded-full">
                            <font-awesome-icon :icon="['fas', 'arrow-down']" class="text-2xl text-gray-700" />
                        </span>
                        <p class="mt-1">Descarga de material</p>
                    </div>
                    <div
                        class="border text-center p-3 bg-purple-50 cursor-pointer rounded-lg transform hover:scale-105 transition duration-500">
                        <span class="py-1 px-2 rounded-full">
                            <font-awesome-icon :icon="['fas', 'hourglass-end']" class="text-2xl text-gray-700" />
                        </span>
                        <p class="mt-1">Finalizar material</p>
                    </div>
                </div>
            </div>
            <!--table-->
            <div v-else>
                <div class="mt-5 p-2 bg-green-200 flex justify-between">
                    <span v-for="img in categories.image" :key="img.id" class="flex">
                        <img :src="img.url" alt="" class="w-6 mx-2">
                        <h3 class="text-lg">Existencias <span class="">{{ store.currentType.name }}</span></h3>
                    </span>
                    <PrimaryButton @click.prevent="store.showType(store.type_id)">
                        <font-awesome-icon :icon="['fas', 'plus']" class="mr-1" />Nuevo material
                    </PrimaryButton>
                </div>
                <EasyDataTable :headers="store.headers" :rows-per-page="10" :items="store.materials" border-cell
                    buttons-pagination>
                    <template #empty-message>
                        <p>No se ha encontrado ningún resultado</p>
                    </template>
                    <template #item-measures="data">
                        {{ `${data.measures.width} ancho x ${data.measures.lenght} largo` }}
                    </template>
                </EasyDataTable>
            </div>
        </div>
        <ModalStoreUpdateMaterial :show="store.openModal" :type="store.type" :brands="brands" :categories="categories"
            :colors="colors" />
        <ModalStoreType :show="store.openTypeModal" :categories="categories" />
        <ModalEntryMaterial :show="store.openStockModal" :providers="providers" :categories="categories"
            :materials="materials" :types="types" :colors="colors" />
    </AppLayout>
</template>