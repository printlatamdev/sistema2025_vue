import { defineStore } from 'pinia'
import { useForm } from '@inertiajs/vue3';
import { useAlertStore } from './alert';

export const useMaterialStore = defineStore('material', {
  state: () => ({ 
    alert: useAlertStore(),
    isMessage: 'Material',
    isCatMessage: 'Categoría',
    title: '',
    materials: [],
    activeTab: 0,
    openModal: false,
    openCatModal: false,
    openDeleteModal: false,
    edit: [],
    errors: [],
    form: useForm({
      name: '',
      quantity: '',
      ounce: '',
      thickness: '',
      width: '',
      lenght: '',
      color: '',
      finish: '',
      density: '',
      size: '',
      gum: '',
      print: '',
      status: '',
      code: '',
      entry_date: '',
      departure_date: '',
      use_date: '',
      expiration_date: '',
      brand_id: '',
      materialtype_id: '',
      error: '',
      processing: false,
    }),
    formCat: useForm({
      name: '',
      description: '',
      error: '',
      processing: false,
    }),
    headers: [
      { text: "Nombre", value: "name" },
      { text: "Cantidad", value: "quantity" },
      { text: "Medidas", value: "measures" },
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
        this.activeTab = id;
        this.materials = response.data;
    });
    },
    resetToZero(){
      this.activeTab = 0;
    },
    storeCategory(){
      this.formCat.post(route("store.categories"), {
        onSuccess: () => {
            this.closeModal();
            this.alert.successAlert(this.isCatMessage + ' agregado');
        },
    });
    },
    showStoreModal(){
      this.openModal = true;
    },
    showCatModal(){
      this.openCatModal = true;
    },
    showDeleteModal(data){
      this.edit = data;
      this.openDeleteModal = true;
    },
    closeModal(){
      this.openModal = false;
      this.openDeleteModal = false;
      this.openCatModal = false;
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