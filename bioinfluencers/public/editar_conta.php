<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>

    <title>Editar perfil</title>

    <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>

    <!-- Custom styles for this template-->
    <link href="css/croppie.css" rel="stylesheet">
    <?php include "helpers/css.php"; ?>

</head>


<body>
<header class="sticky-top">

    <?php include "componentes/navbar.php"; ?>

</header>

<main class="container mb-5 p-0">

    <?php include "componentes/editar_conta.php"; ?>

</main>


<!-- JavaScript-->

<?php include "helpers/js.php"; ?>
<script src="javascript/croppie.js"></script>
<script>
    $(document).ready(function(){

        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width:200,
                height:200,
                type:'circle' //circle
            },
            boundary:{
                width:300,
                height:300
            }
        });

        $('#fileToUpload').on('change', function(){
            var reader = new FileReader();
            reader.onload = function (event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            };
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });

        $('.crop_image').click(function(event){
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(response){
                $.ajax({
                    url:"upload.php",
                    type: "POST",
                    data:{"image": response},
                    success:function(data)
                    {
                        $('#uploadimageModal').modal('hide');
                        $('#img_perf').html(data);
                    }
                });
            })
        });

    });
</script>

</body>

</html>


