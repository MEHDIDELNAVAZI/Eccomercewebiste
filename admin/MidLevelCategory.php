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
            height: 33px;


        }

        #add_s_m input {
            display: block;
            width: 80%;
            border-radius: 5px;
            padding: 10px;
            margin-top: 20px;
            height: 33px;
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

        #addform select {
            width: 80%;
            padding: 10px;

        }

        #s_m_form select {
            padding: 5px;
            margin-top: 20px;
            font-size: 16px;
            width: 80%;

        }

        td {
            background-color: #E0E0E0;
        }
    </style>
</head>

<body>

    <!-- Modal for  edit mid category    -->

    <div class="modal fade" id="s_m" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog   modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Mid level category </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="s_m_form" method="post">
                        
                        <select name="tcat_name" id="tcat_name_selection">
                            <?php
                            $queryfor_midcat = $mysqli->query("SELECT * FROM tbl_top_category ");
                            while ($row = mysqli_fetch_assoc($queryfor_midcat)) {
                                echo "<option  value= '" . $row["tcat_id"] . "'>";
                                echo $row["tcat_name"];
                                echo "</option>";
                            }
                            ?>
                        </select>

                        <input type="text"  placeholder="Mid category name " id="editmdcatname">
                        <input  hidden  type="text" id="mcat_id_editpage">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="eidtsocial_media" data-dismiss="modal"> Edit </button>
                </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal for  edit mid category    -->



    <!-- Modal for  delete  top cat  -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete MidCategory </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="color:black">Are you sure you want to delete this Mid Category ?!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="delete_midcat" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for  delete  top cat  -->




    <!-- Modal for  add mid   category   -->

    <div class="modal fade" id="add_s_m" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog   modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Mid category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="addform" method="post">

                        <label for="Topcat">Top catgeoory name </label>
                        <select name="topcategory" id="addmidcat_topcat">
                            <?php
                            $query  = $mysqli->query("SELECT *  FROM  tbl_top_category ");
                            while ($row = mysqli_fetch_assoc($query)) {
                                echo "<option>";
                                echo $row["tcat_name"];
                                echo "</option>";
                            }
                            ?>
                        </select>

                        <label for="midcat">Mid category name :</label>
                        <input type="text" name="midcat" placeholder="Add name for the mid category ">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addsocilamedia" data-dismiss="modal"> Add </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for  add mid   category   -->

    <div class="search">
        <form method="post">
            <input name="search" type="text" placeholder="Search for Mid categories ">
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
                <th>#</th>
                <th>Mid category name </th>
                <th> Top category name ?</th>
                <th>Actions </th>
            </tr>

            <?php
            if (isset($_POST["all"])) {
                $q  = $mysqli->query("SELECT * FROM  tbl_mid_category ");
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
                        echo $row["mcat_name"];
                        echo "</td>";
                        echo "<td>";

                        $topctaegoryquery  = $mysqli->query("SELECT * FROM  tbl_top_category WHERE 
                         tcat_id = '$row[tcat_id]'");
                        while ($row2 = mysqli_fetch_assoc($topctaegoryquery)) {
                            $tcat_name = $row2["tcat_name"];
                            echo  $tcat_name;
                        };
                        echo "</td>";
                        echo "<td class='action'>";
                        echo "<form method='post' id='edittcat'>";
                        echo  '<input  hidden  type="text"  name ="mcat_id" value="' . $row["mcat_id"] . '">';
                        echo  '<input  hidden  type="text"  name ="mcat_name" value="' . $row["mcat_name"] . '">';
                        echo  '<input  hidden  type="text"  name ="tcat_id" value="' . $row["tcat_id"] . '">';
                        echo  '<input  hidden  type="text"  name ="tcat_name" value="' . $tcat_name . '">';

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

                $querypageination  = $mysqli->query("SELECT * FROM  tbl_mid_category  LIMIT $start,5 ");
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
                        echo $row["mcat_name"];
                        echo "</td>";
                        echo "<td>";
                        $topctaegoryquery  = $mysqli->query("SELECT * FROM  tbl_top_category WHERE 
                         tcat_id = '$row[tcat_id]'");
                        while ($row2 = mysqli_fetch_assoc($topctaegoryquery)) {
                            $tcat_name = $row2["tcat_name"];
                            echo  $tcat_name;
                        };
                        echo "</td>";
                        echo "<td class='action'>";
                        echo "<form method='post' id='edittcat'>";
                        echo  '<input hidden   type="text"  name ="mcat_id" value="' . $row["mcat_id"] . '">';
                        echo  '<input  hidden  type="text"  name ="mcat_name" value="' . $row["mcat_name"] . '">';
                        echo  '<input  hidden  type="text"  name ="tcat_id" value="' . $row["tcat_id"] . '">';
                        echo  '<input  hidden   type="text"  name ="tcat_name" value="' . $tcat_name . '">';

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

                $query1  = $mysqli->query("SELECT * FROM  tbl_mid_category WHERE  mcat_name  LIKE '$str%' ");
                $counter  =  1;
                if (mysqli_num_rows($query1) ==  0) {
                    echo "<td>";
                    echo "There is not any field that you searched !";
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
                        echo $row["mcat_name"];
                        echo "</td>";
                        echo "<td>";
                        $topctaegoryquery  = $mysqli->query("SELECT * FROM  tbl_top_category WHERE 
                         tcat_id = '$row[tcat_id]'");
                        while ($row2 = mysqli_fetch_assoc($topctaegoryquery)) {
                            $tcat_name = $row2["tcat_name"];
                            echo  $tcat_name;
                        };
                        echo "</td>";
                        echo "<td class='action'>";
                        echo "<form method='post' id='edittcat'>";
                        echo  '<input  hidden   type="text"  name ="mcat_id" value="' . $row["mcat_id"] . '">';
                        echo  '<input  hidden  type="text"  name ="mcat_name" value="' . $row["mcat_name"] . '">';
                        echo  '<input  hidden  type="text"  name ="tcat_id" value="' . $row["tcat_id"] . '">';
                        echo  '<input  hidden  type="text"  name ="tcat_name" value="' . $tcat_name . '">';

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
                    $query  = $mysqli->query("SELECT * FROM  tbl_mid_category limit 5");
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
                            echo $row["mcat_name"];
                            echo "</td>";
                            echo "<td>";
                            $topctaegoryquery  = $mysqli->query("SELECT * FROM  tbl_top_category WHERE 
                         tcat_id = '$row[tcat_id]'");
                            while ($row2 = mysqli_fetch_assoc($topctaegoryquery)) {
                                $tcat_name = $row2["tcat_name"];
                                echo  $tcat_name;
                            };
                            echo "</td>";
                            echo "<td class='action'>";
                            echo "<form method='post' id='edittcat'>";
                            echo  '<input  hidden  type="text"  name ="mcat_id" value="' . $row["mcat_id"] . '">';
                            echo  '<input   hidden type="text"  name ="mcat_name" value="' . $row["mcat_name"] . '">';
                            echo  '<input   hidden  type="text"  name ="tcat_id" value="' . $row["tcat_id"] . '">';
                            echo  '<input  hidden  type="text"  name ="tcat_name" value="' . $tcat_name . '">';

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
            $query2  = $mysqli->query("SELECT * FROM  tbl_mid_category ");
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
        $("#edittcat button").click(function() {
            var s = $(this).parent().find("input");
            var m_cat_id = s[0].value;
            var tcat_id = s[2].value ;
            var mcat_name  = s[1].value ;
            
            $("#tcat_name_selection").val(tcat_id);
            $("#editmdcatname").val(mcat_name);
            $("#mcat_id_editpage").val(m_cat_id);

            $.ajax({
                type: "post",
                url: "../fetchdata/fetch_midcategory_by_topcategory_id.php",
                data: {
                    topcategory: tcat_id
                },
                success: function(d) {
                    $("#mcat_name_selection").html(d);
                    $("#mcat_name_selection").val(m_cat_id) ;

                }
            });
           


        
            $("#eidtsocial_media").click(function() {
                var updatetopcategory_id = $("#tcat_name_selection").val();
                var editmdcatname = $("#editmdcatname").val();
                var mcat_id = $("#mcat_id_editpage").val();


                $.ajax({
                    type: "post",
                    url: "edit_add_delete_mcat.php?edit=ture",

                    data: {
                        updatetopcategory_id: updatetopcategory_id,
                        editmdcatname: editmdcatname,
                        mcat_id: mcat_id
                    },

                    success: function(response) {
                        var res = jQuery.parseJSON(response);

                        if (res.status == 200) {
                            $(".message").css("display", "block");
                            $(".message").html(res.message);
                            $('#reload').load(location.href + " #reload");
                            setInterval(() => $(".message").fadeOut(), 5000)

                            setInterval(() => $(".message").fadeOut(), 5000)
                            setTimeout(function() {
                                $.ajax({
                                    type: "post",
                                    url: "../fetchdata/fetchdata_adminpanel.php",
                                    data: {
                                        panel: "MidLevelCategory"
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
                        } else if (res.status == 302) {
                            $(".message").css("display", "block");
                            $(".message").html(res.message);
                            setInterval(() => $(".message").fadeOut(), 5000)
                        }
                        else if (res.status == 405) {
                            $(".message").css("display", "block");
                            $(".message").html(res.message);
                            setInterval(() => $(".message").fadeOut(), 5000)
                        }
                    }
                });
            })
        })


        $(".d").click(function() {
            var s2 = $(this).parent().parent().find("input");
            var mcat_id = s2[0].value;

            $("#delete_midcat").click(function() {
                $('#reload').load(location.href + " #reload");

                setTimeout(function() {

                    $.ajax({
                        type: "post",
                        url: "edit_add_delete_mcat.php?delete=true",
                        data: {
                            mcat_id: mcat_id
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
                                        panel: "MidLevelCategory"
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
                                        panel: "MidLevelCategory"
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
                url: "MidLevelCategory.php",
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
                url: "MidLevelCategory.php",
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
            $.ajax({
                type: "post",
                url: "MidLevelCategory.php",
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

            var nameformidcategory = $("#addform input ").val();
            var topcategory = $("#addmidcat_topcat").val();

            if (nameformidcategory == "") {
                $(".message").css("display", "block");
                $(".message").html("name field should  not be empty !");
                setInterval(() => $(".message").fadeOut(), 5000)
            } else {

                $.ajax({
                    type: "post",
                    url: "edit_add_delete_mcat.php?add=ture",
                    data: {
                        topcategory: topcategory,
                        nameformidcategory: nameformidcategory
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
                                        panel: "MidLevelCategory"
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