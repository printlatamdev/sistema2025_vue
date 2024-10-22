import { defineStore } from 'pinia'
import { useForm } from '@inertiajs/vue3';
import { useAlertStore } from './alert';

export const useContactStore = defineStore('contact', {
  state: () => ({ 
    alert: useAlertStore(),
    isMessage: 'Contacto',
    openModal: false,
    openDeleteModal: false,
    edit: [],
    search: '',
    errors: [],
    form: useForm({
      name: '',
      lastname: '',
      cellphone: '',
      telephone: '',
      email: '',
      company_id: '',
      country_id: '',
      error: '',
      processing: false,
    }),
    headers: [
        { text: "Nombre", value: "name" },
        { text: "Apellido", value: "lastname" },
        { text: "Celular", value: "cellphone" },
        { text: "Teléfono", value: "telephone" },
        { text: "Correo electrónico", value: "email" },
        { text: "Compañia", value: "company.social_reason" },
        { text: "País", value: "country.name" },
        { text: "Acciones", value: "options", width: 100 },
    ],
 }),
 getters: {
     filledInputs(state) {
         return state.form.name=='' || state.form.lastname=='' || state.form.cellphone=='' || state.form.email==''  || state.form.company_id==''  || state.form.country_id=='';
     },
 },
  actions: {
    storeContact(id){
      if(!id){
        this.form.post(route("store.contacts"), {
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
        this.form.put(route("update.contacts", id), {
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
    deleteContact(id){
      this.form.delete(route('delete.contacts', id), {
        onSuccess: () => {
          this.closeModal();
          this.successAlert('eliminado');
          this.alert.successAlert(this.isMessage + ' eliminado');
        },
        onError: (error) => { 
          this.errors = error;
          this.alert.errorAlert();
        },
      });
    },
    showStoreModal(){
      this.openModal = true;
    },
    showDeleteModal(data){
      this.edit = data;
      this.openDeleteModal = true;
    },
    closeModal(){
      this.openModal = false;
      this.openDeleteModal = false;
      this.clearInput();
    },
    editData(data){
      this.showStoreModal();
      this.edit = data;
      this.form.name = data.name;
      this.form.lastname = data.lastname;
      this.form.cellphone = data.cellphone;
      this.form.telephone = data.telephone;
      this.form.email = data.email;
      this.form.company_id = data.company.id;
      this.form.country_id = data.country.id;
    },
    clearInput(){
      this.edit = '';
      this.form.name = "";
      this.form.lastname = "";
      this.form.cellphone = "";
      this.form.telephone = "";
      this.form.email = "";
      this.form.company_id = "";
      this.form.country_id = "";
    },
  },
})