/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
        fontFamily:{
            'Bebas' :[ 'Bebas Neue', 'cursive']
        }
      },
    },
    plugins: [
        require('flowbite/plugin')
    ]
  }
