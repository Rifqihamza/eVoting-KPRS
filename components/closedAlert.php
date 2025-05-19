<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alert!</title>
</head>

<body>
    <img id="imgLogo" src="assets/img/logo.png" alt="School Election Logo" class="mx-auto w-[10rem] mt-10">
    <?php include 'components/awan_element.php'; ?>

    <div id="boxForm" class="fixed bottom-0 inset-x-0 bg-white backdrop-blur-md w-[20rem] sm:w-2/4 sm:h-[34rem] h-[33rem] p-4 mx-auto rounded-t-2xl shadow-inner shadow-gray-300">
        <h1 class="bg-red-800 text-white px-6 py-4 rounded-xl text-center uppercase text-2xl font-bold">Komisi Pemilihan Raya Sekolah</h1>
        <div id="message" class="p-4 space-y-2">
            <p class="text-center text-xl font-semibold">Website Has Been Closed</p>
            <p class="text-center text-xl font-semibold">Mohon Maaf Website Pemilihan Telah Ditutup</p>
            <p class="text-center text-lg font-semibold">Pemilihan Paslon OSIS MM2100 dan Putra Dharma Telah Berakhir</p>
        </div>
        <div id="btn" class="text-center mt-2">
            <button onclick="okeBtn()" class="text-white bg-red-800 sm:w-1/2 w-64 px-4 py-2 rounded-lg uppercase text-xl tracking-wide font-semibold translate-y-[5px] active:translate-y-[10px] [box-shadow:0_10px_0_#c3ae95] active:[box-shadow:0_5px_0_#c3ae95]">Baiklah!</button>
        </div>
        <!-- Rotated Image -->
        <div class="fixed sm:-bottom-10 -bottom-6 sm:-left-28 -left-[4rem] rotate-6 -z-10">
            <img src="../assets/img/kotak_element.png" class="sm:w-1/2 w-[10rem]" alt="Rotated Vector">
        </div>
        <div class="absolute sm:left-[18em] left-28 sm:bottom-6 bottom-4 -z-10">
            <img src="../assets/img/golput.png" class="sm:w-1/3 w-[6rem]" alt="Image">
        </div>
        <div class="fixed sm:-bottom-10 -bottom-12 sm:-right-80 -right-[23rem] -rotate-12 -z-10">
            <img src="../assets/img/kertas_element.png" class="sm:w-2/3 w-1/2" alt="Image">
        </div>
    </div>

    <audio id="background-audio" loop>
        <source src="<?php echo BASEURL; ?>/assets/bg_kicir_kicir.mp3" type="audio/mp3">
        Your browser does not support the audio element.
    </audio>

    <?php include 'footer.php'; ?>
</body>

</html>
