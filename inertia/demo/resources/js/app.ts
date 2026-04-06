import { createInertiaApp, Link } from '@inertiajs/vue3';
import { createApp, h } from "vue";
import Layout from "./Shared/Layout.vue";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    resolve: name => {
    const pages = import.meta.glob('./pages/**/*.vue', { eager: true })
    let page = pages[`./pages/${name}.vue`]
    page.default.layout = name.startsWith('Public/') ? undefined : Layout
    return page
},
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
