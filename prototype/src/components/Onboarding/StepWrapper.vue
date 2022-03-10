<script setup>
import { bgImg } from '../../constants/brands'
const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    },
    showBgImg: {
        type: Boolean
    }
})
</script>

<template>
    <div
        :class="`StepWrapper StepWrapper--${brand}`"
        :style="showBgImg ? { backgroundImage: `url('${bgImg[brand]}')` } : {}"
    >
        <div
            :class="`StepWrapper__overlay ${
                showBgImg ? 'StepWrapper__overlay--gradient' : ''
            }`"
        >
            <slot />
        </div>
    </div>
</template>

<style>
.StepWrapper {
    position: relative;
    width: 100%;
    height: 100%;
    background-size: cover;
}

.StepWrapper__overlay {
    display: flex;
    position: absolute;
    width: 100%;
    height: 100%;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: #000c17;
}

.StepWrapper--drumeo .StepWrapper__overlay--gradient {
    background: linear-gradient(
            0deg,
            rgba(0, 32, 57, 0.55),
            rgba(0, 32, 57, 0.55)
        ),
        linear-gradient(0deg, rgba(11, 118, 219, 0.4), rgba(11, 118, 219, 0.4));
}

.StepWrapper--pianote .StepWrapper__overlay--gradient {
    background: linear-gradient(
            0deg,
            rgba(0, 32, 57, 0.46),
            rgba(0, 32, 57, 0.46)
        ),
        linear-gradient(0deg, rgba(246, 26, 48, 0.4), rgba(246, 26, 48, 0.4));
}

.StepWrapper--guitareo .StepWrapper__overlay--gradient {
    background: linear-gradient(
            0deg,
            rgba(0, 32, 57, 0.45),
            rgba(0, 32, 57, 0.45)
        ),
        linear-gradient(0deg, rgba(0, 201, 172, 0.2), rgba(0, 201, 172, 0.2));
}

.StepWrapper--singeo .StepWrapper__overlay--gradient {
    background: linear-gradient(
            0deg,
            rgba(131, 0, 233, 0.1),
            rgba(131, 0, 233, 0.1)
        ),
        linear-gradient(0deg, rgba(0, 32, 57, 0.45), rgba(0, 32, 57, 0.45));
}
</style>
