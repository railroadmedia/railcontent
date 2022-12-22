var Filters = {
    filterByPrice: function(minPrice, maxPrice){
        var scalableCard = $('.scalable-card');

        scalableCard.addClass('hide');

        scalableCard.each(function () {
            var thisPrice = $(this).data('price');

            if (thisPrice > minPrice && thisPrice < maxPrice) {
                $(this).removeClass('hide');
            }
        });
    },
    filterByCategory: function(category){
        var scalableCard = $('.scalable-card');
        var sections = $('.category-section');

        // scalableCard.addClass('hide');
        sections.addClass('hide');

        sections.each(function () {
            var thisCategory = $(this).data('category');
            var sectionCards = $(this).find('.scalable-card');

            if (category === 'all') {

                $(this).removeClass('hide');

                sectionCards.each(function(){
                    if($(this).hasClass('hide-on-sort')){
                        $(this).removeClass('hide');
                    }
                });
            }
            else {
                if (category === thisCategory) {
                    $(this).removeClass('hide');
                }
            }
        });
    }
};
var Sorting = {
    sortItems: function(sortValue, sortDirection){
        var sortItems = [];

        $('.scalable-card').each(function(){
            var thisItem = $(this),
                thisData = $(this).data(sortValue);

            sortItems.push({
                item: thisItem,
                data: thisData
            });
        });

        if(sortDirection === 'desc'){
            sortItems.sort(
                Sorting.dynamicSort('data')
            );
        }
        else {
            sortItems.sort(
                Sorting.dynamicSort('-data')
            );
        }

        $.each(sortItems, function(){
            var thisItem = $(this.item),
                lastItem = $(sortItems[sortItems.length - 1].item);

            thisItem.insertBefore(lastItem);
        });
    },
    sortInSection: function(sortValue, sortDirection){
        var sections = $('.category-section');

        sections.each(function(){
            var sortItems = [];
            var sectionCards = $(this).find('.scalable-card');

            sectionCards.each(function(){
                var thisItem = $(this),
                    thisData = $(this).data(sortValue);

                sortItems.push({
                    item: thisItem,
                    data: thisData
                });
            });

            if(sortDirection === 'desc'){
                sortItems.sort(
                    Sorting.dynamicSort('data')
                );
            }
            else {
                sortItems.sort(
                    Sorting.dynamicSort('-data')
                );
            }

            $.each(sortItems, function(){
                var thisItem = $(this.item),
                    lastItem = $(sortItems[sortItems.length - 1].item);

                thisItem.insertBefore(lastItem);
            });
        });
    },
    dynamicSort: function(property){
        var sortOrder = 1;

        if(property[0] === "-") {
            sortOrder = -1;
            property = property.substr(1);
        }
        return function (a,b) {
            var result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
            return result * sortOrder;
        };
    }
};

$(function () {
    $('.price-filter').on('click', function(){
        $('.price-filter').removeClass('active');
        $(this).addClass('active');

        var minPrice = $(this).data('min-price'),
            maxPrice = $(this).data('max-price');

        Filters.filterByPrice(minPrice, maxPrice);
    });

    $('.category-filter').on('click', function(){
        $('.category-filter').removeClass('active');
        $(this).addClass('active');

        var thisCategory = $(this).data('category');

        Filters.filterByCategory(thisCategory);
    });

    $('#sortOrder')
        .change(function () {
            switch($(this).val()){
                case 'Price: Low to High':
                    Sorting.sortItems('price', 'desc');
                    break;
                case 'Price: High to Low':
                    Sorting.sortItems('price', 'asc');
                    break;
            }
        });

    $('#sortBySection')
        .change(function () {
            switch($(this).val()){
                case 'Price: Low to High':
                    Sorting.sortInSection('price', 'desc');
                    break;
                case 'Price: High to Low':
                    Sorting.sortInSection('price', 'asc');
                    break;
            }
        });

    var cardLink = $('.scalable-card a');

    cardLink.click(function(e){
        var titleText = $(this).find('h4').text(),
            linkUrl = $(this).attr('href');

        dataLayer.push({
            'event': 'gtm.linkClick',
            'gtm.elementText': titleText,
            'gtm.elementUrl': linkUrl
        });
    });
});