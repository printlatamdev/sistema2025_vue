import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";

export const useCompanyStore = defineStore("company", {
    state: () => ({
        openModal: false,
        form: useForm({
            commercial_name: "",
            social_reason: "",
            cellphone: "",
            telephone: "",
            address: "",
            nrc: "",
            nit: "",
            business_line: "",
            agency: "",
        }),
    }),
    actions: {
        storeCompany() {
            this.closeModal();
            this.form.post(route("store.companies"), {
                onSuccess: () => {
                    this.closeModal();
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
