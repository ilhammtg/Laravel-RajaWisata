import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import tailwindcss from '@tailwindcss/vite'
import vue from '@vitejs/plugin-vue'
import path from 'path' // 1. Tambahkan import path

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
        vue(),
    ],

    // 2. Tambahkan Resolve Alias agar path 'ziggy-js' dipaksa ke folder yang benar
    resolve: {
        alias: {
            'ziggy-js': path.resolve(__dirname, 'vendor/tightenco/ziggy'),
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },

    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'localhost',
            port: 5173,
        },
        watch: {
            usePolling: true // Ini sudah benar untuk WSL/Docker
        }
    },

    optimizeDeps: {
        include: [
            'vue',
            '@inertiajs/vue3',
            'axios',
            'pinia',
            'ziggy-js' // 3. WAJIB TAMBAHKAN INI
        ],
    },

    build: {
        target: 'es2020',
        cssCodeSplit: true,
        chunkSizeWarningLimit: 500,
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (id.includes('node_modules/vue/') || id.includes('node_modules/@vue/')) {
                        return 'vendor-vue'
                    }
                    if (id.includes('node_modules/@inertiajs/')) {
                        return 'vendor-inertia'
                    }
                    if (id.includes('node_modules/axios/')) {
                        return 'vendor-axios'
                    }
                    // 4. Tambahkan chunk untuk ziggy agar tidak campur
                    if (id.includes('vendor/tightenco/ziggy/')) {
                        return 'vendor-ziggy'
                    }
                },
                entryFileNames: 'assets/[name]-[hash].js',
                chunkFileNames: 'assets/[name]-[hash].js',
                assetFileNames: 'assets/[name]-[hash].[ext]',
            },
        },
    },
})