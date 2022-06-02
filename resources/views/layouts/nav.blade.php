<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item menu-open">
        <a href="{{route('home')}}" class="nav-link active">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Admin Master
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('users.index')}}" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              <p>User</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('kota.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Kota Kategori</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('fasilitas.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Fasilitas Kategori</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('mitra.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Client Mitra</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('product.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Product Kos</p>
            </a>
          </li>


          <li class="nav-item">
              <form action="{{route('logout')}}" method="POST" id="logout">
                @csrf
                <a class="nav-link" href="#" onclick="document.getElementById('logout').submit()">
                <i class="nav-icon fas fa-sign-out-alt">Logout</i>
                </a>
            </form>
          </li>

        </ul>
      </li>

    </ul>
  </nav>
