import { defineConfig } from 'vite';
import react from "@vitejs/plugin-react";
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        hmr: {
            host: "0.0.0.0",
        },
        port: 3000,
        host: true,
    },
    plugins: [
        laravel({
            input: "resources/js/app.jsx",
            refresh: true,
        }),
        react(),
    ],
});