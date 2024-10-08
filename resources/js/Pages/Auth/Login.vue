<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useAlertStore } from '@/Store/alert';

let store = useAlertStore();
defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onSuccess: (response) => {
            form.reset('password')
            store.successAlert('Sesión iniciada')
        },
        onError: (error) => {
            store.errorAlert();
        },
    });
};
</script>

<template>

    <Head title="Inicio de sesión" />

    <AuthenticationCard>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div class="border rounded-lg p-5">
            <AuthenticationCardLogo />
            <form @submit.prevent="submit" class="mt-5">
                <div>
                    <InputLabel for="email" value="Correo electrónico" />
                    <TextInput id="email" v-model="form.email" type="email" class=" block w-full" required autofocus
                        autocomplete="username" />
                    <InputError class="" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Contraseña" />
                    <TextInput id="password" v-model="form.password" type="password" class=" block w-full" required
                        autocomplete="current-password" />
                    <InputError class="" :message="form.errors.password" />
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <Checkbox v-model:checked="form.remember" name="remember" />
                        <span class="ms-2 text-sm text-gray-600">Recordar credenciales</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link v-if="canResetPassword" :href="route('password.request')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Forgot your password?
                    </Link>

                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Iniciar sesión
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticationCard>
</template>
