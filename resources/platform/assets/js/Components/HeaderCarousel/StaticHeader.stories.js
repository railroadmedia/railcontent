// StaticHeader.stories.js

import StaticHeader from './StaticHeader.vue';

export default {
  title: 'Components/Collections/StaticHeader',
  parameters: {
    design: {
      type: "figma",
      url: "https://www.figma.com/file/LKQ4FJ4bTnCSjedbRpk931/Sample-File",
    },
  },
  component: StaticHeader,
  argTypes: {
    topSubtitle: { control: 'text' },
    title: { control: 'text' },
    titleClasses: { control: 'text' },
    ctaText: { control: 'text' },
    description: { control: 'text' },
    ctaUrl: { control: 'text' },
    img: { control: 'text' },
    showSlide: { control: 'boolean' },
  },
};

const Template = (args) => ({
  components: { StaticHeader },
  setup() {
    return { args };
  },
  template: '<StaticHeader v-bind="args" />',
});

export const Primary = Template.bind({});
Primary.args = {
  topSubtitle: 'Sample subtitle',
  title: 'Sample title',
  titleClasses: 'sample-class',
  ctaText: 'Click me',
  description: 'This is a sample description for the static header.',
  ctaUrl: 'https://www.example.com',
  img: 'https://loremflickr.com/1920/1080',
  showSlide: true,
};

// Add more variants if needed
