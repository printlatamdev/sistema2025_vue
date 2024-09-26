import { defineStore } from 'pinia'
import { useForm } from '@inertiajs/vue3';
import { useAlertStore } from './alert';

export const useMaterialStore = defineStore('material', {
  state: () => ({ 
    alert: useAlertStore(),
    isMessage: 'Material',
    materials: [],
    activeTab: false,
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
        { text: "Cantidad", value: "quantity" },
        { text: "medidas", value: "measures" },
    ],
 }),
  actions: {
    storeMaterial(id){
      if(!id){
        this.form.post(route("store.materials"), {
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
        this.form.put(route("update.materials", id), {
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
    deleteMaterial(id){
      this.form.delete(route('delete.materials', id), {
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
    getMaterialByTypes(id){
      axios.get(route('materials.types', id)).then(response => {
        this.activeTab = true;
        response.data.map((el) => {
            this.materials = el;
        });
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