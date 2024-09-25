<script setup>
import NavLink from '@/Components/NavLink.vue';
import { useAlertStore } from '@/Store/alert';

const store = useAlertStore();

</script>
<template>
    <div class="m-5">
        <img class="w-24 h-14 rounded-md" src="/images/logo.jpg" style="display:block;margin:0 auto">
    </div>
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
        <font-awesome-icon :icon="['fas', 'chart-pie']" class="mr-2"/> Dashboard
    </NavLink>
    <NavLink @click.prevent="store.showSubmenu(store.showItemMenu)">
        <div class="flex justify-between">
            <span><font-awesome-icon :icon="['fas', 'paperclip']" class="mr-2" />Cotizaciones</span>
            <span class="mr-5 px-1 rounded-sm">
                    <font-awesome-icon :icon="['fas', 'chevron-down']" class="transition duration-150 ease-in-out " v-if="store.showItemMenu==false" />
                    <font-awesome-icon :icon="['fas', 'chevron-up']" class="ml-1 transition duration-150 ease-in-out " v-else />
            </span>  
        </div>
    </NavLink>
    <div class="submenu transition duration-150 ease-in-out " v-if="store.showItemMenu">
    <NavLink :href="route('quotations')" :active="route().current('quotations')">
        <span><font-awesome-icon :icon="['fas', 'paperclip']" class="mr-2" />Datos de Cotizaciones</span>
    </NavLink>
        <NavLink :href="route('companies')" :active="route().current('companies')">
            <font-awesome-icon :icon="['fas', 'bolt']" class="mr-2" />Clientes
        </NavLink>
        <NavLink :href="route('contacts')" :active="route().current('contacts')">
            <font-awesome-icon :icon="['fas', 'address-book']" class="mr-2" /> Contactos
        </NavLink>
    </div>
    <NavLink :href="route('orders')" :active="route().current('orders')">
        <font-awesome-icon :icon="['fas', 'bag-shopping']" class="mr-2" /> Ordenes de compra
    </NavLink>
</template>
<style scoped>
    .submenu{
        margin-left: 25px;
    }

</style>