<nav id="sidebar">
            <div class="sidebar-header">
                <h3>Card System</h3>
            </div>
    
            <ul class="list-unstyled components">
                <p>Main Menu</p>
                <li  class="#">
                <a href="index.php">เมนู</a>
                </li>
                <?php
                    if($userDetails->status == 2 || $userDetails->status == 4 ){
                                            //element class level 2  = sale
                ?>
                <li class="#" >
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">ใบเบิก - คืน</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li class="#">
                            <a href="create-cashcard.php">ใบเบิกบัตรกิจกรรมลูกค้า</a>
                        </li>
                        <li class="#">
                            <a href="generate-card.php">พิมพ์บัตร</a>
                        </li>
                        <li class="#">
                            <a href="trackstatus.php">ตรวจสอบสถานะ</a>
                        </li>
                        <li class="#">
                            <a href="cancelcard.php">ยกเลิกบัตร</a>
                        </li>
                    </ul>
                </li>
                <?php
                    }
                    if($userDetails->status == 0 || $userDetails->status == 4 ){

                    //element class level 2  = printer
                ?>
                <li  class="#">
                <a href="#realmoney" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">บัตรร้านค้ากิจกรรม</a>
                <ul class="collapse list-unstyled" id="realmoney">
                        <li class="#">
                            <a href="create-realmoney.php">เบิกบัตรร้านค้ากิจกรรม</a>
                        </li>
                    </ul>
                </li>
                <?php
                    }
                    if($userDetails->status == 6 || $userDetails->status == 4 ){

                    //element class level 2  = printer
                ?>
                <li  class="#">
                <a href="#newyear" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">บัตรปีใหม่</a>
                <ul class="collapse list-unstyled" id="newyear">
                        <li class="#">
                            <a href="create_newyear.php">เบิกบัตรปีใหม่</a>
                        </li>
                    </ul>
                </li>
                <?php
                    }
                    if($userDetails->status == 5 || $userDetails->status == 4 ){

                    //element class level 2  = printer
                ?>
                <li  class="#">
                <a href="#farm" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">ร้านค้าฟาร๋ม</a>
                <ul class="collapse list-unstyled" id="farm">
                        <li class="#">
                            <a href="create-farm.php">เบิกบัตรร้านค้าฟาร์ม</a>
                        </li>
                        <li class="#">
                            <a href="closefarm.php">ใบรายงานปิดร้านค้าฟาร์ม</a>
                            <a href="closesheep.php">ใบรายงานปิดร้านค้าฟาร์มแกะ</a>
                        </li>
                    </ul>
                </li>
                <?php
                    }
                    if($userDetails->status == 3 || $userDetails->status == 4 ){
                ?>
                <li  class="#">
                <a href="#laser" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">ร้านค้าเลเซอร์เกมส์</a>
                <ul class="collapse list-unstyled" id="laser">
                        <li class="#">
                            <a href="create-lasergame.php">เบิกบัตรร้านค้าเลเซอร์เกมส์</a>
                        </li>
                    </ul>
                </li>
                <?php
                    }
                    if($userDetails->status == 1 || $userDetails->status == 4 ){

                    //element class level 2  = printer
                ?>
                <li  class="#">
                <a href="#printercard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">รายงานการปิดยอด</a>
                <ul class="collapse list-unstyled" id="printercard">
                        <li class="#">
                            <a href="closing-report.php">ใบรายงานปิดยอดร้านค้ากิจกรรม</a>
                        </li>
                        <li class="#">
                            <a href="closefarm.php">ใบรายงานปิดร้านค้าฟาร์ม</a>
                        </li>
                        <li class="#">
                            <a href="closesheep.php">ใบรายงานปิดร้านค้าฟาร์มแกะ</a>
                        </li>
                        <li class="#">
                            <a href="closelaser.php">ใบรายงานปิดยอดร้านค้าเลเซอร์เกม</a>
                        </li>
                        <li class="#">
                            <a href="close-newyear.php">ใบรายงานปิดยอดวันปีใหม่</a>
                        </li>
                        <li class="#">
                            <a href="edit-seniorsoft.php">เพิ่มรหัสบัตรซ๊เนียรซอฟต์</a>
                        </li>
                        
                    </ul>
                </li>
                <?php
                    }
                    if($userDetails->status == 3 || $userDetails->status == 4 ){
                ?>
                <li  class="#">
                <a href="#reportList" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">รายงาน</a>
                <ul class="collapse list-unstyled" id="reportList">
                        <li class="#">
                            <a href="report-customer-datein.php">รายงานวันที่ลูกค้าเข้า</a>
                        </li>
                        <li class="#">
                            <a href="report-cou.php">รายงานบัตรคงเหลือ</a>
                        </li>
                        <li class="#">
                            <a href="edit-grantCustomer.php">แก้ไขสิทธิ์การสแกน</a>
                        </li>
                        <li class="#">
                            <a href="activityalone.php">สรุปยอดบัตรกิจกรรมเดี่ยว</a>
                        </li>
                        <li class="#">
                            <a href="summaryfarm.php">สรุปยอดบัตรกิจกรรมฟาร์ม</a>
                        </li>
                        <li class="#">
                            <a href="report-xyz.php">สรุปยอดบัตร XYZ</a>
                        </li>
                        <li class="#">
                             <a href="chart.php">รายงานสรุปผลยอดรายวัน</a>
                        </li>
                    </ul>
                </li>
                <?php
                    }
                ?>
                <?php

                if($userDetails->status == 4 ){

                ?>
                <li class="#" >
                <a href="#test" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" >ผู้ดูแลระบบ</a>
                <ul class="collapse list-unstyled" id="test">
                    <li class="#">
                        <a href="setting.php">สมาชิก</a>
                    </li>
                    <li class="#">
                            <a href="chart.php">รายงานกิจกรรม</a>
                    </li>
                    <li><a href="history-foc.php">ประวัติ FOC</a></li>
                    <li>
                    <a href="exportData.php">รายงานการเบิกบัตรลูกค้า</a>
                    </li>
                </ul>
                </li>
                <li class="#" >
                <a href="#conclude" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" >สรุปการใช้บัตร</a>
                <ul class="collapse list-unstyled" id="conclude">
                    <li class="#">
                        <a href="concoluecard.php">การใช้บัตร</a>
                    </li>
                    <li class="#">
                        <a href="chart.php">การคืน</a>
                    </li>
                </ul>
                </li>
                <?php
                }
                ?>
            </ul>
    
         
        </nav>