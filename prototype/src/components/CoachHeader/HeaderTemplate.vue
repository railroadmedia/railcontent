<script>
import imgix from 'imgix.js'

const colors = {
    drumeo: {
        solidBg: '#00101d',
        bgRgb: 'rgba(0, 16, 29, 0)',
        subtitle: '#7E9AB1',
    },
    guitareo : {
        solidBg: '#101817',
        bgRgb: 'rgba(0, 16, 29, 0)',
        subtitle: '#717179',
    },
    singeo: {
        solidBg: '#18131C',
        bgRgbStart: 'rgba(0, 16, 29, 0)',
        subtitle: '#717179',
    },
    pianote: {
        solidBg: '#201617',
        bgRgb: 'rgba(0, 16, 29, 0)',
        subtitle: '#717179',
    },
};

export default {
  name: 'HeaderTemplate',
  props: ['brand', 'backgroundImage', 'topSubtitle', 'bottomSubtitle', 'shortBio', 'actions'],
  setup(props, context) {
    return {
      colors,
      brandColors: colors[props.brand],
      imgix
    };
  }
}
</script>

<template>
  <section class="tw-grid xs:tw-grid-cols-1 sm:tw-grid-cols-1 md:tw-grid-cols-1 lg:tw-grid-cols-2 tw-gap-0">
    <div class="lg:tw-hidden tw-bg-top"
        :style="{
            backgroundColor: colors[brand]['solidBg'],
            backgroundImage: `url(${imgix(
                backgroundImage,
                []
            )})`,
            color: '#fff',
            backgroundSize: 'cover',
            minHeight: '25vh',
            backgroundPosition: '50%',
            }">
        <div :style="{
          width: '100%',
          height: '100%',
          background: `linear-gradient(180deg,${colors[brand]['bgRgbStart']} 50%,${ colors[brand]['solidBg'] })`,
        }"></div>
    </div>
    <div class="tw-text-white" :style="{ backgroundColor: brandColors['solidBg'] }">
        <div class="tw--mt-24 md:tw-mt-0 tw-text-center lg:tw-text-left md:tw-py-12 lg:tw-py-16 tw-py-12 md:tw-px-14 tw-px-6">
                <h2 v-if="topSubtitle" class="tw-uppercase tw-font-semibold tw-mb-2 tw-font-bold" :style="{
                  color: brandColors['subtitle'],
                  fontSize: '14px',
                  lineHeight: '24px',

                }">
                    {{ topSubtitle }}
                </h2>

            <h1 class="tw-mb-3 tw-uppercase tw-font-normal" :style="{
              fontSize: '40px',
              lineHeight: '36px',
            }">
                {{ $title }}
            </h1>
                <h2 v-if="bottomSubtitle" class="tw-uppercase tw-font-semibold tw-mb-2 tw-font-bold" :style="{
                  color: brandColors['subtitle'],
                  fontSize: '14px',
                  lineHeight: '24px',
                }">
                    {{ bottomSubtitle }}
                </h2>
            <h3 class="tw-mb-6 tw-font-normal" style="font-size: 14px; line-height: 24px;">
                {{ shortBio }}
            </h3>
            <div class="tw-flex tw-flex-col lg:tw-flex-row tw-items-center xl:tw-items-start tw-flex-wrap xl:tw-flex-nowrap">
                {{ actions }}
            </div>
        </div>
    </div>
    <div class="tw-hidden lg:tw-flex tw-bg-top"
        :style="{
          backgroundColor: colors[brand]['solidBg'],
            backgroundImage: `url(${imgix(
                backgroundImage,
                []
            )})`,
            color: '#fff',
            backgroundSize: 'cover',
            backgroundPosition: '50%',
        }">
        <div :style="{
          width: '100%',
          height: '100%',
          background: `linear-gradient(268deg,${colors[brand]['bgRgbStart']} }} 50%,${colors[brand]['solidBg']})`,
        }"></div>
    </div>
</section>
</template>
