<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <a class="navbar-brand" href="{{ route('home') }}" style="margin-left: 20px; margin-right: 20px;">
    {{ config('app.name') }}
  </a>
  <button
    class="navbar-toggler"
    type="button"
    data-bs-toggle="collapse"
    data-bs-target="#navbarNav"
    aria-controls="navbarNav"
    aria-expanded="false"
    aria-label="Toggle navigation"
  >
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
      @auth
        <li class="nav-item d-flex align-items-center" style="margin-left: 15px; margin-right: 15px;">
          <a class="nav-link d-flex align-items-center" href="{{ route('profile.show') }}">
            <img src="{{ Storage::url(auth()->user()->profile_pic) }}" alt="Profile Picture" class="rounded-circle" style="width: 35px; height: 35px;">
            <span class="ms-2 d-none d-md-inline">{{ '@'.auth()->user()->name }}</span>
          </a>

          <!-- Notification Icon -->
          <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="notificationModalLabel">Your Notifications</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  @foreach ($notifications as $notification)
                      <div class="alert alert-info">
                          <strong>{{ $notification->data['title'] }}</strong>
                          <p>{{ $notification->data['message'] }}</p>
                          <small>{{ $notification->created_at->diffForHumans() }}</small>
                      </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <a class="nav-link d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#notificationModal">
            <i class="fa fa-bell" style="font-size: 20px;"></i>
              <span class="badge bg-danger">{{ $unreadNotificationsCount }}</span>
          </a>

          <a class="nav-link d-flex align-items-center" href="{{ route('logout') }}" style="margin-left: 15px;">
            <i class="fa fa-sign-out" style="font-size: 20px;"></i>
            <span class="ms-2 d-none d-md-inline">Logout</span>
          </a>
        </li>
      @else
        <!-- Guest menu -->
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('home') }}" style="margin-left: 15px; margin-right: 15px;">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}" style="margin-left: 15px; margin-right: 15px;">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}" style="margin-left: 15px; margin-right: 15px;">Register</a>
        </li>
      @endauth
    </ul>
  </div>
</nav>
