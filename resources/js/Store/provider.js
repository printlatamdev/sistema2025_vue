import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import { useAlertStore } from './alert';

export const useProviderStore = defineStore("provider", {
    state: () => ({
        openModal: false,
        alert: useAlertStore(),
        isMessage: 'Proveedor',
        form: useForm({
            name: "",
            payment_condition: "",
        }),
    }),
    actions: {
        storeProvider() {
            this.form.post(route("store.providers"), {
                onSuccess: () => {
                    this.closeModal();
                    this.alert.successAlert(this.isMessage + ' agregado');
                },
            });
        },
        showStoreModal() {
            this.openModal = true;
        },
        closeModal() {
            this.openModal = false;
        },
    },
});
