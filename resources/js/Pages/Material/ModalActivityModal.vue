<script setup>
import { computed, defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Filepond from '@/Components/Filepond.vue';
import TextInput from '@/Components/TextInput.vue';
import { useMaterialStore } from '@/Store/material';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import WarningButton from '@/Components/WarningButton.vue';

let store = useMaterialStore();
defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    materials: {
        type: Object,
        default: ([])
    }
});
</script>
<template>
    <DialogModal :show="show" @close="store.closeModal" :max-width="maxWidth">
        <template #title>
            Registro de actividad de materiales
        </template>
        <template #content>
            <ol class="relative border-s border-gray-200">
                <span v-for="mat in materials" :key="mat.id">
                    <span v-for="item in mat.activities" :key="item.id">
                        <li class="ms-3 border mt-1 p-1 rounded-md">
                            <div class="absolute w-3 h-3 bg-gray-500 rounded-full mt-3 -start-1.5 border border-white">
                            </div>
                            <time class="mb-1 text-xs font-normal leading-none text-gray-400">{{ item.register_date
                                }}</time>
                            <!--<h3 class="text-md font-semibold text-gray-900">{{ item }}
                            </h3>-->
                            <p class="text-sm font-normal text-gray-600">
                                {{ item.causer.name }} ha agregado {{ item.properties.attributes.name }} con la cantidad de {{
                                    item.properties.attributes.quantity }} unidades
                            </p>
                        </li>
                    </span>
                </span>
            </ol>
        </template>
    </DialogModal>
</template>