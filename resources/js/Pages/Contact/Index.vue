<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { useContactStore } from '@/Store/contact';

let store = useContactStore();
defineProps({
    contacts: {
        type: Object,
        default: ([]),
    },
    countries: {
        type: Object,
        default: ([]),
    },
    companies: {
        type: Object,
        default: ([]),
    },
    maxWidth: {
        type: String,
        default: 'md',
    },
});

</script>

<template>
    <AppLayout title="Contactos">
        <div class="w-full">
            <h2 class="text-2xl font-semibold">Datos de Contactos</h2>
            <div class="flex justify-end">
                <PrimaryButton @click="store.showStoreModal()">Nuevo contacto</PrimaryButton>
            </div>
            <EasyDataTable :headers="store.headers" :items="contacts" border-cell buttons-pagination class="mt-5" >
                <template #item-options="options">
                    <SecondaryButton class="mr-1" @click="store.editData(options)"><font-awesome-icon :icon="['fas', 'pen-to-square']" /></SecondaryButton>
                    <DangerButton @click="store.showDeleteModal(options)"><font-awesome-icon :icon="['fas', 'trash-can']" /></DangerButton>
                </template>
            </EasyDataTable>
        </div>

        <DialogModal :show="store.openModal" @close="store.closeModal">
            <template #title>{{ store.edit == '' ? 'Nuevo' : 'Actualizar' }} registro de contacto</template>
            <template #content>
                <div class="mt-5">
                    <form @submit.prevent="store.storeContact(store.edit.id)">
                        <div class="flex">
                            <div class="w-1/3 mr-1">
                                <InputLabel for="name" value="Nombre" />
                                <TextInput v-model="store.form.name" class="w-full" type="text" />
                            </div>
                            <div class="w-1/3">
                                <InputLabel for="lastname" value="Apellido" />
                                <TextInput v-model="store.form.lastname" class="w-full" type="text" />
                            </div>
                            <div class="w-1/3 ml-1">
                                <InputLabel for="email" value="Correo electrónico" />
                                <TextInput v-model="store.form.email" class="w-full" type="email" />
                            </div>
                        </div>
                        <div class="flex mt-4">
                            <div class="w-1/4 mr-1">
                                <InputLabel for="country_id" value="País" />
                                <select v-model="store.form.country_id"
                                    class="block w-full border-gray-300 rounded-md text-xs">
                                    <option class="text-gray-500"> Seleccione una opción</option>
                                    <option v-for="country in countries" :key="country.id" :value="country.id">
                                        {{ country.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="w-1/4 mr-1">
                                <InputLabel for="company_id" value="Cliente" />
                                <select v-model="store.form.company_id"
                                    class="block w-full border-gray-300 rounded-md text-xs">
                                    <option class="text-gray-500"> Seleccione una opción</option>
                                    <option v-for="company in companies" :key="company.id" :value="company.id">
                                        {{ company.social_reason }}
                                    </option>
                                </select>
                            </div>
                            <div class="w-1/4 mr-1">
                                <InputLabel for="cellphone" value="Celular" />
                                <TextInput v-model="store.form.cellphone" class="w-full" type="text" />
                            </div>
                            <div class="w-1/4">
                                <InputLabel for="telephone" value="Teléfono" />
                                <TextInput v-model="store.form.telephone" class="w-full" type="text" />
                            </div>
                        </div>
                        <div class="flex justify-end mt-3">
                            <PrimaryButton >{{ store.edit == '' ? 'Guardar' : 'Actualizar' }}  datos</PrimaryButton>
                        </div>
                    </form>
                </div>
            </template>
        </DialogModal>

        
        <DialogModal :show="store.openDeleteModal" @close="store.closeModal" :max-width="maxWidth">
            <template #content>
                <div class="mt-5 text-center">
                    <p>¿Seguro que desea eliminar el contacto de <span class="font-semibold">{{ store.edit.name + ' ' +store.edit.lastname }}</span> seleccionado?</p>
                    <p>El registro no podrá recuperarse posteriormente</p>
                    <div class="flex justify-end mt-3">
                        <DangerButton @click="store.deleteContact(store.edit.id)">
                            <font-awesome-icon :icon="['fas', 'trash-can']" class="mr-1"/>Eliminar
                        </DangerButton>
                    </div>
                </div>
            </template>
        </DialogModal>
    </AppLayout>
</template>
