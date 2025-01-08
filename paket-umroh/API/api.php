<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');

// Contoh data yang akan dikembalikan oleh API
$data = [
    [
        "title" => "Alfalah Reguler",
        "price" => "Rp. 25.000.000 / person",
        "badge" => "Best Seller",
        "image" => "https://via.placeholder.com/300x200"
    ],
    [
        "title" => "Alfalah Ramadhan",
        "price" => "Rp. 20.000.000 / person",
        "badge" => "Special Seller",
        "image" => "https://via.placeholder.com/300x200"
    ],
    [
        "title" => "Alfalah Gold",
        "price" => "Rp. 35.000.000 / person",
        "badge" => "Long Trip",
        "image" => "https://via.placeholder.com/300x200"
    ],
    [
        "title" => "Alfalah Private",
        "price" => "Rp. 30.000.000 / person",
        "badge" => "Best Seller",
        "image" => "https://via.placeholder.com/300x200"
    ],
    [
        "title" => "Alfalah Tour Plus",
        "price" => "Rp. 40.000.000 / person",
        "badge" => "Special Offering",
        "image" => "https://via.placeholder.com/300x200"
    ]
];

// Mengembalikan data dalam format JSON
echo json_encode($data);
