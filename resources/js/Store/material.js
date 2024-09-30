import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import { useAlertStore } from "./alert";

export const useMaterialStore = defineStore("material", {
    state: () => ({
        alert: useAlertStore(),
        isMessage: "Material",
        isCatMessage: "Categoría",
        isTypeMessage: "Tipo",
        title: "",
        isForm: false,
        materials: [],
        type_id: null,
        activeTab: 0,
        openModal: false,
        openCatModal: false,
        openTypeModal: false,
        openDeleteModal: false,
        edit: [],
        errors: [],
        form: useForm({
            name: "",
            quantity: "",
            ounce: "",
            thickness: "",
            width: "",
            lenght: "",
            color: "",
            finish: "",
            density: "",
            size: "",
            gum: "",
            print: "",
            status: "",
            code: "",
            entry_date: "",
            departure_date: "",
            use_date: "",
            expiration_date: "",
            brand_id: "",
            materialtype_id: "",
            error: "",
            processing: false,
        }),
        formCat: useForm({
            name: "",
            image: "",
            description: "",
            error: "",
            processing: false,
        }),
        formType: useForm({
            name: "",
            materialcategory_id: "",
            description: "",
            error: "",
            processing: false,
        }),
        headers: [
            { text: "Nombre", value: "name" },
            { text: "Cantidad", value: "quantity" },
            { text: "Medidas", value: "measures" },
        ],
    }),
    actions: {
        storeMaterial() {
            this.form.post(route("store.materials"), {
                onSuccess: () => {
                    this.closeModal();
                    this.clearInput();
                    this.alert.successAlert(this.isMessage + " agregado");
                },
                onError: (error) => {
                    this.errors = error;
                    this.alert.errorAlert();
                },
            });
        },
        deleteMaterial(id) {
            this.form.delete(route("delete.materials", id), {
                onSuccess: () => {
                    this.closeModal();
                    this.successAlert("eliminado");
                    this.alert.successAlert(this.isMessage + " eliminado");
                },
                onError: (error) => {
                    this.errors = error;
                    this.alert.errorAlert();
                },
            });
        },
        getMaterialByTypes(id) {
            this.type_id = id;
            axios.get(route("materials.types", id)).then((response) => {
                this.activeTab = id;
                this.materials = response.data;
            });
        },
        showType(id){
            axios.get(route("show.types", id)).then((response) => {
                this.activeTab = id;
                this.type = response.data;
                console.log(this.type);
                this.showStoreModal();
            });
        },
        showForm(status){
            this.isForm = true;
            if(status == true){
                this.hideForm();
            }
        },
        hideForm(){
            this.isForm = false;
        },
        resetToZero() {
            this.activeTab = 0;
        },
        storeCategory() {
            this.formCat.post(route("store.categories"), {
                onSuccess: () => {
                    this.closeModal();
                    this.alert.successAlert(this.isCatMessage + " agregado");
                },
            });
        },
        storeType(cat_id) {
            this.formType.materialcategory_id = cat_id;
            this.formType.post(route("store.types"), {
                onSuccess: () => {
                    this.closeModal();
                    this.alert.successAlert(this.isTypeMessage + " agregado");
                },
            });
        },
        handleFile(e) {
            const image = e.target.files[0];
            if (!image) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                this.formCat.image = image;
            };
            reader.readAsDataURL(image);
        },
        showStoreModal() {
            this.openModal = true;
        },
        showTypeModal() {
            this.openTypeModal = true;
        },
        showCatModal() {
            this.openCatModal = true;
        },
        showDeleteModal(data) {
            this.edit = data;
            this.openDeleteModal = true;
        },
        closeModal() {
            this.openModal = false;
            this.openDeleteModal = false;
            this.openCatModal = false;
            this.openTypeModal = false;
            this.clearInput();
        },
        editData(data) {
            this.showStoreModal();
            this.edit = data;
            this.form.name = data.name;
        },
        clearInput() {
            this.edit = "";
            this.formCat.name = "";
            this.formCat.image = "";
            this.formCat.description = "";
            this.formType.name = "";
            this.formType.materialcategory_id = "";
            this.formType.description = "";
        },
    },
});
