import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                unesco: {
                    50: '#F0F7FF',
                    100: '#E0EFFF',
                    200: '#B8DCFF',
                    300: '#7AC0FF',
                    400: '#339FFF',
                    500: '#0077D4',
                    600: '#0061B0',
                    700: '#004C8C',
                    800: '#003666',
                    900: '#002242',
                },
                vitality: {
                    50: '#FFF1F2',
                    100: '#FFE1E4',
                    200: '#FFC8CE',
                    300: '#FFA0AB',
                    400: '#FF697B',
                    500: '#E63946',
                    600: '#CC202F',
                    700: '#A81422',
                    800: '#8A131E',
                    900: '#4C060D',
                },
                cosmic: {
                    950: '#050B17',
                    900: '#0B132B',
                    850: '#111C3D',
                    800: '#1C2541',
                    700: '#2A375C',
                }
            },
            backdropBlur: {
                xs: '2px',
                '2xl': '24px',
                '3xl': '32px',
            },
            boxShadow: {
                'glass-sm': '0 4px 20px -2px rgba(0, 0, 0, 0.05), 0 2px 6px -1px rgba(0, 0, 0, 0.02)',
                'glass': '0 8px 32px 0 rgba(0, 119, 212, 0.08), inset 0 1px 0 0 rgba(255, 255, 255, 0.6)',
                'glass-dark': '0 12px 40px 0 rgba(0, 0, 0, 0.35), inset 0 1px 0 0 rgba(255, 255, 255, 0.1)',
                'glow-unesco': '0 0 25px rgba(0, 119, 212, 0.45)',
                'glow-vitality': '0 0 25px rgba(230, 57, 70, 0.45)',
            }
        },
    },

    plugins: [forms, typography],
};
