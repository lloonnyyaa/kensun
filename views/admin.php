<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="  crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script src="/views/scripts.js"></script>
        <title>Админ</title>
    </head>
    <body>
        <div class="container">
            <div id="result"></div>
            <h2>Параметры</h2>
            <form id="add_partner" action="//development.pp.ua/admin/updateConfig" method="post">
                <div class="form-group row">
                    <label for="radius" class="col-4 col-form-label">Радиус, км</label>
                    <div class="col-8">
                        <input id="radius" type="text" name="radius" value="<?php echo $radius?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ip_address" class="col-4 col-form-label">IP Адресс (для тестирования)</label>
                    <div class="col-8">
                        <input id="ip_address" type="text" name="ip" value="<?php echo !is_null($ip) ? $ip : ''?>">
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Обновить">
            </form>
            <hr>
            <h2>Добавить нового парнера</h2>
            <form id="add_partner" action="//development.pp.ua/admin/addPartner" method="post">
                <div class="form-group row">
                    <label for="partner_name" class="col-4 col-form-label">Название</label>
                    <div class="col-8">
                        <input id="partner_name" type="text" name="partner_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="partner_address" class="col-4 col-form-label">Адресс</label>
                    <div class="col-8">
                        <input type="text" id="partner_address" name="partner_address">
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Добавить">
            </form>
            
            <hr>
            
        </div>
    </body>
</html>