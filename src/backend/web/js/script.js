$(document).ready(function(){

    const grid = $('#language-list');
    const deleteButton = $('#delete-rows');

    deleteButton.click(function(){

        const languageIDs = grid.yiiGridView('getSelectedRows');

        if (languageIDs.length > 0) {
            const url = deleteButton.data('url');

            $.post({
                url: url,
                dataType: 'json',
                data: {data: languageIDs},
            }).done(function(data) {

                data.forEach(function (key) {
                    const tr = grid.find('tr[data-key=' + key + ']');
                    tr.remove();
                });

            })
            .fail(function(data) {
                console.log(data);
            })
        }
    });
});


