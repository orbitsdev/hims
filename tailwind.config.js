import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import preset from './vendor/filament/support/tailwind.config.preset'
const colors = require('tailwindcss/colors')
/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {


                green: colors.green,
                gray: colors.neutral,
                'tory-blue': {
                    '50': '#f0f7ff',
                    '100': '#e0edfe',
                    '200': '#b9dbfe',
                    '300': '#7bbffe',
                    '400': '#369ffa',
                    '500': '#0b82ec',
                    '600': '#0065c9',
                    '700': '#014fa1',
                    '800': '#054487',
                    '900': '#0b3a6f',
                    '950': '#07244a',
                },
                'mantis': {
                '50': '#f6faf3',
                '100': '#e9f5e3',
                '200': '#d3eac8',
                '300': '#afd89d',
                '400': '#82bd69',
                '500': '#61a146',
                '600': '#4c8435',
                '700': '#3d692c',
                '800': '#345427',
                '900': '#2b4522',
                '950': '#13250e',

                    },
                   'kaitoke-green': {
        '50': '#edfff7',
        '100': '#d6ffed',
        '200': '#afffdc',
        '300': '#71ffc3',
        '400': '#2cfca3',
        '500': '#01e684',
        '600': '#00bf6a',
        '700': '#009657',
        '800': '#067547',
        '900': '#064f32',
        '950': '#003620',
    },


            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

        },
    },

    plugins: [forms, typography],
};
