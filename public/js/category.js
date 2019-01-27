const C_ITEM = '<li data-cat=\'<%JSON.stringify(this)%>\'><%this.name%><span class="remove-item"></span><span class="child-items"></span></li>';
const C_ITEM_LOOP = '<li data-cat=\'<%JSON.stringify(this[index])%>\'><%this[index].name%><span class="remove-item"></span><span class="child-items"></span></li>';

document.addEventListener("DOMContentLoaded", function () {

    function addItem(e) {
        if (e.target.classList.contains('active')) {
            e.target.classList.remove('active');
        }
        var newItemForm = document.getElementById('new-item-form-wrapper');
        if (newItemForm.classList.contains('new-hide')) {
            newItemForm.classList.remove('new-hide');
        }
        document.getElementById('new-item-form').addEventListener("submit", function (event) {
            event.preventDefault();
            var form = event.target;
            var data = new FormData(form);

            ajax.setContentType(form.enctype);
            ajax.post('category', data).success(function (data) {
                document.getElementById("categories-list").insertAdjacentHTML('beforeend', view.render(C_ITEM, data.category));
                event.target.parentNode.classList.add('new-hide');
                e.target.classList.add('active');
            })
                .error(function () {

                })
        })
    }

    function removeItem(e) {
        var api = e.target.parentNode.parentNode.dataset.api;
        var category = JSON.parse(e.target.parentNode.dataset.cat);
        ajax.delete(api+'/'+category.item_id).success(function (data) {
            e.target.parentNode.parentNode.removeChild(e.target.parentNode);
        }).error(function (data) {

        })
    }

    function getChilds(e) {
        e.preventDefault();
        var api = e.target.parentNode.parentNode.dataset.api;
        var category = JSON.parse(e.target.parentNode.dataset.cat);
        ajax.get(api+'/'+category.item_id).success(function (data) {
            var template =
                'BRANDS:' +
                '<ul data-api="brand">' +
                '<%for(var index in this) {%>' +
                C_ITEM_LOOP +
                '<%}%>' +
                '</ul>';
            document.getElementById("brands-list").innerHTML = view.render(template, data.items);
            var removeSelection = document.getElementsByClassName('remove-item');
            [].forEach.call(removeSelection, function (e) {
                e.addEventListener('click', removeItem);
            });
            var moreSelection = document.getElementsByClassName('child-items');
            [].forEach.call(moreSelection, function (e) {
                e.addEventListener('click', getChilds);
            });

        })
            .error(function (data) {

            });
    }

    document.getElementById('add-item').addEventListener('click', addItem);

    ajax.get('category')
        .success(function (data) {
            var template =
                '<%for(var index in this) {%>' +
                C_ITEM_LOOP +
                '<%}%>';
            document.getElementById("categories-list").innerHTML = view.render(template, data.items);

            var removeSelection = document.getElementsByClassName('remove-item');
            [].forEach.call(removeSelection, function (e) {
                e.addEventListener('click', removeItem);
            });

            var moreSelection = document.getElementsByClassName('child-items');
            [].forEach.call(moreSelection, function (e) {
                e.addEventListener('click', getChilds);
            });
        })
        .error(function (data) {

        });

});