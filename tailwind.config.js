/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#EDF7ED',
                    300: '#7BC47D',
                    500: '#2E9D30',
                    600: '#258026',
                    700: '#1B631C',
                },
                ink: {
                    DEFAULT: '#10201A',
                    700: '#1B5F1D',
                },
                paper: {
                    DEFAULT: '#FAF8F4',
                },
                clay: {
                    50: '#FBF4EF',
                    300: '#D4A07A',
                    500: '#A8531F',
                    600: '#874118',
                },
            },
            fontFamily: {
                display: ['"Space Grotesk"', 'sans-serif'],
                body: ['Inter', 'sans-serif'],
            },
            maxWidth: {
                content: '72rem',
            },
        },
    },
    plugins: [],
};
