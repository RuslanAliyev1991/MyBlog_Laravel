 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-laugh-wink"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Admin Panel</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item @if(Request::segment(2)=='dashboard')
         active
     @endif">
         <a class="nav-link" href="{{ route('admin.dashboard') }}">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span>
         </a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Interface
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link @if(Request::segment(2)=='news') in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">

             <i class="fas fa-fw fa-align-justify"></i>
             <span>News</span>
         </a>
         <div id="collapseTwo" class="collapse @if(Request::segment(2)=='news') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Look news:</h6>
                 <a class="collapse-item @if(Request::segment(2)=='news' and !Request::segment(3)) active @endif" href="{{ route('admin.news.index') }}">News content</a>
                 <a class="collapse-item @if(Request::segment(2)=='news' and Request::segment(3)=='create') active @endif" href="{{ route('admin.news.create') }}">Create news</a>
             </div>
         </div>
     </li>

     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="nav-item @if(Request::segment(2)=='categories')
         active
     @endif">
         <a class="nav-link" href="{{ route('admin.category.index') }}">
             <i style="font-size: 18px;" class="fab fa-fb fa-buffer"></i>
             <span>Categories</span>
         </a>
     </li>

     <li class="nav-item">
         <a class="nav-link @if(Request::segment(2)=='pages') in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapsePage" aria-expanded="true" aria-controls="collapsePage">

             <i class="fas fa-fw fa-folder"></i>
             <span>Pages</span>
         </a>
         <div id="collapsePage" class="collapse @if(Request::segment(2)=='pages') show @endif" aria-labelledby="headingPage" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Look pages:</h6>
                 <a class="collapse-item @if(Request::segment(2)=='pages' and Request::segment(3)=='index') active @endif" href="{{ route('admin.page.index') }}">Pages content</a>
                 <a class="collapse-item @if(Request::segment(2)=='pages' and Request::segment(3)=='create') active @endif" href="{{ route('admin.page.create') }}">Create page</a>
             </div>
         </div>
     </li>


     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Settings
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link" href="#">
             <i class="fas fa-fw fa-cog"></i>
             <span>Config</span>
         </a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->
