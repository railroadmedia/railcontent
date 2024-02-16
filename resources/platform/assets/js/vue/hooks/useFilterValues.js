export function useFilterValues() {
    const getFilterValues = (object) => {
        const formattedFilters = {};
        const numberFormat = /\s\(\d{1,}\)/;

        Object.keys(object).forEach((key) => {
            if(object[key].length > 0){
                formattedFilters[key] = [];
                object[key].map((o, i) => {
                    formattedFilters[key].push({
                        key: o,
                        value: o.replace(numberFormat, '')
                    });
                })
            }
        });

        const filters = [];

        if(Object.keys(formattedFilters).length > 0){
            for(const key of Object.keys(formattedFilters)){
                filters.push({
                    category: key,
                    items: formattedFilters[key]
                });
            }
        }

        return filters;
    }

    return { getFilterValues };
}
