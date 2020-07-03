<div id="sidebar-nav" class="sidebar">
  <div class="sidebar-scroll">
    <nav>
      <ul class="nav">
        @if(Auth::check() && Auth::user()->role == "admin")
        <li><a href="{{ url('/dashboard') }}" class="{{ Request::is('dashboard')?'active':'' }}"><i
              class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
        <li><a href="{{ url('/siswa') }}" class="{{ Request::is('siswa','siswa/*')?'active':'' }}"><i
              class="lnr lnr-user"></i> <span>Siswa</span></a></li>
        @elseif (Auth::check())
        <li><a href="{{ url('/dashboard') }}" class="{{ Request::is('dashboard')?'active':'' }}"><i
              class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
        @endif
      </ul>
    </nav>
  </div>
</div>