<?php

$hash_database = '$2y$12$p5dOx3zAQ4P5gQWH.gx02.mmnSKp.IGLMHNAXmkqtshukMYqzcUnG';

// 1. Contoh jika kita menebak password-nya adalah 'kuyy'
$tebakan_1 = 'kuyy';

if (password_verify($tebakan_1, $hash_database)) {
    echo "Tebakan 1 BENAR! Password aslinya adalah: " . $tebakan_1 . "\n";
} else {
    echo "Tebakan 1 SALAH!\n";
}

echo "---------------------------------\n";

// 2. Contoh jika kita menebak password-nya adalah 'password'
$tebakan_2 = 'password';

if (password_verify($tebakan_2, $hash_database)) {
    echo "Tebakan 2 BENAR! Password aslinya adalah: " . $tebakan_2 . "\n";
} else {
    echo "Tebakan 2 SALAH!\n";
}