<script setup>
import SquaredCard from "../../SquaredCard/SquaredCard.vue";
import SquaresContainer from "../../SquaredCard/SquaresContainer.vue";
import InstrumentCardContent from "../../SquaredCard/InstrumentCardContent.vue";
import ProgressBar from "../../ProgressBar/ProgressBar.vue";
import StepWrapper from "../StepWrapper.vue";
import StepHeader from "../StepHeader.vue";

import { brandUrl, bgImgCard } from "../../../../constants/brands";
import { saveInstrumentHistoryData } from "../services";
const props = defineProps({
  brand: {
    type: String,
  },
  steps: {
    type: Array,
  },
  info: {
    type: Object,
  },
});
const emit = defineEmits(["onChangeStep", "onCheckStep", "onChangeInfo"]);

function onInstrumentSelection(instrument) {
  saveInstrumentHistoryData({
    instrument: instrument,
  }).catch(error => { console.error(error) });
  emit("onChangeInfo", { ...props.info, user: props.info.user, instrument });
  emit("onCheckStep", 1, true);
  emit("onChangeStep", 2);
}
function goBack() {
  emit('onChangeStep', 0);
}
</script>

<template>
  <StepWrapper :brand="brand" :showBgImg="false" :showInstrumentBrand="false">
    <div class="
        tw-flex-grow
        md:tw-flex-grow-0
        md:tw-h-auto
        tw-w-full tw-flex tw-flex-col tw-items-center
        md:tw-justify-center
        tw-pt-[40px]
        md:tw-mt-0
        tw-overflow-y-scroll
      ">
      <StepHeader title="What instrument would you like to learn?" subtitle="Want to learn more than one instument? You can change your instrument at any
    time in your profile or by using the instrument selector in the navigation." @onGoBack="goBack" />
      <SquaresContainer>
        <SquaredCard :backgroundUrl="bgImgCard.drumeo" type="drumeo" :active="info.instrument === 'drums'"
          @onSelect="() => onInstrumentSelection('drums')">
          <InstrumentCardContent instrumentText="DRUMS" :logoUrl="brandUrl.drumeo" logoAltText="Drumeo Logo" />
        </SquaredCard>
        <SquaredCard :backgroundUrl="bgImgCard.pianote" :active="info.instrument === 'piano'" type="pianote"
          @onSelect="() => onInstrumentSelection('piano')">
          <InstrumentCardContent instrumentText="PIANO" :logoUrl="brandUrl.pianote" logoAltText="Pianote Logo" />
        </SquaredCard>
        <SquaredCard :backgroundUrl="bgImgCard.guitareo" :active="info.instrument === 'guitar'" type="guitareo"
          @onSelect="() => onInstrumentSelection('guitar')">
          <InstrumentCardContent instrumentText="GUITAR" :logoUrl="brandUrl.guitareo" logoAltText="Guitareo Logo" />
        </SquaredCard>
        <SquaredCard :backgroundUrl="bgImgCard.singeo" :active="info.instrument === 'singing'" type="singeo"
          @onSelect="() => onInstrumentSelection('singing')">
          <InstrumentCardContent instrumentText="SINGING" :logoUrl="brandUrl.singeo" logoAltText="Singeo Logo" />
        </SquaredCard>
      </SquaresContainer>
    </div>
    <div class="
        tw-justify-self-end
        md:tw-justify-self-center
        tw-flex tw-flex-col
        tw-items-center
        tw-pb-[30px]
        tw-pt-[10px]
        md:tw-pb-0
        md:tw-pt-0
      ">
      <ProgressBar :brand="brand" :currentStep="1" :steps="steps" @onChangeStep="(s) => emit('onChangeStep', s)" />
    </div>
  </StepWrapper>
</template>
