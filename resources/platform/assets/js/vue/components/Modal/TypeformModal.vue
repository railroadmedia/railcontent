<script setup>
    const props = defineProps({
        brand: {
            type: String,
            default: 'drumeo'
        }
    });
</script>

<template>

    <div id="surveyModal" class="modal">
        <div class="flex flex-column corners-10">
            
                <div v-if="brand === 'drumeo'"
                     class="typeform-widget" 
                     data-url="https://form.typeform.com/to/rnPhq70s?typeform-medium=embed-snippet" 
                     style="width: 100%; height: 600px;">
                </div> 
            
                <div v-if="brand === 'pianote'"
                     class="typeform-widget" 
                     data-url="https://form.typeform.com/to/huIKxOSj?typeform-medium=embed-snippet" 
                     style="width: 100%; height: 600px;">
                </div> 
            
        </div>
    </div>

</template>
