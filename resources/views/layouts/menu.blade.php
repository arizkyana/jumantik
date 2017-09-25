<ul class="sidebar-nav">

    <li class="sidebar-brand">
        {{--<a href="#">--}}
            {{--Start Bootstrap--}}
            {{--</a>--}}
    </li>
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li data-toggle="collapse" data-target="#siswa" aria-expanded="false" aria-controls="siswa">
        <a href="#">Siswa</a>
        <ul id="siswa" class="sidebar-nav-sub collapse">
            <li>
                <a href={{ route('siswa/add') }}>Tambah Siswa</a>
            </li>
            <li>
                <a href={{ route('siswa/list') }}>List Siswa</a>
            </li>
        </ul>
    </li>
    <li data-toggle="collapse" data-target="#sekolah" aria-expanded="false" aria-controls="siswa">
        <a href="#">Sekolah</a>
        <ul id="sekolah" class="sidebar-nav-sub collapse">
            <li>
                <a href={{ route('sekolah/add') }}>Tambah Sekolah</a>
            </li>

        </ul>
    </li>
    <li data-toggle="collapse" data-target="#perpustakaan" aria-expanded="false"
        aria-controls="perpustakaan">
        <a href="#">Perpustakaan</a>
        <ul id="perpustakaan" class="sidebar-nav-sub collapse">
            <li>
                <a href={{ route('peminjaman') }}>Peminjaman</a>
            </li>
            {{--<li>--}}
                {{--<a href={{ route('perpustakaan/pengembalian') }}>Pengembalian</a>--}}
                {{--</li>--}}
            {{--<li>--}}
                {{--<a href={{ route('perpustakaan/buku') }}>Master Buku</a>--}}
                {{--</li>--}}
            {{--<li>--}}
                {{--<a href={{ route('perpustakaan/denda') }}>Denda</a>--}}
                {{--</li>--}}
            {{--<li>--}}
                {{--<a href={{ route('perpustakaan/anggota') }}>Anggota</a>--}}
                {{--</li>--}}

        </ul>
    </li>
    <li>
        <a href={{ route('jadwal') }}>Jadwal</a>
    </li>
    <li>
        <a href={{ route('perwalian') }}>Perwalian</a>
    </li>
    <li data-toggle="collapse" data-target="#menu" aria-expanded="false" aria-controls="menu">
        <a href="#">Menu</a>
        <ul id="menu" class="sidebar-nav-sub collapse">
            <li>
                <a href={{ route('menu') }}>Daftar Menu</a>
            </li>
            <li>
                <a href={{ route('menu/create') }}>Tambah Menu</a>
            </li>

        </ul>
    </li>
    <li data-toggle="collapse" data-target="#role" aria-expanded="false" aria-controls="role">
        <a href="#">Role</a>
        <ul id="role" class="sidebar-nav-sub collapse">
            <li>
                <a href={{ route('role') }}>Daftar Role</a>
            </li>
            <li>
                <a href={{ route('role/create') }}>Tambah Role</a>
            </li>

        </ul>
    </li>
    <li>
        <a href="#">About</a>
    </li>
    <li>
        <a href="#">Services</a>
    </li>
    <li>
        <a href="#">Contact</a>
    </li>
</ul>