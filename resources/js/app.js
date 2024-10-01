import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createPinia } from 'pinia'
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import FloatingVue from 'floating-vue';
import 'floating-vue/dist/style.css';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faPenToSquare,faTrashCan,faAnglesRight,faAnglesLeft,faArrowLeft,faFilePdf,faPlus,faFloppyDisk,faHammer,faCircleUser,faPowerOff,faChartPie,faPaperclip,faBolt,faAddressBook,faBell,faBagShopping,faChevronDown,faChevronUp,faArrowDown,faHourglassEnd,faFolderPlus} from '@fortawesome/free-solid-svg-icons'
library.add(faPenToSquare,faTrashCan,faAnglesRight,faAnglesLeft,faArrowLeft,faFilePdf,faPlus,faFloppyDisk,faHammer,faCircleUser,faPowerOff,faChartPie,faPaperclip,faBolt,faAddressBook,faBell,faBagShopping,faChevronDown,faChevronUp,faArrowDown,faHourglassEnd,faFolderPlus)



const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const pinia = createPinia()

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(pinia)
            .use(VueSweetalert2)
            .use(FloatingVue)
            .component('EasyDataTable', Vue3EasyDataTable)
            .component('font-awesome-icon', FontAwesomeIcon)
            .component('VueDatePicker', VueDatePicker)
            .component('v-select', vSelect)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
