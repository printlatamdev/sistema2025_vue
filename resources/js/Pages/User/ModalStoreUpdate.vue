<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import { useUserStore } from '@/Store/user';

let store = useUserStore();
defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    roles: {
        type: Object,
        default: ([]),
    },
    countries: {
        type: Object,
        default: ([]),
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
                        <TextInput v-model="store.form.name" class="w-full" type="text" />
                        <InputError class="" :message="store.form.errors.name" />
                    </div>
                    <div class="w-full mt-3">
                        <InputLabel for="email" value="Correo electrónico" />
                        <TextInput v-model="store.form.email" class="w-full" type="email" />
                        <InputError class="" :message="store.form.errors.email" />
                    </div>
                    <div class="flex">
                        <div class="w-1/2 mt-3 mr-2">
                            <InputLabel for="roles" value="Roles" />
                            <v-select v-model="store.form.roles" :reduce="roles => roles['id']" :options="roles"
                                label="name" multiple>
                                <template v-slot:no-options="{ search, searching }">
                                    <template v-if="searching">
                                        No se ha encontrado resultados para <em>{{ search }}</em>.
                                    </template>
                                    <em v-else style="opacity: 0.5">Empieza a escribir para buscar los roles</em>
                                </template>
                            </v-select>
                            <InputError class="" :message="store.form.errors.roles" />
                        </div>
                        <div class="w-1/2 mt-3">
                            <InputLabel for="countries" value="País" />
                            <v-select v-model="store.form.countries" :reduce="countries => countries['id']"
                                :options="countries" label="name" multiple>
                                <template v-slot:no-options="{ search, searching }">
                                    <template v-if="searching">
                                        No se ha encontrado resultados para <em>{{ search }}</em>.
                                    </template>
                                    <em v-else style="opacity: 0.5">Empieza a escribir para buscar los paises</em>
                                </template>
                            </v-select>
                            <InputError class="" :message="store.form.errors.roles" />
                        </div>
                    </div>
                    <div class="w-full mt-3">
                        <InputLabel for="password" value="Contraseña" />
                        <TextInput v-model="store.form.password" class="w-full" type="password" />
                        <InputError class="" :message="store.form.errors.password" />
                    </div>
                    <div class="flex justify-end mt-3">
                        <PrimaryButton @click.prevent="store.storeUser()" :disabled="store.filledInputs">
                            <font-awesome-icon :icon="['fas', 'floppy-disk']" class="mr-1" />Guardar {{ store.isMessage
                            }}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </template>
    </DialogModal>
</template>