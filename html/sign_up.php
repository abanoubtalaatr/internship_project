<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
   <div class="sign_up col-md-4 col-md-offset-4">

      <!-- Start sign_up_form -->
	  <div class="sign_up_form">
			 <form method="POST">
			  <div class="form-row">
			  	<div class="col">
			  		<h2>Create Account</h2>
			  	</div>
			    <div class="col" style="width: 45%;float: left; margin-right: 5%">
			      <input type="text" class="form-control" placeholder="First name" name="first_name" maxlength="20" minlength="3">
			      <div class="error first_name">error</div>
			    </div>
			    <div class="col" style="width: 50%;display: inline-block;">
			      <input type="text" class="form-control" placeholder="Last name" name="last_name"  maxlength="20" minlength="3">
			      <div class="error last_name">error</div>
			    </div>
<div class="col">
                 <label>country</label>
			     <select name="country">
			     	<option>....</option>
			     	<?php 
			     	 $countries = array("AF" => "Afghanistan",
									"AX" => "Åland Islands",
									"AL" => "Albania",
									"DZ" => "Algeria",
									"AS" => "American Samoa",
									"AD" => "Andorra",
									"AO" => "Angola",
									"AI" => "Anguilla",
									"AQ" => "Antarctica",
									"AG" => "Antigua and Barbuda",
									"AR" => "Argentina",
									"AM" => "Armenia",
									"AW" => "Aruba",
									"AU" => "Australia",
									"AT" => "Austria",
									"AZ" => "Azerbaijan",
									"BS" => "Bahamas",
									"BH" => "Bahrain",
									"BD" => "Bangladesh",
									"BB" => "Barbados",
									"BY" => "Belarus",
									"BE" => "Belgium",
									"BZ" => "Belize",
									"BJ" => "Benin",
									"BM" => "Bermuda",
									"BT" => "Bhutan",
									"BO" => "Bolivia",
									"BA" => "Bosnia and Herzegovina",
									"BW" => "Botswana",
									"BV" => "Bouvet Island",
									"BR" => "Brazil",
									"IO" => "British Indian Ocean Territory",
									"BN" => "Brunei Darussalam",
									"BG" => "Bulgaria",
									"BF" => "Burkina Faso",
									"BI" => "Burundi",
									"KH" => "Cambodia",
									"CM" => "Cameroon",
									"CA" => "Canada",
									"CV" => "Cape Verde",
									"KY" => "Cayman Islands",
									"CF" => "Central African Republic",
									"TD" => "Chad",
									"CL" => "Chile",
									"CN" => "China",
									"CX" => "Christmas Island",
									"CC" => "Cocos (Keeling) Islands",
									"CO" => "Colombia",
									"KM" => "Comoros",
									"CG" => "Congo",
									"CD" => "Congo, The Democratic Republic of The",
									"CK" => "Cook Islands",
									"CR" => "Costa Rica",
									"CI" => "Cote D'ivoire",
									"HR" => "Croatia",
									"CU" => "Cuba",
									"CY" => "Cyprus",
									"CZ" => "Czech Republic",
									"DK" => "Denmark",
									"DJ" => "Djibouti",
									"DM" => "Dominica",
									"DO" => "Dominican Republic",
									"EC" => "Ecuador",
									"EG" => "Egypt",
									"SV" => "El Salvador",
									"GQ" => "Equatorial Guinea",
									"ER" => "Eritrea",
									"EE" => "Estonia",
									"ET" => "Ethiopia",
									"FK" => "Falkland Islands (Malvinas)",
									"FO" => "Faroe Islands",
									"FJ" => "Fiji",
									"FI" => "Finland",
									"FR" => "France",
									"GF" => "French Guiana",
									"PF" => "French Polynesia",
									"TF" => "French Southern Territories",
									"GA" => "Gabon",
									"GM" => "Gambia",
									"GE" => "Georgia",
									"DE" => "Germany",
									"GH" => "Ghana",
									"GI" => "Gibraltar",
									"GR" => "Greece",
									"GL" => "Greenland",
									"GD" => "Grenada",
									"GP" => "Guadeloupe",
									"GU" => "Guam",
									"GT" => "Guatemala",
									"GG" => "Guernsey",
									"GN" => "Guinea",
									"GW" => "Guinea-bissau",
									"GY" => "Guyana",
									"HT" => "Haiti",
									"HM" => "Heard Island and Mcdonald Islands",
									"VA" => "Holy See (Vatican City State)",
									"HN" => "Honduras",
									"HK" => "Hong Kong",
									"HU" => "Hungary",
									"IS" => "Iceland",
									"IN" => "India",
									"ID" => "Indonesia",
									"IR" => "Iran, Islamic Republic of",
									"IQ" => "Iraq",
									"IE" => "Ireland",
									"IM" => "Isle of Man",
									"IL" => "Israel",
									"IT" => "Italy",
									"JM" => "Jamaica",
									"JP" => "Japan",
									"JE" => "Jersey",
									"JO" => "Jordan",
									"KZ" => "Kazakhstan",
									"KE" => "Kenya",
									"KI" => "Kiribati",
									"KP" => "Korea, Democratic People's Republic of",
									"KR" => "Korea, Republic of",
									"KW" => "Kuwait",
									"KG" => "Kyrgyzstan",
									"LA" => "Lao People's Democratic Republic",
									"LV" => "Latvia",
									"LB" => "Lebanon",
									"LS" => "Lesotho",
									"LR" => "Liberia",
									"LY" => "Libyan Arab Jamahiriya",
									"LI" => "Liechtenstein",
									"LT" => "Lithuania",
									"LU" => "Luxembourg",
									"MO" => "Macao",
									"MK" => "Macedonia, The Former Yugoslav Republic of",
									"MG" => "Madagascar",
									"MW" => "Malawi",
									"MY" => "Malaysia",
									"MV" => "Maldives",
									"ML" => "Mali",
									"MT" => "Malta",
									"MH" => "Marshall Islands",
									"MQ" => "Martinique",
									"MR" => "Mauritania",
									"MU" => "Mauritius",
									"YT" => "Mayotte",
									"MX" => "Mexico",
									"FM" => "Micronesia, Federated States of",
									"MD" => "Moldova, Republic of",
									"MC" => "Monaco",
									"MN" => "Mongolia",
									"ME" => "Montenegro",
									"MS" => "Montserrat",
									"MA" => "Morocco",
									"MZ" => "Mozambique",
									"MM" => "Myanmar",
									"NA" => "Namibia",
									"NR" => "Nauru",
									"NP" => "Nepal",
									"NL" => "Netherlands",
									"AN" => "Netherlands Antilles",
									"NC" => "New Caledonia",
									"NZ" => "New Zealand",
									"NI" => "Nicaragua",
									"NE" => "Niger",
									"NG" => "Nigeria",
									"NU" => "Niue",
									"NF" => "Norfolk Island",
									"MP" => "Northern Mariana Islands",
									"NO" => "Norway",
									"OM" => "Oman",
									"PK" => "Pakistan",
									"PW" => "Palau",
									"PS" => "Palestinian Territory, Occupied",
									"PA" => "Panama",
									"PG" => "Papua New Guinea",
									"PY" => "Paraguay",
									"PE" => "Peru",
									"PH" => "Philippines",
									"PN" => "Pitcairn",
									"PL" => "Poland",
									"PT" => "Portugal",
									"PR" => "Puerto Rico",
									"QA" => "Qatar",
									"RE" => "Reunion",
									"RO" => "Romania",
									"RU" => "Russian Federation",
									"RW" => "Rwanda",
									"SH" => "Saint Helena",
									"KN" => "Saint Kitts and Nevis",
									"LC" => "Saint Lucia",
									"PM" => "Saint Pierre and Miquelon",
									"VC" => "Saint Vincent and The Grenadines",
									"WS" => "Samoa",
									"SM" => "San Marino",
									"ST" => "Sao Tome and Principe",
									"SA" => "Saudi Arabia",
									"SN" => "Senegal",
									"RS" => "Serbia",
									"SC" => "Seychelles",
									"SL" => "Sierra Leone",
									"SG" => "Singapore",
									"SK" => "Slovakia",
									"SI" => "Slovenia",
									"SB" => "Solomon Islands",
									"SO" => "Somalia",
									"ZA" => "South Africa",
									"GS" => "South Georgia and The South Sandwich Islands",
									"ES" => "Spain",
									"LK" => "Sri Lanka",
									"SD" => "Sudan",
									"SR" => "Suriname",
									"SJ" => "Svalbard and Jan Mayen",
									"SZ" => "Swaziland",
									"SE" => "Sweden",
									"CH" => "Switzerland",
									"SY" => "Syrian Arab Republic",
									"TW" => "Taiwan, Province of China",
									"TJ" => "Tajikistan",
									"TZ" => "Tanzania, United Republic of",
									"TH" => "Thailand",
									"TL" => "Timor-leste",
									"TG" => "Togo",
									"TK" => "Tokelau",
									"TO" => "Tonga",
									"TT" => "Trinidad and Tobago",
									"TN" => "Tunisia",
									"TR" => "Turkey",
									"TM" => "Turkmenistan",
									"TC" => "Turks and Caicos Islands",
									"TV" => "Tuvalu",
									"UG" => "Uganda",
									"UA" => "Ukraine",
									"AE" => "United Arab Emirates",
									"GB" => "United Kingdom",
									"US" => "United States",
									"UM" => "United States Minor Outlying Islands",
									"UY" => "Uruguay",
									"UZ" => "Uzbekistan",
									"VU" => "Vanuatu",
									"VE" => "Venezuela",
									"VN" => "Viet Nam",
									"VG" => "Virgin Islands, British",
									"VI" => "Virgin Islands, U.S.",
									"WF" => "Wallis and Futuna",
									"EH" => "Western Sahara",
									"YE" => "Yemen",
									"ZM" => "Zambia",
									"ZW" => "Zimbabwe");

                          $cont =  ksort($countries);
                      foreach($countries as $key => $value) {

					?>
					<option value="<?= $value ?>" title="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($value) ?></option>
                     <?php }
 
			     	?>
			     

			     </select>
			     <div class="error country">error</div>
			    </div>


			     <div class="col">
                 <label>gender</label>
			     <select name="gender">
			     	<option>...</option>
			     	<option value="male">Male</option>
			     	<option value="female">Female</option>
			     </select>
			     <div class="error gender">error</div>
			    </div>

			    <div class="col">
			      <input type="email" class="form-control" placeholder="Email" name="email" maxlength="100" minlength="15">
			      <div class="error email">error</div>
			    </div>

                <div class="col">
			      <input type="password" class="form-control" placeholder="Password" name="password" maxlength="100" minlength="6">
			      <div class="error password">error</div>
			    </div>

			    <div class="col">
			      <input type="password" class="form-control" placeholder="Confirm password" name="confirm_password">
			      <div class="error repassword">error</div>
			    </div>
                <div class="col">
                	<button type="button" class="btn btn-primary" name="sign_up">Sign Up</button>
                </div>
			  </div>
			</form>

	  </div> <!-- End sign_up_form -->

   </div>  <!-- End sign_Up -->

<script type="text/javascript" src="../js/main.js"></script>

</body>
</html>