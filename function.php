<?php

function tambah($a, $b) {
    return $a + $b;
}

function kurang($a, $b) {
    return $a - $b;
}

function hitungDiskon($harga, $diskon) {
    $potongan = $harga * ($diskon / 100);
    return $harga - $potongan;
}

function formatRupiah($value) {
    return 'Rp ' . number_format($value, 0, ',', '.');
}

function buildHasil($penjumlahan, $pengurangan, $hargaDiskon) {
    return "Penjumlahan: <span class='highlight'>" . $penjumlahan . "</span><br>"
        . "Pengurangan: <span class='highlight'>" . $pengurangan . "</span><br>"
        . "Harga setelah diskon: <span class='highlight'>" . formatRupiah($hargaDiskon) . "</span>";
}
?>