<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import AddButton from '@/Components/AddButton.vue';
import ModalStoreBrand from '../Brand/ModalStoreBrand.vue';
import { useMaterialStore } from '@/Store/material';
import { useBrandStore } from '@/Store/brand';

let store_brand = useBrandStore();
let store = useMaterialStore();

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    brands: {
        type: Boolean,
        default: false,
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
            Nuevo registro de material
        </template>
        <template #content>
            <div class="mt-5">
                <form action="">
                    <div class="w-full flex mt-3">
                        <div class="w-2/6 mr-2">
                            <InputLabel for="name" value="Tipo" />
                            <TextInput v-model="store.form.name" class="w-full" type="text" />
                        </div>
                        <div class="w-2/6 mr-2">
                            <InputLabel for="quantity" value="Cantidad" />
                            <TextInput v-model="store.form.quantity" class="w-full" type="text" />
                        </div>
                        <div class="w-1/6 mr-2">
                            <InputLabel for="width" value="Ancho" />
                            <TextInput v-model="store.form.width" class="w-full" type="text" />
                        </div>
                        <div class="w-1/6 mr-2">
                            <InputLabel for="width" value="Alto" />
                            <TextInput v-model="store.form.lenght" class="w-full" type="text" />
                        </div>
                    </div>
                    <div class="flex mt-5">
                        <div class="w-2/4 mr-2">
                            <InputLabel for="brand" value="Marca" />
                            <div class="flex">
                                <select v-model="store.form.brand_id" class="block w-full border-gray-300 rounded-l-md">
                                <option class="text-gray-500" disabled> Seleccione una opción</option>
                                <option v-for="item in brands" :key="item.id" :value="item.id">
                                    {{ item.name }}
                                </option>
                            </select>
                            <AddButton v-tooltip="'Agregar nueva marca'" class="" @click.prevent="store_brand.showStoreModal()">
                                <font-awesome-icon :icon="['fas', 'plus']" />
                            </AddButton>
                            </div>
                        </div>
                        <div class="w-1/4 mr-2">
                            <InputLabel for="color" value="Color" />
                            <select v-model="store.form.color" class="block w-full border-gray-300 rounded-md">
                                <option class="text-gray-500" disabled> Seleccione una opción</option>
                                <option v-for="item in brands" :key="item.id" :value="item.id">
                                    {{ item.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <ul class="flex mt-10 text-sm font-medium text-center rounded-lg border">
                        <li class="w-full inline-block p-3 text-gray-900 border-r border-gray-200 cursor-pointer"
                            :class="{ 'bg-sky-200 text-gray-900': store.isForm == 1 }" @click="store.isForm = 1">
                            Registro para materiales
                        </li>
                        <li class="inline-block w-full p-3 bg-white border-r border-gray-200 cursor-pointer"
                            @click="store.isForm = 2" :class="{ 'bg-sky-200 text-gray-900': store.isForm == 2 }">
                            Registro para tintas
                        </li>
                    </ul>
                    <!--materials-->
                    <div class="mt-5" v-if="store.isForm == 1">
                        <div class="w-full flex">
                            <div class="w-1/5 mr-1">
                                <InputLabel for="ounce" value="Onzas" />
                                <TextInput v-model="store.form.ounce" class="w-full" type="text" />
                            </div>
                            <div class="w-1/5 mr-1">
                                <InputLabel for="thickness" value="Grosor" />
                                <TextInput v-model="store.form.thickness" class="w-full" type="text" />
                            </div>
                            <div class="w-1/5 mr-1">
                                <InputLabel for="finish" value="Acabado" />
                                <TextInput v-model="store.form.finish" class="w-full" type="text" />
                            </div>
                        </div>
                        <div class="w-full flex mt-3">
                            <div class="w-1/4 mr-2">
                                <InputLabel for="density" value="Densidad" />
                                <TextInput v-model="store.form.density" class="w-full" type="text" />
                            </div>
                            <div class="w-1/4 mr-2">
                                <InputLabel for="size" value="Medida" />
                                <TextInput v-model="store.form.size" class="w-full" type="text" />
                            </div>
                            <div class="w-1/4 mr-2">
                                <InputLabel for="gum" value="Goma" />
                                <TextInput v-model="store.form.gum" class="w-full" type="text" />
                            </div>
                            <div class="w-1/4 mr-2">
                                <InputLabel for="print" value="Impresión" />
                                <TextInput v-model="store.form.print" class="w-full" type="text" />
                            </div>
                        </div>

                    </div>
                    <!--inks-->
                    <div v-else>
                        <div class="w-full flex mt-3">
                            <div class="w-1/4 mr-2">
                                <InputLabel for="code" value="Código" />
                                <TextInput v-model="store.form.code" class="w-full" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-3">
                        <PrimaryButton @click.prevent="store.storeCategory()">
                            <font-awesome-icon :icon="['fas', 'floppy-disk']" class="mr-1" />Guardar
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </template>
    </DialogModal>
    <ModalStoreBrand :show="store_brand.openModal" />
</template>