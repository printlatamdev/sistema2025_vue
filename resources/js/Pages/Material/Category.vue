<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import Card from '@/Components/Card.vue';
import ModalStoreCategory from './ModalStoreCategory.vue';
import { useMaterialStore } from '@/Store/material';

let store = useMaterialStore();
defineProps({
    categories: {
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
            <h2 class="text-3xl font-bold">Categorías de Material</h2>
            <!--cards-->
            <div class="grid grid-cols-6 gap-2 mt-14">
                <div class="border rounded-lg text-center p-3 cursor-pointer" @click="store.showCatModal()">
                    <span class="bg-gray-200 py-1 px-2 rounded-full">
                        <font-awesome-icon :icon="['fas', 'plus']" />
                    </span>
                    <p>Nueva categoría</p>
                </div>
                <div v-for="item in categories" :key="item.id">
                    <Link :href="route('categories.types', item.id)" >
                        <Card v-tooltip="'Acceder a los tipos de material ' + `${item.name}`">
                            <template #description>
                                <p class="text-lg font-semibold">{{ item.name }}</p>
                            </template>
                            <template #icon>
                                <div class="bg-gray-200 px-2 py-1 rounded-md">
                                    <font-awesome-icon :icon="['fas', 'bolt']" class="text-2xl" />
                                </div>
                            </template>
                        </Card>
                    </Link>
                </div>
            </div>
        </div>
        <ModalStoreCategory :show="store.openCatModal" />
    </AppLayout>
</template>
