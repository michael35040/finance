<?php
// Include the library
require('simple_html_dom.php');

// Retrieve the DOM from a given URL
$html = file_get_html('http://www.kitco.com/mobile/');

// Extract all text from a given cell
$gold["bid"] = $html->find('td[align="center"]', 4)->plaintext.'<br><hr>'; 
$gold["ask"] = $html->find('td[align="center"]', 5)->plaintext.'<br><hr>'; 
$gold["change"] = $html->find('td[align="center"]', 7)->plaintext.'<br><hr>'; 
$silver["bid"] = $html->find('td[align="center"]', 9)->plaintext.'<br><hr>'; 
$silver["ask"] = $html->find('td[align="center"]', 10)->plaintext.'<br><hr>';
$silver["change"] = $html->find('td[align="center"]', 12)->plaintext.'<br><hr>'; 
$platinum["bid"] = $html->find('td[align="center"]', 14)->plaintext.'<br><hr>'; 
$platinum["ask"] = $html->find('td[align="center"]', 15)->plaintext.'<br><hr>'; 
$platinum["change"] = $html->find('td[align="center"]', 17)->plaintext.'<br><hr>';
$palladium["bid"] = $html->find('td[align="center"]', 19)->plaintext.'<br><hr>'; 
$palladium["ask"] = $html->find('td[align="center"]', 20)->plaintext.'<br><hr>';
$palladium["change"] = $html->find('td[align="center"]', 22)->plaintext.'<br><hr>';
$rhodium["bid"] = $html->find('td[align="center"]', 24)->plaintext.'<br><hr>'; 
$rhodium["ask"] = $html->find('td[align="center"]', 25)->plaintext.'<br><hr>';  
$rhodium["change"] = $html->find('td[align="center"]', 27)->plaintext.'<br><hr>';

/*
//To prove it works.
var_dump($gold); 
var_dump($silver); 
var_dump($platinum); 
var_dump($palladium); 
var_dump($rhodium);
*/
?>

<style>
 table {
     border-collapse: collapse;
 }
 table, td, th {
     border: 1px solid black;
 }
</style>

<table>
<thead>
 <tr>
  <th>Element</th>
  <th>Bid</th>
  <th>Ask</th>
  <th>Change</th>
 </tr>
</thead>
<tbody>
 <tr>
  <td>Gold</td>
  <td><?php echo(number_format($gold["bid"],2,".","")); ?></td>
  <td><?php echo(number_format($gold["ask"],2,".","")); ?></td>
  <td><?php echo(number_format($gold["change"],2,".","")); ?></td>
 </tr>
 <tr>
  <td>Silver</td>
  <td><?php echo(number_format($silver["bid"],2,".","")); ?></td>
  <td><?php echo(number_format($silver["ask"],2,".","")); ?></td>
  <td><?php echo(number_format($silver["change"],2,".","")); ?></td>
 </tr>
 <tr>
  <td>Platinum</td>
  <td><?php echo(number_format($platinum["bid"],2,".","")); ?></td>
  <td><?php echo(number_format($platinum["ask"],2,".","")); ?></td>
  <td><?php echo(number_format($platinum["change"],2,".","")); ?></td>
 </tr>
 <tr>
  <td>Palladium</td>
  <td><?php echo(number_format($palladium["bid"],2,".","")); ?></td>
  <td><?php echo(number_format($palladium["ask"],2,".","")); ?></td>
  <td><?php echo(number_format($palladium["change"],2,".","")); ?></td>
 </tr>
 <tr>
  <td>Rhodium</td>
  <td><?php echo(number_format($rhodium["bid"],2,".","")); ?></td>
  <td><?php echo(number_format($rhodium["ask"],2,".","")); ?></td>
  <td><?php echo(number_format($rhodium["change"],2,".","")); ?></td>
 </tr>
</tbody> 
</table>

<br>
<br>
Gold/Silver Ratio (GSR): <?php echo(number_format(($gold["bid"]/$silver["bid"]),2,".",",")); ?>
<br>
<br>

<?php $silverprice=$silver["bid"]; ?>


<table>
<thead>
<tr>
<th>Size</th>
<th>#</th>
<th>Note</th>
</tr>
</thead>
<tbody>
<tr>
 <td>Silver Fat Man</td>
 <td>$<?php echo(number_format(($silverprice*3224.74),2,".",",")); ?></td>
 <td>Fat Adult Male = 221.12lbs = 3,224.74 troy ounces</td>
</tr>

<tr>
 <td>Silver Man</td>
 <td>$<?php echo(number_format(($silverprice*2668.75),2,".",",")); ?></td>
 <td>Average Adult Male = 183lbs = 2,668.75 troy ounces</td>
</tr>
<tr>
 <td>Silver Kilogram</td>
 <td>$<?php echo(number_format(($silverprice*32.1507466),2,".",",")); ?></td>
 <td>1 Kilogram = 32.1507466  troy ounces</td>
</tr>
<tr>
 <td>Silver Pound</td>
 <td>$<?php echo(number_format(($silverprice*14.5833333),2,".",",")); ?></td>
 <td>1 pound = 14.5833333 troy ounces</td>
</tr>
<tr>
 <td>Silver Ounce</td>
 <td>$<?php echo(number_format(($silverprice*1),2,".",",")); ?></td>
 <td>1 Troy Ounce</td>
</tr>
 <td>Silver Gram</td>
 <td>$<?php echo(number_format(($silverprice/31.1034768),2,".",",")); ?></td>
 <td>31.1034768 = 1 troy ounce</td>
</tr>
<tr>
 <td>Silver Grain</td>
 <td>$<?php echo(number_format(($silverprice/480),2,".",",")); ?></td>
 <td>480 grain = 1 troy ounce</td>
</tr>
</tbody>
</table>

 
 <br>
$1 Face Value, New (0.723 ozt): <?php echo(number_format(($silverprice*.723),2,".",",")); ?>x
 <br>
$1 Face Value, Worn (0.715 ozt): <?php echo(number_format(($silverprice*.715),2,".",",")); ?>x
 <br>
