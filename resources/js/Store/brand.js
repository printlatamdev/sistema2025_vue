import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import { useAlertStore } from './alert';

export const useBrandStore = defineStore("brand", {
    state: () => ({
        openModal: false,
        alert: useAlertStore(),
        isMessage: 'Marca',
        search: '',
        form: useForm({
            name: "",
            category: "",
            description: "",
        }),
        categories: [
            { name: "Cliente", value: "Cliente" },
            { name: "Material", value: "Material" },
        ],
    }),
    actions: {
        storeBrand() {
            this.form.post(route("store.brands"), {
                onSuccess: () => {
                    this.closeModal();
                    this.alert.successAlert(this.isMessage + ' agregada');
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
