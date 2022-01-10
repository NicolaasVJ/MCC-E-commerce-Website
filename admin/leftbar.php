<?php

if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}
else {

?>

<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-15">
    </div>
    <div class="sidebar-brand-text mx-3">ADMIN PANEL</div>
</a>

<hr class="sidebar-divider my-0">

<li class="nav-item">
    <a class="nav-link" href="index.php?dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<hr class="sidebar-divider my-0">

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-tshirt"></i>
        <span>Products</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="= py-2 collapse-inner rounded">
            <a class="collapse-item" href="index.php?insert_product">Add Products</a>
            <a class="collapse-item" href="index.php?view_product">List of products</a>
        </div>
    </div>
</li>

<hr class="sidebar-divider my-0">

<li class="nav-item">
    <a class="nav-link" href="index.php?view_order">
        <i class="fas fa-shopping-cart"></i>
        <span>Orders</span></a>
</li>

<hr class="sidebar-divider my-0">

<li class="nav-item">
    <a class="nav-link" href="index.php?view_customer">
        <i class="fas fa-address-book"></i>
        <span>Customer</span></a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-users-cog"></i>
        <span>Administrators</span>
    </a>
    <div id="collapseAdmin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="py-2 collapse-inner rounded">
            <a class="collapse-item" href="index.php?insert_admin">Add Admin</a>
            <a class="collapse-item" href="index.php?view_admin">List of Administrators</a>
            <a class="collapse-item" href="index.php?update_admin">Edit Profile</a>
        </div>
    </div>
</li>

<hr class="sidebar-divider my-0">

<li class="nav-item ">
    <a class="nav-link" href="logout.php">
        <i class="fas fa-sign-out-alt"></i>
        <span>Log out</span></a>
</li>

<hr class="sidebar-divider d-none d-md-block">
</ul>

<?php } ?>