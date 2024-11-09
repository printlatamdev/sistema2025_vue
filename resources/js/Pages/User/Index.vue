<script setup>
import { onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import ModalStoreUpdate from './ModalStoreUpdate.vue';
import ModalProfile from './ModalProfile.vue';
import Roles from './Roles.vue';
import { useUserStore } from '@/Store/user';
import Permission from './Permission.vue';

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
onMounted(() => {
    store.resetToZero();
});

</script>
<template>
    <AppLayout title="Usuarios">
        <div class="">
            <h2 class="text-3xl font-bold">Datos de {{ store.isMessage }}</h2>
                <!--tabs-->
                <div class="mt-5 w-full">
                    <ul class='flex justify-start cursor-pointer'>
                        <li class='py-2 px-6 rounded-t-lg text-gray-700 bg-gray-100 border'
                            :class="{ 'bg-gray-700 text-white': store.activeTab == 0 }" @click="store.showUsers()">
                            Usuarios
                        </li>
                        <li class='py-2 px-6 rounded-t-lg text-gray-700 bg-gray-100 border'
                            :class="{ 'bg-gray-700 text-white': store.activeTab == 1 }" @click="store.showRoles()">
                            Roles
                        </li>
                        <li class='py-2 px-6 rounded-t-lg text-gray-700 bg-gray-100 border'
                            :class="{ 'bg-gray-700 text-white': store.activeTab == 2 }" @click="store.showPermission()">
                            Permisos
                        </li>
                    </ul>
                </div>
            <div class=" mt-7 grid gap-6 grid-cols-2 xl:grid-cols-6 md:grid-cols-3" v-if="store.activeTab==0">
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
                            v-tooltip.bottom="'Rol asignado a ' + `${item.name}`" :class="{
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
        <Roles v-if="store.activeTab==1" :roles="roles" />
        <Permission :permissions="permissions" v-if="store.activeTab==2" />
        <ModalStoreUpdate :show="store.openModal" :roles="roles" :countries="countries" />
        <ModalProfile :show="store.openProfileModal" />
    </AppLayout>
</template>
