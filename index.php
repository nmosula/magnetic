<?php
include ("./inc_setting.php");
$title=$company_name." - головна";
include ($root_path."/header.php");

		$res	= $db->query("select * from ".$table_golovna);
		$row	= $db->fetch_array($res);
		$description = stripslashes($row["description"]);
		if (strlen($description) > 1)
		{
?>
        <!-- Who are we? -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header bordered">
					<i class="fa fa-pencil"></i> Тестове завдання
                </h1>

				<div class="row">
					<div class="col-sm-8 text-justify">
<?php
						echo nl2br($description);
?>
					</div>
					<div class="col-sm-4">
						<div id="map-canvas"></div>
					</div>
				</div>

            </div>
        </div>
<?php
		}
?>	

		
<?include ($root_path."/footer.php")?>
