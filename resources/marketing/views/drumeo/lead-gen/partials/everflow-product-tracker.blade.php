<script type='text/javascript' src='https://www.mcqn3fgtrk.com/scripts/sdk/everflow.js'></script>
<script type='text/javascript'>
    var addToCartText = 'add-to-cart';
    var advertiserId =  "{{ config('railanalytics.drumeo.production.providers.everflow.brand_id') }}"

    window.onload = function() {
        var elems = document.body.getElementsByTagName("a");
        if (!EF.getAdvertiserTransactionId(advertiserId)) {
            EF.click({
                offer_id: EF.urlParameter('oid'),
                affiliate_id: EF.urlParameter('affid'),
                transaction_id: EF.urlParameter('_ef_transaction_id'),
            }).then(function(transaction_id){
                console.log(transaction_id);
                for (var i = 0; i < elems.length; i++){
                    if (elems[i].href.includes(addToCartText)) {
                        var href = elems[i].href;
                        var separator = href.includes('?') ? '&' : '?';
                        elems[i].href = href + separator + '_ef_transaction_id=' + transaction_id;
                    }
                }
            });
        } else {
            for (var i = 0; i < elems.length; i++){
                if (elems[i].href.includes(addToCartText)) {
                    var href = elems[i].href;
                    var separator = href.includes('?') ? '&' : '?';
                    elems[i].href = href + separator + '_ef_transaction_id=' + EF.getAdvertiserTransactionId(advertiserId);
                }
            }
        }
    }
</script>
