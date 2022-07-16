<!-- ================================================== Connection to Database ==================================================== -->
<?php
    $servername="localhost";
    $username="root";
    $password="";
    $database="noteapp";

    //INSERT INTO `noteappdetails` (`notetitle`, `notedetails`, `datetime`) VALUES ('Go to College', 'I will go to college tack  my Laptop', current_timestamp());
    $connection=mysqli_connect($servername,$username,$password,$database);
    if(!$connection)
    {
        echo("Connection is  not Successfully");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note-App</title>
</head>
<body>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    
    <title>Note-App</title>
  </head>
  <body>
    <!-- ===================================================== Navbar ============================================================== -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand" href="#">Note-App</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
              </li>
            </ul>
            <button type="button" class="btn btn-outline-warning" id="darkmodebtn">Enable Dark mode</button>
      </div>
      </div>
</nav>
<!-- ======================================================== Insert Database ========================================= -->
<?php
 if($_SERVER["REQUEST_METHOD"]=="POST")
 {
     $notetitle=$_POST["Title"];
     $notedetalis=$_POST["NoteDetalis"];

     if ($notetitle=="" || $notedetalis=="")
      {
        echo("<div class='alert alert-danger alert-dismissible fade show' role='danger'>
        <strong>Something Worng!!!</strong> Your Note-Title or Note-Detalis empty!!!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>");
      }

      else
        {
            $sql="INSERT INTO `noteappdetails` (`no`, `notetitle`, `notedetails`, `datetime`) VALUES (NULL, '$notetitle', '$notedetalis', current_timestamp())";
            $result=mysqli_query($connection,$sql);
            if(!$result)
              {
                  echo("<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                  <strong>Not Successfully!!!</strong> You Note is not Insert Successfully!!!
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>");
              }
            else
              {
                  echo("<div class='alert alert-success alert-dismissible fade show' role='alert'>
                  <strong>Successfully!</strong> Your Note is Insert Successfully!!.
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>");
              }
        }
  }
?>
    <!-- ====================================================== Text-Area ========================================================== -->

<div class="form" style="Width:50%;margin-left:25%;margin-top:5%">
    <form action="/php-program/Noteapp.php" method="post">
    <div class="mb-3 ">
        <label for="exampleFormControlInput1" class="form-label">Note Title</label>
        <input type="txt" id="Title" name="Title" class="form-control" placeholder="">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Note Detalis  </label>
        <textarea class="form-control" id="NoteDetails" name="NoteDetalis" rows="3"></textarea>
    </div>
    <div class="button">
    <button class="btn btn-primary" type="submit">Submit</button>
    </div>
</form>
</div>
<!-- ========================================================= Select Database value =================================== -->
<div class="container">
<!-- <?php
    $sql="SELECT * FROM `noteappdetails`";
    $result=mysqli_query($connection,$sql);
    while($row=mysqli_fetch_assoc($result))
    {
        echo"<br>";
        echo $row["notetitle"]."<br>".$row["notedetails"]."<br>". $row["datetime"];
        echo "<br>";
    }
?> -->

<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col" class="form-label">No</th>
      <th scope="col" class="form-label">Title</th>
      <th scope="col" class="form-label">Details</th>
      <th scope="col" class="form-label">Date-Time</th>
      <th scope="col" class="form-label">Action</th>
    </tr>
  </thead>
  <tbody>
  <!-- ===================================================== Display Data in Table Form =============================================== -->
    <?php
    $sql="SELECT * FROM `noteappdetails`";
    $result=mysqli_query($connection,$sql);
    $sno=0;
    while($row=mysqli_fetch_assoc($result))
    {
        $sno= $sno+1;
        echo"<tr>
        <th scope='row'>".$sno."</th>
        <td>".$row["notetitle"]."</td>
        <td>".$row["notedetails"]."</td>
        <td>".$row["datetime"]."</td>
        <td><button class='btn btn-primary' class='delete' type='submit' onclick='remove(this)' style='width:70%'>Delete</button></td>
      </tr>";
    }
    ?>  
  </tbody>
</table>
</div>
<hr>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
  $(document).ready( function () 
  {
    $('#myTable').DataTable();
  } );  
</script>

<script>
  function remove(target)
  {
    target.parentElement.parentElement.remove();
  }

  $("#darkmodebtn").click(function()
  {
    $("body").css('background-color','#042743');
    $(".form-label").css('color','white');
  });
</script>
  </body>
</html>
</body>
</html>