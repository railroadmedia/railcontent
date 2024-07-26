import { mount } from '@vue/test-utils'
import StaticHeader from './StaticHeader.vue'
import Slide from './Slide.vue'

describe('StaticHeader Component Test', () => {
  it('passes props to Slide component correctly', async () => {
    const topSubtitle = 'Top Subtitle';
    const title = 'Main Title';
    const titleClasses = 'text-lg font-bold';
    const ctaText = 'Call to Action';
    const description = 'This is a detailed description.';
    const ctaUrl = 'https://example.com';
    const img = 'https://example.com/image.jpg';
    const showSlide = true;

    const wrapper = mount(StaticHeader, {
      props: {
        topSubtitle,
        title,
        titleClasses,
        ctaText,
        description,
        ctaUrl,
        img,
        showSlide
      },
      global: {
        stubs: {
          Slide // Stub the Slide component
        }
      }
    });

    const slideComponent = wrapper.findComponent(Slide);
    expect(slideComponent.exists()).toBe(true);
    expect(slideComponent.props()).toEqual({
      topSubtitle,
      title,
      titleClasses,
      ctaText,
      description,
      ctaUrl,
      img,
      showSlide: true, // We expect showSlide to always be true as per StaticHeader's template
      animateDirection: "",
      brand: "",
      isPrevSlide: false,
      textContentOverride: "",
    });
  });
});
