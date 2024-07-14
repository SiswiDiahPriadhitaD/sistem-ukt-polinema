<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="">UKT POLINEMA</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="">UKT</a>
    </div>
    <ul class="sidebar-menu">
        @role('wadir')
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-tag"></i>
                    <span>Naive Bayes</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('mahasiswa-perhitungan.index') }}">Perhitungan
                            Diverifikasi</a></li>
                </ul>
            </li>
        @endrole
        @role('super-admin')
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i>
                    <span>User Management</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('user.index') }}">Users List</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-tag"></i>
                    <span>Role and Permission</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('role.index') }}">Role</a></li>
                    <li><a class="nav-link " href="{{ route('assign.user.index') }}">User To Role</a></li>
                </ul>
            </li>
          
            {{-- <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-tag"></i>
                    <span>Master Table</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('pekerjaan-ayah.index') }}">Pekerjaan Ayah</a></li>
                    <li><a class="nav-link" href="{{ route('pekerjaan-ibu.index') }}">Pekerjaan Ibu</a></li>
                    <li><a class="nav-link" href="{{ route('penghasilan-ayah.index') }}">Penghasilan Ayah</a></li>
                    <li><a class="nav-link" href="{{ route('penghasilan-ibu.index') }}">Penghasilan Ibu</a></li>
                    <li><a class="nav-link" href="{{ route('jumlah-pendapatan-orang-tua.index') }}">Pendapatan Orang
                            Tua</a></li>
                    <li><a class="nav-link" href="{{ route('jumlah-tanggungan.index') }}">Jumlah Tanggungan</a></li>
                    <li><a class="nav-link" href="{{ route('status-orang-tua.index') }}">Status Orang Tua</a></li>
                    <li><a class="nav-link" href="{{ route('jumlah-anak.index') }}">Jumlah Anak</a></li>
                    <li><a class="nav-link" href="{{ route('jumlah-orang-tinggal.index') }}">Jumlah Orang Tinggal</a></li>
                    <li><a class="nav-link" href="{{ route('status-kepemilikan-rumah.index') }}">Status
                            Rumah</a></li>
                    <li><a class="nav-link" href="{{ route('besaran-pln.index') }}">Besaran PLN</a></li>
                    <li><a class="nav-link" href="{{ route('besaran-pdam.index') }}">Besaran PDAM</a></li>
                    <li><a class="nav-link" href="{{ route('besaran-pajak-kendaraan-mobil.index') }}">Pajak
                            Mobil</a></li>
                    <li><a class="nav-link" href="{{ route('besaran-pajak-kendaraan-motor.index') }}">Pajak
                            Motor</a></li>
                </ul>
            </li> --}}
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-tag"></i>
                    <span>Kesekretariatan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('periode.index') }}">Periode</a></li>
                    <li><a class="nav-link " href="{{ route('jurusan.index') }}">Jurusan</a></li>
                    <li><a class="nav-link " href="{{ route('program-studi.index') }}">Program Studi</a></li>
                    <li><a class="nav-link " href="{{ route('kelompok-ukt.index') }}">Kelompok UKT</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-tag"></i>
                    <span>Kemahasiswaan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('mahasiswa.index') }}">Mahasiswa</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('mahasiswa-ditolak.index') }}">Mahasiswa Ditolak</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('mahasiswa-diverifikasi.index') }}">Mahasiswa
                            Diverifikasi</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-tag"></i>
                    <span>Naive Bayes</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link " href="{{ route('mahasiswa-perhitungan.index') }}">Perhitungan
                            Diverifikasi</a></li>
                </ul>
            </li>
        @endrole
    </ul>
</aside>