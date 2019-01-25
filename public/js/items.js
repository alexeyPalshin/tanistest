document.addEventListener("DOMContentLoaded", function () {

    function addItem(e) {
        var newItemForm = document.getElementById('new-item-form-wrapper');
        if (newItemForm.classList.contains('new-hide')) {
            newItemForm.classList.remove('new-hide');
        }
        document.getElementById('new-item-form').addEventListener("submit", function (e) {
            e.preventDefault();
            var form = e.target;
            var data = new FormData(form);

            ajax.setContentType(form.enctype);
            ajax.post('category.php', data).success(function () {

            })
                .error(function () {

                })
        })
    }

    document.getElementById('add-item').addEventListener('click', addItem);

    ajax.get('category.php')
        .success(function (data) {
            var template =
                '<%for(var index in this) {%>' +
                '<li data-cat=\'<%JSON.stringify(this[index])%>\'><%this[index].name%><span class="next-items"></span></li>' +
                '<%}%>';
            document.getElementById("categories-list").innerHTML = view.render(template, data.categories);

            var but = document.getElementById('categories-list').childNodes;
            [].forEach.call(but, function (e) {
                e.addEventListener('click', function (e) {
                    e.preventDefault();
                    var category = JSON.parse(e.target.parentNode.dataset.cat);
                    ajax.get('category.php?cat_id=' + category.category_id).success(function (data) {
                        var template =
                            '<div class="column">' +
                            '<ul>' +
                            '<%for(var index in this) {%>' +
                            '<li data-cat=\'<%JSON.stringify(this[index])%>\'><%this[index].name%><span class="next-items"></span></li>' +
                            '<%}%>' +
                            '</ul>' +
                            '</div>';
                        document.getElementById("items-wrapper").insertAdjacentHTML('beforeend', view.render(template, data.brands));


                    })
                        .error(function (data) {

                        });
                }, false)
            })

        })
        .error(function (data) {

        });

});