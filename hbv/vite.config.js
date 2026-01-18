import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 
                    'resources/css/clinic.css',
                    'resources/css/home.css',
                    'resources/css/reset.css',

                    'resources/css/clinic/login.css',
                    'resources/css/clinic/patient.css',
                    'resources/css/clinic/register.css', 

                    'resources/css/patients/edit.css',
                    'resources/css/patients/index.css',
                    'resources/css/patients/show.css',

                    'resources/js/app.js',

                    'resources/js/clinic/login.js',
                    'resources/js/clinic/patient.js',
                    'resources/js/clinic/register.js',
              
                    'resources/js/patients/edit.js'],
                    
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
