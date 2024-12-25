@php
$user = Auth::user();
$idlogin = $user->id;
$join =DB::table('masyarakat')
        ->join('users', 'users.id', '=', 'masyarakat.user_id')
        ->select('users.nama as nama_masyarakat','masyarakat.*')
        ->where('users.id', $idlogin)
        ->first();
// var_dump($join);
// die;
@endphp
<!--start header -->
<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="top-menu ms-auto">
            </div>
            <a href="{{ url('/profile_masyarakat') }}" style="text-decoration: none">
            <div class="user-box dropdown">
                    @if($join->foto == null)
                    <img src="{{ asset('assets/img/profile/profile.jpg') }}" class="user-img" alt="user avatar">
                    @endif
                    @if($join->foto != null)
                    <img src="{{ asset('assets/img/profile/' . $join->foto) }}" class="user-img" alt="user avatar">
                    @endif
                  
                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ $join->nama_masyarakat }}</p>
                        <p class="designattion mb-0">Masyarakat</p>
                    </div>
                </div>
            </a>
        </nav>
    </div>
</header>
<!--end header -->