<script type='text/javascript' src='https://ef-proxy.musora.com/scripts/sdk/everflow.js'></script>
<script type='text/javascript'>
    const addToCartText = 'add-to-cart';
    const advertiserId = "{{ $advertiserId }}";
    const efTransactionKey = '_ef_transaction_id';
    const extraDataKey = 'extra-data';

    function updateGoToCartTag(elems, transaction_id) {
        if (transaction_id) {
            for (let i = 0; i < elems.length; i++){
                if (elems[i].href.includes(addToCartText) && !elems[i].href.includes(efTransactionKey)) {
                    const href = elems[i].href;
                    const separator = href.includes('?') ? '&' : '?';
                    elems[i].href = href + separator + efTransactionKey + '=' + transaction_id;
                    // the sidebar cart uses meta-data included with the <a> tag, not the href value >.<
                    // See CartSidebar.addToCart for the complementary code
                    const originalProductDetails = elems[i].getAttribute(extraDataKey)
                    let jsonDetails = JSON.parse(originalProductDetails) ?? {}
                    jsonDetails[efTransactionKey] = transaction_id
                    const updatedProductDetails = JSON.stringify(jsonDetails)
                    elems[i].setAttribute(extraDataKey, updatedProductDetails)
                }
            }
        }
    }

    function everflowOnLoad()
    {
        var elems = document.body.getElementsByTagName("a");
        if (!EF.getAdvertiserTransactionId(advertiserId)) {
            EF.click({
                offer_id: EF.urlParameter('oid'),
                affiliate_id: EF.urlParameter('affid'),
                transaction_id: EF.urlParameter(efTransactionKey),
            }).then(function(transaction_id){
                updateGoToCartTag(elems, transaction_id);
            });
        } else {
            updateGoToCartTag(elems, EF.getAdvertiserTransactionId(advertiserId));
        }
    }
    if (window.addEventListener) {
        window.addEventListener('load', everflowOnLoad)
    } else {
        window.attachEvent('onload', everflowOnLoad)
    }
</script>
