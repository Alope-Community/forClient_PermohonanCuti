<div class="wrapper">
    <aside id="sidebar" class="expand">
        <div class="d-flex" style="padding-top: 20px;">
            <button class="toggle-btn" type="button">
                <i class="lni lni-grid-alt"></i>
            </button>
            <div class="sidebar-logo">
                <h1 class="text-white">SiCuti</h1>
            </div>
        </div>
        <hr class="text-white">
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="{{ route('dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="lni lni-grid-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->role == 'super_admin' || auth()->user()->role == 'manajer_sdm')
                <li class="sidebar-item">
                    <a href="{{ route('pengguna.index') }}"
                        class="sidebar-link {{ request()->routeIs('pengguna.index') ? 'active' : '' }}">
                        <i class="lni lni-users"></i>
                        @if (auth()->user()->role == 'manajer_sdm' || auth()->user()->role == 'direktur_operational')
                            <span>Karyawan</span>
                        @else
                            <span>Pengguna</span>
                        @endif
                    </a>
                </li>
            @endif
            @if (auth()->user()->role == 'karyawan')
                <li class="sidebar-item">
                    <a href="{{ route('pengajuan.cuti') }}"
                        class="sidebar-link {{ request()->routeIs('pengajuan.cuti') ? 'active' : '' }}">
                        <i class="lni lni-envelope"></i>
                        <span>Pengajuan Cuti</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('pengajuan.riwayat') }}"
                        class="sidebar-link {{ request()->routeIs('pengajuan.riwayat') ? 'active' : '' }}">
                        <i class="lni lni-timer"></i>
                        <span>Riawayat Pengajuan Cuti</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->role == 'manajer_sdm' || auth()->user()->role == 'super_admin')
                <li class="sidebar-item">
                    <a href="{{ route('jatah-cuti') }}"
                        class="sidebar-link {{ request()->routeIs('jatah-cuti') ? 'active' : '' }}">
                        <i class="lni lni-timer"></i>
                        <span>Jatah Cuti</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->role != 'karyawan')
                <li class="sidebar-item">
                    <a href="{{ route('cuti.verifikasi') }}"
                        class="sidebar-link {{ request()->routeIs('cuti.verifikasi') ? 'active' : '' }}">
                        <i class="lni lni-checkmark-circle"></i>
                        <span>Verifikasi Cuti</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->role == 'manajer_sdm')
                <li class="sidebar-item">
                    <a href="{{ route('penerbitan.index') }}"
                        class="sidebar-link {{ request()->routeIs('penerbitan.index') ? 'active' : '' }}">
                        <i> <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" transform="rotate(0 0 0)">
                                <path
                                    d="M4.75 3.75C3.50736 3.75 2.5 4.75736 2.5 6V21.7182C2.5 22.0141 2.67391 22.2823 2.94401 22.403C3.21411 22.5237 3.52993 22.4743 3.75032 22.277L7.635 18.7984H19.25C20.4926 18.7984 21.5 17.791 21.5 16.5484V6C21.5 4.75736 20.4926 3.75 19.25 3.75H4.75Z"
                                    fill="#ffffff" />
                            </svg></i>


                        <span class="ml-2">Penerbitan Surat</span>
                    </a>
                </li>
            @endif
            <li class="sidebar-item">
                <hr class="text-white">
            </li>
            <li class="sidebar-item">
                <a href="{{ route('user.profile') }}"
                    class="sidebar-link {{ request()->routeIs('user.profile') ? 'active' : '' }}">
                    <i class="lni lni-users"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('logout') }}" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </aside>

    <script>
        const hamBurger = document.querySelector(" .toggle-btn");
        hamBurger.addEventListener("click", function() {
            document.querySelector("#sidebar").classList.toggle("expand");
        });
    </script>