$1 Face Value, Morgan/Peace (0.7734 ozt): <?php echo(number_format(($silverprice*.7734),2,".",",")); ?>x
  <br>
  Constitutional Dollar = 371.25 grains of pure silver (0.7734375 troy ounce)<br><br>

 
 <table>
 <thead>
  <tr>
   <td>Type</td>
   <td>Value</td>
   <td>ASW*</td>
   <td>Note</td>
  </tr>
 </thead>
 
 <tbody>



  <tr>
  <td>Jefferson War Nickle (1942-1945)</td>
  <td>$<?php echo(number_format(($silverprice*.0563),2,".",",")); ?></td>
  <td>0.0723 ozt</td>
  <td>56% Copper, 35% Silver, 9% Manganese</td>
 </tr>

  <tr>
  <td>Barber Dime (1892-1916)</td>
  <td>$<?php echo(number_format(($silverprice*.0723),2,".",",")); ?></td>
  <td>0.0723 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(10*.0723)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Mercury Dime (1916-1945)</td>
  <td>$<?php echo(number_format(($silverprice*.0723),2,".",",")); ?></td>
  <td>0.0723 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(10*.0723)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Roosevelt Dime (1946-1964)</td>
  <td>$<?php echo(number_format(($silverprice*.0723),2,".",",")); ?></td>
  <td>0.0723 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(10*.0723)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Barber Quarter (1892-1916)</td>
  <td>$<?php echo(number_format(($silverprice*.1808),2,".",",")); ?></td>
  <td>0.1808 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(4*.1808)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Standing Liberty Quarter (1916-1930)</td>
  <td>$<?php echo(number_format(($silverprice*.1808),2,".",",")); ?></td>
  <td>0.1808 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(4*.1808)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Washington Quarter (1932-1964)</td>
  <td>$<?php echo(number_format(($silverprice*.1808),2,".",",")); ?></td>
  <td>0.1808 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(4*.1808)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Barber Half Dollar (1892-1915)</td>
  <td>$<?php echo(number_format(($silverprice*.36169),2,".",",")); ?></td>
  <td>0.36169 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(2*.36169)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Franklin Half Dollar (1948-1963)</td>
  <td>$<?php echo(number_format(($silverprice*.36169),2,".",",")); ?></td>
  <td>0.36169 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(2*.36169)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Kennedy Half Dollar (1964)</td>
  <td>$<?php echo(number_format(($silverprice*.36169),2,".",",")); ?></td>
  <td>0.36169 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(2*.36169)),2,".",",")); ?></td>
 </tr>
  
  <tr>
  <td>Kennedy Half Dollar (1965-1970)</td>
  <td>$<?php echo(number_format(($silverprice*.1479),2,".",",")); ?></td>
  <td>0.1479 ozt</td>
  <td>40% Silver, 60% Copper; $1 Face: <?php echo(number_format(($silverprice*(2*.1479)),2,".",",")); ?></td>
 </tr>
 
  <tr>
  <td>Morgan Dollar (1878-1921)</td>
  <td>$<?php echo(number_format(($silverprice*.7734),2,".",",")); ?></td>
  <td>0.7734 ozt</td>
  <td>90% Silver, Face: <?php echo(number_format(($silverprice*.7734),2,".",",")); ?></td>
 </tr>
 
  <tr>
  <td>Peace Dollar (1921-1935)</td>
  <td>$<?php echo(number_format(($silverprice*.7734),2,".",",")); ?></td>
  <td>0.7734 ozt</td>
  <td>90% Silver, Face: <?php echo(number_format(($silverprice*.7734),2,".",",")); ?></td>
 </tr>
 
  <tr>
  <td>Eisenhower (1971-1978)</td>
  <td>$<?php echo(number_format(($silverprice*.3161),2,".",",")); ?></td>
  <td>0.3161 ozt</td>
  <td>60% Copper, 40% Silver</td>
 </tr>
 
  <tr>
  <td>American Silver Eagle (1986-Present)</td>
  <td>$<?php echo(number_format(($silverprice*1),2,".",",")); ?></td>
  <td>1 ozt</td>
  <td>99.93% Silver</td>
 </tr>
 
  <tr>
  <td>America the Beautiful 'Quarter' (2010-Present)</td>
  <td>$<?php echo(number_format(($silverprice*5),2,".",",")); ?></td>
  <td>5 ozt</td>
  <td>99.93% Silver</td>
 </tr>
 
 
 </tbody>
 </table>
 *Actual Silver Weight
 
 
 <br>
 <img src="http://www.kitco.com/images/live/silver.gif">
  <br>
  <br>
 
 <?php $silvergram=$silverprice/31.1034768; ?>
 
 
 <style type="text/css">
	table.tableizer-table {
	border: 1px solid #CCC; font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
} 
.tableizer-table td {
	padding: 4px;
	margin: 3px;
	border: 1px solid #ccc;
}
.tableizer-table th {
	background-color: #104E8B; 
	color: #FFF;
	font-weight: bold;
}
</style><table class="tableizer-table">
<tr class="tableizer-firstrow"><th>Authority</th><th>Denomination</th><th>Standard</th><th>Weight (g)</th><th>Spot $ USD</th><th>Notes</th></tr>
 <tr><td>AEGINA</td><td>didrachma</td><td>Aeginetic</td><td>12.2</td><td>$<?php echo(number_format(($silvergram*12.2),2,".",",")); ?></td><td>Cities minted a STATER or principal trade coin for large scale transactions. In Athens, the stater was a tetradrachma (17.2 g), while in Aegina the stater was a didrachma (12.2 g).</td></tr>
 <tr><td>AEGINA</td><td>drachma</td><td>Aeginetic</td><td>6.1</td><td>$<?php echo(number_format(($silvergram*6.1),2,".",",")); ?></td><td>&nbsp;</td></tr>
 <tr><td>ATHENS</td><td>Talent</td><td>Attic</td><td>25,950.00</td><td>$<?php echo(number_format(($silvergram*25950.00),2,".",",")); ?></td><td>6000 drachmae</td></tr>
 <tr><td>ATHENS</td><td>Minae</td><td>Attic</td><td>432.50</td><td>$<?php echo(number_format(($silvergram*432.50),2,".",",")); ?></td><td>100 drachmae</td></tr>
 <tr><td>ATHENS</td><td>Decadrachma</td><td>Attic</td><td>43.25</td><td>$<?php echo(number_format(($silvergram*43.25),2,".",",")); ?></td><td>10 drachmae</td></tr>
 <tr><td>ATHENS</td><td>Tetradrachma</td><td>Attic</td><td>17.20</td><td>$<?php echo(number_format(($silvergram*17.20),2,".",",")); ?></td><td>4 drachmae</td></tr>
 <tr><td>ATHENS</td><td>Tridrachma</td><td>Attic</td><td>12.90</td><td>$<?php echo(number_format(($silvergram*12.9),2,".",",")); ?></td><td>3 drachmae</td></tr>
 <tr><td>ATHENS</td><td>Didrachma</td><td>Attic</td><td>8.60</td><td>$<?php echo(number_format(($silvergram*8.6),2,".",",")); ?></td><td>2 drachmae</td></tr>
 <tr><td>ATHENS</td><td>Drachma</td><td>Attic</td><td>4.30</td><td>$<?php echo(number_format(($silvergram*4.3),2,".",",")); ?></td><td>6 obols</td></tr>
 <tr><td>ATHENS</td><td>tetrobol</td><td>Attic</td><td>2.87</td><td>$<?php echo(number_format(($silvergram*2.87),2,".",",")); ?></td><td>4 obols</td></tr>
 <tr><td>ATHENS</td><td>tribobol*</td><td>Attic</td><td>2.15</td><td>$<?php echo(number_format(($silvergram*2.15),2,".",",")); ?></td><td>3 obols; *The triobol was also called a hemidrachma or half-drachma.</td></tr>
 <tr><td>ATHENS</td><td>diobol</td><td>Attic</td><td>1.43</td><td>$<?php echo(number_format(($silvergram*1.43),2,".",",")); ?></td><td>2 obols</td></tr>
 <tr><td>ATHENS</td><td>obol</td><td>Attic</td><td>0.72</td><td>$<?php echo(number_format(($silvergram*0.72),2,".",",")); ?></td><td>1 obol</td></tr>
 <tr><td>ATHENS</td><td>hemiobol</td><td>Attic</td><td>0.36</td><td>$<?php echo(number_format(($silvergram*0.36),2,".",",")); ?></td><td>1/2 obol</td></tr>
 <tr><td>CORINTH</td><td>didrachma</td><td>Attic</td><td>8.6</td><td>$<?php echo(number_format(($silvergram*8.6),2,".",",")); ?></td><td>&nbsp;</td></tr>
 <tr><td>CYZICUS</td><td>electrum stater</td><td>Phocaic</td><td>16.01</td><td>$<?php echo(number_format(($silvergram*16.01),2,".",",")); ?></td><td>ELECTRUM (an alloy of gold and silver)</td></tr>
 <tr><td>LYDIA</td><td>electrum stater</td><td>Persic</td><td>14.2</td><td>$<?php echo(number_format(($silvergram*14.2),2,".",",")); ?></td><td>ELECTRUM (an alloy of gold and silver)</td></tr>
 <tr><td>LYDIA</td><td>gold stater</td><td>Persic</td><td>10.9</td><td>$<?php echo(number_format(($silvergram*10.9),2,".",",")); ?></td><td>&nbsp;</td></tr>
 <tr><td>LYDIA</td><td>silver stater</td><td>Persic</td><td>5.55</td><td>$<?php echo(number_format(($silvergram*5.55),2,".",",")); ?></td><td>&nbsp;</td></tr>
 <tr><td>PERSIA</td><td>gold daric</td><td>Persic</td><td>8.35</td><td>$<?php echo(number_format(($silvergram*8.35),2,".",",")); ?></td><td>The Persian king minted a gold DARIC exchanged against 20 silver SIGLOI (and the equivalent of 25 Attic drachmae).</td></tr>
 <tr><td>PERSIA</td><td>Silver siglos</td><td>Persic</td><td>5.35</td><td>$<?php echo(number_format(($silvergram*5.35),2,".",",")); ?></td><td>The Persian king minted a gold DARIC exchanged against 20 silver SIGLOI (and the equivalent of 25 Attic drachmae).</td></tr>
 <tr><td>PHOENICIA</td><td>stater</td><td>Phoenician</td><td>13.9</td><td>$<?php echo(number_format(($silvergram*13.9),2,".",",")); ?></td><td>214.5 grains; double shekel use in Tyre: 1 stater=2 shekels</td></tr>
 <tr><td>PHOENICIA</td><td>shekel</td><td>Phoenician</td><td>7</td><td>$<?php echo(number_format(($silvergram*7),2,".",",")); ?></td><td>&nbsp;</td></tr>
 <tr><td>SYRACUSE</td><td>decadrachma</td><td>Attic</td><td>43.25</td><td>$<?php echo(number_format(($silvergram*43.25),2,".",",")); ?></td><td>&nbsp;</td></tr>
 <tr><td>SYRACUSE</td><td>tetradrachma</td><td>Attic</td><td>17.2</td><td>$<?php echo(number_format(($silvergram*17.2),2,".",",")); ?></td><td>&nbsp;</td></tr>
 <tr><td>SYRACUSE</td><td>drachma</td><td>Attic</td><td>4.3</td><td>$<?php echo(number_format(($silvergram*4.3),2,".",",")); ?></td><td></td></tr>
