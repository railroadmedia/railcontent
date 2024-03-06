import Breadcrumb from './Breadcrumb.vue' // Adjust the import path as needed
import { ArrowLeftIcon, HomeIcon } from '@heroicons/vue/solid';

export default {
    title: 'Components/Breadcrumb',
    component: Breadcrumb,
    parameters: {
      design: {
        type: "figma",
        url: "https://www.figma.com/file/LKQ4FJ4bTnCSjedbRpk931/Sample-File",
      },
    },
    argTypes: {
        breadcrumbs: {
            control: 'object',
        },
        brand: {
            control: 'text',
        }
    },
};

const Template = (args) => ({
    components: { Breadcrumb, ArrowLeftIcon, HomeIcon },
    setup() {
        return { args };
    },
    template: `
    <Breadcrumb v-bind="args" />
  `,
});

export const Default = Template.bind({});
Default.args = {
    brand: 'drumeo',
    breadcrumbs: [{ "title": "songs", "url": "https://dev.musora.com:8443/drumeo/songs" }, { "title": "Super Mario Bros. Theme Song" }],
};

export const SingleBreadcrumb = Template.bind({});
SingleBreadcrumb.args = {
    brand: 'drumeo',
    breadcrumbs: [
        { title: 'First', url: '/first' }
    ],
};

export const LongBreadcrumbList = Template.bind({});
LongBreadcrumbList.args = {
    brand: 'drumeo',
    breadcrumbs: [
        { title: 'Home', url: '/home' },
        { title: 'Category', url: '/category' },
        { title: 'Subcategory', url: '/subcategory' },
        { title: 'Item', url: '/item' },
        { title: 'Detail', url: '/detail' }
    ],
};

export const WithoutUrls = Template.bind({});
WithoutUrls.args = {
    brand: 'drumeo',
    breadcrumbs: [
        { title: 'Home' },
        { title: 'Category' },
        { title: 'Subcategory' }
    ],
};
