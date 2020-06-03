(function() {
    var client = algoliasearch('ONIEP5JA1K', '5644c1812f9387c7a88fba77395b9f87');
    var index = client.initIndex('products');
    var enterPressed = false;
    //initialize autocomplete on search input (ID selector must match)
    autocomplete('#aa-search-input',
        { hint: false }, {
            source: autocomplete.sources.hits(index, { hitsPerPage: 10 }),
            //value to be displayed in input control after user's suggestion selection
            displayKey: 'name',
            //hash of templates used when rendering dataset
            templates: {
                //'suggestion' templating function used to reder a single suggestion
                suggestion: function (suggestion) {
                    const markup = `
                        <div class="algolia-result">
                            <span>
                                <img src="${window.location.origin}/storage/${suggestion.image}" alt="img" class="algolia-thumb">
                                ${suggestion._highlightResult.name.value}
                            </span>
                            <span class="font-weight-bold text-muted">€${(suggestion.price / 100).toFixed(2)}</span>
                        </div>
                        <div class="algolia-details">
                            <span>${suggestion._highlightResult.details.value}</span>
                        </div>
                        
                    `;      
                    return markup;
                        // return '<span>' + 
                        // suggestion._highlightResult.name.value + '</span><span>' +
                        // suggestion.price + '</span>';
                },
                empty: function (result) {
                    return 'Sorry, we did not find any results for "' + result.query + '"';
                }
            }
        }).on('autocomplete:selected', function (event, suggestion, dataset) {
            window.location.href = window.location.origin + '/shop/' + suggestion.slug; // redirect origin URL + /shop/ + product-slug.
            enterPressed = true;    // To not overide events each other.
        }).on('keyup', function(event) {    // Event for 
            if (event.keyCode == 13 && !enterPressed) {  // Event waiting for ENTER key press.  13 is code for ENTER key, 
                window.location.href = window.location.origin + '/search-algolia?q=' + document.getElementById('aa-search-input').value;
            }
        });

    })();