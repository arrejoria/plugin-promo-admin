/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./admin/**/*.{php,html,js}","./public/**/*.{php,html,js}", ,"./includes/*.{php,html,js}"],
  theme: {
    screens: {
      'xs': '375px',
      // => @media (min-width: 375px) { ... }

      'sm': '576px',
      // => @media (min-width: 576px) { ... }

      'md': '960px',
      // => @media (min-width: 960px) { ... }

      'lg': '1440px',
      // => @media (min-width: 1440px) { ... }
    },
  },
  plugins: [],
}

