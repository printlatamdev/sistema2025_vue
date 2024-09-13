import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2/dist/sweetalert2.js";

export const useQuoteStore = defineStore("quote", {
    state: () => ({
        getYear: parseInt(new Date().getFullYear().toString().substr(2,2), 10),
        edit: [],
        tempQuotedetails: [],
        openModal: false,
        openModalQD: false,
        openDeleteModal: false,
        quoteid: "",
        form: useForm({
            important_note: "",
            payment_condition: "",
            offer_validity: "",
            currency: "",
            status: "",
            incoterm: "",
            user_id: "",
            company_id: "",
            contact_id: "",
        }),
        formQD: useForm({
            product_id: "",
            quantity: "",
            price: 0,
            subtotal: 0,
            details: "",
            url: null,
        }),
        headers: [
            { text: "No. Orden", value: "id", width: 50 },
            { text: "Vendedor", value: "user.name" },
            { text: "Cliente", value: "company.social_reason" },
            { text: "Contacto", value: "contact.name" },
            { text: "Reporte", value: "report", width: 50 },
            { text: "Condición de pago", value: "payment_condition", width: 75, },
            { text: "Validez oferta", value: "offer_validity", width: 50 },
            { text: "Moneda", value: "currency", width: 50 },
            { text: "Estado", value: "status", width: 100 },
            { text: "Término de comercio", value: "incoterm", width: 50 },
            { text: "Acciones", value: "options", width: 100 },
        ],
        headersQD: [
            { text: "Producto", value: "product_id" },
            { text: "Descripción", value: "details" },
            { text: "Cantidad", value: "quantity", width: 50 },
            { text: "Unitario", value: "price", width: 50 },
            { text: "Total", value: "total", width: 50 },
        ],
        payment_condition: [
            { name: "Anticipo", value: "Anticipo" },
            { name: "Pago total anticipado", value: "Pago total anticipado" },
            { name: "Pago contra entrega", value: "Pago contra entrega" },
            { name: "Pago a 30 días", value: "Pago a 30 días" },
            { name: "Pago a 60 días", value: "Pago a 60 días" },
        ],
        offer_validity: [
            { name: "10 días", value: "10 días" },
            { name: "15 días", value: "15 días" },
            { name: "30 días", value: "30 días" },
        ],
        currency: [{ name: "USD", value: "USD" }],
        incoterm: [
            { name: "EXW", value: "EXW" },
            { name: "FOB", value: "FOB" },
            { name: "CIF", value: "CIF" },
            { name: "DAP", value: "DAP" },
            { name: "DDP", value: "DDP" },
        ],
        iva: [
            { name: "No asignar", value: "0" },
            { name: "7%", value: "0.13" },
            { name: "12%", value: "0.12" },
            { name: "13%", value: "0.13" },
            { name: "15%", value: "0.15" },
            { name: "Otro porcentaje", value: "Other" },
        ],
    }),
    getters: {
        getTotal(state) {
            return state.formQD.quantity * state.formQD.price;
        },
    },
    actions: {
        storeQuote(id) {
            if(!id){
            this.form.post(route("store.quotations"), {
                onSuccess: () => {
                    this.successAlert('guardada');
                    this.showModalQD();
                    this.closeModal();
                },
            });
            } else {
                this.form.put(route("update.quotations", id), {
                    onSuccess: () => {
                        this.closeModal();
                        this.showModalQD();
                        this.successAlert('actualizada');
                    },
                });
            }
        },
        storeQuoteDetail(){
            this.formQD.quote_id = this.edit.id;
            this.formQD.post(route("store.quotedetails"), {
                onSuccess: () => {
                    this.closeModal();
                },
            });
        },
        deleteQuote(){
            this.form.delete(route('delete.quotations', id), {
                onSuccess: () => {
                  this.closeModal();
                  this.successAlert('eliminada');
                },
            });
        },
        handleFile(e){
            const image = e.target.files[0];
            if(!image) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                this.formQD.url = image;
            };
            reader.readAsDataURL(image);
        },
        storeInLS() {
            this.formQD.subtotal = this.formQD.price * this.formQD.quantity;
            let newQuote = {
                product_id: this.formQD.product_id,
                details: this.formQD.details,
                quantity: this.formQD.quantity,
                price: this.formQD.price,
                total: this.formQD.subtotal,
            };
            this.tempQuotedetails.push(newQuote);
            this.clearInput();
        },
        clearInput() {
            /**this.form.important_note = "";
            this.form.payment_condition = "";
            this.form.offer_validity = ""; 
            this.form.currency = ""; 
            this.form.status = "";
            this.form.incoterm = "";
            this.form.user_id =  "";
            this.form.company_id =  "";
            this.form.contact_id =  ""; */
            this.formQD.quote_id = "";
            this.formQD.product_id = "";
            this.formQD.quantity = "";
            this.formQD.iva = "";
            this.formQD.price = "";
            this.formQD.subtotal = "";
            this.formQD.details = "";
        },
        editData(data){
          this.showStoreModal();
          this.edit = data;
          this.form.offer_validity = data.offer_validity;
          this.form.payment_condition = data.payment_condition;
          this.form.currency = data.currency;
          this.form.status = data.status;
          this.form.incoterm = data.incoterm;
          this.form.user_id = data.user.id;
          this.form.company_id = data.company.id;
          this.form.contact_id = data.contact.id;
        },
        showStoreModal() {
            this.openModal = true;
        },
        showModalQD() {
            this.openModalQD = true;
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
        successAlert(message) {
            Swal.fire({
                toast: true,
                icon: "success",
                title: "Cotización " + message + " satisfactoriamente",
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        },
    },
});
