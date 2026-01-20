import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/reset.css',
                'resources/css/home.css',
                'resources/css/hospital_register.css',
                'resources/css/hospital.css',
                'resources/js/app.js',
                'resources/js/hospital_register.js'],
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


// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';
// import tailwindcss from '@tailwindcss/vite';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//         }),
//         tailwindcss(),
//     ],
//     server: {
//         hmr: {
//             host: 'localhost',
//         },
//         watch: {
//             ignored: ['**/storage/framework/views/**'],
//         },
//     },
// });