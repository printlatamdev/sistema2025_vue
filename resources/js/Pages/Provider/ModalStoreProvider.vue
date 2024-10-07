<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useProviderStore } from '@/Store/provider';

let store = useProviderStore();
defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    payment_conditions: {
        type: Array,
        default: ([]),
        //default: () => [],
    },
    maxWidth: {
        type: String,
        default: 'lg',
    },
});

</script>
<template>
    <DialogModal :show="show" @close="store.closeModal" :max-width="maxWidth">
        <template #title>
            Nuevo registro de {{ store.isMessage }}
        </template>
        <template #content>
            <div class="">
                <form action="">
                    <div class="w-full">
                        <InputLabel for="name" value="Nombre" />
                        <TextInput v-model="store.form.name" class="w-full " type="text" />
                    </div>
                    <div class="w-full mt-3">
                        <InputLabel for="name" value="Condición de pago" />
                        <v-select v-model="store.form.payment_condition" class="w-full" :options="payment_conditions"
                            label="name" >
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    No se ha encontrado resultados para <em>{{ search }}</em>.
                                </template>
                                <em v-else style="opacity: 0.5">Empieza a escribir para buscar una condición de pago</em>
                            </template>
                        </v-select>
                    </div>
                    <div class="flex justify-end mt-5">
                        <PrimaryButton @click.prevent="store.storeProvider()">
                            <font-awesome-icon :icon="['fas', 'floppy-disk']" class="mr-1" />Guardar {{ store.isMessage
                            }}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </template>
    </DialogModal>
</template>