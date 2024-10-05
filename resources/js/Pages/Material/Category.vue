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
            <div class="mt-14 grid grid-cols-2 xl:grid-cols-6 md:grid-cols-3 gap-2">
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
                                <div class="border px-2 py-1 rounded-md">
                                    <span v-for="img in item.image" :key="img.id">
                                        <img :src="img.url" alt="" class="w-8 h-8">
                                    </span>
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
