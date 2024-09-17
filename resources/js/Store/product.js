import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2/dist/sweetalert2.js";

export const useProductStore = defineStore("product", {
    state: () => ({
        openModal: false,
        form: useForm({
            name: "",
            description: "",
        }),
    }),
    actions: {
        storeProduct() {
            this.form.post(route("store.products"), {
                onSuccess: () => {
                    this.closeModal();
                    this.successAlert("agregado");
                },
            });
        },
        showStoreModal() {
            this.openModal = true;
        },
        closeModal() {
            this.openModal = false;
        },
        successAlert(message) {
            Swal.fire({
                toast: true,
                icon: "success",
                title: "Producto " + message + " satisfactoriamente",
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        },
    },
});
