 <ul class="nav nav-pills mb-3 justify-content-center">
     <li class="nav-item">
         <a class="nav-link{{ Request::is('transaksi') ? ' active fw-bold text-light bg-success' : ' text-success' }}"
             href="{{ route('transaksi.index') }}">Semua</a>
     </li>
     <li class="nav-item">
         <a class="nav-link{{ Request::is('transaksi/masuk') ? ' active fw-bold text-light bg-success' : ' text-success' }}"
             href="{{ route('masuk.index') }}">Transaksi Masuk</a>
     </li>
     <li class="nav-item">
         <a class="nav-link{{ Request::is('transaksi/keluar') ? ' active fw-bold text-light bg-success' : ' text-success' }}"
             href="{{ route('keluar.index') }}">Transaksi Keluar</a>
     </li>
 </ul>
