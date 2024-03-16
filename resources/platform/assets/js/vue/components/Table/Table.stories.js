// Table.stories.js

import Table from './Table.vue'; // Adjust the path as necessary

export default {
  title: 'Components/Table',
  parameters: {
    design: {
      type: "figma",
      url: "https://www.figma.com/file/LKQ4FJ4bTnCSjedbRpk931/Sample-File",
    },
  },
  component: Table,
  argTypes: {
    classOverride: { control: 'text' },
    headTitles: { control: 'array' },
    rows: { control: 'array' },
    stickyHeader: { control: 'boolean' },
    onActionClick: { action: 'onActionClick' },
    onScroll: { action: 'onScroll' },
  },
};

const Template = (args, { argTypes }) => ({
  components: { Table },
  props: Object.keys(argTypes),
  setup() {
    return { args };
  },
  template: '<Table v-bind="args" />',
});

export const Empty = Template.bind({});
Empty.args = {
  classOverride: '',
  headTitles: ['Name', 'Date', 'Time', 'Action'],
  rows: [],
  stickyHeader: false,
};

export const Populated = Template.bind({});
Populated.args = {
  ...Empty.args,
  rows: [
    [{ thumb: '', content: 'Song 1' }, { content: '2022-01-01' }, { content: '12:00 PM' }, { showActionSlot: true, actionPayload: { id: 1 } }],
    [{ thumb: '', content: 'Song 2' }, { content: '2022-01-02' }, { content: '1:00 PM' }, { showActionSlot: true, actionPayload: { id: 2 } }]
  ],
};