</table>

<br>
 *A roman talent was 32.3 kilograms, an Egyption talent was 27 kilograms, a Babylonian talent was 30.3 kilograms. The heavy common talent used in the New Testiment was 58.9 kilograms.
Cities premised their currency upon a drachma of varying weight so that coins were exchanged in the market according to their weight. The four crucial standards were the AEGINETIC (employed by the island polis Aegina and cities of the Peloponnesus and Central Greece), the ATTIC or EUBOIC (employed by Athens, Corinth, Sicilian colonies, and cities in the Aegean), the PERSIC, the standard of the Lydian kings (employed by the Great King of Persia and the Asian Greeks), and the Phoenician standard used in the Levant.



<br>
*An Attic Talent of silver was the value of nine man-years of skilled work in 377 BC (11.1 grams of silver per workday).
<br>
*During the Peloponnesian War, an Attic Talent was the amount of silver that would pay a months wages of a trireme crew of 200 rowers (4.3grams of silver per rower per day).
<br>
*Hellenistic mercenaries were commonly paid one drachma per day of military service. There were 6,000 drachme in an Attic Talent.
<br>
*The Babylonians, Sumerians, Hebrews, and Greek divided a Telent into 60 mina. Then 1 mina into 60 shekels. A Greek mina was 434(+/-3)g. A Roman Talent is 1.25 Greek Talents. 
<br>
*In 1800 a building craftsman in urban Europe got an average wage of 11.9 grams of silver a day.
<br>
*Ancient Babylon, workers earned 2.1 grams silver a day. Sheep ranged from 2.6g to 16g silver.
<br>
*Carpenter in Egypt in 709AD maid 16 nomismata annually. 1 nomismata=1 dinar = 3.9g pure gold = 58.5 grams of silver
<br>
*Average Roman Soldier
<br>

