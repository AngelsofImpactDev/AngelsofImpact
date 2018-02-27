<div class="transFullWidthWrapper centerText">
<?php if($_GET['gTrendsMonthToCountry']=='Worldwide'){$gTrendsMonthToCountry='';}else{$gTrendsMonthToCountry='ID';}if($_GET['gTrendsMonthToCheck']){$gTrendsMonthToCheck=$_GET['gTrendsMonthToCheck'];}else{$gTrendsMonthToCheck='6';}if($_GET['gTrendsKeywords']){$gTrendsKeywords=$_GET['gTrendsKeywords'];}else{$gTrendsKeywords=$globvar_keywords;}$gTrendsKeywords=str_replace(', ',',',$gTrendsKeywords);$gTrendsKeywords=str_replace(' ','+',$gTrendsKeywords);$gTrendsKeywordsArr=explode(',',$gTrendsKeywords);$gTrendsKeywordsFirst='';$gTrendsKeywordsRes='';$gTrendsKeywordsNum=0;foreach($gTrendsKeywordsArr as $gTrendsKeywordsArrKey=>$gTrendsKeywordsVal){$gTrendsKeywordsRes.=$gTrendsKeywordsVal.',';$gTrendsKeywordsNum++;if($gTrendsKeywordsNum==5){break;}if($gTrendsKeywordsNum==1){$gTrendsKeywordsFirst=$gTrendsKeywordsVal;}}$gTrendsKeywordsRes=substr($gTrendsKeywordsRes,0,-1);$countryList=array('AF'=>'Afghanistan','AX'=>'Aland Islands','AL'=>'Albania','DZ'=>'Algeria','AS'=>'American Samoa','AD'=>'Andorra','AO'=>'Angola','AI'=>'Anguilla','AQ'=>'Antarctica','AG'=>'Antigua and Barbuda','AR'=>'Argentina','AM'=>'Armenia','AW'=>'Aruba','AU'=>'Australia','AT'=>'Austria','AZ'=>'Azerbaijan','BS'=>'Bahamas the','BH'=>'Bahrain','BD'=>'Bangladesh','BB'=>'Barbados','BY'=>'Belarus','BE'=>'Belgium','BZ'=>'Belize','BJ'=>'Benin','BM'=>'Bermuda','BT'=>'Bhutan','BO'=>'Bolivia','BA'=>'Bosnia and Herzegovina','BW'=>'Botswana','BV'=>'Bouvet Island (Bouvetoya)','BR'=>'Brazil','IO'=>'British Indian Ocean Territory (Chagos Archipelago)','VG'=>'British Virgin Islands','BN'=>'Brunei Darussalam','BG'=>'Bulgaria','BF'=>'Burkina Faso','BI'=>'Burundi','KH'=>'Cambodia','CM'=>'Cameroon','CA'=>'Canada','CV'=>'Cape Verde','KY'=>'Cayman Islands','CF'=>'Central African Republic','TD'=>'Chad','CL'=>'Chile','CN'=>'China','CX'=>'Christmas Island','CC'=>'Cocos (Keeling) Islands','CO'=>'Colombia','KM'=>'Comoros the','CD'=>'Congo','CG'=>'Congo the','CK'=>'Cook Islands','CR'=>'Costa Rica','CI'=>'Cote d\'Ivoire','HR'=>'Croatia','CU'=>'Cuba','CY'=>'Cyprus','CZ'=>'Czech Republic','DK'=>'Denmark','DJ'=>'Djibouti','DM'=>'Dominica','DO'=>'Dominican Republic','EC'=>'Ecuador','EG'=>'Egypt','SV'=>'El Salvador','GQ'=>'Equatorial Guinea','ER'=>'Eritrea','EE'=>'Estonia','ET'=>'Ethiopia','FO'=>'Faroe Islands','FK'=>'Falkland Islands (Malvinas)','FJ'=>'Fiji the Fiji Islands','FI'=>'Finland','FR'=>'France, French Republic','GF'=>'French Guiana','PF'=>'French Polynesia','TF'=>'French Southern Territories','GA'=>'Gabon','GM'=>'Gambia the','GE'=>'Georgia','DE'=>'Germany','GH'=>'Ghana','GI'=>'Gibraltar','GR'=>'Greece','GL'=>'Greenland','GD'=>'Grenada','GP'=>'Guadeloupe','GU'=>'Guam','GT'=>'Guatemala','GG'=>'Guernsey','GN'=>'Guinea','GW'=>'Guinea-Bissau','GY'=>'Guyana','HT'=>'Haiti','HM'=>'Heard Island and McDonald Islands','VA'=>'Holy See (Vatican City State)','HN'=>'Honduras','HK'=>'Hong Kong','HU'=>'Hungary','IS'=>'Iceland','IN'=>'India','ID'=>'Indonesia','IR'=>'Iran','IQ'=>'Iraq','IE'=>'Ireland','IM'=>'Isle of Man','IL'=>'Israel','IT'=>'Italy','JM'=>'Jamaica','JP'=>'Japan','JE'=>'Jersey','JO'=>'Jordan','KZ'=>'Kazakhstan','KE'=>'Kenya','KI'=>'Kiribati','KP'=>'Korea','KR'=>'Korea','KW'=>'Kuwait','KG'=>'Kyrgyz Republic','LA'=>'Lao','LV'=>'Latvia','LB'=>'Lebanon','LS'=>'Lesotho','LR'=>'Liberia','LY'=>'Libyan Arab Jamahiriya','LI'=>'Liechtenstein','LT'=>'Lithuania','LU'=>'Luxembourg','MO'=>'Macao','MK'=>'Macedonia','MG'=>'Madagascar','MW'=>'Malawi','MY'=>'Malaysia','MV'=>'Maldives','ML'=>'Mali','MT'=>'Malta','MH'=>'Marshall Islands','MQ'=>'Martinique','MR'=>'Mauritania','MU'=>'Mauritius','YT'=>'Mayotte','MX'=>'Mexico','FM'=>'Micronesia','MD'=>'Moldova','MC'=>'Monaco','MN'=>'Mongolia','ME'=>'Montenegro','MS'=>'Montserrat','MA'=>'Morocco','MZ'=>'Mozambique','MM'=>'Myanmar','NA'=>'Namibia','NR'=>'Nauru','NP'=>'Nepal','AN'=>'Netherlands Antilles','NL'=>'Netherlands the','NC'=>'New Caledonia','NZ'=>'New Zealand','NI'=>'Nicaragua','NE'=>'Niger','NG'=>'Nigeria','NU'=>'Niue','NF'=>'Norfolk Island','MP'=>'Northern Mariana Islands','NO'=>'Norway','OM'=>'Oman','PK'=>'Pakistan','PW'=>'Palau','PS'=>'Palestinian Territory','PA'=>'Panama','PG'=>'Papua New Guinea','PY'=>'Paraguay','PE'=>'Peru','PH'=>'Philippines','PN'=>'Pitcairn Islands','PL'=>'Poland','PT'=>'Portugal, Portuguese Republic','PR'=>'Puerto Rico','QA'=>'Qatar','RE'=>'Reunion','RO'=>'Romania','RU'=>'Russian Federation','RW'=>'Rwanda','BL'=>'Saint Barthelemy','SH'=>'Saint Helena','KN'=>'Saint Kitts and Nevis','LC'=>'Saint Lucia','MF'=>'Saint Martin','PM'=>'Saint Pierre and Miquelon','VC'=>'Saint Vincent and the Grenadines','WS'=>'Samoa','SM'=>'San Marino','ST'=>'Sao Tome and Principe','SA'=>'Saudi Arabia','SN'=>'Senegal','RS'=>'Serbia','SC'=>'Seychelles','SL'=>'Sierra Leone','SG'=>'Singapore','SK'=>'Slovakia (Slovak Republic)','SI'=>'Slovenia','SB'=>'Solomon Islands','SO'=>'Somalia, Somali Republic','ZA'=>'South Africa','GS'=>'South Georgia and the South Sandwich Islands','ES'=>'Spain','LK'=>'Sri Lanka','SD'=>'Sudan','SR'=>'Suriname','SJ'=>'Svalbard & Jan Mayen Islands','SZ'=>'Swaziland','SE'=>'Sweden','CH'=>'Switzerland, Swiss Confederation','SY'=>'Syrian Arab Republic','TW'=>'Taiwan','TJ'=>'Tajikistan','TZ'=>'Tanzania','TH'=>'Thailand','TL'=>'Timor-Leste','TG'=>'Togo','TK'=>'Tokelau','TO'=>'Tonga','TT'=>'Trinidad and Tobago','TN'=>'Tunisia','TR'=>'Turkey','TM'=>'Turkmenistan','TC'=>'Turks and Caicos Islands','TV'=>'Tuvalu','UG'=>'Uganda','UA'=>'Ukraine','AE'=>'United Arab Emirates','GB'=>'United Kingdom','US'=>'United States of America','UM'=>'United States Minor Outlying Islands','VI'=>'United States Virgin Islands','UY'=>'Uruguay, Eastern Republic of','UZ'=>'Uzbekistan','VU'=>'Vanuatu','VE'=>'Venezuela','VN'=>'Vietnam','WF'=>'Wallis and Futuna','EH'=>'Western Sahara','YE'=>'Yemen','ZM'=>'Zambia','ZW'=>'Zimbabwe');?>
<div id="currentWidth"></div>
<form action="insights.php" method="get" id="gTrendsForm">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="50%" valign="top">
<div class="adminSubTitle multiDataViewTable">Search Engine Insights</div>
</td>
<td class="rightText">
<img src="images/icon/infoSmall.png" <?php echo tooltip('Numbers represent search interest relative to the highest point on the chart.')?> />
</td>
</tr>
<tr>
<td <?php echo tooltip('Enter 5 keywords maximum, separated by comma.<br />First keyword will be used for Regional &amp; Related Searches data.<div class="italic">(ex: <span class="bold">Electronics, Jakarta Electronics</span>)</div>')?>>
<input type="text" placeholder="Enter 5 keywords maximum, seperated by comma." name="gTrendsKeywords" value="<?php echo str_replace('+',' ',$gTrendsKeywordsRes);?>" />
</td>
<td class="rightText smallSelect">
<select name="gTrendsMonthToCountry" id="gTrendsMonthToCountry">
<option value="Worldwide" class="leftText">Worldwide</option>
<?php foreach($countryList as $countryListKey=>$countryListVal){?>
<option value="<?php echo $countryListKey?>" <?php if($gTrendsMonthToCountry==$countryListKey){echo 'selected="selected"';}?> class="leftText"><?php echo $countryListVal?></option>
<?php }?>
</select>
<select name="gTrendsMonthToCheck" id="gTrendsMonthToCheck">
<?php for($i=1;$i<=12;$i++){?>
<option value="<?php echo $i?>" <?php if($gTrendsMonthToCheck==$i){echo 'selected="selected"';}?> class="leftText">Last <?php echo $i?> Months</option>
<?php }?>
</select>
<input type="submit" value="&nbsp;" style="visibility:hidden;width:1px;height:1px;position:absolute;top:1px;left:1px" />
</td>
</tr>
</table>
</form>
<script type="text/javascript">$("#gTrendsMonthToCountry,#gTrendsMonthToCheck").change(function(){$("#gTrendsForm").submit()});</script>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="76%" valign="top">
<div id="googleTrend1" class="minHeight330"></div>
</td>
<td width="25%" valign="top">
<div id="googleTrend2" class="minHeight330"></div>
</td>
</tr>
</table>
<div class="spacer20"></div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="50%" valign="top">
<div class="adminSubTitle multiDataViewTable">Related Searches</div>
</td>
<td class="rightText">
<img src="images/icon/infoSmall.png" <?php echo tooltip('People whose searches match the restrictions most often searched for these terms too.')?> />
</td>
</tr>
<tr>
<td width="50%" valign="top">
<div id="googleTrend3" class="minHeight330"></div>
</td>
<td width="50%" valign="top">
<div id="googleTrend4" class="minHeight330"></div>
</td>
</tr>
</table>
<script type="text/javascript">/*<![CDATA[*/curFullWidth=$("#currentWidth").width();curHalfWidth=Math.floor(curFullWidth/2);curTenthWidth=Math.floor(curFullWidth/10);$("#googleTrend1").html('<iframe src="//www.google.com/trends/fetchComponent?hl=en-US&amp;q=<?php echo $gTrendsKeywordsRes?>&amp;geo=<?php echo $gTrendsMonthToCountry?>&amp;date=today+<?php echo $gTrendsMonthToCheck?>-m&amp;cmpt=q&amp;tz=Etc/GMT-7&amp;tz=Etc/GMT-7&amp;content=1&amp;cid=TIMESERIES_GRAPH_0&amp;export=5&amp;w='+Math.floor(curTenthWidth*5.9)+'&amp;h=330" style="border: none;" height="330" width="'+(curTenthWidth*6)+'" scrolling="no" style="overflow: hidden;"></iframe>');$("#googleTrend2").html('<iframe src="//www.google.com/trends/fetchComponent?hl=en-US&amp;q=<?php echo $gTrendsKeywordsFirst?>&amp;geo=<?php echo $gTrendsMonthToCountry?>&amp;date=today+<?php echo $gTrendsMonthToCheck?>-m&amp;cmpt=geo&amp;tz=Etc/GMT-7&amp;tz=Etc/GMT-7&amp;content=1&amp;cid=GEO_MAP_0_0&amp;export=5&amp;w=200&amp;h=232" style="border: none;" height="330" width="'+(curTenthWidth*4)+'" scrolling="no" style="overflow: hidden;"></iframe>');$("#googleTrend3").html('<iframe src="//www.google.com/trends/fetchComponent?hl=en-US&amp;q=<?php echo $gTrendsKeywordsRes?>&amp;geo=<?php echo $gTrendsMonthToCountry?>&amp;date=today+<?php echo $gTrendsMonthToCheck?>-m&amp;cmpt=q&amp;tz=Etc/GMT-7&amp;tz=Etc/GMT-7&amp;content=1&amp;cid=TOP_QUERIES_0_0&amp;export=5&amp;w='+curHalfWidth+'&amp;h=420" style="border: none;" height="450" width="'+curHalfWidth+'"></iframe>');$("#googleTrend4").html('<iframe src="//www.google.com/trends/fetchComponent?hl=en-US&amp;q=<?php echo $gTrendsKeywordsRes?>&amp;geo=<?php echo $gTrendsMonthToCountry?>&amp;date=today+<?php echo $gTrendsMonthToCheck?>-m&amp;cmpt=q&amp;tz=Etc/GMT-7&amp;tz=Etc/GMT-7&amp;content=1&amp;cid=RISING_QUERIES_0_0&amp;export=5&amp;w='+curHalfWidth+'&amp;h=420" style="border: none;" height="450" width="'+curHalfWidth+'"></iframe>');/*]]>*/</script>
</div>