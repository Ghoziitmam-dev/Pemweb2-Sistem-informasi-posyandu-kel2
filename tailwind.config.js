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
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                emerald: {
                    50: '#EAF6EC', 100: '#DAF1DE', 200: '#BCDCC6', 300: '#8EB69B', 400: '#5E9275',
                    500: '#3E7A63', 600: '#235347', 700: '#163832', 800: '#0B2B26', 900: '#051F20',
                },
                slate: {
                    50: '#F1F9F3', 100: '#E3F2E7', 200: '#CFE3D5', 300: '#AFCBB8', 400: '#7FA08C',
                    500: '#55766A', 600: '#3C5A52', 700: '#2A4540', 800: '#163832', 900: '#0B2B26',
                },
            },
        },
    },

    plugins: [forms],
};