/*

TODO:
- Add light mode / dark mode support
- Test code in production

*/

const path = require('path');

module.exports = {
  stories: [
    "./Introduction.mdx",
    "./Components.mdx",
    "./StyleGuide/**/*.mdx",
    "./Components/**/*.mdx",
    "./Constants/**/*.mdx",
    "./Hooks/**/*.mdx",
    "./Libraries/**/*.mdx",
    "./Services/**/*.mdx",
    "./Stores/**/*.mdx",
    "../resources/platform/assets/js/**/*.stories.mdx",
    "../resources/platform/assets/js/**/*.stories.@(js|jsx|ts|tsx)"
  ],
  addons: [
    '@storybook/addon-docs',
    "@storybook/addon-links",
    "@storybook/addon-essentials",
    "@storybook/addon-interactions",
    "@storybook/addon-designs",
  ],
  framework: {
    name: "@storybook/vue3-webpack5",
    options: {
      builder: {
        useSWC: true,
      },
    },
  },
  docs: {
    autodocs: "tag",
  },
  parameters: {
    options: {
      storySort: {
        order: [
          'Introduction', 
          'Styleguide', 
          'Components',
          ['Introduction', 'Units', 'Collections'],
        ],
      },
    },
  },
  webpackFinal: async (config, { configType }) => {
    // Find and alter the rule for SASS/SCSS files
    config.module.rules.push({
      test: /\.scss$/,
      use: [
        'style-loader', // Creates `style` nodes from JS strings
        'css-loader',   // Translates CSS into CommonJS
        {
          loader: 'postcss-loader', // Processes CSS with PostCSS
          options: {
            postcssOptions: {
              plugins: [
                require('tailwindcss')('./resources/platform/tailwind.config.js'), // Path to your Tailwind config
                require('autoprefixer'),
              ],
            },
          },
        },
        'sass-loader' // Compiles Sass to CSS
      ],
      include: path.resolve(__dirname, '../'),
    });

    return config;
  },
};
