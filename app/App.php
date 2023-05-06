<?php

declare(strict_types=1);

// Your Code
function getTransactionFiles(string $path): array
{

    $files = array_slice(scandir($path), 2);

    $transactionFiles = [];

    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === "csv") {
            $transactionFiles[] = $file;
        }
    }

    return $transactionFiles;
}

function getFileTransactions(string $filename): array
{

    $transactionsArray = [];
    $filePath = FILES_PATH . $filename;

    if (!file_exists($filePath)) {
        throw new \Exception("file does not exists");
    }

    $file = fopen($filePath, "r");

    if (!$file) {
        return [];
    }

    // ignore the header of the file
    fgetcsv($file);

    while ($transaction = fgetcsv($file)) {
        $transactionsArray[] = extractTransactionData($transaction);
    }


    fclose($file);

    return $transactionsArray;
}


function extractTransactionData(array $transaction): array {

    [$date, $checkNumber, $description, $amount] = $transaction;

    $amount = convertAmountToFloat($amount);

    return [
        "date" => $date,
        "checkNumber" => $checkNumber,
        "description" => $description,
        "amount" => $amount
    ];
}



function getCompleteTransactionsArray(array $transactionFiles): array
{

    $transactionsArray = [];
    foreach ($transactionFiles as $tranFile) {
        $fileTransactions = getFileTransactions($tranFile);
        $transactionsArray = array_merge($transactionsArray, $fileTransactions);
    }

    return $transactionsArray;
}




function calculateTotals(array $transactions): array {

    $totals = ["net" => 0, "income" => 0, "expense" => 0];

    foreach($transactions as $transaction) {
        $totals["net"] += $transaction["amount"];

        if ($transaction["amount"] > 0) {
            $totals["income"] += $transaction["amount"];
        } else {
            $totals["expense"] += $transaction["amount"];
        }
    }

    return $totals;
}