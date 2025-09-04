    <nav id="sidebar" class="sidebar-material sidebar-collapsed">
      <div class="sidebar-header d-flex align-items-center justify-content-between">
        <span>Sinilam</span>
        <button id="closeSidebar" class="btn btn-sm btn-light d-lg-none"><i class="bi bi-x"></i></button>
      </div>
      <ul class="nav flex-column gap-1 px-2">
                <x-nav-item icon="grid" :active="request()->routeIs('dashboard')" :href="route('dashboard')">Jumlah Data</x-nav-item>
                <li class="nav-header text-muted">MENU</li>
                <x-nav-item icon="bug" :active="request()->routeIs('penyakit*')" :href="route('penyakit')">Hama & Penyakit</x-nav-item>
                <x-nav-item icon="exclamation-circle-fill" :active="request()->routeIs('gejala*')" :href="route('gejala')">Gejala</x-nav-item>
                <x-nav-item icon="book-half" :active="request()->routeIs('basis-pengetahuan')" :href="route('basis-pengetahuan')">Basis Pengetahuan</x-nav-item>
                <x-nav-item icon="clipboard2" :active="request()->routeIs('diagnosis*')" :href="route('diagnosis')">Diagnosis</x-nav-item>
                <li class="nav-header text-muted">PROFILE</li>
                    <x-nav-item icon="person-fill" :active="request()->routeIs('profile*')" :href="route('profile')" >Profile</x-nav-item>
                    <x-nav-item :href="route('logout')" icon="box-arrow-right">Logout</x-nav-item>
      </ul>
    </nav>
    <div id="sidebarOverlay" class="sidebar-overlay"></div>
