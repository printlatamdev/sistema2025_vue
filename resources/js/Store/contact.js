import { defineStore } from 'pinia'
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2/dist/sweetalert2.js'

export const useContactStore = defineStore('contact', {
  state: () => ({ 
    openModal: false,
    openDeleteModal: false,
    edit: [],
    form: useForm({
      name: '',
      lastname: '',
      cellphone: '',
      telephone: '',
      email: '',
      company_id: '',
      country_id: '',
    }),
    headers: [
        { text: "Nombre", value: "name" },
        { text: "Apellido", value: "lastname" },
        { text: "Celular", value: "cellphone" },
        { text: "Teléfono", value: "telephone" },
        { text: "Correo electrónico", value: "email" },
        { text: "Compañia", value: "company.social_reason" },
        { text: "País", value: "country.name" },
        { text: "Acciones", value: "options" },
    ],
 }),
  actions: {
    storeContact(id){
      if(!id){
        this.form.post(route("store.contacts"), {
          onSuccess: () => {
            this.closeModal();
            this.clearInput();
            this.successAlert('agregado');
          },
        });
      } else{
        this.form.put(route("update.contacts", id), {
          onSuccess: () => {
            this.closeModal();
            this.clearInput();
            this.successAlert('actualizado');
          },
        });
      }
    },
    deleteContact(id){
      this.form.delete(route('delete.contacts', id), {
        onSuccess: () => {
          this.closeModal();
          this.successAlert('eliminado');
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
      console.log(data);
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
    successAlert(message){
        Swal.fire({
            toast: true,
            icon: 'success',
            title: 'Contacto ' + message + ' satisfactoriamente',
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    },
  },
})