<?php include 'midleware.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form action="code.php" method="post">
    <div class="container mb-4">
        <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Student ID</label>
                <input type="text" name= "id" class="form-control">
        </div>
        <div class="mb-3">
                <label class="form-label">Student Name</label>
                <input type="text" name= "name" class="form-control" >
        </div>
        <div class="mb-3">
                <label  class="form-label">Student Email</label>
                <input type="email" name= "email" class="form-control" >
        </div>
        <div class="mb-3">
                <label class="form-label">Courses</label>
                <input type="text" name= "course" class="form-control">
        </div>
        <div class="mb-3">
                <label class="form-label">Grades</label>
                <input type="text" name= "grade" class="form-control">
        </div>
        <button type="submit" name="addstudent" class="btn btn-primary">Submit</button>
    </div>
</form>
</body>
</html>
<?php
echo $_SESSION['user_id'];
?>