 <!-- Sidebar -->
 <div class="sidebar d-flex flex-column p-3 mt-3 pt-5">
     <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
     <a href="{{ route('admin.users') }}"><i class="fas fa-users"></i> Users</a>
     <a href="{{ route('admin.product') }}">
         <i class="fas fa-box"></i> Products
     </a>
     <a href="{{ route('admin.orderdetails') }}"><i class="fas fa-cogs"></i> Order Details</a>
     <a href="#reports"><i class="fas fa-chart-line"></i> Reports</a>
     <form id="logout-form" action="{{ route('custom.logout') }}" method="POST" style="display: none;">
         @csrf
     </form>
     <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
         <i class="fas fa-sign-out-alt"></i> Logout
     </a>

 </div>
