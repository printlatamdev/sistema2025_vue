<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { useContactStore } from '@/Store/contact';

let store = useContactStore();
defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    countries: {
        type: Object,
        default: ([]),
    },
    companies: {
        type: Object,
        default: ([]),
    },
});
</script>
<template>
    <DialogModal :show="show" :max-width="maxWidth" @close="store.closeModal">
        <template #title>{{ store.edit == '' ? 'Nuevo' : 'Actualizar' }} registro de contacto</template>
        <template #content>
            <div class="mt-5">
                <form @submit.prevent="store.storeContact(store.edit.id)">
                    <div class="flex">
                        <div class="w-1/3 mr-1">
                            <InputLabel for="name" value="Nombre" />
                            <TextInput v-model="store.form.name" class="w-full" type="text" />
                            <InputError class="" :message="store.form.errors.name" />
                        </div>
                        <div class="w-1/3">
                            <InputLabel for="lastname" value="Apellido" />
                            <TextInput v-model="store.form.lastname" class="w-full" type="text" />
                            <InputError class="" :message="store.form.errors.lastname" />
                        </div>
                        <div class="w-1/3 ml-1">
                            <InputLabel for="email" value="Correo electrónico" />
                            <TextInput v-model="store.form.email" class="w-full" type="email" />
                            <InputError class="" :message="store.form.errors.email" />
                        </div>
                    </div>
                    <div class="flex mt-4">
                        <div class="w-1/4 mr-1">
                            <InputLabel for="country_id" value="País" />
                            <select v-model="store.form.country_id"
                                class="block w-full border-gray-300 rounded-md text-xs">
                                <option class="text-gray-500" disabled> Seleccione una opción</option>
                                <option v-for="country in countries" :key="country.id" :value="country.id">
                                    {{ country.name }}
                                </option>
                            </select>
                            <InputError class="" :message="store.form.errors.country_id" />
                        </div>
                        <div class="w-1/4 mr-1">
                            <InputLabel for="company_id" value="Cliente" />
                            <select v-model="store.form.company_id"
                                class="block w-full border-gray-300 rounded-md text-xs">
                                <option class="text-gray-500" disabled> Seleccione una opción</option>
                                <option v-for="company in companies" :key="company.id" :value="company.id">
                                    {{ company.social_reason }}
                                </option>
                            </select>
                            <InputError class="" :message="store.form.errors.company_id" />
                        </div>
                        <div class="w-1/4 mr-1">
                            <InputLabel for="cellphone" value="Celular" />
                            <TextInput v-model="store.form.cellphone" class="w-full" type="text" />
                            <InputError class="" :message="store.form.errors.cellphone" />
                        </div>
                        <div class="w-1/4">
                            <InputLabel for="telephone" value="Teléfono" />
                            <TextInput v-model="store.form.telephone" class="w-full" type="text" />
                        </div>
                    </div>
                    <div class="flex justify-end mt-3">
                        <PrimaryButton>
                            <font-awesome-icon :icon="['fas', 'floppy-disk']" class="mr-1" />{{ store.edit == '' ? 'Guardar' : 'Actualizar' }}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </template>
    </DialogModal>
</template>