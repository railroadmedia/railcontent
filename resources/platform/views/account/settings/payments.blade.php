@extends('account.settings.layout')

@section('meta')
    <title>Payments | Musora</title>
@endsection

@section('edit-forms')
    <div id="editForm" class="tw-flex tw-flex-col">

        <div class="flex flex-row pa-3 flex-auto">
            <div class="flex flex-column">
                <div class="flex flex-row mb-3">
                    <h2 class="tw-font-bold tw-text-lg tw-text-[#00101D] dark:tw-text-white">Payment History</h2>
                </div>
                @if($shopifyOrders)
                    @foreach($shopifyOrders as $shopifyOrder)
                        <a href="{{ $shopifyOrder['statusUrl'] }}"
                           class="flex flex-row flex-wrap mb-1 text-black no-decoration"
                           target="_blank">
                            <div class="flex flex-column xs-12 md-4">
                                <div class="flex flex-row">
                                    <p class="tw-text-sm tw-font-bold tw-text-[#00101D] dark:tw-text-white">
                                        <i class="fal fa-file-pdf mr-1"></i>
                                        {{ Carbon\Carbon::parse($shopifyOrder['processedAt'])->format('F j, Y') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-column xs-12 md-8">
                                <div class="flex flex-row">
                                    <div class="flex flex-column tw-text-xs tw-italic tw-uppercase align-h-center xs-6 tw-text-[#00101D] dark:tw-text-white">
                                        {{ $shopifyOrder['itemsProductTitlesString'] }}
                                    </div>
                                    <div class="flex flex-column tw-text-xs tw-italic tw-uppercase align-h-right xs-3 tw-text-[#00101D] dark:tw-text-white">
                                        ${{ number_format($shopifyOrder['totalPrice'], 2, '.') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p class="body tw-text-[#00101D] dark:tw-text-white">You do not have any payments in your payment history.</p>
                @endif
            </div>
        </div>

    </div>
@endsection

@section('layout-scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endsection
