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
                'card-shake': {
                    '0%, 100%': { transform: 'translateX(0) rotate(0)' },
                    '20%': { transform: 'translateX(-14px) rotate(-1deg)' },
                    '40%': { transform: 'translateX(12px) rotate(1deg)' },
                    '60%': { transform: 'translateX(-8px)' },
                    '80%': { transform: 'translateX(6px)' },
                },
            },
            animation: {
                'card-bounce': 'card-bounce 0.4s ease-out',
                'card-shake': 'card-shake 0.4s ease-in-out',
            },
        },
    },

    plugins: [forms],
};