<br>
<b>Ancient Prices</b>
<br>
Before delving into the discussion of silver’s historical value, a few starting conditions are important to understand. First, it’s difficult to equate modern and ancient labor. A lot of labor in ancient times was performed by slaves and the translations of “laborer” or “craftsman” into modern terms is imprecise at best, as are concepts like the length of a normal workday. Likewise, prices can be skewed by the more primitive state of trade – modern conveniences like wine and spices seem quite expensive in medieval England, but part of that is clearly due to the fact that they weren’t produced in England and long trade routes and/or wars took their toll on prices.
Going back to ancient Babylon, we know that workers earned the equivalent of about 2.1 grams of silver per day (about 1/15 of an ounce or a little more than $2 in today’s silver prices). At that time, the price of a sheep ranged from 2.6 g to 16 g of silver (about $2 to $16 in today’s prices), which compares to recent prices of about $90 to $120.
Apparently it was better to be a laborer in ancient Greece, as typical wages were about 1 attic drachma (4.3 g of silver) in the fifth century and about 2.5 drachmai by 377. In the fifth century, a drachma would buy you approximately 3 kg of olive oil and three drachmai would buy you a medimnos of wheat (about 54 liters). While the price of that medimos climbed to 5 drachmai by the 4th century, it basically still worked out that a day’s labor would buy about two weeks worth of food for one person (if they lived on bread alone).
The Romans may have brought many valuable inventions to the world, but debasement and serious inflation are inventions that humanity probably could have done without. Although the Roman day wage of 1.2 denarii (4.2 g of silver) was pretty consistent with wages during the time of the Greeks, there was huge inflation and debasement from the time of Nero through Diocletian and beyond. As the Romans gutted the silver content of the denarius from 3.5 g of 98% silver to 3.4 g of 94% silver on down to 40% and then almost nothing, the price of a “measure” of wheat soared by about 15,000 times over about 250 years [see also Preparing For Economic Headwinds: Bill Gross’ Commodity Picks].
<br>
<b>The Medieval Times</b>
<br>
While the medieval period saw a pronounced increase in trade and the growth of cities, it was also marked by wars and plagues that significantly depopulated large swathes of Europe. In many cases, depopulation led to pressures for higher wages and the nobility often fought back with wage controls.
Around 1300 AD, a laborer in England could expect two earn about 2 pounds sterling in a year, or about 672 g of silver (about 2.1 g of silver per day, given the different workweek of medieval times). Likewise, we know a thatcher in 1261 could look to earn about 2 pennies a day or 2.8 g of silver. Thatchers’ pay increased to about 3 pence (approximately 4.2 g of silver) in 1341, 4 pence in 1381, and 6 pence in 1481. Along the way, a city “craftsman” could look to earn about 4 pence a day in the 1350s.
So what would those wages buy? In the early 14th century, wine cost between 3 pence and 10 pence per gallon in England, and two dozen eggs could be had for 1 pent. Some time later, an axe cost about 5 pence in mid-15thcentury England, while wheat cost about 0.2 g of silver per liter (not much different than the per-liter price in ancient Greece).
<br>
<b>The Industrial Age</b>
<br>
By the 18th and 19th centuries, the use of paper money was increasingly common alongside silver and gold coins. What’s more, the price of gold and silver were increasingly fixed and stable for long stretches of time. Sir Isaac Newton fixed the price of gold in 1717, and it pretty much stayed at that at the price (excluding the years of the Napoleonic Wars) until World War 1 [see also 3 Metals Outshining Gold].
Likewise, the price of silver more or less stayed at about $1.30/oz from the founding of the U.S. through the Civil War. Prices were exceptionally turbulent during the Civil War (rising to nearly $3/oz) and stayed above $1.30/oz until the late 1870s. Prices generally declined through the latter years of the 19th century, dipping below $0.60/oz in 1897, and mostly hovered in the $0.50s through to World War I. From a low of about $0.25/oz in 1932, silver generally climbed thereafter – moving above $0.70/oz after World War II, moving past $0.80/oz in 1950, and crossing $1/oz in 1960.
Silver jumped alongside gold throughout the 1970s, and spiked to $50 an ounce in January of 1980 as the Hunt brothers (Nelson Hunt and William Hunt) manipulated silver in an attempt to corner the market. Silver crashed shortly thereafter, hitting $8 in 1981, $6 in 1986, and dropping below $4 in the early 1990s. Silver has since rallied through the late ’90s and the first decade of the 21st century, and currently sits around $33 an ounce.
Tracing the path of wages, we have an average wage of about $1 per day in the latter part of the 19th century, or about 25 g of silver. When Henry Ford revolutionized the auto industry (and how companies viewed wages) in 1914 and offered $5/day (about 10oz of silver), the average daily wage was about $2.34 per day.
When federal minimum wages began in 1938, the nominal value of those wages were about $2/day (or more than 4.5 ounces). Those wages climbed to about $16 per day in 1974 (about 3.6 ounces of silver) to $58 today (or about 1.75 ounces of silver). Said differently, today’s minimum wage buys about 13 times the amount of silver that the average daily wage in ancient Greece bought.
<br>
<b>The Future</b>
<br>
Silver’s value throughout history has always been volatile, as the supply of labor, foodstuffs and consumer goods waxed and waned with wars, trade growth and technological innovation. Given how modern governments view monetary policy as something of a panacea, though, it seems like ongoing inflation is a pretty safe bet.
It is worth asking whether the price of silver stacks up as fair. For more than 2,000 years, somewhere between 1/10th and 1/15th of an ounce of silver would buy you a day’s labor; in today’s terms, that would suggest that silver should trade for $264, if U.S. wages should be seen as the global standard. By way of comparison, minimum wages in China’s Guangdong province (an area with extensive manufacturing activity) would work out to about $6/day on average or about 5.6 g of silver – about half the wages in 4th century Greece, so it really is a case of what you consider to be the representative global wage [see also Doomsday Special: 7 Hard Assets You Can Hold In Your Hand].
It is also interesting to see that the value of gold today is more than 50-times that of silver, even though the actual ratio of production and global reserves suggests that such a spread is at least 3-times wider than it should be. In any event, investors should continue to expect silver prices to be volatile and inconsistent, irrespective of whether governments start pursuing sounder monetary policy.
<br>


