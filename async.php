<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="css/async.css">
    <title>Document</title>
</head>

<body>
    <!-- <form action="rest/index.php" method="POST"> -->
    <form id="registration" >
        <div class="container">

            <div class="mb-3 text-center bg-info display-3 text-white roboto ">
                <label class="form-label"><strong>AUTHENTIFICATION</strong></label>
            </div>

            <div id="divError" class="bg-danger text-white">
                
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="txtName" name="lastname" aria-describedby="nameHelp">
                <div id="nameHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="firstName" class="form-label">FirstName</label>
               
                <input type="text" class="form-control" id="firstName" name="firstname" aria-describedby="firstNameHelp" >
                <div id="firstNameHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="inputPassword1" class="form-label">Password</label>
                <input type="password" minlength="8" maxlength="20"  class="form-control" id="inputPassword1" name="password" aria-describedby="password1Help">
            </div>
            <div class="col-auto">
                <span id="password1Help" class="form-text">
                    Must be 8-20 characters long.
                </span>
            </div>
            <div class="mb-3">
                <label for="inputPassword2" class="form-label">Password confirm</label>
                <input type="password" minlength="8" maxlength="20" class="form-control" id="inputPassword2" name="confirmPassword">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Valider</button>
            </div>
        </div>
        
</form>
    <div id="validationMail" class="d-flex justify-content-center mx-4 mb-3 mb-lg-4"></div>
    <script src="js/async.js" type="module"></script>

</body>

</html>