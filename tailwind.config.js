/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.antlers.html',
        './resources/**/*.antlers.php',
        './resources/**/*.blade.php',
        './resources/**/*.vue',
        './content/**/*.md',
    ],

    theme: {
        colors: {
            background: {
                DEFAULT: 'var(--color-background)',
            },
            primary: {
                DEFAULT: 'var(--color-primary)',
            },
            secondary: {
                DEFAULT: 'var(--color-secondary)',
            },
            tertiary: {
                DEFAULT: 'var(--color-tertiary)',
            },
        },
    },

    plugins: [
        require('@tailwindcss/typography'),
    ],
};
