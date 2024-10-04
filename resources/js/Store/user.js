import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import { useAlertStore } from './alert';

export const useUserStore = defineStore("user", {
    state: () => ({
        openModal: false,
        alert: useAlertStore(),
        isMessage: 'Usuario',
        form: useForm({
            name: "",
        }),
    }),
    actions: {
        showStoreModal() {
            this.openModal = true;
        },
        closeModal() {
            this.openModal = false;
        },
    },
});
