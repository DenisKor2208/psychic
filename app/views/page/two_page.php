<?php $this->layout('template/template', ['title' => 'Two Page']) ?>

<?php $this->push('head') ?>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
          crossorigin="anonymous">
<?php $this->end() ?>

    <div class="row text-center bg-light mb-5 p-5">
        <div class="col">

            <form action="/openThreePage" class="mb-3" method="GET">

                <div class="row justify-content-center mb-4">
                    <?php echo flash()->display(); ?>
                    <div class="form-group col-4">
                        <?php echo flash()->display(); ?>
                        <label for="userNumber">Введите пожалуйста ваше число</label>
                        <input class="form-control form-control-lg" id="userNumber" name="user_number" >
                    </div>
                </div>

                <div class="row mb-4">
                    <?php echo $guesswork_psychics_in_HTML; ?>
                </div>

                <p>
                    <button type="submit" class="btn btn-secondary btn-lg">Результат</button>
                </p>

            </form>
            <button onclick="window.location.href = '/clearSession';" class="btn btn-info btn-lg">Начать заново</button>
        </div>
    </div>



<?php $this->insert('main_table', [
                                        'name_psychic_in_HTML' => $name_psychic_in_HTML,
                                        'history_step_data_in_HTML' => $history_step_data_in_HTML,
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

