<script setup>
import { defineProps } from 'vue';
import DialogModal from '@/Components/DialogModal.vue';
import { useUserStore } from '@/Store/user';

let store = useUserStore();
defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    roles: {
        type: Object,
        default: ([]),
    },
    maxWidth: {
        type: String,
        default: '3xl',
    },
});

</script>
<template>
    <DialogModal :show="show" @close="store.closeModal" :max-width="maxWidth">
        <template #title>
            Nuevo registro de  {{store.isMessage }}
        </template>
        <template #content>
            <div class="">
                profile {{ store.profile }}
            </div>
        </template>
    </DialogModal>
</template>