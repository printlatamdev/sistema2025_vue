<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useMaterialStore } from '@/Store/material';

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
                    <p class="border-b-2 my-5 text-md font-semibold">Detalles de material</p>
                    <div class="w-full flex">
                        <div class="w-1/5 mr-1">
                            <InputLabel for="brand" value="Marca" />
                            <select v-model="store.form.brand_id" class="block w-full border-gray-300 rounded-md ">
                                <option class="text-gray-500" disabled> Seleccione una opción</option>
                                <option v-for="item in brands" :key="item.id" :value="item.id">
                                    {{ item.name }}
                                </option>
                            </select>
                        </div>
                        <div class="w-1/5 mr-1">
                            <InputLabel for="color" value="Color" />
                            <TextInput v-model="store.form.color" class="w-full" type="text" />
                        </div>
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
                    <p class="border-b-2 my-5 text-md font-semibold">Detalles de tintas</p>
                    <div class="w-full flex mt-3">
                        <div class="w-1/4 mr-2">
                            <InputLabel for="code" value="Código" />
                            <TextInput v-model="store.form.code" class="w-full" type="text" />
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
</template>