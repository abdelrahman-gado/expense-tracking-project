<?php
function styleBasedOnAmount(float $amount): string
{
    if (isNegative($amount)) {
        return "color: red;";
    } else {
        return "color: green";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th,
        table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th,
        tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check #</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td>
                        <?= formatDate($transaction["date"]) ?>
                    </td>
                    <td>
                        <?= $transaction["checkNumber"] ?>
                    </td>
                    <td>
                        <?= $transaction["description"] ?>
                    </td>
                    <td style="<?= styleBasedOnAmount($transaction["amount"]) ?>">
                        <?= formatDollarsAmount($transaction["amount"]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Income:</th>
                <td>
                    <?= formatDollarsAmount($totals["income"]) ?>
                </td>
            </tr>
            <tr>
                <th colspan="3">Total Expense:</th>
                <td>
                    <?= formatDollarsAmount($totals["expense"]) ?>
                </td>
            </tr>
            <tr>
                <th colspan="3">Net Total:</th>
                <td>
                    <?= formatDollarsAmount($totals["net"]) ?>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>