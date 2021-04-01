<div class="album py-5 bg-light">
    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr class="table-primary">
                <th scope="col"></th>
                <th scope="col">Экстрасенс 1</th>
                <th scope="col">Экстрасенс 2</th>
                <th scope="col">Экстрасенс 3</th>
                <th scope="col">Пользователь</th>
            </tr>
            </thead>
            <tbody>


            <tr class="table-active">
                <th scope="row">Достоверность</th>

                <td>
                    <?php echo
                    (isset($_SESSION['history'][$step_d]['psychic_1'])) ?  $_SESSION['history'][$step_d]['psychic_1'] : '-';
                    ?>
                </td>
                <td>
                    <?php echo
                    (isset($_SESSION['history'][$step_d]['psychic_1'])) ?  $_SESSION['history'][$step_d]['psychic_2'] : '-';
                    ?>
                </td>
                <td>
                    <?php echo
                    (isset($_SESSION['history'][$step_d]['psychic_1'])) ?  $_SESSION['history'][$step_d]['psychic_3'] : '-';
                    ?>
                </td>

                <td></td>
            </tr>



            <?php foreach ($_SESSION['history'] as $step): ?>

            <tr>
                <th scope="row" class="table-primary">Шаг <?php echo $step['step']; ?></th>
                <td><?php echo $step['psychic_1_result']; ?></td>
                <td><?php echo $step['psychic_2_result']; ?></td>
                <td><?php echo $step['psychic_3_result']; ?></td>

                <?php if (isset($step['user_number_result'])): ?>
                    <td><?php echo $step['user_number_result']; ?></td>
                <?php else: ?>
                    <td><?php echo "-"; ?></td>
                <?php endif; ?>
            </tr>

            <?php endforeach; ?>



            </tbody>
        </table>
    </div>
</div>
