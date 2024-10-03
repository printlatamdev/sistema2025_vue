import { defineStore } from "pinia";
import { useForm,router } from "@inertiajs/vue3";
import { useAlertStore } from './alert';

export const useQuoteStore = defineStore("quote", {
    state: () => ({
        alert: useAlertStore(),
        isMessage: 'Cotización',
        isSecondMessage: 'Detalle de cotización',
        getYear: parseInt(new Date().getFullYear().toString().substr(2,2), 10),
        edit: [],
        myErrors: [],
        newQuote: [],
        contactsByCompany: [],
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
            error: '',
            processing: false,
        }),
        formQD: useForm({
            quote_id: "",
            product_id: "",
            quantity: "",
            price: "",
            subtotal: "",
            details: "",
            image: null,
            error: '',
            processing: false,
        }),
        formTotal: useForm({
            quote_id: "",
            iva: null,
            iva2: null,
            error: '',
            processing: false,
        }),
        getCalc: {
            total_pr: 0,
            withIva: null
        },
        headerMain: [
            { text: "No. Orden", value: "quote.id", width: 50 },
            { text: "Cliente", value: "quote.company.social_reason",  },
            { text: "Contacto", value: "quote.contact.name",  },
            { text: "Vendedor", value: "quote.user.name",  },
            { text: "Reporte", value: "report", width: 50 },
            { text: "Fecha de registro", value: "register_date", width:150 },
            { text: "Acciones", value: "options", width: 100 },
        ],
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
            { text: "Producto", value: "name" },
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
            { name: "No asignar", value: "null" },
            { name: "7%", value: "7" },
            { name: "12%", value: "12" },
            { name: "13%", value: "13" },
            { name: "15%", value: "15" },
            { name: "Otro porcentaje", value: "Other" },
        ],
    }),
    getters: {
        getTotal(state) {
            return state.formQD.quantity * state.formQD.price;
        },
        getParcialSubtotal(state) {
            return state.getCalc.total_pr * state.formTotal.iva;
        },
        getTotalIva(state) {
            let newIva = '';
            if(state.formTotal.iva2 != ''){
                newIva = state.formTotal.iva2;
            } else {
                newIva = state.formTotal.iva;
            }
            return state.getCalc.total_pr + (state.getCalc.total_pr * newIva);
        },
    },
    actions: {
        storeQuote(id) {
            if(!id){
                axios.post(route('store.quotations'), {
                    important_note: this.form.important_note,
                    payment_condition: this.form.payment_condition,
                    offer_validity: this.form.offer_validity,
                    currency: this.form.currency,
                    status: this.form.status,
                    incoterm: this.form.incoterm,
                    user_id: this.form.user_id,
                    company_id: this.form.company_id,
                    contact_id: this.form.contact_id,
                }).then((response) => {
                    this.edit = response.data;
                    this.alert.successAlert(this.isMessage + ' agregado');
                    this.closeModal();
                    this.showModalQD();
                    this.clearMainInput();
                }).catch(error => { this.myErrors = error.response.data.errors });
            } else {
                this.form.put(route("update.quotations", id), {
                    onSuccess: () => {
                        this.alert.successAlert(this.isMessage + ' actualizada');
                        this.closeModal();
                        this.showModalQD();
                    },
                    onError: (error) => { 
                      this.errors = error;
                      this.alert.errorAlert();
                    },
                });
            }
        },
        storePivot(id){
            this.formQD.quote_id = this.edit.id;
            this.formQD.post(route("store.productquote"), {
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
        storeQuoteDetail(id){
            this.formTotal.quote_id = this.edit.id;
            this.formTotal.put(route("store.quotedetail", this.edit.id), {
                onSuccess: () => {
                    this.closeModal();
                    this.alert.successAlert(this.isSecondMessage + ' agregado');
                    this.edit = '';
                },
                onError: (error) => { 
                  this.errors = error;
                  this.alert.errorAlert();
                },
            });
        },
        deleteQuote(){
            this.form.delete(route('delete.quotations', id), {
                onSuccess: () => {
                  this.closeModal();
                  this.alert.successAlert(this.isMessage + ' eliminada');
                },
                onError: (error) => { 
                  this.errors = error;
                  this.alert.errorAlert();
                },
            });
        },
        getReport(id){
            router.get(route('report.quote', id));
        },
        refreshData(id){
            axios.get(route('quoterefresh', id)).then(response => {
                response.data.map((el) => {
                    this.edit = el;
                    this.getCalc.total_pr = el.products.reduce((accumulator, current) => accumulator + current.total, 0);
                });
            });
        },
        getContactByCompany(id){
            axios.get(route('contact.company', id)).then(response => {
                this.contactsByCompany = response.data;
            });
        },
        handleFile(e){
            const image = e.target.files[0];
            if(!image) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                this.formQD.image = image;
            };
            reader.readAsDataURL(image);
        },
        clearMainInput(){
            this.edit = '';
            this.form.important_note = "";
            this.form.payment_condition = "";
            this.form.offer_validity = ""; 
            this.form.currency = ""; 
            this.form.status = "";
            this.form.incoterm = "";
            this.form.user_id =  "";
            this.form.company_id =  "";
            this.form.contact_id =  "";
        },
        clearInput() {
            this.formQD.quote_id = "";
            this.formQD.product_id = "";
            this.formQD.quantity = "";
            this.formQD.iva = "";
            this.formQD.iva2 = "";
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
            this.openModalQD = false;
            this.openDeleteModal = false;
            this.clearInput();
            this.clearMainInput();
        },
    },
});
