<?php $this->layout('template/template', ['title' => 'One Page']) ?>

<?php $this->push('head') ?>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
          crossorigin="anonymous">
<?php $this->end() ?>

    <div class="row text-center mb-5 bg-light p-5">
        <div class="col">
            <form action="/openTwoPage" class="mb-3" method="GET">
                <p class="h3 mb-3">Здравствуй Пользователь!</p>
                <p class="h3 mb-5">Загадай двузначное число</p>
                <button type="submit" class="btn btn-secondary btn-lg">Загадал</button>
            </form>
            <button onclick="window.location.href = '/clearSession';" class="btn btn-info btn-lg">Обнулить прогресс</button>
        </div>
    </div>



<?php $this->insert('main_table', [
                                        'array_name_psychic' => $array_name_psychic,
                                        'name_psychic_in_HTML' => $name_psychic_in_HTML,
                                        'history_step_data_in_HTML' => $history_step_data_in_HTML,
                                        'array_trust_psychic' => $array_trust_psychic,
                                        'trust_psychic_in_HTML' => $trust_psychic_in_HTML
                                    ]);
?>

<?php $this->push('scripts') ?>

<script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG"
        crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous">
</script>

<?php $this->end() ?>

