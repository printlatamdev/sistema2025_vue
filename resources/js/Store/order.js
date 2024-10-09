import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import { useAlertStore } from "./alert";

export const useOrderStore = defineStore("order", {
    state: () => ({
        alert: useAlertStore(),
        isMessage: "Orden",
        openModal: false,
        openPivotModal: false,
        openDeleteModal: false,
        edit: [],
        errors: [],
        form: useForm({
            computo: "",
            print: "",
            cut: "",
            payment: "",
            mod: "",
            application_number: "",
            delivery_date: "",
            application_date: "",
            assign_date: "",
            next_payment_date: "",
            country_id: "",
            user_id: "",
            company_id: "",
            contact_id: "",
            error: "",
            processing: false,
        }),
        headers: [
            { text: "No. Orden", value: "name" },
            { text: "Material", value: "material.name" },
            { text: "Cliente", value: "company.social_reason" },
            { text: "Cantidad", value: "quantity" },
            { text: "Precio (Sin IVA)", value: "price" },
            { text: "Fecha registro", value: "register_date", width: 150 },
        ],
    }),
    getters: {

    },
    actions: {
        showStoreModal() {
            this.openModal = true;
        },
        showPivotModal() {
            this.openPivotModal = true;
        },
        showDeleteModal(data) {
            this.edit = data;
            this.openDeleteModal = true;
        },
    },
});
