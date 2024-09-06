<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('format_indo')) {
    function format_indo($date)
    {
        date_default_timezone_set('Asia/Jakarta');
        // array hari dan bulan
        $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
        $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $waktu = substr($date, 11, 5);
        $hari = date("w", strtotime($date));
        $result = $Hari[$hari] . ", " . $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun . " " . $waktu;

        return $result;
    }
}

if (!function_exists('format_indo2')) {
    function format_indo2($date)
    {
        date_default_timezone_set('Asia/Jakarta');
        // array hari dan bulan
        $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
        $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $waktu = substr($date, 11, 5);
        $hari = date("w", strtotime($date));
        $result = $Bulan[(int)$bulan - 1] . " " . $tahun;

        return $result;
    }
}

if (!function_exists('format_indo3')) {
    function format_indo3($date)
    {
        date_default_timezone_set('Asia/Jakarta');
        // array hari dan bulan
        $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
        $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $waktu = substr($date, 11, 5);
        $hari = date("w", strtotime($date));
        $result =  $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun . " " . $waktu;

        return $result;
    }
}

if (!function_exists('format_bulan')) {
    function format_bulan($date)
    {
        date_default_timezone_set('Asia/Jakarta');
        // array hari dan bulan
        $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
        $Bulan = array("JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AGU", "SEP", "OKT", "NOV", "DES");

        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $waktu = substr($date, 11, 5);
        $hari = date("w", strtotime($date));
        $result = $Bulan[(int)$bulan - 1];

        return $result;
    }
}

if (!function_exists('format_array')) {
    function format_array($bln, $data1, $data2)
    {
        $i = 0;
        $data = array();
        while ($i <=  $bln) {
            $data[] =  (empty($data1[$i]) ? '0' : $data1[$i]) - (empty($data2[$i]) ? '0' : $data2[$i]);
            $i++;
        }
        return $data;
    }
}

if (!function_exists('dateAgo')) {
    function dateAgo($date)
    {
        $ts = strtotime($date);
        $tsYmdDate = strtotime(date('Y-m-d 00:00:00', $ts));

        $tsNow = time();
        // $dateNow = date('Y-m-d H:i:s', $tsNow);
        $tsYmdNow = strtotime(date('Y-m-d 00:00:00', $tsNow));

        $diff = ($tsYmdNow - $tsYmdDate) / (60 * 60 * 24);

        if ($diff == '1') {

            return "Kemarin jam " . date('g:i A', $ts);
        } else {

            $diff = abs($tsNow - $ts);

            $seconds  = $diff;
            $minutes  = floor($diff / 60);
            $hours    = floor($minutes / 60);
            $days     = floor($hours / 24);

            if ($seconds < 60) {
                return "$seconds detik yang lalu";
            } elseif ($minutes < 60) {
                return ($minutes == 1) ? "semenit yang lalu" : "$minutes menit yang lalu";
            } elseif ($hours < 24) {
                return ($hours == 1) ? "satu jam yang lalu" : "$hours jam yang lalu";
            } else {
                return format_indo3($date);
            }
        }
    }
}
