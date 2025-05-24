<div class="wrapper">
    <aside id="sidebar" class="expand">
        <div class="d-flex" style="padding-top: 20px;">
            <button class="toggle-btn" type="button">
                <i class="lni lni-grid-alt"></i>
            </button>
            <div class="sidebar-logo">
                <h1 class="text-white">Brand Name</h1>
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
            @if (auth()->user()->role == 'super_admin')
                <li class="sidebar-item">
                    <a href="{{ route('pengguna.index') }}"
                        class="sidebar-link {{ request()->routeIs('pengguna.index') ? 'active' : '' }}">
                        <i class="lni lni-users"></i>
                        <span>Pengguna</span>
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
            @endif
            <li class="sidebar-item">
                <a href="{{ route('pengajuan.riwayat') }}"
                    class="sidebar-link {{ request()->routeIs('pengajuan.riwayat') ? 'active' : '' }}">
                    <i class="lni lni-timer"></i>
                    <span>Riawayat Pengajuan Cuti</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('user.surat') }}"
                    class="sidebar-link {{ request()->routeIs('user.surat') ? 'active' : '' }}">
                    <i class="lni lni-comments"></i>
                    <span>Surat Balasan</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('cuti.verifikasi') }}"
                    class="sidebar-link {{ request()->routeIs('cuti.verifikasi') ? 'active' : '' }}">
                    <i class="lni lni-checkmark-circle"></i>
                    <span>Verifikasi Cuti</span>
                </a>
            </li>
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
