<?php
include  "./config_database.php";
session_start();
if (
    isset($_SESSION['USER_ID']) &&
  isset( $_SESSION['SESSION_EMAIL'])
) {
    include "./header.php";
?>

    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Bootstrap CSS -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        <style>
            .border-right {
                margin-left: 30px;
            }

            .borderbottom {
                border-bottom: solid gray 1px;
            }

            .borderright {
                border-right: solid gray 1px;
            }

            .editusername {
                border-radius: 5px;
                margin: auto;
                background-color: white;
                border: solid black 1px;
                box-shadow: black 1px 1px 1px 1px;
                position: fixed;
                z-index: 3000;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                display: none;
                visibility: hidden;
                overflow-y: scroll;
            }

            .scroll {
                margin: 4px, 4px;
                padding: 4px;
                background-color: white;
                width: 400px;
                height: 300px;
                overflow-x: hidden;
                overflow-y: auto;
                text-align: justify;
            }

            #nameform input {
                width: 70%;
                height: 40px;
                border: solid black 1px;
                border-radius: 10px;
                padding: 5px;
                outline: none;
                margin-top: 40px;
            }

            #nameform .updatename {
                margin-top: 40px;
                height: 40px;
                width: 40%;
                background-color: #EF4056;
                border-radius: 10px;
                outline: none;
            }

            .subprofiles {
                padding: 0;
                margin: 0;
                list-style: none;
            }

            .subprofiles a {
                color: black;
                display: block;
                padding: 10px;
                text-decoration: none;
            }

            .subprofiles li {
                display: block;
                width: 100%;
                height: 40px;
                color: white;
                border-bottom: solid black 1px;
            }

            .subprofiles a:hover {
                text-decoration: none;
            }

            .subprofiles a:hover {
                color: red;
                transition: all 0.5s;
            }

            .addnumber {
                background-color: #CCFFCC;
                outline: none;
                border-radius: 10px;
                color: black;
            }

            #editname input {
                border-radius: 5px;
                width: 100%;
                padding: 10px;
                height: 40px;
            }

            #editnumberform input {
                border-radius: 5px;
                width: 100%;
                padding: 10px;
                height: 40px;
            }

            #editpasswordform input {
                border-radius: 5px;
                width: 100%;
                padding: 10px;
                height: 40px;
            }

            #editemailform input {
                border-radius: 5px;
                width: 100%;
                padding: 10px;
                height: 40px;
            }

            #addcodeform input {
                border-radius: 5px;
                width: 100%;
                padding: 10px;
                height: 40px;
            }


            #editname input {
                border-radius: 5px;
                width: 100%;
                padding: 10px;
                height: 40px;
            }


            #editcodeform input {
                border-radius: 5px;
                width: 100%;
                padding: 10px;
                height: 40px;
            }

            .details .col {
                height: 50px;
                padding: 10px;
                font-size: 20px;
            }


            .profile ul {
                padding: 0;
                list-style: none;
                margin: 0;
            }

            .profile ul li {
                display: block;
                width: 100%;
                border-radius: 5px;
            }

            .profile ul li:hover {
                display: block;
                width: 100%;
                transition: all 1.5s;
                background-color: #e0e0e0;
            }

            .profile ul li a {
                color: black;
                display: block;
                font-size: 20px;
                text-decoration: none;
                padding: 15px;
            }

            .profile ul li a:hover {
                text-decoration: none;

            }

            .message {
                width: 200px;
                height: 100px;
                padding: 10px;
                color: black;
                background-color: #EF4056;
                border-radius: 5px;
                font-size: 17px;
                position: fixed;
                top: 30px;
                z-index: 8000;
                left: 50%;
                transform: translateX(-50%);
                display: none;

            }

            #editpasswordform label {
                margin-top: 10px;
            }



            input[type="number"] {
                width: 50px;
                height: 50px;
                font-size: 30px;
                text-align: center;
                border-radius: 5px;
                padding: 10px;
                margin-left: 20px;
            }

            .code::-webkit-outer-spin-button,
            .code::-webkit-inner-spin-button {
                margin: 0;
                -webkit-appearance: none;
            }

            .loader {
                border: 16px solid #f3f3f3;
                /* Light grey */
                border-top: 16px solid #3498db;
                /* Blue */
                border-radius: 50%;
                width: 120px;
                height: 120px;
                animation: spin 2s linear infinite;
                position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                margin: auto;
                z-index: 12000;
                display: none;
                visibility: hidden;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            #error-email-format {
                font-size: 20px;
                color: red;
                padding: 10px;
                margin-top: 10px;
            }

            body.modal-open .supreme-container {
                -webkit-filter: blur(1px);
                -moz-filter: blur(1px);
                -o-filter: blur(1px);
                -ms-filter: blur(1px);
                filter: blur(1px);
            }

            .err_ad {
                color: #EF4056;
                font-size: 16px;
            }

            .btn23 {
                color: black;
                padding-left: 15px;
                padding-top: 15px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin-right: 10px;
                cursor: pointer;
                width: 200px;
                border-radius: 5px;
            }
            .div1,
            .div2 {
                border: solid gray 1px;
                border-radius: 5px;
                padding: 15px;
                width: 850px;
                margin-top: 20px;
                margin-left: 20px;
            }
            .button1 {
                border-bottom: solid #EF4056 4px;
            }
        </style>
    </head>

    <body>

        <div class="loader"></div>

        <!-- message box   -->
        <div class="message"></div>
        <!-- message box   -->

        <!-- Modal for edit name  -->

        <div class="modal fade" id="editnamemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog   modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editname</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editname" method="post">
                            <input name="name" type="text" placeholder="Update name" value="<?php
                                                                                            $query  = $mysqli->query("SELECT * FROM users WHERE 
                                        id= '$_SESSION[USER_ID]'");
                                                                                            while ($row = mysqli_fetch_assoc($query)) {
                                                                                                echo $row["name"];
                                                                                            }
                                                                                            ?> ">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="update" data-dismiss="modal">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal for edit name  -->





        <!-- Modal for  add number -->

        <div class="modal fade" id="addnumber" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog   modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add number </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addnumberform" method="post">
                            <input name="number" type="text" placeholder="+912-----------">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addnumberbtn" data-dismiss="modal">Add number </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal for  add number -->




        <!-- Modal for  edit number -->

        <div class="modal fade" id="editnumbermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit number </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editnumberform" method="post">
                            <input name="editnumber" type="text" value="<?php
                                                                        $query  = $mysqli->query("SELECT * FROM phones 
                             WHERE userid = '$_SESSION[USER_ID]'
                             ");
                                                                        while ($row = mysqli_fetch_assoc($query)) {
                                                                            $number  = $row["phonenumber"];
                                                                            echo $number;
                                                                        }

                                                                        ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="editnumberbtn" data-dismiss="modal">Edit number </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal for  edit number -->




        <!-- Modal for  edit password -->

        <div class="modal fade" id="editpassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog   modal-dialog-centered  " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit password </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editpasswordform" method="post">
                            <label for="previousepass">Previous password </label>
                            <input name="previousepass" type="text" id="previousepass">

                            <label for="newpass">New password</label>
                            <input name="newpass" type="text" id="newpass">

                            <label for="confirm">Confirm password</label>
                            <input name="confirm" type="text" id="confirmpass">

                    </div>
                    <a href="forgotpassword.php" class="p-4"> Forgot password </a>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="editpasswordbtn" data-dismiss="modal">Edit Password </button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- Modal for  edit password -->



        <!-- Modal for  add code number -->

        <div class="modal fade" id="addcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog   modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add code </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addcodeform" method="post">
                            <input name="code" type="text">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addcodebtn" data-dismiss="modal">Add code </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal for  add code number -->






        <!-- Modal for  edit code number -->

        <div class="modal fade" id="editcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog   modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit code </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editcodeform" method="post">
                            <input name="newcode" type="text" value=<?php
                                                                    $queryy  = $mysqli->query("SELECT * FROM identifynumber 
                             WHERE userid = '$_SESSION[USER_ID]'
                             ");
                                                                    while ($row = mysqli_fetch_assoc($queryy)) {
                                                                        $code  = $row["identifynumber"];
                                                                        echo $code;
                                                                    }
                                                                    ?>>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="editcodebtn" data-dismiss="modal">Edit code </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal for  edit code number -->







        <!-- Modal for  add  borthday  -->

        <div class="modal fade" id="addbirthday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog   modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add your birthday </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="addbithdayform">
                            <div class="form-group "> <!-- Date input -->
                                <label class="control-label" for="date">Date </label>
                                <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text" />
                            </div>
                            <div class="form-group"> <!-- Submit button -->
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addbirthdaybtn" data-dismiss="modal">Add Birthday </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal for  add  borthday  -->




        <!-- Modal for  edit  borthday  -->

        <div class="modal fade" id="editbirthday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog   modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit your birthday </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="editbirthdayform">
                            <div class="form-group "> <!-- Date input -->
                                <label class="control-label" for="date">Date </label>
                                <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text" />
                            </div>
                            <div class="form-group"> <!-- Submit button -->
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="editbirthdaybtn" data-dismiss="modal">Edit </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal for  edit  borthday  -->






        <!-- Modal for edit emial  -->

        <div class="modal fade" id="editemail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog   modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit email</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editemailform" method="post">
                            <input name="name" type="text" placeholder="Update email" value="<?php
                                                                                                $query  = $mysqli->query("SELECT * FROM users WHERE 
                                        id= '$_SESSION[USER_ID]'");
                                                                                                while ($row = mysqli_fetch_assoc($query)) {
                                                                                                    echo $row["email"];
                                                                                                }
                                                                                                ?> ">
                            <span id="error-email-format"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="editemailbtn" data-dismiss="modal">edit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal for edit email  -->



        <!-- Modal for varify emial  -->

        <div class="modal fade" id="verifyemail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog   modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">verify email</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="verifyemailform" method="post">
                            <input type="number" placeholder="0" required min="0" max="9" class="code   " name="1000gan" id="1000gan" required>
                            <input type="number" placeholder="0" required min="0" max="9" class="code   " name="100gan" id="100gan" required>
                            <input type="number" placeholder="0" required min="0" max="9" class="code   " name="10gan" id="10gan" required>
                            <input type="number" placeholder="0" required min="0" max="9" class="code   " name="yekan" id="yekan" required>
                    </div>
                    <div class="modal-footer">

                        <div>Timer : <span id="timer"></span></div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="verifyemailbtn" data-dismiss="modal">Verify</button>
                        <button type="button" class="btn btn-primary" id="resendcode" data-dismiss="modal">Resend code </button>

                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal for varify emial  -->


        <!-- Modal for addres  -->

        <div class="modal fade" id="addaddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog   modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add address</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addaddressform" method="post">
                            <input type="text" placeholder="Address line 1" class="ad_l1  " style="width: 70%;">
                            <div class="error_ad_1  err_ad"></div>
                            <br>
                            <input type="text" placeholder="Address line 2" class="ad_l2  mt-3" style="width: 70%">
                            <div class="error_ad_2  err_ad"></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addaddressbtn">Add</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal for address -->
        <div class="container-fluide px-4  boxy" style="width:90%;margin:180px  auto">
            <div class="row gx-5 " id="reload">
                <div class="col-md-3">
                    <div class="p-3 border bg-light" style="border-radius: 5px;">
                        <i class='bx bx-user-circle' style="font-size: 30px;"></i>
                        <span style="font-size: 30px;">
                            <?php
                            $query  = $mysqli->query("SELECT * FROM users WHERE 
                                        id= '$_SESSION[USER_ID]'");
                            while ($row = mysqli_fetch_assoc($query)) {
                                echo $row["name"];
                            }
                            ?>
                        </span>
                        <hr>
                        <div class="profile">
                            <ul>
                                <li><a href="./userdetails.php?profile=true"><i class='bx bx-user-pin'></i> profile</a></li>
                                <li><a href="./userdetails.php?profile/addresses=true"> <i class='bx bxs-direction-left'></i> Addresses</a></li>
                                <li><a href="./userdetails.php?profile/comments=true"><i class='bx bx-chat'></i> Comments</a></li>
                                <li><a href="./userdetails.php?profile/recently_watched=true"> <i class='bx bx-time-five'></i> recently Watched</a></li>
                                <li><a href="./userdetails.php?profile/favorite"><i class='bx bxs-heart'></i> Favorite</a></li>
                                <li><a href="./userdetails.php?profile/orders"><i class='bx bx-cart'></i> Orders </a></li>
                                <li><a href="./logout.php"><i class='bx bx-log-out'></i> Logout </a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_GET['profile'])) {
                ?>
                    <div class="col-md-9  details   columnmargintop">
                        <div class="p-3 border bg-white" style="border-radius: 10px ">
                            <div class="row ">
                                <div class="col mt-1"><span style="color: red;">Name : </span>

                                    <span style="font-size: 17px;">
                                        <?php
                                        $query  = $mysqli->query("SELECT * FROM users WHERE 
                                        id= '$_SESSION[USER_ID]'");
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            echo $row["name"];
                                        }
                                        ?>
                                    </span>
                                    <button style="float: right;" type="button" class="btn btn-primary  " data-toggle="modal" data-target="#editnamemodal">
                                        <i class='bx bxs-edit-alt' style="font-size: 16px;"></i>
                                    </button>
                                </div>
                                <div class="col mt-1">
                                    <span style="color: red;">Number : </span>
                                    <?php
                                    $queryearchfornumber  = $mysqli->query("SELECT * From  phones WHERE 
                                    userid = '$_SESSION[USER_ID]'  
                                ");
                                    if ($queryearchfornumber->num_rows  === 1) {
                                        while ($row = mysqli_fetch_assoc($queryearchfornumber)) {
                                            $number  = $row["phonenumber"];
                                        }
                                        echo  "<span style='font-size:16px;padding:10px'>";
                                        echo  $number;
                                        echo  "</span>";
                                        echo  "    <button  style='float: right;' type='button' class='btn btn-primary' data-toggle='modal' data-target='#editnumbermodal'>
                                    <i class='bx bxs-edit-alt ' style='font-size: 16px;' ></i>
                                        
                                        </button>
                                        ";
                                    } else {
                                        echo  "<span style='font-size:16px'>Add number !  </span>";
                                        echo  "    <button   style='float: right;' type='button' class='btn  btn-primary' data-toggle='modal' data-target='#addnumber'>
                                <i class='bx bx-add-to-queue ' style='font-size: 20px;' ></i>
                                    </button>
                                    ";
                                    }
                                    ?>
                                </div>
                                <div class="w-100 ">
                                </div>
                                <div class="col mt-3"> <span style="color: red;"> Password : </span>

                                    <?php
                                    $str = " * * * * * * * *  * ";
                                    echo $str;
                                    echo  "    <button   style='float: right;' type='button' class='btn btn-primary ml-3' data-toggle='modal' data-target='#editpassword'>
                                    <i class='bx bxs-edit-alt' style='font-size: 16px;' ></i>
                                        </button>
                                        ";

                                    ?>


                                </div>
                                <div class="col mt-3"> <span style="color: red;"> Identity number : </span>
                                    <?php
                                    $userid = $_SESSION["USER_ID"];
                                    $querysearch = $mysqli->query("SELECT * FROM identifynumber WHERE 
                                  userid =  '$userid'  
                                  ");
                                    if (mysqli_num_rows($querysearch) == 0) {
                                        echo  "<span style='font-size:16px'>Add your code !  </span>";
                                        echo  "    <button  style='float: right;' type='button' class='btn btn-primary ml-3' data-toggle='modal' data-target='#addcode'>
                                    <i class='bx bx-add-to-queue' style='font-size: 16px;' ></i>
                                        </button>
                                    ";
                                    } else {
                                        while ($row  = mysqli_fetch_assoc($querysearch)) {
                                            $code  = $row["identifynumber"];
                                        }
                                        echo  "<span style='font-size:16px;padding:10px'>";
                                        echo  $code;
                                        echo  "</span>";

                                        echo  "    <button  style='float: right;' type='button' class='btn btn-primary' data-toggle='modal' data-target='#editcode'>
                                    <i class='bx bxs-edit-alt ' style='font-size: 16px;' ></i>

                                        </button>  ";
                                    }


                                    ?>
                                </div>
                                <div class="w-100"></div>
                                <div class="col  mt-3 pb-3"> <span style="color: red;"> Birthday : </span>
                                    <?php
                                    $userid = $_SESSION["USER_ID"];
                                    $querysearch = $mysqli->query("SELECT * FROM birthday WHERE 
                                   userid =  '$userid'  
                                  ");
                                    if (mysqli_num_rows($querysearch) == 0) {
                                        echo  "<span style='font-size:16px'>Add your birthday  !</span>";
                                        echo  "    <button  style='float: right;' type='button' class='btn btn-primary ml-3' data-toggle='modal' data-target='#addbirthday'>
                                    <i class='bx bx-add-to-queue' style='font-size: 16px;' ></i>
                                        </button>
                                    ";
                                    } else {
                                        while ($row  = mysqli_fetch_assoc($querysearch)) {
                                            $year = $row["year"];
                                            $month = $row["month"];
                                            $day = $row["day"];
                                        }
                                        echo  "<span style='font-size:16px;padding:10px'>";
                                        echo   $month . "/" . $day . "/" . $year;
                                        echo  "</span>";

                                        echo  "    <button  style='float: right;' type='button' class='btn btn-primary' data-toggle='modal' data-target='#editbirthday'>
                                    <i class='bx bxs-edit-alt ' style='font-size: 16px;' ></i>

                                        </button>  ";
                                    }
                                    ?>
                                </div>
                                <div class="col mt-3  pb-3"> <span style="color: red;"> Email : </span>
                                    <?php
                                    $query  = $mysqli->query("SELECT * From  users WHERE 
                                       id  = '$_SESSION[USER_ID]'  ");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        $email  = $row["email"];
                                    };
                                    echo  "<span style='font-size:16px;padding:10px'>";
                                    echo   $email;
                                    echo  "</span>";
                                    if (isset($_SESSION["verifycodeforeditemail"])) {
                                        echo  "    <button  style='float: right;' type='button' class='btn btn-primary' data-toggle='modal' data-target='#verifyemail'>
                                        <i class='bx bxs-edit-alt ' style='font-size: 16px;' ></i>
                                            </button>  ";
                                    } else {
                                        echo  "  <button  style='float: right;' type='button' class='btn btn-primary' data-toggle='modal' data-target='#editemail'>
                                        <i class='bx bxs-edit-alt ' style='font-size: 16px;' ></i>
                                            </button>  ";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php
                } else if (isset($_GET["profile/addresses"])) {
                ?>
                    <div class="col-md-9  details   columnmargintop" id="addreses">
                        <div class="p-3 border bg-white" style="border-radius: 10px ">
                            <div class="row">
                                <span style="font-size: 30px;padding:5px;color:#ef4056;border-bottom:solid #ef4056 3px;margin-left:10px;float:left">Addresses</span>

                                <button type='button' class='btn btn-success' data-toggle='modal' data-target='#addaddress' style="margin-left: 70%;">
                                    <i class='bx bx-add-to-queue' style='font-size: 20px'></i>
                                </button>
                            </div>
                            <div class="addreses">
                                <?php
                                $counter = 1;
                                $query = $mysqli->query("SELECT *  FROM addresses WHERE  user_id='$_SESSION[USER_ID]'");
                                if (mysqli_num_rows($query) > 0) {
                                    while ($row3 = mysqli_fetch_assoc($query)) {
                                        echo  " <h4 style='padding:5px;margin-top:10px'>Address " . $counter  . "</h4>";
                                        echo  $row3["address_line1"] . "," . $row3['address_line2'];
                                        echo "<form method='post' style='float:right'>";
                                        echo  "<input  hidden type='text' value=" . $row3["ad_id"] . ">";
                                        echo "<span class='delete_address' style='font-szie:29px;color:red;float:right'><i class='bx bxs-trash-alt'></i></span>";
                                        echo  "</form>";
                                        $counter = $counter + 1;
                                    }
                                } else {
                                ?>
                                    <div>

                                        <br>
                                        <br>
                                        <img src="./images/empty-cart.svg" alt="empty cart image  svg ">
                                        <span style="font-size:17px;"> There is no any address added !
                                        </span>
                                    </div>
                            </div>
                        <?php   } ?>




                    <?php
                } else if (isset($_GET["profile/comments"])) {
                    ?>
                        <div class="col-md-9  details   columnmargintop" style=" overflow-y: scroll; height:400px;">

                            <div class="p-3 border bg-white" style="border-radius: 10px ">
                                <div class="row">
                                    <span style="font-size: 30px;padding:5px;color:#ef4056;border-bottom:solid #ef4056 3px;margin-left:10px;float:left">Comments</span>
                                </div>

                                <div class="comments  row" id="comments">
                                    <?php

                                    $query = $mysqli->query("SELECT * FROM comment WHERE user_id='$_SESSION[USER_ID]' ");
                                    if (mysqli_num_rows($query) > 0) {

                                        while ($row = mysqli_fetch_assoc($query)) {
                                            $p_id = $row["p_id"];
                                            $query2 = $mysqli->query("SELECT * FROM tbl_product WHERE p_id='$p_id'");
                                            while ($row2 = mysqli_fetch_assoc($query2)) {
                                                echo "<div class='col-4' style='position:relative'>";
                                                echo "<div style='padding:20px'>";
                                                echo  "<form method='post'> ";
                                                echo  "<span class='delete_comment' style='color:red;position:absolute;top:10px;right:50px'><i class='bx bx-trash-alt'></i> </span>";
                                                echo "<input type='text' hidden value=" . $row["comment_id"] . ">";
                                                echo  "</form>";
                                                echo  "<a href=http://shop.test/showproduct.php?p_id=" . $p_id . ">";
                                                echo   "<img  width='100px' height='100px' src=./Uploaded_images/" . $row2["p_featured_photo"] . ">";
                                                echo "</a>";
                                                echo "<div style='width:200px'>";
                                                echo "<span style='font-size:20px'>"  . $row["title"]  . "</span>";
                                                echo "<div style='font-size:14px'>"  . $row["idea"]  . "</div>";
                                                echo "</div>";
                                                echo  "</div>";
                                                echo "</div>";
                                            }
                                        }
                                    } else {
                                    ?>
                                        <div>

                                            <br>
                                            <br>
                                            <img src="./images/empty-cart.svg" alt="empty cart image  svg ">
                                            <span style="font-size:17px;"> There is not any Comment !
                                            </span>
                                        </div>
                                    <?php   } ?>
                                </div>

                            </div>
                        </div>








                    <?php
                } else if (isset($_GET["profile/recently_watched"])) {
                    ?>
                        <div class="col-md-9  details   columnmargintop">

                            <div class="p-3 border bg-white" style="border-radius: 10px ">
                                <div class="row">
                                    <span style="font-size: 30px;padding:5px;color:#ef4056;border-bottom:solid #ef4056 3px;margin-left:10px;float:left">Recently Watched</span>
                                </div>
                                <div class="rec_watched  row" id="rec_watched">
                                    <?php

                                    $query = $mysqli->query("SELECT * FROM  recentcheak   WHERE userid='$_SESSION[USER_ID]' limit 5 ");
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            $p_id = $row["productid"];

                                            $query2 = $mysqli->query("SELECT * FROM tbl_product WHERE p_id='$p_id' ");
                                            while ($row2 = mysqli_fetch_assoc($query2)) {
                                                echo "<div class='col-4''>";
                                                echo "<div style='padding:20px'>";
                                                echo  "<a href=http://shop.test/showproduct.php?p_id=" . $p_id . ">";
                                                echo   "<img  width='100px' height='100px' src=./Uploaded_images/" . $row2["p_featured_photo"] . ">";
                                                echo "</a>";
                                                echo "<div style='width:200px'>";
                                                echo "<span style='font-size:16px;padding:10px'>" . $row2["p_name"]  . "</span>";
                                                echo "</div>";
                                                echo  "</div>";
                                                echo "</div>";
                                            }
                                        }
                                    } else {
                                    ?>
                                        <div>
                                            <br>
                                            <br>
                                            <img src="./images/empty-cart.svg" alt="empty cart image  svg ">
                                            <span style="font-size:17px;"> There is not any Recent product !
                                            </span>
                                        </div>
                                    <?php   } ?>



                                </div>

                            </div>
                        </div>



                    <?php
                } else if (isset($_GET["profile/favorite"])) {

                    ?>
                    
                        <div class="col-md-9  details   columnmargintop">

                            <div class="p-3 border bg-white" style="border-radius: 10px ">
                                <div class="row">

                                    <span style="font-size: 30px;padding:5px;color:#ef4056;border-bottom:solid #ef4056 3px;margin-left:10px;float:left">Favorite Products</span>
                                </div>
                                <div class="fav  row" id="favorite">
                                    <br>
                                    <br>
                                    <?php

                                    $query = $mysqli->query("SELECT * FROM  favorite   WHERE user_id='$_SESSION[USER_ID]' ");
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            $p_id = $row["p_id"];

                                            $query2 = $mysqli->query("SELECT * FROM tbl_product WHERE p_id='$p_id' ");
                                            while ($row2 = mysqli_fetch_assoc($query2)) {
                                                echo "<div class='flex-auto flex flex-col flex-wrap  ml-5''>";
                                                echo "<div style='padding:20px'>";
                                                echo  "<a href=http://shop.test/showproduct.php?p_id=" . $p_id . ">";
                                                echo   "<img  width='100px' height='100px' src=./Uploaded_images/" . $row2["p_featured_photo"] . ">";
                                                echo "</a>";
                                                echo "<div style='width:200px'>";
                                                echo "<span style='font-size:16px;padding:10px'>" . $row2["p_name"]  . "</span>";
                                                echo "</div>";
                                                echo  "</div>";
                                                echo "</div>";
                                            }
                                        }
                                    } else {
                                    ?>
                                        <div>
                                            <br>
                                            <br>
                                            <img src="./images/favorites-list-empty.svg" alt="empty cart image  svg ">
                                            <span style="font-size:17px;"> There is not any Favorite product !
                                            </span>
                                        </div>
                                    <?php   } ?>



                                </div>

                            </div>
                        </div>









                    <?php    } else if (isset($_GET["profile/orders"])) {
                    ?>
                        <div class="col-md-9  details   columnmargintop">

                            <div class="p-3 border bg-white" style="border-radius: 10px ">
                                <div class="row">
                                    <span style="font-size: 30px;padding:5px;color:#ef4056;border-bottom:solid #ef4056 3px;margin-left:10px;float:left">Orders</span>
                                </div>
                                <div class="fav  row" id="orders">

                                    <div class="order_place">
                                        <br>
                                        <div class="button1 btn23">Recent Orders</div>
                                        <div class="button2 btn23">Completed Orders</button>
                                        </div>
                                        <div class="div1 " style="display:block">
                                            <?php
                                            $query = $mysqli->query("SELECT * FROM orders WHERE user_id='$_SESSION[USER_ID]' AND status='Pending' ");
                                            if (mysqli_num_rows($query) > 0) {
                                                while ($row = mysqli_fetch_assoc($query)) {
                                                    $order_id = $row["order_id"];
                                                    $query2 = $mysqli->query("SELECT * FROM order_product WHERE order_id ='$order_id'");
                                                    while ($row2 = mysqli_fetch_assoc($query2)) {
                                                        $p_id = $row2['p_id'];
                                                        $query3 = $mysqli->query("SELECT * FROM tbl_product WHERE p_id='$p_id'");
                                                        echo "<div class='row'>";
                                                        while ($row3 = mysqli_fetch_assoc($query3)) {
                                                            echo "<div class='col-3''>";
                                                            echo "<div style='padding:20px'>";
                                                            echo  "<a href=http://shop.test/showproduct.php?p_id=" . $p_id . ">";
                                                            echo   "<img  width='100px' height='100px' src=./Uploaded_images/" . $row3["p_featured_photo"] . ">";
                                                            echo "</a>";
                                                            echo "<div style='width:200px'>";
                                                            echo "<span style='font-size:16px;padding:10px'>" . $row3["p_name"]  . "</span>";
                                                            echo "</div>";
                                                            echo  "</div>";
                                                            echo "</div>";
                                                        }
                                                    }
                                                }
                                            } else {
                                            ?>
                                             <div>
                                            <br>
                                            <br>
                                            <img src="./images/order-empty.svg" alt="empty cart image  svg ">
                                            <span style="font-size:17px;"> There is not any current  Order !
                                            </span>
                                        </div>
                                            <?php } ?>
                                            
                                        </div>
                                    </div>
                                    </div>
                                    <div class="div2" style="display:none">
                                    <?php
                                            $query = $mysqli->query("SELECT * FROM orders WHERE user_id='$_SESSION[USER_ID]' AND status='Completed' ");
                                            if (mysqli_num_rows($query) > 0) {
                                                while ($row = mysqli_fetch_assoc($query)) {
                                                    $order_id = $row["order_id"];
                                                    $query2 = $mysqli->query("SELECT * FROM order_product WHERE order_id ='$order_id'");
                                                    while ($row2 = mysqli_fetch_assoc($query2)) {
                                                        $p_id = $row2['p_id'];
                                                        $query3 = $mysqli->query("SELECT * FROM tbl_product WHERE p_id='$p_id'");
                                                        echo "<div class='row'>";
                                                        while ($row3 = mysqli_fetch_assoc($query3)) {
                                                            echo "<div class='col-3''>";
                                                            echo "<div style='padding:20px'>";
                                                            echo  "<a href=http://shop.test/showproduct.php?p_id=" . $p_id . ">";
                                                            echo   "<img  width='100px' height='100px' src=./Uploaded_images/" . $row3["p_featured_photo"] . ">";
                                                            echo "</a>";
                                                            echo "<div style='width:200px'>";
                                                            echo "<span style='font-size:16px;padding:10px'>" . $row3["p_name"]  . "</span>";
                                                            echo "</div>";
                                                            echo  "</div>";
                                                            echo "</div>";
                                                        }
                                                    }
                                                }
                                            } else {
                                                ?>
 <div>
                                            <br>
                                            <br>
                                            <img src="./images/order-empty.svg" alt="empty cart image  svg ">
                                            <span style="font-size:17px;"> There is not any Compeleted  Order !
                                            </span>
                                        </div>

                                            <?php 
                                            }
                                            ?>

                                
                                </div>
                            </div>




                        <?php   } ?>







                        </div>
                        </div>
                    </div>







                    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
                    <script src="./bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
                    <script>
                        $("#update").click(function(e) {
                            $("#editnamemodal").modal("hide")

                            var name = $("#editname input").val();

                            $.ajax({
                                type: "post",
                                url: "updateuser-name.php",
                                data: {
                                    name: name
                                },

                                success: function(response) {
                                    var res = jQuery.parseJSON(response);
                                    if (res.status == 422) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                    } else if (res.status == 200) {
                                        $('#reload').load(location.href + " #reload");
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)

                                    } else if (res.status == 423) {
                                        $('#reload').load(location.href + " #reload");
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                    }
                                }
                            });

                        })


                        // Get the input field
                        var input = $("#editname input");
                        // Execute a function when the user presses a key on the keyboard
                        input.keypress(function(event) {
                            // If the user presses the "Enter" key on the keyboard
                            if (event.key === "Enter") {
                                // Cancel the default action, if needed
                                event.preventDefault();
                                // Trigger the button element with a click
                                $("#update").click();
                            }
                        })


                        $("#addnumberbtn").click(function(e) {
                            $("#addnumber").modal("hide")

                            var number = $("#addnumberform input").val();
                            $("#addnumberform input").val("");

                            $.ajax({
                                type: "post",
                                url: "addnumber.php",
                                data: {
                                    number: number
                                },

                                success: function(response) {

                                    var res = jQuery.parseJSON(response);
                                    if (res.status == 422) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)


                                    } else if (res.status == 200) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");
                                    } else if (res.status == 401) {
                                        console.log(res.message);
                                    } else if (res.status == 423) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)

                                    }

                                }
                            });

                        })
                        // Get the input field
                        var input = $("#addnumberform input");
                        // Execute a function when the user presses a key on the keyboard
                        input.keypress(function(event) {
                            // If the user presses the "Enter" key on the keyboard
                            if (event.key === "Enter") {
                                // Cancel the default action, if needed
                                event.preventDefault();
                                // Trigger the button element with a click
                                $("#addnumberbtn").click();
                            }
                        })

                        $("#editnumberbtn").click(function(e) {
                            $("#editnumbermodal").modal("hide")


                            var newnumber = $("#editnumberform input").val();

                            $.ajax({
                                type: "post",
                                url: "editnumber.php",
                                data: {
                                    number: newnumber
                                },
                                success: function(response) {
                                    var res = jQuery.parseJSON(response);
                                    if (res.status == 422) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)

                                    } else if (res.status == 200) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)

                                        $('#reload').load(location.href + " #reload");
                                    } else if (res.status == 423) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)

                                    }
                                }
                            });

                        })


                        // Get the input field
                        var input = $("#editnumberform input");
                        // Execute a function when the user presses a key on the keyboard
                        input.keypress(function(event) {
                            // If the user presses the "Enter" key on the keyboard
                            if (event.key === "Enter") {
                                // Cancel the default action, if needed
                                event.preventDefault();
                                // Trigger the button element with a click
                                $("#editnumberbtn").click();
                            }
                        })

                        $("#editpasswordbtn").click(function(e) {
                            $("#editpassword").modal("hide")

                            var prevpass = $("#previousepass").val();
                            var newpass = $("#newpass").val();
                            var confirmpass = $("#confirmpass").val()
                            console.log(prevpass);
                            console.log(newpass);
                            console.log(confirmpass);

                            $.ajax({
                                type: "post",
                                url: "editpassword.php",
                                data: {
                                    previouspass: prevpass,
                                    newpass: newpass,
                                    confirmpass: confirmpass
                                },
                                success: function(response) {
                                    var res = jQuery.parseJSON(response);
                                    if (res.status == 421) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)

                                    } else if (res.status == 200) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");
                                    } else if (res.status == 420) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");
                                    } else if (res.status == 422) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");
                                    }
                                }
                            });

                        })

                        // Get the input field
                        var input = $("#confirmpass");
                        // Execute a function when the user presses a key on the keyboard
                        input.keypress(function(event) {
                            // If the user presses the "Enter" key on the keyboard
                            if (event.key === "Enter") {
                                // Cancel the default action, if needed
                                event.preventDefault();
                                // Trigger the button element with a click
                                $("#editpasswordbtn").click();
                            }
                        })
                        $("#addcodebtn").click(function(e) {
                            $("#addcode").modal("hide")

                            var code = $("#addcodeform input ").val();
                            $.ajax({
                                type: "post",
                                url: "addidentifycode.php",
                                data: {
                                    code: code,
                                },
                                success: function(response) {
                                    var res = jQuery.parseJSON(response);
                                    if (res.status == 421) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                    } else if (res.status == 200) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");
                                    } else if (res.status == 420) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");
                                    } else if (res.status == 422) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");
                                    } else if (res.status == 423) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)

                                    }
                                }
                            });

                        })


                        // Get the input field
                        var input = $("#addcodeform input");
                        // Execute a function when the user presses a key on the keyboard
                        input.keypress(function(event) {
                            // If the user presses the "Enter" key on the keyboard
                            if (event.key === "Enter") {
                                // Cancel the default action, if needed
                                event.preventDefault();
                                // Trigger the button element with a click
                                $("#addcodebtn").click();
                            }
                        })




                        $("#editcodebtn").click(function(e) {
                            $("#editcode").modal("hide")
                            var newcode = $("#editcodeform input ").val();

                            $.ajax({
                                type: "post",
                                url: "editcode.php",
                                data: {
                                    newcode: newcode,
                                },
                                success: function(response) {
                                    var res = jQuery.parseJSON(response);
                                    if (res.status == 422) {

                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)

                                    } else if (res.status == 200) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");
                                    } else if (res.status == 420) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");
                                    } else if (res.status == 423) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)

                                    }
                                }
                            });

                        })


                        // Get the input field
                        var input = $("#editcodeform input");
                        // Execute a function when the user presses a key on the keyboard
                        input.keypress(function(event) {
                            // If the user presses the "Enter" key on the keyboard
                            if (event.key === "Enter") {
                                // Cancel the default action, if needed
                                event.preventDefault();
                                // Trigger the button element with a click
                                $("#editcodebtn").click();
                            }
                        })




                        $("#addbirthdaybtn").click(function(e) {
                            $("#addbirthday").modal("hide")

                            var Bdate = $("#addbithdayform input").val();
                            console.log(Bdate);
                            $.ajax({
                                type: "post",
                                url: "addbirthdate.php",
                                data: {
                                    date: Bdate,
                                },
                                success: function(response) {
                                    var res = jQuery.parseJSON(response);
                                    if (res.status == 422) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                    } else if (res.status == 200) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");
                                    } else if (res.status == 420) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");
                                    } else if (res.status == 423) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                    }
                                }
                            });

                        })



                        // Get the input field
                        var input = $("#addbithdayform input");
                        // Execute a function when the user presses a key on the keyboard
                        input.keypress(function(event) {
                            // If the user presses the "Enter" key on the keyboard
                            if (event.key === "Enter") {
                                // Cancel the default action, if needed
                                event.preventDefault();
                                // Trigger the button element with a click
                                $("#addbirthdaybtn").click();
                            }
                        })

                        $("#editbirthdaybtn").click(function(e) {
                            $("#editbirthday").modal("hide")
                            var Bdate = $("#editbirthdayform input").val();
                            $.ajax({
                                type: "post",
                                url: "editbirthday.php",
                                data: {
                                    date: Bdate,
                                },
                                success: function(response) {
                                    var res = jQuery.parseJSON(response);
                                    if (res.status == 422) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                    } else if (res.status == 200) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");
                                    } else if (res.status == 420) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");
                                    } else if (res.status == 423) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                    }
                                }
                            });

                        })



                        // Get the input field
                        var input = $("#editbirthdayform input");
                        // Execute a function when the user presses a key on the keyboard
                        input.keypress(function(event) {
                            // If the user presses the "Enter" key on the keyboard
                            if (event.key === "Enter") {
                                // Cancel the default action, if needed
                                event.preventDefault();
                                // Trigger the button element with a click
                                $("#editbirthdaybtn").click();
                            }
                        })

                        var editemail = false;
                        $("#editemailbtn").click(function(e) {
                            editemail = true;
                            $("#editemail").modal("hide")
                            var emial = $("#editemailform input").val();

                            $.ajax({
                                type: "post",
                                url: "editemail.php",
                                data: {
                                    email: emial,
                                },
                                success: function(response) {
                                    var res = jQuery.parseJSON(response);
                                    if (res.status == 450) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");

                                    } else if (res.status == 200) {

                                        var timeleft = 30;
                                        var downloadTimer = setInterval(function() {
                                            timeleft--;
                                            document.getElementById("timer").textContent = timeleft;
                                            if (timeleft <= 0) {
                                                $.ajax({
                                                    type: "post",
                                                    url: "unsetsession.php",
                                                    data: {},
                                                    success: function(response) {
                                                        var res = jQuery.parseJSON(response);
                                                        if (res.status == 200) {
                                                            return;
                                                        }
                                                    }
                                                });
                                                clearInterval(downloadTimer);
                                                $('#reload').load(location.href + " #reload");
                                            }

                                        }, 1000);

                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");
                                        $("#verifyemail").modal("show")

                                    } else if (res.status == 424) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");

                                        $('#reload').load(location.href + " #reload");
                                    } else if (res.status == 425) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");
                                    } else if (res.status == 600) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => $(".message").fadeOut(), 5000)
                                        $('#reload').load(location.href + " #reload");
                                    }
                                },
                                complete: function() {

                                }

                            });

                        })


                        // Get the input field
                        var input = $("#editemailform input");
                        // Execute a function when the user presses a key on the keyboard
                        input.keypress(function(event) {
                            // If the user presses the "Enter" key on the keyboard
                            if (event.key === "Enter") {
                                // Cancel the default action, if needed
                                event.preventDefault();
                                // Trigger the button element with a click
                                $("#editemailbtn").click();
                            }
                        })


                        $("#verifyemailbtn").click(function(e) {
                            var hezargan = $("#1000gan").val();
                            var sadgan = $("#100gan ").val();
                            var dahgan = $("#10gan").val();
                            var yekan = $("#yekan").val();

                            if (hezargan != "" && sadgan != "" && dahgan != "" && yekan != "") {

                                $.ajax({
                                    type: "post",
                                    url: "verifyeditedemail.php",
                                    data: {
                                        hezargan: hezargan,
                                        sadgan: sadgan,
                                        dahgan: dahgan,
                                        yekan: yekan
                                    },

                                    success: function(response) {

                                        var res = jQuery.parseJSON(response);
                                        if (res.status == 260) {
                                            $(".message").css("display", "block");
                                            $(".message").html(res.message);
                                            setInterval(() => $(".message").fadeOut(), 5000)
                                        } else if (res.status == 200) {
                                            timeleft = 0;
                                            $(".message").css("display", "block");
                                            $(".message").html(res.message);
                                            setInterval(() => {
                                                $(".message").fadeOut()
                                            }, 5000)
                                            $('#reload').load(location.href + " #reload");

                                        } else if (res.status == 245) {
                                            $(".message").css("display", "block");
                                            $(".message").html(res.message);
                                            setInterval(() => $(".message").fadeOut(), 5000)
                                            $('#reload').load(location.href + " #reload");
                                        } else if (res.status == 420) {
                                            $(".message").css("display", "block");
                                            $(".message").html(res.message);
                                            setInterval(() => $(".message").fadeOut(), 5000)
                                        } else if (res.status == 505) {
                                            $(".message").css("display", "block");
                                            $(".message").html(res.message);
                                            setInterval(() => $(".message").fadeOut(), 5000)
                                        } else if (res.status == 344) {
                                            $(".message").css("display", "block");
                                            $(".message").html(res.message);
                                            setInterval(() => $(".message").fadeOut(), 5000)
                                        } else if (res.status == 333) {
                                            $(".message").css("display", "block");
                                            $(".message").html(res.message);
                                            setInterval(() => $(".message").fadeOut(), 5000)
                                        }
                                    }
                                });
                            } else {
                                $(".message").css("display", "block");
                                $(".message").html("verify code fields should not be empty ");
                                setInterval(() => $(".message").fadeOut(), 5000)
                            }
                        })
                    </script>


                    <script>
                        $(document).ready(function() {
                            var date_input = $('input[name="date"]'); //our date input has the name "date"
                            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
                            date_input.datepicker({
                                format: 'mm/dd/yyyy',
                                container: container,
                                todayHighlight: true,
                                autoclose: true,
                            })
                        })


                        const codes = document.querySelectorAll(".code")
                        codes[0].focus()
                        codes.forEach((code, idx) => {
                            code.addEventListener("keydown", (e) => {
                                if (e.key >= 0 && e.key <= 9) {
                                    codes[idx].value = "";
                                    setTimeout(() => codes[idx + 1].focus(), 10)

                                } else if (e.key === 'Backspace') {
                                    setTimeout(() => codes[idx - 1].focus(), 10)
                                }
                            })
                        })


                        $(document).ajaxStart(function() {
                            // Show image container
                            if (editemail) {
                                $(".loader").css("display", "block");
                                $(".loader").css("visibility", "visible");
                            }
                            editemail = false

                        });
                        $(document).ajaxComplete(function() {
                            $(".loader").css("display", "none");
                            $(".loader").css("visibility", "hidden");
                        });


                        var emialvalidation = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-][a-zA-Z0-9-]+$/;
                        $("#editemailform input").keyup(function() {

                            var input = $("#editemailform input").val();

                            if (input.match(emialvalidation)) {
                                $("#error-email-format").html('<img src="./icons/icons8-checkmark-48.png" alt="cheak icon" width="20" height="20">');
                            } else {
                                $("#error-email-format").html("email format is not correct !");
                            }

                        })
                    </script>
                    <script>

                    </script>
                    <script>
                        $("#addaddressbtn").click(function() {
                            var addresline1 = $(".ad_l1").val().trim();
                            var addresline2 = $(".ad_l2").val().trim();
                            var user_id = <?php echo  $_SESSION["id"]; ?>

                            if (addresline1 != "" && addresline2 != "") {
                                $.ajax({
                                    type: "post",
                                    url: "addaddress.php?addaddress=true",
                                    data: {
                                        addresline1: addresline1,
                                        addresline2: addresline2,
                                        user_id: user_id
                                    },
                                    success: function(response) {
                                        var res = jQuery.parseJSON(response);
                                        if (res.status == 200) {
                                            $('#addaddress').modal('hide');
                                            $("#addreses").load(" #addreses > *");
                                            $('body').removeClass('modal-open');
                                            $('.modal-backdrop').remove();
                                            $(".message").css("display", "block");
                                            $(".message").html(res.message);
                                            setInterval(() => {
                                                $(".message").fadeOut()
                                            }, 5000)





                                        } else if (res.status == 400) {
                                            $('#addaddress').modal('hide');
                                            $('body').removeClass('modal-open');
                                            $('.modal-backdrop').remove();
                                            $(".message").css("display", "block");
                                            $(".message").html(res.message);
                                            setInterval(() => {
                                                $(".message").fadeOut()
                                            }, 5000)

                                        }
                                    }

                                });

                            } else {
                                if (addresline1 == "") {
                                    $(".error_ad_1").html(" this field required !")
                                } else {
                                    $(".error_ad_1").html("")
                                }
                                if (addresline2 == "") {
                                    $(".error_ad_2").html(" this field required !")
                                } else {
                                    $(".error_ad_2").html("")

                                }
                            }
                        })

                        $('#addreses').on('click', '.delete_address', function() {
                            var ad_id = $(this).parent().find("input").val();
                            $.ajax({
                                type: "post",
                                url: "delete_address.php?daddress=true",
                                data: {
                                    ad_id: ad_id
                                },
                                success: function(response) {
                                    var res = jQuery.parseJSON(response);
                                    if (res.status == 200) {
                                        $("#addreses").load(" #addreses > *");
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => {
                                            $(".message").fadeOut()
                                        }, 5000)

                                    } else if (res.status == 400) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => {
                                            $(".message").fadeOut()
                                        }, 5000)

                                    }
                                }
                            });

                        })
                    </script>


                    <script>
                        $('#comments').on('click', '.delete_comment', function() {
                            var comment_id = $(this).parent().find("input").val();
                            console.log(comment_id);
                            $.ajax({
                                type: "post",
                                url: "delete_comment.php?delete_comment=true",
                                data: {
                                    comment_id: comment_id
                                },
                                success: function(response) {
                                    var res = jQuery.parseJSON(response);
                                    if (res.status == 200) {
                                        $("#comments").load(" #comments > *");
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => {
                                            $(".message").fadeOut()
                                        }, 5000)

                                    } else if (res.status == 400) {
                                        $(".message").css("display", "block");
                                        $(".message").html(res.message);
                                        setInterval(() => {
                                            $(".message").fadeOut()
                                        }, 5000)

                                    }
                                }
                            });




                        })
                    </script>
                    <script>
                        var button1 = $(".button1");
                        var button2 = $(".button2");
                        var div1 = document.querySelector('.div1');
                        var div2 = document.querySelector('.div2');

                        button1.click(function() {
                            button1.css("border-bottom", "solid #EF4056 4px");
                            button2.css("border-bottom", "solid white 4px");
                            div1.style.display = 'block';
                            div2.style.display = 'none';
                        })

                        button2.click(function() {
                            button2.css("border-bottom", "solid #EF4056 4px");
                            button1.css("border-bottom", "solid white 4px");
                            div2.style.display = 'block';
                            div1.style.display = 'none';
                        })
                    </script>

    </body>

    </html>
<?php
} else {
    header("location:index.php?user_status=notlogedin");
}
?>