<!DOCTYPE html>
<html lang="zxx">
<base href="<?=base_url();?>">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="back_assets/img/basic/favicon.ico" type="image/x-icon">
    <title>Hospital ERP</title>
    <!-- CSS -->
    <link rel="stylesheet" href="back_assets/css/app.css">
    <link rel="stylesheet" href="back_assets/css/alertify.min.css">
    <link rel="stylesheet" href="back_assets/css/font-awesome.css">
    <link rel="stylesheet" href="back_assets/css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="back_assets/js/summernote.css">
    <link rel="stylesheet" href="back_assets/css/jasny-bootstrap.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> 
    <script src="back_assets/js/ckeditor.js"></script>
    <link rel="stylesheet" href="back_assets/css/alertify.min.css">




    <!-- Include Editor style. -->
    <style>
        body
        {
           color: black !important;
       }

       .modal-title
       {
        color:black !important;
    }


    .badge {
        font-size: 1.0em;
    }



    .loader {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: #F5F8FA;
        z-index: 9998;
        text-align: center;
    }

    .plane-container {
        position: absolute;
        top: 50%;
        left: 50%;
    }
    .display_block
    {
        display: block !important;
    }
    .display_none
    {
        display: none !important;
    }
    .select2-container--default .select2-selection--single{
        background: white !important;
    }
    .design_form
    {
        border: 2px solid blue;

    }
    .table td
    {
        padding: 4px;
        color: black !important;
    }
    .table th
    {
        padding: 4px;
        text-align: center;
        font-weight: bold !important;
    }

    select[readonly].select2 + .select2-container {
        pointer-events: none;
        touch-action: none;

        .select2-selection {
            background: #eee;
            box-shadow: none;
        }

        .select2-selection__arrow,
        .select2-selection__clear {
            display: none;
        }
    }

</style>

<style type="text/css">
    @media print { body { -webkit-print-color-adjust: exact; } }
</style>

</head>