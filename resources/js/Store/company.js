import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import { useAlertStore } from './alert';

export const useCompanyStore = defineStore("company", {
    state: () => ({ 
        alert: useAlertStore(),
        isMessage: 'Cliente',
        openModal: false,
        openDeleteModal: false,
        edit: [],
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
            error: '',
            processing: false,
        }),
        headers: [
            { text: "Razón Social", value: "social_reason" },
            { text: "Nombre comercial", value: "commercial_name" },
            { text: "Celular", value: "cellphone" },
            { text: "Teléfono", value: "telephone" },
            { text: "NRC", value: "nrc" },
            { text: "NIT", value: "nit" },
            { text: "Dirección", value: "address" },
            { text: "Giro", value: "business_line" },
            { text: "Agencia", value: "agency" },
            { text: "Acciones", value: "options", width: 100 },
        ],
    }),
    getters: {
        filledInputs(state) {
            return state.form.commercial_name=='' || state.form.social_reason=='' || state.form.cellphone=='';
        },
    },
    actions: {
        storeCompany(id) {
            if(!id){
                this.form.post(route("store.companies"), {
                    onSuccess: () => {
                        this.closeModal();
                        this.clearInput();
                        this.alert.successAlert(this.isMessage + ' agregado');
                    },
                    onError: (error) => { 
                      this.errors = error;
                      this.alert.errorAlert();
                    },
                });
            } else{
                this.form.put(route("update.companies", id), {
                    onSuccess: () => {
                        this.closeModal();
                        this.clearInput();
                        this.alert.successAlert(this.isMessage + ' actualizado');
                    },
                    onError: (error) => { 
                      this.errors = error;
                      this.alert.errorAlert();
                    },
                });
            }
        },
        deleteCompany(id){
          this.form.delete(route('delete.companies', id), {
            onSuccess: () => {
              this.closeModal();
              this.alert.successAlert(this.isMessage + ' eliminado');
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
        showDeleteModal(data){
          this.edit = data;
          this.openDeleteModal = true;
        },
        closeModal() {
            this.openModal = false;
            this.openDeleteModal = false;
            this.clearInput();
        },
        clearInput(){
          this.form.commercial_name = "";
          this.form.social_reason = "";
          this.form.cellphone = "";
          this.form.telephone = "";
          this.form.address = "";
          this.form.nrc = "";
          this.form.nit = "";
          this.form.business_line = "";
          this.form.agency = "";
        },
        editData(data){
          this.showStoreModal();
          this.edit = data;
          this.form.commercial_name = data.commercial_name;
          this.form.social_reason = data.social_reason;
          this.form.cellphone = data.cellphone;
          this.form.telephone = data.telephone;
          this.form.address = data.address;
          this.form.nrc = data.nrc;
          this.form.nit = data.nit;
          this.form.business_line = data.business_line;
          this.form.agency = data.agency;
        },
    },
});
