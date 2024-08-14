<script setup>
const props = defineProps({
    classOverride: {
        type: String,
        default: ''
    },
    headTitles: {
        type: Array,
        default: () => ['Name', 'Date', 'Time', '']
    },
    rows: {
        type: Array,
        default: () => []
    },
    stickyHeader: {
        type: Boolean,
        default: false,
    }
});
const emit = defineEmits(['onActionClick', 'onScroll']);
</script>

<template>
    <div class="tw-w-full tw-relative tw-overflow-x-auto tw-shadow-md" :class="classOverride" @scroll="emit('onScroll', $event)">
        <table class="tw-w-full tw-text-left tw-text-[#0D0D0D] dark:tw-text-white">
            <thead
                class=" tw-h-[37px] tw-text-[16px] tw-text-[#0D0D0D] tw-bg-[#E6E7E9] dark:tw-bg-[#031d32] dark:tw-text-white tw-font-bold tw-rounded-t tw-overflow-hidden tw-hidden sm:tw-table-header-group"
                :class="stickyHeader ? 'tw-sticky tw-top-0 tw-z-30' : ''"
            >
                <tr>
                    <th v-for="(title, i) in headTitles" :key="i" scope="col" class="tw-px-6 tw-py-2" v-on:click="check">
                        {{ title }}
                    </th>
                </tr>
            </thead>
            <tbody class="tw-text-[14px]">
                <tr v-if="rows.length === 0">
                    <td colspan="4">
                        <div
                            class="tw-w-full tw-flex dark:tw-text-white tw-items-center tw-py-7 tw-flex-col tw-bg-[#F9F9F9] dark:tw-bg-[#00101D]"
                        >
                            <div class="tw-h-[55px] tw-w-[55px] tw-mb-[30px] tw-rounded-full tw-inline-flex tw-items-center tw-justify-center tw-text-white dark:tw-text-[#9EC0DC] tw-transition-colors tw-bg-[#223F57] dark:tw-bg-[#445F74] "
                            >
                                <musora-icon icon-name="playlist" class="tw-w-[36px]" />
                            </div>
                            <div>
                                <h1 class="tw-font-normal tw-font-open-sans tw-text-sm tw-mb-2">
                                    You haven't created any playlists yet.
                                </h1>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr v-else v-for="([firstCol, ...cols], index) in rows" :key="index"
                    :class="`${index % 2 === 0 ? 'tw-bg-[#F9F9F9] dark:tw-bg-[#071826]' : 'dark:tw-bg-[#00101D]'}`">
                    <th scope="row" class="tw-px-2 sm:tw-px-5 tw-py-2 tw-font-medium tw-whitespace-nowrap dark:text-white">
                        <div class="tw-flex tw-flex-row tw-w-full tw-h-full tw-items-center">
                            <div
                                class="tw-relative tw-overflow-hidden tw-bg-white dark:tw-bg-[#081825] tw-aspect-square tw-h-[58px] tw-w-[58px] tw-rounded tw-shrink-0"
                            >
                                <!-- Image Conatiner -->
                                <div class="tw-relative tw-w-full tw-h-full" v-if="firstCol.thumb">
                                    <img :src="`https://musora.com/cdn-cgi/image/width=200/${firstCol.thumb}`"
                                        alt="playlist thumbnail"
                                        class="tw-transition-opacity tw-opacity-0 tw-duration-500 tw-object-cover tw-object-center tw-w-full tw-h-full tw-blur-sm"
                                        loading="lazy" onload="this.classList.remove('tw-opacity-0')" />
                                    <!-- Image Mask -->
                                    <div
                                        class="tw-z-10 tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center">
                                        <img class="tw-h-full tw-object-contain"
                                            :src="`https://musora.com/cdn-cgi/image/width=330/${firstCol.thumb}`"
                                            alt="playlist thumbnail">
                                    </div>
                                </div>

                                <!-- placeholder (no image or items) -->
                                <div v-else
                                    class="tw-transition tw-flex tw-items-center tw-justify-center tw-w-full tw-h-full tw-bg-[#3F3F46] dark:tw-bg-[#445F74]">
                                    <svg class="tw-w-1/2 tw-h-1/2" width="79" height="79" viewBox="0 0 79 79" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <rect width="79" height="79" fill="url(#pattern0)" />
                                        <defs>
                                            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1"
                                                height="1">
                                                <use xlink:href="#image0_1473_92012" transform="scale(0.00444444)" />
                                            </pattern>
                                            <image id="image0_1473_92012" width="225" height="225"
                                                xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAYAAAA+s9J6AAAACXBIWXMAAAsTAAALEwEAmpwYAAAF8mlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNi4wLWMwMDYgNzkuZGFiYWNiYiwgMjAyMS8wNC8xNC0wMDozOTo0NCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0RXZ0PSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VFdmVudCMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIDIyLjQgKFdpbmRvd3MpIiB4bXA6Q3JlYXRlRGF0ZT0iMjAyMS0wOC0yNlQwMjowMToxNC0wNDowMCIgeG1wOk1vZGlmeURhdGU9IjIwMjEtMDgtMjZUMDI6MDI6MDUtMDQ6MDAiIHhtcDpNZXRhZGF0YURhdGU9IjIwMjEtMDgtMjZUMDI6MDI6MDUtMDQ6MDAiIGRjOmZvcm1hdD0iaW1hZ2UvcG5nIiBwaG90b3Nob3A6Q29sb3JNb2RlPSIzIiBwaG90b3Nob3A6SUNDUHJvZmlsZT0ic1JHQiBJRUM2MTk2Ni0yLjEiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6YTM4ZTA2NWQtYWMwYy1hNjQ5LTliZjYtYTg3YTIxYTQzY2QzIiB4bXBNTTpEb2N1bWVudElEPSJhZG9iZTpkb2NpZDpwaG90b3Nob3A6N2M5OGU1MjEtZTgyZi1jMzQ4LWFjMjgtOWU0MmYyNGQxZmRhIiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InhtcC5kaWQ6ODc5YTMzMzAtZGU1OS02YjRkLTkwMmItY2UxMDUwZTMzMmVlIj4gPHhtcE1NOkhpc3Rvcnk+IDxyZGY6U2VxPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iY3JlYXRlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo4NzlhMzMzMC1kZTU5LTZiNGQtOTAyYi1jZTEwNTBlMzMyZWUiIHN0RXZ0OndoZW49IjIwMjEtMDgtMjZUMDI6MDE6MTQtMDQ6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCAyMi40IChXaW5kb3dzKSIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0ic2F2ZWQiIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6YTM4ZTA2NWQtYWMwYy1hNjQ5LTliZjYtYTg3YTIxYTQzY2QzIiBzdEV2dDp3aGVuPSIyMDIxLTA4LTI2VDAyOjAyOjA1LTA0OjAwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgMjIuNCAoV2luZG93cykiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPC9yZGY6U2VxPiA8L3htcE1NOkhpc3Rvcnk+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+9BRjmAAADjRJREFUeJzt3W+IHdUZx/FvSpGy5EVZioQQl5NQbKqlWIxBtFYa+8ZAo7VVabUFEzSUKL5I/wjiC2lFpUqxGoqFKLQq9U8jja220ARK62rDWqTFNPgiOaaSSiupiCwi0u2LZ6571d29M3PO3GfuzO8Dy+yuOzNPrvd3z/w5c86qhYUFRMTPR7wLEOk7hVDEmUIo4kwhFHGmEIo4UwhFnCmEIs4UQhFnCqGIM4VQxJlCKOJMIRRxphCKOPuodwHSCduBq4ANxc9vFV+vASeAfwIv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" />
                                        </defs>
                                    </svg>
                                </div>

                                <!-- Lock Icon -->
