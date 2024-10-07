<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { useCompanyStore } from '@/Store/company';

let store = useCompanyStore();
defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
});
</script>
<template>
    <DialogModal :show="store.openModal" @close="store.closeModal">
        <template #title>{{ store.edit == '' ? 'Nuevo' : 'Actualizar' }} registro de {{store.isMessage }}</template>
        <template #content>
            <div class="">
                <form @submit.prevent="store.storeCompany(store.edit.id)">
                    <div class="flex">
                        <div class="w-1/2 mr-2">
                            <InputLabel for="commercial_name" value="Nombre comercial" />
                            <TextInput v-model="store.form.commercial_name" class="w-full" type="text" />
                            <InputError class="" :message="store.form.errors.commercial_name" />
                        </div>
                        <div class="w-1/2">
                            <InputLabel for="social_reason" value="Razón social" />
                            <TextInput v-model="store.form.social_reason" class="w-full" type="text" />
                            <InputError class="" :message="store.form.errors.social_reason" />
                        </div>
                    </div>

                    <div class="flex mt-3">
                        <div class="w-1/2 mr-2">
                            <InputLabel for="cellphone" value="Celular" />
                            <TextInput v-model="store.form.cellphone" class="w-full" type="text" />
                            <InputError class="" :message="store.form.errors.cellphone" />
                        </div>
                        <div class="w-1/2">
                            <InputLabel for="telephone" value="Teléfono" />
                            <TextInput v-model="store.form.telephone" class="w-full" type="text" />
                        </div>
                    </div>

                    <div class="flex mt-3">
                        <div class="w-1/3 mr-2">
                            <InputLabel for="nrc" value="NRC" />
                            <TextInput v-model="store.form.nrc" class="w-full" type="text" />
                            <InputError class="" :message="store.form.errors.nrc" />
                        </div>
                        <div class="w-1/3 mr-2">
                            <InputLabel for="nit" value="NIT" />
                            <TextInput v-model="store.form.nit" class="w-full" type="text" />
                            <InputError class="" :message="store.form.errors.nit" />
                        </div>
                        <div class="w-1/3">
                            <InputLabel for="business_line" value="Giro comercial" />
                            <TextInput v-model="store.form.business_line" class="w-full" type="text" />
                        </div>
                    </div>
                    <div class="flex mt-3">
                        <div class="w-full m-1">
                            <InputLabel for="nit" value="Dirección" />
                            <textarea v-model="store.form.address" rows="3"
                                class="block w-full border-gray-300 rounded-md text-sm"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end mt-3">
                        <PrimaryButton :disabled="store.filledInputs">
                            <font-awesome-icon :icon="['fas', 'floppy-disk']" class="mr-1" />{{ store.edit == '' ?
                            'Guardar' : 'Actualizar' }}  {{store.isMessage }}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </template>
    </DialogModal>
</template>