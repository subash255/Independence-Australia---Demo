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
                sans: ['Open Sans', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                fadeInOut: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '50%': { opacity: '1', transform: 'translateY(0)' },
                    '100%': { opacity: '0', transform: 'translateY(-20px)' },
                },
            },
            animation: {
                fadeInOut: 'fadeInOut 3s ease-in-out infinite',
            },
        },
    },

    plugins: [forms],
};