<br>
<b>Average Wage</b>
<br>
Building Craftsman (1850-1899): 24g
<br>
Laborers (1850-1899): 13.8g
<br>
Building Craftsman (1900-1913): 63.9g
<br>
Laborers (1900-1913): 39.5g
<br>
*1850 Comstock Lode Discovery
<br>
<br>
<b>Wanlockhead in 1844: 12 pence = 1 shilling; 20 shilling = 1 pound.</b>
<br>
Miners 60p week
<br>
Smelters 70p week
<br>
Average wage in 1850 was 18 pence
<br>

<br>
"Drachma - equivalent to one day's wages for manual labor (1/8oz Ag)"
<br>
"1 silver stater = 4 drachma = approx. 3.5 denarii"
<br>
"...[A]n average Roman soldier was paid one denarius for each day of service. Each denarius was 1/10th of an ounce, or about $3.00 a day, which is comparable to the world’s average daily pay. That valuation lasted for hundreds of years for basic labor. So now when you hear, “brother can you spare a (silver) dime?” you know that it meant a day’s wages."
<br>
"Later, skilled craftsman pushed that wage to almost an ounce a day. Henry Ford pushed that wage to an unbelievable $5 a day or 3.6 ounces a day which was seen as excessive at the time. Today an average worker makes, let’s say, $100 a day. If there was some economic reality in the system, like real money, a 1/10th of an ounce would equal a day’s wages of $100. Therefore an ounce of silver should be about $1,000 an ounce, a far cry from today’s price of $30."
<br>
"Some other historical reference points include Jesus being sold out by Judas Iscariot for 30 shekels, or ~12 ounces of silver. Can you imagine selling out your friend, much less Jesus Christ, for $350 bucks? What if we had $1,000 ounce silver? For $12,000, there are a lot of people who would do the deed. (Isn’t that close to the price hit men charge, in movies?)"
<br>
"It is also interesting to note that was the same value for a slave at the time."
<br>
"In the Bible, plots of land were bought, anywhere from 50 ounces to 200 ounces of silver. Good luck finding average properties for $1,250 to $5,000 a piece. But again, what if silver was $1,000 an ounce? Finding properties from $50,000 to $200,000 is a snap. So the purpose of this exercise is to see the ratio between a known silver amount and a known asset. When you take away the manipulated measuring stick of the dollar, the only way to compare an assets value is to compare assets to other assets. So, right now, it may cost you 2,000 to 8,000 ounces of silver to buy a plot of land. If we have a reversion to the mean, and our debt/money system collapses, you should be able to pick up land for 50 to 200 ounces. I really think that even this is too high...."
<br>
"Shekel; weighs about 12 grams; about 0.4 troy ounce. As of Jan, 2012, with silver at $30/oz, that would be about $6 per shekel"
<br>
"30 shekels, the amount Judas was paid to betray Jesus, would have been about 11 troy ounces of silver..."
<br>
 
 <br>
 
 
 
 
 
 <hr>
 
 
 
 
<span><a href="/topics/fed">The Fed</a></span>
 
<span><a href="/topics/legal-system">Legal System</a></span>
 
<span><a href="/topics/us-history">U.S. History</a></span>
 
 
<span><a href="/austrian-school/money-and-banking">Money and Banking</a></span>
 </p><div class="body-content">

<img alt="" src="http://images.mises.org/DailyArticleBigImages/4149.jpg" />
 
<p>Are you aware that a Federal Reserve dollar bill is not a constitutional dollar? Perhaps you are, but if so, do you know what a constitutional dollar literally is? Is it gold? Is it silver? Is it both? What is actually meant by a metal standard? Can the United States or any country be on two standards at the same time? Can two metals circulate as coin if there is but one standard? Or does one metal have to drive the other out of circulation? How and why does <a href="http://mises.org/money/3s5.asp">Gresham&#39;s law</a> work when a country uses metal coin for money? In what ways are certain statements of Gresham&#39;s law misleading?</p>
 
<p>Sooner or later, if and when the power of the Federal Reserve over money is revoked in a constitutional manner, and if and when constitutional coin comes back into use, these questions will need to be asked, answered, and understood. That is what this article does in a compact fashion.</p>
<p>In his meticulously researched two-volume work, <em>Pieces of Eight</em>, constitutional lawyer Edwin Vieira Jr. shows beyond any doubt that the constitutional dollar in the United States is an &quot;historically determinate, fixed weight of fine silver.&quot; The Coinage Act of 1792 is but one source among many that makes this evident, reading,</p>
 <blockquote>
