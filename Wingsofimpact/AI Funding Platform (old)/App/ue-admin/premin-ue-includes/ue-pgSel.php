<div class="pageSelector">
	 <?php
            //Get Current Page Name
            $fairu = $_SERVER["SCRIPT_NAME"];
            $bureq = explode('/', $fairu);
            $pfile = $bureq[count($bureq) - 1];
            $pgSel_parameters = pageParamsFormat($pageParamsArr,array('page'));
			
			//First
			if ($page > 1) echo '<a href="'.$pfile.pageParamsFormat($pageParamsArr,array('page' => 1)).'" class="footerBtn" style="float: left;">First</a>';
    
            //Prev
            if ($page > 1) echo '<a href="'.$pfile.pageParamsFormat($pageParamsArr,array('page' => ($page-1))).'" class="footerBtn" style="float: left;">&laquo;</a>';
            
            //Page Selector
            if($jumlahData > 21) {
                $nowpage = $page;
                $firstpage = $nowpage - 10;
                $lastpage = $nowpage + 10;
                $makz = ceil($jumlahData/$pagePerView);
                if($firstpage < 1) {
                    $firstpage = 1;
                }
                if($lastpage > $makz) {
                    $lastpage = $makz;
                }
                
                for ($i=$firstpage;$i<=$lastpage;$i++) {
                    if($nowpage == $i) {
                        echo $i;
                    }
                    else {
                        echo '<a href="'.$pfile.pageParamsFormat($pageParamsArr,array('page' => $i)).'"> '.$i.' </a>';
                    }
                }
                
            }
            else {
                $nowpage = $page;
                for ($i=1;$i<=ceil($jumlahData/$pagePerView);$i++) {
                    if($nowpage == $i) {
                        echo $i;
                    }
                    else {
                        echo '<a href="'.$pfile.pageParamsFormat($pageParamsArr,array('page' => $i)).'"> '.$i.' </a>';
                    }
                }
            }
            
            //Last
            if ($page < ceil($jumlahData/$pagePerView)) echo '<a class="footerBtn" style="float: right;" href="'.$pfile.pageParamsFormat($pageParamsArr,array('page' => $makz)).'">Last</a>';
			
            //Next
            if ($page < ceil($jumlahData/$pagePerView)) echo '<a class="footerBtn" style="float: right;" href="'.$pfile.pageParamsFormat($pageParamsArr,array('page' => ($page+1))).'">&raquo;</a>';
            
            //Null
            if ($jumlahData == 0) echo 'Not Found';
     ?>
</div>