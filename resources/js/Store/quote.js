import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";

export const useQuoteStore = defineStore("quote", {
    state: () => ({
        openModal: false,
        quoteid: '',
        currentStep: 1,
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
            quote_id: "",
            product_id: "",
            quantity: "",
            description: "",
            iva: "",
            price: "",
            subtotal: "",
            details: "",
        }),
        headers: [
            { text: "No. Orden", value: "id" },
            { text: "Vendedor", value: "user.name" },
            { text: "Cliente", value: "company.social_reason" },
            { text: "Contacto", value: "contact.name" },
            { text: "Condición de pago", value: "payment_condition" },
            { text: "Validez oferta", value: "offer_validity" },
            { text: "Moneda", value: "currency" },
            { text: "Estado", value: "status" },
            { text: "Término de comercio", value: "incoterm" },
        ],
        headersQD: [
            { text: "Producto", value: "product_id" },
            { text: "Descripción", value: "description" },
            { text: "Cantidad", value: "quantity" },
            { text: "Unitario", value: "price" },
            { text: "Total", value: "total" },
        ],
        tempQuotedetails: [
            { product_id: "", description: "", quantity: "", price: "", total: "" },
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
        currency: [
            { name: "USD", value: "USD" },
        ],
        incoterm: [
            { name: "EXW", value: "EXW" },
            { name: "FOB", value: "FOB" },
            { name: "CIF", value: "CIF" },
            { name: "DAP", value: "DAP" },
            { name: "DDP", value: "DDP" },
        ],
    }),
    getters: {
      getSubtotal(state) {
        return state.formQD.quantity * state.formQD.price;
      }
    },
    actions: {
        storeQuote() {
            this.currentStep = 2;
            /**this.closeModal();
            this.form.post(route("store.quotations"), {
                onSuccess: () => {
                    this.closeModal();
                },
            }); */
        },
        storeInLS(){
            this.formQD.subtotal = this.formQD.price * this.formQD.quantity;
            
            let newQuote = {
                product_id: this.formQD.product_id,
                description: this.formQD.description,
                quantity: this.formQD.quantity, 
                price:this.formQD.price,
                total:this.formQD.subtotal 
            };
            this.tempQuotedetails.push(newQuote);
            this.clearInput();
        },
        clearInput(){
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
        showStoreModal() {
            this.openModal = true;
        },
        closeModal() {
            this.openModal = false;
        },
    },
});
