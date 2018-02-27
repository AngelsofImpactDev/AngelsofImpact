<?php
	function writeGlobalHistory($writeGlobalHistoryTypeName,$writeGlobalHistoryMode,$writeGlobalHistoryDesc='',$writeGlobalHistoryTableName,$writeGlobalHistoryIdColumnName,$writeGlobalHistoryRGH=true,$recordHistoryEDTPG=true) {							
		if($writeGlobalHistoryRGH == true && $recordHistoryEDTPG == true) {
			if($writeGlobalHistoryMode == '') {
				$writeGlobalHistoryMode = 'create';
			}
			$writeGlobalHistoryTime = time();
			$writeGlobalHistoryUser = $_SESSION['currentUserId'];
			@ $writeGlobalHistoryQue = ue_query("INSERT INTO globalhistory VALUES('','$writeGlobalHistoryTime','$writeGlobalHistoryTypeName','$writeGlobalHistoryMode','$writeGlobalHistoryUser','$writeGlobalHistoryDesc','$writeGlobalHistoryTableName','$writeGlobalHistoryIdColumnName')");
			if($writeGlobalHistoryQue) {
				return true;
			}
			else {
				return false;
			}
		}
	}

	function generateChart($generateChartData,$generateChartName='chartCanvas') {
		$chartJsCount = 0;
		$chartJsLabels = '';
		$chartJsDatasets = '';
		$chartJsLegend = '';
		$chartLabelGenerated = false;
		
		$genChartColors = array(
			'63,133,242',
			'15,157,88',
			'219,68,55',
			'126,55,148',
			'106,74,60',
			'244,180,00',
			'159,190,238',
			'248,107,35',
			'46,177,207',
			'36,130,152',
			'82,191,146'
		);
		
		foreach($generateChartData as $generateChartDataKey => $generateChartDataVal) {
			$chartJsLabelsDatas = '';
			foreach($generateChartDataVal as $generateChartDataValKey => $generateChartDataValVal) {
				$chartJsLabelsDatas .= round($generateChartDataValVal).',';
				
				if($chartLabelGenerated == false) {
					$chartJsLabels .= '"'.$generateChartDataValKey.'",';
				}
			}
			$chartLabelGenerated = true;
			$chartJsLabelsDatas = substr($chartJsLabelsDatas,0,-1); //Deletes Trailing Comma
			
			$chartJsDatasets .= '{
				label: "'.$generateChartDataKey.'",
				fillColor : "rgba('.$genChartColors["$chartJsCount"].',0.2)",
				strokeColor : "rgba('.$genChartColors["$chartJsCount"].',1)",
				pointColor : "rgba('.$genChartColors["$chartJsCount"].',1)",
				pointStrokeColor : "#fff",
				pointHighlightFill : "#fff",
				pointHighlightStroke : "rgba(151,187,205,1)",
				data : ['.$chartJsLabelsDatas.']
			},';
			
			$chartJsLegend .= '<table>
				<tr>
					<td width="1">
						<div style="background-color: rgba('.$genChartColors["$chartJsCount"].',1);" class="chartLegendSwatch"></div>
					</td>
					<td>
						'.$generateChartDataKey.'
					</td>
				</tr>
			</table>';
			
			if((count($genChartColors)-1)>$chartJsCount) {
				$chartJsCount++;
			}
		}
		
		$chartJsLabels = substr($chartJsLabels,0,-1); //Deletes Trailing Comma
		$chartJsDatasets = substr($chartJsDatasets,0,-1); //Deletes Trailing Comma
		
		return '<script type="text/javascript" src="js/chart/chart.min.js"></script>
			<link rel="stylesheet" type="text/css" href="js/chart/chart.css" />
			<table id="chartContainer" width="100%">
				<tr>
					<td valign="top">
						<canvas id="'.$generateChartName.'" height="250"></canvas>
					</td>
					<td valign="top" width="20%">
						<div id="chartLegend">
							'.$chartJsLegend.'
						</div>
					</td>
				</tr>
			</table>
			<script type="text/javascript">
				var lineChartData'.$generateChartName.' = {
					labels : ['.$chartJsLabels.'],
					datasets : [
						'.$chartJsDatasets.'
					]
		
				}
				
				var ctx'.$generateChartName.' = document.getElementById("'.$generateChartName.'").getContext("2d");
				window.myLine = new Chart(ctx'.$generateChartName.').Line(lineChartData'.$generateChartName.', {
					responsive: true,
					maintainAspectRatio: false
				});
			</script>';
	}
	
	function generateCircleChart($generateCircleChartData,$generateCircleChartName='circleChart') {
		$colorsArr = array(
			'63,133,242',
			'15,157,88',
			'219,68,55',
			'126,55,148',
			'106,74,60',
			'244,180,00',
			'159,190,238',
			'248,107,35',
			'46,177,207',
			'36,130,152',
			'82,191,146'
		);
		
		$dataCircleNum = 0;
		$dataCircleStr = '';
		foreach($generateCircleChartData as $generateCircleChartDataKey => $generateCircleChartDataVal) {
			$dataCircleStr .= '{
				value: '.$generateCircleChartDataVal.',
				color:"rgba('.$colorsArr["$dataCircleNum"].',1)",
				highlight: "rgba('.$colorsArr["$dataCircleNum"].',0.8)",
				label: "'.$generateCircleChartDataKey.'"
			},';
			$dataCircleNum++;
		}
		$dataCircleStr = substr($dataCircleStr,0,-1);
		
		$returnCircleChart = '<script type="text/javascript" src="js/chart/chart.min.js"></script>
			<link rel="stylesheet" type="text/css" href="js/chart/chart.css" />
			<canvas id="'.$generateCircleChartName.'" width="150" height="150"></canvas>
			<script type="text/javascript">
				var dataCircle'.$generateCircleChartName.' = [
					'.$dataCircleStr.'
				]
				var ctxCircle'.$generateCircleChartName.' = document.getElementById("'.$generateCircleChartName.'").getContext("2d");
				window.myLine = new Chart(ctxCircle'.$generateCircleChartName.').Doughnut(dataCircle'.$generateCircleChartName.', {
					responsive: true,
					maintainAspectRatio: false,
					segmentStrokeWidth : 2
				});
			</script>
		';
		
		return $returnCircleChart;
	}
	
	function lastcouplemonths($lastcouplemonthsNum) {
		for ($i=$lastcouplemonthsNum;$i>=0;$i--) {
			$months[] = date("F", strtotime( date( 'Y-m-01' )." -$i months"));
		}
		
		return $months;
	}
?>