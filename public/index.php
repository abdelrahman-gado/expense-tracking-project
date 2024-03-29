<?php

declare(strict_types=1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

/* YOUR CODE (Instructions in README.md) */

require_once APP_PATH . "helper.php";
require_once APP_PATH . "App.php";

$transactionFiles = getTransactionFiles(FILES_PATH);
$transactions = getCompleteTransactionsArray($transactionFiles);

$totals = calculateTotals($transactions);

require_once VIEWS_PATH . "transactions.php";