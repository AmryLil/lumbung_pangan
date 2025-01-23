/** @type {import('tailwindcss').Config} */
import daisyui from 'daisyui';
import flowbitePlugin from 'flowbite/plugin';

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        'jost': ['Jost', 'sans-serif'],
      },
    },
  },
  plugins: [
    daisyui,
    flowbitePlugin,
  ],
};
