<?php defined('BASEPATH') or die("You Don't Have Access"); ?>

<!-- Container -->
<div id="loginPage" class="container relative">
    <!-- Box Container -->
    <div id="boxForm" class="fixed bottom-0 inset-x-0 bg-white backdrop-blur-md w-[20rem] sm:w-2/4 sm:h-[34rem] h-[33rem] p-4 mx-auto rounded-t-2xl shadow-inner shadow-gray-300">
        <img src="assets/img/batik_element.png" class="absolute left-0 top-0 opacity-50 w-full h-screen -z-50" alt="">
        <!-- Title -->
        <div id="titleForm" class="text-center uppercase tracking-wide space-y-2 z-10">
            <h1 class="text-2xl font-extrabold text-white bg-red-800 px-2 py-3 rounded-xl">Komisi Pemilihan Raya Sekolah</h1>
            <p class="text-lg font-semibold">Login Terlebih Dahulu Ya!</p>
        </div>
        <form action="" method="post" class="flex flex-col gap-2 z-20" autocomplete="off">
            <label for="fullname" class="">Fullname</label>
            <input type="text" placeholder="Insert Your Fullname..." required name="fullname" class="px-4 py-4 rounded-xl outline-none bg-[#e6d9c1] placeholder:text-gray-800 focus:[box-shadow:0_0_4px_1px_#777777] duration-300" />

            <label for="token" class="">Token</label>
            <input type="text" placeholder="Insert Your Token" required name="nis" class="px-4 py-4 rounded-xl outline-none bg-[#e6d9c1] placeholder:text-gray-800 focus:[box-shadow:0_0_4px_1px_#777777] duration-300" />
            <div class="py-6">
                <button onclick="playAudio()" type="submit" name="submit" class="loginBtn mt-6 text-center font-bold uppercase tracking-xl w-full px-3 py-2 text-white bg-red-800 rounded-xl -translate-y-[10px] [box-shadow:0_10px_0_#c3ae95] active:[box-shadow:0_5px_0_#c3ae95] active:-translate-y-[5px] relative z-10" value="login">Login</button>
            </div>
        </form>
        <!-- Rotated Image -->
        <div class="fixed sm:-bottom-10 -bottom-6 sm:-left-28 -left-[4rem] rotate-6 -z-10">
            <img src="assets/img/kotak_element.png" class="sm:w-1/2 w-[10rem]" alt="Rotated Vector">
        </div>
        <div class="absolute sm:left-[18em] left-28 sm:bottom-6 bottom-4  -z-10">
            <img src="assets/img/golput.png" class="sm:w-1/3 w-[6rem]" alt="">
        </div>
        <div class="fixed sm:-bottom-10 -bottom-12 sm:-right-80 -right-[23rem] -rotate-12 -z-10">
            <img src="assets/img/kertas_element.png" class="sm:w-2/3 w-1/2" alt="">
        </div>
    </div>
</div>