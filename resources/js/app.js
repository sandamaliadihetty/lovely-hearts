import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import mitt from 'mitt';
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';


import {useToast} from "vue-toastification";

const emitter = mitt();
const toast = useToast();

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

function updateMessage(message) {
    const rgx = /(.*\()(\d+)(\stimes\))$/g;
    if (message.match(rgx)) {
        const number = parseInt(message.replace(rgx, '$2')) + 1;
        const newMessage = message.replace(rgx, `$1${number}$3`);
        return newMessage;
    }
    return `${message} (2 times)`;
}


createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const myApp = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Toast,{filterBeforeCreate: (toast, toasts) => {
                    const $toast = useToast();
                    const existingToast = toasts.find((t) =>
                        t.content.match(`^${toast.content}(\(\d+ times\))?`)
                    );
                    if (existingToast) {
                        $toast.update(existingToast.id, {
                            content: updateMessage(existingToast.content),
                        });
                        return false;
                    }
                    return toast;
                }})
            .use(ZiggyVue, Ziggy)
            .component('Link', Link)
            .component('Head', Head);

        myApp.config.globalProperties.emitter = emitter;
        myApp.config.globalProperties.$toast = toast;
        myApp.config.globalProperties.$route = route;

        myApp.mount(el);
        return myApp;
    },
    progress: {
        color: '#4B5563',
    },
});
