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
    categories: {
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
    <DialogModal :show="show" @close="store.closeModal" :max-width="maxWidth">
        <template #title>
            Nuevo registro de {{ store.isTypeMessage }}
        </template>
        <template #content>
            {{ categories }}
            <form action="">
                <div class="flex">
                    <div class="w-full mr-2">
                        <InputLabel for="name" value="Nombre" />
                        <TextInput v-model="store.formType.name" class="w-full" type="text" />
                    </div>
                    <div class="w-1/3" v-if="categories.id==1">
                        <InputLabel for="code" value="Código" />
                        <TextInput v-model="store.formType.code" class="w-full" type="text" />
                    </div>
                </div>
                <!--second line-->
                <div class="flex mt-3">
                    <div class="w-full mr-2">
                        <InputLabel for="materialcategory_id" value="Categoría" />
                        <select v-model="categories.id" class="block w-full border-gray-300 rounded-md text-xs"
                            disabled>
                            <option :value="categories.id">
                                {{ categories.name }}
                            </option>
                        </select>
                    </div>
                    <div class="w-full" v-if="categories.id==1">
                        <InputLabel for="measure" value="Medida (En litros)" />
                        <TextInput v-model="store.formType.measure" class="w-full" type="text" />
                    </div>
                </div>
                <div class="mt-3">
                    <InputLabel for="name" value="Descripción" />
                    <textarea v-model="store.formType.description" rows="3"
                        class="block w-full border-gray-300 rounded-md text-sm"></textarea>
                </div>
                <div class="flex justify-end mt-3">
                    <PrimaryButton @click.prevent="store.storeType(categories.id)">
                        <font-awesome-icon :icon="['fas', 'floppy-disk']" class="mr-1" />Guardar {{ store.isTypeMessage
                        }}
                    </PrimaryButton>
                </div>
            </form>
        </template>
    </DialogModal>
</template>