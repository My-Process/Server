/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    mode: 'jit',
    theme: {
        extend: {
            fontFamily: {
                'inter': ['"Inter"', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
