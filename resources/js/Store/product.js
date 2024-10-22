import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import { useAlertStore } from './alert';

export const useProductStore = defineStore("product", {
    state: () => ({
        openModal: false,
        alert: useAlertStore(),
        isMessage: 'Producto',
        search: '',
        form: useForm({
            name: "",
            description: "",
        }),
    }),
    actions: {
        storeProduct() {
            this.form.post(route("store.products"), {
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
