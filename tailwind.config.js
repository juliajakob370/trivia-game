import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.jsx',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                pixel: ['"Press Start 2P"', 'cursive'],
                retro: ['VT323', 'monospace'],
            },
            colors: {
                blush: '#FDF3F6',
                rose: {
                    light: '#F9E4EC',
                    DEFAULT: '#F2B8C6',
                    dark: '#D98CA0',
                },
                mauve: {
                    light: '#C97F98',
                    DEFAULT: '#A66584',
                    dark: '#7F4D6D',
                },
                plum: {
                    light: '#935979',
                    DEFAULT: '#6C4160',
                    dark: '#593554',
                },
            },
            keyframes: {
                'card-bounce': {
                    '0%': { transform: 'scale(1) rotate(0deg)' },
                    '30%': { transform: 'scale(1.18) rotate(-3deg)' },
                    '60%': { transform: 'scale(0.97) rotate(1deg)' },
                    '100%': { transform: 'scale(1.05) rotate(-1deg)' },
                },
            },
            animation: {
                'card-bounce': 'card-bounce 0.4s ease-out',
            },
        },
    },

    plugins: [forms],
};
