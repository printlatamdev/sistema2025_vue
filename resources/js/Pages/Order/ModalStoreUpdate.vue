<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import { useOrderStore } from '@/Store/order';

let store = useOrderStore();
defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    materials: {
        type: Object,
        default: ([]),
    },
    maxWidth: {
        type: String,
        default: 'xl',
    },
});
</script>
<template>
    <DialogModal :show="show" :max-width="maxWidth" @close="store.closeModal">
        <template #title>{{ store.edit == '' ? 'Nuevo' : 'Actualizar' }} registro de orden de compra</template>
        <template #content>
            <div class="mt-5">

                <form>
                    <div class="w-full">
                        <InputLabel for="name" value="Proveedor" />
                        <v-select v-model="store.form.company_id" :options="companies" label="name">
                            <slot name="no-options">No se han encontrado resultados</slot>
                        </v-select>
                        <InputError class="" :message="store.form.errors.company_id" />
                    </div>
                    <div class="w-full mt-3">
                        <InputLabel for="name" value="Solicitado por" />
                        <v-select v-model="store.form.user_id" :options="users" label="name">
                            <template #no-options="{ search, searching, loading }">
                                No se han encontrado resultados
                            </template>
                        </v-select>
                        <InputError class="" :message="store.form.errors.name" />
                    </div>
                    <div class="flex mt-3">
                        <div>
                            <label class="flex items-center">
                                <Checkbox />
                                <span class="ms-1 text-sm text-gray-700">PO</span>
                            </label>
                        </div>
                        <div class="ml-4">
                            <label class="flex items-center">
                                <Checkbox />
                                <span class="ms-1 text-sm text-gray-700">POP</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-end mt-3">
                        <PrimaryButton @click.prevent="store.showPivotModal()">
                            <font-awesome-icon :icon="['fas', 'floppy-disk']" class="mr-1" />{{ store.edit == '' ?
                                'Guardar' : 'Actualizar' }}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </template>
    </DialogModal>
</template>