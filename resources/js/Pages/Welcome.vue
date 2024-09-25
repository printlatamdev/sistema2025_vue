<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Card from '@/Components/Card.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>

    <Head title="Color Digital | Seleccionar país" />
    <div class="w-1/2 mx-auto align-center p-10 m-10 text-center">
        <h2 class="font-bold text-2xl">Seleccionar país</h2>
        <p class="text-md">
            Selecciona el país donde te encuentras para gestionar los datos dentro de este.
        </p>
        <div class="grid grid-cols-2 gap-2 mt-7">
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
</template>
