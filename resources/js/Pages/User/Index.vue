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
            <div class="grid grid-cols-6 gap-6 mt-7">
                <!--Begin card-->
                <div class="border p-4 rounded-lg transform hover:scale-105 transition duration-500" v-for="item in users" :key="item.id">
                    <div class="flex justify-end">
                        <font-awesome-icon :icon="['fas', 'gear']" class="text-gray-500 cursor-pointer" v-tooltip="'Configuración de la cuenta'"/>
                    </div>
                    <img :src="item.profile_photo_url" class="rounded-full w-28 h-28 bg-teal-50 p-2 mx-auto" alt="">
                    <div class="text-center">
                        <h4 class="text-lg font-semibold">{{ item.name }}</h4>
                        <h4 class="text-sm">{{ item.email }}</h4>
                        <div class="w-1/2  mx-auto bg-teal-100 rounded-lg p-1 text-sm mt-3"
                            v-tooltip="'Rol de ' + `${item.name}`" :class="{
                                'bg-green-100': item.rol == 1,
                                'bg-blue-100': item.rol == 2,
                                'bg-purple-100': item.rol == 3,
                                'bg-yellow-100': item.rol == 4,
                                'bg-gray-100': item.rol == 5,
                                'bg-red-100': item.rol == 6,
                            }">Facturación</div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
