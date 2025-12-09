import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            // TAMBAHKAN BAGIAN INI
            colors: {
                'custom-orange': '#E67E22',
                // Anda bisa menambahkan variasi lain
                'custom-orange-dark': '#D35400',
            }
            
        },
    },

    plugins: [forms],
};
