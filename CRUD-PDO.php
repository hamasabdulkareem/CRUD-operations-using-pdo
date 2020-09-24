<?php
       
    //===== Creat Database ======== //

        $sql = "CREATE DATABASE CRUD_PDO";
        $conn->exec($sql);

    // ======== Connect DB ======= //

        $servername = "localhost";
        $dbname = "CRUD_PDO";
        $username = "root";
        $password = "";
        $conn = "mysql::host=$servername;dbname=$dbname";
        $options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,];
        $conn = new PDO($conn, $username, $password, $options);

    //======= Create Table ======== //

        $sql = "CREATE TABLE Employees (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        Address VARCHAR(50),
        phone INT(9)
        )";
        $conn->exec($sql);

    //======= Insert Date ======== //

        $sql = "INSERT INTO Employees (firstname, lastname, email, Address, phone)
        VALUES ('Ahmad', 'Ali', 'Ahmad132@gmail.com','Sanaa','777435989')";
        $conn->exec($sql);

    //======= Insert Multiple Records ======== //

        $conn->beginTransaction();
        $conn->exec("INSERT INTO Employees2 (firstname, lastname, email, Address, phone)
        VALUES ('Ahmad', 'Ali', 'Ahmad132@gmail.com','Sanaa','777435989')");
        $conn->exec("INSERT INTO Employees2 (firstname, lastname, email, Address, phone)
        VALUES ('Maher', 'Mohammed', 'Maher564@gmail.com','Tize','711888909')");
        $conn->exec("INSERT INTO Employees2 (firstname, lastname, email, Address, phone)
        VALUES ('Abdulkareem', 'Esmail', 'Abdulkareem@gmail.com','Aden','732564756')");
        $conn->commit();


    //======= Select Data ======== //

        $stmt = $conn->prepare("SELECT * FROM Employees");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $k=>$v) {
        echo $v['firstname']." ".$v['lastname']." ".$v['email']." ".$v['Address']." ".$v['phone']."<br><br>";
        }

    //======= Select Data Where ======== //

        $stmt = $conn->prepare("SELECT * FROM Employees WHERE phone='732564756'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $k=>$v) {
        echo $v['firstname']." ".$v['lastname']." ".$v['email']." ".$v['Address']." ".$v['phone']."<br><br>";
        }
             

    //======= Delete Data ======== //     
                    
        $sql = "DELETE FROM Employees WHERE id=4";
        $conn->exec($sql);
        echo "Record deleted successfully";
                 
                  
    //======= Updata Data ======== // 

       $sql = "UPDATE Employees SET lastname='Khaled' WHERE id=2";
       $stmt = $conn->prepare($sql);
       $stmt->execute();
       echo $stmt->rowCount() . " records UPDATED successfully";
                    
?>