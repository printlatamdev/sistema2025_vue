<script setup>
import NavLink from '@/Components/NavLink.vue';
defineProps({
    on: Boolean,
});
</script>
<template>
    <div class="m-5">
        <img class="w-24 h-14 rounded-md" src="/images/logo.jpg" style="display:block;margin:0 auto">
    </div>
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
        Dashboard
    </NavLink>
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
        Cotizaciones
    </NavLink>
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
        Compañias
    </NavLink>
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
        Contactos
    </NavLink>
</template>
