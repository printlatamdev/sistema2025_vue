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
        default: '5xl',
    },
});

</script>
<template>
    <DialogModal :show="show" @close="store.closeModal" :max-width="maxWidth">
        <template #title>
            Perfil <span class="bg-teal-100 px-2 rounded-md">{{ store.profile.name }}</span>
        </template>
        <template #content>
            <div class="">
                profile {{ store.profile }}
            </div>
        </template>
    </DialogModal>
</template>