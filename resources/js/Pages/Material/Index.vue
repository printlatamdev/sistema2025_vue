<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
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
    maxWidth: {
        type: String,
        default: 'md',
    },
});

</script>

<template>
    <AppLayout title="Materiales">
        <div class="w-full">
            <h2 class="text-3xl font-bold">Datos de materiales {{ types[0].category.name }}</h2>
            <div class="border-b-2 mt-5">
                <ul class='flex cursor-pointer'>
                    <span v-for="item in types" :key="item.id">
                        <li class='py-2 px-6 rounded-t-lg text-gray-700 bg-gray-100'
                            :class="{ 'bg-gray-500 text-white': store.activeTab == true }"
                            @click="store.getMaterialByTypes(item.id)">
                            {{ item.name }}
                        </li>
                    </span>
                </ul>
            </div>
            {{ store.materials }}
            <!--table-->
            <EasyDataTable :headers="store.headers" :rows-per-page="10" :items="store.materials" border-cell buttons-pagination class="mt-5">
                
            </EasyDataTable>
        </div>
    </AppLayout>
</template>