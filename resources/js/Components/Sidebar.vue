<script setup>
import NavLink from '@/Components/NavLink.vue';

</script>
<template>
    <div class="m-5">
        <img class="w-24 h-14 rounded-md" src="/images/logo.jpg" style="display:block;margin:0 auto">
    </div>
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
        <font-awesome-icon :icon="['fas', 'chart-pie']" class="mr-2"/> Dashboard
    </NavLink>
    <NavLink :href="route('quotations')" :active="route().current('quotations')">
        <font-awesome-icon :icon="['fas', 'paperclip']" class="mr-2" />Cotizaciones
    </NavLink>
    <NavLink :href="route('orders')" :active="route().current('orders')">
        <font-awesome-icon :icon="['fas', 'bag-shopping']" class="mr-2" /> Ordenes de compra
    </NavLink>
    <NavLink :href="route('companies')" :active="route().current('companies')">
        <font-awesome-icon :icon="['fas', 'bolt']" class="mr-2" />Clientes
    </NavLink>
    <NavLink :href="route('contacts')" :active="route().current('contacts')">
        <font-awesome-icon :icon="['fas', 'address-book']" class="mr-2" /> Contactos
    </NavLink>
</template>
