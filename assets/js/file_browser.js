$(document).ready(function () {

    $(document).on('click', '.folder a, .drive a', function () {
        let clickedLi = $(this).parent('li');

        if (clickedLi.attr('action') == 'open') {
            clickedLi.find('ul').slideToggle("fast");
            return false;
        }

        if (clickedLi.attr('action') == '') {
            clickedLi.attr('action', 'open')
        }

        $( ".currentDir" ).html(clickedLi.attr('data_ref') );

        if(clickedLi.attr('class') == 'file') {
            if (!window.confirm("Download a file?")) {
                return false;
            }

            $.ajax({
                url: 'download.php?filepath=' + btoa(clickedLi.attr('data_ref')),
                type: 'POST',
                success: function() {
                    window.open('download.php?filepath=' + btoa(clickedLi.attr('data_ref')));
                }
            });
            return true;
        }

        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            data: {"path": clickedLi.attr('data_ref')},
            dataType: 'json',
            context: document.body,
            success: function () {

            }
        })
            .done(function (data) {
                let filetype;
                let href;
                let list = clickedLi.append('<ul>').find('ul');
                $.each(data, function (i, val) {

                    if (val.type == "D") {
                        filetype = 'folder';
                    }
                    else {
                        filetype = 'file';
                    }

                    list.append('<li action="" data_ref="' + val.full + '" class="' + filetype + '"><a href="#">' + val.base + '</a></li>').hide();
                });

                list.slideToggle("fast");

            });
        return false;
    });
});