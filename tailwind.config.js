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
        extend: {
            spacing: {
                '30': '7.5rem',
                '88': '22rem',
                '112': '28rem',
                '128': '32rem',
                '144': '36rem',
            },
            backgroundImage: {
                'hero-image': 'var(--hero-image)',
            },
            container: {
                center: true,
                padding: {
                    xl: '5rem',
                    '2xl': '6rem',
                },   
            }
        },
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
            header: {
                DEFAULT: 'var(--color-header-text)',
            },
            title: {
                DEFAULT: 'var(--color-title-text)',
            },
            text: {
                DEFAULT: 'var(--color-text)',
            },
        },
    },

    plugins: [
        require('@tailwindcss/typography'),
    ],
};
