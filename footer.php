<footer class="w-full bg-gray-800 fixed bottom-0 flex flex-row items-center gap-1 sm:gap-2 z-50">
    <div id="titleSMK" class="bg-red-600 sm:w-52 w-38 font-bold uppercase italic tracking-wider px-2 py-1 text-white rounded-br-3xl">
        <p class="sm:text-sm text-[5px]">The Real</p>
        <p class="sm:text-sm text-[5px]">Vocational School</p>
    </div>
    <ul class="flex flex-row gap-2">
        <li class="flex flex-row items-center gap-0.5 sm:gap-2 text-white sm:text-xs text-[5px]">
            <img src="assets/img/yt_icon.png" class="w-4 sm:w-6">
            <a href="https://www.youtube.com/@SMKMitraIndustriMMOfficial" target="_blank">SMK Mitra Industri (Official)</a>
        </li>
        <li class="flex flex-row items-center gap-0.5 sm:gap-2 text-white sm:text-xs text-[5px]">
            <img src="assets/img/ig_icon.png" class="w-4 sm:w-6">
            <a href="https://www.instagram.com/mitra_industri/" target="_blank">Mitra Industri</a>
        </li>
        <li class="flex flex-row items-center gap-0.5 sm:gap-2 text-white sm:text-xs text-[5px]">
            <img src="assets/img/ig_icon.png" class="w-4 sm:w-6">
            <a href="https://www.instagram.com/osismitraindustri/">Osis Mitra Industri</a>
        </li>
        <li class="flex flex-row items-center gap-0.5 sm:gap-2 text-white sm:text-xs text-[5px]">
            <img src="assets/img/fb_icon.png" class="w-4 sm:w-6">
            <a href="https://www.facebook.com/SmkMitraIndustriMM2100/?locale=id_ID">SMK Mitra Industri</a>
        </li>
        <li class="flex flex-row items-center gap-0.5 sm:gap-2 text-white sm:text-xs text-[5px]">
            <img src="assets/img/web_icon.png" class="w-4 sm:w-6 bg-white rounded-full">
            <a href="https://smkind-mm2100.sch.id/" target="_blank">www.smkind-mm2100.sch.id</a>
        </li>
    </ul>
</footer>

<audio id="background-audio" loop>
    <source src="assets/bg_kicir_kicir.mp3" type="audio/mp3">
    Your browser does not support the audio element.
</audio>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function logoutBtn() {
        window.location.href = "logout.php";
    }

    function confirmVote(id, suara) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Sudah Yakin Dengan Pilihanmu?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, vote!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `./submit.php?id=${id}&s=${suara}`;
            }
        });
    }
</script>
<script>
    function playAudio() {
        var audio = document.getElementById('background-audio');
        audio.play();
        sessionStorage.setItem('audioPlayed', 'true');
    }

    window.onload = function() {
        if (sessionStorage.getItem('audioPlayed') === 'true') {
            playAudio();
        }
    };
</script>
</body>

</html>