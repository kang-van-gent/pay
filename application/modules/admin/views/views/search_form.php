<!DOCTYPE html>
<html ng-app lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FB : facebook.com/ToBeDeveloper : การค้นหาแบบตัวเลือกหลายเงื่อนไข</title>
    <!-- Bootstrap -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div role="main" class="container theme-showcase">

        <!-- FORM -->
        <form action="display_info.php" method="POST">
                <fieldset>
                <legend>
                    <div role="alert" class="alert alert-info">
                        การเลือกค้นหาแบบเลือกได้หลายเงื่อนไข:
                      </div>
                </legend>
                <h3>คุณสมบัติของที่พัก</h3>
                <label class="checkbox-inline">
                  <input type="checkbox" id="inlineCheckbox1" name="opt1" value="1"> พัดลม
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox" id="inlineCheckbox2" name="opt2" value="1"> เครื่องปรับอากาศ
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox" id="inlineCheckbox3" name="opt3" value="1"> โทรทัศน์
                </label>

                <br><hr>

                <input name="btn_submit" type="submit" value="ค้นหา">
                </field(set>
        </form>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../../js/jquery.min.js"></script>
    <script src="js/angular.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>

  </body>
</html>