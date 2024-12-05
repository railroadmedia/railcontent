<script setup>
import {ref, computed, onMounted} from 'vue'
import { storeToRefs } from 'pinia'
import UserInfo from './steps/UserInfo.vue'
import InstrumentSelect from './steps/InstrumentSelect.vue'
import InstrumentType from './steps/InstrumentType.vue'
import Experience from './steps/Experience.vue'
import Genre from './steps/Genre.vue'
import Topics from './steps/Topics.vue'
import Goals from './steps/Goals.vue'
import { initialSteps, instrumentBrand, brandInstrument } from './constants';
import { getInitialInfo, getCheckedSteps } from './utils';
import { useUserStore } from '@stores/user';

const props = defineProps({
  primaryBrand: {
    type: String,
    default: null,
  },
  startOnStep: {
    type: Number,
    default: null,
  },
  selectedBrand: {
    type: String,
    default: null,
  },
  configOptions: {
    type: Object,
  },
  selectedGear: {
    type: Object,
  },
  selectedTopics: {
    type: Object,
  },
  selectedGenres: {
    type: Object,
  },
  selectedExperience: {
    type: Object,
  },
  selectedGoals: {
    type: Object,
  },
  newUser: {
    type: Boolean,
    default: false,
  },
});


const userStore = useUserStore();
const { userId, userDisplayName, userProfilePictureUrl } = storeToRefs(userStore)

const currentStep = ref(0)
const info = ref(getInitialInfo({
    userId: userId.value,
    userDisplayName: userDisplayName.value,
    userProfilePictureUrl: userProfilePictureUrl.value,
    ...props,
    instrument: brandInstrument[props.selectedBrand],
}))
const steps = ref(initialSteps.default);
const skipSteps = ref([]);
const brand = computed(() => instrumentBrand[info.value.instrument]);

function changeStep (step) {
    if (step === 2) {
        const newSteps = getCheckedSteps({ ...props, steps: JSON.parse(JSON.stringify(steps.value)), brand: brand.value });
        steps.value = newSteps;
    }
    currentStep.value = step;
}

function changeInfo (newInfo) {
    info.value = newInfo;
}

function instrumentSelect (instrument) {
    steps.value = initialSteps[instrumentBrand[instrument]];
    steps.value[0].checked = true;
    steps.value[1].checked = true;
    changeInfo({ ...info.value, instrument });
}

function checkStepToggle (step, val) {
    const newSteps = steps.value;
    newSteps[step].checked = val
    steps.value = newSteps;
}

onMounted(() => {
  if (props.selectedBrand) {
    steps.value = initialSteps[props.selectedBrand];

    if (props.startOnStep) {
      const newSteps = [...steps.value];
      newSteps.forEach(({}, index) => {
        if (props.startOnStep >= index) {
          newSteps[index].checked = true;
        }
      });
      currentStep.value = props.startOnStep;
    } else {
      const newSteps = getCheckedSteps({
        ...props,
        steps: JSON.parse(JSON.stringify(steps.value)),
        brand: props.selectedBrand
      });
      steps.value = newSteps;
      const lastCheckedStep = newSteps.findLastIndex(idx => idx.checked);
      currentStep.value = lastCheckedStep > 0 ? lastCheckedStep : 0;
    }
  }
  
  if (props.newUser && props.primaryBrand) {
    skipSteps.value = [1];
    changeInfo({ ...info.value, user: info.value.user, instrument: brandInstrument[props.primaryBrand] });
  }
});

const resetSkipAndHiddenSteps = () => {
  skipSteps.value = [];
}

const shouldShowStep = (step) => {
  return step === steps.value[currentStep.value].key;
}
</script>

<template>
  <div class="tw-bg-[#000c17] tw-dark">
    <UserInfo :currentStep="currentStep" :skipSteps="skipSteps" :brand="brand" v-if="shouldShowStep('userInfo')" @onChangeStep="changeStep" @onChangeInfo="changeInfo"
              @onCheckStep="checkStepToggle" :steps="steps" :info="info" :config-options="configOptions"/>
    <InstrumentSelect :currentStep="currentStep" :skipSteps="skipSteps" @onResetSkipAndHiddenSteps="resetSkipAndHiddenSteps" :brand="brand" v-if="shouldShowStep('instrumentSelect')" @onChangeStep="changeStep" @onInstrumentSelect="instrumentSelect"
                      @onCheckStep="checkStepToggle" :steps="steps" :info="info" :config-options="configOptions"/>
    <InstrumentType :currentStep="currentStep" :skipSteps="skipSteps" :brand="brand" v-if="shouldShowStep('instrumentType')" @onChangeStep="changeStep" @onChangeInfo="changeInfo"
                    @onCheckStep="checkStepToggle" :steps="steps" :info="info" :config-options="configOptions"
                    :step-name="steps[currentStep].label"/>
    <Experience :currentStep="currentStep" :skipSteps="skipSteps" :brand="brand" v-if="shouldShowStep('experience')" @onChangeStep="changeStep" @onChangeInfo="changeInfo"
                @onCheckStep="checkStepToggle" :steps="steps" :info="info" :config-options="configOptions"
                :step-name="steps[currentStep].label"/>
    <Genre :currentStep="currentStep" :skipSteps="skipSteps" :brand="brand" v-if="shouldShowStep('genre')" @onChangeStep="changeStep" @onChangeInfo="changeInfo"
           @onCheckStep="checkStepToggle" :steps="steps" :info="info" :config-options="configOptions"
           :step-name="steps[currentStep].label"/>
    <Topics :currentStep="currentStep" :skipSteps="skipSteps" :brand="brand" v-if="shouldShowStep('topics')" @onChangeStep="changeStep" @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle" :steps="steps" :info="info" :config-options="configOptions"
            :step-name="steps[currentStep].label"/>
    <Goals :currentStep="currentStep" :skipSteps="skipSteps" :brand="brand" v-if="shouldShowStep('goals')" @onChangeStep="changeStep" @onChangeInfo="changeInfo"
           @onCheckStep="checkStepToggle" :steps="steps" :info="info" :config-options="configOptions"
           :step-name="steps[currentStep].label"/>
  </div>
</template>