<p>&quot;the money of account of the United States shall be expressed in dollars or units &hellip; of the value [mass or weight] of a Spanish milled dollar as the same is now current, and to contain three hundred and seventy-one grains and four sixteenth parts of a grain of pure &hellip; silver.</p></blockquote>
<p>The United States has a legal and constitutional silver standard, although we would not know it today, since the government has illegally and unconstitutionally removed silver as currency and replaced it with the Federal Reserve notes that we know as dollar bills. The term &quot;dollar bills&quot; obscures the actual and tangible meaning of &quot;dollar&quot; as a specific weight of silver.</p>
<p>The United States has historically minted gold coins as well as silver coins, as the constitution instructed. It regulated their &quot;value,&quot; the weight of gold they contained, in order to bring the meaning of a gold dollar into conformity with the silver standard coin, which contains 371.25 grains of pure silver. This too was constitutionally mandated. The government did the same for foreign coins up until 1857.</p>
<p>The United States never was or could be constitutionally on a dual standard or a gold standard. It circulated silver and gold coins as media of exchange by adjusting the content of the gold dollar to a silver-standard dollar. For example, the Coinage Act of 1792 authorizes &quot;Eagles &mdash; each to be of the value of ten dollars or units [i.e., of ten silver dollars], and to contain two hundred and forty-seven grains, and four eighths of a grain of pure &hellip; gold.&quot; Since the dollar contained 371.25 grains of silver, this brought into legal equivalence 3712.5 grains of silver and 247.5 grains of gold. The ratio was 1:15.</p>
<p>In the Coinage Act of 1834, Congress adjusted the gold eagle: &quot;Each eagle shall contain two-hundred and thirty-two grains of pure gold.&quot; This brought into legal equivalence 3712.5 grains of silver and 232 grains of gold. The ratio was 1:16. The reason for the change was that gold had appreciated in market value relative to silver.</p>&quot;If a dollar is made to be 1 oz of gold and also 16 oz of silver, what is a dollar when those metals no longer exchange at that ratio?&quot;
<p>Old coins could be brought in and reminted for free (after waiting 40 days.) If old coins were not reminted, they were to be accepted as payments &quot;at the rate of ninety-four and eight-tenths of a cent per pennyweight.&quot; The weights of the earlier and later eagles were influenced by a change in the standard gold alloy. The rate of 94.8 cents per pennyweight took that change as well as the alteration in the pure gold content into account, so that payments made in either the old or the new coins became very nearly equivalent in terms of the amounts of pure gold being paid.</p>
<p>With this as an introduction, let us go on to an explanation of Gresham&#39;s law and the reason why Congress was constitutionally mandated to make such adjustments in the weight of gold in the gold-dollar coin.</p>
<p>Suppose that the dollar is defined as a unit that contains 371.25 grains of silver, and suppose that the unit is physically identified with a specific silver coin that contains that mass of silver. Since grains are unfamiliar units, let us use ounces. Let us note that There are 480 grains in one troy ounce. Hence, 371.25 grains weighs 0.7734375 oz. That is to say that if a silver-dollar standard is officially and constitutionally instituted, with each dollar having the mass of 371.25 grains of silver, this means that the dollar is defined as containing 0.7734375 troy ounces of silver.</p>
<p>In all nonfraudulent exchanges involving dollars, someone who pays or receives a dollar is supposed to pay or receive that mass (or loosely weight) of silver in coin or its equivalent in bullion (bars or ingots). The dollar sign, &quot;$,&quot; in such a regime means 1 silver dollar of the official weight of 0.7734375 troy ounces of pure silver. The word &quot;dollar&quot; means the silver coin of that specific mass.</p>
<p>A standard is something that is unchanging. A yard always has 36 inches. A pound always has 16 ounces. A standard, constitutional dollar always has the same amount of the metal that is chosen as its definition, until the constitution is amended to alter the standard, or unless the constitution allows the legislature to alter the standard.</p>
<p>Economically, there can only be a single such standard dollar at a time. One cannot simultaneously have the dollar mean a certain amount of silver and another amount of gold. An economy cannot have two concurrent and different standards of the dollar. The reason for this is that, as will now be discussed, the relative prices of any two metals fluctuate over time.</p>
<p>The exchange rates of gold for silver vary over time due to the changing supplies and demands for these metals in markets. At one time, 1 oz of gold may exchange for 16 oz of silver, while at another time it may exchange for 25 oz of silver. These fluctuations go on unceasingly.</p>
<p>If an attempt is made to define a dollar by two standards simultaneously, it will fail. If a dollar is made to be 1 oz of gold and also 16 oz of silver, what is a dollar when those metals no longer exchange at that ratio? What is a dollar when they exchange at 1 oz of gold to 25 oz of silver? There is no answer. There is no answer because the dollar cannot simultaneously be two different weights of two different metals whose rates of exchange vary over time. One or the other of the two metals has to be chosen as a standard.</p>
<p>Fluctuations occur in the market even if the government sets an official rate of exchange between the two metals, which is what was done in the various coinage acts. The government can attempt to force a given exchange rate, but this will not alter the fact that the market exchange rate departs from the forced exchange rate. The result of a discrepancy between legal and market rates of exchange will be that one of the metals will disappear from circulation. That result comes under the heading of Gresham&#39;s law in operation.</p>
<p>There are two ways that the government can, without the direct use of force, keep both silver and gold circulating as money even if only one of them is the standard. One way is to regulate the value of the official gold dollar as time passes, which means to change the official rate of exchange between gold and silver in order to bring it into accord with the market rate of exchange. That is what the coinage acts did.</p>
<p>The other way is to avoid using a gold dollar altogether and produce gold coins that have a known weight but no designation as a dollar. The gold coin can &quot;float&quot; or have a changing price against the silver-standard dollar. This method was not used but it could and should be used in the future if and when the constitutional silver dollar is restored as the unit of account.</p>
<p>Let us examine in more detail how a money standard, such as the silver standard, works; and then let us examine Gresham&#39;s law.</p>&quot;Gresham&#39;s law is an application of the idea that money machines do not exist in equilibrium, that there is no free lunch, and that risk-free arbitrage opportunities do not exist in equilibrium.&quot;
<p>Suppose that there is a single silver standard: that of a dollar containing 0.7734375 oz of silver. Suppose also that at some specific time, the price of a troy ounce of gold in terms of silver is $16 in the market. This means that 1 oz of gold exchanges in the market for 16 silver dollars, each dollar containing 0.7734375 oz of silver. That is, 1 oz of gold exchanges for 12.375 oz of silver.</p>
<p>Now suppose that the government issues a gold coin. If an official gold coin is made that says it is a $16 gold coin, stamped literally 16 dollars, it will contain 1 troy ounce of gold, worth exactly $16, that is, worth 16 silver dollars. Suppose that the government goes one step further: it makes this exchange rate the official rate, such that in debt contracts one is permitted to pay either 16 silver dollars or 1 of these gold coins.</p>
<p>The official exchange rate is 1/16 oz of gold per silver dollar. The silver standard and accompanying law make silver a legal payment or legal tender in debt contracts, unless perhaps the private parties to the contract are allowed to specify otherwise. With gold&#39;s price officially fixed at 1 oz per 16 silver dollars, then gold at that price is also a legal tender in payment of debts. The government in this example is attempting to keep both gold and silver in circulation by making the official rate the same as the market rate.<a class="noteref" href="#note1" name="ref1">[1]</a></p>
<p>In the unlikely case that the market price of gold remains at $16 indefinitely, this gold coin provides a substitute or equivalent to the silver standard, even though there is but a single standard. If this market ratio prevails through time, staying at the official rate, there is no real difference between gold and silver for payment purposes. In this situation, one can think in terms of either a silver or a gold standard, even though there is really only a single standard. There is no significant difference.</p>
<p>However, this situation never actually occurs. Market prices do change. A single standard then becomes essential in an economic sense if the dollar is to retain a clear definition as a standard. The silver standard fixes the dollar at 371.25 grains of silver, no matter what happens to the market price of gold in terms of silver. If the relative prices of silver and gold change, that shows up in a change solely in the price of gold. This will make the &quot;16 dollar&quot; designation on the gold coin obsolete from a market point of view, but not from an official point of view.</p>
<p>This disparity will set in motion certain events that we now look into. These events are certain to occur because the discrepancy between the market and official rates will create a profit incentive.</p>
<p>Consider two examples in which the market prices deviate from the official exchange ratio. The first example occurs when gold rises in price relative to silver. Suppose that 1 oz of gold becomes able to buy 20 silver dollars in the market. The market exchange ratio becomes 0.05 oz of gold per silver dollar, while the official rate is still 0.0625 oz of gold per silver dollar. The gold piece becomes more valuable. An ounce of gold now exchanges for 15.46875 oz of silver, which is the amount of silver in 20 silver dollars. At the official rate, it exchanges for only 12.375 oz of silver.</p>
<p>Now we explore the profit opportunity that lies at the heart of Gresham&#39;s law: If someone owes 16 dollars and can pay in either silver or gold coins, which will they chose? Will it be silver or gold? Intuitively, one pays with the less expensive metal, which is silver. One holds gold off the market and instead uses silver for payments. The more expensive metal disappears from circulation as money or coin, although it will continue to be used for jewelry, teeth, and industrial applications.</p>
<p>The official contractual rate in debt contracts calls for either 16 silver dollars or 1 gold coin. But 1 gold coin now exchanges for 20 silver dollars in the market. If a person possesses 1 gold coin, he can buy 20 silver dollars in the market by ignoring the official rate of exchange. He can then pay the debt with 16 of these silver dollars and have 4 silver dollars left over. This is clearly preferable to paying out the entire gold coin to satisfy the debt, since he gets rid of the debt and still has 4 dollars left over. Hence, he will pay at the official rate in silver dollars, not in gold coins.</p>
<p>This situation contains a risk-free arbitrage (or profit) opportunity. Exploiting it drives gold out of circulation as money. For example, suppose a person starts by borrowing 1 gold coin. He then buys 20 silver dollars and keeps 4 of them. He then repays the loan of the gold coins with 16 silver dollars, since they are legal tender. He can repeat this operation again and again to augment his pile of free silver. This is a money machine &mdash; a risk-free arbitrage &mdash; in which one party gains and the other loses.</p>
<p>The lender of gold coins is obeying the law by honoring the official exchange rate, but he is losing on this deal since the 16 silver dollars that he is repaid cannot buy 1 gold coin in the market. He will stop lending gold coins. He will put an end to the money machine. This is why finance theories typically assume that assets are priced so as to preclude risk-free arbitrage opportunities.</p>&quot;One hears Gresham&#39;s law stated as &#39;bad money drives out good.&#39; This is misleading, confusing, and erroneous. In the example of gold appreciating and disappearing, silver is by no means &#39;bad money,&#39; nor is gold &#39;good money&#39;.&quot;
<p>Let us think of this in another way, which is in terms of exchange rates. An exchange rate when silver is the standard is expressed as a number of ounces of gold per silver dollar. When gold appreciates in price relative to silver, the exchange rate falls. That is, less gold is required to exchange for each silver dollar. In the example above, one can satisfy the debt at the official exchange rate of 0.0625 oz of gold per silver dollar, whereas the silver dollar fetches only 0.05 oz of gold in the market. Silver that is used to extinguish debt has a greater value than silver that is used to buy gold in the market as coin. Therefore, silver will be used for payments of debt and all other exchanges, not gold.</p>
<p>The result of gold having appreciated in price relative to silver and thus of the market rate of exchange of gold for silver having fallen below the official rate of exchange (0.05 oz of gold per silver dollar as opposed to 0.0625 oz of gold per silver dollar) is that gold will disappear from circulation as payments. This is an example of Gresham&#39;s law.</p>
<p>When two metals are legal tender at an official rate of exchange and one metal&#39;s market price increases, that metal (here gold) will disappear from circulation as money. Gresham&#39;s law is an application of the idea that money machines do not exist in equilibrium, that there is no free lunch, and that risk-free arbitrage opportunities do not exist in equilibrium.</p>
<p>There is another way of describing what happens when gold appreciates in price relative to silver, but the official rate is lower: One could say that the official exchange rate undervalues gold. The undervalued metal disappears from circulation.</p>
<p>This language is misleading and confusing, however. Is silver overvalued? It seems natural to conclude that silver is overvalued if gold is undervalued. However, silver is not overvalued. Silver cannot possibly be overvalued because it is the standard being used to define the dollar.</p>
<p>Despite the very great drawback introduced by the terms &quot;undervalued&quot; and &quot;overvalued&quot; in this context, they have been common in debates on bimetallism. These terms have contributed to confusion, erroneous analysis, and policy blunders with costly consequences, because they obscure the reality that one metal is always the standard. In the United States, that constitutional metal has always been silver.</p>
<p>One also hears Gresham&#39;s law stated as &quot;bad money drives out good.&quot; This too is misleading, confusing, and erroneous. In the example of gold appreciating and disappearing, silver is by no means &quot;bad money,&quot; nor is gold &quot;good money.&quot; There is no good and bad money at all. Silver is the metal being used as the standard. It has not driven gold or good money out of circulation. The fixed exchange rate of gold set at too high a level compared to the going market rate has driven gold out of exchange.</p>
<p>For completeness, we consider the opposite case in which gold depreciates relative to the silver standard. Suppose that the market exchange rate rises from 0.0625 oz to 0.076923 oz of gold per silver dollar, which means that one ounce of gold now trades for 13 silver dollars. Suppose that a debt of $16 is to be paid. A person can pay in either silver or gold dollars. This again requires 1 gold coin at the official rate. The cost of that coin in the market is 13 silver dollars. If one had 16 silver dollars, one could use 13 of them to buy 1 gold dollar in order to pay off the debt. One would then have 3 silver dollars left over. Therefore, it&#39;s less expensive to pay the debt with gold.</p>
<p>Gresham&#39;s law again goes to work. Silver disappears from circulation. When two metals are legal tender at an official rate of exchange and one metal&#39;s market price depreciates in terms of the metal used as a standard (silver), that depreciated metal (gold) will circulate, and the other metal (silver) will disappear from circulation as a medium of exchange while maintaining its role as a medium of account.</p>
<p>In practice, a rather small depreciation of gold (1&ndash;3 percent) is enough to cause silver coins to disappear from circulation. Suppose we start with an official and market ratio of silver to gold at which there is the equivalent of 0.05 oz of gold in one silver dollar. This means that 1 silver dollar buys exactly $1 worth of gold at the official and market rate, and that 20 silver-dollar coins buy 1 gold coin that weighs 1 oz and is worth 20 times as much as the silver in one silver dollar.</p>&quot;The solution to all this is straightforward. Choose one metal as a standard and allow the price of the other metal to fluctuate freely or float in the market.&quot;
<p>Suppose now that the market price for gold declines such that 0.051 oz of gold buys 1 silver dollar. This is a 2-percent increase in the market exchange ratio. At the official exchange rate of 20 silver dollars per gold coin, the 0.051 oz of gold is worth 0.051 &times; 20 = $1.02 (i.e., 1.02 silver dollars.) If a person had to pay $1, it would be better to pay it in the less-expensive metal (here gold), at the official rate of 0.05 oz of gold per dollar. People will thus tend to use gold for exchanges and hold silver off the market.</p>
<p>If small changes drive one metal or the other out of circulation, the government has to adjust the official exchange rates frequently if both are to be kept in circulation. This is both costly and inconvenient. The solution to this is straightforward. Choose one metal as a standard and allow the price of the other metal to fluctuate freely or float in the market.</p>
<p>If silver is the standard, then gold coins can be minted with no dollar designation at all. They can be minted with the weight of pure gold shown. Then when they are used as payments or used as a basis for issuing e-credits or gold certificates, their weights can be used in conjunction with the changing price of gold to gauge appropriate payments and receipts.</p><h2>Frequently Asked Questions</h2>
<p>Q: What is a constitutional dollar literally (in the United States)?</p>
<p>A: It is a silver coin containing 371.25 grains (0.7734375 troy ounces) of pure silver.</p>
<p>Q: Is a gold standard constitutional?</p>
<p>A: No, not for the United States as the constitution is written. It should be noted, however, that individual states have a constitutional power to make specie (silver, gold, or both) legal tender.</p>
<p>Q: What is meant by a metal standard?</p>
<p>A: It means a monetary unit that contains a specific weight of metal.</p>
<p>Q: Can the United States or any country be on two metal standards at the same time?</p>
<p>A: No, this will be impracticable because of the continual changes in relative prices of any two metals.</p>
<p>Q: Can two metals circulate as coin if there is but one standard?</p>
<p>A: Yes. The metal that is not the standard can circulate as a coin of a given weight of that precious metal whose value at any given time is determined by reference to market prices. Such a coin need not carry any specific dollar designation. This obviates Gresham&#39;s law.</p>
<p>Q: Does one metal have to drive the other out of circulation?</p>
<p>A: No. As long as the metal that is not the standard is not legally made to exchange at a fixed ratio to the standard metal, both metals can circulate just as silver and gold both trade in today&#39;s markets. Gresham&#39;s law will not come into play.</p>
<p>Q: How and why does Gresham&#39;s law work when a country uses metal coin for money?</p>
<p>A: Gresham&#39;s law takes hold when the government fixes an exchange rate between two metals. When the market rate of exchange deviates from the fixed rate, arbitrage opportunities arise that make it profitable to use the less-expensive metal as means of payment at the official rate. Then the more-expensive metal disappears from circulation as a medium of exchange.</p><a href="http://store.mises.org/What-Has-Government-Done-to-Our-Money-MP3CD-P329C0.aspx?utm_source=Mises_Daily&amp;utm_medium=Graphic&amp;utm_campaign=Item_in_Daily"><img alt="WHGDtOM?" src="http://store.mises.org/Assets/ProductImages/CD3182.jpg" /></a>
<p><a href="http://store.mises.org/What-Has-Government-Done-to-Our-MoneyCase-for-a-100-Percent-Gold-Dollar-P224C0.aspx?utm_source=Mises_Daily&amp;utm_medium=Graphic&amp;utm_campaign=Item_in_Daily">Print $17</a></p>
<p><a href="http://store.mises.org/What-Has-Government-Done-to-Our-Money-MP3CD-P329C0.aspx?utm_source=Mises_Daily&amp;utm_medium=Product_Price_Link&amp;utm_campaign=Item_in_Daily">Audio $25</a></p>
<p>Q: What is an accurate rendition of Gresham&#39;s law?</p>
<p>A: When two metals are legal tender at an official rate of exchange and when one metal&#39;s market price appreciates in terms of the metal used as a standard, the appreciated metal will disappear from circulation as money and the metal used as a standard will circulate. Conversely, when two metals are legal tender at an official rate of exchange and one metal&#39;s market price depreciates in terms of the metal used as a standard, the depreciated metal will circulate; the metal used as a standard will disappear from circulation as a medium of exchange, although it is still the medium of account.</p>
<p>Put more simply, when two metals are legal tender at a fixed, official rate of exchange, the metal that is less expensive at the market rate of exchange will tend to circulate for payments while the more expensive metal will tend to disappear as a medium of exchange.</p>
<p>[bio] See [AuthorName]&#39;s [AuthorArchive].</p><p class="blog-link"><a href="http://blog.mises.org/12134/a-constitutional-dollar/">Comment on the blog.</a></p>
<p>You can subscribe to future articles by [AuthorName] via this [RSSfeed].</p><h5 id="notes">Notes</h5>
<p><a href="#ref1" name="note1">[1]</a> The law may also enable one to legally write contracts to protect against future changes in the market rate of exchange, but that is another matter. We want to see what occurs if the official rate of exchange of silver and gold deviates from the market rate as time passes.</p></div>
 
