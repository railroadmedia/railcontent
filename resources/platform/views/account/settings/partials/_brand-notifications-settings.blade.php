<div class="tw-flex tw-flex-row tw-flex-auto tw-p-3 tw-pb-0 tw-text-[#00101D] dark:tw-text-white">
    @foreach($allBrands as $brand)
        <span class="tw-inline-flex tw-flex-row form-group tw-items-center tw-mr-2 md:tw-mr-4">
             <a class="tw-no-underline tw-transition {{$selectedBrand == $brand ? 'tw-text-[#001017] dark:tw-text-white tw-border-0' : 'tw-text-[#717179] hover:tw-text-[#001017] dark:hover:tw-text-white dark:tw-text-[#80A0B9]'}}"
                :href="'?selected-brand={{ $brand }}'"
             >
                  <h3
                      class="tw-text-lg md:tw-text-2xl tw-capitalize  {{$selectedBrand == $brand ? 'tw-text-[#00101D] dark:tw-text-white tw-border-0 tw-border-solid tw-border-b-[3px]' : 'tw-text-gray-400 hover:tw-text-gray-500'}}"
                  >
                      {{ $brand }}
                  </h3>
            </a>
        </span>
    @endforeach
</div>
