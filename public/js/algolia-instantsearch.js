(function() {
    
    const search = instantsearch({
        appId: 'ONIEP5JA1K',
        apiKey: '5644c1812f9387c7a88fba77395b9f87',
        indexName: 'products',
        urlSync: true
    });

    // container where the results go.
    search.addWidget(
        instantsearch.widgets.hits({
            container: '#hits',
            templates: {
                empty: 'No results',
                item: function(item) {
                    return `
                        <a href="${window.location.origin}/shop/${item.slug}">
                            <div class="instantsearch-result">
                                <div>
                                    <img src="${window.location.origin}/storage/${item.image}" alt="img" class="algolia-thumb-result">
                                </div>
                                <div>
                                    <div class="result-title">
                                        ${item._highlightResult.name.value}
                                    </div>
                                    <div class="result-details">
                                        ${item._highlightResult.details.value}
                                    </div>
                                    <div class="result-price">
                                        $${(item.price / 100).toFixed(2)}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <hr>
                    `;
                }
            }
        })
    );

    // Initialize SearchBox
    search.addWidget(
        instantsearch.widgets.searchBox({
            container: '#search-box',
            placeholder: 'Search for products'
        })
    );

    // Initialize pagination
    search.addWidget(
        instantsearch.widgets.pagination({
            container: '#pagination',
            maxPages: 20,
            // default is to scroll to 'body, here we disable this behavior
            scrollTo: false
        })
    );

    // initialize RefinementList
    search.addWidget(
        instantsearch.widgets.refinementList({
            container: '#refinement-list',
            attributeName: 'categories',
        })
    );

    search.addWidget(
        instantsearch.widgets.stats({
            container: '#stats-container'
        })
    );

    search.start();
})();