<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@4.1.0/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <br>
        <form id="myform1" name="form1" method="POST" action="test-submit.php" novalidate>
            <div class="form-group row">
                <label for="input_name" class="col-sm-3 col-form-label text-right">ชื่อ นามสกุล</label>
                <div class="col">
                    <input type="text" class="form-control" oninput="" name="input_name" id="input_name" autocomplete="off" value="" required>
                    <div class="invalid-feedback">
                        กรุณากรอกชื่อ นามสกุล
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <legend class="col-form-label col-sm-3 pt-0 text-right">ความสนใจ</legend>
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input required" type="checkbox" name="checkbox_hobby1" id="hobby1" value="การออกกำลังกาย" required>
                        <label class="form-check-label" for="hobby1">
                            การออกกำลังกาย
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input required" type="checkbox" name="checkbox_hobby2" id="hobby2" value="อ่านหนังสือ" required>
                        <label class="form-check-label" for="hobby2">
                            อ่านหนังสือ
                        </label>
                        <div class="invalid-feedback">
                            กรุณาเลือกความสนใจ
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 offset-sm-3 text-right pt-3">
                    <button type="submit" name="btn_submit" id="btn_submit" value="" class="btn btn-primary btn-block">ส่งข้อมูล</button>
                </div>
            </div>
        </form>

        <form id="form2" name="form2" method="post" action="">
            Citizen ID: <input name="data1" type="text" id="data1" onkeyup="autoTab2(this,1)" /><br>
            Tel: <input name="data2" type="text" id="data2" onkeyup="autoTab2(this,2)" /><br>
        </form>

    </div>

    <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
    <script src="https://unpkg.com/bootstrap@4.1.0/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function autoTab2(obj, typeCheck) {
            /* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย
            หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น  รูปแบบเลขที่บัตรประชาชน
            4-2215-54125-6-12 ก็สามารถกำหนดเป็น  _-____-_____-_-__
            รูปแบบเบอร์โทรศัพท์ 08-4521-6521 กำหนดเป็น __-____-____
            หรือกำหนดเวลาเช่น 12:45:30 กำหนดเป็น __:__:__
            ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบเลขบัตรประชาชน
            */
            if (typeCheck == 1) {
                var pattern = new String("_-____-_____-_-__"); // กำหนดรูปแบบในนี้
                var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้     
            } else {
                var pattern = new String("__-____-____"); // กำหนดรูปแบบในนี้
                var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้                 
            }
            var returnText = new String("");
            var obj_l = obj.value.length;
            var obj_l2 = obj_l - 1;
            for (i = 0; i < pattern.length; i++) {
                if (obj_l2 == i && pattern.charAt(i + 1) == pattern_ex) {
                    returnText += obj.value + pattern_ex;
                    obj.value = returnText;
                }
            }
            if (obj_l >= pattern.length) {
                obj.value = obj.value.substr(0, pattern.length);
            }
        }
    </script>


    <script type="text/javascript">
        $(function() {
            var checkbox_required = false;
            $(":checkbox.required").on("click", function() {
                var is_checked = $(this).prop("checked");
                if (is_checked) {
                    $(":checkbox.required").prop('required', false);
                    checkbox_required = true;
                } else {
                    if ($(":checkbox.required:checked").length == 0) {
                        checkbox_required = false;
                        $(":checkbox.required").prop('required', true);
                    }
                }

            });
            $("#myform1").on("submit", function() {
                var form = $(this)[0];
                if (form.checkValidity() === false || checkbox_required === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            });
        });
    </script>
</body>