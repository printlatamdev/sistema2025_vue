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
        headersOD: [
            { text: "Material", value: "name" },
            { text: "Descripción", value: "details" },
            { text: "Cantidad", value: "quantity", width: 50 },
            { text: "Unitario", value: "price", width: 50 },
            { text: "Total", value: "total", width: 50 },
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
        storePivot(id){
            this.formOD.material_id = this.edit.id;
            this.formOD.post(route("store.materialorder"), {
                onSuccess: () => {
                    //this.closeModal();
                    this.refreshData(id);
                    this.alert.successAlert(this.isMessage + ' agregado');
                },
                onError: (error) => { 
                  this.errors = error;
                  this.alert.errorAlert();
                },
            });
        },
        refreshData(id){
            axios.get(route('quoterefresh', id)).then(response => {
                response.data.map((el) => {
                    this.edit = el;
                });
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
