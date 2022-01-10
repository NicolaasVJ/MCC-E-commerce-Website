<?php 
    $dbCon = new dbConnect();

        $user_session = $_SESSION['user_email'];

        $query = "SELECT name FROM customer WHERE EMAIL='$user_session'";

        $User = $dbCon->query($query);

        $db_user = mysqli_fetch_array($User);

        $_SESSION['username'] = $db_user['name'];
?>
<ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-light "> <?php echo $_SESSION['username']; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item small" href="view_customer.php">
                            <i class="fas fa-cogs fa-sm fa-fw mr-3" bg-transparent text-decoration-none style="cursor: pointer;" data-toggle="modal" data-target="#UpdateModal" data-dismiss="modal">></i>
                            Edit Profile
                           
                        </a>
                        <a class="dropdown-item small" href="purchaseHistory.php">
                            <i class="fas fa-list fa-sm fa-fw mr-3"></i>
                            Purchase History
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="logout.php" name="logout">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-3 "></i>
                            Log out
                        </a>
                        
                    </div>
                </li>

            </ul>