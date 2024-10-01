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
    type: {
        type: Object,
        default: ([]),
    },
    brands: {
        type: Object,
        default: ([]),
    },
    categories: {
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
            Nuevo registro de material <span class="bg-blue-200 p-1 rounded-md">{{ type.name }}</span>
        </template>
        <template #content>
            <div class="mt-5">
                <form action="">
                    <div class="w-full flex mt-3">
                        <div class="w-3/6 mr-2">
                            <InputLabel for="name" value="Tipo" />
                            <TextInput v-model="store.form.name" class="w-full" type="text" />
                        </div>
                        <div class="w-1/6 mr-2">
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
                    <div class="flex mt-3">
                        <div class="w-1/4 mr-2">
                            <InputLabel for="code" value="Código" />
                            <TextInput v-model="store.form.code" class="w-full" type="text" />
                        </div>
                        <div class="w-2/4 mr-2">
                            <InputLabel for="brand" value="Marca" />
                            <div class="flex">
                                <select v-model="store.form.brand_id" class="block w-full border-gray-300 rounded-l-md">
                                    <option class="text-gray-500" disabled> Seleccione una opción</option>
                                    <option v-for="item in brands" :key="item.id" :value="item.id">
                                        {{ item.name }}
                                    </option>
                                </select>
                                <AddButton v-tooltip="'Agregar nueva marca'" class=""
                                    @click.prevent="store_brand.showStoreModal()">
                                    <font-awesome-icon :icon="['fas', 'plus']" />
                                </AddButton>
                            </div>
                        </div>
                        <div class="w-1/4 mr-2">
                            <InputLabel for="color" value="Color" />
                            <select v-model="store.form.color" class="block w-full border-gray-300 rounded-md">
                                <option class="text-gray-500" disabled> Seleccione una opción</option>
                                <option v-for="item in store.colors" :key="item.id" :value="item.value">
                                    {{ item.text }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <!-- <ul class="flex mt-10 text-sm font-medium text-center rounded-lg border">
                        <li class="w-full inline-block p-3 text-gray-900 border-r border-gray-200 cursor-pointer"
                            :class="{ 'bg-sky-200 text-gray-900': store.isForm == 1 }" @click="store.isForm = 1">
                            Registro para materiales
                        </li>
                        <li class="inline-block w-full p-3 bg-white border-r border-gray-200 cursor-pointer"
                            @click="store.isForm = 2" :class="{ 'bg-sky-200 text-gray-900': store.isForm == 2 }">
                            Registro para tintas
                        </li>
                    </ul>-->
                    <!--inks-->
                    <!--materials-->
                    <div class="mt-7 bg-gray-100 border rounded-t-xl">
                        <div class="flex items-center cursor-pointer justify-between w-full p-3 font-medium text-gray-700  hover:bg-gray-100"
                            @click="store.showForm(store.isForm)">
                            <span class="font-semibold">Detalles de {{ categories.name == 'Tintas' ? 'tintas' :
                                'material'
                                }}</span>
                            <!--icon-->
                            <font-awesome-icon :icon="['fas', 'chevron-down']" class="" v-if="store.isForm == false" />
                            <font-awesome-icon :icon="['fas', 'chevron-up']" class="" v-else />
                        </div>
                        <div class="px-5 py-2 bg-gray-50" :class="{ 'hidden': store.isForm == false }">
                            <div v-if="categories.name == 'Tintas'">
                                <!--datapickers-->
                                <div class="w-full flex mt-3">
                                    <!--<div class="w-1/3 mr-2">
                                        <InputLabel for="entry_date" value="Fecha de ingreso" />
                                        <VueDatePicker v-model="store.form.entry_date" inline auto-apply></VueDatePicker>
                                    </div>-->
                                    <div class="w-1/3 mx-auto">
                                        <InputLabel for="departure_date" value="Fecha de salida" />
                                        <VueDatePicker v-model="store.form.departure_date" inline auto-apply
                                            locale="es"></VueDatePicker>
                                    </div>
                                    <div class="w-1/3 mx-auto">
                                        <InputLabel for="use_date" value="Fecha de uso" />
                                        <VueDatePicker v-model="store.form.use_date" inline auto-apply locale="es">
                                        </VueDatePicker>
                                    </div>
                                    <div class="w-1/3">
                                        <div class="w-full mr-2">
                                            <InputLabel for="expiration_date" value="Fecha de vencimiento" />
                                            <VueDatePicker v-model="store.form.expiration_date" locale="es" class="mx-auto">
                                            </VueDatePicker>
                                            <div class="w-full mt-3 mr-2">
                                                <InputLabel for="expiration_date" value="Medida" />
                                                <select v-model="store.form.color"
                                                    class="block w-full border-gray-300 rounded-md">
                                                    <option class="text-gray-500" disabled> Seleccione una opción
                                                    </option>
                                                    <!--<option v-for="item in store.colors" :key="item.id" :value="item.value">
                                                {{ item.text }}
                                            </option>-->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
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
                        </div>
                    </div>
                    <div class="flex justify-end mt-3">
                        <PrimaryButton @click.prevent="store.storeMaterial(type.id, categories.id)">
                            <font-awesome-icon :icon="['fas', 'floppy-disk']" class="mr-1" />Guardar
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </template>
    </DialogModal>
    <ModalStoreBrand :show="store_brand.openModal" />
</template>