import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import { useAlertStore } from "./alert";

export const useMaterialStore = defineStore("material", {
    state: () => ({
        alert: useAlertStore(),
        isMessage: "Material",
        isCatMessage: "Categoría",
        isTypeMessage: "Tipo de material",
        title: "",
        isForm: false,
        materials: [],
        currentType: [],
        type_id: null,
        activeTab: 0,
        openModal: false,
        openCatModal: false,
        openTypeModal: false,
        openLogModal: false,
        openStockModal: false,
        openDeleteModal: false,
        openDownModal: false,
        edit: [],
        search: "",
        loadingImage: false,
        loadingFile: false,
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
            materialcategory_id: "",
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
        formInk: useForm({
            color_id: "",
            type_id: "",
            quantity: "",
            code: "",
            departure_date: "",
            use_date: "",
            expiration_date: "",
            error: "",
            processing: false,
        }),
        formType: useForm({
            name: "",
            code: "",
            measure: "",
            materialcategory_id: "",
            description: "",
            error: "",
            processing: false,
        }),
        formDown: useForm({
            material_id: "",
            purchaseorder_id: "",
            quantity: "",
            ordertype: "",
            company: "",
            image: null,
            file: null,
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
    getters: {
        filledInputCat(state) {
            return state.formCat.name == "" || state.formCat.image == "";
        },
        createInks(state) {},
    },
    actions: {
        storeMaterial(type, cat_id) {
            this.form.materialtype_id = type.id;
            this.form.materialcategory_id = cat_id;
            this.form.post(route("store.materials"), {
                onSuccess: (response) => {
                    //this.materials = response.props.materials;
                    this.getMaterialByTypes(type);
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
        getMaterialByTypes(data) {
            this.type_id = data.id;
            axios.get(route("materials.types", data.id)).then((response) => {
                this.activeTab = data.id;
                this.materials = response.data;
                this.currentType = data;
            });
        },
        showType(id) {
            axios.get(route("show.types", id)).then((response) => {
                this.activeTab = id;
                this.type = response.data;
                this.showStoreModal();
            });
        },
        showForm(status) {
            this.isForm = true;
            if (status == true) {
                this.hideForm();
            }
        },
        hideForm() {
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
        storePivotInk() {},
        downloadMaterial() {},
        handleFile(e, num) {
            if (num == 1) {
                const file = e.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.loadingFile = false;
                    this.formDown.file = image;
                };
                reader.readAsDataURL(file);
            } else {
                const image = e.target.files[0];
                if (!image) return;
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.form.image = image;
                };
                reader.readAsDataURL(image);
            }
            const image = e.target.files[0];
            if (!image) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                this.loadingImage = false;
                this.formDown.image = image;
            };
            reader.readAsDataURL(image);
        },
        showStoreModal() {
            this.openModal = true;
        },
        showLogModal() {
            this.openLogModal = true;
        },
        showTypeModal() {
            this.openTypeModal = true;
        },
        showModalStock() {
            this.openStockModal = true;
        },
        showModalDown() {
            this.openDownModal = true;
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
            this.openStockModal = false;
            this.openDownModal = false;
            this.openLogModal = false;
            this.clearInput();
        },
        editData(data) {
            this.showStoreModal();
            this.edit = data;
            this.form.name = data.name;
        },
        clearInput() {
            this.edit = "";
            this.form.name = "";
            this.form.quantity = "";
            this.form.ounce = "";
            this.form.thickness = "";
            this.form.width = "";
            this.form.lenght = "";
            this.form.color = "";
            this.form.finish = "";
            this.form.density = "";
            this.form.size = "";
            this.form.gum = "";
            this.form.print = "";
            this.form.status = "";
            this.form.code = "";
            this.form.entry_date = "";
            this.form.departure_date = "";
            this.form.use_date = "";
            this.form.expiration_date = "";
            this.form.brand_id = "";
            this.form.materialtype_id = "";
            this.form.materialcategory_id = "";
            this.formCat.name = "";
            this.formCat.image = "";
            this.formCat.description = "";
            this.formType.name = "";
            this.formType.materialcategory_id = "";
            this.formType.description = "";
        },
    },
});
