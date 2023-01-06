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
    include_once 'db.php';//$conn
    $sql = "SELECT students.*,class.name_class FROM `students`
    JOIN class ON students.class = class.id";
    $stmt = $conn->query($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);//array
    //Lấy về dữ liệu nhiều hơn 1
    $students = $stmt->fetchAll();
    // echo '<pre>';
    // print_r($rows);
    // echo '</pre>';
?>
<a href="add.php"> Thêm mới </a>
<table class="table">
    <thead>
        <tr>
            <th>Mã học sinh</th>
            <th>Tên học sinh</th>
            <th>Lớp</th>
            <th>Ngày sinh</th>
            <th>Thông tin</th>
            <th>Giới tính</th>
            <th>Sửa, Xóa</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach( $students as $key => $row ):
            //  echo '<pre>';
            //  print_r($row);
            // die();
            ?>
            <tr>
            <td> <?php echo  $key+1;?> </td>
               <td> <?php echo $row['name'];?> </td>
               <td><?php echo $row['class'];?></td>
               <td><?php echo $row['birthday'];?></td>
               <td><?php echo $row['thongtin'];?></td>
               <td><?php echo $row['gender'];?></td>
               <td>
                    <a href="edit.php?id=<?= $row['id'] ;?>" >Edit</a> <br>
                    <!-- <button type="submit" class="w3-button w3-red" onclick="return confirm('Chuyên vào thùng rác')">Xóa</button> -->
                     <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" href="delete.php?id=<?= $row['id'] ;?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>