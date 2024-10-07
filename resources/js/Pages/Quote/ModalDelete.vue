<script setup>
import { defineProps } from 'vue';
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import { useQuoteStore } from '@/Store/quote';

let store = useQuoteStore();
defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: 'md',
    },
});

</script>
<template>
    <DialogModal :show="show" @close="store.closeModal" :max-width="maxWidth">
        <template #content>
            <div class="text-center">
                <p>¿Seguro que desea eliminar la cotización <span class="font-semibold">#{{ store.edit.id }}</span> seleccionada?</p>
                <p>El registro no podrá recuperarse posteriormente</p>
                <div class="flex justify-end mt-3">
                    <DangerButton @click="store.deleteQuote(store.edit.id)">
                        <font-awesome-icon :icon="['fas', 'trash-can']" class="mr-1" />Eliminar
                    </DangerButton>
                </div>
            </div>
        </template>
    </DialogModal>
</template>