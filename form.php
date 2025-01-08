<?php defined('BASEPATH') or die("You Don't Have Access"); ?>

<!-- Form -->
<div id="Login" class="absolute inset-0 flex justify-center items-center">
    <div class="w-3/4 sm:w-2/4 h-auto p-6 mx-auto border border-white/10 rounded-xl backdrop-blur-md bg-white/3 [box-shadow:0_0_4px_2px_#fff]">

        <!-- Logo Image -->
        <img fetchpriority="high" src="https://smkind-mm2100.sch.id/wp-content/uploads/2022/10/MM2100-LOGO-SMK-Mitra-Industri-MM2100-PNG.png" class="py-4 w-36 h-auto mx-auto" alt="">

        <!-- Container Form -->
        <div class="tracking-wider mx-auto w-full space-y-4">

            <!-- Title Form -->
            <h1 class="sm:text-xl text-md font-bold uppercase text-white text-center">Welcome To <span class="text-orange-300">KPRS</span> Site!</h1>
            <p class="text-white text-sm sm:text-md text-center">Login Terlebih Dahulu Ya!</p>

            <form action="" method="post" class="container w-full flex flex-col space-y-4" autocomplete="off">

                <!-- Use Fullname & Token -->
                <label for="fullname" class="text-white tracking-wide">Fullname</label>
                <input type="text" placeholder="Insert Your Fullname..." required="fullname" name="fullname" class="py-4 px-4 rounded-xl outline-none bg-white/10 border border-white/20 text-white focus:[box-shadow:0_0_4px_2px_#fff] duration-300" />

                <label for="fullname" class="text-white tracking-wide">Token</label>
                <input type="number" placeholder="Insert Your Token" required="NIS" name="nis" class="py-4 px-4 rounded-xl outline-none bg-white/10 border border-white/20 text-white focus:[box-shadow:0_0_4px_2px_#fff] duration-300" />

                <!-- Button Submit to Login -->
                <div id="btnLogin" class="flex flex-row w-full gap-3 text-center">
                    <button type="submit" name="submit" class="text-white w-full rounded-lg bg-white/5 border border-white/10 py-2 px-4 hover:[box-shadow:0_0_4px_2px_#fff] duration-300" value="login">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>