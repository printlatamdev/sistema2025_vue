<script setup>
import NavLink from '@/Components/NavLink.vue';
defineProps({
    on: Boolean,
});
</script>
<template>
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
