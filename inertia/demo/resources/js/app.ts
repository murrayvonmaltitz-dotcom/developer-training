import { createInertiaApp, Link } from '@inertiajs/vue3';
import { createApp, h } from "vue";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component("Link", Link)
      .mount(el)
    },
    title: (title) => (title ? `${title} - ${appName}` : appName),
    progress: {
        color: '#4B5563',
        showSpinner: true
    },
});
