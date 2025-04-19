import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		'./vendor/laravel/jetstream/**/*.blade.php',
		'./storage/framework/views/*.php',
		'./resources/views/**/*.blade.php',
		"./vendor/developermithu/tallcraftui/src/**/*.php",


        "./vendor/wireui/wireui/src/*.php",
        "./vendor/wireui/wireui/ts/**/*.ts",
        "./vendor/wireui/wireui/src/WireUi/**/*.php",
        "./vendor/wireui/wireui/src/Components/**/*.php",

	],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                    primary: '#289cd9', // Coral
                    secondary: '#FFD700', // Gold
                    accent: '#32CD32', // Lime Green
                    neutral: '#F5F5DC', // Beige
                    info: '#289cd9', // Turquoise
                    success: '#3CB371', // Medium Sea Green
                    warning: '#FFA500', // Orange
                    error: '#FF4500', // Orange Red
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'), 
        require('@tailwindcss/typography'), 
        require('daisyui')
    ],

};
