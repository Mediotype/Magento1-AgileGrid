function clearFilters(gridId) {
    var filters = $$('#' + gridId + ' .filter input', '.filter select');
    for (var i in filters) {
        filters[i].value = '';
    }
}

function loadFilter(gridId, filterString, filterName) {
    clearFilters(gridId);
    if (filterString != '') {

        filterString = decodeURI(filterString);
        var valuePairs = filterString.split('&');
        for (var i = 0; i < valuePairs.length; i++) {
            try {

                var data = valuePairs[i].split('=');
                var filter = $$("#" + gridId + " .filter [name='" + data[0] + "']");
                filter[0].value = data[1];
            } catch (exception) {
                console.log(exception);
            }
        }
    }

    eval(gridId + "JsObject.addVarToUrl('selectedFilterName', filterName);");
    eval(gridId + "JsObject.doFilter();");
}

function saveFilter(gridId, url) {

    var filters = $$('#' + gridId + ' .filter input', '#' + gridId + ' .filter select');
    var elements = [];
    for (var i in filters) {
        if (filters[i].value && filters[i].value.length) elements.push(filters[i]);
    }

    var filterValue = Form.serializeElements(elements);
    var filterName = false;
    var filterElm
    if ($$('#' + gridId + ' #filters')[0].value == '') {
        filterName = window.prompt('Filter Name');
        //Trim White Sapce
        if (filterName)
            filterName = filterName.trim();

    } else {
        filterName = $$('#' + gridId + ' #filters')[0].selectedOptions[0].innerHTML;
        if (!confirm('Are you sure you want to update ' + filterName + '?')) {
            filterName = false;
        }
    }

    if (filterName && filterName != '') {
        new Ajax.Request(
            url,
            {
                method: 'post',
                onComplete: function (v) {
                    loadFilter(gridId, filterValue, filterName);
                },

                parameters: {
                    name: filterName,
                    grid_id: gridId,
                    filter: filterValue
                }
            }
        );
    }
}

function deleteFilter(gridId, url) {
    var filterName = false;
    var filterElm
    filterName = $$('#' + gridId + ' #filters')[0].selectedOptions[0].innerHTML;
    if (!confirm('Are you sure you want to DELETE \'' + filterName + '\'?')) {
        filterName = false;
    }

    if (filterName && filterName != '') {
        new Ajax.Request(
            url,
            {
                method: 'post',
                onComplete: function (v) {
                    loadFilter(gridId, '', '');
                },

                parameters: {
                    name: filterName,
                    grid_id: gridId
                }
            }
        );
    }
}