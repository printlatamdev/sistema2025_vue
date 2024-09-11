import { defineStore } from 'pinia'
import { useForm } from '@inertiajs/vue3';

export const useContactStore = defineStore('contact', {
  state: () => ({ 
    openModal: false,
    form: useForm({
      name: '',
      lastname: '',
      cellphone: '',
      telephone: '',
      email: '',
      company_id: '',
      country_id: '',
    }),
 }),
  actions: {
    storeContact(){
    this.form.post(route("store.contacts"), {
      onSuccess: () => {
        this.closeModal();
      },
    });
    },
    showStoreModal(){
      this.openModal = true;
    },
    closeModal(){
      this.openModal = false;
    }
  },
})