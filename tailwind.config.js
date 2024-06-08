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
            container: {
                center: true,
                padding: {
                    DEFAULT: '1.25rem',
                    lg: '2rem',
                    xl: '5rem',
                    '2xl': '6rem',
                },   
            }
        },
        colors: {
            background: {
                DEFAULT: 'var(--color-background)',
            },
            backgroundSecondary: {
                DEFAULT: 'var(--color-background-secondary)',
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
            footer: {
                DEFAULT: 'var(--color-footer)',
            },
        },
    },

    plugins: [
        require('@tailwindcss/typography'),
    ],
};
