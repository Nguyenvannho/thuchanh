<!DOCTYPE html>
<html lang="en">

<head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Document</title>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

</body>

</html>
<?php
include_once 'db.php'; ?>
<?php
// $sql = "SELECT * FROM `students`";
$sql = "SELECT * FROM class";
$stmt = $conn->query($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ); //array 
$class = $stmt->fetchAll();
$error = [];
//Xu ly form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       // echo '<pre>';
       // print_r( $_REQUEST );
       // die();
       $name = $_REQUEST['name'];
       $class = $_REQUEST['class'];
       $birthday = $_REQUEST['birthday'];
       $thongtin = $_REQUEST['thongtin'];
       $gender = $_REQUEST['gender'];

       if ($name == "") {
              $error['name'] = 'Vui lòng nhập  tên';
       }
       if ($class == "") {
              $error['class'] = 'Vui lòng nhập  lớp';
       }
       if ($birthday == "") {
              $error['birthday'] = 'Vui lòng nhập  ngày sinh';
       }
       if ($thongtin == "") {
              $error['thongtin'] = 'Vui lòng nhập  thông tin';
       }
       if ($gender == "") {
              $error['gender'] = 'Vui lòng nhập  giới tính';
       }


       if (empty($error)) {
              $sql = "INSERT INTO students(name,class,birthday,thongtin,gender)
                     VALUES('$name','$class','$birthday','$thongtin','$gender')";

              // echo ($sql);
              // die();

              //Thuc hien truy van
              $conn->exec($sql);

              //Chuyen huong
              header("Location: list.php");
       }
       //Viet cau truy van

}
?>
<div class="contaner">
       <div class="row">
<form action="" method="post">
       Tên Học Sinh :<input class="form-control" type="text" name="name"> <br>
       <div class="text-danger"> <?php echo isset($error['name']) ? $error['name'] : ''; ?> </div>
       Lớp:
       <select  class="form-control"  name="class" id="">
              <?php foreach ($class as $key => $item) : ?>
                     <option value="<?= $item->id ?>"><?= $item->name_class ?></option>
              <?php endforeach; ?>
       </select>
       <br>
       Ngày Sinh: <input class="form-control" type="date" name="birthday"> <br>
       <div class="text-danger"> <?php echo isset($error['birthday']) ? $error['birthday'] : ''; ?> </div>
       Thông tin: <input class="form-control" type="text" name="thongtin"> <br>
       <div class="text-danger"> <?php echo isset($error['thongtin']) ? $error['thongtin'] : ''; ?> </div>
       Giới Tính:
       <select name='gender' class="form-select b-0">
              <option value="Nam">Nam</option>
              <option value="Nữ">Nữ</option>
       </select>
       <input class="btn btn-primary" type="submit" value="Them">
       <a class="btn btn-dark" href="list.php">Thoát</a>
</form>
</div>
</div>