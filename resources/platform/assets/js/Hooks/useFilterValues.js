export function useFilterValues() {
    const getFilterValues = (object) => {
        const formattedFilters = {};
        const numberFormat = /\s\(\d+\)/;

        Object.keys(object).forEach((key) => {
            if(object[key].length > 0){
                formattedFilters[key] = [];
                object[key].map((o, i) => {
                    formattedFilters[key].push({
                        key: o.type,
                        value: o.count
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

    //Format Sanity Tab Data to match existig implementation
    const formatTabData = (tabs, name) => {
        //Default
        if(tabs.length === 0) {
            return [
                {
                    value : `All ${name}`,
                    groupByView: false,
                    key: ""
                },
            ]
        }
        
        let formattedTabs = tabs.map( (tab) => {
            return {
                value: tab.name,
                groupByView: tab.is_group_by || false,
                key: tab.value,
                required: tab.is_required_field || false,
            }
        })
        return formattedTabs;
    }

    return { getFilterValues, formatTabData };
}
