/*
    This file exports the theme settings you will 
    be able to 'extend' in you tailwind.config.js
*/

module.exports = {
  //FONTS
  fontFamily: {
    primary: ['"Open Sans"', "Century Gothic", "sans-serif"],
    "roboto-condensed": ['"Roboto Condensed"', "Segoe UI", "sans-serif"],
    "bison-bold": ['"Bison Bold"', "Impact"],
    "permanent-marker": ["Permanent Marker", "Brush Script MT", "cursive"],
    "bebas-neue": ["Bebas Neue", "cursive"]
  },
  //COLORS
  colors: {
    //Brands Colors
    drumeo: {
      50: "#F3F4F5",
      100: "#E7F1FB",
      200: "#B2D4F4",
      300: "#6DADE9",
      400: "#3C91E2",
      500: "#0B76DB", //DEFAULT
      DEFAULT: "#0B76DB",
      600: "#095EAF",
      700: "#074783",
      800: "#112E4A",
      900: "#13171B",
    },
    drumeoBasic: {
      50: "#F3F4F5",
      200: "#B2D4F4",
      500: "#0B76DB", //DEFAULT
      DEFAULT: "#0B76DB",
      800: "#112E4A",
      900: "#13171B",
    },
    pianote: {
      50: "#F6F5F5",
      100: "#FEE8EA",
      200: "#FCB8BF",
      300: "#FA7683",
      400: "#F73346",
      500: "#F61A30",
      DEFAULT: "#F61A30",
      600: "#AC1222",
      700: "#7B0D18",
      800: "#55171D",
      900: "#201617",
    },
    pianoteBasic: {
      50: "#F6F5F5",
      200: "#FCB8BF",
      500: "#F61A30",
      DEFAULT: "#F61A30",
      800: "#55171D",
      900: "#201617",
    },
    guitareo: {
      50: "#F2F4F3",
      100: "#E6FAF7",
      200: "#CCF4EE",
      300: "#A8EDE3",
      400: "#66DFCD",
      500: "#00C9AC", //DEFAULT
      DEFAULT: "#00C9AC",
      600: "#00A18A",
      700: "#007967",
      800: "#0C443C",
      900: "#101817",
    },
    guitareoBasic: {
      50: "#F2F4F3",
      300: "#A8EDE3",
      500: "#00C9AC", //DEFAULT
      DEFAULT: "#00C9AC",
      800: "#0C443C",
      900: "#101817",
    },
    singeo: {
      50: "#F4F3F5",
      100: "#F3E6FD",
      200: "#DAB3F8",
      300: "#B566F2",
      400: "#9C33ED",
      500: "#8300E9", //DEFAULT
      DEFAULT: "#8300E9",
      600: "#6900BA",
      700: "#4F008C",
      800: "#320E4F",
      900: "#18131C",
    },
    singeoBasic: {
      50: "#F4F3F5",
      200: "#DAB3F8",
      500: "#8300E9", //DEFAULT
      DEFAULT: "#8300E9",
      800: "#320E4F",
      900: "#18131C",
    },
    recordeo: {
      50: "#F6F5F4",
      100: "#FFEFCC",
      200: "#FFE3A7",
      300: "#FFCE66",
      400: "#FFBE33",
      500: "#FFAE00", //DEFAULT
      DEFAULT: "#FFAE00",
      600: "#CC8B00",
      700: "#996800",
      800: "#563F0F",
      900: "#1E1B14",
    },
    recordeoBasic: {
      50: "#F6F5F4",
      200: "#FFE3A7",
      500: "#FFAE00", //DEFAULT
      DEFAULT: "#FFAE00",
      800: "#563F0F",
      900: "#1E1B14",
    },
    //Dark Mode
    dm: {
      "mild-blue": "#7E9AB1",
      "gray-blue": "#445F74",
      "royal-blue": "#002039",
      "dark-blue-1": "#081825",
      "dark-blue-2": "#000C17",
      "dark-blue-3": "#00101D",
    },
  },
  //FONT SIZES
  fontSize: {
    13: ["13px", "16.25px"],
    32: ["32px", "1.5"],
    54: ["54px", "1"],
  },
  //SPACING
  spacing: {
    md: "28rem",
    14: "3.5rem",
    44: "11rem",
    68: "17rem",
    72: "18rem",
    80: "20rem",
    92: "23rem",
  },
  //Z-INDEX
  zIndex: {
    0: 0,
    10: 10,
    20: 20,
    30: 30,
    40: 40,
    50: 50,
    75: 75,
    100: 100,
    150: 150,
    200: 200,
    250: 250,
    auto: "auto",
  },
  //INSETS
  inset: {
    0: 0,
    1: "1rem",
    2: "2rem",
    3: "3rem",
    4: "4rem",
    5: "5rem",
    auto: "auto",
    "-full": "100%",
  },
};
