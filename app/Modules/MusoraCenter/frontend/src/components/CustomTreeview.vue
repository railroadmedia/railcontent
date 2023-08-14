<template>
    <div class="text-left mt-12">
        <v-subheader>JSON Output</v-subheader>
        <v-treeview
            :items="treeView"
            :transition="true"
        >
            <template
                slot="label"
                slot-scope="props"
            >
                <strong :class="brandTextColor">{{ props.item.name }}: </strong>
                <span :class="getTreeViewItemClass(props.item.val)">
                    {{ props.item.val || 'Object' }}
                </span>
            </template>
        </v-treeview>
    </div>
</template>
<script>
import brandColors from '../api/mixins.js';

export default {
    name: 'VCustomTreeview',
    mixins: [brandColors],
    props: {
        item: {
            type: Object,
        },
        objectName: {
            type: String,
            default: 'Content',
        },
    },
    computed: {
        treeView() {
            const vm = this;
            function parseIntoTreeView(object) {
                const treeView = [];

                Object.keys(object).forEach((key, index) => {
                    if (object[key] && typeof object[key] === 'object') {
                        treeView.push({
                            id: (index + 1),
                            name: key,
                            children: parseIntoTreeView(object[key]),
                        });
                    } else {
                        treeView.push({
                            id: (index + 1),
                            name: key,
                            val: object[key] ? object[key] : 'null',
                        });
                    }
                });

                return treeView;
            }

            return [{
                id: 1,
                name: this.objectName,
                children: parseIntoTreeView(this.item),
            }];
        },
    },
    methods: {
        getTreeViewItemClass(val) {
            if (val) {
                if (typeof val === 'number') {
                    return 'deep-purple--text lighten-2';
                }
                    
                if (val === 'null') {
                    return 'orange--text';
                }
                        
                return 'success--text';
            }

            return '';
        },
    },
};
</script>
