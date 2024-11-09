import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import { useAlertStore } from './alert';

export const useUserStore = defineStore("user", {
    state: () => ({
        openModal: false,
        openProfileModal: false,
        profile: [],
        search: '',
        activeTab: 0,
        alert: useAlertStore(),
        isMessage: 'Usuario',
        isMessageRol: 'Rol',
        form: useForm({
            name: "",
            email: "",
            password: "",
            roles: [],
            countries: [],
            error: '',
            processing: false,
        }),
    }),
    getters: {
        filledInputs(state) {
            return state.form.name=='' || state.form.email=='' || state.form.password=='' || state.form.roles=='' || state.form.countries=='';
        },
    },
    actions: {
        storeUser() {
            this.form.processing = true;
            this.form.post(route("store.users"), {
                onSuccess: () => {
                    this.closeModal();
                    this.alert.successAlert(this.isMessage + ' agregado');
                    this.resetInputs();
                },
            });
        },
        showRoles(){
            this.isMessage = 'Roles';
            this.activeTab = 1;
        },
        resetToZero() {
            this.activeTab = 0;
        },
        resetInputs(){
            this.form.name = "";
            this.form.email = "";
            this.form.password = "";
            this.form.roles = [];
            this.form.countries = [];
        },
        showStoreModal() {
            this.openModal = true;
        },
        showProfileModal(data) {
            this.openProfileModal = true;
            this.profile = data;
        },
        closeModal() {
            this.openModal = false;
            this.openProfileModal = false;
        },
    },
});
