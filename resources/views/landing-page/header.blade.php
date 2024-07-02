<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/assets/css/landing-page.css">
</head>

<body>
    <div class="header col-md-12 d-flex justify-content-around align-items-end">
        <div class="col-md-8">
            <div class="d-flex justify-content-start">
                <img class="img-fluid img-h my-2 mr-3" src="{{ asset('assets/img/logo.png') }}">
                <div class="t-header">
                    <span class="s-b">UKT </span><span class="s-p">POLINEMA</span>
                    <p class="p-header">Pengajuan Keringanan UKT Politeknik Negeri Malang
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <p id="realtime-clock" class="p-header p-time text-right"></p>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary-nav sticky-top p-2">
        <button id="navbar-toggle" class="navbar-toggler" type="button">
            <i class="fas fa-bars n-icon"></i>
        </button>
        <div class="navbar-collapse" id="navbar">
            <ul class="navbar-nav ml-5 py-1">
                <li class="nav-item nav-main">
                    <p class="text-white m-0 p-0">MENU</p>
                </li>
                <li class="nav-item mr-5">
                    <a href="{{ url('/') }}"><i class="fas fa-home a-nav"></i></a>
                </li>
                @if (!auth()->user())
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="a-nav">LOGIN</a>
                    </li>
                @else
                    @role('mahasiswa')
                        <li class="nav-item mr-5">
                            <a href="{{ route('front-end.biodata') }}" class="a-nav">BIODATA Pendaftar</a>
                        </li>
                        <li class="nav-item mr-5">
                            <a href="{{ route('front-end.pengumuman') }}" class="a-nav">PENGUMUMAN</a>
                        </li>
                    @endrole
                    <li class="nav-item">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="a-nav text-danger">LOGOUT
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </nav>

    <script>
        function updateRealTimeClock() {
            var now = new Date();
            var dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
            var day = now.getDay();
            var date = now.getDate();
            var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
                "Oktober", "November", "Desember"
            ];
            var month = now.getMonth();
            var year = now.getFullYear();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();

            var formattedTime = dayNames[day] + ', ' + date + ' ' + monthNames[month] + ' ' + year + ' ~ ' + hours + ':' + (
                minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;

            document.getElementById("realtime-clock").textContent = formattedTime;
        }

        updateRealTimeClock();

        setInterval(updateRealTimeClock, 1000);
    </script>

    <script>
        document.getElementById('navbar-toggle').addEventListener('click', function() {
            document.getElementById('navbar').classList.toggle('open');
        });

        document.addEventListener('click', function(event) {
            if (!event.target.closest('#navbar') && !event.target.closest('#navbar-toggle')) {
                document.getElementById('navbar').classList.remove('open');
            }
        });
    </script>
</body>

</html>