<p><br /><strong>Note:</strong> The views expressed on Mises.org are not necessarily those of the Mises Institute.</p>
 <div class="clearfix"><div id="group-sharing" class="group-sharing">
 
 
 
 <hr>
 
 
<?php
//echo(var_dump(get_defined_vars()));
/*
//START EXAMPLE
// Include the library
include('simple_html_dom.php');
 
// Retrieve the DOM from a given URL
$html = file_get_html('http://davidwalsh.name/');

// Find all "A" tags and print their HREFs
foreach($html->find('a') as $e) 
    echo $e->href . '<br>';

// Retrieve all images and print their SRCs
foreach($html->find('img') as $e)
    echo $e->src . '<br>';

// Find all images, print their text with the "<>" included
foreach($html->find('img') as $e)
    echo $e->outertext . '<br>';

// Find the DIV tag with an id of "myId"
foreach($html->find('div#myId') as $e)
    echo $e->innertext . '<br>';

// Find all SPAN tags that have a class of "myClass"
foreach($html->find('span.myClass') as $e)
    echo $e->outertext . '<br>';

// Find all TD tags with "align=center"
foreach($html->find('td[align=center]') as $e)
    echo $e->innertext . '<br>';
    
// Extract all text from a given cell
echo $html->find('td[align="center"]', 1)->plaintext.'<br><hr>';

//END EXAMPLE
*/

?>
