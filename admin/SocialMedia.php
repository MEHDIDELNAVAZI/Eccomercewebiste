<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$Db_name  = "EcommerceWebsite";
$mysqli = new mysqli;
$conn = $mysqli->connect($servername, $username, $password, $Db_name);

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Social Media </title>
    <style>
        table {
            width: 100%;
            height: 40px;
            font-size: 16px;
            text-align: center;
        }

        table button {
            margin-left: 10px;
        }

        table td,
        th {
            border: solid #DFDEE0 1px;
            padding: 5px;
            border: solid #808080 1px;

        }

        table th {
            background-color: #FFFFFF;
        }

        input[type='submit'] {
            background-color: blue;
            color: white;
        }

        #s_m input {
            display: block;
            width: 80%;
            border-radius: 5px;
            padding: 10px;
            margin-top: 20px;


        }

        #add_s_m input {
            display: block;
            width: 80%;
            border-radius: 5px;
            padding: 10px;
            margin-top: 20px;
        }

        .action {
            text-align: center;
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

        .search {
            margin-bottom: 20px;
            padding: 10px;
            float: right;
        }

        .search form input {
            border-radius: 5px;
            width: 300px;
            padding: 5px;
        }

        .pagination button {
            display: inline-block;
        }
        td{
        background-color:#E0E0E0;
        }
    </style>
</head>

<body>

    <!-- Modal for  eidt Social media   -->

    <div class="modal fade" id="s_m" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog   modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Social media </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="s_m_form" method="post">
                        <input name="s_n" type="text" id="s_n" placeholder=" social media name ">
                        <input name="s_url" type="text" id="s_url" placeholder="socila media URL">
                        <input hidden name="s_id" type="text" id="s_id">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="eidtsocial_media" data-dismiss="modal"> Edit </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal for  eidt Social media   -->



    <!-- Modal for  delete btn  -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete social media</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="color:black">Are you sure you want to delete this social media ?!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="delete_social_media" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for  delete btn  -->




    <!-- Modal for  add Social media   -->

    <div class="modal fade" id="add_s_m" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog   modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Social media </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="addform" method="post">

                        <input name="s_n" type="text" id="add_n" placeholder=" social media name ">
                        <input name="s_url" type="text" id="add_url" placeholder="socila media URL">
                        <input name="s_url" type="text" id="icon" placeholder="  Like  fa fa-facebook-square">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addsocilamedia" data-dismiss="modal"> Add </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal for add Social media   -->




    <div class="search">
        <form method="post">
            <input name="search" type="text" placeholder="Search for Social medias">
            <button type="button" class="btn btn-secondary  searchbtn">Search</button>
        </form>
    </div>
    <div class="shownumber">

    </div>

    <div class="container">
        <button class="btn btn-primary  all">All</button>
        <button type='button' class='btn btn-primary ' data-toggle='modal' data-target='#add_s_m'>
            <i class='bx bx-message-square-add'></i> </button>


        <table>
            <tr>
                <th>ID </th>
                <th>Social Name </th>
                <th>Social URL</th>
                <th>Actions </th>
            </tr>

            <?php
            if (isset($_POST["all"])) {
                $q  = $mysqli->query("SELECT * FROM  tbl_social ");
                $counter  = 1;
                if (mysqli_num_rows($q) ==  0) {
                    echo "<td>";
                    echo "There is not any fild !";
                    echo "</td>";
                    echo "<td>";
                    echo "____";
                    echo "</td>";
                    echo "<td>";
                    echo "____";
                    echo "</td>";
                    echo "<td>";
                    echo "____";
                    echo "</td>";
                } else {
                    while ($row = mysqli_fetch_assoc($q)) {
                        echo   "<tr>";
                        echo "<td>";
                        echo $counter;
                        echo "</td>";
                        echo "<td>";
                        echo  ' <i class=" ' . $row["social_icon"] . ' mr-3"></i>';
                        echo $row["social_name"];
                        echo "</td>";
                        echo "<td>";
                        echo "<a href="  . $row["social_url"] . ">";
                        echo $row["social_url"];
                        echo "</a>";
                        echo "</td>";
                        echo "<td class='action'>";
                        echo "<form method='post' id='editsocial'>";
                        echo  "<input  hidden  type='text'  name ='social_id' value=" . $row["social_id"] . ">";
                        echo  "<input hidden  type='text'  name ='social_name' value=" . $row["social_name"] . ">";
                        echo  "<input  hidden  type='text'  name ='social_url' value=" . $row["social_url"] . ">";

                        echo  "    <button  type='button' class='btn btn-primary ' data-toggle='modal' data-target='#s_m'>";
                        echo  "<i class='bx bxs-edit-alt' style='font-size: 16px;' ></i>   </button>";
                        echo  "<button type='button' class='btn btn-danger  d' data-toggle='modal' data-target='#deletemodal'>
            <i class='bx bx-message-square-minus'></i>
            </button>";

                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";

                        $counter++;
                    }
                }
            }
            if ($_POST["pagination"]) {

                $test  =  $_POST["paginationtbn"];

                if ($_POST["hasclassnext"] == "true") {
                    $start = $_SESSION["currentstart"] + 5;
                    $_SESSION["currentstart"] = $_SESSION["currentstart"] + 5;
                } else if ($_POST["hasclassprev"] == "true") {
                    $start = $_SESSION["currentstart"] - 5;
                    $_SESSION["currentstart"] = $_SESSION["currentstart"] - 5;
                } else {
                    if ($test == "1") {
                        $start = 0;
                        $_SESSION["currentstart"] = 0;
                    } else {
                        $start = ($test - 1) * 5;
                        $_SESSION["currentstart"] = $start;
                    }
                }

                $querypageination  = $mysqli->query("SELECT * FROM  tbl_social  LIMIT $start,5 ");
                $counter  = $start + 1;
                if (mysqli_num_rows($querypageination) ==  0) {
                    echo "<td>";
                    echo "There is not any fild !";
                    echo "</td>";
                    echo "<td>";
                    echo "____";
                    echo "</td>";
                    echo "<td>";
                    echo "____";
                    echo "</td>";
                    echo "<td>";
                    echo "____";
                    echo "</td>";
                } else {
                    while ($row = mysqli_fetch_assoc($querypageination)) {
                        echo   "<tr>";
                        echo "<td>";
                        echo $counter;
                        echo "</td>";
                        echo "<td>";
                        echo  ' <i class=" ' . $row["social_icon"] . ' mr-3"></i>';
                        echo $row["social_name"];
                        echo "</td>";
                        echo "<td>";
                        echo "<a href="  . $row["social_url"] . ">";
                        echo $row["social_url"];
                        echo "</a>";
                        echo "</td>";
                        echo "<td class='action'>";
                        echo "<form method='post' id='editsocial'>";
                        echo  "<input  hidden  type='text'  name ='social_id' value=" . $row["social_id"] . ">";
                        echo  "<input hidden  type='text'  name ='social_name' value=" . $row["social_name"] . ">";
                        echo  "<input  hidden  type='text'  name ='social_url' value=" . $row["social_url"] . ">";

                        echo  "    <button  type='button' class='btn btn-primary ' data-toggle='modal' data-target='#s_m'>";
                        echo  "<i class='bx bxs-edit-alt' style='font-size: 16px;' ></i>   </button>";
                        echo  "<button type='button' class='btn btn-danger  d' data-toggle='modal' data-target='#deletemodal'>
            <i class='bx bx-message-square-minus'></i>
            </button>";

                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";

                        $counter++;
                    }
                }
            }


            if (isset($_POST["searchstr"])) {

                $str  = $_POST["searchstr"];

                $query1  = $mysqli->query("SELECT * FROM  tbl_social WHERE  social_name LIKE '$str%'  limit 5");
                $counter  =  1;
                if (mysqli_num_rows($query1) ==  0) {

                    echo "<td>";
                    echo "There is not any fild that you searched !";
                    echo "</td>";
                    echo "<td>";
                    echo "____";
                    echo "</td>";
                    echo "<td>";
                    echo "____";
                    echo "</td>";
                    echo "<td>";
                    echo "____";
                    echo "</td>";
                } else {
                    while ($row = mysqli_fetch_assoc($query1)) {
                        echo   "<tr>";
                        echo "<td>";
                        echo $counter;
                        echo "</td>";
                        echo "<td>";
                        echo  ' <i class=" ' . $row["social_icon"] . ' mr-3"></i>';
                        echo $row["social_name"];
                        echo "</td>";
                        echo "<td>";
                        echo "<a href="  . $row["social_url"] . ">";
                        echo $row["social_url"];
                        echo "</a>";
                        echo "</td>";
                        echo "<td class='action'>";
                        echo "<form method='post' id='editsocial'>";
                        echo  "<input  hidden  type='text'  name ='social_id' value=" . $row["social_id"] . ">";
                        echo  "<input hidden  type='text'  name ='social_name' value=" . $row["social_name"] . ">";
                        echo  "<input  hidden  type='text'  name ='social_url' value=" . $row["social_url"] . ">";

                        echo  "    <button  type='button' class='btn btn-primary ' data-toggle='modal' data-target='#s_m'>";
                        echo  "<i class='bx bxs-edit-alt' style='font-size: 16px;' ></i>   </button>";
                        echo  "<button type='button' class='btn btn-danger  d' data-toggle='modal' data-target='#deletemodal'>
            <i class='bx bx-message-square-minus'></i>
            </button>";

                        echo "</form>";
                        echo "</td>";


                        echo "</tr>";

                        $counter++;
                    }
                }
            } else {

                if ($_POST["pagination"] != "true"  && !isset($_POST["all"])) {
                    $query  = $mysqli->query("SELECT * FROM  tbl_social limit 5");
                    if (mysqli_num_rows($query) ==  0) {

                        echo "<td>";
                        echo "There is not any fild !";
                        echo "</td>";
                        echo "<td>";
                        echo "____";
                        echo "</td>";
                        echo "<td>";
                        echo "____";
                        echo "</td>";
                        echo "<td>";
                        echo "____";
                        echo "</td>";
                    } else {
                        $counter  =  1;
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo   "<tr>";
                            echo "<td>";
                            echo $counter;
                            echo "</td>";
                            echo "<td>";
                            echo  ' <i class=" ' . $row["social_icon"] . ' mr-3"></i>';
                            echo $row["social_name"];
                            echo "</td>";
                            echo "<td>";
                            echo "<a href="  . $row["social_url"] . ">";
                            echo $row["social_url"];
                            echo "</a>";
                            echo "</td>";
                            echo "<td class='action'>";
                            echo "<form method='post' id='editsocial'>";
                            echo  "<input  hidden  type='text'  name ='social_id' value=" . $row["social_id"] . ">";
                            echo  "<input  hidden type='text'  name ='social_name' value=" . $row["social_name"] . ">";
                            echo  "<input  hidden  type='text'  name ='social_url' value=" . $row["social_url"] . ">";

                            echo  "    <button  type='button' class='btn btn-primary ' data-toggle='modal' data-target='#s_m'>";
                            echo  "<i class='bx bxs-edit-alt' style='font-size: 16px;' ></i>   </button>";
                            echo  "<button type='button' class='btn btn-danger  d' data-toggle='modal' data-target='#deletemodal'>
                <i class='bx bx-message-square-minus'></i>
                </button>";

                            echo "</form>";
                            echo "</td>";


                            echo "</tr>";

                            $counter++;
                        }
                    }
                }
            }



            ?>





        </table>


        <div class="pagination  mt-4 ">
            <?php
            $query2  = $mysqli->query("SELECT * FROM  tbl_social ");
            $numberof_data  = mysqli_num_rows($query2);
            $paginationnum = ceil($numberof_data / 5);
            // prev btn 
            if ($paginationnum > 1) {
                for ($i = 1; $i <= $paginationnum; $i++) {
                    echo "<button class='btn btn-primary ml-2'>  " . $i;
                    echo "</button>";
                }
                //next btn 
            } else {
            }
            ?>
        </div>

    </div>









    <script>
        $("#editsocial button").click(function() {
            var s = $(this).parent().find("input");
            var Socialmedia_id = s[0].value;
            var Socialmedia_name = s[1].value;
            var Socialmedia_url = s[2].value;
            $("#s_n").val(Socialmedia_name);
            $("#s_url").val(Socialmedia_url);
            $("#s_id").val(Socialmedia_id);
            console.log(Socialmedia_id)
            console.log(Socialmedia_id)
            console.log(Socialmedia_id)
        })


        $("#eidtsocial_media").click(function() {
            var s2 = $(this).parent().parent().find("input");
            var Socialmedia_name = s2[0].value;
            var Socialmedia_url = s2[1].value;
            var Socialmedia_id = s2[2].value;
            $.ajax({
                type: "post",
                url: "editsocial.php?edit=ture",
                data: {
                    S_name: Socialmedia_name,
                    S_url: Socialmedia_url,
                    S_id: Socialmedia_id
                },

                success: function(response) {
                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $(".message").css("display", "block");
                        $(".message").html(res.message);
                        $('#reload').load(location.href + " #reload");
                        setInterval(() => $(".message").fadeOut(), 5000)
                        setTimeout(function() {
                            $.ajax({
                                type: "post",
                                url: "../fetchdata/fetchdata_adminpanel.php",
                                data: {
                                    panel: "SocialMedia"
                                },
                                success: function(d) {
                                    $(".main_pannel").html(d);
                                }
                            });
                        }, 200);

                    } else if (res.status == 400) {
                        $(".message").css("display", "block");
                        $(".message").html(res.message);
                        setInterval(() => $(".message").fadeOut(), 5000)
                    } else if (res.status == 201) {
                        $(".message").css("display", "block");
                        $(".message").html(res.message);
                        setInterval(() => $(".message").fadeOut(), 5000)
                    }
                }
            });
        })

        $(".d").click(function() {
            var s2 = $(this).parent().parent().find("input");
            var Socialmedia_id = s2[0].value;
            console.log(Socialmedia_id);

            $("#delete_social_media").click(function() {
                $('#reload').load(location.href + " #reload");

                setTimeout(function() {

                    $.ajax({
                        type: "post",
                        url: "editsocial.php?delete=true",
                        data: {
                            S_id: Socialmedia_id
                        },

                        success: function(response) {
                            var res = jQuery.parseJSON(response);

                            if (res.status == 200) {

                                $(".message").css("display", "block");
                                $(".message").html(res.message);
                                $('#reload').load(location.href + " #reload");
                                setInterval(() => $(".message").fadeOut(), 5000)

                                $.ajax({
                                    type: "post",
                                    url: "../fetchdata/fetchdata_adminpanel.php",
                                    data: {
                                        panel: "SocialMedia"
                                    },
                                    success: function(d) {
                                        $('#deletemodal').modal('hide');
                                        $(".main_pannel").html(d);
                                    }
                                });

                            } else if (res.status == 400) {
                                $(".message").css("display", "block");
                                $(".message").html(res.message);
                                setInterval(() => $(".message").fadeOut(), 5000)
                                $(".message").css("display", "block");
                                $(".message").html(res.message);
                                $('#reload').load(location.href + " #reload");
                                setInterval(() => $(".message").fadeOut(), 5000)

                                $.ajax({
                                    type: "post",
                                    url: "../fetchdata/fetchdata_adminpanel.php",
                                    data: {
                                        panel: "SocialMedia"
                                    },
                                    success: function(d) {
                                        $('#deletemodal').modal('hide');
                                        $(".main_pannel").html(d);
                                    }
                                });

                            }
                        }
                    });
                }, 200);

            })
        })

        $(".searchbtn").click(function() {
            var searchstring = $(".search form input").val();

            $.ajax({
                type: "post",
                url: "SocialMedia.php",
                data: {
                    searchstr: searchstring
                },
                success: function(d) {
                    $(".main_pannel").html(d);


                }
            })



        })

        $(".all").click(function() {
            $.ajax({
                type: "post",
                url: "SocialMedia.php",
                data: {
                    all: "all"
                },
                success: function(d) {
                    $(".main_pannel").html(d);
                }
            })

        })

        // pagination  javascript     
        var start = 1;
        var stop = 5;
        $(".pagination button").click(function() {
            var hasclassnext = $(this).hasClass("next");
            var hasclassprev = $(this).hasClass("prev");
            var paginationtbn = $(this).html();
            console.log(paginationtbn);
            $.ajax({
                type: "post",
                url: "SocialMedia.php",
                data: {
                    hasclassnext: hasclassnext,
                    hasclassprev: hasclassprev,
                    paginationtbn: paginationtbn,
                    pagination: "true"
                },
                success: function(d) {
                    $(".main_pannel").html(d);
                }
            })

        })


        $("#addsocilamedia").click(function() {
            
            var name = $("#add_n").val() ;
            var url = $("#add_url").val() ;
            var icon = $("#icon").val() ;

            console.log(name) ;
            if (name=="") {
                $(".message").css("display", "block");
                $(".message").html("name field should  not be empty !");
                setInterval(() => $(".message").fadeOut(), 5000)
            } else {

                $.ajax({
                type: "post",
                url: "editsocial.php?add=ture",
                data: {
                    name:name , 
                    url:url,
                    icon:icon
                },

                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        $(".message").css("display", "block");
                        $(".message").html(res.message);
                        $('#reload').load(location.href + " #reload");
                        setInterval(() => $(".message").fadeOut(), 5000)
                        setTimeout(function() {
                            $.ajax({
                                type: "post",
                                url: "../fetchdata/fetchdata_adminpanel.php",
                                data: {
                                    panel: "SocialMedia"
                                },
                                success: function(d) {
                                    $(".main_pannel").html(d);
                                }
                            });
                        }, 200);

                    } else if (res.status == 400) {
                        $(".message").css("display", "block");
                        $(".message").html(res.message);
                        setInterval(() => $(".message").fadeOut(), 5000)
                    }  else if (res.status == 201) {
                        $(".message").css("display", "block");
                        $(".message").html(res.message);
                        setInterval(() => $(".message").fadeOut(), 5000)
                    }
                }
            });
             
            }

        });

        var input = document.querySelector(".search input ");
        input.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.querySelector(".searchbtn").click();
            }
        });
    </script>
</body>

</html>