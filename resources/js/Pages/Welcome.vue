<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Card from '@/Components/Card.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ModalStoreUpdate from './Country/ModalStoreUpdate.vue';
import { useCountryStore } from '@/Store/country';

let store = useCountryStore();
defineProps({
    countries: {
        type: Object,
        default: ([]),
    },
});
</script>

<template>

    <Head title="Seleccionar país" />
    <PrimaryButton class="m-2" @click.prevent="store.showStoreModal()">+</PrimaryButton>
    <div class="w-1/2 mx-auto align-center p-10 m-16 text-center">
        <h2 class="font-bold text-2xl">Seleccionar país</h2>
        <p class="text-md">
            Selecciona el país donde te encuentras para gestionar los datos dentro de este.
        </p>
        <div class="grid grid-cols-2 gap-3 mt-7">
            {{ countries }}
            <Link :href="route('login')">
                <Card>
                    <template #description>
                        <p class="text-lg">El Salvador</p>
                    </template>
                    <template #icon>
                        <div class="">
                            <img src="/images/esa.png" alt="" class="w-12 h-12" </div>
                    </template>
                </Card>
            </Link>
            <Link :href="route('login')">
                <Card>
                    <template #description>
                        <p class="text-lg">Nicaragua</p>
                    </template>
                    <template #icon>
                        <div class="">
                            <img src="/images/nic.png" alt="" class="w-12 h-12" </div>
                    </template>
                </Card>
            </Link>
        </div>
    </div>
    <ModalStoreUpdate :show="store.openModal" />
</template>
