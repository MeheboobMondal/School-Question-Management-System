<?php 
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;  // Prevent further execution of the script
}
include '../connection.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/v5-font-face.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
    
     <!-- TinyMCE Script -->
  <script src="https://cdn.tiny.cloud/1/d71kkfjpozt900p9rl68i8w0msava9nmr2kaj48rmxr10ga3/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
  <style>
        .MathJax {
            color: #000;
        }
        .math-equation {
            display: inline-block;
            margin: 0;
            padding: 0;
            line-height: normal;
        }
    </style>
    <!-- <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script> -->
     <!-- html2pdf.js
 <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script> -->
 <!-- Include KaTeX
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
<script src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script> -->
<!-- MathJax -->
<!-- <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

html2canvas
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script> -->

<!-- jsPDF  -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> --> 
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script> -->
</head>
<body class="bg-gray-100 flex"></body>
<div class="flex-1">
        