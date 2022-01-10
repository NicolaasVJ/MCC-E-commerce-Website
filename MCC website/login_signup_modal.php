<div class="modal" id="loginModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <div class="modal-header border-bottom-0 p-2 px-3 ">
          <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="modal-body">
            <form method="post"action="login.php">
                <h2 class="modal-title">Log in</h2>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4 btn-block py-2 mb-3 text-uppercase font-weight-bold" name="login">Log in</button>
                <p class="mb-3">Don't have an account?
                    <a class="text-info border-0 bg-transparent text-decoration-none" style="cursor: pointer;" data-toggle="modal" data-target="#SignUpModal" data-dismiss="modal">Sign Up</a>
                </p>
            </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="SignUpModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-bottom-0 p-2 px-3">
          <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body pb-2">
            <form method="POST" class="px-3" action="signup.php">
                <h2 class="modal-title mb-3">Sign Up</h2>
                <div class="form-group">
                    <label for="name">Name and Surname</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cell">Cell Number</label>
                    <input type="text" name="cell" id="cell" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4 btn-block py-2 mb-3 font-weight-bold text-uppercase" name="signup">Sign Up</button>
                <p class="mb-3">Already have an account?
                    <a class="text-info font-weight-bold border-0 bg-transparent text-decoration-none" style="cursor: pointer;" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Log in</a>
                </p>
            </form>
        </div>
      </div>
    </div>
  </div>
