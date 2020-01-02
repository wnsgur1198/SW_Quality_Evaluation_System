<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MSE</title>

  <link href="../css/testcase.css" rel="stylesheet">

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/simple-sidebar.css" rel="stylesheet">

  <script src=" ../vendor/jquery/jquery.min.js"> </script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- 합쳐지고 최소화된 최신 CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

  <!-- 부가적인 테마 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

  <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

  <script src="http://code.jquery.com/jquery-latest.min.js"></script>

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <style type="text/css">
    table {
      text-align: center;
      border-collapse: collapse;
      border: 1px solid #d4d4d4;
      width: 130%;
    }

    tr:nth-child(even) {
      background: #d4d4d4;
    }

    th,
    td {
      padding: 10px 10px;
    }

    th {
      border-bottom: 1px solid #d4d4d4;
    }

    table.type01 {
      line-height: 3;
    }

    table.type01 th {
      text-align: center;
      background: #eee;
      font-weight: bold;
    }
  </style>
</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">MSE</div>
      <div class="list-group list-group-flush">
        <a href="../index.html" class="list-group-item list-group-item-action bg-light">Main</a>
        <a href="../pages/testcase.html" class="list-group-item list-group-item-action bg-light">TC</a>
        <a href="../pages/show_testcase.php" class="list-group-item list-group-item-action bg-light">QA</a>
        <!-- <a href="../pages/result.html" class="list-group-item list-group-item-action bg-light">Report</!-->
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">MSE Menu</button>
      </nav>

      <div class="container-fluid">
        <!-- 내용 -->
        <div id="jb-container">
          <div id="jb-header">
            <h1>Testcase</h1>
          </div>
          <div>
            <?php
              $conn = mysqli_connect('mse.ckbl1fdsxpkw.ap-northeast-2.rds.amazonaws.com','user','00000000','MSE_DB');
              if ( conn == false ) {
                echo "<p>Failure</p>";
            } else {
                echo "<p>Success</p>";
            }
              $result = mysqli_query($conn, "SELECT * FROM TC_Table");
              
              echo("<table>");
              echo("<tr><td>Num</td><td>ID</td><td>Scenario</td>
              <td>Input</td><td>Output</td><td>Main</td>
              <td>TEST</td><td>Comment</td></tr>");
              while($row = mysqli_fetch_assoc($result)) 
              {
                for($i=0; $i<sizeof($result); $i++)
                {
                  $count++;
                  echo("<tr><td>".$count."</td><td>".$row['TC_ID']."</td><td>".$row['TC_Scenario']."</td>
                  <td>".$row['TC_Input']."</td><td>".$row['TC_Output']."</td>
                  <td><div class='TC_Info' name='TC_Info_$count' id='TC_Info_$count'>".$row['TC_Main']."
                  </div></td>
                  <td width=10%><div class='check_Info' id='check_Info'>
                  <input type='radio' name='chk_info_$count' value='yes'>yes
                  <input type='radio' name='chk_info_$count' value='no'>no
                  </div></td>
                  <td><div class='addComment'>
                  <textarea rows='5' cols='30' name='contents_$count' id='contents_$count'></textarea>
                  </div></td>
                  </tr>");
                }
                
              }
              echo("</table>");
              echo("<hr>");
              // echo("<form name='input' method='post' action='http://15.164.250.88/pages/result.html'>
              // <input type='submit' value='결과보기'></form>");
              echo("<input type='button' id='test' value='결과보기'>");
            ?>
            </<input>


            <div id="jb-footer">
            </div>
          </div>

        </div>
      </div>
      <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Menu Toggle Script -->
    <script>
      $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>

    <script>
      $(document).ready(function () {
        $('#test').click(function () {
          var msg = "";
          var msg1 = "";
          var count_yes = 0;
          var count_no = 0;
          var count_null = 0;
          var count_1 = 0;
          var count_2 = 0;
          var count_3 = 0;
          var count_4 = 0;
          var count_5 = 0;
          var count_6 = 0;
          var comments = "";
          var count_commnet = 0;

          //json 만들기
          var TCArray = new Array();

          function Make_JSON() {
            var TCInfo = new Object();
            TCInfo.num = [i];
            TCInfo.main = $("#TC_Info_" + [i] + "").html();
            TCInfo.comment = $("#contents_" + [i] + "").val();

            TCArray.push(TCInfo);
          }

          //코멘트
          function Comment_Check() {
            if ($("#contents_" + [i] + "").val() != '') {
              comments += [i] + "=" + $("#contents_" + [i] + "").val() + "," + "\n";
              count_commnet++;
            };
          }

          //품질특성 개수 
          function TC_Check() {
            if ($("#TC_Info_" + [i] + "").html() == 1) {
              count_1++;
            } else if ($("#TC_Info_" + [i] + "").html() == 2) {
              count_2++;
            } else if ($("#TC_Info_" + [i] + "").html() == 3) {
              count_3++;
            } else if ($("#TC_Info_" + [i] + "").html() == 4) {
              count_4++;
            } else if ($("#TC_Info_" + [i] + "").html() == 5) {
              count_5++;
            } else if ($("#TC_Info_" + [i] + "").html() == 6) {
              count_6++;
            }
          }

          // yes or no 개수
          for (i = 1; i < 21; i++) {
            // msg +=  $("input[name=chk_info_" + [i] + "]:checked").val() + "\n";
            if ($("input[name=chk_info_" + [i] + "]:checked").val() == 'yes') {
              count_yes++;
            } else if ($("input[name=chk_info_" + [i] + "]:checked").val() == 'no') {
              count_no++;
              TC_Check();
              Comment_Check();
              Make_JSON();
            } else {
              count_null++;
            }
          }

          console.log(TCArray);
          // alert(comments)

          // test하기
          // alert(msg + "\n" + count_yes + "\n" + count_no + "\n" + count_null);
          // alert(count_1 + ", " + count_2 + ", " + count_3 + ", " + count_4 + ", " + count_5 + ", " + count_6);

          if (count_null == '0') {
            // 값 전송
          location.href = "../pages/result.html?" + count_yes + ":" + count_no + ":" + count_1 + ":" + count_2 +
            ":" + count_3 + ":" + count_4 + ":" + count_5 + ":" + count_6 + ":" + count_commnet + ":" + comments ;
          } else {
            alert(count_null + "의 Testcase가 남아있습니다.");
          }

        });
      });
      // }
    </script>

    <script type="text/javascript" src="../js/testcase.js">
      < /body>

      <
      /html>