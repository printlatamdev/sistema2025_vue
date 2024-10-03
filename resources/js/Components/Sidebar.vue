<script setup>
import NavLink from '@/Components/NavLink.vue';
import { useAlertStore } from '@/Store/alert';
import AuthenticationCardLogo from './AuthenticationCardLogo.vue';

const store = useAlertStore();

</script>
<template>
    <div class="m-5">
        <AuthenticationCardLogo />
    </div>
    <!--Dashboard-->
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
        <font-awesome-icon :icon="['fas', 'chart-pie']" class="mx-2" /> Inicio
    </NavLink>
    <!--Quotes-->
    <div>
        <div class="flex justify-between cursor-pointer items-center px-1 py-2 text-sm hover:bg-gray-700 font-medium text-white transition duration-150 ease-in-out"
            @click.prevent="store.showSubmenu(store.showItemMenu)">
            <span><font-awesome-icon :icon="['fas', 'paperclip']" class="mx-2" />Cotizaciones</span>
            <span class="mr-5 px-1 rounded-sm">
                <font-awesome-icon :icon="['fas', 'chevron-down']" class="" v-if="store.showItemMenu == false" />
                <font-awesome-icon :icon="['fas', 'chevron-up']" class="" v-else />
            </span>
        </div>
        <div class="submenu transition duration-150 ease-in-out " v-if="store.showItemMenu">
            <NavLink :href="route('quotations')" :active="route().current('quotations')">
                <span><font-awesome-icon :icon="['fas', 'paperclip']" class="mx-2" />Datos de Cotizaciones</span>
            </NavLink>
            <NavLink :href="route('companies')" :active="route().current('companies')">
                <font-awesome-icon :icon="['fas', 'bolt']" class="mx-2" />Clientes
            </NavLink>
            <NavLink :href="route('contacts')" :active="route().current('contacts')">
                <font-awesome-icon :icon="['fas', 'address-book']" class="mx-2" /> Contactos
            </NavLink>
        </div>
    </div>
    <!--Orders-->
    <NavLink :href="route('orders')" :active="route().current('orders')">
        <font-awesome-icon :icon="['fas', 'bag-shopping']" class="mx-2" /> Ordenes de compra
    </NavLink>
    <!--Suministros-->
    <div>
        <div class="flex justify-between cursor-pointer items-center px-1 py-2 text-sm hover:bg-gray-700 font-medium text-white transition duration-150 ease-in-out"
            @click.prevent="store.showSubmenu2(store.showItemMenu2)">
            <span><font-awesome-icon :icon="['fas', 'hammer']" class="mx-2" />Suministros</span>
            <span class="mr-5 px-1 rounded-sm">
                <font-awesome-icon :icon="['fas', 'chevron-down']" class="" v-if="store.showItemMenu2 == false" />
                <font-awesome-icon :icon="['fas', 'chevron-up']" class="" v-else />
            </span>
        </div>
        <div class="submenu transition duration-150 ease-in-out " v-if="store.showItemMenu2">
            <NavLink :href="route('categories')" :active="route().current('categories')">
                <font-awesome-icon :icon="['fas', 'hammer']" class="mx-2" /> Materiales
            </NavLink>
        </div>
    </div>
    <!--support-->
    <!--<div class="mt-10">
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="border-t border-gray-700">
            <font-awesome-icon :icon="['fas', 'power-off']" class="mx-2" /> Configuración
        </NavLink>
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="">
            <font-awesome-icon :icon="['fas', 'power-off']" class="mx-2" /> Soporte técnico
        </NavLink>
    <!--Logout
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="">
        <font-awesome-icon :icon="['fas', 'power-off']" class="mx-2" /> Cerrar sesión
    </NavLink>
    </div>-->
</template>
<style scoped>
.submenu {
    margin-left: 25px;
}
</style>