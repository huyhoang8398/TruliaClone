const search = instantsearch({
    appId: 'MQ39V1L64H',
    apiKey: 'e6398a37ffd863822b19ae8a558ac92b',
    indexName: 'buy',
    routing: true
});


search.addWidget(
    instantsearch.widgets.searchBox({
        container: '#search-input',
        placeholder: 'Where do you want to search?',
        poweredBy: true,
        magnifier: true
    })
);

search.addWidget(
    instantsearch.widgets.sortBySelector({
        container: '#sort-by',
        autoHideContainer: true,
        indices: [
            {
                name: search.indexName,
                label: 'Most relevant',
            },
            {
                name: `${search.indexName}_price_asc`,
                label: 'Lowest price',
            },
            {
                name: `${search.indexName}_price_desc`,
                label: 'Highest price',
            }
        ]
    })
);

search.addWidget(
    instantsearch.widgets.stats({
        container: '#stats',
    })
);



search.addWidget(
    instantsearch.widgets.hits({
        container: '#hits',
        templates: {
            item: getTemplate('hit'),
            empty: getTemplate('no-results')
        }
    })
);


search.addWidget(
    instantsearch.widgets.pagination({
        container: '#pagination',
        scrollTo: '#search-input',
    })
);

search.addWidget(
    instantsearch.widgets.refinementList({
        container: '#category',
        attributeName: 'category',
        operator: 'or',
        templates: {
            header: getHeader('Category'),
        },
    })
);

function getTemplate(templateName) {
    return document.querySelector(`#${templateName}-template`).innerHTML;
}

function getHeader(title) {
    return `<h5>${title}</h5>`;
}

search.start();    