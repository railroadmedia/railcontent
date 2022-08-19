<div 
    class="input-field" 
    {{-- x-bind:disabled="disabled" --}}
    x-data="{ 
        dropdownMenuOpen : false,
        activeCategory : '',
        selectedValue : false,
        placeholder : '{{$placeholder}}',
    }"
>
    <label id="{{$id}}" class="label text-[#00101D] dark:text-white">
        <span class="text-red-500 @if(empty($required)) hidden @endif">*</span>
        {{ $label }}
    </label>

    <div class="input-wrapper">
        {{-- <!-- Dropdown Trigger / Label --> --}}
        <button 
            type="button"
            class="text-sm h-12 transition-all py-1 leading-4 dark:bg-[#00101D] dark:text-[#9EC0DC] dark:border-[#445F74]"
            x-bind:class="formData.selectedOption && 'bg-gray-100'"
            x-on:click="dropdownMenuOpen = ! dropdownMenuOpen;"
            x-on:keyup.esc="dropdownMenuOpen = false"
            aria-haspopup="listbox" 
            aria-expanded="true" 
            aria-labelledby="{{$id}}"
            @if(!empty($required)) aria-required="required" @endif
            {{-- x-bind:aria-invalid="invalid" --}}
            ref="dropdownButton"
            tabindex="0"
        >
            {{-- <!-- Dropdown Selected Text --> --}}
            <span x-text="formData.selectedOption || placeholder"></span>

            {{-- <!-- Icons --> --}}
            <span class="input-icon">
                {{-- <!-- Heroicon name: solid/exclamation-circle --> --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="invalid-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{-- <!-- Heroicon name: solid/chevron-down --> --}}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </span>
        </button>

        {{-- <!-- Clear input --> --}}
        <button 
            x-if="selectedValue"
            tabindex="0"
            x-on:click="formData.selectedOption = ''"
            class="h-12 w-12 border border-solid border-gray-300 absolute bg-white top-0 right-0 flex items-center justify-center p-0"
            x-bind:class="formData.selectedOption === '' && 'hidden'"
            {{-- x-bind:class="themeFocusBorder" --}}
        >
            <span 
                class="h-6 w-6 cursor-pointer"
                {{-- x-bind:class="themeTextClass"  --}}
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
        </button>

        {{-- <!-- Separate the Dropdown from the Ul's - Make the container full width --> --}}
        <div 
            x-show="dropdownMenuOpen"
            tabindex="-1"
            x-on:mouseleave="dropdownMenuOpen = false; activeCategory = ''"
            x-on:keyup.esc="dropdownMenuOpen = false; activeCategory = ''"
            class="dropdown-wrapper w-full md:w-auto absolute h-auto border border-solid border-gray-200 z-10 shadow-lg overflow-auto md:border-none md:shadow-none md:h-64 md:overflow-initial md:mt-0"
        >
            <ul class="dropdown text-sm w-full border-none max-h-full relative overflow-initial mt-0 rounded-md md:border md:w-72"  
                role="listbox" 
                x-on:aria-labelledby="id" 
                aria-activedescendant="listbox-option-3"
            >
                @foreach ($listData as $key => $category)
                    <li
                        key="{{$key}}"
                        class="with-dropdown md:bg-transparent"
                        x-on:class="activeCategory === {{$key}} ? 'bg-gray-200' : 'bg-transparent'"
                    >   
                        {{-- <!-- no submenu --> --}}
                        @if(empty($category['options']))
                            <input 
                                type="radio" 
                                id="category-{{$key}}" 
                                name="{{$name}}" 
                                value="{{$category['label']}}" 
                                checked="{{$category['selected']}}"
                                x-model="formData.selectedOption"
                                x-on:change="selectedValue = {{$category['label']}}"
                            >

                            <label 
                                for="category-{{$key}}" 
                                class="option" 
                                {{-- x-bind:class="selectedOption === category.label ? themeBgClass : ''" --}}
                                tabindex="0"
                                role="option"
                                x-on:mouseover="activeCategory = ''"
                                x-on:keyup.enter="selectedOption = {{$category['label']}}"
                            >
                                <span>{{ $category['label'] }}</span>
                            </label>
                        @else
                            <div 
                                class="option" 
                                tabindex="0"                        
                                x-on:mouseover="activeCategory = {{$key}}"
                                x-on:click="activeCategory = {{$key}};"
                                x-on:keyup.enter="activeCategory = activeCategory === {{$key}} ? '' : {{$key}}"
                            >
                                <span>{{ $category['label'] }}</span>
                                <span class="input-icon h-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                            viewBox="0 0 20 20" 
                                            fill="currentColor" 
                                            class="transform rotate-90 md:rotate-0" 
                                            x-bind:class="activeCategory === {{$key}} ? '-rotate-90' : 'rotate-90'"
                                    >
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </div>
                        @endif

                        {{-- <!-- Sub navigation --> --}}
                        @if(!empty($category['options']))
                            <div 
                                x-show="activeCategory === {{$key}}" 
                                class="relative w-full z-1 md:top-0 md:left-full md:pl-1 md:absolute md:h-auto"
                                x-on:mouseleave="dropdownMenuOpen = false; activeCategory = ''"
                            >
                                <ul class="dropdown subdropdown mt-0 top-0 text-sm overflow-initial relative shadow-none rounded-none border-none md:border md:shadow-lg md:rounded-md md:ml-1">
                                    @foreach ($category['options'] as $subKey => $option)
                                    <li>
                                        <input type="radio" 
                                            id="option-{{$subKey}}{{$key}}" 
                                            name="{{$name}}" 
                                            value="{{$option['value']}}"
                                            checked="{{$option['checked']}}"
                                            x-model="formData.selectedOption"
                                            x-on:change="dropdownMenuOpen = false"
                                            {{-- x-on:change="selectOption(i,j)" --}}
                                        >
                                        <label 
                                            for="option-{{$subKey}}{{$key}}" 
                                            class="option pl-6 md:pl-4" 
                                            {{-- x-bind:class="selectedOption === option.value ? themeBgClass : ''" --}}
                                            tabindex="0"
                                            role="option"
                                            x-on:keyup.enter="selectedOption = option.value"
                                        >
                                            <span>{{ $option['label'] }}</span>
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Error Message -->
        {{-- <p class="input-message">{{ errorMessage }}</p> --}}
    </div>

    {{-- <!-- <code class="text-xs"><pre>{{ this.listData }}</pre></code> --> --}}
</div>



<script>
export default {
    name: 'MultiLevelDropdown',
    //props
    props: {
        id: {
            type: String,
            required: true
        },
        name: {
            type: String,
            required: true
        },
        label: {
            type: String,
            required: true
        },
        placeholder: {
            type: String,
            default: 'Select an Option',
        },
        listData: {
            type: Array,
            required: true
        },
        selectedValue: {
            type: String,
            default: '',
        },
        disabled: {
            type: Boolean,
            default: false
        },
        required: {
            type: Boolean,
            default: false
        },
        invalid: {
            type: Boolean,
            default: false
        },
        errorMessage: {
            type: String,
            default: ''
        },
        theme: {
            type: String,
            default: ''
        }
    },

    // data
    data() {
        return {
            dropdownMenuOpen: false,
            activeCategory: '',
            selectedOption: '',
        }
    },

    // methods
    methods: {
        log(option){
            console.log(option)
        },
        closeOnHover() {
            const medium = '(min-width: 768px)';
            if(window.matchMedia(medium).matches){
                this.activeCategory = '';
            }
        },
        closeDropdowns() {
            this.dropdownMenuOpen = false;
            this.activeCategory = '';
        },
        clearSelectedValue() {
            this.selectedOption = '';
        },
        openSubOnHover(i) {
            const medium = '(min-width: 768px)';
            if(window.matchMedia(medium).matches){
                this.activeCategory = i;
            }
        },
        openSubOnClick(i) {
            const medium = '(max-width: 767px)';
            if(window.matchMedia(medium).matches){
                this.activeCategory = this.activeCategory === i ? '' : i;
            }
        },

        selectOption(cat_index, opt_index) {
            this.listData.forEach( function(category,i,catarr) {
                if(category === catarr[cat_index]) {
                    category.selected = true;  
                } else {
                    category.selected = false;
                }

                if(category.options) {
                    category.options.forEach( function(option, j, optarr) {
                        if(option === optarr[opt_index] && category === catarr[cat_index]) {
                            option.checked = true;
                        } else {
                            option.checked = false;
                        }
                    })
                }
            })
            this.closeDropdowns()
        },
    },

    // computed
    computed: {
        themeBgClass() {
            return 'bg-'+this.theme;
        },
        themeTextClass() {
            return 'text-'+this.theme;
        },
        themeFocusBorder() {
            return 'focus:border-'+this.theme;
        }
    },

    //watchers
    watch: {
        selectedOption: function(val) {
            this.$emit('updateValue', val);
        },
        
        selectedValue: function(value) {
            if(!value.length) {
                this.clearSelectedValue();
            }
        } 
    }
}
</script>