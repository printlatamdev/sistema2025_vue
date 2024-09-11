<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    quotes: {
        type: Object,
        default: ([]),
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
});
const headers = [
  { text: "No. Orden", value: "id" },
  { text: "Vendedor", value: "user.name" },
  { text: "Cliente", value: "company.social_reason" },
  { text: "Contacto", value: "contact.name" },
  { text: "Condición de pago", value: "payment_condition" },
  { text: "Validez oferta", value: "offer_validity" },
  { text: "Moneda", value: "currency" },
  { text: "Estado", value: "status" },
  { text: "Término de comercio", value: "incoterm" },
];

</script>

<template>
    <AppLayout title="Cotizaciones">
        <div class="w-full">
           <h2 class="text-2xl font-semibold">Datos de Cotizaciones</h2>
            <EasyDataTable
                :headers="headers"
                :items="quotes"
                class="mt-5"
            />
        </div>
    </AppLayout>
</template>
