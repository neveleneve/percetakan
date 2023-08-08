<div class="row justify-content-center">
    <div class="col-12 col-lg-10">
        <ul class="nav nav-tabs justify-content-center">
            <li class="nav-item">
                <a class="nav-link{{ Request::is('dashboard*') ? ' active fw-bold disabled' : ' text-dark' }}"
                    href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            @if (Auth::user()->role->name == 'Admin')
                <li class="nav-item">
                    <a class="nav-link{{ Request::is('user*') ? ' active fw-bold disabled' : ' text-dark' }}"
                        href="{{ route('user.index') }}">User</a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link{{ Request::is('gudang*') ? ' active fw-bold disabled' : ' text-dark' }}"
                    href="{{ route('gudang.index') }}">Gudang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Request::is('item*') ? ' active fw-bold disabled' : ' text-dark' }}"
                    href="{{ route('item.index') }}">Item</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Request::is('transaksi*') ? ' active fw-bold disabled' : ' text-dark' }}"
                    href="{{ route('transaksi.index') }}">Transaksi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Request::is('laporan*') ? ' active fw-bold disabled' : ' text-dark disabled' }}"
                    href="#">Laporan</a>
            </li>
        </ul>
    </div>
</div>
