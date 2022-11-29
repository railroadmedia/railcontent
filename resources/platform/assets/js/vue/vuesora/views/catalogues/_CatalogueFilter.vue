<template>
    <div class="flex flex-column ph-1 catalogue-filter" 
         :class="{'short-filter-container': shortFilterContainer, 'tw-w-full md:tw-w-1/4': isCoachesGrid}"
    >
        <div class="form-group">
            <select
                :id="filterName + 'Filter'"
                v-model="valueInterface"
                class="tw-pb-0 tw-text-[#00101D] dark:tw-text-white no-label tw-bg-white dark:tw-bg-transparent"
                :class="{'is-clearable': valueInterface}"
                :disabled="valueInterface"
                @keydown.prevent
            >
                <option
                    class="tw-text-[#00101D]"
                    selected
                    disabled
                    :value="null"
                >
                    {{ placeholderLabel }}
                </option>
                <option
                    class="tw-text-[#00101D]"
                    v-for="filter in sortedOptions"
                    :key="filter.key"
                    :value="filter.value"
                >
                    {{ filter.key }}
                </option>
            </select>

            <span
                v-if="valueInterface"
                class="cancel-filter"
                @click.stop="cancelFilter"
            >
                <i
                    class="fas fa-times"
                    :class="'text-' + themeColor"
                ></i>
            </span>
        </div>
    </div>
</template>
<script>
import Utils from '../../assets/js/classes/utils';

export default {
    name: 'CatalogueFilter',
    props: {
        filterName: {
            type: String,
            default: () => '',
        },
        filtersLabels:{
            type: Object,
            default: () => ({}),
        },
        item: {
            type: Array,
            default: () => [],
        },
        themeColor: {
            type: String,
            default: () => 'drumeo',
        },
        initialValue: {
            type: [String, Number],
            default: () => null,
        },
        isCoachesGrid: {
            type: Boolean,
            default: () => false,
        },
        loading: {
            type: Boolean,
            default: () => false,
        },
        shortFilterContainer: {
            type: Boolean,
            default: () => false,
        },
    },
    data() {
        return {
            filter_value: this.initialValue,
        };
    },
    computed: {
        valueInterface: {
            cache: false,
            get() {
                return this.initialValue;
            },
            set(value) {
                this.filter_value = value;

                this.$emit('filterChange', {
                    key: this.filterName,
                    value: this.filter_value,
                });
            },
        },

        sortedOptions() {
            return this.item;
        },

        placeholderLabel() {
            const labelMap = {
                difficulty: 'Skill Level',
                instructor: 'Instructor',
                topic: 'Topic',
                progress: 'Progress',
                artist: 'Artist',
                focus: 'Focus',
                style: 'Style',
                bpm: 'Tempo',
                type: 'Type',
                key: 'Key',
                key_pitch_type: 'Type',
                instrument: 'Instrument'
            };

            return this.filtersLabels[this.filterName] || labelMap[this.filterName];
        },
    },
    methods: {
        cancelFilter() {
            if (!this.loading) {
                this.valueInterface = null;
            }
        },
        toTitleCase: phrase => Utils.toTitleCase(phrase),
    },
};
</script>
<style>
.short-filter-container {
    max-width: 400px;
}
</style>
