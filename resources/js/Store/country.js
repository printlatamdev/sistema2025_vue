import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import { useAlertStore } from './alert';

export const useCountryStore = defineStore("country", {
    state: () => ({
        openModal: false,
        alert: useAlertStore(),
        isMessage: 'País',
        form: useForm({
            name: "",
            acronym: "",
            image: "",
            error: "",
            processing: false,
        }),
        categories: [
            { name: "Imagen", value: "name" },
            { name: "Nombre", value: "name" },
            { name: "Sigla", value: "acronym" },
        ],
    }),
    getters: {
        filledInputs(state) {
            return (
                state.form.name == "" ||
                state.form.acronym == "" ||
                state.form.image == ""
            );
        },
    },
    actions: {
        storeCountry() {
            this.form.post(route("store.countries"), {
                onSuccess: (response) => {
                    this.closeModal();
                    this.alert.successAlert(this.isMessage + ' agregado');
                },
                onError: (error) => { 
                  this.errors = error;
                  this.alert.errorAlert();
                },
            });
        },
        handleFile(e) {
            const image = e.target.files[0];
            if (!image) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                this.form.image = image;
            };
            reader.readAsDataURL(image);
        },
        showStoreModal() {
            this.openModal = true;
        },
        closeModal() {
            this.openModal = false;
        },
    },
});
