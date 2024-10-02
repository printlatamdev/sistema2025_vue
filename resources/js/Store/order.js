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
            name: "",
            error: "",
            processing: false,
        }),
        formOD: useForm({
            material_id: "",
            order_id: "",
            quantity: "",
            price: "",
            subtotal: "",
            total: "",
            details: "",
            image: null,
            error: '',
            processing: false,
        }),
        headers: [
          { text: "No. Orden", value: "name" },
          { text: "Material", value: "material.name" },
          { text: "Cliente", value: "company.social_reason" },
          { text: "Cantidad", value: "quantity" },
          { text: "Precio (Sin IVA)", value: "price" },
          { text: "Fecha registro", value: "register_date" },
        ],
    }),
    getters: {
        getTotal(state) {
            return state.formOD.quantity * state.formOD.price;
        },
    },
    actions: {
        storeOrder(id) {
            this.form.post(route("store.order"), {
                onSuccess: () => {
                    this.closeModal();
                    this.clearInput();
                    this.alert.successAlert(this.isMessage + " agregado");
                },
                onError: (error) => {
                    this.errors = error;
                    this.alert.errorAlert();
                },
            });
        },
        deleteOrder(id) {
            this.form.delete(route("delete.order", id), {
                onSuccess: () => {
                    this.closeModal();
                    this.successAlert("eliminado");
                    this.alert.successAlert(this.isMessage + " eliminado");
                },
                onError: (error) => {
                    this.errors = error;
                    this.alert.errorAlert();
                },
            });
        },
        showStoreModal() {
            this.openModal = true;
        },
        showPivotModal(){
            this.openPivotModal = true;
        },
        showDeleteModal(data) {
            this.edit = data;
            this.openDeleteModal = true;
        },
        closeModal() {
            this.openModal = false;
            this.openDeleteModal = false;
            this.clearInput();
        },
        editData(data) {
            this.showStoreModal();
            this.edit = data;
            this.form.name = data.name;
        },
        clearInput() {
            this.edit = "";
        },
    },
});
