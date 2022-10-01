<?php 

function buatKode($nomer_terakhir, $kunci, $jumlah_karakter = 0)
{
	$nomer_baru = Intval(substr($nomer_terakhir, strlen($kunci))) + 1;
	$nomer_baru_plus_nol = str_pad($nomer_baru, $jumlah_karakter, "0", STR_PAD_LEFT);
	$kode = $kunci . $nomer_baru_plus_nol;
	return $kode;
}