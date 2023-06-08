<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
include "../config_database.php";
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

    <!-- Modal for  edit end category    -->
    <div class="modal fade" id="s_m" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog   modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit End level category </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="s_m_form" method="post">
                        <select name="endcategory" id="editendcategory_tcat">
                            <?php
                            $query  = $mysqli->query("SELECT *  FROM  tbl_top_category ");
                            while ($row = mysqli_fetch_assoc($query)) {
                                echo "<option  value=" . $row["tcat_id"] . ">";
                                echo $row["tcat_name"];
                                echo "</option>";
                            }
                            ?>
                        </select>
                        <select name="edit_midcategory_select" id="edit_midcategory_select"></select>
                        <input type="text" id="edited_endcategory" name="edited_endcat" placeholder="Enter a name to Edit ">
                        <input hidden type="text" id="ecat_id_editpage">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="eidtsocial_media" data-dismiss="modal"> Edit </button>
                </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal for  edit end category    -->



    <!-- Modal for  delete  end cat   -->
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
                    <p style="color:black">Are you sure you want to delete this End Category ?!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="delete_midcat" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for  delete  end cat  -->


    <!-- Modal for  add end   category   -->

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
                        <select name="endcategory" id="addendcategory">
                            <?php
                            $query  = $mysqli->query("SELECT *  FROM  tbl_top_category ");
                            while ($row = mysqli_fetch_assoc($query)) {
                                echo "<option  value=" . $row["tcat_id"] . ">";
                                echo $row["tcat_name"];
                                echo "</option>";
                            }
                            ?>
                        </select>
                        <label for="midcat">Mid category name :</label>
                        <select name="add_midcategory_select" id="add_midcategory_select"> </select>
                        <input type="text" id="new_endcategory" name="new_end_cat" placeholder="Enter new end category">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addsocilamedia" data-dismiss="modal"> Add </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal for  add end   category   -->

    <div class="search">
        <form method="post">
            <input name="search" type="text" placeholder="Search for end categories ">
            <button type="button" class="btn btn-secondary  searchbtn">Search</button>
        </form>
    </div>
    <div class="shownumber">
    </div>

    <div class="container">
        <button class="btn btn-primary  all">All</button>
        <button type='button' class='btn btn-primary   add_end_category' data-toggle='modal' data-target='#add_s_m'>
            <i class='bx bx-message-square-add'></i> </button>
        <table>
            <tr>
                <th>#</th>
                <th>Endcategory name </th>
                <th> Mid category name </th>
                <th> Top category name </th>

                <th>Actions</th>
            </tr>
            <?php
            if (isset($_POST["all"])) {
                $q  = $mysqli->query("SELECT * FROM  tbl_end_category ");
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
                        echo $row["ecat_name"];
                        echo "</td>";
                        echo "<td>";
                        $topctaegoryquery  = $mysqli->query("SELECT * FROM  tbl_mid_category WHERE 
                         mcat_id = '$row[mcat_id]'");
                        while ($row2 = mysqli_fetch_assoc($topctaegoryquery)) {
                            $mcat_name = $row2["mcat_name"];
                            echo  $mcat_name;
                        };


                        $topctaegoryquery_id  = $mysqli->query("SELECT * FROM  tbl_mid_category WHERE 
                         mcat_id = '$row[mcat_id]'");
                        while ($row2 = mysqli_fetch_assoc($topctaegoryquery_id)) {
                            $tcat_id = $row2["tcat_id"];

                            $queryfor_topcat_name  =  $mysqli->query("SELECT  * FROM tbl_top_category
                            WHERE   tcat_id = '$tcat_id' 
                             ");
                            while ($rowww = mysqli_fetch_assoc($queryfor_topcat_name)) {
                                $tcat_name  =  $rowww["tcat_name"];
                            }
                        };

                        echo "</td>";
                        echo "<td>";
                        echo $tcat_name;
                        echo "</td>";


                        echo "<td class='action'>";
                        echo "<form method='post' id='edittcat'>";
                        echo  '<input  hidden  type="text"  name ="mcat_id" value="' . $row["mcat_id"] . '">';
                        echo  '<input  hidden  type="text"  name ="mcat_name" value="' . $mcat_name . '">';
                        echo  '<input  hidden  type="text"  name ="tcat_id" value="' . $tcat_id . '">';
                        echo  '<input  hidden  type="text"  name ="tcat_name" value="' . $tcat_name . '">';
                        echo  '<input  hidden  type="text"  name ="tcat_name" value="' . $row["ecat_id"] . '">';
                        echo  '<input  hidden   type="text"  name ="ecat_name" value="' . $row["ecat_name"] . '">';


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
                    $start = $_SESSION["currentstart"] + 10;
                    $_SESSION["currentstart"] = $_SESSION["currentstart"] + 10;
                } else if ($_POST["hasclassprev"] == "true") {
                    $start = $_SESSION["currentstart"] - 5;
                    $_SESSION["currentstart"] = $_SESSION["currentstart"] - 10;
                } else {
                    if ($test == "1") {
                        $start = 0;
                        $_SESSION["currentstart"] = 0;
                    } else {
                        $start = ($test - 1) * 10;
                        $_SESSION["currentstart"] = $start;
                    }
                }

                $querypageination  = $mysqli->query("SELECT * FROM  tbl_end_category  LIMIT $start,10");
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
                        echo $row["ecat_name"];
                        echo "</td>";
                        echo "<td>";

                        $topctaegoryquery  = $mysqli->query("SELECT * FROM  tbl_mid_category WHERE 
                         mcat_id = '$row[mcat_id]'");
                        while ($row2 = mysqli_fetch_assoc($topctaegoryquery)) {
                            $mcat_name = $row2["mcat_name"];
                            echo  $mcat_name;
                        };


                        $topctaegoryquery_id  = $mysqli->query("SELECT * FROM  tbl_mid_category WHERE 
                         mcat_id = '$row[mcat_id]'");
                        while ($row2 = mysqli_fetch_assoc($topctaegoryquery_id)) {
                            $tcat_id = $row2["tcat_id"];

                            $queryfor_topcat_name  =  $mysqli->query("SELECT  * FROM tbl_top_category
                            WHERE   tcat_id = '$tcat_id' 
                             ");
                            while ($rowww = mysqli_fetch_assoc($queryfor_topcat_name)) {
                                $tcat_name  =  $rowww["tcat_name"];
                            }
                        };

                        echo "</td>";
                        echo "<td>";
                        echo $tcat_name;
                        echo "</td>";


                        echo "<td class='action'>";
                        echo "<form method='post' id='edittcat'>";
                        echo  '<input  hidden  type="text"  name ="mcat_id" value="' . $row["mcat_id"] . '">';
                        echo  '<input  hidden  type="text"  name ="mcat_name" value="' . $mcat_name . '">';
                        echo  '<input  hidden  type="text"  name ="tcat_id" value="' . $tcat_id . '">';
                        echo  '<input hidden   type="text"  name ="tcat_name" value="' . $tcat_name . '">';
                        echo  '<input  hidden  type="text"  name ="tcat_name" value="' . $row["ecat_id"] . '">';
                        echo  '<input  hidden  type="text"  name ="ecat_name" value="' . $row["ecat_name"] . '">';



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

                $query1  = $mysqli->query("SELECT * FROM  tbl_end_category WHERE  ecat_name  LIKE '$str%' ");
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
                        echo $row["ecat_name"];
                        echo "</td>";
                        echo "<td>";
                        $topctaegoryquery  = $mysqli->query("SELECT * FROM  tbl_mid_category WHERE 
                         mcat_id = '$row[mcat_id]'");
                        while ($row2 = mysqli_fetch_assoc($topctaegoryquery)) {
                            $mcat_name = $row2["mcat_name"];
                            echo  $mcat_name;
                        };


                        $topctaegoryquery_id  = $mysqli->query("SELECT * FROM  tbl_mid_category WHERE 
                         mcat_id = '$row[mcat_id]'");
                        while ($row2 = mysqli_fetch_assoc($topctaegoryquery_id)) {
                            $tcat_id = $row2["tcat_id"];

                            $queryfor_topcat_name  =  $mysqli->query("SELECT  * FROM tbl_top_category
                            WHERE   tcat_id = '$tcat_id' 
                             ");
                            while ($rowww = mysqli_fetch_assoc($queryfor_topcat_name)) {
                                $tcat_name  =  $rowww["tcat_name"];
                            }
                        };

                        echo "</td>";
                        echo "<td>";
                        echo $tcat_name;
                        echo "</td>";


                        echo "<td class='action'>";
                        echo "<form method='post' id='edittcat'>";
                        echo  '<input  hidden  type="text"  name ="mcat_id" value="' . $row["mcat_id"] . '">';
                        echo  '<input  hidden  type="text"  name ="mcat_name" value="' . $mcat_name . '">';
                        echo  '<input  hidden  type="text"  name ="tcat_id" value="' . $tcat_id . '">';
                        echo  '<input  hidden  type="text"  name ="tcat_name" value="' . $tcat_name . '">';
                        echo  '<input  hidden  type="text"  name ="tcat_name" value="' . $row["ecat_id"] . '">';
                        echo  '<input  hidden  type="text"  name ="ecat_name" value="' . $row["ecat_name"] . '">';

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
                    $query  = $mysqli->query("SELECT * FROM  tbl_end_category limit 10");
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
                            echo $row["ecat_name"];
                            echo "</td>";
                            echo "<td>";

                            $topctaegoryquery  = $mysqli->query("SELECT * FROM  tbl_mid_category WHERE 
                             mcat_id = '$row[mcat_id]'");
                            while ($row2 = mysqli_fetch_assoc($topctaegoryquery)) {
                                $mcat_name = $row2["mcat_name"];
                                echo $mcat_name;
                            };


                            $topctaegoryquery_id  = $mysqli->query("SELECT * FROM  tbl_mid_category WHERE 
                             mcat_id = '$row[mcat_id]'");
                            while ($row2 = mysqli_fetch_assoc($topctaegoryquery_id)) {
                                $tcat_id = $row2["tcat_id"];

                                $queryfor_topcat_name  =  $mysqli->query("SELECT  * FROM tbl_top_category
                                WHERE   tcat_id = '$tcat_id' 
                                 ");
                                while ($rowww = mysqli_fetch_assoc($queryfor_topcat_name)) {
                                    $tcat_name  =  $rowww["tcat_name"];
                                }
                            };

                            echo "</td>";
                            echo "<td>";
                            echo $tcat_name;
                            echo "</td>";
                            echo "<td class='action'>";
                            echo "<form method='post' id='edittcat'>";
                            echo  '<input  hidden  type="text"  name ="mcat_id" value="' . $row["mcat_id"] . '">';
                            echo  '<input  hidden  type="text"  name ="mcat_name" value="' . $mcat_name . '">';
                            echo  '<input  hidden  type="text"  name ="tcat_id" value="' . $tcat_id . '">';
                            echo  '<input hidden   type="text"  name ="tcat_name" value="' . $tcat_name . '">';
                            echo  '<input  hidden  type="text"  name ="ecat_id" value="' . $row["ecat_id"] . '">';
                            echo  '<input  hidden  type="text"  name ="ecat_name" value="' . $row["ecat_name"] . '">';

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
            $query2  = $mysqli->query("SELECT * FROM  tbl_end_category ");
            $numberof_data  = mysqli_num_rows($query2);
            $paginationnum = ceil($numberof_data / 10);
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
            var ecat_id = s[4].value;
            var tcat_name = s[3].value;
            var tcat_id = s[2].value;
            var mcat_name = s[1].value;
            var ecat_name = s[5].value;
            var mcat_id = s[0].value;

            $("#edited_endcategory").val(ecat_name);
            $("#editendcategory_tcat").val(tcat_id);
            $("#ecat_id_editpage").val(ecat_id);

            $.ajax({
                type: "post",
                url: "../fetchdata/fetch_midcategory_by_topcategory_id.php",
                data: {
                    topcategory: tcat_id
                },
                success: function(d) {
                    $("#edit_midcategory_select").html(d);
                    $("#edit_midcategory_select").val(mcat_id);
                }
            });
            $("#eidtsocial_media").click(function() {
                var selects = $("#s_m_form select");
                var top_cat_id = selects[0].value;
                var mid_cat_id = selects[1].value;
                var inputs = $("#s_m_form input");
                var editedname_endcat = inputs[0].value;
                var ecat_id = inputs[1].value;


                $.ajax({
                    type: "post",
                    url: "edit_add_delete_endcat.php?edit=ture",

                    data: {
                        top_cat_id: top_cat_id,
                        mid_cat_id: mid_cat_id,
                        editedname_endcat: editedname_endcat,
                        ecat_id: ecat_id
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
                                        panel: "EndLevelCategory"
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
                    }
                });
            })
        })

        $(".d").click(function() {
            var s2 = $(this).parent().parent().find("input");
            var ecat_id = s2[4].value;


            $("#delete_midcat").click(function() {

                setTimeout(function() {

                    $.ajax({
                        type: "post",
                        url: "edit_add_delete_endcat.php?delete=true",
                        data: {
                            ecat_id: ecat_id
                        },
                        success: function(response) {
                            var res = jQuery.parseJSON(response);

                            if (res.status == 200) {
                                $(".message").css("display", "block");
                                $(".message").html(res.message);
                                setInterval(() => $(".message").fadeOut(), 5000)

                                $.ajax({
                                    type: "post",
                                    url: "../fetchdata/fetchdata_adminpanel.php",
                                    data: {
                                        panel: "EndLevelCategory"
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
                                        panel: "EndLevelCategory"
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
                url: "EndLevelCategory.php",
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
                url: "EndLevelCategory.php",
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
                url: "EndLevelCategory.php",
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

            var selects = $("#addform select ")
            var topcategory_id = selects[0].value;
            var midcategory_id = selects[1].value;
            var newendcat_name = $("#addform input ").val();


            if (newendcat_name == "") {
                $(".message").css("display", "block");
                $(".message").html("name field should  not be empty !");
                setInterval(() => $(".message").fadeOut(), 5000)
            } else {

                $.ajax({
                    type: "post",
                    url: "edit_add_delete_endcat.php?add=ture",
                    data: {
                        topcategory_id: topcategory_id,
                        midcategory_id: midcategory_id,
                        newendcat_name: newendcat_name
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
                                        panel: "EndLevelCategory"
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


        $("#addendcategory").change(function() {
            var topcategory = $("#addendcategory").val();
            $.ajax({
                type: "post",
                url: "../fetchdata/fetch_midcategory_by_topcategory_id.php",
                data: {
                    topcategory: topcategory
                },

                success: function(d) {
                    $("#add_midcategory_select").html(d);
                }
            });
        })



        $("#editendcategory_tcat").change(function() {
            var tcat_id = $("#editendcategory_tcat").val();
            $.ajax({
                type: "post",
                url: "../fetchdata/fetch_midcategory_by_topcategory_id.php",
                data: {
                    topcategory: tcat_id
                },

                success: function(d) {
                    $("#edit_midcategory_select").html(d);
                }
            });
        })


        $(".add_end_category").click(function() {
            var topcategory = $("#addendcategory").val();
            $.ajax({
                type: "post",
                url: "../fetchdata/fetch_midcategory_by_topcategory_id.php",
                data: {
                    topcategory: topcategory
                },
                success: function(d) {
                    $("#add_midcategory_select").html(d);
                }
            });

        })
    </script>
</body>

</html>