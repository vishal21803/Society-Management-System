<?php @session_start();
 
 $a=$_REQUEST["name"];
 $b=$_REQUEST["password"];

 include("connectdb.php");

 $rsCust=mysqli_query($con,"select * from sens_users where BINARY name='$a' ");

 if(mysqli_num_rows($rsCust)==0){
    header("location:login.php?regmsg=1");
 }
 else{
      $row=mysqli_fetch_array($rsCust);

      if($row["password"]==$b){
        
        $_SESSION['uname']=$a;
        $_SESSION['uid']=$row["id"];

                $memid=$row["id"];

         $rsmem=mysqli_query($con,"select * from sens_members where user_id='$memid' ");
        while($row5=mysqli_fetch_array($rsmem)) {
          $_SESSION["member_id"]=$row5["member_id"];
        }





        if($row["role"]=='user'){
            
            $_SESSION['utype']='user';
            header("location:userPage.php");
        }

        elseif($row["role"]=='admin'){
            
            $_SESSION['utype']='admin';
            header("location:adminPage.php");
        }

         elseif($row["role"]=='accountant'){
            
            $_SESSION['utype']='accountant';
            header("location:accountantPage.php");
        }

      }
      
      else{
        header("location:login.php?regmsg=2");

      }


 }

