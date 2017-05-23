<?php if (is_array($partners)) : ?>
    <h2 class="text-center">Установить купленное оборудование Вы сможете у одного из наших партнеров, которые находятся в Вашем регионе.</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Название</th><th>Адрес</th>
            </tr>
        </thead>
        <?php foreach ($partners as $partner) : ?>
            <tr>
                <td><?php echo $partner['name'] ?></td><td><?php echo $partner['address'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>    
    <input type="submit" class="btn btn-primary m-3" value="Отправить данные на почту" onclick="$('form#send_mail').show();">
    <form style="display:none" id="send_mail" action="//development.pp.ua/front/sendMail" method="post">
        <div class="form-group row">
            <label for="email" class="col-2 col-form-label">Ваш Email</label>
            <div class="col-4">
                <input id="email" type="text" name="email">
            </div>
            <div class="col-4">
                <input type="submit" class="btn btn-success" value="Отправить">
            </div>
        </div>
    </form>
    <div id="result"></div>
    <script>
        $('form#send_mail').submit(function (e) {
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
    </script>
    <?php include ROOT . '/views/map.php'; ?>
<?php else: ?>
    <p><?php echo $partners ?></p>
<?php endif; ?>