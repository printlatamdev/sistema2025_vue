<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { useUserStore } from '@/Store/user';

let store = useUserStore();
defineProps({
    users: {
        type: Object,
        default: ([]),
    },
});

</script>

<template>
    <AppLayout title="Usuarios">
        <div class="w-full">
            <h2 class="text-3xl font-bold">Datos de {{ store.isMessage }}</h2>
            <div class="grid grid-cols-5 gap-2 mt-7" >
                <div class="bg-gray-50 p-4 rounded-md" v-for="item in users" :key="item.id">
                    <img :src="item.profile_photo_url" class="rounded-full w-28 h-28 bg-teal-50 p-2 mx-auto" alt="">
                    <div class="text-center">
                        <h4 class="text-lg">{{ item.name }}</h4>
                        <h4 class="text-sm">{{ item.email }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
