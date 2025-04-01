<?php 
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;  // Prevent further execution of the script
}
include '../connection.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
        .MathJax {
            color: #000;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- TinyMCE Script -->
  <script src="https://cdn.tiny.cloud/1/d71kkfjpozt900p9rl68i8w0msava9nmr2kaj48rmxr10ga3/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
  <!-- mathjs -->
 


 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/v5-font-face.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
</head>
<body class="bg-gray-100 flex"></body>
<div class="flex-1">
        