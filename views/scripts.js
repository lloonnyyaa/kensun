$(document).ready(function () {

    // отправка форм
    $("form").submit(function (e) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: "POST",
        }).done(function (answer) {
            $('div#result').fadeIn(1000).html(answer);
            setTimeout(function () {
                $('div#result').fadeOut(1000);
            }, 1000);
        }).fail(function (xhr, status, error) {
            var err = xhr.responseText;
            alert(err);
        });

    });

    $('#confirm_order').click(function () {
        event.preventDefault();
        $.ajax({
            url: '//development.pp.ua/front/order',
            data: [],
            type: "POST",
        }).done(function (answer) {
            $('div#partners_table').html(answer);

        }).fail(function (xhr, status, error) {
            var err = xhr.responseText;
            alert(err);
        });
    });
});