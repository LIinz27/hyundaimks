<?php

// Central place for site contact details.
//
// TODO: isi nilai kontak resmi di file .env (atau langsung di sini) sebelum go-live.
// Nilai kosong akan dirender sebagai placeholder "Belum tersedia" di footer,
// jadi tidak ada nomor/email palsu yang tampil ke pengunjung.

return [
    'contact_whatsapp' => env('SITE_CONTACT_WHATSAPP', ''),
    'contact_phone'    => env('SITE_CONTACT_PHONE', ''),
    'contact_email'    => env('SITE_CONTACT_EMAIL', ''),
];
