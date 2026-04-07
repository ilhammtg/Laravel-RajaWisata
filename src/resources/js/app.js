import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createPinia } from 'pinia'; 
import { ZiggyVue } from 'ziggy-js'; 
import { Ziggy } from './ziggy.js';

createInertiaApp({
    title: (title) => `${title} - Raja Wisata`,
    resolve: (name) => {
        return resolvePageComponent(
            `./Pages/${name}.vue`, 
            import.meta.glob('./Pages/**/*.vue')
        );
    },
    setup({ el, App, props, plugin }) {
        // 1. Buat instance aplikasi
        const app = createApp({ render: () => h(App, props) });
        
        // 2. Buat instance Pinia
        const pinia = createPinia();
        
        // 3. Daftarkan semua plugin (Urutan Penting!)
        app.use(plugin)           // Register Inertia dulu
           .use(pinia)            // Register Pinia agar Store tersedia di komponen
           .use(ZiggyVue, Ziggy); // Register Ziggy agar fungsi route() tersedia

        // 4. Mount aplikasi ke elemen DOM
        app.mount(el);
    },
    progress: {
        color: '#059669',
        showSpinner: true,
    },
});