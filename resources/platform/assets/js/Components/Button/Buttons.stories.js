import Button from "./MuButton";

export default {
  title: "Components/Button",
  component: Button,
  parameters: {
    design: {
      type: "figma",
      url: "https://www.figma.com/file/LKQ4FJ4bTnCSjedbRpk931/Sample-File",
    },
  },
};

const Template = (args) => ({
  components: { Button },
  setup() {
    return { args };
  },
  template: '<MuButton v-bind="args">My button</MuButton>',
});

export const Primary = Template.bind({});
export const Secondary = Template.bind({});