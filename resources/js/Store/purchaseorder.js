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
            approved_by: "",
            requested_by: "",
            users: [],
            processing: false,
        }),
        formOD: useForm({
            material_id: "",
            purchaseorder_id: "",
            quantity: "",
            price: "",
            subtotal: "",
            iva: '',
            total: "",
            details: "",
            image: null,
            error: "",
            processing: false,
        }),
        headers: [
            { text: "No. Orden", value: "id", width:50 },
            //{ text: "Aprobado por", value: "approvedBy" },
            //{ text: "Autorizado por", value: "requestedBy" },
            { text: "Cliente", value: "provider.name" },
            { text: "Precio (Sin IVA)", value: "order_details.total_materials", width: 100 },
            { text: "Fecha registro", value: "register_date", width: 150 },
            { text: "Acciones", value: "options", width: 100 },
        ],
        iva: [
            { name: "No asignar", value: "0" },
            { name: "7%", value: "7" },
            { name: "12%", value: "12" },
            { name: "13%", value: "13" },
            { name: "15%", value: "15" },
            { name: "Otro porcentaje", value: "0" },
        ],
        headersOD: [
            { text: "Material", value: "name" },
            { text: "Descripción", value: "pivot.details" },
            { text: "Cantidad", value: "pivot.quantity", width: 50 },
            { text: "Unitario", value: "pivot.price", width: 50 },
            { text: "Total", value: "pivot.subtotal", width: 50 },
        ],
    }),
    getters: {
        getTotal(state) {
            return state.formOD.quantity * state.formOD.price;
        },
        filledInputs(state) {
            return (
                state.form.provider_id == "" ||
                state.form.approved_by == "" ||
                state.form.requested_by == ""
            );
        },
        filledInputsOD(state) {
            return (
                state.formOD.material_id == "" ||
                state.formOD.quantity == "" ||
                state.formOD.price == ""
            );
        },
    },
    actions: {
        storeOrder(id) {
            this.form.users = [this.form.approved_by,  this.form.requested_by];
            if (!id) {
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
            } else {
                this.form.put(route("update.purchaseorders", id), {
                    onSuccess: () => {
                        this.alert.successAlert(
                            this.isMessage + " actualizada"
                        );
                        this.showPivotModal();
                    },
                    onError: (error) => {
                        this.errors = error;
                        this.alert.errorAlert();
                    },
                });
            }
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
            this.formOD.purchaseorder_id = this.edit.id;
            this.formOD.post(route("store.materialorder"), {
                onSuccess: () => {
                    this.clearPivotInput();
                    this.refreshData(id);
                    this.alert.successAlert(this.isMessage + " agregado");
                },
                onError: (error) => {
                    this.errors = error;
                    this.alert.errorAlert();
                },
            });
        },
        editData(data) {
            this.showStoreModal();
            this.edit = data;
            this.form.provider_id = data.provider.id;
            this.form.details = data.details;
            data.users.map((el) => {
                el.roles.map((element) => {
                    if(element.id == 1){
                        this.form.approved_by = el.id;
                    } else {
                        this.form.requested_by = el.id;
                    }
                });
            });
            this.form.ordertype = data.ordertype;
        },
        refreshData(id) {
            axios.get(route("purchaseorder.refresh", id)).then((response) => {
                response.data.map((el) => {
                    this.edit = el;
                    console.log(this.edit);
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
        clearPivotInput() {
            this.formOD.material_id = "";
            this.formOD.price = "";
            this.formOD.quantity = "";
            this.formOD.subtotal = "";
            this.formOD.details = "";
            this.formOD.iva = "";
        },
        clearInput() {
            this.edit = "";
            this.form.provider_id = "";
            this.form.details = "";
            this.form.approved_by = "";
            this.form.requested_by = "";
            this.form.ordertype = "";
        },
    },
});
