<script setup>
import NavLink from '@/Components/NavLink.vue';

</script>
<template>
    <div class="m-5">
        <img class="w-24 h-14 rounded-md" src="/images/logo.jpg" style="display:block;margin:0 auto">
    </div>
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
        Dashboard
    </NavLink>
    <NavLink :href="route('quotations')" :active="route().current('quotations')">
        Cotizaciones
    </NavLink>
    <NavLink :href="route('companies')" :active="route().current('companies')">
        Compañias
    </NavLink>
    <NavLink :href="route('contacts')" :active="route().current('contacts')">
        Contactos
    </NavLink>
</template>
