<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useUserStore } from '@/Store/user';
import ModalStoreUpdate from './ModalStoreUpdate.vue';
import ModalProfile from './ModalProfile.vue';

let store = useUserStore();
defineProps({
    users: {
        type: Object,
        default: ([]),
    },
    roles: {
        type: Object,
        default: ([]),
    },
    countries: {
        type: Object,
        default: ([]),
    },
});

</script>

<template>
    <AppLayout title="Usuarios">
        <div class="w-full">
            <h2 class="text-3xl font-bold">Datos de {{ store.isMessage }}</h2>
            <div class=" mt-7 grid gap-6 grid-cols-2 xl:grid-cols-6 md:grid-cols-3">
                <!--Begin card-->
                <div class="w-full border text-center cursor-pointer p-4 rounded-lg transform hover:scale-105 transition duration-500"
                    @click="store.showStoreModal()">
                    <div class="bg-gray-200 px-3 py-2 rounded-full w-10 h-10 mt-12 mx-auto">
                        <font-awesome-icon :icon="['fas', 'plus']" />
                    </div>
                    <p>Agregar nuevo usuario</p>
                </div>
                <div class="border p-2 rounded-lg transform hover:scale-105 transition duration-500"
                    v-for="item in users" :key="item.id">
                    <div class="flex justify-end">
                        <font-awesome-icon :icon="['fas', 'gear']" class="text-gray-500 cursor-pointer text-lg"
                            v-tooltip="'Configuración de la cuenta'" @click.prevent="store.showProfileModal(item)" />
                    </div>
                    <img :src="item.profile_photo_url" class="rounded-full w-24 h-24 bg-teal-50 p-2 mx-auto" alt="">
                    <div class="text-center">
                        <h4 class="text-lg font-semibold">{{ item.name }}</h4>
                        <h4 class="text-sm">{{ item.email }}</h4>
                        <br>
                        <span v-for="rol in item.roles" :key="rol.id" class="w-auto mx-auto rounded-lg p-1 text-sm ml-1"
                            v-tooltip="'Rol de ' + `${item.name}`" :class="{
                                'bg-green-100': rol.id == 1,
                                'bg-blue-100': rol.id == 2,
                                'bg-purple-100': rol.id == 3,
                                'bg-yellow-100': rol.id == 4,
                                'bg-gray-100': rol.id == 5,
                                'bg-red-100': rol.id == 6,
                                'bg-orange-200': rol.id == 7,
                            }">
                            {{ rol.name }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <ModalStoreUpdate :show="store.openModal" :roles="roles" :countries="countries" />
        <ModalProfile :show="store.openProfileModal" />
    </AppLayout>
</template>
