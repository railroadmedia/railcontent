export function useFilterValues() {
    const getFilterValues = (object) => {
        const formattedFilters = {};
        const numberFormat = /\s\(\d+\)/;

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
                if(formattedFilters[key].length > 10){
                    const quotient = Math.ceil(formattedFilters[key].length/10);

                    for(let i = 0; i < quotient; i++){
                        filters.push({
                            category: key + `${i + 1}`,
                            items: formattedFilters[key].slice(1*i*10, (i+1)*10)
                        });
                    }
                } else {
                    filters.push({
                        category: key,
                        items: formattedFilters[key]
                    });
                }
            }
        }

        return filters;
    }

    return { getFilterValues };
}
