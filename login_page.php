<?php include('header.php') ?>
  <div class="container">
        <div class="row">
          <h1>LOGIN TO JEDI TEMPLE</h1>
        </div>
        <div class="row">
          <div class="jumbotron">
            <form id='login' action='login_handler.php' method='post' accept-charset='UTF-8'>
              <fieldset >
                <legend>Login</legend>
                <input type='hidden' name='submitted' id='submitted' value='1'/>
                <div class="form-group">
                  <label for='username' >User Name*:</label>
                  <input type='text' class="form-control" name='username' id='username'  maxlength="50" />
                </div>
                <div class="form-group">
                  <label for='password' >Password*:</label>
                  <input type='password' class="form-control" name='password' id='password' maxlength="50" />
                </div>
                <div class="form-group">
                  <input class="btn btn-default" type='submit' name='Submit' value='Submit' />
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
<?php include('footer.php') ?>