<!--                                <div class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-[rgba(0,12,23,0.85)] tw-z-20 tw-flex tw-justify-center tw-items-center">-->
<!--                                    <musora-icon class="tw-w-[30px]" icon-name="lock-icon"></musora-icon>-->
<!--                                </div>-->
                            </div>
                            <div class="tw-ml-[10px]">
                                <span class="tw-font-bold">{{ firstCol.content }}</span>
                                <div class="tw-text-[#7E9AB1] sm:tw-hidden">
                                    <template v-for="(col, i) in cols" :key="`table-row-${i}`">
                                        <span v-if="!col.showActionSlot && col.content">{{ col.content }}</span><span v-if="i === 0"> | </span>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </th>
                    <td v-for="(col, i) in cols" :key="`table-row-${i}`" :class="`tw-px-2 sm:tw-px-5 tw-py-2 sm:tw-table-cell sm:tw-text-left tw-text-right ${!col.showActionSlot && col.content && 'tw-hidden'}`">
                        <span v-if="!col.showActionSlot && col.content">{{ col.content }}</span>
                        <button v-if="col.showActionSlot" @click="() => emit('onActionClick', col.actionPayload, index)">
                            <slot :tableIndex="index" :actionPayload="col.actionPayload" name="actionContent"></slot>
                        </button>
                    </td>
            </tr>
        </tbody>
    </table>
</div></template>
