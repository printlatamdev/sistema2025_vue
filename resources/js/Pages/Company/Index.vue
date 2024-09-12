<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { useCompanyStore } from '@/Store/company';

let store = useCompanyStore();
defineProps({
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
    <AppLayout title="Compañias">
        <div class="w-full">
            <h2 class="text-2xl font-semibold">Datos de Compañias</h2>
            <div class="flex justify-end">
                <PrimaryButton @click="store.showStoreModal()">Nueva compañia</PrimaryButton>
            </div>
            <EasyDataTable :headers="store.headers" :items="companies" border-cell buttons-pagination class="mt-5">
                <template #item-options="options">
                    <SecondaryButton class="mr-1" @click="store.editData(options)"><font-awesome-icon :icon="['fas', 'pen-to-square']" /></SecondaryButton>
                    <DangerButton @click="store.showDeleteModal(options)"><font-awesome-icon :icon="['fas', 'trash-can']" /></DangerButton>
                </template>
            </EasyDataTable>
        </div>
        <DialogModal :show="store.openModal" @close="store.closeModal">
            <template #title>{{ store.edit == '' ? 'Nuevo' : 'Actualizar' }} registro de Compañia</template>
            <template #content>
                <div class="mt-5">
                    <form @submit.prevent="store.storeCompany(store.edit.id)">
                        <div class="flex">
                            <div class="w-1/2 mr-1">
                                <InputLabel for="commercial_name" value="Nombre comercial" />
                                <TextInput v-model="store.form.commercial_name" class="w-full" type="text" />
                            </div>
                            <div class="w-1/2">
                                <InputLabel for="social_reason" value="Razón social" />
                                <TextInput v-model="store.form.social_reason" class="w-full" type="text" />
                            </div>
                        </div>

                        <div class="flex mt-3">
                            <div class="w-1/2 mr-1">
                                <InputLabel for="cellphone" value="Celular" />
                                <TextInput v-model="store.form.cellphone" class="w-full" type="text" />
                            </div>
                            <div class="w-1/2">
                                <InputLabel for="telephone" value="Teléfono" />
                                <TextInput v-model="store.form.telephone" class="w-full" type="text" />
                            </div>
                        </div>
                        
                        <div class="flex mt-3">
                            <div class="w-1/3 mr-1">
                                <InputLabel for="nrc" value="NRC" />
                                <TextInput v-model="store.form.nrc" class="w-full" type="text" />
                            </div>
                            <div class="w-1/3 mr-1">
                                <InputLabel for="nit" value="NIT" />
                                <TextInput v-model="store.form.nit" class="w-full" type="text" />
                            </div>
                            <div class="w-1/3">
                                <InputLabel for="business_line" value="Giro comercial" />
                                <TextInput v-model="store.form.business_line" class="w-full" type="text" />
                            </div>
                        </div>
                        <div class="flex mt-3">
                            <div class="w-full m-1">
                                <InputLabel for="nit" value="Dirección" />
                                <textarea v-model="store.form.address" rows="3" class="block text-xs w-full border-gray-300 rounded-md"></textarea>
                            </div>
                        </div>
                        <div class="flex justify-end mt-3">
                            <PrimaryButton>{{ store.edit == '' ? 'Guardar' : 'Actualizar' }}</PrimaryButton>
                        </div>
                    </form>
                </div>
            </template>
        </DialogModal>

        
        <DialogModal :show="store.openDeleteModal" @close="store.closeModal" :max-width="maxWidth">
            <template #content>
                <div class="mt-5 text-center">
                    <p>¿Seguro que desea eliminar la compañia <span class="font-semibold">{{ store.edit.social_reason }}</span> seleccionada?</p>
                    <p>El registro no podrá recuperarse posteriormente</p>
                    <div class="flex justify-end mt-3">
                        <DangerButton @click="store.deleteCompany(store.edit.id)">
                            <font-awesome-icon :icon="['fas', 'trash-can']" class="mr-1"/>Eliminar
                        </DangerButton>
                    </div>
                </div>
            </template>
        </DialogModal>
    </AppLayout>
</template>
