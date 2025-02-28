import { breakpointsTailwind, useBreakpoints } from '@vueuse/core';
const breakpoints = useBreakpoints({
    ...breakpointsTailwind,
    '3xl': 1815,
});
const xxxlDesktop = breakpoints.greaterOrEqual('3xl');
const xxlDesktop = breakpoints.greaterOrEqual('2xl');
const xlDesktop = breakpoints.greaterOrEqual('xl');
const lgDesktop = breakpoints.greaterOrEqual('lg');

export const getCardNum = (props, cardNum, toggleSeeAllCard) => {

    //Challenge Carousel
    if(props.catalogueType === 'challenge-carousel'){
         if(window.innerWidth >= 692){
             cardNum.value = 2;
        } else{
             cardNum.value = 1;
        }
    }

    //Challenge
    else if(props.catalogueType === 'challenge'){
        if(xxxlDesktop.value){
            cardNum.value = 6;
        } else if(xlDesktop.value){
            cardNum.value = 5;
        } else if(lgDesktop.value){
            cardNum.value = 4;
        } else {
            cardNum.value = 20;
        }
    }

    //Challenge Awards
    else if(props.catalogueType === 'challengeAward'){
        if(xlDesktop.value){
            cardNum.value = 6;
        } else if(lgDesktop.value){
            cardNum.value = 4;
        } else {
            cardNum.value = 20;
        }
    }

    //Pack
    else if(props.catalogueType === 'pack'){
        cardNum.value = 1;
    }

    else {
        if(props.isMiniView){
            toggleSeeAllCard(false);
            if(window.innerWidth > 2256){
                cardNum.value = 10;
            } else if(window.innerWidth > 1536){
                cardNum.value = 8;
            } else if(window.innerWidth > 1280){
                cardNum.value = 6;
            } else if(window.innerWidth > 1024){
                cardNum.value = 4;
            } else {
                toggleSeeAllCard(true);
                cardNum.value = 6;
            }
        } else {
            if(xxlDesktop.value){
                cardNum.value = 5;
            } else if(lgDesktop.value){
                cardNum.value = 4;
            } else{
                cardNum.value = 20;
            }
        }
    }

}
