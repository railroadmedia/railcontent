<div class="tw-flex tw-flex-row tw-flex-auto pa-3 tw-text-black dark:tw-text-white tw-py-3">
    @foreach($allBrands as $brand)
        <span class="tw-inline-flex tw-flex-row form-group tw-items-center mr-2">
             <a class="tw-no-underline tw-transition"
                :href="'?selected-brand={{ $brand }}'"
             >
                  <h3
                      class="{{$selectedBrand == $brand ? 'capitalize tw-text-black dark:tw-text-white tw-border-0 tw-border-solid tw-border-b-[3px]' : 'capitalize tw-text-gray-400 hover:tw-text-gray-500'}}"
                  >
                      {{ $brand }}
                  </h3>
            </a>
        </span>
    @endforeach
</div>
