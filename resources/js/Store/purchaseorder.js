import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import { useAlertStore } from "./alert";
import {
    ClassicEditor,
    Heading,
    Bold,
    Essentials,
    Italic,
    Mention,
    Paragraph,
    Undo,
    Indent,
    IndentBlock,
    BlockQuote,
    Link,
} from "ckeditor5";
import "ckeditor5/ckeditor5.css";
export const usePurchaseorderStore = defineStore("purchaseorder", {
    state: () => ({
        alert: useAlertStore(),
        isMessage: "Orden de compra",
        openModal: false,
        openPivotModal: false,
        openDeleteModal: false,
        edit: [],
        errors: [],
        editor: ClassicEditor,
        editorData:
            "<p>A continuación se adjunta orden de compra para la adquisicion de X productos, para ser usados en X tareas, favor compartir con Lic. Eduardo para su aprobacion y firma.</p> ",
        editorConfig: {
            plugins: [
                Bold,
                Heading,
                Essentials,
                Italic,
                Mention,
                Paragraph,
                Undo,
                Indent,
                IndentBlock,
                BlockQuote,
                Link,
            ],
            toolbar: [
                "undo",
                "redo",
                "|",
                "heading",
                "|",
                "bold",
                "italic",
                "|",
                "outdent",
                "indent",
                "|",
                "blockquote",
                "link",
            ],
        },
        form: useForm({
            provider_id: "",
            details: "",
            ordertype: [],
            approvedBy: "",
            requestedBy: "",
            users: [],
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
            error: "",
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
        filledInputs(state) {
            return (
                state.form.provider_id == "" ||
                state.form.approvedBy == "" ||
                state.form.requestedBy == ""
            );
        },
    },
    actions: {
        storeOrder() {
            let userData = this.form;
            userData.users = [userData.approvedBy, userData.requestedBy];
            axios.post(route("store.purchaseorders"), {
                    provider_id: this.form.provider_id,
                    details: this.form.details,
                    ordertype: this.form.ordertype,
                    users: this.form.users,
                }).then((response) => {
                    this.edit = response.data;
                    this.closeModal();
                    this.showPivotModal();
                    this.alert.successAlert(this.isMessage + " agregada");
                }).catch((error) => {
                    this.myErrors = error.response.data.errors;
                });
        },
        deleteOrder(id) {
            this.form.delete(route("delete.order", id), {
                onSuccess: () => {
                    this.closeModal();
                    this.successAlert("eliminado");
                    this.alert.successAlert(this.isMessage + " eliminada");
                },
                onError: (error) => {
                    this.errors = error;
                    this.alert.errorAlert();
                },
            });
        },
        storePivot(id) {
            this.formOD.material_id = this.edit.id;
            this.formOD.post(route("store.materialorder"), {
                onSuccess: () => {
                    //this.closeModal();
                    this.refreshData(id);
                    this.alert.successAlert(this.isMessage + " agregado");
                },
                onError: (error) => {
                    this.errors = error;
                    this.alert.errorAlert();
                },
            });
        },
        refreshData(id) {
            axios.get(route("quoterefresh", id)).then((response) => {
                response.data.map((el) => {
                    this.edit = el;
                });
            });
        },
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
        closeModal() {
            this.openModal = false;
            this.openDeleteModal = false;
            this.openPivotModal = false;
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
