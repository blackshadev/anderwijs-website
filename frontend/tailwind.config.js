// tailwind.config.js

module.exports = {
    theme: {
        extend: {
            screens: {
                dark: { raw: '(prefers-color-scheme: dark)' },
            },
            colors: {
                'aw-green': '#51b848',
            },
        },
        fontFamily: {
            sans: ['"Fira Sans"', 'Arial', 'sans-serif']
        },
    },
}
