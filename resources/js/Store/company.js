import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import Swal from 'sweetalert2/dist/sweetalert2.js';

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
                    this.clearInput();
                    this.successAlert();
                },
            });
        },
        showStoreModal() {
            this.openModal = true;
        },
        closeModal() {
            this.openModal = false;
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
        successAlert(){
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Compañia agregada satisfactoriamente',
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        },
    },
});
