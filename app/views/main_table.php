<div class="row bg-light pt-3">

    <div class="table-responsive">

        <table class="table table-striped table-bordered text-center align-middle">

            <thead>
            <tr class="table-primary">
                <th>#</th>
                    <?php echo $name_psychic_in_HTML ?>
                    <th>Пользователь</th>
            </tr>
            </thead>

            <tbody>

            <!--Блок результатов достоверность экстрасенсов-->
            <tr class="table-secondary">
                <th>Достоверность</th>
                <?php echo $trust_psychic_in_HTML; ?>
                <td></td>
            </tr>

            <!--Блок шагов с результатами-->
            <?php echo $history_step_data_in_HTML; ?>

            </tbody>
        </table>

    </div>

</div>