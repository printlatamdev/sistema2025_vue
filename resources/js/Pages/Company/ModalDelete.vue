<script setup>
import { defineProps } from 'vue';
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import { useCompanyStore } from '@/Store/company';

let store = useCompanyStore();
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
            <div class=" text-center">
                <p>¿Seguro que desea eliminar la compañia <span class="font-semibold">{{ store.edit.social_reason
                        }}?</span></p>
                <p>El registro no podrá recuperarse posteriormente</p>
                <div class="flex justify-end mt-3">
                    <DangerButton @click="store.deleteCompany(store.edit.id)">
                        <font-awesome-icon :icon="['fas', 'trash-can']" class="mr-1" />Eliminar
                    </DangerButton>
                </div>
            </div>
        </template>
    </DialogModal>
</template>