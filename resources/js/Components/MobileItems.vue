<script setup>
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

</script>
<template>

    <ResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')">
        Mi perfil
    </ResponsiveNavLink>
    <ResponsiveNavLink :href="route('quotations')" :active="route().current('quotations')">
        Cotizaciones
    </ResponsiveNavLink>
    <ResponsiveNavLink :href="route('orders')" :active="route().current('orders')">
        Ordenes de compra
    </ResponsiveNavLink>
    <ResponsiveNavLink :href="route('companies')" :active="route().current('companies')">
        Clientes
    </ResponsiveNavLink>
    <ResponsiveNavLink :href="route('contacts')" :active="route().current('contacts')">
        Contactos
    </ResponsiveNavLink>
    <ResponsiveNavLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')"
        :active="route().current('api-tokens.index')">
        API Tokens
    </ResponsiveNavLink>
</template>
