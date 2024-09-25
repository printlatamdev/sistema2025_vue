import { defineStore } from 'pinia'
import { useForm } from '@inertiajs/vue3';
import { useAlertStore } from './alert';

export const useOrderStore = defineStore('order', {
  state: () => ({ 
    alert: useAlertStore(),
    isMessage: 'Order',
    openModal: false,
    openDeleteModal: false,
    edit: [],
    errors: [],
    form: useForm({
      name: '',
      error: '',
      processing: false,
    }),
    headers: [
        { text: "Nombre", value: "name" },
    ],
 }),
  actions: {
    storeOrder(id){
      if(!id){
        this.form.post(route("store.order"), {
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
        this.form.put(route("update.order", id), {
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
    deleteOrder(id){
      this.form.delete(route('delete.order', id), {
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
    },
    clearInput(){
      this.edit = '';
    },
  },
})