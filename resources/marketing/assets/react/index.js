import React from 'react'
import ReactDOM from 'react-dom'
import {ShopifyProvider, ShopPayButton} from '@shopify/hydrogen-react';

function App() {
    return (
        <ShopifyProvider
            storeDomain="https://musora-sandbox-staging.myshopify.com/"
            storefrontToken="82a7622a525e4e4052c0e645aab32356"
            storefrontApiVersion="2023-01"
            countryIsoCode="CA"
            languageIsoCode="EN"
        >
            <AddVariantQuantity1 variantId="gid://shopify/Product/8540194275623" />
        </ShopifyProvider>
    );
}
function AddVariantQuantity1({variantId}) {
    return <ShopPayButton variantIds={[variantId]} />;
}

ReactDOM.render(<App />, document.getElementById('app'))
