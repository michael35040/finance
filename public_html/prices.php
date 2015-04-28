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





<tr>
 <td>$1 FV 90% Silver Coins (0.715ozt)</td>
 <td>$<?php echo(number_format(($silverprice*.0715),2,".",",")); ?></td>
 <td></td>
</tr>
<tr>
 <td>10ozt Silver Bar</td>
 <td>$<?php echo(number_format(($silverprice*10),2,".",",")); ?></td>
 <td></td>
</tr>
<tr>
 <td>Tube of Silver Eagles (20ozt)</td>
 <td>$<?php echo(number_format(($silverprice*20),2,".",",")); ?></td>
 <td></td>
</tr>
<tr>
 <td>100oz Silver Bar</td>
 <td>$<?php echo(number_format(($silverprice*100),2,".",",")); ?></td>
 <td></td>
</tr>
<tr>
 <td>Moster Box Silver Eagles (500oz)</td>
 <td>$<?php echo(number_format(($silverprice*500),2,".",",")); ?></td>
 <td></td>
</tr>
<tr>
 <td>$1,000 FV 90% Silver Coins (715ozt)</td>
 <td>$<?php echo(number_format(($silverprice*715),2,".",",")); ?></td>
 <td></td>
</tr>
<tr>
 <td>COMEX 1000oz Good Delivery Silver Bar</td>
 <td>$<?php echo(number_format(($silverprice*1000),2,".",",")); ?></td>
 <td></td>
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
 
 Dollar as a Unit of Measurement
 <br>
 The DOLLAR is a unit of measurement, same as a pound, ounce, inch, foot, yard, acre, mile, etc. Units of measure do not change only the number of units or the value of the units of measure change.The DOLLAR is a form of measurement, not money. A Dollar is 90% pure silver (412.5 grains in weight) or 90% pure gold (25.8 grains). A DOLLAR of silver weighs the same as ten silver dimes, or four silver quarters, or two silver halves. 
 <br>
 THE TERM DOLLAR HAS BEEN DEFINED SEVERAL WAYS:
 <br>
“A silver coin” Webster’s Encyclopedic Dictionary, 1980.
 <br>
“A weight of gold or silver” Encyclopedia Britannica, 1962.
 <br>
“412.5 grains of silver” World Dictionary, 1959.
 <br>
The Century Dictionary, Published 1914 (with over 8,000 pages of definitions) defines the term DOLLAR as “The monetary unit or standard of value of the United States and Canada. By the term Dollar in the United States is intended the coined dollar of the United States, a certain quantity in weight and fineness of gold or silver…”Silver Certificates state the following: “This certifies that there is on deposit in the Treasury of the United States of America (denomination) Dollar(s) in silver payable to the bearer on demand.”
 <br>
United States Notes states the following:
 <br>
“The United States of America will pay to the bearer on demand (denomination) Dollar(s).”
 <br>
A NOTE cannot be a DOLLAR, it can only be a promise to pay.
 <br>
Constitutional Requirement:
 <br>
The United States Constitution only permits coined money to be used to pay debts.
 <br>
Article 1, Section 10, paragraph 1, The United States Constitution:
 <br>
No State shall make any thing but gold and silver coin a tender in payment of debts….
 <br>
Coinage Act of April 2, 1792:
 <br>
The money of account of the United States shall expressed in dollars or units…all accounts in public and all proceedings in the courts of the United States shall kept and had in conformity to this regulation.
Paper receipts for gold and silver are no longer issued by the United States.
 <br>
Besides the denominations of United States notes, from $1 to $10,000, that were issued before 1929, several other types of United States paper receipts no longer issued have circulated within the past 75 years. National Bank notes were issued by national banks from 1863 to 1929. Gold certificates, authorized in 1865 and issued by the Treasury Department in exchange for gold coin and bullion, circulated until 1933. Silver certificates, authorized in 1878 and issued in exchange for dollars of silver, accounted for nearly all of the $1 notes in circulation until November 1963, when the first $1 Federal Reserve notes without the “Will Pay To The Bearer On Demand” notation were issued as money.
 <br>
Which one is the real Money?
 <br>
The Federal Reserve Note without the “Will Pay To The Bearer On Demand” removed was first issued in November 1963. It claims to be Five Dollars.
 <br>
A Note is a promise to pay. It cannot be money.The United States Note that was issued before November 1963 was redeemable for Five Dollars. If it was redeemable for Five Dollars, it could not be the Five Dollars.
 <br>
Real Money is for example a 1913 Dollar of Silver (412.5 grains of silver in weight)AKA the Morgan Dollar of Silver.
 <br>
The paper money we use every day are Federal Reserve Notes (FRN), not Dollars as we commonly call them. The FRNs are no longer receipts for “Dollars” or “Dollars of Silver”. If a FRN is not redeemable for “Dollars” what is it worth? It is worth what you believe it is worth, since you can still use it to buy things, it has a value. But what is it costing you to use FRNs that are not backed by something tangible (like gold or silver) to control its worth? Since there is nothing controlling the actual number of FRNs printed, an unlimited amount can be produced. As in any market, the value of anything goes down if there is more of the item available to be consumed.
 <br>
There is a way to place a value on a FRN by comparing it to the value of a Dollar of Silver.
 <br>
As of Oct. 18, 2008 the NYMEX closing price of silver was at 9.32 FRNs per troy ounce of silver. Each Morgan Dollar contains 0.7735 troy ounces of silver. This translates to a value of 7.21 FRNs for each Morgan Dollar. Transversely, the value of a FRN is about 13.7 cents.
 <br>
This is why things cost so much. The FRNs we call Dollars only have the buying power of 13.7 cents.
 <br>
Today’s FEDERAL RESERVE* (Private Corporation with Federal Controls) NOTES are not redeemable for silver or gold. They survive by our faith only. We should always have faith, but to own a dollar of silver it takes 7.21 FEDERAL RESERVE NOTES. 
 <br>







<hr>








<h1>Pros and Cons of Various Forms of Investment Silver</h1>
This page is designed to help you determine what type of silver to invest in.  Various forms (such as 'junk' silver coins and 100oz silver bars) each have their advantages and disadvantages.<p>

<br><br>
<table border>
<tr><th>Form</th><th>Pros</th><th>Cons</th></tr>

<tr><td>1oz Silver <i>Bullion</i> Bars</td><td valign="top">
<ul>
<li>Small premium over spot
<li>Serial numbers make them safe (if recorded)
<li>Serial numbers make them harder to counterfeit
</ul>
</td><td valign="top">
<ul>
<li>Small size makes them cumbersome in quantity
</ul>
</tr>

<tr><td>1oz Silver <i>Art</i> Bars</td><td valign="top">
<ul>
<li>You can collect them
<li>Although easily sold, it may be hard to get as much as you paid for them.
</ul>
</td><td valign="top">
<ul>
<li>High premium over spot
<li>Small size makes them cumbersome in quantity
</ul>
</tr>

<tr><td>1oz Silver <i>Rounds</i></td><td valign="top">
<ul>
<li>You can collect them
</ul>
</td><td valign="top">
<ul>
<li>Modest premium over spot
<li>Small size makes them cumbersome in quantity
</ul>
</tr>

<tr><td>1oz Silver <i>U.S. Eagles</i></td><td valign="top">
<ul>
<li>Guaranteed by the U.S. Government never to be worth less than $1
<li>Very well recognized and liquid
</ul>
</td><td valign="top">
<ul>
<li>It is one of the highest premiums over spot for silver bullion
<li>They are a more cumbersome than higher weight bars
</ul>
</tr>


<tr><td>1oz Silver <i>Canadian Maples</i></td><td valign="top">
<ul>
<li>Guaranteed by Canada not to be worth less than CDN$5.
<li>Well recognized and liquid
</ul>
</td><td valign="top">
<ul>
<li>It is one of the highest premiums over spot for silver bullion
<li>They are a more cumbersome than higher weight bars
</ul>
</tr>

<tr><td>1oz Silver <i>Coins</i> (pandas, philharmonics, Libertads, etc.)</td><td valign="top">
<ul>
<li>Guaranteed by a government to be worth at least a certain amount
<li>Many are well recognized and liquid
</ul>
</td><td valign="top">
<ul>
<li>Most have high premiums over spot
<li>They are a more cumbersome than higher weight bars
<li>Pandas are commonly counterfeited (in China)
</ul>
</tr>

<tr><td>10oz Silver <i>Bullion</i> Bars</td><td valign="top">
<ul>
<li>Small premium over spot
<li>Serial numbers help make them safe (if recorded)
</ul>
</td><td valign="top">
<ul>
<li>Cost can be out of reach for smaller investors
<li>Can't be broken up into smaller units
</ul>
</tr>

<tr><td>1 Kilo Silver <i>Bullion</i> Bars</td><td valign="top">
<ul>
<li>Reasonable premium over spot
<li>Serial numbers help make them safe (if recorded)
</ul>
</td><td valign="top">
<ul>
<li>Cost can be out of reach for smaller investors
<li>Can't be broken up into smaller units
</ul>
</tr>

<tr><td><i>40% 'Junk' Silver</i> coins</td><td valign="top">
<ul>
<li>Guaranteed by the U.S. Government never to be worth less than face value
<li>Well recognized and liquid
<li>Often priced below spot
<li>Small sizes could be useful for bartering (for those that believe such a day would come)
<li>If you're bored, you can hunt to see if there are coins with numismatic value
<li>Have a higher face-value-per-ounce than 90% silver
</ul>
</td><td valign="top">
<ul>
<li>The $500 and $1000 face value bags are a bit cumbersome
<li>Since they are not pure silver, if they needed to be melted, it would cost more than with .999 fine silver
<li>It is time-consuming to count the larger bags, if you want to verify the count
</ul>
</tr>

<tr><td><i>90% 'Junk' Silver</i> coins</td><td valign="top">
<ul>
<li>Guaranteed by the U.S. Government never to be worth less than face value
<li>Very well recognized and liquid
<li>Often priced near or below spot
<li>Can be bought in small amounts
<li>Small sizes could be useful for bartering (for those that believe such a day would come)
<li>If you're bored, you can hunt to see if there are coins with numismatic value
</ul>
</td><td valign="top">
<ul>
<li>The $500 and $1000 face value bags are a bit cumbersome
<li>Since they are not pure silver, if they needed to be melted, it would cost more than with .999 fine silver
</ul>
</tr>


<tr><td>100oz Silver <i>Bullion</i> Bars</td><td valign="top">
<ul>
<li>Small premium over spot
<li>Serial numbers make them safe (if recorded)
</ul>
</td><td valign="top">
<ul>
<li>Cost can be out of reach for many investors
<li>In the 1980s, there were isolated cases of genuine bars with holes drilled and filled with lead<br>(you can use the 'ring test' to help ensure that it is real, solid silver)
</ul>
</tr>

<tr><td>1000oz Silver <i>Bullion</i> Bars</td><td valign="top">
<ul>
<li>Lowest premium over spot
<li>Takes the least amount of space (per ounce)
<li>Serial numbers make them safe (if recorded)
</ul>
</td><td valign="top">
<ul>
<li>Cost can be out of reach for many investors
<li>The bars may need to be assayed when sold
<li>It may be hard to find a buyer
<li>The bars do not weigh exactly 1,000 ounces, making it harder to calculate how much you have
</ul>
</tr>

<tr><td>Silver ETF (Exchange Traded Fund)</td><td valign="top">
<ul>
<li>Typically no premium over spot
<li>Very easy to trade
</ul>
</td><td valign="top">
<ul>
<li>You don't have physical possession of the silver
<li>You need to be confident that the silver backing the ETF exists
<li>You have to be confident that the ETF is not manipulated in any way (e.g. lots of shares sold short)
<li>Some would say that it may be too easy to sell (and you might not profit as much when selling, but that could also prevent a loss)
</ul>
</tr>

<tr><td>Pooled Silver Account</td><td valign="top">
<ul>
<li>Typically no premium over spot
<li>Typically no storage or other annual fees
</ul>
</td><td valign="top">
<ul>
<li>You don't have physical possession of the silver
<li>The silver may not even exist; apparently it is standard practice at some banks not to have physical silver backing the pool
<li>You have to trust the company holding it, that they don't go out of business
<li>Any silver backing it isn't allocated to you, so in a bankruptcy, you might not get the silver owed you
</ul>
</tr>

</table>







<hr>


 
 
 
<center><h1>Good Information About Bags of 90% Silver Coins</h1></center>

Some people who are interested in silver bullion purchase $1,000FV (Face Value) bags of 90% United States silver coins.  This is simply either 10,000 dimes (from 1964 or earlier), 4,000 quarters (from 1964 or earlier), or 2,000 half dollars (from 1964 or earlier).  Many dealers also sell half bags ($500FV), quarter bags ($250FV), $100 bags, and smaller amounts.<p>

At a recent spot price of $20.82 (as of 10 Mar 2014 16:00), a $1,000 face value bag of 90% silver U.S. coins has a melt value of $<b>
<script>
function FormatDollars( amt, max )
{
 var cents;
 var xstr;
 var spaces = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

 cents = Math.round( amt * 100 );

 xstr = "" + cents;
 len = xstr.length;
 
 if ( len == 1 )
 {
  xstr = "0" + xstr;
  len = 2;
 }

 return xstr.substring( 0, len - 2) + "." + xstr.substring( len - 2, len );
}
</script>
<script>
document.write( FormatDollars( 20.82 * 715, 6 ) );
</script>
</b> (based on 715 ounces pure silver per bag).<p>
 

<br>
<H3>What are the advantages/disadvantages of $1000FV 90% silver over .999 pure bars?</H3>

Pros over .999 fine bars:
<UL>
<LI>They are in small units, making it easier to sell if silver prices jump very high
<LI>The small units could make them useful if needed for bartering
<LI>They are very easy to identify, and therefore easy to sell
<LI>They could have some numismatic value, since they can never be minted again
</UL>

Cons over .999 fine bars:
<UL>
<LI>You can't easily determine how much pure silver is in the coins
<LI>They are bulkier, and therefore harder to store, than .999 fine bars
<LI>You need to count or weigh the coins to verify how much you have
</UL>


<H3>What is the real value of $1000FV 90% silver?</H3>

It is very hard to place a value on $1000FV bags of 90% silver coins.  why?  Because there are many variables.  First is the denomination:  Half dollars tend to be valued more highly than quarters or dimes, since they are usually less worn (and therefore have more silver), have smaller mintages, and are easier to count.  Next comes the variety:  Mercury dimes and Walking Liberty halves tend to have price premiums, since the coins are older (and may have more numismatic value) and easier to identify as being 90% silver (you don't have to check the dates, as you do with more recent 90% silver coins).<p>

Regardless of the type of coin, the value of 90% silver coins compared to spot prices varies widely at times.  Sometimes there are very high premiums (such as late 1999, just before Y2K, when people thought they would be useful for bartering if computer systems went down).  At other times, such as the early-to-mid 1980s and shortly after Y2K, these bags would sell well below the spot price.  In some cases, this was due to low demand, and in other cases (such as during the high prices of silver in early 1980), this was due to the lengthy delay to melt the coins into fine silver (and the risk of the price declining before that happened).<p>

But, if you are just buying it for the silver content, what matters the most is how much silver the coins contain.  A $1,000FV bag of 90% silver coins contains about 715 ounces of pure silver (plus about 80 ounces of copper).<P>

<h3>What Coins Will I Get?</h3>
That depends.  If you're getting a full $1,000 face value bag, most commonly you will get a bag of all dimes (10,000 of them) or all quarters (4,000 of them).  Sometimes, you'll get a mix, but that isn't as common (people typically want all of the same denomination).  Occasionally, you may get a bag of half dollars, but often you'll have to pay a premium for bags of half dollars.<p>

Typically, for dimes, you will get Roosevelt dimes (the same type we have today), but occasionally will see some mercury dimes (or even more rarely, Barber dimes) mixed in.  Some dealers will sell bags of just Mercury dimes at a premium (which is nice, as you don't have to check the dates of them to make sure they are pure silver, as post-1964 Roosevelt dimes are not made of silver).  For quarters, you'll usually get Washington quarters with an occasional Barber quarter mixed in.  Halves are typically mixed, with the majority being Franklin halves.<p>



<h3>All About Weight</h3>
When first minted, $1,000FV of 90% silver weighs 803.76 troy ounces.  Since it is 90% silver, that means that the coins contain 723.38 troy ounces of pure silver.  A circulated bag contains roughly 715 ounces of pure silver.<p>

Since silver is sold in troy ounces, we won't bother telling you the avoirdupois ounce weights (what it would be on a bathroom scale), or the weight in pounds.  Do not trust anyone selling silver using avoirdupois ounces; no dealer will sell using avoirdupois ounces (it is illegal).  The same holds true for people selling 'pounds' of silver (12 troy ounces or 16 avoirdupois ounces) -- silver is sold in troy ounces, not in pounds (this gets even more complicated, since a troy pound weighs less than an avoirdupois pound, whereas a troy ounce weighs more than an avoirdupois ounce).<p>


<H3>Gresham's Law</H3>
Gresham's Law says that bad money drives out good money.  Here, it means that as $1000FV bags of 90% silver coins change hands, new owners may take out the good coins (less worn coins, or those with numismatic value) while leaving the bad ones (more worn coins, without numismatic value).  The reason is simple:  these bags trade based on the face value of the coins, not the weight or based on numismatic value.  You might get lucky and get a "good" bag.  But as time goes on, the $1000FV bags weigh less and less.<p>

If the price of silver climbs high enough, this will stop.  It will likely happen when the price of silver becomes high enough that the 8% or so difference in value between "good" bags and "bad" (highly circulated) bags will become very significant.  At $14/oz, a $1000FV bag containing the worst possible 90% silver coins costing about $10,000 will contain about $800 less silver than a bag containing "good" coins.  If silver were to reach, say, $100/oz, then that same bag of the worst possible 90% silver coins would be short over $10,000 -- more than the original cost of the bag!  I can guarantee you that if you brought the bag to a refiner, they would only pay you based on the weight (otherwise, they would be paying you for perhaps 715 ounces of silver when they would only be able to extract perhaps 665 ounces).<p>


<H3>How much silver really is in that $1000FV bag?</H3>

One of the biggest questions is 'How much silver is really in there?'.  This can get very confusing, because of troy vs. avoirdupois ounces, and circulation.  In other words, while 90% U.S. silver coins are sold by face value, they shouldn't be.<P>

A $1000FV bag of brand new, untouched coins would weigh 803.75 troy ounces, and at 90% silver, would therefore contain 723.38 ounces of pure silver.  But those brand new ("brilliant uncirculated") coins all have high collector value, so you aren't going to get a bag containing the full 723.38 ounces of silver (unless you are very, very lucky!).<p>

Most dealers assume that the bags weigh 715 ounces (so they do not have to weigh them all).  Websites claim that $1000FV bags of circulated coins contain on average various amounts of silver.  We've seen "approximately 715 ounces", "718-720 ounces" (for Walking Libery Halves), "the average amount of Silver per $1000 bag is a little over 710 ounces".  But that just ain't always right.  When you buy a $1000FV bag (or a lesser amount), you usually don't know what you are getting.  Sometimes the seller will specify "dimes" or "quarters", and sometimes even the specific variety (such as Mercury dimes or Walking Liberty halves).  But I haven't seen any dealers that specify the weight of the bags.<p>

So how much silver is really in there?  If you get a bag, you can weight it, convert the weight to troy ounces, and multiply by .9 to get the pure silver content (which will be as exact as your scale; wear of the coins should be exactly even between the silver and non-silver content).  But that isn't always easy.<p>

To test, we took 10 mercury dimes that were extremely worn (where you could no longer see the ridges on the edges of the coins), and weighed them.  They should have weighed 25g total if new (2.50g each); they actually weighed in at 22.8g (2.28g each).  This was on a scale accurate to .1g.  Dividing 22.8 by 25.0 shows us that they now weigh 91.2% of their original weight.  Multiplying 723.38 (the original pure silver content of a $1000FV bag of 90% pure coins) by 91.2% results in 659.7 ounces.  The good news is that with the bag that we found those in, a random sample of 20 coins weighed 48.6g, or 2.43g each, or 97.2% of their original weight (or 703oz for a $1000FV bag).  That's a bit lower than average, but not terrible.<p>

We then tested some Walking Liberty halves, picking out 10 of the most well worn ones out of several hundred.  These weighed 117.7g (11.77g each), compared to the 12.50g they should have weighed.  That's 94.16% of the full weight, or almost 6% short of the original weight.  That would be just 681.1 troy ounces for a $1000FV bag.  The good news is that a random sample of 10 coins from that bag weighed 122.5g, or 12.25g each, just 2% short of the full weight when new, for 709oz for a full bag.  And those coins looked pretty well worn (but most had the full rims).<p>

Of course, Mercury dimes and Walking Liberty halves tend to be more well worn than newer coins.  And since those older coins tend to carry a premium, it is unlikely that you would come across many of them without asking for them.  So a bag you encounter would likely have a higher silver content than 700oz.  A sample of 40 random Roosevelt dimes from a bag weighed 2.48g each, or over 99% of their original weight (or 717.6oz for a $1000FV bag).  And a sample of 10 random Franklin Halves weighed in at 12.36g each, just under 99% of their original weight (or about 715.3 ounces).<p>

So where does that leave us?  It means that when you buy a $1000FV bag of coins, you'll probably get about the 715 ounces that are usually claimed -- but in some cases, it could contain as much as 50 fewer ounces than you might be led to believe (or possibly less, if the coins were worn worse than the ones we tested, but these were pretty bad, with the dates on some barely legible).  At best, you could be lucky and get uncirculated coins at slightly over 723 ounces (about 1% more silver than you paid for).<p>

<table border>
<tr><th>Type</th><th>Denomination</th><th>Percent of Original Silver Content</th></tr>
<tr><td>Well Worn Mercury Dimes</td><td>$.10</td><td>91.2%</td></tr>
<tr><td>Well Worn Walking Liberty:</td><td>$.50</td><td>94.2%</td></tr>
<tr><td>Random sample from Mercury Dime Bag</td><td>$.10</td><td>97.2%</td></tr>
<tr><td>Random sample from Walking Liberty Bag</td><td>$.50</td><td>98.0%</td></tr>
<tr><td>Industry standard assumption of a 715oz bag</td><td>Any</td><td>98.8%</td></tr>
<tr><td>Random sample from Franklin Halves</td><td>$.50</td><td>98.9%</td></tr>
<tr><td>Random sample from Roosevelt Bag</td><td>$.10</td><td>99.2%</td></tr>
<tr><td></td><td></td><td></td></tr>
</table>



<H3>Other Issues...</H3>

Also, it's important to note that unless you count the coins, you won't know for sure how many are in there.  That isn't a problem if you go by weight (since 700 ounces of well worn coins has almost exactly the same amount of silver as 700 ounces of brand new coins).  But if you don't go by weight, and don't count the coins, you have a chance of getting ripped off.  A spot-check of a number of bags of silver coins from well-known dealers showed that while many were "honest counts", some weren't (by as much as $5FV, or .5%).  That may be due to honest mistakes (in counting, or someone who previously owned the bag who saw a "good" coin and took it out, meaning to replace it).<p>

Finally, you need to be sure that the dates are all 1964 or earlier.  It's easy to tell with obsolete coinage, but 90% Roosevelt dimes, Washington quarters and Kennedy halves look and feel almost exactly like the coins with 0% silver (or 40%, in the case of some Kennedys).  one bag that was spot-checked had a 2003 quarter in it (probably due to someone taking one of the old quarters and replacing it, not realizing that the old one was silver).<p>

<h3>Where Does the 715 Ounce Figure Come From?</h3>
The 715 ounce average weight of $1,000 face value of silver comes from as far back as 1970 (see <a href="http://books.google.com/books?id=OwYEAAAAMBAJ&pg=PA36#v=onepage&q=&f=false">Kiplinger's Personal Finance</a> May 1970, p.36).


<h3>Determining Melt Value</h3>
For a typical $1,000FV bag of 90% silver coins, you can multiply the current spot price by 715 to get the melt value (e.g. if spot is $10/ounce, the melt value would be $7,150).  If the coins are all very well worn, you might need to weigh the bag first (remembering that a 'bathroom scale' uses avoirdupois pounds/ounces, which need to be converted into troy ounces).<p>

<H3>When Did $1,000 bags Start?</H3>
They date back to at least the late 1960s.  An article in Life magazine, from 02 May 1969, states "... [I] lug around thousand-dollar bags of quarters, which weigh about 50 pounds."<p>

$1,000 face value bags of silver coins were trading on the New York Commodity Exchange back then, as well.<p>


<br>
<table border>
<tr><th>Condition</th><th>Avoirdupois Oz<BR>(bathroom scale)</th><th>Troy Oz</th><th>Troy Oz Silver</th></tr>
<tr><td>BU, brand new</td><td>876.90 (54.806 lbs)</td><td>803.76</td><td>723.38</td></tr>
<tr><td>What most claim</td><td>866.7 (54.171 lbs)</td><td>794.4</td><td>715</td></tr>
<tr><td>Worst Case (?)</td><td>799.7 (49.98 lbs)</td><td>733</td><td>659.7</td></tr>
</table>





<hr>







<br><br>
<h1>American Silver in Silver Eagles</h1>

Many people believe that they have heard that the U.S. Mint is required by law to purchase silver mined in the United States to create the American Silver Eagles.<p>

This is only partially true.<p>

<h3>The Original Law</h3>
When American Silver Eagles were first introduced in 1986, the law stated that the silver for American Eagles come from the U.S. Strategic and Critical Materials Stock Pile (curious? <a href="http://about.ag/StrategicStockpile.htm">read about the stockpile here</a>).<p>

At that time, the Mint could <i>only</i> buy silver for Eagles from the government stockpile.  For other silver coins (but not Eagles), it could purchase newly mined silver from American refiners.<p>

<h3>The 2002 Change</h3>

However, in the early 2000s, the stockpile was quickly depleting.  If it was allowed to be used up, no more silver American Eagles could be minted.  So the law changed in 2002, such that once the stockpile was depleted, the Mint was required to buy silver from natural deposits in the United States that were brought to the U.S. Mint within a year after being mined (as had been allowed for other silver coins).<p>

However, the law also provided an out:  "If it is not economically feasible to obtain [silver from U.S. mines]", the Mint could obtain the silver "from other available sources."  That gave the Mint the ability to buy foreign silver in cases where American silver was not available (or could only be obtained above spot price, as it states that the Mint cannot pay more than the "average world price", essentially the COMEX spot price).<p>

<h3>Newly Mined Silver</h3>
The requirement to use American silver only applied to newly mined silver (within 1 year of being mined), to help support American silver mines.<p>

So the law treated "old" silver mined in the United States the same as foreign silver.<p>

At any point where obtaining the recently mined U.S. silver was not economically feasible (e.g. if it would cost more than spot, or not available as quickly as needed), the Mint could use any other silver they could find.<p>

<h3>Source</h3>
You can find the law, as well as the notes about changes, at <a href="http://www.law.cornell.edu/uscode/pdf/uscode31/lii_usc_TI_31_CH_51_SC_II_SE_5116.pdf">law.cornell.edu</a>.<p>



<h1>




<center>
<h1>All About the United States Strategic Silver Stockpile</h1>
</center>
<p>

This page discusses the Strategic Stockpile of silver in the United States.  For some reason, there is very little information available about it.<p>

The United States keeps stockpiles of strategic materials.  It is run by the "<a href="https://www.dnsc.dla.mil/">DLA</a> (Defense Logistics Agency) Strategic Materials."  Before July, 2010 it was run by the Defense National Stockpile Center; the stockpile itself is called the United States National Defense Stockpile.  It was created after World War II to store critical strategic materials of national defense purposes.  This helps ensure that the United States will have the materials it needs in the time of a crisis.  You can also read an <a href="http://www.globalsecurity.org/military/agency/dod/dnsc.htm">overview of the agency</a>.<p>

The <i>Silver</i> Strategic Stockpile (then called the Strategic and Critical Materials Stockpile) was formed in June, 1968, with a 'donation' of 165 million ounces of silver from the U.S. Treasury.  25.5 million ounces was removed in 1970, leaving 139.5 million ounces.  It stayed at about that level through 1985, after which it declined each year until 2002 when it was all used up (the silver was sold to the Treasury for making Silver Eagles).  As early as 1979 it was determined that the silver was not necessary, because &quot;the probable wartime supply exceeds projected U.S. requirements&quot; (Report By The Comptroller of the United States, 'National Defense Requirements For A Silver Stockpile', April 10, 1979).  The silver was stored in West Point (49.4Moz) and San Francisco (90.1Moz) (same source).<p>

To see the exact levels per year, you can look at our <a href="/data/csv/stockpiles.htm">Silver Stockpiles of the Past</a> page.<p>



<p>
<br><br><table style="margin-left: auto; margin-right: auto;"><tr><td><h2>Silver Stockpiles of the Past
</h2></td></tr></table>
<table style="margin-left: auto; margin-right: auto;"><tr><td><span style="margin-left: auto; margin-right: auto;">Known silver stockpiles, at the end of the year.  Treasury numbers do NOT include coins in circulation.
</td></tr></table>
<p>
<table border style="margin-left: auto; margin-right: auto;">
<tr><th>Year</th><th>Industry</th><th>Futures Exchanges</th><th>Treasury</th><th>Strategic Stockpile</th><th>DoD</th><th>ETFs</th></tr>
<tr align=right><td>1940</td><td>?</td><td>?</td><td>3,135,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1941</td><td>?</td><td>?</td><td>3,280,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1942</td><td>?</td><td>?</td><td>3,334,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1943</td><td>?</td><td>?</td><td>3,254,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1944</td><td>?</td><td>?</td><td>2,345,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1945</td><td>?</td><td>?</td><td>2,005,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1946</td><td>?</td><td>?</td><td>1,953,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1947</td><td>?</td><td>?</td><td>1,963,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1948</td><td>?</td><td>?</td><td>1,952,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1949</td><td>?</td><td>?</td><td>1,978,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1950</td><td>?</td><td>?</td><td>1,983,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1951</td><td>?</td><td>?</td><td>1,965,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1952</td><td>?</td><td>?</td><td>1,938,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1953</td><td>?</td><td>?</td><td>1,926,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1954</td><td>?</td><td>?</td><td>1,935,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1955</td><td>?</td><td>?</td><td>1,930,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1956</td><td>?</td><td>?</td><td>1,981,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1957</td><td>?</td><td>?</td><td>2,014,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1958</td><td>?</td><td>?</td><td>1,957,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1959</td><td>?</td><td>?</td><td>2,106,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1960</td><td>?</td><td>?</td><td>1,992,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1961</td><td>?</td><td>?</td><td>1,863,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1962</td><td>?</td><td>?</td><td>1,767,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1963</td><td>?</td><td>?</td><td>1,583,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1964</td><td>?</td><td>?</td><td>1,218,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1965</td><td>?</td><td>?</td><td>804,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1966</td><td>?</td><td>?</td><td>594,000,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1967</td><td>?</td><td>?</td><td>348,300,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>1968</td><td>77,156,000</td><td>89,200,000</td><td>256,000,000</td><td>165,000,000</td><td>?</td><td>0</td></tr>
<tr align=right><td>1969</td><td>85,590,000</td><td>113,200,000</td><td>104,000,000</td><td>165,000,000</td><td>?</td><td>0</td></tr>
<tr align=right><td>1970</td><td>81,900,000</td><td>127,980,000</td><td>25,100,000</td><td>139,500,000</td><td>?</td><td>0</td></tr>
<tr align=right><td>1971</td><td>56,200,000</td><td>128,470,000</td><td>48,000,000</td><td>139,500,000</td><td>?</td><td>0</td></tr>
<tr align=right><td>1972</td><td>52,061,000</td><td>100,400,000</td><td>45,800,000</td><td>139,500,000</td><td>8,900,000</td><td>0</td></tr>
<tr align=right><td>1973</td><td>38,400,000</td><td>91,700,000</td><td>45,100,000</td><td>139,500,000</td><td>6,100,000</td><td>0</td></tr>
<tr align=right><td>1974</td><td>49,300,000</td><td>87,300,000</td><td>44,030,000</td><td>139,500,000</td><td>6,030,000</td><td>0</td></tr>
<tr align=right><td>1975</td><td>34,600,000</td><td>123,699,000</td><td>41,000,000</td><td>139,500,000</td><td>8,000,000</td><td>0</td></tr>
<tr align=right><td>1976</td><td>30,600,000</td><td>115,823,000</td><td>39,700,000</td><td>139,500,000</td><td>7,600,000</td><td>0</td></tr>
<tr align=right><td>1977</td><td>35,600,000</td><td>129,400,000</td><td>39,400,000</td><td>139,500,000</td><td>6,700,000</td><td>0</td></tr>
<tr align=right><td>1978</td><td>146,902,000</td><td>Incl. in Industrial</td><td>39,157,000</td><td>207,372,000</td><td>6,450,000</td><td>0</td></tr>
<tr align=right><td>1979</td><td>149,131,000</td><td>Incl. in Industrial</td><td>38,990,000</td><td>182,295,000</td><td>5,670,000</td><td>0</td></tr>
<tr align=right><td>1980</td><td>17,255,000</td><td>120,798,000</td><td>38,890,000</td><td>139,500,000</td><td>4,510,000</td><td>0</td></tr>
<tr align=right><td>1981</td><td>20,875,000</td><td>96,511,000</td><td>38,732,000</td><td>137,500,000</td><td>3,810,000</td><td>0</td></tr>
<tr align=right><td>1982</td><td>20,467,000</td><td>106,182,000</td><td>36,768,000</td><td>137,500,000</td><td>1,750,000</td><td>0</td></tr>
<tr align=right><td>1983</td><td>17,449,000</td><td>151,232,000</td><td>34,565,000</td><td>137,500,000</td><td>100,000</td><td>0</td></tr>
<tr align=right><td>1984</td><td>21,217,000</td><td>137,631,000</td><td>31,889,000</td><td>137,500,000</td><td>342,000</td><td>0</td></tr>
<tr align=right><td>1985</td><td>18,467,000</td><td>173,144,000</td><td>32,633,000</td><td>137,509,000</td><td>450,000</td><td>0</td></tr>
<tr align=right><td>1986</td><td>17,671,000</td><td>162,089,000</td><td>33,823,000</td><td>127,317,000</td><td>2,508,000</td><td>0</td></tr>
<tr align=right><td>1987</td><td>15,143,000</td><td>169,723,000</td><td>39,513,000</td><td>113,074,000</td><td>2,411,000</td><td>0</td></tr>
<tr align=right><td>1988</td><td>15,432,000</td><td>188,467,000</td><td>38,613,000</td><td>106,419,000</td><td>2,604,000</td><td>0</td></tr>
<tr align=right><td>1989</td><td>17,490,000</td><td>250,615,000</td><td>32,054,000</td><td>95,584,000</td><td>2,604,000</td><td>0</td></tr>
<tr align=right><td>1990</td><td>18,743,000</td><td>277,653,000</td><td>27,007,000</td><td>92,273,000</td><td>1,029,000</td><td>0</td></tr>
<tr align=right><td>1991</td><td>19,869,000</td><td>281,640,000</td><td>33,115,000</td><td>83,913,000</td><td>739,000</td><td>0</td></tr>
<tr align=right><td>1992</td><td>21,766,000</td><td>301,574,000</td><td>24,916,000</td><td>72,661,000</td><td>932,000</td><td>0</td></tr>
<tr align=right><td>1993</td><td>23,630,000</td><td>337,582,000</td><td>29,321,000</td><td>59,479.000</td><td>1,093,000</td><td>0</td></tr>
<tr align=right><td>1994</td><td>29,868,000</td><td>334,367,000</td><td>28,356,000</td><td>53,692,000</td><td>482,000</td><td>0</td></tr>
<tr align=right><td>1995</td><td>NA</td><td>202,228,000</td><td>16,718,000</td><td>46,618,000</td><td>417,000</td><td>0</td></tr>
<tr align=right><td>1996</td><td>NA</td><td>146,285,000</td><td>12,924,000</td><td>46,618,000</td><td>321,000</td><td>0</td></tr>
<tr align=right><td>1997</td><td>12,699,000</td><td>110,277,000</td><td>15,560,000</td><td>39,223,000</td><td>0</td><td>0</td></tr>
<tr align=right><td>1998</td><td>12,699,000</td><td>75,875,000</td><td>18,711,000</td><td>33,115,000</td><td>0</td><td>0</td></tr>
<tr align=right><td>1999</td><td>NA</td><td>75,875,000</td><td>19,837,000</td><td>25,013,000</td><td>0</td><td>0</td></tr>
<tr align=right><td>2000</td><td>14,853,000</td><td>93,880,000</td><td>7,073,000</td><td>14,725,000</td><td>?</td><td>0</td></tr>
<tr align=right><td>2001</td><td>11,574,000</td><td>104,489,000</td><td>7,073,000</td><td>675,000</td><td>?</td><td>0</td></tr>
<tr align=right><td>2002</td><td>9,002,000</td><td>105,775,000</td><td>7,073,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>2003</td><td>2,990,000</td><td>110,277,000</td><td>7,073,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>2004</td><td>4,211,000</td><td>115,099,000</td><td>7,073,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>2005</td><td>2,764,000</td><td>120,565,000</td><td>7,073,000</td><td>0</td><td>?</td><td>0</td></tr>
<tr align=right><td>2006</td><td>3,150,000</td><td>128,603,000</td><td>7,073,000</td><td>0</td><td>?</td><td>121,208,000</td></tr>
<tr align=right><td>2007</td><td>2,250,000</td><td>132,782,000</td><td>7,073,000</td><td>0</td><td>?</td><td>172,006,000</td></tr>
<tr align=right><td>2008</td><td>4,920,000</td><td>133,747,000</td><td>7,073,000</td><td>0</td><td>?</td><td>264,922,180</td></tr>
<tr align=right><td>2009</td><td>???</td><td>112,527,613.1</td><td>7,073,000</td><td>0</td><td>?</td><td>469,400,000</td></tr>
<tr align=right><td>2010</td><td>???</td><td>104,490,000</td><td>7,073,000</td><td>0</td><td>?</td><td>591,574,000</td></tr>
<tr align=right><td>2011</td><td>???</td><td>117,350,000</td><td>7,073,000</td><td>0</td><td>?</td><td>565,853,000</td></tr>
<tr align=right><td>2012</td><td>???</td><td>141,460,000</td><td>7,073,000</td><td>0</td><td>?</td><td>610,864,000</td></tr>
</table>
<br><br>

<br><br><br>

<hr>


<center><h1>Silver Reporting in the United States</h1></center>

[For taxes, see our page on <a href="/taxes.htm">bullion tax</a>.]<p>

<h3>Summary for Buying/Selling Physical Silver (or Gold)</h3>

In general, the U.S. Government wants to know two things -- if you are laundering money, or avoiding taxes.  As a result, purchasing silver (or other metals) with cash of $10,000 or more may be reportable, and selling certain types and largish quantities of silver (or other metals) may be reportable.<p>

<table border>
<tr><th>Type of Transaction</th><th>Reportability</th></tr>
<tr><td>Cash transactions</td><td>In general, only reportable if paying cash (such as $20 bills) or sometimes cashier's checks and the like, but only if more than $10K (in a single transaction, or related transactions).</td></tr>
<tr><td>Buying Gold/Silver/Platinum/Palladium</td><td>If you buy precious metals (specifically, gold, silver, platinum or palladium), there are no reporting requirements for the dealer (except if you pay in cash; see above).  You could, in theory, buy $1 billion of silver and whoever sells it to you would not need to report it.</td></tr>
<tr><td>Selling Gold/Silver/Platinum/Palladium</td><td>If you sell precious metals (specifically, gold, silver, platinum or palladium) to a dealer, they <i>may</i> be required to fill out a 1099-B form.  They are required to fill out the form if both [1] you sell metal in a form that has been approved by the CFTC for trading by a regulated futures contract, and [2] you are selling enough metal to meet the minimum required for the contract.  This applies per 24-hour period, so you could sell 20 coins one day, and 20 coins 24 hours later, and might not have to report.  If you sell in a manner specifically to avoid the reporting requirement, reporting is then required.  <!-- <i>Starting January 1, 2012, unless repealed, selling over $600 of silver or gold will be <a href="1099-healthcare.htm">reported</a> on a 1099 form</i>.--></td></tr>

</table>

<br><h3>Cash Sales - Reportable >$10,000</h3>(only applies when you are BUYING from a dealer, not selling)<p>
If you buy silver (or virtually anything else) from a dealer, and pay cash (either real cash, such as $20 bills, or a cashier's check or similar anonymous source of money), and the amount is over $10,000, the dealer must report it on an IRS Form 8300.  Specifically, anyone 'conducting trade or business' must file the 8300 (so if you sell to an individual, they probably would not need to file the form).<p>

The $10,000 limit applies to either a single transaction, or series of related transactions within a 12-month period.  So if you buy $8,000 of silver in cash from a dealer in the morning, and another $8,000 in the afternoon (or even 6 months later) as part of a 'related transaction', they would be required to report this on the Form 8300.  But if the transactions are not related, they are treated separately. Two transactions are related if they occur with 24 hours of each other, of if the dealer knows or has reason to know that the transactions are a series of connected transactions.  What that really means is anyone's guess!<p>

As for 'related transactions', the IRS states that if you purchase <i>different items</i>, they are considered unrelated transactions.  <!-- See IRS FAQ #7 --> So if you buy $8K of Silver Eagles one week, and $8K of 90% silver the next week, it should not have to be reported.  Unless, of course, the dealer thinks you did so to avoid the reporting requirements.  So the reporting isn't required, but you can't avoid the requirement that way.  Strange, yes.<p>

So what is cash?  True cash qualifies (currency such as $20 bills and/or coins).  So do cashier's checks, bank drafts, traveler's checks or money orders -- but only if they are $10,000 or under, and either the dealer knows that you are trying to avoid the reporting requirements or you silver is considered a 'designated reporting transaction' by the Treasury (section 1.6050I-1(c)(iii)).  That section refers to 408(m)(3), which mentions that some coins and bullion are considered collectibles, others are not.<p>

If the transaction is <i>required</i> to be reported, the business is required to inform you by January 31 of the subsequent calendar year (as is normally the case with 1099 forms).  However, they must not inform you if the form is not required, but they report anyways because they are reporting a suspicious transaction.<p>

<br><h3>Buying Silver</h3>
There are no reporting requirements when buying silver, gold, or other precious metals.  The reason for this is that only the IRS is interested, and they only care if you are making money that you aren't reporting -- which cannot be the case if you are buying.<p>

<br><h3>Selling Silver</h3>
This one is quite complicated.  It seems that dealers are clearly required to report some larger transactions (such as 1000 ounce bars of silver), but that much information is outdated.  For example, the IRS site refers to 25 1-ounce gold coins, but those futures contracts are no longer traded, which may make them exempt (CME/Comex doesn't provide the specifications anymore, or know where they can be found; we're waiting to hear back from the CFTC).  We can't even find law that specifies what forms of silver are reportable (I.E. whether it applies to <i>current</i> or <i>current or obsolete</i> CFTC-approved futures contracts).  The best we can find is <a href="http://www.law.cornell.edu/uscode/uscode26/usc_sec_26_00006045----000-.html">26 USC § 6045(g)(3)(B)(iii)</a>.  That doesn't make it clear if it refers to current commodities, or also includes previously approved commoditites that are no longer traded.<p>

A dealer is required to fill out a 1099-B form and report it to the IRS, if you sell silver (or gold, platinum, or palladium) in [1] a form that the CFTC has approved for trading, and [2] is at least the minimum amount to satisfy a futures contract.<p>

Sales during a 24-hour period must be aggregated and treated as a single sale.  So selling a reportable amount in two transactions more than 24 hours apart would not normally be reportable.  However, there is of course an exception that if the broker knows or has reason to know that you are trying to avoid the reporting requirements, they are then required to report it.<p>

However, the only futures contracts currently traded appear to be:<p>
<ul>
<li>1000 ounce silver contracts
<li>5000 ounce silver contracts
<li>100 ounce gold contracts 
<li>33.2 ounce gold contracts
</ul>

However, in the past, there were 
<ul>
<li>25 1-Ounce Gold Coins
<li>1 or 10 $1,000 face value bags of 90% silver coins [unclear which; we are waiting for confirmation from CFTC]
</ul>

So selling any type of silver other than 1,000 ounce bars and 90% silver coins should not be reportable in any quantity (unless you are suspected of avoiding reporting requirements).  In the case of 1,000 ounce bars, a single bar would likely be reportable (since 'mini' contracts trade a single bar).  In the case of 90% silver coins, it should only if in $1,000 face value quantities or more, or possibly $10,000 or more (the specifications for the contract the amount is based on are no longer publicly available!).  However, it is unknown if 90% silver coins are required to be reported in the $1,000 face value quantity (since such futures contracts are not currently traded).<p>

<!-- <i>Starting January 1, 2012, unless repealed, selling over $600 of silver or gold will be <a href="1099-healthcare.htm">reported</a> on a 1099 form</i><p>-->

<h3>Trading Silver</h3>
Trading silver for gold, or gold for silver, is considered a "taxable event" (where you pay tax on any gain that you made from the metal that you gave the other party).<p>
The IRS does allow for "like kind" exchanges without being taxed at the time, such as trading 1 ounce generic rounds for 1 ounce generic bars.  They do not give a lot of guidance as to exactly what is considered "like kind" in terms of precious metals (except that trading silver for gold or vice-versa is not considered a like kind exchange).<p>


<h3>Other...</h3>
Note that the reporting rules are very complex.  There is certainly a chance that we misinterpreted something, and a slight possibility that we are unaware of a reporting rule of some sort.<p>

Also of note is that at least one major bullion dealer reports that "We are not aware of any reporting requirements and we do not accept cash, so we do not report sales or purchases of ANY amount."<p> <!-- http://tulving.com/New%20Pages/faq_frequently_asked_questions.htm -->

Also note that you normally are required to report the sale of precious metals on your taxes, and pay tax on any profits (as is the case with just about anything you may happen to make a profit on).  This is true whether or not the sale is reported.  So if you buy a silver coin for $10 and sell it for $15, no reporting will be done, but you must pay taxes on the $5 profit.<p>


<br>
<h3>Sources:</h3>
<a href="http://www.irs.gov/instructions/i1099b/ar02.html">IRS 1099-B Instructions</a>, covering selling silver<br>
<a href="http://www.irs.gov/businesses/small/article/0,,id=148821,00.html">IRS FAQs regarding Reporting Cash Payments of Over $10,000</a><br>
<a href="http://www.irs.ustreas.gov/pub/irs-tege/irc408.pdf">IRS: Sec. 408 INDIVIDUAL RETIREMENT ACCOUNTS</a>, defining collectibles (I.E. regarding <$10K cashier's checks and the like).<br>
<a href="http://edocket.access.gpo.gov/cfr_2009/aprqtr/26cfr1.6050I-1.htm">Treas. Reg. section 1.6050I-1(c)(iii)</a> defining what a 'designated reporting transaction' is (I.E. regarding <$10K cashier's checks and the like).<br>
<a href="http://www.cftc.gov/anr/anrdesig97.htm">CFTC Annual Report 1997</a> and <a href="http://www.cftc.gov/anr/anrdea_contracts.htm">Futures and Option Contracts Designated by the CFTC as of September 30, 1999</a> - Shows some obsolete contracts such as gold coin contracts.


<hr>



<center><h1>All About Silver in IRAs</h1></center>

<h3>Can I have silver in an IRA?</h3>
Yes, with certain restrictions.  The short answer is that you can have any .999 fine (or better) silver in your IRA (or .995 fine or better gold), if it is kept with a custodian (a bank, or someone who receives special authorization).<p>

<h3>What are the advantages?</h3>
The advantage is that the gains are tax-free.  This is helpful since gains on silver (and gold) are treated as capital gains on collectibles in the U.S., which means that you are taxed at the normal income tax rate (which is higher than the normal capital gains tax rate).

<h3>What are the disadvantages?</h3>
The main disadvantage is that you do not have physical possession of your silver (or gold).  Under normal circumstances, this is fine.  But if for some reason the metal isn't there when you go to sell it, you lose all the money you put in, and you lose all the gains you may have had.

<h3>What kind of silver can be in it?</h3>
It appears that any silver that is .999 fine (or better) can be in there, as well as any gold that is .995 fine or better.  All U.S. Eagles (the ones made in and after the 1980s) are definitely allowed.  Technically, any .900 fine (or better) silver and .9167 fine gold (or better) may be allowed.  From the laws, it appears as though the silver does not need to have any specific hallmark on it (as one dealer claims), nor does it need to be in kilogram amounts (as another implies).  See more details below.<p>

<h3>Who can be a custodian (have possession of the silver)?</h3>
<a href="http://www.law.cornell.edu/uscode/26/usc_sec_26_00000408----000-.html">26 USC 408</a>(m), that covers collectibles, refers to a trustee as mentioned in 26 USC 408(a)(2).  That requires the trustee to be a bank <i>or</i> someone who obtains approval of 'the Secretary' (presumably someone at the IRS).  A bank (per 26 USC 408(n)) can be a bank, an insured credit union, or a corporation that is subject to supervision and examination by the Commissioner of Banking (or equivalent in the state that the corporation is incorporated in).<p>

<h3>How does the process work?</h3>
Normally, you would open an IRA account with a company that can act as the custodian (a/k/a a 'self-directed IRA').  Then, you tell the company to buy the silver (or other precious metal) from the bullion dealer of your choice.  You will likely need to fill out a form authorizing the purchase.  

<h3>What are the details?</h3>

IRAs are covered by <a href="http://www.law.cornell.edu/uscode/26/usc_sec_26_00000408----000-.html">26 USC 408</a>.  Section 408(m) covers 'collectibles.'  Collectibles are items normally not allowed in IRAs (technically, they are allowed, but the amount spent is considered a distribution, and is subject to penalty).  Collectibles covers coins and bullion, with some exceptions.<p>

IRAs are allowed to contain U.S. Eagles (gold, silver, or platinum), coins issued under the laws of any State, or any gold, silver, platinum, or palladium bullion 'of a fineness equal to or exceeding the minimum fineness that a contract market requires for metals which may be delivered in satisfaction of a regulated futures contract'.  It does not state anything about minimum quantities.<p>

The two most common regulated futures contracts for precious metals are COMEX 5000oz silver and 100oz gold contracts.  The <a href="http://www.cmegroup.com/trading/metals/precious/silver_contract_specifications.html">5000oz silver contract</a> is defined with a minimum purity of .999 ("Silver delivered under this contract shall assay to a minimum of 999 fineness.").  The <a href="http://www.cmegroup.com/trading/metals/precious/gold_contract_specifications.html">100oz gold contract</a> is defined with a minimum purity of .995 ("Gold delivered under this contract shall assay to a minimum of 995 fineness").<p>

So it seems that any silver with a fineness of .999 or higher is allowed in IRAs (and any gold with a fineness of .995 or higher).<p>

Note that $1000 face value bags of 90% silver, as well as Krugerrands (.9167 fine) <i>used</i> to be traded, and still appear to be considered by the CFTC to be valid commodity contracts, and the IRS wants dealers to report when dealers buy these products.  So .900 fine or better silver, or .9167 fine gold could probably be used legally in an IRA -- but doing so involves the risk that the IRS may feel otherwise.  That's a risk you probably don't want to take.<p>

Note that the exception allowing these bullion items to be in an IRA <i>requires</i> that they be in the physical possession of a custodian.<p>


<hr>



<h3>Is it Legal to Melt U.S. Silver Coins?</h3>
<b>Yes</b>.<p>

Although many claim that it is not legal, it is.  The practice was banned starting in 1967, but then allowed in 1969.  See <a href="http://books.google.com/books?id=NwUEAAAAMBAJ&pg=PA43#v=onepage&q=&f=false">Kiplinger's Magazine, January 1974</a>, last paragraph.<p>

It is, however, illegal to melt U.S. pennies and nickels (silver 'war' nickels can be melted).  See the <a href="http://www.usmint.gov/pressroom/?flash=yes&action=press_release&ID=724">120-Day Ruling Press Release</a> and <a href="http://www.usmint.gov/pressroom/index.cfm?action=press_release&ID=771">Final Ruling Press Release</a>, and <a href="http://www.usmint.gov/downloads/consumer/FederalRegisterNotice.pdf">recent/current law</a> at the U.S. Mint website (which also confirms that melting silver coins was illegal from 1967-1969).  The full law can be found at <a href="http://ecfr.gpoaccess.gov/cgi/t/text/text-idx?c=ecfr&tpl=/ecfrbrowse/Title31/31cfr82_main_02.tpl">gpoaccess.gov</a>.<p>

The reasons for these are simple.  There are no longer any silver coins in circulation (except as people occasionally re-introduce them, usually by mistake), so melting them has no effect on day-to-day transactions.  However, melting pennies and nickels removes them from circulation, so it would harm the U.S. economy for people to melt them.<p>







<hr>





<center><h1>The Truth About Safe Deposit Boxes for Silver and Gold</h1></center>

Yes, they are safe!<p>

Most people knowledgeable about precious metals recommend that the best way to buy them is to have physical possession of them.  There are many possibilities here; you can have them in a safe in your house, under your mattress, hidden somewhere in your house, buried in your yard, with a friend, or in a safety deposit box at a bank.<p>

Safe deposit boxes do have some real drawbacks.  For example, they typically are not insured (however, the chances of getting your safety deposit box broken into is probably much less likely than your home being robbed).  Also, some states will seal your safe deposit box upon your death.  And the I.R.S. can freeze your box, preventing you from being allowed to open it.<p>

A safe deposit box at a bank is usually very safe.  However, there is a lot of questionable information and rumors out there, so lets address them.<p>

<h3>I heard that safe deposit boxes were sealed in 1933, is this true?</h3>
No!  This is a hoax, that states that Executive Order 6102 said "All safe deposit boxes in banks or financial institutions have been sealed" and "may only be opened in the presence of an agent of the Internal Revenue Service."  Again, <i>this is a hoax</i>.  We have tracked it back to a book "After the Crash - Life In the New Great Depression" (from 1996, on pp.193-194). It starts with the real text of <a href="http://www.presidency.ucsb.edu/ws/index.php?pid=14611">Executive Order 6102</a> (from 1933, requiring citizens to turn in their god), makes a few convenient changes, and then adds what appears to be made-up text.<p>

If there is any question, Executive Orders are written for an entire country, not individuals -- and the hoax refers to individuals (e.g. stating that the government knows that they have bullion).<p>

We have carefully examined the real Executive Order 6102 and writings of the time, and nothing in it even suggests that safe deposit boxes were sealed.  Sealing every safe deposit box in the country would have been a massive undertaking, and the manpower to have an IRS agent present at every opening just wasn't there (there was about 1 IRS agent for every 5,000 individuals).<p>

Ironically, the first version of the Wikipedia article on Executive Order 6102 was just the text of the hoax. Later, it was referred to as a rumor, and the entire text quoted. Then when people started trying to get the text of Executive Order 6102, they would quote the text of the hoax (as the Wikipedia article contained the full text of the hoax, but not the real text), spreading the hoax further.<p>

The clearest evidence that this is a hoax is that it refers to gold <i>and silver</i>, although silver ownership was not banned in 1933!<p>


<h3>California is opening safe deposit boxes!</h3>
There is some truth to this, but it is nothing to worry about.  An ABC report (at abcnews.go.com/GMA/Story?id=4832471&page=3) sounds very scary; talking about how some states accidentally open up safe deposit boxes when the owners could have been easily contacted.  And scary stories exist about how people lost millions of dollars due to lost deeds, or $10,000s due to jewelry that was sold at auction for much less than its true value, or sentimental items being sold off.<p>

First, cases like this are very rare.  Second, none of this applies to bullion.  If you have a 1-ounce gold bar in your safe deposit box, and it is accidentally opened and auctioned off, you will get the proceeds.  The bar isn't going to be sold for significantly less than the spot price, and shouldn't hold sentimental value to you.<p>

<h3>The Patriot Act - Will Homeland Security Seal Safe Deposit Boxes?</h3>
These appear to be hoaxes.<p>

A guy in a suit going by the name 'doobsta' on YouTube at www.youtube.com/watch?v=SuvzTwFZlFM states that U.S. legislation states that 'During a bank holiday, the U.S. Government has the right to open up all safety deposit boxes', and that there is a list of items that they can confiscate, including precious metals.  However, this term only appears on two websites, both pointing to that YouTube guy.  And the <a href="http://frwebgate.access.gpo.gov/cgi-bin/getdoc.cgi?dbname=107_cong_public_laws&docid=f:publ056.107.pdf">Patriot Act</a> does not mention bank holidays.<p>

Another story at bellaciao.org/en/article.php3?id_article=10012 claims that in the event of a 'national disaster', only agents of Homeland Security will be allowed to open safe deposit boxes, and that 'no weapons, cash, gold or silver will be allowed to leave the bank' and 'only various paperwork will be given to the owners.'  This sounds very suspicious.  First, 'allowed to leave the bank' suggests that the items would not be confiscated (that they would have to be put back in the box).  Second, it covers what IS NOT allowed, and what IS allowed -- but leaves out lots of stuff.  What about trinkets?  Jewelry? Stock certificates?  Bearer Bonds? Platinum bars?  Government lawyers would never have a list of things that are included and not included -- they always either list what is included (with everything else being excluded) or everything that is excluded (with everything else being included).<p>

In the event of a true state of emergency, the President could come up with an Executive Order that would handle all of this -- so there is no need for a top-secret safety deposit box procedure that 10,000s of bank employees would be told about (during a 2-day workshop, no less!).<p>

<h3>Can the I.R.S. Access my Safe Deposit Box?</h3>
Yes, under certain conditions.<p>

They cannot simply go to the bank and open up your safe deposit box.  However, if they have a judgement against you, it sounds like they can freeze your account (where you would be unable to open the box), using a '<a href="https://www.dccu.us/accounts-and-services/safe-deposit-box.php">Notice of Levy</a>'.  Then, you would be present during the opening of the box.<p>

<h3>Can Someone that Wins a Lawsuit Against Me Access my Safe Deposit Box?</h3>
Yes.<p>

As an example, see this document from the <a href="http://www.courtinfo.ca.gov/selfhelp/smallclaims/collectmoreways.htm">California Courts</a>.<p>

<h3>Can Cash be Kept in a Safe Deposit Box?</h3>
Yes.<p>

There are some people that may imply otherwise.  However, there is nothing restricting you from having cash in a safe deposit box.<p>

<h3>Are the Contents of my Safe Deposit Box Insured?</h3>
No.<p>

It is possible that the bank may have insurance; however, it is very unlikely (especially since they have no idea of the value of the contents of the safety deposit boxes).<p>




<hr>




<h1>THIS HAS BEEN REPEALED</h1>

The below information is about a law that was passed, to take effect on January 1, 2012.<p>

HOWEVER, the law HAS BEEN repealed.  The repeal has passed the House and Senate (on 05 Apr 2011, 87-12 vote), and the President signed the bill on 14 Apr 2011.<p>

Details of the law are here, for the curious, regarding what could have happened:<p>
<br><br><br><br>

<hr>


<h1>1099s</h1>

In the United States, there is a reporting requirement that requires businesses to fill out 1099 forms for certain transactions of $600 or more.  These get sent to the IRS.  These are typically filled out when individuals receive $600 or more of non-wage income from a business over the course of a year.  The law can be found at <a href="http://www.law.cornell.edu/uscode/26/usc_sec_26_00006041----000-.html">here</a>.

<h1>New Law</h1>
In March, 2010, HR3590 ("The Patient Protection and Affordable Care Act") was passed.  You can find it <a href="http://democrats.senate.gov/reform/patient-protection-affordable-care-act-as-passed.pdf">here</a>.  This 900 page health care bill has on page 737, section 9006 titled "EXPANSION OF INFORMATION REPORTING REQUIREMENTS."  This section changes the reporting requirements.<p>

Specifically, it changes the law so that [1] payments to corporations are included (except ones exempt per <a href="http://www.law.cornell.edu/uscode/26/usc_sec_26_00000501----000-.html">section 501(a)</a>, such as charities), and [2] "amounts in consideration for property" are included (so purchases over $600 are reported).  The law takes effect January 1, 2012.<p>


<pre>
<b>SEC. 9006. EXPANSION OF INFORMATION REPORTING REQUIREMENTS.</b>
     (a) IN GENERAL.—Section 6041 of the Internal Revenue Code of 1986 is amended by adding at the end the
following new subsections:
     ‘‘(h) APPLICATION TO CORPORATIONS.—Notwithstanding any regulation prescribed by the Secretary before
the date of the enactment of this subsection, for purposes of this section the term ‘person’ includes any
corporation that is not an organization exempt from tax under section 501(a).
     ‘‘(i) REGULATIONS.—The Secretary may prescribe such regulations and other guidance as may be
appropriate or necessary to carry out the purposes of this section, including rules to prevent duplicative
reporting of transactions.’’.
     (b) PAYMENTS FOR PROPERTY AND OTHER GROSS PROCEEDS.— Subsection (a) of section 6041 of the Internal 
Revenue Code of 1986 is amended—
          (1) by inserting ‘‘amounts in consideration for property,’’ after ‘‘wages,’’,
          (2) by inserting ‘‘gross proceeds,’’ after ‘‘emoluments, or other’’, and
          (3) by inserting ‘‘gross proceeds,’’ after ‘‘setting forth the amount of such’’.
     (c) EFFECTIVE DATE.—The amendments made by this section shall apply to payments made after 
December 31, 2011.
</pre>

<h1>Key Facts</h1>
<ul>
<li>This reporting is <i>only</i> required to be done by businesses ("All persons engaged in a trade or business"), when they pay money for something.
<li>This reporting <i>will</i> be done if you sell bullion worth $600 or more.
<li>The government will <i>not</i> know that you sold bullion (but would have the information necessary to compile a list of people who either had bullion, or a connection with the bullion industry).
<li>This reporting is <i>not</i> required when you <i>buy</i> bullion.
<li>This reporting is <i>not</i> required for transactions between two individuals, only when the buyer is a business.
<li>You are always required to report income on your tax return whether or not you receive a 1099 form.
<li><a href="http://thomas.loc.gov/home/gpoxmlc111/h5141_ih.xml">H.R. 5141</a> is attempting to repeal this (see also <a href="http://www.govtrack.us/congress/bill.xpd?bill=h111-5141">govtrack.us</a>).  If passed, it would cause the new law not to take effect, so reporting would continue as it had in the past.
</ul>






<hr>








<br><br>
<h1>Silver, Gold and Taxes (in the United States)</h1>

Please note, tax laws are very complex, and change frequently.  Therefore, this information may be inaccurate or outdated (but to the best of our knowledge is not).<p>

Also see our <a href="/28percent.htm">Truth About the 28% Tax</a> page.  In the United States, the tax you pay may be a lot less than you expect, and rarely 28%.<p>

<h2>When Buying Silver or Gold</h2>
In the United States, there is no GST, VAT, national tax or the like.  The only tax that you might pay is state sales tax, depending on which state you live in.  In states with sales tax that covers bullion, purchases over a certain amount are normally exempt (just check with your local dealer to find out).  If you live in a state with sales tax, and order online from an out-of-state company, the company will likely not charge you sales tax (but you will likely be expected to pay 'use tax' to your state).<p>

When buying silver or gold, you need to keep track of what you bought and when (so that you can report the capital gains or loss, as mentioned later).<p>

<h2>When Selling Silver or Gold</h2>
When selling, you will pay federal tax if you receive more than you original paid.  As of this writing, gold, silver, and platinum bullion (and any type of coins) are treated as collectibles.  That means that gains (your "profit") are usually treated as income, and but if it is a long-term gain the <i>maximum</i> rate would be 28% (it gets reported on the 1040 Schedule D).<p>

The price that you original paid (including any commissions, fees, etc.) is normally your 'basis', which is used to determine if you made a gain or a loss.  If you sell for more than that, you pay the 28% capital gains rate (however, if you would have a lower tax rate if the capital gains were treated as income, that lower rate will apply).  Also, if the gain is short-term (you bought it less than 1 year before selling it), you are taxed at your normal income tax rate.<p>

Note that you may need to file <a href="http://www.irs.gov/businesses/small/article/0,,id=110413,00.html">estimated taxes</a> after you sell bullion.  This is typically the case if you end up owing the IRS at least $1,000 after withholdings are accounted for.<p>

<h2>Sales Tax</h2>
Some states require that you pay sales tax on bullion purchases, often only under a certain amount (e.g. purchases under $500).<p>

We were going to research which states collect sales tax on bullion, but <a href="http://thecoinologist.com/sales-tax-state-by-state-breakdown/">The Coinologist</a> already did.  Thank you!<p>

Summary of states that <b><i>do</i></b> collect sales tax on bullion:  Alabama, Arkansas, Washington DC, Hawaii, Indiana, Kansas,
 Kentucky, Maine, Minnesota, Nebraska, New Hampshire, New Jersey, New Mexico, North Carolina, Ohio, Oklahoma, Tennessee,
 Vermont, Virginia, West Virginia, Wisconsin, Wyoming.<p>

Summary of states that <b><i>do not</i></b> collect sales tax on bullion:
Arizona,
Delaware,
Georgia,
Idaho,
Illinois,
Iowa,
Michigan,
Mississippi,
Missouri,
North Dakota,
Oregon,
Pennsylvania,
Rhode Island,
South Carolina,
South Dakota,
Utah,
Washington<p>

Summary of states that <b><i>do</i></b> collect sales tax on bullion, but have exemptions over a certain amount:
California ($1,500),
Connecticut ($1,000),
Florida ($500),
Louisiana ($1,000),
Maryland ($1,000),
Massachusetts ($1,000),
New York ($1,000),
Texas ($1,000).<p>

Summary of states that <b><i>vary</i></b> based on city or county (no state tax):  Alaska, Montana, Colorado.<p>



<table border>
<tr><td><a href="http://www.azleg.gov/ars/42/05061.htm">Arizona</a></td><td>Not taxed</td><td>42-5061(A)(21)&nbsp;</td></tr>
<tr><td><a href="http://www.boe.ca.gov/lawguides/business/current/btlg/vol1/sutr/1599.html">California</a></td><td>Taxed up to $1,500</td><td>South African coins are always taxed (e.g. Krugerrands). California Gold medallions are not taxed. Regulation 1599.</td></tr>
<tr><td><a href="http://askdrs.ct.gov/scripts/drsrightnow.cfg/php.exe/enduser/std_adp.php?p_faqid=708">Connecticut</a></td><td>Taxed up to $1,000</td><td>Conn. Gen. Stat. § 12-412(45).</td></tr>

<tr><td><a href="http://www.flsenate.gov/Laws/Statutes/2012/Chapter212/All">Florida</a></td><td>Taxed under $500</td><td>212.08 (7)(ww)</td></tr>


<tr><td><a href="http://law.onecle.com/georgia/48/48-8-3.html">Georgia</a></td><td>Not taxed</td><td>Title 48, Section 48-8-3 (66)</td></tr>

<tr><td><a href="http://www.legislature.idaho.gov/idstat/Title63/T63CH36SECT63-3622V.htm">Idaho</a></td><td>Not taxed</td><td>Title 63 Chapter 36 (63-3622V)</td></tr>
<tr><td><a href="http://www.in.gov/dor/reference/files/sib50.pdf">Indiana</a></td><td>Taxed</td><td>Information Bulletin #50, December 2002.</td></tr>
<tr><td><a href="http://rvpolicy.kdor.ks.gov/Pilots/Ntrntpil/IPILv1x0.NSF/ae2ee39f7748055f8625655b004e9335/3bb93e2d360d387a86256523006b3f1a?OpenDocument">Kansas</a></td><td>Taxed.</td><td>Regulation Number 92-19-56</td></tr>
<tr><td><a href="http://legis.la.gov/lss/lss.asp?doc=101815">Louisiana</a></td><td>Taxed up to $1,000</td><td>RS 47:301 Chapter 2 Section 301 (16)(b)(ii)</td></tr>
<tr><td><a href="http://www.malegislature.gov/Laws/GeneralLaws/PartI/TitleIX/Chapter64h/Section6">Massachusetts</a></td><td>Taxed up to $1,000</td><td> Chapter 64H Section 6 (ll)</td></tr>
<tr><td><a href="http://www.moga.mo.gov/statutes/C100-199/1440000815.HTM">Missouri</a></td><td>Not Taxed.</td><td>Chapter 144 Section 144.815</td></tr>
<tr><td><a href="http://www.tax.ny.gov/pdf/memos/sales/m89_20s.pdf">New York</a></td><td>Taxed up to $1,000</td><td>Section 1115(a)(27)</td></tr>
<tr><td><a href="http://www.legis.nd.gov/cencode/t57c39-2.pdf?20130201124135">North Dakota</a></td><td>Not taxed</td><td>57-39.2-04.31</td></tr>
<tr><td><a href="http://www.tax.ok.gov/rules/Rules2012/Chapter%2065%20Sales%20and%20Use%20Tax%20_2_.pdf">Oklahoma</a></td><td>Taxed</td><td>710:65-13-95 exempts bullion stored at a recognized depository.</td></tr>
<tr><td><a href="http://www.tax.ri.gov/help/synopsis.php">Rhode Island</a></td><td>Not taxed</td><td>Title 44, Chapters 18-19, </td></tr>
<tr><td><a href="http://www.scstatehouse.gov/code/t12c036.php">South Carolina</a></td><td>Not taxed</td><td>Section 12-36-2120 (70)(a)</td></tr>
<tr><td><a href="http://dor.sd.gov/formsandpub/SummaryofStateSalesTaxExemptions0113.pdf">South Dakota</a></td><td>Not taxed</td><td>10-45-110</td></tr>
<tr><td><a href="http://www.tn.gov/attorneygeneral/op/2012/op12-110.pdf">Tennessee</a></td><td>Taxed</td><td>Attorney General Opinion #12-110, December 2012.</td></tr>
<tr><td><a href="http://apps.leg.wa.gov/wac/default.aspx?cite=458-20-248">Washington</a></td><td>Not Taxed</td><td>WAC 458-20-248</td></tr>
<tr><td><a href="http://docs.legis.wi.gov/code/admin_code/tax/11/IX/78/1/c?up=1">Wisconsin</a></td><td>Taxed</td><td>Tax 11.78 (1)(g)</td></tr>

<!--
<tr><td><a href=""> </a></td><td> </td><td>&nbsp;</td></tr>
-->
</table>


<h2>Tax Fraud</h2>
Many people in forums state that they do not or will not pay tax when selling their silver or gold.<p>

Worse, many people also go to great lengths to not "leave a paper trail" -- in other words, they don't get receipts for their purchases (presuambly because they expect not to pay taxes later).  Once, I made a trade with a well known bullion dealer at a coin show; while I was waiting, I saw him make a trade with another dealer and print a receipt.  But for my trade, he was not expecting to give me a receipt.  It was clear that customers more often than not do not want paperwork.<p>

However, you should think carefully before doing this.  Tax fraud can have serious consequences:  [1] In rare cases, you could go to jail; [2] the penalties for tax fraud are higher than for negligence; [3] the normal 3-year statute of limitations <a href="http://www.law.cornell.edu/uscode/text/26/6501">goes away</a> (normally, 3 years after a return is filed, the IRS cannot change it).<p>

So if you hide gains from silver sales for decades, and one of your recent returns gets audited, you could end up owing an astronomical amount.  Normally, the IRS can only look at returns for 3 years.  But if they discover fraud, they can go back as far as the fraud does.  So you may end up owing taxes, penalties, and interest on all the gains for all the years.<p>

For those that think they will not get caught, one of the standard questions that auditors ask during an audit is whether or not you keep money in a hidden location (such as a safe) [see <a href="http://johnrdundon.com/tag/irs-audit-questions/">here</a>].  No matter what you answer, if you buy a lot of things with cash, they will need to see where the money is coming from (and if you lie about having hidden cash, it helps the fraud case).<p>

Also, many people somehow believe that not having a receipt for making a silver purchase would benefit them (perhaps they are envisioning a team of government agents tearing through their house looking for receipts, which only happens in movies and to those wearing tin foil hats).  The government doesn't care if you purchased silver, only if you reported any gains.  If you <i>did</i> sell silver, and get audited, you'll need to have the receipt from purchasing it to prove what you gain (or loss) is.  Without the receipt, you could be at the mercy of the IRS.<p>



<h2>What Else Should I Know?</h2>
<ul>
<li>There are certain <a href="/reporting.htm">reporting requirements</a> that dealers may need to handle, so it is possible that the IRS may know about sales of bullion.

<li>It is <i>very</i> important to keep track of your purchases (and any trades you may make).  If you do not, when you sell you may find that you cannot determine what your gain was.  In that case, you may need to report your basis as 0, and you could end up paying more taxes than your gain!

<li>Barter is <a href="http://www.irs.gov/businesses/small/article/0,,id=188095,00.html">taxed</a>.  So if you paid $500 each for 4 1-ounce U.S. gold eagles ($2,000 total), and then later buy a used car worth $4,000 for those same 4 eagles (now worth $1,000 each), the IRS considers it the same as having sold them.  As such, you would need to report a capital gain of $2,000 (the difference between the $4,000 value and the $2,000 basis).

<li>For taxes, you cannot treat gold or silver coins at their <a href="http://www.irs.gov/irb/2008-04_IRB/ar12.html">face value</a> (Frivolous Position #13).  In the barter example above, the seller could not claim that he sold his car for $200 (the face value of those gold eagles).  This may result in a $5,000 'frivolous return' penalty!

<li>You cannot claim that gains on gold or silver aren't taxable since gold or silver preserve value, and protect against the decline of fiat currency.  See <a href="http://www.irs.gov/irm/part4/irm_04-010-012r.html">Frivolous Argument #15 here</a>.

</ul>









<hr>





<h1>28% Taxes</h1>

<h3>Summary</h3>
If you have a gain when selling physical silver (or any other collectible, or ETF backed by collectibles like SLV), it is taxed exactly as if it was earned income, except that if the gain was long-term the tax rate is limited to 28%.<p>


<h3>Information on 28% Capital Gains Tax Rate for Silver and Gold</h3>

Most investors in silver and gold find out at some point that when selling, they are taxed as collectibles, at the <i>maximum rate</i> of 28%, and get quite upset!  Many even decide not to pay tax when they sell, and risk serious fraud penalties.  Worse, investing in ETFs backed by silver is taxed the same as physical.<p>

The truth is a bit different.  The term "maximum rate of 28%" is used frequently, and it makes it sound like you are being penalized, and that the rate is always 28% (it sounds like they are saying "You have to pay the maximum rate, which is 28%").  That isn't quite the case.  The "Maximum" here simply means that the most you will pay on capital gains when selling silver (or gold or other collectibles) is 28%, never higher.  It could have been correctly and <b>more accurately phrased</b> as "The maximum the rate can be is 28%" or "<b>The tax rate is limited to a maximum of 28%</b>".<p>

In the United States, all income is always taxed at a specific tiered rate -- unless the law says otherwise.  And for collectibles, the law has a somewhat <i>lower</i> rate, which is limited to no more than 28%.<p>

<h3>Examples</h3>

Let's say that Joe has several options for making money in the tax year in question.  He lives rent free and only needs $10,000 to make it through the year.  He can either work, or sell some investments.  One option is to sell physical silver, another is to sell shares of Apple.  In either case, they can be either long term gains (owned more than 1 year) or short term gains (owned less than 1 year).  He is single, and has $9,500 in standard deductions and exemptions, using 2011 tax tables.<p>

<table border>
<tr><th>Situation</th><th>Total Income</th><th>Taxable Income</th><th>Tax</th><th>Eff. Tax Rate</th><th>Notes</th></tr>
<tr><td>He <b>works</b> part time, and earns $10,000 for the year.</td>
    <td>$10,000</td><td>$500</td><td>$51</td><td>0.51%</td><td>This is earned income.  Little tax due, since his income is just above the standard deduction and exemptions.</td></tr>
<tr><td>He sells $10,000 of <b>silver</b> he bought for $6,000 a <b>few years ago</b>.</td>
    <td>$4,000</td><td>$0</td><td>$0</td><td>0%</td><td>This is long term collectibles capital gains.  No tax due, since his income is less than standard deduction and exemptions.</td></tr>
<tr><td>He sells $10,000 of <b>Apple</b> shares he bought for $6,000 a <b>few years ago</b>.</td>
    <td>$4,000</td><td>$0</td><td>$0</td><td>0%</td><td>This is long term capital gains.  No tax due, since his income is less than standard deduction and exemptions.</td></tr>
<tr><td>He sells $10,000 of <b>silver</b> he bought for $6,000 a <b>few months ago</b>.</td>
    <td>$4,000</td><td>$0</td><td>$0</td><td>0%</td><td>This is short term collectibles capital gains.  No tax due, since his income is less than standard deduction and exemptions.</td></tr>
<tr><td>He sells $10,000 of <b>Apple</b> shares he bought for $6,000 a <b>few months ago</b>.</td>
    <td>$4,000</td><td>$0</td><td>$0</td><td>0%</td><td>This is short term capital gains.  No tax due, since his income is less than standard deduction and exemptions.</td></tr>
</table>
<br>
So we can see here that if you do not have much income (regardless of the source), it is possible to pay no taxes, regardless of the source of income.<p>

Here's another example, where he makes more money:

<table border>
<tr><th>Situation</th><th>Total Income</th><th>Taxable Income</th><th>Tax</th><th>Eff. Tax Rate</th><th>Notes</th></tr>
<tr><td>He <b>works</b> full time, and earns $100,000 for the year.</td>
    <td>$100,000</td><td>$90,500</td><td>$18,964</td><td>18.7%</td><td>This is earned income.</td></tr>


<tr><td>He sells $100,000 of <b>silver</b> he bought for $60,000 a <b>few years ago</b>.</td>
    <td>$40,000</td><td>$30,500</td><td>$4,154</td><td>13.6%</td><td>This is long term collectibles capital gains, which are taxed at regular income rates with a 28% maximum.</td></tr>

<tr><td>He sells $100,000 of <b>Apple</b> shares he bought for $60,000 a <b>few years ago</b>.</td>
    <td>$40,000</td><td>$30,500</td><td>$0</td><td>0%</td><td>This is long term capital gains.  No tax due, since the $30,500 would put him in the 15% tax bracket, and the capital gains rate was 0% at that tax bracket.</td></tr>

<tr><td>He sells $100,000 of <b>silver</b> he bought for $60,000 a <b>few months ago</b>.</td>
    <td>$40,000</td><td>$30,500</td><td>$4,154</td><td>13.6%</td><td>This is short term capital gains, which are taxed as regular income.</td></tr>

<tr><td>He sells $100,000 of <b>Apple</b> shares he bought for $60,000 a <b>few months ago</b>.</td>
    <td>$40,000</td><td>$30,500</td><td>$4,154</td><td>13.6%</td><td>This is short term capital gains, which are taxed as regular income.</td></tr>
</table>
<br>
Here, we see a more realistic example where selling the silver generates less tax than working (since the original purchase was made with money that had already been taxed).  And, for short term gains the rates for selling silver are identical to selling stocks.  The long term collectibles gain generates a bigger tax bill than the stocks, but is still only 13.6% (and only 4% of the $100,000 received).


<h3>What <i>is</i> the Tax Rate for Selling Silver?</h3>
You probably know the first step:  you determine the <i>capital gain</i> (essentially, your profit).  This is normally the price you received (after any fees, commissions, etc., if you paid any) minus the price you paid (minus fees, commissions, etc., if you paid any).  So if you paid $250 for a silver bar and sell it for $300, you have a capital gain of $50.<p>

So in this case, you owe tax on $50.<p>

Now, the actual tax you will pay isn't necessarily 28% ($14 in this case) that many people lead you to believe you owe.<p>

The rate you pay is usually the same rate you pay for your income tax, with a maximum of 28%.  Let's say you are married, with no dependent children, and earn $70,000 a year.  Your first $19,000 or so of income is tax-free, allowing you over $88,000 of income at the 15% tax bracket.  So the $50 profit would get taxed at the 15% tax rate, not 28%.  Selling the bar for $300 would generate a tax of $7.50.<p>

<h3>Who Pays 28%?</h3>
The only way that you would actually pay 28% would be if you are in the 28% tax bracket, which (for married filing jointly; $85,600 for an individual) starts at $142,700/year (after deductions, so perhaps $150K-$180K or more).  So you have to be making a good amount of money to actually pay the 28% rate.<p>





<hr>






<br>
<center><h2>COMEX 101:</h2><h3>All About the Gold and Silver Futures Market</h3></center>
<br>

Although this page usually refers specifically to silver, the same applies to gold with a few minor differences (e.g. the contract size of 100 vs 5,000 oz, and the costs involved).<p>

Silver futures are just an agreement between two parties, where one agrees to buy a specific amount of silver from the other at a set time in the future.  In the United States, this is normally done through an organization called COMEX.<p>


<br><h3>What is a Short Sale?</h3>
A short sale is when someone agrees to sell silver in the future (which they usually do not have).  This is perfectly legal, and necessary for the futures market to work.  Without someone agreeing to sell in the future (the short), nobody could agree to buy in the future (the long).  There must be one short seller for every long.  The short seller is hoping that the price of silver will go down, and that when the contract expires, they will simply be paid the difference in the price of silver if it has gone down.  There is a chance that they may need to deliver the physical silver (regardless of how the price moves), in which case they would need to buy it.<p>

<br><h3>How Does the Buying Process Work (Going Long)?</h3>
Let's say it is January 1, 2010.  You decide that you want to buy some silver.  You decide to 'go long' 1 contract of June, 2010 silver at $20/ounce.  This means that you agree to buy 5,000 ounces of silver (the amount per contract) in June, 2010 (although if you do not want to take delivery, you can sell the contract before June, 2010) <!-- https://marketforceanalysis.com/index_assets/COMEX%20Inventory%20Shows%20Alarming%20Trend.pdf implies 'held into delivery month' -->.  <!-- REMOVED 03 Dec 2010: In reality, you would have a margin account, in which case you only have to put down a percentage of what you owe -- but that just complicates things, so let's assume you just buy the one contract and pay the $100,000 on January 1, 2010. --><p>

In order for you to make this agreement, someone else needs to 'go short' 1 contract of June, 2010 silver at $20/ounce, in which they agree to sell 5,000 ounces of silver at $20 in June.  If they want, they can deliver the silver to the warehouse and get their $20/ounce, or they can buy a long position to offset their short position.<p>

<br><h3>Where Does the Silver Come From (Taking Delivery)?</h3>
The vast majority of futures contracts end up being settled in cash, where no silver changes hands.  But, if you want the physical silver, you can get it -- after all, that is the whole point of the futures market.  <!-- At this point, let's assume that the COMEX warehouses had no silver in them when you made your purchase.-->  When your contract is about to expire, here are the possible outcomes:<p>

<ol>
<li>You decide that you want the silver, and you want to keep it in the COMEX warehouse.  You wait (called 'standing for delivery'), and by the end of June, 2010 the short will have given the Clearing House a Notice of Intention to Deliver.  The Clearing House will then send an Assignment Notification to the seller and to you, which lets you know who the seller is, and a list of the serial numbers of the bars you will receive.<!-- 7A06(C) -->  You will also receive an invoice.  The short will deliver to a COMEX warehouse the 5,000 ounces of silver (or turn in a warehouse receipt, if they have one -- it appears that they can buy them from bullion banks that have silver in the Registered category).  You are then given the warehouse receipt (or your dealer can hold it for you), at which point you own the silver.

<li>You decide that you want to take delivery.  The same as situation #1 happens, except you then immediately request delivery and turn in your warehouse receipt.  You get your silver.

<li>You decide that you do not want the silver, you want to take the profit or loss.  In this case, you sell your contract at the current price (before the beginning of June, 2010 -- or else you may have to take delivery).  If the price is now $21, you make $5,000 profit; if it is $19, you have a $5,000 loss <!-- REMOVED 03 Dec 2010: (if you trade on margin, these figures would be much higher) -->.

<li>You decide that you do not want the silver, but you want to keep a futures position.  In this case, you roll over the contract, by selling your current contract and buying one for a future month.
</ol>

<br><h3>What is in the Warehouses?</h3>
COMEX has several warehouses for metals (see the lists for <a href="http://www.cmegroup.com/trading/metals/silver-depositories.html">silver</a> and <a href="http://www.cmegroup.com/trading/metals/gold-depositories.html">gold</a>).  They contain lots of silver.  They had 152.003 million ounces (as of 17 Jan 2013), worth about 
<script>
document.write( '$' + FormatDollars( 20.82 * 152.003, 2 ) );
</script>
million.  This is split into two categories: Eligible and Registered.<p>  <!-- See https://www.kitcomm.com/showthread.php?t=29225&page=4 -->

<!--
Eligible silver is silver that has been purchased (and paid for) by a long at some point in the past (that they are currently paying storage fees for), and is eligible for delivery at any point that the client wants.  It has been assigned to the clients, who have the serial numbers of their bars.<p>
-->
Eligible silver is silver that is in a COMEX vault and has been determined to meet the COMEX requirements (e.g. minimum fineness and weight, acceptable refiner).  Often this is silver that has been purchased by a long (paid in full, not part of a COMEX contract) at some point in the past (that they are currently paying storage fees for).  The silver is eligible for delivery at any point that the owner wants.  It has been assigned to the owner, who has the serial numbers of their bars.  Eventually, it will either be delivered to the owner, or become registered silver.  It is the same as silver in any other vault, except that the silver is within the COMEX system (known to meet COMEX requirements).<p>

Registered silver is silver that is sitting in the COMEX warehouse, and can be used to settle a contract.  The warehouse has issued a depository receipt (warrant).  Warrants are issued in the name of an Exchange Clearing Member (corporations that handle trades, typically for their customers), not individual traders.  When a short needs to settle their contract, the silver they provide the long must be registered.  The short can buy it from a bullion bank, convert eligible silver they have, or use silver they they had previously stopped (from a long contract).

As of 17 Jan 2013, there were 37.976 million ounces of registered silver (available), worth about
<script>
document.write( '$' + FormatDollars( 20.82 * 37.976, 2 ) );
</script>
million and 114.027 million ounces of eligible silver (customer owned) in the COMEX warehouses, worth about
<script>
document.write( '$' + FormatDollars( 20.82 * 114.027, 2 ) + ' million.' );
</script>
<p>


<br><h3>Position Limits</h3>
COMEX has position limits, which are the maximum number of contracts that you can have open at one time.  As of this writing (June, 2010), anyone with 150 silver (or gold) contracts needs to report to COMEX their positions.  The limit is 1,500 contracts in the current (spot) month for silver (3,000 contracts for gold), with 6,000 silver (or gold) contracts in all months combined.  The position limits can be found at the <a href="http://www.cmegroup.com/rulebook/files/CBOTChapter5_InterpretationClean.pdf">COMEX website</a>.<p>

For silver, the 1,500 contracts controls 7,500,000 ounces of silver, worth about
<script>
document.write( '$' + FormatDollars( 20.82 * 7.5, 2 ) );
</script>

million.  For gold, the 3,000 contracts controls 300,000 ounces of gold, worth about 
<script>
document.write( '$' + FormatDollars( 1341.10 * .3, 2 ) );
</script>
million.<p>

<br><h3>Costs</h3>

There are various costs involved in purchasing silver (or gold) through the futures markets.  Here are the ones we are aware of:<p>

<ul>
<li>A commission, paid to your broker, that includes exchange fees.  This is to buy the original contract and receive delivery on it.  One person reported a $100 broker fee for handling delivery (in addition to the standard commission to buy the original contract). <!-- http://goldismoney2.com/showthread.php?4856-Delivery-of-a-COMEX-silver-contract-My-experience -->
<li>The actual cost of the silver.  This is the price per ounce multiplied by the number of ounces you will actually receive (which may vary up to 6%).
<li>If the seller pre-paid storage costs, you will be responsible for up to 30 days worth (per <a href="http://www.cmegroup.com/rulebook/NYMEX/1/7A.pdf">7A06(F)</a>), but you would have paid that to the warehouse anyways if the seller had not prepaid.  The seller has to pay the storage costs up to and including the day of delivery.
<li>If the seller paid for 'in and out labor', you are required to pay half of it, but you would have paid that anyways if the seller had not paid the fee.  In other words, the seller paid to have the silver put into the warehouse and taken out of the warehouse -- so you are responsible for the cost to get it out of the warehouse. <!-- 7A06(F) -->
<li>Transportation.  You can pick it up yourself (which is not recommended!), or have it transported for you.  For silver, the one report we've heard of is about $1,000-$2,000 to deliver 1 contract (5,000 ounces).  In 2003, Brinks would have charged up to $.09 to $.27/ounce for gold (minimum $135), plus a $20 security charge per a <a href="http://www.silverbearcafe.com/private/paperintogold.html">silverbearcafe</a> article (confirmed about $150 in 2009 <a href="http://goldnews.bullionvault.com/turning_gold_futures_gold">here</a>).  
<li>Monthly storage fee, if you have the silver or gold stored in a warehouse.  COMEX reports <!-- www.cmegroup.com/trading/metals/files/Storage_charges_for_precious_metals.pdf --> in June, 2010 that for silver it costs from $30-$35/month per contract, or $.072-$.084/oz per year.  However, the Delaware Depository lists their cost as $20/contract per month, or $.048/year per ounce (in 2004, they charged $18.50/month).  For gold, it is $12-$15/bar monthly, or $1.44-$1.80/year per ounce.
<li>'Out Charge' or 'Delivery Out' - The charge to remove the silver from the warehouse.  In June, 2010 COMEX reports that the out charge is $125 per contract ($.025/ounce), although Delaware Depository states $100/contract ($.02/ounce) on their website <!-- http://www.delawaredepository.com/bullion/exchange.asp -->($65 in 2004).  For gold, it is $25 per bar ($.25/ounce).
<li>If you take delivery, and want to send the silver back to the warehouse (sell it short), you would need to pay to have the bar assayed and/or recertified. This is not necessary if you just hold on to the warehouse receipt.
</ul>

<br><h3>Margins</h3>
When you buy a long position or sell a short position, it is done on margin.  So if you buy a long contract for 5,000 ounces of silver for June, 2010 at $20, the total value of the silver is $100,000.  However, you would only be required to put down a small amount (perhaps $5,000).  If the price of silver goes up, the money is deposited into your account.  If the price of silver goes down, money is removed from your account, and when it gets below a certain amount, you are required to immediately come up with the more money (or else your position is sold).<p>

Let's again assume that silver is $20/ounce, and you have $100,000 to spend.  If you wanted to put all that money into physical silver (as opposed to futures), you could go out to a bullion store and spend $100,000 and get it today.  Or, you could put down a small amount ($5,000 in the example above), and then pay the other $95,000 when you received the delivery notice.<p>

If you are looking to play the market, and think the price of silver is going to go up, you could instead buy 20 long contracts (100,000 ounces of silver worth $2M) for that $100,000.  If silver goes up $1, you would make $100,000, and double your money!  If silver goes down $1, though, it wipes out your entire investment, and you would be required to put up another $100,000 to keep the position (or else it would be liquidated, or sold).<p>

This leverage can obviously be very lucrative, or very dangerous (if you are not careful).<p>

<br><h3>Offsetting</h3>
You may have noticed that buyers are required to take delivery of metal, and sellers are required to make delivery of the metal -- unless they offset their positions.  So how does <i>that</i> work?<p>

Let's say that there are currently no June, 2010 contracts.  You are the first to buy one, and you go long 1 contract.  For that to happen, someone else goes short 1 contract (promising to deliver the silver in June, 2010).  The short is required to either deliver, or buy an offsetting position (in this case, 1 long contract).  Since there is only 1 long contract they can buy (yours), if they buy it, they would have to deliver to themselves -- so the exchange doesn't require them to deliver.  If you were not willing to sell your long contract, the short would have to provide you with the metal (but there are market makers that help ensure that the short can buy an offsetting long contract).<p>

Or, let's say that you ("Long A") buy 1 long contract for June, 2010.  Someone ("Short A") sells short 1 contract, in order for you to buy.  Then, someone else ("Long B") goes long 1 contract (which requires another person ("Short B") to go short 1 contract).  At this point, there are 2 people with a long position, and 2 people with a short position.  If Short A does not want to deliver, he can buy the long contract from Long B.  Now there is 1 person with a long position (you, Long A) and one person with a short position (Short B).  When it comes time to deliver, Short B will provide the silver to you.  Short A is now also Long B, so as before, the exchange doesn't require him to deliver to himself.<p>

That's how offsetting works.  Essentially, if you have both long and short positions, any extras get cancelled out.  So if you have 1,000 long positions and 100 short positions, you end up with 900 long positions.  Or, if you have 1,000 short positions and 100 long positions, you end up with 900 short positions.<p>

<br><h3>Delivery Notices</h3>
A short seller is required to either close out his position by buying an offsetting long position, or deliver the silver.  This is done by issuing a delivery notice ("Notice of Intention to Deliver").  COMEX then decides which long will be assigned the delivery (whoever bought their long position first), and sends an Assignment Notification (to the long and short), and the long must then accept and pay for a warehouse receipt (which they can pay to keep stored at the warehouse, or pay to have physical delivery).<p>

COMEX has reports on how many delivery notices were generated each <a href="http://www.cmegroup.com/delivery_reports/MetalsIssuesAndStopsReport.pdf">day</a>, <a href="http://www.cmegroup.com/delivery_reports/MetalsIssuesAndStopsMTDReport.pdf">month</a>, and <a href="http://www.cmegroup.com/delivery_reports/MetalsIssuesAndStopsYTDReport.pdf">year</a>.  The reports show which firms had clients issue the notices (shorts delivering the silver), and which stopped the notices (had clients receiving the silver).<p> 

<br><h3>Is a Long Guaranteed to Receive Silver?</h3>
Yes.  Some people are confused about this, as COMEX doesn't make it clear to people who aren't active in futures.  Someone active in futures knows that a futures contract is exactly that -- a contract.  It is a contract to buy or sell a specific amount of metal at a specific month in the future at a specific 
price.<p>

The confusion arises because the short gets to decide when they deliver the silver -- either at the beginning of the month, the middle, or the end.  A long cannot <i>initiate</i> the process.  However, the short <i>must</i> initiate the process at some point during the month -- they are required to do so by their contract.<p>

Another point that confuses novices is when they read that when a short gives a Delivery Notice, COMEX will assign it to the long that got their position earliest.  This makes it sound like some longs won't be assigned delivery.  But, for every long there is a short, so it just means that earlier purchasers of long positions will get delivery earlier in the month; those that got their positions more recently may have to wait closer to the end of the month.  But all longs will be assigned a delivery, unless they buy an offsetting short position.<p>

The final piece of the puzzle is what happens if the short does not deliver the silver?  In this case, the Clearing Member (the firm that the short's contract went through) is required to deliver the silver (per <a href="http://www.cmegroup.com/rulebook/NYMEX/1/7B.pdf">7B02</a>).  If they cannot, COMEX rules state that COMEX will not be liable for more than the value of the metal at the time of default (per <a href="http://www.cmegroup.com/rulebook/NYMEX/1/7B.pdf">7B14</a>), and only if they are notified within 60 minutes.  However, we are not aware of instances that this has happened, and the person to receive the silver was not fairly compensated.  If there were such a default, it would seriously damage the reputation of the COMEX, and could possibly disrupt the silver market, so it would be avoided at all costs.  And, a long in theory would be able to sue the short and the Clearing Member (and probably COMEX, although they would be better protected).<p>

<br><h3>Can you be Forced to Take or Make Delivery?</h3>
Yes and no.  Specifically, futures contracts are exactly that -- contracts to buy or sell something in the future.  So if you buy a long contract, you are obligated to take delivery; if you sell a short contract, you are obligated to deliver the silver.  But, if you do not want to, you can offset your contract (e.g. sell short if you have a long contract), which gets rid of your obligation.<p>

<br><h3>The Delivery Month</h3>
The Delivery Month is the month in which the short is required to deliver the silver.  However, there are a number of dates involved:

<ul>
<li>First business day of the month.  This is the first day that a short can file a Notice of Intention to Deliver.

<li>Notice of Intent to Deliver Day.  This is the day that the short files the Notice of Intention to Deliver.  This may be on any business day of the delivery month.

<li>Date of Presentation, appears to be the same as the Notice of Intent to Deliver Day. The Date of Presentation is the day before the Notice Day.  COMEX does not define it, but mentions it in 7A06(C)(3).

<li>Notice Day.  This is the day that the Clearing House (COMEX) issues an Assignment Notification to the long and the short.  This is the day prior to the Delivery Day.

<li>Delivery Day.  This is the day that the short transfers ownership of the silver to the long, by exchanging a warehouse receipt.

<li>Third last business day of the month.  This is the last day that contracts may be traded. <!-- http://www.cmegroup.com/trading/metals/precious/gold_contract_specifications.html -->
</ul>


<br><h3>Why Farther Months Cost More</h3>
If you look at the futures price of silver, you'll notice that in most cases, the longer it is until delivery, the more the contract costs.  For example, as of this writing, June 2010 silver is $18.18, but June 2014 silver is $18.84.  This is a situation referred to as <i>contango</i>, and is normal.<p>

At first, people might assume that is because people expect the price of silver to rise.  However, the real reason for that is because the short seller (if they are not naked) has to pay warehouse storage fees, and loses interest that he could make on his money if he sold the silver today.  So the short is going to want more money the farther out the contract is.  And the long is willing to pay that, since they avoid paying storage fees and make interest on their money.<p>

There are rare exceptions to this rule, where something called <i>backwardation</i> occurs.  Backwardation means that the closer months cost more than the farther months.  This can happen if there is concern that silver may not be easily available in the future, and that you are more likely to get your silver if you choose a closer month.  This is a very bullish situation, and would likely lead to higher prices.<p>


<br><h3>Report: Commitment of Traders</h3>
The <a href="http://www.cftc.gov/MarketReports/CommitmentsofTraders/index.htm">Commitment of Traders</a> is a report published by the CFTC every week.  It lists how many contracts are held by the 4 largest traders combined and how many are held by the 8 largest traders combined.  It also reports how many contracts are held by various categories of traders (currently, "Producer/Merchant/Processor/User", "Swap Dealers", "Managed Money", "Other Reportables" and "Nonreportable Positions" (traders with less than 150 contracts)).<p>

Most people will not find much use for this data.  However, it can be used to help determine if there is market manipulation.  For example, if the 4 largest traders have a very high percentage of the open interest, it is more likely that they could influence the price.<p>


<br><h3>Report: Bank Participation Report</h3>
The <a href="http://www.cftc.gov/MarketReports/BankParticipationReports/index.htm">Bank Participation Report</a> is a report published by the CFTC every month.  It lists how many banks have short or long positions in each futures market, and what percentage of the open interest is held by all the banks combined.<p>

Most people will not find much use for this data.  However, it can be used to help determine if banks are able to influence the price of silver.<p>

<!--
<br><h3>Report: Index Investment Data</h3>
The <a href="http://www.cftc.gov/MarketReports/IndexInvestmentData/index.htm">Index Investment Data Report</a> is a report published by the CFTC every quarter.  It lists how many contracts are held by swap dealers and index traders.<p>
-->

<br><h3>Options</h3>
Options give you the right (but not obligation) to buy or sell futures contracts, at a set price at a set time in the future.  A call option lets you buy silver, a put option lets you sell it.<p>

For example, if silver is $20/ounce and you think it will go to $25/ounce by December, you could buy $22 December call options.  If silver does go to $25/ounce by December, you would be able to sell the options for about $3/ounce profit.  Or, you could pay the $22/ounce and convert them to futures contracts (which you could then have delivered or stored in a warehouse, if you wished).<p>


<br><h3>Terms</h3>
<dl>
  <dt>Backwardation</dt>
    <dd>- The situation where silver will cost more for closer delivery months.  This can occur if there is a concern that silver may not be delivered in the future.  See also Backwardation.</dd>
  <dt>Bank Participation Report</dt>
    <dd>- A <a href="http://www.cftc.gov/MarketReports/BankParticipationReports/index.htm">report</a> by the CFTC that shows how many banks hold futures positions, and how many contracts are held in total by all the banks.</dd>
  <dt>CFTC</dt>
    <dd>- The Commodities Futures Trading Commission, the organization in the United States that is responsible for overseeing the futures markets.</dd>
  <dt>Clearing House</dt>
    <dd>- The organization that is in charge of clearing futures contracts (COMEX) (see <a href="http://www.cmegroup.com/rulebook/NYMEX/1/NYMEX-COMEX_Definitions.pdf">COMEX site</a>).</dd>
  <dt>Clearing Member</dt>
    <dd>- A firm that is approved by COMEX for clearing transactions (see <a href="http://www.cmegroup.com/rulebook/NYMEX/1/NYMEX-COMEX_Definitions.pdf">COMEX site</a>).</dd>
  <dt>Contango</dt>
    <dd>- The normal situation where the longer it will be until the delivery month, the more the silver will cost (to account for storage fees).  See also Backwardation.</dd>
  <dt>Contract</dt>
    <dd>- A set amount of silver (5,000oz) or gold (100oz) to be bought or sold on a specific date.  So if you go long 10 contracts of silver, you will be buying 50,000 ounces of silver.</dd>
  <dt>COT</dt>
    <dd>- The Commitment of Traders report.  This is issued by the <a href="http://www.cftc.gov/MarketReports/CommitmentsofTraders/index.htm">CFTC</a>, and lists number of contracts held by largest 4 and 8 traders, as well as a breakdown of contracts by the type of trader.</dd>
  <dt>Delivery Day</dt>
    <dd>- The day that the long receives the warehouse receipt.  It can be any business day in the delivery month.  For more details, see <a href="http://www.cmegroup.com/rulebook/NYMEX/1/7A.pdf">NYMEX Rulebook 7A06-E(1)</a>.  The warehouse receipt is received electronically, normally at 7:30AM CST (8:30AM EST).</dd>
  <dt>Delivery Notice</dt>
    <dd>- See Notice of Intention to Deliver.</dd>
  <dt>Eligible</dt>
    <dd>- When referring to silver in a warehouse, it means that the silver is eligible for delivery (to a long that has a warehouse receipt, and is paying storage fees).  See also Registered.</dd>
  <dt>Long</dt>
    <dd>- Agreeing to buy a specific amount of silver in the future at a set price in a set month.  See also Short.</dd>
  <dt>Naked Short</dt>
    <dd>- Someone who agrees to sell silver in the future, but does not have any silver to back up the contract. This is legal (the person just needs to buy real silver before or at delivery, or buy an offsetting long position before the contract is up).</dd>
  <dt>Notice Day</dt>
    <dd>- The day that an Assignment Notification is issued by the Clearing House (COMEX) to the buyer and seller.  This is the day that the seller finds out who the buyer is, and the buyer finds out who the seller is, and the serial numbers of the bars that they will receive. See <a href="http://www.cmegroup.com/rulebook/NYMEX/1/7A.pdf">7A06(C)</a>.</dd>
  <dt>Notice of Intention to Deliver</dt>
    <dd>- A notice from the short that states that he will be delivering the silver, and which bars will be delivered.  Someone who is short silver <i>must</i> file a 'Notice of Intention to Deliver' with the COMEX, unless they instead buy an offsetting long position, so they do not have to deliver the silver. See <a href="http://www.cmegroup.com/rulebook/NYMEX/1/7A.pdf">7A06(B)</a>.</dd>
  <dt>Offsetting Position</dt>
    <dd>- The opposite of the position that you have.  If you have a short contract, you can buy a long contract (for the same month and price), which is called the offsetting position.  One you have done so, you have no obligation to deliver the silver.  If you have a long contract, you can sell a short contract (for the same month and price), and then you do not have to take delivery.</dd>
  <dt>Open Interest</dt>
    <dd>- The total number of contracts for a given commodity and monthly.  So if for June 2010 silver there are 13,580 longs (in which case there are also 13,580 shorts), you would say the open interest for June, 2010 silver is 13,580.</dd>
  <dt>Registered</dt>
    <dd>- When referring to silver in a warehouse, it means that the silver is owned by COMEX and/or bullion banks, and can be bought by shorts for delivery.  See also Eligible.</dd>
  <dt>Short</dt>
    <dd>- Agreeing to sell a specific amount of silver in the future at a set price in a set month.  See also Long.</dd>
  <dt>Standing for Delivery</dt>
    <dd>- Waiting until your long contract expires, to get your silver.</dd>
  <dt>Stop</dt>
    <dd>- A term indicating that a delivery notice was given to the buyer.  In delivery reports, COMEX shows both how many Delivery Notices were 'issued' (the short notifying that they would be delivered) and 'stopped' (the long receiving the delivery notice).</dd>
  <dt>Warehouse Receipt</dt>
    <dd>- A 'receipt' that entitles you to a specific amount of silver.  It lists the specific bars that you own, including the brand and serial numbers. <!-- Rulebook 112.07 --></dd>
  <dt>Warrant</dt>
    <dd>- The method used to give you ownership of silver in a warehouse, per <a href="http://www.law.cornell.edu/ucc/7/overview.html">Article 7 of the Uniform Commercial Code</a>.  It is the same as a warehouse receipt.</dd>
</dl>


<br><h3>Other Information (was: Remaining Questions)</h3>
<ul>
<li>Who owns the Registered silver in the COMEX warehouses (bullion banks, clearing members, or others)?<br>
 <ul>
 <li>One <a href="http://silveraxis.com/todayinsilver/2008/10/01/random-thoughts-about-a-random-market/">source</a> suggests that the registered category is silver that is owned by investors, both long and short (anyone that stood for delivery without removing the silver from COMEX).  It also suggests that the eligible category is for longs that stood for delivery, and chose to store their silver at COMEX (but that makes little sense, as you have to pay storage fees if you have a warehouse receipt, right?).
 <li>It appears clear now that the Registered category is for silver that has been "registered for delivery", and someone holds the warrant for those bars.  This could be anyone (which includes bullion banks as well as longs that stand for delivery, but continue to store their bars in the COMEX vault).
 </ul>
<li>Who can access the Registered silver in the COMEX warehouses (bullion banks, clearing members, or others)?
 <ul>
 <li>Whoever has the warrant has access to the Registered silver.
 </ul>
<li>Ultimately, all the silver in the Registered and Eligible categories meets COMEX requirements for size and quality.  The difference is that the Registered category has had a warehouse receipt generated.
</ul>







<hr>









<h1>All About Silver Weight...</h1>

Silver is almost always sold in troy ounces (occasionally, it is sold in grams or kilograms).<p>

A troy ounce is slightly heavier than an avoirdupois (United States) ounce, weighing 1.097142857 avoirdupois ounces.  A troy ounce is also 31.1034768g (versus an avoirdupois ounce that weighs 28.3495231g).<p>

Large quantities of silver are usually measured in millions of ounces (for example, a silver ETF may contain 300 million ounces).  Occasionally, tons will be used (although tons are more commonly used with gold).  A ton of silver always means a metric ton, which weighs 32,150.7466 troy ounces.<p>

You may occasionally see silver sold by the 'pound', but this is almost always done by individuals or inexperienced dealers (or scam artists).  That's because the times that pounds are used, it usually comes about when an individual weighs the silver on a bathroom or postage scale (using avoirdupois pounds and ounces).  So they are probably referring to an avoirdupois pound, which actually weighs more than a troy pound (an avoirdupois pound is 16 avoirdupois ounces, whereas a troy pound is 12 troy ounces).  But, they could be referring to a troy pound.  A scammer selling a 'pound' of silver will typically sell a troy pound to someone who thinks that it is 16 troy ounces of silver (when in fact it is 12 ounces).  The scammer avoids any legal problems, because a pound of silver is indeed 12 troy ounces.<p>

<table border>
<tr><td>1 Troy Ounce =</td><td>1.097142857 Avoirdupois Ounces</td></tr>
<tr><td>1 Troy Ounce =</td><td>31.1034768 grams</td></tr>
<tr><td>1 Troy Pound =</td><td>12 Troy Ounces</td></tr>

<tr><td>1 Kilogram =</td><td>1,000 Grams</td></tr>
<tr><td>1 Kilogram =</td><td>32.1507466 troy ounces</td></tr>

<tr><td>1 Avoirdupois Ounce =</td><td>0.911458333452013 Troy Ounces</td></tr>
<tr><td>1 Avoirdupois Pound =</td><td>16 Avoirdupois Ounces</td></tr>

<tr><td><font color="lightgray">1 troy ton =</font></td><td><font color="lightgray">2450 troy lb.</font></td></tr>
<tr><td>1 Metric Ton =</td><td>1,000 kilograms</td></tr>
<tr><td>1 Metric Ton =</td><td>32,150.7466 troy ounces</td></tr>
</table>









<hr>








<h1>Spot, Premiums, Discounts, Spreads, and Fees</h1>

When you buy or sell silver (or gold), there are a lot of variables that come into play in determining the price (unless you simply buy a bar marked '$100' at a yard sale).  Some dealers make this very easy (showing just the price you pay per ounce), others make it harder (by not making shipping costs or commission charges easily accessible).<p>

The most important variable is the current spot price.  This is typically updated many times each minute throughout the day (the notable exception being on weekends, when the price is not changed).  It is based on the price of futures contracts for the nearest delivery month.  But if the spot price of silver is $15/ounce, you won't pay $15 for an ounce of silver.<p>

Like all other businesses, dealers cannot sell to you for the same price that they buy something.  In retail, this is called a markup (e.g. the store may pay $200 for a TV, and sell it to you for $250, resulting in a $50 markup).  With precious metals, dealers typically buy from customers as well as sell to customers.  The difference in price is called a 'spread'.  So a dealer may have a 3% spread between their buy and sell prices (so if you buy something from them, and sell it back while the spot price is the same, you will lose 3% from the spread).<p>

The next factor is premiums and discounts.  If a dealer sells to you (or buys from you) above the spot price, the difference between the sell (or buy) price and spot is called the 'premium.'  Alternatively, if they sell or buy below the spot price, the difference is called the 'discount.'  The premium for some products is higher than for other products.  For example, the premium for 1 ounce .999 fine coins is usually higher than for 1 ounce .999 fine medals (ones not produced by a government), and .999 fine coins/medals that weigh less than an ounce usually have a higher premium than those that weigh an ounce.<p>

Another factor is fees (such as shipping, commissions, and taxes).  Most 'brick and mortal' dealers do not charge any fees other than taxes (if applicable).  Most online dealers charge shipping, but not tax.  Some upscale dealers charge commissions (typically ones that have salespeople that call you occasionally).<p>

So there you have it!<p>





<hr>







<center>
<h1>How the Spot Price of Silver or Gold is Determined</h1>
<h2> Or, if the price <i>is</i> manipulated, who sells precious metals cheaply?</h2>
</center>
<br>

<h3>The Old Days</h3>
One of the most well-known sources of the 'spot price' of silver or gold is the London Gold and Silver Fixings.  They started in 1897 (for silver) and 1919 (for gold), and are fairly simple.  A group of 'market participants' (mostly banks, currently 6 for gold and 3 for silver) convene once (silver) or twice (gold) a day to determine the spot price.  They start with the current spot price, and see if there would be more buyers or sellers if the spot price was kept the same.  If more buyers, the price is raised; if more sellers, the price is lowered.  This is continued until the orders can be filled at one price.<p>
People buying or selling silver or gold outside this process would simply do so at the spot price.  This system worked pretty well, and couldn't easily be manipulated, since real silver and gold was (presumably) changing hands.<p>

<h3>Today</h3>
Today, the London Fixings still carry on.  However, they now really just act as a way to get a once- or twice-a-day value for the price of silver or gold.<p>

However, most silver today is bought or sold based on up-to-the-minute spot prices, which are based on the futures market and the OTC (Over the Counter) market, both of which trade massive amounts of silver and gold (the sheer volume implies that it is for speculation, to take advantage of short-term price fluctuations; most of the silver or gold is never in the hands of the buyers or sellers).  In the case of futures markets, computer generated trades appear to dominate, which essentially day trade, likely buying and selling within minutes.<p>

In the United States, the COMEX is where the futures contracts are traded.  Amazingly, about <a style="text-decoration:none; color: black;" href="statinfo.htm?var=COMEX_AG_TRADEDPERDELIVERED">447.12</a> ounces of silver are traded on COMEX for every ounce that is delivered!<p>

Given how much silver is bought or sold by computer programs, and how little is delivered, it appears that the spot price is primarily set by the few people that do this massive amount of day trading in silver.  Some people question whether or not the price of silver (or gold) is manipulated, and it is easy to see why.  It almost certainly is manipulated, it's just a question of whether the people manipulating it are doing so intentionally or not.<p>

<h3>Physical Silver Pricing - Who Sells Cheap?</h3>

For the people that think that the silver price is artificially low, the question becomes, 'If the price is being held down, who is selling silver at an artificially low price?'.  The thought is that if the price is artificially low, more people will buy than sell, and eventually there won't be any more silver to buy.  So why is there (almost) always silver to buy?<p>

First, the largest source of new silver by far is the mining companies.  They <i>have</i> to sell their silver.  In theory, they could store it waiting for a better price, but then they won't have money coming in to pay for their operations.  Otherwise, they have to accept whatever the current price is.  And people aren't going to buy for more than the spot price today (unless there isn't anywhere else to get it, but there almost always is).<p>

The other major source of silver is recycled silver.  The companies melting and refining the old silver don't care what the price is, since the silver wasn't theirs to begin with (they have to buy the silver that is being refined).  Since they have to both buy and sell, they have to use the current spot price (again, since buyers won't pay more than the spot price).<p>

For so-called 'retail silver' (such as silver eagles, smaller silver bars, and 90% junk silver coins), some of that comes to market through estates.  The people selling off the estates aren't likely to know (or even care) whether the value of silver is higher than the spot price.  They will just sell the silver for something close to the spot price.  For those that have silver and are looking to sell it themselves, dealers aren't going to pay higher than the spot price (plus/minus a small premium depending on the item), so they need to either sell based on the current spot price, or hold on for a higher price later (but, the spot price could go down by the time they finally get tired of waiting).<p>

So for the most part, the only people that might like to sell silver, but aren't willing to sell based on the current spot price, are those that are both convinced that the value of silver is much higher than the current spot price, and can wait to sell.  And that accounts for a very, very small percentage of the market.<p>

So if the market <i>is</i> manipulated, and the price is artificially low, that doesn't mean that silver won't come to the market.<p>


<br><br><br><br><br><br>
<!--
...
o 97% is paper trades not delivered
[                                 97%                                                                                                   ! 3% ]

o You would think from demand, a fairly large amount of people would cooperate in determining price.  But no, b/c 97% is in futures market

o Jewelry owners [GOLD!!!] often are fine getting 20-60% of spot, even though they could likely sell on eBay for much more
	o And, they pay much more than spot

o No simple rule-of-thumb is used, like with stocks [P/E].
-->









<hr>






<center>
<h1>About.Ag - Is the Price of Silver Manipulated?</h1>
<br><br>
</center>

Many people claim that the price of silver and gold are manipulated.<p>

On the one hand, it would be hard to manipulate a multi-trillion-dollar market (gold).  It would likely take a large government or large group of traders to do this, and would be hard to pull off without the help of COMEX and the CFTC.<p>

On the other hand, about 100 times as much silver and gold trade on COMEX and other paper exchanges each day than there is demand for.  And silver (and gold) aren't as easy to price as, say, stock in a company.  The problem with manipulating most markets is that you have to convince people to either buy at an inflated price, or sell at an artificially low price.  But with silver (and gold), if you can control the 'spot price', you can get people to sell at a price that is lower than it otherwise should be.  The 'spot price' is often the current price of futures on COMEX, the very ones that have a trading volume about 100 times as much real silver.<p>

Another interesting fact is that the price of silver directly tracks the price of gold.  Throughout the day, if the price of gold starts going up, within a couple of minutes the price of silver rises too.  And if the price of gold falls, silver will follow.  This either means that the people trading silver futures are also trading gold futures (and enter the prices in the same way), or the people trading silver believe that its value is based on the exact same fundamentals as gold (mostly ignoring the large differences between the two metals).<p>

Some people feel that silver and gold are manipulated by short sellers of silver and gold futures.  The idea is that if there is a huge amount of silver or gold being sold short (where someone promises to deliver it in the future, even though they may not have it), they will have to eventually buy that silver or gold, at which point the prices would rise.  On the other hand, some people believe that the short sellers are able to rig prices downwards, where they can then buy back the silver at prices near what they were when they originally entered the market.<p>

So is the price manipulated?  Do some research, and you can decide.<p>







<hr>





<h1>Record High Silver Spot Price in 1980</h1>

There are lots of claims as to what the record price was in 1980 -- $41.50, $48.80, $<b>49.45</b>, $50, $50.50, etc.<p>

Why is this?  Because there is the London Fix, New York closing price, intraday high, and other figures that people could use.<p>
<br>

<h2>Highest London Fix</h2>

We believe the best price to use as the record high price of silver in 1980 is $<b>49.45</b>, which was the <a href="http://www.lbma.org.uk">London Fix</a> on January 18, 1980.<p>

This represents a group of bullion banks with buyers and sellers discovering a mutually agreeable price, at a set point in time (avoiding adding 'high', 'low', and 'average' to the mix).<p>

<h2>Highest New York Closing Price</h2>

In 1980, there was no &quot;New York&quot; closing price.  Trading was done both at COMEX (in New York) and CBOT (in Chicago).  As far as we can tell, the COMEX and CBOT closing prices were not actively followed, nor can we even find a record of what they were.  Trading at times was fairly light (especially after the liquidation only order), so the closing price would not necessarily be the most useful price to use.<p>

The COMEX closing prices for January, 1980 silver <i>appear</i> to have been $48.80 on January 17, 1980 and $46.80 on January 18, 1980.  These are from Jerome Smith's &quot;Silver Profits in the 80's&quot; (p.20), and a few other sources.  However, none state definitively that those were COMEX closing prices.<p>


<h2>Intraday</h2>
The intraday high refers to the highest price during the day.  According to "Financial Crises: Understanding the Powerwar U.S. Experience" p.71, and "The Great Silver Bubble" p.144, the intraday price of silver on January 18 1980 reached $50.36 on COMEX and $52.50 on CBOT.

<h2>Other Prices</h2>
COMEX rules prevented the silver price from moving up or down more than $1 a day (but did not apply to the current month).  As a result, the price for March, 1980 silver hit a high of just $41.50 on January 21, 1980, according to Paul Sarnoff's &quot;Silver Bulls&quot; (p.82).<p>

On April 22, 2011 the Wikipedia article <a href="http://en.wikipedia.org/wiki/Silver_Thursday">Silver Thursday</a> shows a price of $48.70, which appears to be made-up.  This price appears as "The previous day the price had risen to $48.70 in New York", but it is not specified where or how that price came from.<p>

<!--
A thread at Ki*co used $50.35 as the COMEX high, and $54.00 as an intraday high, but are extremely unreliable!<p>-->


<h2>High Price Chart, Low to High!</h2>

<table border>
<tr><th>Price</th><th>Date</th><th>Description</th></tr>
<tr><td>$41.50</td><td>January 21, 1980</td><td>COMEX May, 1980 High</td></tr>
<tr><td>$48.40</td><td>January 17, 1980</td><td>COMEX Settlement Price</td></tr>
<tr><td>$48.70</td><td>January 17, 1980</td><td>Unknown.  Appears in Wikipedia 'Silver Thursday'.<br>Also in The Great Silver Bubble as:<br> "The previous day the price had risen to $48.70 in New York."</td></tr>
<tr><td>$49.45</td><td>January 18, 1980</td><td>London Fix</td></tr>
<tr><td>$50.36</td><td>January 18, 1980</td><td>Intraday COMEX High</td></tr>
<tr><td>$52.50</td><td>January 18, 1980</td><td>Intraday CBOT High</td></tr>
</table>








<hr>







<center><h1>Mills Silver is FAKE</h1></center>

<h3>What is 'Mills Silver'?</h3>

The short answer is that it is not real silver!<p>

A slightly longer answer is that these are fake silver bars, made of a base metal (such as copper or lead), and (presumably) have silver electroplated on them.  We estimate that there is less than $.05 worth of silver on each one.<p>

'Mills Silver' is a term apparently made up by the CMC Mint (selling on auction sites as ameropaintball).  'Mil' is a term used to indicate a thickness of silver/gold plating.  Until February, 2010 we had not heard of the term 'mills silver'.  At that time, though, the CMC Mint started mass producing many different bars of a base metal and labelling them ".100 MILLS .999 FINE SILVER - 1 TROY OZ" or ".100 Mills.999 Fine Silver - 1 Troy Oz Ounce" or "1 OZ .100 MILLS.999 FINE SILVER" or "100 MILLS FINE SILVER - 1 OZ TROY" or "100 mills .999 Fine Silver - 1 Oz Troy" or "1 Troy oz - 100 mills - 999 Silver" (and probably some other variations).<p>

The term 'mil' when electroplating silver refers to 1/1000".  The items marked '100 mills', if referring to 'mils', would be 1/10" thick on each side -- yet a standard real silver bar is 91 mils thick (.091").  Clearly, these are not electroplated with 100 mils of silver, or they would really contain about 2 ounces of silver, and the company would quickly go out of business.  Therefore, the ones marked '.100 mills' probably mean '.100 mils', or 1/10,000".  That is 1/910th the thickness of a standard silver bar, and multiplied by 2 (as all sides should have the electroplate on them) is 1/455th the thickness of a standard silver bar.  That's about 0.22% silver, or 22 parts silver per 978 parts of lead/copper/whatever.  Or a value of less than $.05 even with silver at $20/ounce.<p>

The term 'mills' has a legal meaning in the United States; it refers to 1/10 cent.  As such, these bars may be considered counterfeit coins.<p>

<h3>Should I buy something labeled 'mills silver'?</h3>
No, unless it is clearly marked as being electroplated.  In many countries, it is illegal to buy, sell, or ship items that are not marked properly.  All of the bars/rounds labelled 'mills' that we have encountered were not (in our opinion) legal to buy, sell, or ship in the United States.  They also violate the Hobby Protection Act in the United States, as they are not marked with 'COPY'.<p>

Of course, if you find one of these stunningly beautiful, and don't mind the legal risks of buying and owning one, and don't mind that you won't be able to sell it later, go ahead and buy one.<p>







<hr>







<br>

<table width="100%">
<tr><td>
<table>
<script>
document.write( '<tr><td colspan=3>Melt Values: <font color="gray">&nbsp;&nbsp;(spot at $20.82, as of 10 Mar 2014)</font></td></tr>' );
document.write( '<tr><td>1 Oz <a href="/MillsSilver.htm">100 Mills</a> Silver Bar/Round:</td><td>&nbsp;</td><td>$' + FormatDollars( 20.82 / 455, 5 ) + "</td></tr>" );
document.write( '<tr><td>1 Oz Silver Bar/Round:</td><td>&nbsp;</td><td>$' + FormatDollars( 20.82, 5 ) + "</td></tr>" );
document.write( "<tr><td>$1 90% Silver Coins (.715oz):</td><td>&nbsp;</td><td>$" + FormatDollars( 20.82 * .715, 5 ) + "</td></tr>" );
document.write( "<tr><td>10oz Silver Bar:</td><td>&nbsp;</td><td>$" + FormatDollars( 20.82 * 10, 5 ) + "</td></tr>" );
document.write( "<tr><td>Tube of Silver Eagles (20oz):</td><td>&nbsp;</td><td>$" + FormatDollars( 20.82 * 20, 5 ) + "</td></tr>" );
</script>
</table>
</td>
<td align="center" width="5%">
</td>
<td align=right>
<table>
<script>
document.write( '<tr><td colspan=3>Melt Values: <font color="gray">&nbsp;&nbsp;(spot at $20.82, as of 10 Mar 2014)</font></td></tr>' );
document.write( "<tr><td>100oz Silver Bar:</td><td>&nbsp;</td><td>$" + FormatDollars( 20.82 * 100, 6 ) + "</td></tr>" );
document.write( "<tr><td>Monster Box Silver Eagles (500oz):</td><td>&nbsp;</td><td>$" + FormatDollars( 20.82 * 500, 6 ) + "</td></tr>" );
document.write( "<tr><td>$1,000FV 90% Silver (715oz):</td><td>&nbsp;</td><td>$" + FormatDollars( 20.82 * 715, 6 ) + "</td></tr>" );
document.write( "<tr><td>1,000 Oz Silver Bar:</td><td>&nbsp;</td><td>$" + FormatDollars( 20.82 * 1000, 6 ) + "</td></tr>" );
</script>
</table>
</td></tr>
</table>

<br>
<center>
</center>



<table width="90%">
<tr><td width="50%">

QUICK STATS <font color="#808080">(spot as of about 10 Mar 2014 16:00, most others updated 17 Jan 2013; click values for full details)</font><br><br>

<table border width="100%">
<tr><th width="30%">Stat</th><th width="30%">Silver</th><th width="30%">Gold</th><th width="10%">Ratio</th></tr>
<tr><td>Spot Price:</td><td><b>$20.82</b></td><td>$1341.10</td><td><b><a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_SILVERGOLD">64.41</a>:1</b></td></tr>
<tr><td>Physical Spot Price:</td><td><b>$<a style="text-decoration:none; color: black;" href="statinfo.htm?var=PHYSICALSILVERSPOT">21.06</a></b></td><td>$<a style="text-decoration:none; color: black;" href="statinfo.htm?var=PHYSICALGOLDSPOT">1349.92</a></td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_PHYSICALSPOT">64.10</a>:1</td></tr>
<tr><td>Total Identified Gold/Silver:</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=TOTAL_SILVER_HOLDINGS">602.829</a> Million Ounces</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=TOTAL_GOLD_HOLDINGS">1187.193</a> Million Ounces</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_TOTAL_HOLDINGS">0.51</a>:1</td></tr>
<tr><td>Highest Price Ever (London Fix):</td><td>$<a style="text-decoration:none; color: black;" href="statinfo.htm?var=SILVER_HIGHPRICE_NOMINAL">49.45</a> (18 Jan 1980)</td><td>$<a style="text-decoration:none; color: black;" href="statinfo.htm?var=GOLD_HIGHPRICE_NOMINAL">1218.25</a> (03 Dec 2009)</td><td>todo</td></tr>
<tr><td>Highest Price, Inflation Adjusted:</td><td>$<a style="text-decoration:none; color: black;" href="statinfo.htm?var=SILVER_HIGHPRICE_ADJUSTED">127.60</a> (18 Jan 1980)</td><td>$<a style="text-decoration:none; color: black;" href="statinfo.htm?var=GOLD_HIGHPRICE_ADJUSTED">2193.25</a> (18 Jan 1980)</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_HIGHPRICE_ADJUSTED">17.19</a>:1</td></tr>
<tr><td>Estimated Mined To Date:</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=SILVER_EVER_MINED">44542.001</a> Million Ounces</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=GOLD_EVER_MINED">4250.000</a> Million Ounces</td><td><b><a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_MINED_EVER">10.48</a>:1</b> http://www.gold-eagle.com/editorials_05/zurbuchen011506pv.html</td></tr>
<tr><td>Currently Mined, Annually:</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=SILVER_MINED_CURRENTLY">680.900</a> Million Ounces</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=GOLD_MINED_CURRENTLY">79.895</a> Million Ounces</td><td><b><a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_MINED_CURRENTLY">8.52</a>:1</b> http://www.silverinstitute.org/supply_demand.php & http://www.invest.gold.org/sites/en/why_gold/demand_and_supply/</td></tr>
<tr><td>Annual Demand:</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=SILVER_ANNUAL_DEMAND">888.400</a> Million Ounces</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=GOLD_ANNUAL_DEMAND">122.324</a> Million Ounces</td><td><b><a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_ANNUAL_DEMAND">7.26</a>:1</b> http://www.silverinstitute.org/supply_demand.php & http://www.research.gold.org/supply_demand/</td></tr>
<tr><td>U.S. Eagles, Sold Last Month:</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=USMINT_AG_OZLASTMONTH">3.160</a> Million Ounces</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=USMINT_AU_OZLASTMONTH">0.137</a> Million Ounces</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_USMINT_OZLASTMONTH">23.15</a>:1 http://www.usmint.gov/mint_programs/american_eagles/?flash=yes&action=sales&year=2010 & http://www.usmint.gov/mint_programs/american_eagles/?flash=yes&action=sales&year=2010</td></tr>
</table>
<br><br>
<table border width="100%">
<tr><th width="30%">Stat</th><th width="30%">Silver</th><th width="30%">Gold</th><th width="10%">Ratio</th></tr>
<tr><td>COMEX Open Interest:</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=COMEX_AG_OPENINTEREST">687.710</a> Million Ounces</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=COMEX_AU_OPENINTEREST">44.130</a> Million Ounces</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_COMEX_OPENINTEREST">15.58</a>:1</td></tr>
<tr><td>COMEX Top 4 Net Short:</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=COMEX_AG_NETSHORT4">279.898</a> Million Ounces (<a style="text-decoration:none; color: black;" href="statinfo.htm?var=COMEX_AG_NETSHORT4_PC">40.70</a>%)</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=COMEX_AU_NETSHORT4">17.696</a> Million Ounces (<a style="text-decoration:none; color: black;" href="statinfo.htm?var=COMEX_AU_NETSHORT4_PC">40.10</a>%)</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_COMEX_NETSHORT4">15.82</a>:1</td></tr>
<tr><td>COMEX Daily Volume (Traded):</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=COMEX_AG_DAILYVOLUME">292.265</a> Million Ounces</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=COMEX_AU_DAILYVOLUME">23.154</a> Million Ounces</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_COMEX_TRADED">12.62</a>:1 http://www.cmegroup.com/tools-information/build-a-report.html?report=dailybulletin</td></tr>
<tr><td>COMEX Daily Volume (Delivered):</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=COMEX_AG_DAILYDELIVERY">0.654</a> Million Ounces</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=COMEX_AU_DAILYDELIVERY">0.011</a> Million Ounces</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_COMEX_DELIVERED">60.28</a>:1 http://www.cmegroup.com/delivery_reports/MetalsIssuesAndStopsYTDReport.pdf</td></tr>
<tr><td>COMEX Ounces Traded Per Ounce Delivered:</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=COMEX_AG_TRADEDPERDELIVERED">447.12</a>:1</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=COMEX_AU_TRADEDPERDELIVERED">2135.36</a>:1</td><td>n/a</td></tr>
<tr><td>% of Annual Demand Met by COMEX:</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=COMEX_AG_DEMAND_PERCENT">18.39</a>%</td><td><a style="text-decoration:none; color: black;" href="statinfo.htm?var=COMEX_AU_DEMAND_PERCENT">2.22</a>%</td><td>n/a</td></tr>
</table>







<hr>





<h1>Gold Versus Silver</h1>

<h3>Which is better? You decide</h3>

We believe that silver has more profit potential than gold in the long term.  However, we also know that silver is more volatile than gold.  So let's take a look at the various arguments of why gold is a good investment, why silver is a good investment, and how gold and silver compare to each other.<p>


<table border>
<tr><th>Reason</th><th>Winner</th><th>Silver Details</th><th>Gold Details</th></tr>

<tr><td>Current use as money</td><td>Gold</td><td>Silver is neither used as money, nor as a reserve by governments.  As such, it does not receive much value for those purposes.</td><td>Gold isn't currently used as money, but is used as reserves by governments.  As such, it is given a high value.</td></tr>

<tr><td>Value due to Beauty</td><td>Neither</td><td>Silver was originally used in part because of its beauty, that could not be matched with other metals.  However, today inexpensive silver plating is virtually indistinguishable from pure silver.</td><td>The same holds true for gold.</td></tr>

<tr><td>Silver/Gold Ratio</td><td>Silver</td><td>The silver/gold ratio is how much silver gold can buy.  As of 10 Mar 2014, it is <a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_SILVERGOLD">64.41</a>:1 (meaning that an ounce of gold will buy <a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_SILVERGOLD">64.41</a> ounces of silver).  Historically, this has been about 15:1 (see <a href="http://www.dani2989.com/gold/goldsirverratio180027092004gb.htm">explanation</a> or <a href="http://goldinfo.net/silver600.html">graph</a>), and came about in diverse geographic areas, suggesting that a 15:1 ratio is 'normal' (assuming that silver and gold are used as money).  There have been roughly <a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_MINED_EVER">10.48</a> ounces of silver mined for every ounce of gold (currently, it is <a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_MINED_CURRENTLY">8.52</a>:1), which likely accounts for why for centuries the ratio was about 15:1.  If for some reason the silver/gold ratio returned to 15:1, silver would increase in price significantly. <!-- {450%} (or gold could go down {90%}, or a combination of the two). --></td><td>It could be argued from the silver/gold ratio that silv
er no longer has monetary value, and therefore the ratio could continue to increase.</td></tr>

<tr><td>Ounces of Gold + Silver ever mined</td><td>Debatable</td><td>Historically, about <a href="http://www.gold-eagle.com/editorials_05/zurbuchen011506pv.html"><a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_MINED_EVER">10.48</a> ounces of silver</a> have been mined for every ounce of gold.  This backs the idea of a 15:1 silver/gold ratio (presumably, the idea was that on average people would have half their wealth in gold, and half in silver).  It could also be argued that since silver is also an industrial metal (I.E. a lot is consumed, never to be seen again), the silver ratio should be lower than the <a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_MINED_EVER">10.48</a>:1 mined ratio.  If people desired equal values of silver and gold, and silver and gold were distributed evenly, there would be about an <a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_MINED_EVER">10.48</a>:1 ratio (assuming silver used industrially could be used; if not, the ratio would be more in favor of silver).  This would result in a {550%} increase in the price of silver (or corresponding decrease in the price of gold).</td><td>There is a lot more silver mined than gold, and therefore gold should be more valuable than si
lver.  That's pretty clear (unless there are other extreme factors involved).</td></tr>


<!--
<tr><td>Historical Precedence</td><td>Silver</td><td>Silver has historically traded at about a 15:1 ratio against gold, whereas today it trades at <a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_SILVERGOLD">64.41</a>:1.<br>Silver has traded as high as $<a style="text-decoration:none; color: black;" href="statinfo.htm?var=SILVER_HIGHPRICE_NOMINAL">49.45</a> ($<a style="text-decoration:none; color: black;" href="statinfo.htm?var=SILVER_HIGHPRICE_ADJUSTED">127.60</a> adjusted for inflation), but is just $20.82 (as of 10 Mar 2014).<br>  Got silver?</td><td>The highest price of gold in 1980 (about $850) has been passed, but the inflation-adjusted high ($<a style="text-decoration:none; color: black;" href="statinfo.htm?var=GOLD_HIGHPRICE_ADJUSTED">2193.25</a>) has not (gold is currently trading at $1341.10).</td></tr>
-->



<tr><td>Ounces of Gold + Silver currently mined</td><td>Silver</td><td>The best estimates show <a href="http://www.silverinstitute.org/supply_demand.php"><a style="text-decoration:none; color: black;" href="statinfo.htm?var=SILVER_MINED_CURRENTLY">680.900</a> million ounces</a> of silver mined per year in 2008, and <a href="http://www.invest.gold.org/sites/en/why_gold/demand_and_supply/"><a style="text-decoration:none; color: black;" href="statinfo.htm?var=GOLD_MINED_CURRENTLY">79.895</a> million ounces</a> of gold mined per year (per GFMS Ltd.). That works out to <a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_MINED_CURRENTLY">8.52</a> ounces of silver mined annually for every ounce of gold, which suggests that silver should be priced at about 1/8 the price of gold, requiring silver to rise about about {750%} to reach it.</td><td>Again, it could be argued that so much more silver being mined than gold justifies golds higher price.</td></tr>

<tr><td>Previous Highs</td><td>Silver</td><td>Silver's highest ever price was right around $50/ounce (it traded over that, but the daily settlement price was slightly lower).  As of this writing, silver is trading for 30% of that price, meaning that silver would have to go up 235% to reach that price.</td><td>As of this writing, gold is trading higher than its high of $850/oz on January 21, 1980.</td></tr>

<tr><td>Previous Highs - Inflation-adjusted</td><td>Silver</td><td>Silver's <a href="http://www.westegg.com/inflation/">inflation-adjusted high</a> is about $130, over 8 times the current price as of this writing.  In other words, if we hit an inflation-adjusted high, silver would be at $132, and go up over 700%.</td><td>Gold's inflation-adjusted price is about $2,275, about 2 times the current price as of this writing.  In other words, if we hit an inflation-adjusted high, gold would be at $2,275, and go up over 100%.</td></tr>

<td>Roman pay</td><td>Silver</td><td>According to <a href="http://en.wikipedia.org/wiki/Denarius">Wikipedia</a>, a Roman soldier would typically be paid 1 denarius per day of work, equating to at least US$58 (based on minimum wage).  At between 3.4-3.9g per coin, that works out to $462 to $530 an ounce.  These are just rough estimates, though!</td><td>The Aureus was about 7.3-8g of gold, and equal to 25 denari.  That works out to a silver:gold ratio of about 11-12:1, or gold being valued at roughly $5,000 an ounce (based on the labor it could buy).  These are just rough estimates, though!</td></tr>
<tr><td>Bulk silver/gold</td><td>Silver</td><td>The largest known stockpiles of silver amount to less than 1 billion ounces (such as Comex warehouses and the SLV ETF).  If someone (perhaps a government) wanted to buy, say, 100 million ounces of silver, there would be nowhere to buy it at once.  It would require buying it on the open market, raising the price of silver in the process.</td><td>There are numerous stockpiles of gold; the governments of many countries have plenty of gold on hand.  To raise the price of gold, governments would need to add to their stockpiles.</td></tr>

<td>Potential Price Manipulation</td><td>Both</td><td>There are people who claim that the price of silver (and gold) are manipulated to the downside (I.E. the price is lower than it really should be).  There is evidence that suggests that this could be the case (either the 'conspiracy theory' version, or just simply that computer investment programs are unintentionally keeping the prices down).  If this were true, it could benefit the prices of silver and gold.</td><td>Same as with silver.</td></tr>
<tr><td>Underlying Face Value</td><td>Silver</td><td>You can easily buy 1 ounce silver Canadian Maple coins that, at this writing, are guaranteed not to lose more than about 68% of their value.  Similarly, 40% U.S. Kennedy Half Dollars are guaranteed to be worth US$.50 each, and contain 4.6g of silver each, and at current prices guarantees that you cannot lose more than 80% of your investment.  Of course, if silver prices ever did get that low again ($3-$5/oz), these coins could be sold at more than face value, as they likely would sell for a fairly high premium.  And, this argument only applies if you buy silver coins with a high face-value-to-silver ratio.</td><td>Right now, U.S. Gold Eagles have a face value of approximately 5% of the value of the gold, meaning that your investment would have to drop about 95% for the face value to become a factor.</td></tr>

<td>Investment Demand (ETFs)</td><td>Debatable</td><td>As of this writing, the value of the largest gold ETF (GLD) is 7.75 times as much as the largest silver ETF (SLV) ($37.57B vs $4.85B).  If people invested as much in silver as gold (by selling some gold and buying silver, in the ETFs), that would result in $16.36B invested in silver, which would require buying 1.1 billion ounces (likely more than is currently available), which would drive prices much higher (Warren Buffett's purchase of 130 million ounces in 1997-1998 caused the price to spike to 80% over 7 months).</td><td>Gold investors could simply argue that gold is more valuable than silver, and more perceived as money than silver, and therefore one should devote a much smaller amount of their precious metals investment to silver.</td></tr>
<tr><td>Return to Gold/Silver Standard</td><td>Depends</td><td>It may be unlikely that we would return to a gold/silver standard.  But if we did, and silver was part of it (bi-metal), and all gold and silver ever mined were divided evenly among everyone, there would be 6.4 ounces of silver per person, and .6 ounces of gold per person.  That's if all silver ever mined could be obtained for coinage.  Today, a $1,000 silver investment would get you 10 times that 6.4 ounces.</td><td>This also shows that gold is very rare, with less than an ounce per person to go around.</td></tr>

<td>Available Gold and Silver</td><td>Silver</td><td>Most silver that has been mined has 'disappeared', either into products, or even investments.  Most experts would be amazed if a person or organization could obtain even 10% of the silver ever mined (4-5 billion ounces).  The price spike after Warren Buffett's 130 million ounce purchase helps confirm this (if there were 40+ billion ounces available, buying .3% would not have had such a major impact on the price).</td><td>About <a href="http://www.research.gold.org/supply_demand/">11%</a> of the gold mined each year is used industrially (compared to <a href="http://www.silverinstitute.org/supply_demand.php">62%</a> for silver), and much of that is eventually recycled.  As a result, most gold ever mined is still available (only <a href="http://www.invest.gold.org/sites/en/why_gold/demand_and_supply/">2% is unaccounted for</a>).</td></tr>


<!-- STOCKPILES: -->
<tr><td>Stockpiles of gold and silver</td><td>Silver</td><td>The best estimates are that there are roughly 6 billion ounces of gold that could be sold without mining (943 million ounces by our count in government stockpiles and ETFs), but perhaps a few billion ounces of silver that could be sold without mining (482 million ounces in government stockpiles and ETFs, by our count).  So there may be less silver available for sale than gold!  That would suggest silver prices roughly equal to gold prices, resulting in a whopping 6600% increase in the price of silver!</td><td>n/a</td></tr>

<td>Government Stockpiles</td><td>Debatable</td><td>There are nearly no government stockpiles of silver at present.  The United States used to have about <a href="http://www.onlygold.com/articles/ayr_2007/A_Modern_Silver_Story.asp">3 billion ounces</a> of silver, but has gotten rid of it all.  If governments want silver at some point, it will significantly increase demand, and therefore the price of silver.</td><td>Plenty of governments have plenty of gold (nearly 1 billion ounces total, per <a href="http://en.wikipedia.org/wiki/Official_gold_reserves">Wikipedia</a>.  This helps increase the perceived value of gold versus silver.</td></tr>
<tr><td>ETFs</td><td>Silver</td><td>The biggest silver ETF (SLV) has a market cap of <a href="http://us.ishares.com/product_info/fund/overview/SLV.htm">$4.9B</a> (as of 29 Jan 2010).  As of 22 Nov 2009, total gold ETF holdings were <a href="http://www.commodityonline.com/futures-trading/technical/Combined-Gold-ETF-holdings-at-56.4-million-ounces-12931.html">56.4 million ounces</a>, worth about $64B.  That's 13 times as much money in gold as silver, suggesting that silver prices would go much higher if equal amounts were invested in gold and silver.</td><td>The same stats could be used to say that silver no longer has monetary value.</td></tr>

<tr><td>Economist Adam Smith</td><td>Silver</td><td>In Wealth of Nations, the famous economist Adam Smith stated "We ought naturally to expect, therefore, that there should always be in the market, not only a greater quantity, but a greater value of silver than of gold." <!-- In the 'Variations in the Proportion between the respective Values of Gold and Silver' section, I.11.181  --> He is saying that the value of all the silver in the world (I.E. the market capitalization) should be higher than that of all the gold in the world.  In other words, the silver:gold ratio should be <i>less than</i> the <a style="text-decoration:none; color: black;" href="statinfo.htm?var=RATIO_MINED_EVER">10.48</a>:1 ratio of silver to gold ever mined.</td><td>Of course, those words were written in a time of bimetalism; since then, there was a gold standard and then the current fiat system.  As a result, silver is in less demand than it otherwise might be.</td></tr>


<td>Retail Shortages</td><td>Silver</td><td>In March, 2008 there was an unprecedented shortage of 'retail silver' (physical silver in forms that all but the largest investors typically purchase). Most large bullion dealers were out of most or all of their silver (and their suppliers were out, too) for a few weeks.  Again, in August, 2008, major shortages occurred.  This could be attributed to the silver market being small, but if shortages of retail silver haven't occurred in the past, it's a sign that either [1] there is less silver available than before, or [2] investors are purchasing more silver than in the past, or [3] dealers were reducing their inventory (which doesn't make business sense).  As one of these shortages began, The Tulving Co started selling 1000 ounce silver bars, suggesting that it was one of the few forms of silver that could be obtained (they are rarely sold in the retail market).</td><td>There have been minor retail gold shortages, but not to the extent of the silver shortages.  The 
argument that silver shortages occurred because the silver market is small don't help -- if the silver market is so small, it would take less investor demand to cause prices to rise.</td></tr>
<tr><td>Financial Advisors Recommend Precious Metals</td><td>Debatable</td><td>Most financial advisors recommand having precious metals in a diversified portfolio (typically 5% to 10%).  Most people do not.  Over $10 trillion is invested in stocks.  If 5% of that were in precious metals, split between gold and silver, that's $250 billion each that would be moved into gold and silver.  At today's prices, that would buy over 16 billion ounces of silver, which would be impossible to find, forcing the price up drastically.</td><td>Doing so would also create demand for 250 million ounces of gold, but that demand could be met if needed by government selling (or, the price of gold would rise -- but not as much as with silver).</td></tr>

<td></td><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td></tr>

</table>





<hr>





<pre>
Summary of CFTC Meeting to Examine Futures and Options Trading in the Metals Markets, March 25 2010.

Note that there may be a few remarks mis-attributed, as you had to memorize faces as people were introduced.
And this is from a biased viewpoint (as were the viewpoints of most at the meeting, and listening to it).

---
PARTICIPANTS:
CFTC Chairman Gary Gensler
CFTC Commissioner Michael Dunn
CFTC Commissioner Jill E. Sommers
CFTC Commissioner Bart Chilton
CFTC Commissioner Scott D. O'Malia

Panel One:
   Dan Berkovitz, General Counsel, CFTC
   Steve Sherrod, Division of Market Oversight, CFTC

Panel Two:
   Jeff Burghardt, Luvata
   Jeremy Charles, HSBC Bank USA, NA
   Tom LaSala, CME Group
   Mark Epstein, Individual Trader

Panel Three:
   Tom Callahan, NYSE Euronext
   Dr. Henry G. Jarecki, Gresham Investment Management
   Bill Murphy, Gold Antitrust Action Committee
   Kevin Norrish, Barclays Capital
   John Lothian, John Lothian & Co.

Panel Four:
   Richard Strait, Triland USA, a Division of Mitsubishi Corporation
   Simon Grenfell, Deutsche Bank
   Mike Masters, Masters Capital
   Harvey Organ, Individual Investor
   Jeffrey Christian, CPM Group

---

MEETING NOTES:


o Chairman Gensler started by mentioning that they are looking for comments by public, through April 30, 2010, sent to metalshearing [at] cftc dot gov.  But at the end mentioned the April 30 deadline as being for the Energies comments.  Maybe they will be merged?

o 9:13 Commissioner Dunn said that they usually do not tell the public when there is an investigation.
	o Futures are a 'Zero sum game' -> for every  winner, there's a loser
	o If OTC rules are not made too, then futures market will move to non-transparent OTC
		o [MY COMMENT: That's fine; OTC doesn't set prices, so it would help price discovery to remove people trading large quantities in <1 second]

o 9:16 Commissioner Sommers spoke.
o 9:18 Commissioner Chilton spoke, he supports position limits
o 9:18 Commissioner O'Malia spoke.
o 9:21 Dan Berkovitz, General Counsel, CFTC, spoke.
...
o 9:31 Someone spoke; LBMA OTC accounts for 50% of trading
	o 9:37 The 'Summary of Traders at or Above Positions Limits' slide; those numbers not previously released to public.
	o 9:39 They are owner level, not trader level.  Top 4 net short are copper/gold/silver [see slide]
o 9:40 Gensler asked Dan Berkovitz about manipulation allegations, should they be addressed here?
	o Generally inappropriate to discuss current investigations, nor mention market participants by name.
	o Witnesses should refrain from specific allegations to specific parties
o 9:42 Chilton: 'We are not censoring our witnesses' testimony"

o CMEGROUP said that CFTC can't impose limits, since excessive speculation has not been proved.
	o 9:43 Berkowitz says his interpretation is that a finding of excessive speculation is NOT necessary for imposing position limits
o 9:48 Dunn: 
	o 9:51 DMO (Director of Market Oversight): When accountability limits hit, they monitor daily. They get consent to get more info; if they cannot get it, trader cannot go above limit.
	o Dunn: All of these [large 4 shorts] were sanctioned by the CFTC then, right?
		o DMO was evading, talking about how there were 20+(?) exemptions in gold, 5(?) exemptions gold/silver.
	o Dunn: 'So you have sanctioned what is going on, right?'
		o DMO: DMO doesn't do anything in particular; the exchange gathers the info.  DMO doesn't do anything when traders exceed levels
o 9:55 Sommers:
	o What would justify a trader having these large short positions?  DMO?Dunn?  They don't have to justify it unless hard limit hit.
	o Examples of how traders have justified exemptions?  DMO?DUNN?: There are a variety; the most typical is bonafide hedging position (where trade holds a cash position in gold, hedges in futures).
o 9:56 Chilton:
	o We must promote price activity, but we can't list traders. This concerns Chilton. Making the Bank report less transparent not good. Why did we do it?
	o If a banker has a position so large that it would reveal the trader, shouldn't that pique our interest?
		DMO: Yes.
	o We need mandatory hard-cap limits. If a someone is over the limit, you're in violation. If they still do it, fined, etc.
	o Physical shortages: Some had forecast that the market would drop.
		o ?: ETFs are linked through arbitrage to Comex.

10:08 They then moved on  to Panel 2.  That had Tom Callahan, NYSE Euronext; Dr. Henry G. Jarecki, Gresham Investment Management; Bill Murphy, Gold Antitrust Action Committee; Kevin Norrish, Barclays Capital; John Lothian, John Lothian & Co.

10:12 Tom LaSala (CME Group).  Excessive speculation has not occurred. The 'Fringe' group GATA has not supported their position with credible evidence. Position limits Would shift volume outside of the CFTC's reach. LBMA deliveries dwarf those of Comex (except in November 2009 and January 2010).

10:16 Jeremy Charles (HSBC). With position limits, activity will move to other markets. He suggests that banks have real gold/silver in London, but are shorting it in US [I add: why? Perhaps can't short in London?]. The CFTC should have clear exemptions for (bonafide?) hedging.

10:20 Mark Epstein.  He is a market maker, for 2-sided markets. He has a computer program that adjusts constantly. He closes out positions at end of day, so no overnight risk [I add: wouldn't that mean that he sells positions right before closing; could that manipulate?]. Often it is Second-by-second or millisecond-by-millisecond.  Typically he trades between 1,000-2,000 contracts per day.
o On Feb 4? at 10:15AM, in 1/4 second, 2,000 futures contracts were sold and caused the price to go down 100 ticks.  That's 200,000oz of gold, or $215 million. Stuff like this stuff happens every day.
o He bought physical silver in May 2008.  The price went from $17 down to $8.25 up to 19.50. At the end of 2008, he took physical delivery of 1,000oz silver bars, had them melted into 100oz bars, because of the huge price discrepancy between futures markets and retail markets.
o He believes that the 7.5Moz limit in silver is too high.  Market has net short position of 30,000 short contracts, HUGE. They must have had exemptions, this isn't hedging.  Silver behaves like no other market.
o The short position has a chilling effect on market makers, so they need to widen price spreads to account for the increased risk. The big players set prices.  The short positions are irresponsibly large.
o There is the risk of failure to deliver the silver, would hurt COMEX.
o He thinks limits should be 2,000 contracts, or 1,000 for the delivery month. Only exemptions should be for bonafide hedgers.

10:27 Jeff Burghardt (Luvata).  He thinks hedge funds are causing prices to go up.  If funds had smaller positions, volatility would go down. He suggests higher margin requirements. Position limits would affect only a few if any funds, margin requirements would affect all funds.

10:32 Diarmuid O’Hegarty (LME).  Talking about base metals, e.g. copper.

10:37 Gensler asked Q: What is the nature in the silver market of large concentrated shorts?
	o Charles (HSBC):  Short positions are hedged by loco London (in their case, can't talk about other banks). They sell short to get cash for operations, too.
		o HSBC maintains a long position, so they can provide their clients with silver, the clients buy it.
	o Epstein: That is the role of the futures market (if you have silver, you can then sell it short). The issue with silver is for example on 24 Mar 2010 8:37:53, someone dumped 272 contracts, silver went down 14 ticks or about 1/2%, all within 50ms.  He says that if 2000 silver contracts were sold insantly, it would definitely be 'limit down'(!!!).
	o Q: high frequency algorithms. Epstein, do you see someone on other side with much more powerful program?
		o Epstein: There is a counterparty to every transaction. A bank buying/selling $5M-$10M of silver would massively affect the price.
	o Q: Are you colocated [have a computer right next to Comex computers]?
		o Epstein: Yes, anyone can get access to buy/sell quickly at Comex in Chicago.
	o Q: Some people complained to the CFTC that they couldn't buy silver, but Epstein did.
		o Epstein: I took delivery. I had a truck pick it up from exchange. There are 115 million ounces in the exchange, he just got slip (warehouse receipt) for some of it.
			o Epstein: Once you take the bars off exchange, if you want to put them back, they need to be re-assayed, which would be expensive.
			o Epstein: Futures market needs to track the physical market; there was a $2-3 difference in 2008, the futures market was not serving its purpose.
			o Epstein: Comex could lose all silver. People could have drained all the silver if the price difference kept up.
	o Q: What would happen if people drained the silver vaults at Comex?
		o Tom LaSala: If there was a high demand for metal, metal would come in to replenish supplies.
			o We're not a coin market, that's why coins may be expensive when 1000oz bars through Comex are not.

10:50	o Sommers->Lasala(CME): How do energy/metals markets relate?
		o Being in the pit, you would have a 'feel' of market; with electronic trading you do not. It's more liquid now. Some markets are more volatile than others, normally smaller markets [e.g. silver] are affected more.
		o Perhaps that large order in silver was made in error when the order book was shallow. It was not necessarily a party with high concentration.
10:53	o Sommers->Lasala(CME): Bonafide hedging exemptions. Why would you, or not, grant them? 
		o Lasala: They are not granted blindly. You apply for one, stipulate your book, state what is behind your position. Grants are for a finite number of contracts.
		o Sometimes, I have no doubt in my mind they have the metal, but we can't give them an exemption because it would affect the price/market.
		o The limits are historically small; Lasala wanted to keep them that way.

10:56	o Chilton->Lasala: You took 28 actions in metals. Some were to maintain position, some to reduce; how many to reduce?
		o Lasala: I don't know, I will supply them after the meeting.
	o Chilton: Did you instruct any of the big shorts to reduce?	
		o Lasala: I think so. [!!!]
	o Chilton: Where there any fines?
		o There is at least 1 matter pending. [!!!]
11:00	o Chilton: Jeremy Charles/HSBC, for your bank's own funds, you don't feel that you should be allowed to go over limits, right (e.g. for banks own purposes, not for customers)
		o Jeremy Charles: We would use an exemption to hedge one contract against another.
			o Jeremy Charles: I think it's a misconception that there are large (unhedged?) short positions out there. [!!!]
		o Q: Would you be opposed to limits for your own book?  That is being proposed in energies.
11:02	o O'Malia -> Jeremy Charles:
		o Jeremy Charles: The stocks of gold/silver in London are massive compared to Comex stocks.  For shortages, there's a shortage of one type of product. Physical metal is always available; if you want 1 million ounces of gold, HSBC can get within 48 hours with no problem.  There is a massive stock in London.
11:06	o Epstein: The difference in May and July futures contracts is about $.02, that's about the storage cost.  It is always that way.  But it was trading $.10 in the other direction (in example he mentioned re: early 2008)
	o If it is moving $.12 between months, something significant is taking place.  It should never happen that Comex is the easiest way to get physical metal.
11:07 	o (?). They try to make sure there is enough supply for spot month deliveries. It would trigger a potential action. The rules of exchange allow positions to be forced to be closed out.
11:09	o Gensler->LaSala. Gold/silver have the same limits, but gold is 5 times the size of silver market, why is that?
		o LaSala: That is the way it historically has been.
	o Gensler Q: How often do you talk to Top 4 Shorts?
		o LaSala: We talk to them Where appropriate, when necessary.
	o Gensler Q: How Often?
		o LaSala: Not daily. If we know about their positions, then we leave it alone.
	o Gensler: In the case of being short futures, and long gold: HSBC says they have large inventory. London is the primary settlement globally. Metal normally kept in vault if short.
	o Gensler: More transparency would be helpful.
	o LaSala: We did a recent review of large shorts. They will share with the Director of Market Oversight (DMO).  Numbers are comparable to what they were in the past.
		o [My Note: Why were they not shared already???]
11:15	o Jeff Burghardt(?): It looks like the pricing of copper has moved away from the fundamentals.  e.g. there was an earthquake in Chile, and the price moved just $.07, whereas it moves much more than that when a large player moves into the market.
11:17-12:01 missed.
12:01 Kevin Norrish(?) Barclays has some people with large projects, they need to deal with large quanties of risk.  Smaller investors take other side(?).
	o Norrish: U.S. futures market provides liquidity and price discovery, and is 'exportable'. Position limits would move investments to other countries.
	o Norrish: Index investors are price stabilizers. They buy when prices are too low, sell when prices are too high.
12:04 o Dr. Henry G. Jarecki (GIM). He helps customers diversify their portfolios.
		o Futures have been imune to the problems that plagued stocks, bonds, and the real estate market. He witnessed the Hunt Brothers trying to corner the market.  The price went up high, but 'Billions of dollars of silver came on the market', and the little guys had more silver than the Hunt Brothers had money. [!!!]
		o He feels that all his customers shouldn't be lumped together (for position limits?). His small firm might be forced to move to overseas markets.
		o He suggests that [1] Position limits would cause trading to go to OTC, or physical storage. [2] Trade data, who benefits(?). [3] Rules should apply to the implementor (not the beneficiary), should be attributed to beneficiary(?), [4] It is trivial to identify end users.
12:11	o John Lothian.  Gold has little industrial value; it's a belief of store of wealth, a replacement for money.  Gold is useful if a nation's debt may be defaulted on.
	o Lothian: Low interest rates played role to rising gold price.
	o Lothian: Some think central bankers and others keep price down. That is 'intellectually dishonest'.
		o We didn't have as many tools for risk in 1970s
		o Those alleging manipulation are 'Politically opportunistic' (and other diskind words; 'charlatains'). Healthy skepticism OK, not 'pseudo-skeptical behavior'.
12:16 The CFTC webcast connection failed through 12:20.
12:20 Bill Murphy, GATA, was reading very fast from a paper; presumably same text as is online at CFTC.
12:22 Gensler Q: Concentration is higher in silver, etc. than most markets.  Help us understand how concentration helps orderly markets.
		o A: Norrish: Barclays needs to be able to take large positions.
	Gensler Q: If very concentrated, could you get tipping point where there would be less liquidity? 
		o A: Lothian: Consolidation is occurring, causing the concentration. The tipping point is an issue; your challenge is whether or not to be courageous [based on a 'courageous' quote earlier].  We've lost transparency with electronic trading.
	Gensler->Jarecki.  HSBC says that the short positions are covered with cash gold. Then why is so much physical inventory short; it almost seems constant.
		o Jarecki: There is a great deal of lending of metals from merchants to jewelers, etc. They buy the metal, sell it forward, lend out.
	   o Some people buy and sell forward (e.g. copper), because it is cheaper to do. Buy from one facility, sell at another for arbitrage.
12:29 Dunn:  If position limits, ...
	A: Jarecki: Over centuries, regulations caused trade to move from location to location; it stays in one place until there is a good reason to move elsewhere.
12:37	Bill Murphy: There is no point in having position limits if the big boys can still trade [I.E. if exemptions are granted to anyone].
12:38 Chilton-> Calahan, you have position limits in London, too, right?.  It's the specific level that's important.
	o Chilton: Position Limit is solid concept, just has to be right number.  So what is too much concentration?
		o Calahan: We account for just 5% of market, so limits (that were inherited from CBOT) were relative to size of their market, and are adequate.
		o Calahan: The limits are working out well.  Federally mandated limits vs. exchanges deciding the limits. The exchange can monitor/change limits as needed.
12:43 O'Malia Q: Would position limits spare price increases?
	A1: It is inconclusive whether or not it would help pricing, based on CFTC data. [based on agricultural markets]
	A2: Metals markets are big and liquid. Limits would make prices more volatile in the short term.
	A3: Jarecki: The evidence shows that these high prices existed in all markets (even steel/iron; outside futures(?)). The massive amounts of printed money had to go somewhere.
	A4: Lothian: It adds friction, hurts price signals. Higher prices means we need more production, more selling. Anything retarding that hurts price signal, people will go to OTC.
	A5: Murphy. Anything limiting ability of big bullion banks is a plus, it leads to better price discovery.
12:49 Gensler said he thinks that position limits do not retard; for example, traffic lights are 'friction', they slows down traffic, but are necessary.
	o Gensler: High concentration, does it help price discovery? We have found a rational way to deal with leverage in futures market.
	o Gensler: The clearing mechanism isn't perfect, but works well. It should be in OTC market too.
12:51 Dunn: ->Norrish. Why aren't we walking into the same problem that happened with the housing market?
	 	o Norrish: Commodities worked best, there was accurate discovery, and no distress.
		o Norrish: Some risks are large, for example, it could be building a $10B copper mine. They need large financial institutions to help with risk, who may then feed out the risk to the market gradually.
	Dunn: I'm concerned about those institutions and systemic risk.  Thanks to the Chair for selling the concept of position limits to the EU last week.
12:55	Dunn: Q: If we get OTC regulation, should we put in position limits at that time?
	o Callahan: Correction: We have no position limits in London.  Doing it simultaneously would be best.
	o Jarecki: In the metals markets, it is trivial to own physical material. Our customers put 100% margin, buy gold/silver/copper in warehouses.
	  Jarecki: People who don't trust currencies don't want broker & exchange & clearinghouse to stand between them, especially those worried about inflation. There is a risk that people will move futures paper into warehouses, and that there will be shortages.
	  [!!!But that means futures are holding down prices!!!]

o 1:00 Chilton: $200 Billion went into the markets through 2008. Position limits build confidence in the markets: it is rational, with parameters. But we need to have the right limits (e.g. if too high, limits do nothing).
	o Chilton->Norrish.  Norrish: It is very difficult to distinguish a hedge vs. speculative trading, e.g. a farmer selling next year's corn crop, the crop could be less than he thought.
		Norrish: Imagine that multiplied 1000s of times. That's what financials deal with every day.
	Chilton: Exemptions should be targeted, e.g. a $10B copper mine might be OK. If it is too complicated to figure out w/limits, that makes me queasy.
	Chilton->Murphy. You are critical of Comex, and say they are complicit to manipulation. Can you give the commission evidence of how/when?
		o Murphy: We have 11 years worth of evidence. 2 days ago we got a whistleblower, we will be handing out the information to the press after this meeting.
		o Murphy: March 23, 2010 GATA got an E-mail from Andrew McQuire of Goldman Sachs, that Chase brags about making money. In 2009 he contacted the CFTC, and described in detail the routine manipulation at Comex and options expiration, rollover, etc.
		o Murphy: He gave CFTC 2 days notice of the Feb 5 attack on the gold price, and it was exactly as predicted. It would not be possible to predict that unless the market is manipulated.
		o Murphy: It is common knowledge to flush out the shorts before the discussion today. $1100-$1150 in gold options, so sell short to overwhelm bids.  March 19. Thumbed noses at CFTC.
	Chilton: Thank you, that was more specific than I was expecting. But, we don't want to discuss individual circumstances.
	O'Malia-> Jarecki? Norish?. Epstein said there was a 'Chilling effect with large orders'.
		A: Market makers sometimes harasses large orders, they join bid/offer, use market data.
		A: Often people want to sell all at one time, with no execution risk. Large players want to play and teach market makers a lesson once in a while [!!! THAT IS MANIPULATION!!!].
	Jarecki: Don't the large sellers lose out, since the last lots get sold at a lower price?
	O'Malia: There were 4 recommendations...
	Jarecki: Everything to stop fraud is great. But, having regulations just because they are good is bad.
1:15 Gensler: America benefits from a regulated economy.
1:17 Dunn-> ? A: OTC market, you would just get a piece of it, and piece of world futures trade. We need global regulators to agree to position limits or transparency. Otherwise, it puts us in a bad position here [in the U.S.].
1:19 Chilton: There is a concern in waiting for other countries, but someone has to go first; we need to be the leaders. [!!!]
	Chilton-> Jarecki, what is enough? 50%? A: If you own 20% of soybeans in world, you're in a unique situation, others should know abot it. Practical implication. (?)
1:21 Gensler: We'll leave and come back.
1:33 Meeting Resumed.

--- Panel 4

1:33 Gensler: Jeffrey Christian, CPM Group, here via teleconference.
1:38 Strait(?) OTC. Jarecki warns that people will move from futures to owning the metal.  He is against positions limits.
	o Strait: Epstein talked about buying 1000oz bars to melt into 100 bars.  100oz bars are the most desired product, so the supply was limited. Futures market is basis that fabricated markets use for pricing.
	o Strait: Futures are not meant to be end-all for consumer. It takes up to 20 days to deliver contract.
1:44 Masters: There is manipulation when large traders place large trades; limits would make it harder to manipulate markets.
		o Excessive speculation: No speculator can individually cause harm, but they as a whole harm price discovery. Limits reduce their dominance; not restraint of 1 specific trader.
		o Speculators should never have more than 50% of open interest, because then they dominate.  In the past, they were about 25% [where?] with few liquidity complaints.
		o The ideal varies by market, but 25% is good starting point.
		o Consumables should use both manipulative limits and speculative limits, whichever is lower.  Precious metals can be consumed, but more often they are held. So speculation is OK.
		o Passive speculation caused the run-up over past 8 years. It accounts for the lion's share of open interest.  Active speculation adds liquidity (buying and selling), passive speculation allocates the metals and drains them by buying large quantities. It undermines the process, destroys price discovery.
			[BUT: that is saying that buying physical metal undermines price discovery! If that happens, the market is the problem!]
		o CFTC needs to address passive speculation.
1:50 Organ: The 2008 Bank Participation reports showed that 1-2 banks had 169Moz silver. In July 2008, the same had 31MOz. A short increased of 138Moz is 20% of annual mine production.
		o Silver has the largest concentrated short position in any commodity.  Gold, 3-or-less in August 2008, there was an 11-fold increase, a short increase of 8 million ounces, or about 11% of the annual world production
		o Silver: Ted Butler calculated that JPMorgan was short 200 million ounces.
		o Billions of dollars were lost in 2008. Most futures markets have a limit of 1-2% of annual production; gold-silver exceed that, which allows manipulation. Limits must be on both long+short. Hedgers should deposit 40% in warehouse, provide affidavit of 100% ownership and that they will not lease, etc.
1:56 Christian, CPM.  Some proposals he has heard today wouldn't do any good. Position limits won't help; there is a risk if ill-conceived/ill-applied.
		o Position limits are like Sarbanes-Oxley. He was surprised that so many people speaking today felt that banks are not bonafide hedgers.
2:04 Gensler->Strait: A: Segregating the banks' order books is difficult, since they are making markets for their customers.
		o A: Clearing: The CFTC should encourage clearing, bring in OTC clearing, it improves transparency. Q: If CFTC implements OTC limits, how would it impact Clearport traffic?
		o Gensler: Clearing reduces risk.
2:07 Gensler->Masters: You are saying that gold and precious metals are not consumable, so we should take a different approach for each?
		o Masters:  Copper is a consumable, precious metals are not, so precious metals should have manipulative limits not speculation limits.
     Gensler: Limits on the near-month helps control manipulation. Is that it?
		o Masters: Yes, and all-months-combined limit is for speculation. 
2:08 Dunn->Strait+Masters(?):  You say that there could be a bubble if there are no position limits, or OTC: 
     Dunn->Strait: wheat vs. metals. If people would just buy the real thing, should we have a different type of silver contract?
		o Strait/Masters(?): Silver is mainly OTC. Japan, Hong Kong, Russia, you're doing loco London not Comex. So no, no new market. 'Silver is different than gold'. He was upset at the platinum/palladium ETFs.
     Sommers to Strait+Masters(?).  A: Platinum+Palladium are strategic. Having them in an ETF shocked me, it is insane. It will artificially drive up prices of important metals. The CFTC should have oversight of that, not SEC(?) OCC(?).
2:16 Chilton: The 2008 high demand and high retail price of silver with a low futures price. It gave people concern and it should be addressed.  Yes, if our limits are ill-conceived that would be bad, "duh"! 
2:18 Chilton->Masters: How would you apply limits?
		o Masters: By contract, exemptions? Banks as hedgers, the rules should apply.
     Chilton: 'Massive passives' should as mass have limit, but how?
		o Masters: Zero would be best.
2:21 Chilton->Masters: It there a way for individuals to play the markets.
		o Masters:  If you ask the individuals 'What is a contango?', 99% wouldn't be able to answer. Go buy TIPS, buy the Euro, they are a lot more liquid.
		[In other words, take note individuals: you shouldn't buy gold because you don't know the rules.  Just buy a government-backed inflation-protected bond, or a hedge against the dollar]
2:22 O'Malia: How do we make position limits stick?
		o Masters(?) London Mercantile Exchange is dominant, we don't have jurisdiction there.
2:24 O'Malia: -> Christian. The net short positions exceeds the physical supply. Should we be concerned that the shorts wouldn't be able to deliver?
		o Christian: No. It's been that way for decades, there are mechanisms for cash settlements. Most short positions are hedges offsetting OTC longs.
		o Organ: I see a risk. As China, Russia, etc. demand physical, it put pressures on Comex. At some point in time, we will have a failure.
		o Ethan Douglas, assisting Organ: The LBMA has 20Moz trading in gold per day, net. That's $5.4Trillion/year. Not 100% backed, it is a fractional reserve. Unallocated = unsecured, because it is fractional reserve.
		o Ethan Douglas: Hedgers are paper hedgeing paper. It is a Ponzi scheme. 
		o (?) People trust bullion banks, trust the paper.
2:28 Dunn->Christian: Precious metals are financial assets, they trade at 100 times the underlying physical. Buyers are voting for the paper.
		o Christian: The 2008 explosion of shorts on futures market, Organ implied that it causes the prices to go down. Bullion banks were selling gold/silver hand over fist in OTC, physical, because everyone was buying. Bullion banks had to hedge, so they sold short.
			[BUT, that makes no sense!]
		o Christian: With limits on futures markets, they would find another way to hedge; someone will supply that.
2:31 Dunn->Organ. 'How could it not be manipulative, having such big shorts?'
		o Organ: I'm concerned of the size of short positions of the 1-2 banks and their manipulation of prices. Like yesterday (down .5% in seconds). They are controlling prices. Comex should be the price discovery, but 1-2 banks are making sure they determine the price; we're seeing the opposite of price discovery.
2:33 Chilton: Arbitrage: I have seen valid arguments on both sides.  We could be the gold standard of regulation, and build confidence in our markets.  Without limits, would markets leave U.S.?
		o Organ: Huge exemptions have to be addressed. If similar to 1-2% of annual products.
		o Masters?: People want more regulation and transparency. The thought of people trading in Dubai is an empty threat. What if there is another crisis, will the government of Dubai stand behind it? Is the counterparty OK?
2:38 Gensler->Christian: We're hearing that bullion banks are hedging.  How does that work?
		o Christian(?): I misspoke, in August 2008 it was liquidation of leveraged PM positions, bullion banks were buying, going short to hedge.
     Gensler: What *are* the bullion banks hedging on other side? Is it warehouse receipts?
		o Christian: They are hedging a tremendous number of things. On the bullion bank's books you will find gold forward purchases from mining and refiners. Gold leased to electronics makers and jewellers, etc.
		o Christian: Producers sell the gold the minute it leaves their mine, and goes to smelter. The bullion bank buys it, agrees on a price, but can't sell until it is out of refinery (could be 2 weeks, could be 6 months). So they sell short.
			[Could this cause the huge price swings? e.g. bullion bank just dumps 10MOz of gold from past couple months, buys it back when out of refinery???]
		o Christian: When they get the metal, they can unwind the hedge. Deritivitves are also sold to insurance, etc. often long exposure in gold; offset with shorts.
		o Christian: There has been talk about physical and how "There isn't much out there".  If I look at the large short positions, I ask myself 'Where are other shorts being hedged?'. He believes they have more that gold/silver that needs hedging, he believes it is done as OTC in London.
		[But why is the short amount fairly constant?]
2:43 Meeting adjourned.
Gensler said that the comment period for ENERGY was good until April 30th.  Please comment, send records.


</pre>

END!<br><br>

Nothing more to add; changes will be corrections, edits, clarity, etc.




<hr>

<pre>
==Why did Silver go to $50/ozt?==

===1979-1980===


Hunt Brothers (Nelson Bunker Hunt & William Herbert Hunt) attempted to corner the silver market using leverage. Leverage is the use of various financial instruments or borrowed capital, such as margin, to increase the potential return of an investment.

Nelson Bunker Hunt and William Herbert Hunt, the sons of Texas oil billionaire Haroldson Lafayette Hunt, Jr., had for some time been attempting to corner the market in silver.

From 1973 the [[Nelson Bunker Hunt|Hunt brothers]] began [[cornering the market]] in silver, helping to cause a spike in January 1980 of the London Silver Fix to $49.45 per troy ounce, silver futures to reach an intraday all-time high of $50.35 per troy ounce and a reduction of the gold/silver ratio down to 1:17.0 (gold also peaked the same day in 1980, at $850 per troy ounce).<ref>http://www.silverinstitute.org/hist_priceuk.php  {{Wayback|url=http://www.silverinstitute.org/hist_priceuk.php|date =20111103021300}}</ref><ref>{{cite news| url=http://www.bloomberg.com/news/2010-09-24/silver-climbs-to-30-year-high-beating-gold-with-its-26-advance-this-year.html | work=Bloomberg | first1=Pham-Duy | last1=Nguyen | first2=Nicholas | last2=Larkin | title=Silver Futures Jump to 30-Year High: Gold Is Steady After Topping ,300 | date=September 24, 2010| archiveurl=http://web.archive.org/web/20140209122524/http://www.bloomberg.com/news/2010-09-24/silver-climbs-to-30-year-high-beating-gold-with-its-26-advance-this-year.html | archivedate=February 9, 2014 }}</ref>

In the last nine months of 1979, the brothers were estimated to be holding over 100 million troy ounces of silver and several large silver [[futures contract]]s.<ref>[http://silverbearcafe.com/private/01.09/circlek.html H.L. Hunt and the Circle K Cowboys] {{Wayback|url=http://silverbearcafe.com/private/01.09/circlek.html|date =20120510231848}}</ref> However, a combination of changed trading rules on the [[New York Mercantile Exchange]] (NYMEX) and the intervention of the [[Federal Reserve]] put an end to the game. By 1982 the London Silver Fix had collapsed by 90% to $4.90 per troy ounce.<ref>http://www.silverfixing.com/timeline.pdf</ref>

In 1979, the price for silver jumped from $6 per troy ounce ($0.193/g) to a record high of $48.70 per troy ounce ($1.566/g), which represents an increase of 712%. The brothers were estimated to hold one third of the entire world supply of silver (other than that held by governments). The situation for other prospective purchasers of silver was so dire that the jeweler Tiffany's took out a full page ad in The New York Times, condemning the Hunt Brothers and stating "We think it is unconscionable for anyone to hoard several billion, yes billion, dollars' worth of silver and thus drive the price up so high that others must pay artificially high prices for articles made of silver".

But on January 7, 1980, in response to the Hunts' accumulation, the exchange rules regarding leverage were changed, when COMEX adopted "Silver Rule 7" placing heavy restrictions on the purchase of commodities on margin. The Hunt brothers had borrowed heavily to finance their purchases, and as the price began to fall again, dropping over 50% in just four days, they were unable to meet their obligations, causing panic in the markets.

However, there were other factors in the increase in price. There was concern about the U.S. geopolitical hegemony and dollar's status.

U.S. Hegemony-The U.S. was seen as weakening with regard to how it handled the Iran hostage crisis. During 1979 and 1980 Democratic President Jimmy Carter was trying to figure out how to free the hostages that were taken in November 1979 at the U.S. Embassy in Tehran, Iran. Other than a failed rescue mission in April 1980, not much was done to free the hostages. The hostages were to remain in captivity until January 20 of 1981, the date of Ronald Reagan’s inauguration. A month after U.S. hostages were taken in Iran, Russia invaded Afghanistan. Jimmy Carter’s response to this naked aggression was to boycott the 1980 Summer Olympics held in Moscow, Russia.

U.S. Dollar-U.S. President Richard Nixon ended the international convertibility of the U.S. dollar to gold (Bretton Woods) on August 16, 1971 (Nixon Shock). The U.S. attempted to revalue to price of gold from $35 to $38 (12/71) to $42.22 (10/73). In October 1976, the U.S. government officially changed the definition of the dollar; references to gold were removed from statutes. From this point, the international monetary system was made of pure fiat money. The late 1970s and early 1980s were an era of gas lines and double digit price inflation as consumer prices rose so swiftly that grocery stores hired “price changers” whose sole task was to mark the inventory higher. Pink Floyd’s bleak double album “The Wall” was released in November, 1979 and topped the charts during a time when it looked like United States was falling and had seen its better days.

===2010-2011===

There was immense risk to the world economy that summer and investors drove the prices up buy buying defensive commodities (silver & gold). When the short-term risk subsided, investors reallocated their assets back into yielding (dividend or interest) investments such as stocks or bonds.

The 2011 [[United States debt ceiling]] crisis was the major factor for the rise in price. The 2010 U.S. midterm elections led to the [[President Obama]] vs. [[Tea Party movement]] battle. The price of silver steadily rose from $17 to $30 as the elections approached. Then as the split and threats started to materialize between late 2010 and 2011, silver found a "new normal" between $25 and $30.

In 2011, Republicans in Congress demanded deficit reduction as part of raising the debt ceiling.  The resulting contention was resolved on 2 August 2011 by the [[Budget Control Act of 2011]].
 
Then the first few months of 2011, Moody's and S&P downgraded the outlook on US finances. This was a major shock to the financial world; that's when silver climbed to $50. On 5 August 2011, S&P issued the first ever [[United States federal government credit-rating downgrade|downgrade in the federal government's credit rating]], citing their April warnings, the difficulty of bridging the parties and that the resulting agreement fell well short of the hoped-for comprehensive 'grand bargain'.<ref>{{cite web
| url =  http://www.standardandpoors.com/ratings/articles/en/us/?assetID=1245316529563
| title =  United States of America Long-Term Rating Lowered To 'AA+' Due To Political Risks, Rising Debt Burden; Outlook Negative
}}</ref> The credit downgrade and debt ceiling debacle contributed to the [[Dow Jones Industrial Average]] falling nearly 2,000 points in late July and August. Following the downgrade itself, the DJIA had one of its worst days in history and fell 635 points on August 8.{{sfn|Sweet|8 August 2011}}

Then as it became likely that U.S. Secretary of Treasury [[Timothy Geithner]] would order the treasury to use extraordinary measures to delay the crisis, silver settled back at $35. As the debacle continued during the summer, silver moved in the range of $33 to $43.

As it became clear that the "financial apocalypse" would be delayed by late summer, people dumped silver commodities and moved back into U.S. equities. The price of silver quickly went back the level of the "new normal" of around $30.

Whether classifying silver's movement as a 'bubble' (seen when comparing silver with gold) has been debatable with [[Peter Schiff]] denying that a bubble ever existed.
 </pre>
 
 
 
 
 <hr>
 <pre> 
 
 
 

12th to 17th Century, GSR was 12:1.


1717, the master of the Royal Mint, Sir Isaac Netwon, introducued a new mint ratio as between silver and gold, and this had the effect of putting the Kingdom of Britain on a de facto gold standard. Isaac Newton monetized silver and set the ratio at 15.5 early in the 18th century and this held until 1873.


1785, United States adopted silver standard based on the "Spanish Milled Dollar" in 1785, codified in 1792.															
In the 1780s, Thomas Jefferson, Robert Morris and Alexander Hamilton recommended to Congress the value of a decimal system. This system would also apply to monies in the United States. The question was what type of standard: gold, silver or both.[14] The United States adopted a silver standard based on the Spanish milled dollar in 1785.
The Spanish dollar was the coin upon which the original United States dollar was based, and it remained legal tender in the United States until the Coinage Act of 1857. Because it was widely used in Europe, the Americas, and the Far East, it became the first world currency by the late 18th century.[2][3] Aside from the U.S. dollar, several other existing currencies, such as the Canadian dollar, the Japanese yen, the Chinese yuan, the Philippine peso, and several currencies in Latin America, were initially based on the Spanish dollar and other 8-real coins. Diverse theories link the origin of the "$" symbol to the columns and stripes that appear on one side of the Spanish dollar.
US and Europe drained of silver
From 1750 to 1870, wars within Europe as well as an ongoing trade deficit with China (which sold to Europe but had little use for European goods) drained silver from the economies of Western Europe and the United States. Coins were struck in smaller and smaller numbers, and there was a proliferation of bank and stock notes used as money.
1792, Coinage Act of 1792 15:1 ratio; 1ozt Gold $20.67/24.75 grains Gold $1; 371.25grains Silver $1; 
The United States adopted a silver standard based on the "Spanish milled dollar" (eight-real, piece of eight) in 1785. This was codified in the 1792 Mint and Coinage Act, and by the federal government's use of the "Bank of the United States" to hold its reserves, as well as establishing a fixed ratio of gold to the US dollar. This was, in effect, a derivative silver standard, since the bank was not required to keep silver to back all of its currency. This began a long series of attempts for America to create a bimetallic standard for the US dollar, which would continue until the 1920s. Gold and silver coins were legal tender, including the Spanish real. Because of the huge debt taken on by the US federal government to finance the Revolutionary War, silver coins struck by the government left circulation, and in 1806 President Jefferson suspended the minting of silver coins.
1834, Coinage Act of 1834 16:1 ratio; 1ozt Gold $20.67/23.2 grains Gold $1; 371.25grains Silver $1; 														

1849, California Gold Rush
1853, Silver coinage (except $1) debased 
1859, Comstock Lode – Nevada Silver Rush
The US Treasury was put on a strict hard money standard, doing business only in gold or silver coin as part of the Independent Treasury Act of 1848, which legally separated the accounts of the federal government from the banking system. However the fixed rate of gold to silver overvalued silver in relation to the demand for gold to trade or borrow from England. Following Gresham's law, silver poured into the US, which traded with other silver nations, and gold moved out. In 1853 the US reduced the silver weight of coins, to keep them in circulation, and in 1857 removed legal tender status from foreign coinage.
1861-1865, American Civil War
In 1857, the final crisis of the free banking era of international finance began, as American banks suspended payment in silver, rippling through the very young international financial system of central banks. In 1861 the US government suspended payment in gold and silver, effectively ending the attempts to form a silver standard basis for the dollar. Through the 1860-1871 period, various attempts to resurrect bi-metallic standards were made, including one based on the gold and silver franc; however, with the rapid influx of silver from new deposits, the expectation of scarcity of silver ended.
The combination that produced economic stability was restriction of supply of new notes, a government monopoly on the issuance of notes directly and indirectly, a central bank, and a single unit of value. As notes devalued, or silver ceased to circulate as a store of value, or there was a depression, governments demanding specie as payment drained the circulating medium out of the economy. At the same time there was a dramatically expanded need for credit, and large banks were being chartered in various states, including those in Japan by 1872. The need for stability in monetary affairs would produce a rapid acceptance of the gold standard in the period that followed.
The Coinage Act of 1873, enacted by the United States Congress in 1873, embraced the gold standard and de-monetized silver. Western mining interests and others who wanted silver in circulation labeled this measure the "Crime of '73". For about five years, gold was the only metallic standard in the United States until passage of the Bland-Allison Act on February 28, 1878, requiring the US Treasury to purchase domestic silver bullion to be minted into legal tender coins co-existent with gold coins. Silver Certificate Series 1878 was issued to join the gold certificates already in circulation.
1933-1934, Gold (1/20.67th oz in 1933 to 1/35th in 1934 by Rooosevelt															
By acts of Congress in 1933, including the Gold Reserve Act and the Silver Purchase Act of 1934, the domestic economy was taken off the gold standard and placed on the silver standard for the first time. The Treasury Department was reempowered to issue paper currency redeemable in silver dollars and bullion, thereby divorcing the domestic economy from bimetallism and leaving it on the silver standard, although international settlements were still in gold.[6]
This meant that for every ounce of silver in the U.S. Treasury's vaults, the U.S. government could continue to issue money against it. These silver certificates were shredded upon redemption since the redeemed silver was no longer in the Treasury. With the world market price of silver having been in excess of $1.29 per troy ounce since 1960, silver began to flow out of the Treasury at an increasing rate. To slow the drain, President Kennedy ordered a halt to issuing $5 and $10 silver certificates in 1962. That left the $1 silver certificate as the only denomination being issued.
1944, Bretton Woods Created
Preparing to rebuild the international economic system while World War II was still raging, 730 delegates from all 44 Allied nations gathered at the Mount Washington Hotel in Bretton Woods, New Hampshire, United States, for the United Nations Monetary and Financial Conference, also known as the Bretton Woods Conference. The delegates deliberated during 1–22 July 1944, and signed the Bretton Woods agreement on its final day. Setting up a system of rules, institutions, and procedures to regulate the international monetary system, these accords established the International Monetary Fund (IMF) and the International Bank for Reconstruction and Development (IBRD), which today is part of the World Bank Group. The United States, which controlled two thirds of the world's gold, insisted that the Bretton Woods system rest on both gold and the US dollar. Soviet representatives attended the conference but later declined to ratify the final agreements, charging that the institutions they had created were "branches of Wall Street."[1] These organizations became operational in 1945 after a sufficient number of countries had ratified the agreement.

1963, Silver removed from currency
On June 4, 1963, Kennedy signed Public Law 88-36, which marked the beginning of the end for even the $1 silver certificate. The law authorized the Federal Reserve to issue $1 and $2 bills, and revoked the Silver Purchase Act of 1934, which authorized the Secretary of the Treasury to issue silver certificates (by now limited to the $1 denomination). Because it would be several months before the new $1 Federal Reserve Notes could enter circulation in quantity, there was a need to issue silver certificates in the interim. Because the Agricultural Adjustment Act of 1933 granted the right to issue silver certificates to the president, Kennedy issued Executive Order 11110 to delegate that authority to the Treasury Secretary during the transition
Silver certificates continued to be issued until late 1963, when the $1 Federal Reserve Note was released into circulation. For several years, existing silver certificates could be redeemed for silver, but this practice was halted on June 24, 1968

1971, Nixon completely decoupled the US Dollar and Gold															
Finally, President Richard Nixon announced[7] on August 15, 1971 the end of the Bretton Woods international monetary system meaning that the United States would no longer redeem currency for gold or any other precious metal, forming the final step in abandoning the gold and silver standards. This announcement was part of the economic measures now known as the "Nixon Shock".
Due to the monetary policy of the U.S Federal Reserve, calls for a return to the gold standard have returned.[citation needed] Some states have chosen to use a loophole in the Federal Reserve act that gives individual states the right to issue currencies of gold or silver coins or rounds.[citation needed] This was done because the Federal Reserve act does not allow them to print their own currency if they wished.[citation needed] As of January 2012, Utah allowed the payment of debt to be settled in silver and gold, and the value of the American silver or gold rounds used was pegged to the price of the given precious metal.[citation needed] Payment in some cases can be requested to be made in silver or gold rounds. As of 2011, eleven other U.S states were currently exploring their options to possibly make similar changes like Utah.[8]






GOLD STANDARD

US: Pre-Civil War
In 1792, Congress passed the Mint and Coinage Act. It authorized the Federal Government's use of the Bank of the United States to hold its reserves, as well as establish a fixed ratio of gold to the U.S. dollar. Gold and silver coins were legal tender, as was the Spanish Real. In 1792 the market price of gold was about 15 times that of silver.[14] Silver coins left circulation, exported to pay for the debts taken on to finance the American Revolutionary War. In 1806 President Jefferson suspended the minting of silver coins. This resulted in a derivative silver standard, since the Bank of the United States was not required to fully back its currency with reserves. This began a long series of attempts by the United States to create a bi-metallic standard.
The intention was to use gold for large denominations, and silver for smaller denominations. A problem with bimetallic standards was that the metals' absolute and relative market prices changed. The mint ratio (the rate at which the mint was obligated to pay/receive for gold relative to silver) remained fixed at 15 ounces of silver to 1 ounce of gold, whereas the market rate fluctuated from 15.5 to 1 to 16 to 1. With the Coinage Act of 1834, Congress passed an act that changed the mint ratio to approximately 16 to 1. Gold discoveries in California in 1848 and later in Australia lowered the gold price to fall relative to silver; this drove silver money from circulation because it was worth more in the market than as money.[16] Passage of the Independent Treasury Act of 1848 placed the U.S. on a strict hard-money standard. Doing business with the American government required gold or silver coins.
Government accounts were legally separated from the banking system. However, the mint ratio (the fixed exchange rate between gold and silver at the mint) continued to overvalue gold. In 1853, the US reduced the silver weight of coins to keep them in circulation and in 1857 removed legal tender status from foreign coinage. In 1857 the final crisis of the free banking era began as American banks suspended payment in silver, with ripples through the developing international financial system. Due to the inflationary finance measures undertaken to help pay for the US Civil War, the government found it difficult to pay its obligations in gold or silver and suspended payments of obligations not legally specified in specie (gold bonds); this led banks to suspend the conversion of bank liabilities (bank notes and deposits) into specie. In 1862 paper money was made legal tender. It was a fiat money (not convertible on demand at a fixed rate into specie). These notes came to be called "greenbacks".[16]
US: Post-Civil War
After the Civil War, Congress wanted to reestablish the metallic standard at pre-war rates. The market price of gold in greenbacks was above the pre-War fixed price ($20.67 per ounce of gold) requiring deflation to achieve the pre-War price. This was accomplished by growing the stock of money less rapidly than real output. By 1879 the market price matched the mint price of gold ($20.67 per ounce). The coinage act of 1873 (also known as the Crime of ‘73) demonetized silver. This act removed the 412.5 grain silver dollar from circulation. Subsequently silver was only used in coins worth less than $1 (fractional currency). With the resumption of convertibility on June 30, 1879 the government again paid its debts in gold, accepted greenbacks for customs and redeemed greenbacks on demand in gold. Greenbacks were therefore perfect substitutes for gold coins. During the latter part of the nineteenth century the use of silver and a return to the bimetallic standard were recurrent political issues, raised especially by William Jennings Bryan, the People's Party and the Free Silver movement . In 1900 the gold dollar was declared the standard unit of account and a gold reserve for government issued paper notes was established. Greenbacks, silver certificates, and silver dollars continued to be legal tender, all redeemable in gold.[16]
Fluctuations in the US gold stock, 1862–1877
US gold stock
1862	59 tons
1866	81 tons
1875	50 tons
1878	78 tons
The US had a gold stock of 1.9 million ounces (59 t) in 1862. Stocks rose to 2.6 (81 t) in 1866, declined in 1875 to 1.6 million ounces (50 t) and rose to 2.5 million (78 t) in 1878. Net exports did not mirror that pattern. In the decade before the Civil War net exports were roughly constant; postwar they varied erratically around pre-war levels, but fell significantly in 1877 and became negative in 1878 and 1879. The net import of gold meant that the foreign demand for American currency to purchase goods, services, and investments exceeded the corresponding American demands for foreign currencies. In the final years of the greenback period (1862–1879), gold production increased while gold exports decreased. The decrease in gold exports was considered by some to be a result of changing monetary conditions. The demands for gold during this period were as a speculative vehicle, and for its primary use in the foreign exchange markets financing international trade. The major effect of the increase in gold demand by the public and Treasury was to reduce exports of gold and increase the Greenback price of gold relative to purchasing power.[17]
Gold exchange standard
 	This section needs additional citations for verification. Please help improve this article by adding citations to reliable sources. Unsourced material may be challenged and removed. (March 2013)
Towards the end of the 19th century, some silver standard countries began to peg their silver coin units to the gold standards of the United Kingdom or the US. In 1898, British India pegged the silver rupee to the pound sterling at a fixed rate of 1s 4d, while in 1906, the Straits Settlements adopted a gold exchange standard against sterling, fixing the silver Straits dollar at 2s 4d.
Around the start of the 20th century, the Philippines pegged the silver peso/dollar to the U.S. dollar at 50 cents. This move was assisted by the passage of the Philippines Coinage Act by the United States Congress on March 3, 1903.[18] Around the same time Mexico and Japan pegged their currencies to the dollar. When Siam adopted a gold exchange standard in 1908, only China and Hong Kong remained on the silver standard.
When adopting the gold standard, many European nations changed the name of their currency from Daler (Sweden and Denmark) or Gulden (Austria-Hungary) to Crown, since the former names were traditionally associated with silver coins and the latter with gold coins.
Impact of World War I
Governments with insufficient tax revenue suspended convertibility repeatedly in the 19th century. The real test, however, came in the form of World War I, a test which "it failed utterly" according to economist Richard Lipsey.[7]
By the end of 1913, the classical gold standard was at its peak but World War I caused many countries to suspend or abandon it. According to Lawrence Officer the main cause of the gold standard’s failure to resume its previous position after World War 1 was “the Bank of England's precarious liquidity position and the gold-exchange standard.” A run on sterling caused Britain to impose exchange controls that fatally weakened the standard; convertibility was not legally suspended, but gold prices no longer played the role that they did before.[19] In financing the war and abandoning gold, many of the belligerents suffered drastic inflations. Price levels doubled in the US and Britain, tripled in France and quadrupled in Italy. Exchange rates change less, even though European inflations were more severe than America’s. This meant that the costs of American goods decreased relative to those in Europe. Between August 1914 and spring of 1915, the dollar value of US exports tripled and its trade surplus exceeded $1 billion for the first time.[20]
Ultimately, the system could not deal quickly enough with the large balance of payments deficits and surpluses; this was previously attributed to downward wage rigidity brought about by the advent of unionized labor, but is now considered as an inherent fault of the system that arose under the pressures of war and rapid technological change. In any case, prices had not reached equilibrium by the time of the Great Depression, which served to kill off the system completely.[7]
For example, Germany had gone off the gold standard in 1914, and could not effectively return to it because War reparations had cost it much of its gold reserves. During the Occupation of the Ruhr the German central bank (Reichsbank) issued enormous sums of non-convertible marks to support workers who were on strike against the French occupation and to buy foreign currency for reparations; this led to the German hyperinflation of the early 1920s and the decimation of the German middle class.
The US did not suspend the gold standard during the war. The newly created Federal Reserve intervened in currency markets and sold bonds to “sterilize”[vague] some of the gold imports that would have otherwise increased the stock of money.[citation needed] By 1927 many countries had returned to the gold standard.[16] As a result of World War 1 the United States, which had been a net debtor country, had become a net creditor by 1919.[21]
Gold bullion replaces gold specie as standard
 
William McKinley ran for president on the basis of the gold standard.
The gold specie standard ended in the United Kingdom and the rest of the British Empire at the outbreak of World War I. Treasury notes replaced the circulation of gold sovereigns and gold half sovereigns. Legally, the gold specie standard was not repealed. The end of the gold standard was successfully effected by the Bank of England through appeals to patriotism urging citizens not to redeem paper money for gold specie. It was only in 1925, when Britain returned to the gold standard in conjunction with Australia and South Africa that the gold specie standard was officially ended.
The British Gold Standard Act 1925 both introduced the gold bullion standard and simultaneously repealed the gold specie standard. The new standard ended the circulation of gold specie coins. Instead, the law compelled the authorities to sell gold bullion on demand at a fixed price, but only in the form of bars containing approximately four hundred troy ounces (12 kg) of fine gold.[22] John Maynard Keynes argued against the deflationary dangers of resuming the gold standard.[23]
Many other countries followed Britain in returning to the gold standard, this was followed by a period of relative stability but also deflation.[24] This state of affairs lasted until the Great Depression (1929–1939) forced countries off the gold standard. In September 19, 1931, speculative attacks on the pound forced Britain to abandon the gold standard. Loans from American and French Central Banks of £50,000,000 were insufficient and exhausted in a matter of weeks, due to large gold outflows across the Atlantic.[25][26][27] The British benefited from this departure. They could now use monetary policy to stimulate the economy. Australia and New Zealand had already left the standard and Canada quickly followed suit.
The interwar partially backed gold standard was inherently unstable, because of the conflict between the expansion of liabilities to foreign central banks and the resulting deterioration in the Bank of England's reserve ratio. France was then attempting to make Paris a world class financial center, and it received large gold flows as well.[28]
In May 1931 a run on Austria's largest commercial bank caused it to fail. The run spread to Germany, where the central bank also collapsed. International financial assistance was too late and in July 1931 Germany adopted exchange controls, followed by Austria in October. The Austrian and German experiences, as well as British budgetary and political difficulties, were among the factors that destroyed confidence in sterling, which occurred in mid-July 1931. Runs ensued and the Bank of England lost much of its reserves.
Depression and World War II
 
Ending the gold standard and economic recovery during the Great Depression.[29]
Great Depression
Some economic historians, such as Barry Eichengreen, blame the gold standard of the 1920s for prolonging the economic depression which started in 1929 and lasted for about a decade.[30] Adherence to the gold standard prevented the Federal Reserve from expanding the money supply to stimulate the economy, fund insolvent banks and fund government deficits that could "prime the pump" for an expansion. Once off the gold standard, it became free to engage in such money creation. The gold standard limited the flexibility of the central banks' monetary policy by limiting their ability to expand the money supply. In the US, the Federal Reserve was required by law to have gold backing 40% of its demand notes.[31] Others including former Federal Reserve Chairman Ben Bernanke and Nobel Prize-winner Milton Friedman place the blame for the severity and length of the Great Depression at the feet of the Federal Reserve, mostly due to the deliberate tightening of monetary policy even after the gold standard.[32] They blamed the US major economic contraction in 1937 on tightening of monetary policy resulting in higher cost of capital, weaker securities markets, reduced net government contribution to income, the undistributed profits tax and higher labor costs.[33] The money supply peaked in March 1937, with a trough in May 1938.[34]
Higher interest rates intensified the deflationary pressure on the dollar and reduced investment in U.S. banks. Commercial banks converted Federal Reserve Notes to gold in 1931, reducing its gold reserves and forcing a corresponding reduction in the amount of currency in circulation. This speculative attack created a panic in the U.S. banking system. Fearing imminent devaluation many depositors withdrew funds from U.S. banks.[35] As bank runs grew, a reverse multiplier effect caused a contraction in the money supply.[36] Additionally the New York Fed had loaned over $150 million in gold (over 240 tons) to European Central Banks. This transfer contracted the US money supply. The foreign loans became questionable once Britain, Germany, Austria and other European countries went off the gold standard in 1931 and weakened confidence in the dollar.[37]
The forced contraction of the money supply resulted in deflation. Even as nominal interest rates dropped, inflation-adjusted real interest rates remained high, rewarding those who held onto money instead of spending it, further slowing the economy.[38] Recovery in the United States was slower than in Britain, in part due to Congressional reluctance to abandon the gold standard and float the U.S. currency as Britain had done.[39]
In the early 1930s, the Federal Reserve defended the dollar by raising interest rates, trying to increase the demand for dollars. This helped attract international investors who bought foreign assets with gold.[35]
Congress passed the Gold Reserve Act on 30 January 1934; the measure nationalized all gold by ordering Federal Reserve banks to turn over their supply to the U.S. Treasury. In return the banks received gold certificates to be used as reserves against deposits and Federal Reserve notes. The act also authorized the president to devalue the gold dollar. Under this authority the president, on 31 January 1934, changed the value of the dollar from $20.67 to the troy ounce to $35 to the troy ounce, a devaluation of over 40%.
Other factors in the prolongation of the Great Depression include trade wars and the reduction in international trade caused by barriers such as Smoot-Hawley Tariff in the US and the Imperial Preference policies of Great Britain,[40] the failure of central banks to act responsibly,[41] government policies designed to prevent wages from falling, such as the Davis-Bacon Act of 1931, during the deflationary period resulting in production costs dropping slower than sales prices, thereby injuring business profits[42] and increases in taxes to reduce budget deficits and to support new programs such as Social Security. The US top marginal income tax rate went from 25% to 63% in 1932 and to 79% in 1936,[43] while the bottom rate increased over tenfold, from .375% in 1929 to 4% in 1932.[44] The concurrent massive drought resulted in the US Dust Bowl.
The Austrian School claimed that the Great Depression was the result of a credit bust.[45] Alan Greenspan wrote that the bank failures of the 1930s were sparked by Great Britain dropping the gold standard in 1931. This act "tore asunder" any remaining confidence in the banking system.[46] Financial historian Niall Ferguson wrote that what made the Great Depression truly 'great' was the European banking crisis of 1931.[47] According to Fed Chairman Marriner Eccles, the root cause was the concentration of wealth resulting in a stagnating or decreasing standard of living for the poor and middle class. These classes went into debt, producing the credit explosion of the 1920s. Eventually the debt load grew too heavy, resulting in the massive defaults and financial panics of the 1930s.[48]
World War II
Under the Bretton Woods international monetary agreement of 1944, the gold standard was kept without domestic convertibility. The role of gold was severely constrained, as other countries’ currencies were fixed in terms of the dollar. Many countries kept reserves in gold and settled accounts in gold. Still they preferred to settle balances with other currencies, with the American dollar becoming the favorite. The International Monetary Fund was established to help with the exchange process and assist nations in maintaining fixed rates. Within Bretton Woods adjustment was cushioned through credits that helped countries avoid deflation. Under the old standard, a country with an overvalued currency would lose gold and experience deflation until the currency was again valued correctly. Most countries defined their currencies in terms of dollars, but some countries imposed trading restrictions to protect reserves and exchange rates. Therefore, most countries' currencies were still basically inconvertible. In the late 1950s, the exchange restrictions were dropped and gold became an important element in international financial settlements.[16]
Bretton Woods
 	This section needs additional citations for verification. Please help improve this article by adding citations to reliable sources. Unsourced material may be challenged and removed. (October 2013)
Main article: Bretton Woods system
After the Second World War, a system similar to a gold standard and sometimes described as a "gold exchange standard" was established by the Bretton Woods Agreements. Under this system, many countries fixed their exchange rates relative to the U.S. dollar and central banks could exchange dollar holdings into gold at the official exchange rate of $35 per ounce; this option was not available to firms or individuals. All currencies pegged to the dollar thereby had a fixed value in terms of gold.[7]
Starting in the 1959-1969 administration of President Charles de Gaulle and continuing until 1970, France reduced its dollar reserves, exchanging them for gold at the official exchange rate, reducing US economic influence. This, along with the fiscal strain of federal expenditures for the Vietnam War and persistent balance of payments deficits, led U.S. President Richard Nixon to end international convertibility of the U.S. dollar to gold on August 15, 1971 (the "Nixon Shock").
This was meant to be a temporary measure with the gold price of the dollar, and the official rate of exchanges remaining constant. Revaluing currencies was the main purpose of this plan. No official revaluation or redemption occurred. The dollar subsequently floated. In December 1971, the “Smithsonian Agreement” was reached. In this agreement, the dollar was devalued from $35 per troy ounce of gold to $38. Other countries' currencies appreciated. This was the official price of the dollar, and policies to maintain its value relative to other currencies. However, gold convertibility did not resume. In October 1973, the price was raised to $42.22. Once again, the devaluation was insufficient. Within two weeks of the second devaluation the dollar was left to float. The $42.22 par value was made official in September 1973, long after it had been abandoned in practice. In October 1976, the government officially changed the definition of the dollar; references to gold were removed from statutes. From this point, the international monetary system was made of pure fiat money.



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
<tr class="tableizer-firstrow"><td>Year</td><td>Silver</td><td>Gold</td><td>GSR</td></tr>
 <tr><td>1792</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1793</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1794</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1795</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1796</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1797</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1798</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1799</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1800</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1801</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1802</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1803</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1804</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1805</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1806</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1807</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1808</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1809</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1810</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1811</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1812</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1813</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1814</td><td>1.453</td><td>19.39</td><td>13.35</td></tr>
 <tr><td>1815</td><td>1.477</td><td>19.39</td><td>13.13</td></tr>
 <tr><td>1816</td><td>1.323</td><td>19.39</td><td>14.66</td></tr>
 <tr><td>1817</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1818</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1819</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1820</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1821</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1822</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1823</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1824</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1825</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1826</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1827</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1828</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1829</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1830</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1831</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1832</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1833</td><td>1.293</td><td>19.39</td><td>15.00</td></tr>
 <tr><td>1834</td><td>1.293</td><td>20.69</td><td>16.00</td></tr>
 <tr><td>1835</td><td>1.293</td><td>20.65</td><td>15.97</td></tr>
 <tr><td>1836</td><td>1.293</td><td>20.65</td><td>15.97</td></tr>
 <tr><td>1837</td><td>1.350</td><td>20.65</td><td>15.30</td></tr>
 <tr><td>1838</td><td>1.296</td><td>20.65</td><td>15.93</td></tr>
 <tr><td>1839</td><td>1.296</td><td>20.65</td><td>15.93</td></tr>
 <tr><td>1840</td><td>1.296</td><td>20.65</td><td>15.93</td></tr>
 <tr><td>1841</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1842</td><td>1.293</td><td>20.65</td><td>15.97</td></tr>
 <tr><td>1843</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1844</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1845</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1846</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1847</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1848</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1849</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1850</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1851</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1852</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1853</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1854</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1855</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1856</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1857</td><td>1.294</td><td>20.65</td><td>15.96</td></tr>
 <tr><td>1858</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1859</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1860</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1861</td><td>1.292</td><td>20.65</td><td>15.98</td></tr>
 <tr><td>1862</td><td>1.709</td><td>20.65</td><td>12.08</td></tr>
 <tr><td>1863</td><td>1.952</td><td>20.65</td><td>10.58</td></tr>
 <tr><td>1864</td><td>2.939</td><td>20.65</td><td>7.03</td></tr>
 <tr><td>1865</td><td>1.889</td><td>20.65</td><td>10.93</td></tr>
 <tr><td>1866</td><td>1.766</td><td>20.65</td><td>11.69</td></tr>
 <tr><td>1867</td><td>1.741</td><td>20.65</td><td>11.86</td></tr>
 <tr><td>1868</td><td>1.747</td><td>20.65</td><td>11.82</td></tr>
 <tr><td>1869</td><td>1.569</td><td>20.65</td><td>13.16</td></tr>
 <tr><td>1870</td><td>1.430</td><td>20.65</td><td>14.44</td></tr>
 <tr><td>1871</td><td>1.412</td><td>20.65</td><td>14.62</td></tr>
 <tr><td>1872</td><td>1.449</td><td>20.66</td><td>14.26</td></tr>
 <tr><td>1873</td><td>1.421</td><td>20.66</td><td>14.54</td></tr>
 <tr><td>1874</td><td>1.411</td><td>20.66</td><td>14.64</td></tr>
 <tr><td>1875</td><td>1.394</td><td>20.66</td><td>14.82</td></tr>
 <tr><td>1876</td><td>1.315</td><td>20.66</td><td>15.71</td></tr>
 <tr><td>1877</td><td>1.212</td><td>20.66</td><td>17.05</td></tr>
 <tr><td>1878</td><td>1.100</td><td>20.66</td><td>18.78</td></tr>
 <tr><td>1879</td><td>1.144</td><td>20.65</td><td>18.05</td></tr>
 <tr><td>1880</td><td>1.116</td><td>20.66</td><td>18.51</td></tr>
 <tr><td>1881</td><td>1.129</td><td>20.66</td><td>18.30</td></tr>
 <tr><td>1882</td><td>1.099</td><td>20.66</td><td>18.80</td></tr>
 <tr><td>1883</td><td>1.110</td><td>20.66</td><td>18.61</td></tr>
 <tr><td>1884</td><td>1.064</td><td>20.66</td><td>19.42</td></tr>
 <tr><td>1885</td><td>1.032</td><td>20.66</td><td>20.02</td></tr>
 <tr><td>1886</td><td>1.006</td><td>20.65</td><td>20.53</td></tr>
 <tr><td>1887</td><td>0.970</td><td>20.65</td><td>21.29</td></tr>
 <tr><td>1888</td><td>0.936</td><td>20.66</td><td>22.07</td></tr>
 <tr><td>1889</td><td>0.959</td><td>20.65</td><td>21.53</td></tr>
 <tr><td>1890</td><td>1.056</td><td>20.66</td><td>19.56</td></tr>
 <tr><td>1891</td><td>0.956</td><td>20.68</td><td>21.63</td></tr>
 <tr><td>1892</td><td>0.840</td><td>20.68</td><td>24.62</td></tr>
 <tr><td>1893</td><td>0.703</td><td>20.68</td><td>29.42</td></tr>
 <tr><td>1894</td><td>0.615</td><td>20.66</td><td>33.59</td></tr>
 <tr><td>1895</td><td>0.677</td><td>20.65</td><td>30.50</td></tr>
 <tr><td>1896</td><td>0.664</td><td>20.71</td><td>31.19</td></tr>
 <tr><td>1897</td><td>0.590</td><td>20.71</td><td>35.10</td></tr>
 <tr><td>1898</td><td>0.603</td><td>20.71</td><td>34.34</td></tr>
 <tr><td>1899</td><td>0.600</td><td>20.66</td><td>34.43</td></tr>
 <tr><td>1900</td><td>0.648</td><td>20.68</td><td>31.91</td></tr>
 <tr><td>1901</td><td>0.558</td><td>20.71</td><td>37.11</td></tr>
 <tr><td>1902</td><td>0.487</td><td>20.69</td><td>42.48</td></tr>
 <tr><td>1903</td><td>0.560</td><td>20.67</td><td>36.91</td></tr>
 <tr><td>1904</td><td>0.612</td><td>20.68</td><td>33.79</td></tr>
 <tr><td>1905</td><td>0.655</td><td>20.64</td><td>31.51</td></tr>
 <tr><td>1906</td><td>0.969</td><td>20.62</td><td>21.28</td></tr>
 <tr><td>1907</td><td>0.552</td><td>20.66</td><td>37.43</td></tr>
 <tr><td>1908</td><td>0.494</td><td>20.67</td><td>41.84</td></tr>
 <tr><td>1909</td><td>0.529</td><td>20.68</td><td>39.09</td></tr>
 <tr><td>1910</td><td>0.553</td><td>20.64</td><td>37.32</td></tr>
 <tr><td>1911</td><td>0.556</td><td>20.64</td><td>37.12</td></tr>
 <tr><td>1912</td><td>0.640</td><td>20.65</td><td>32.27</td></tr>
 <tr><td>1913</td><td>0.584</td><td>20.64</td><td>35.34</td></tr>
 <tr><td>1914</td><td>0.503</td><td>20.72</td><td>41.19</td></tr>
 <tr><td>1915</td><td>0.561</td><td>20.72</td><td>36.93</td></tr>
 <tr><td>1916</td><td>0.758</td><td>20.72</td><td>27.34</td></tr>
 <tr><td>1917</td><td>0.899</td><td>20.72</td><td>23.05</td></tr>
 <tr><td>1918</td><td>1.019</td><td>20.72</td><td>20.33</td></tr>
 <tr><td>1919</td><td>1.336</td><td>20.70</td><td>15.49</td></tr>
 <tr><td>1920</td><td>0.655</td><td>20.68</td><td>31.57</td></tr>
 <tr><td>1921</td><td>0.663</td><td>20.58</td><td>31.04</td></tr>
 <tr><td>1922</td><td>0.643</td><td>20.66</td><td>32.13</td></tr>
 <tr><td>1923</td><td>0.650</td><td>21.32</td><td>32.80</td></tr>
 <tr><td>1924</td><td>0.692</td><td>20.69</td><td>29.90</td></tr>
 <tr><td>1925</td><td>0.692</td><td>20.64</td><td>29.83</td></tr>
 <tr><td>1926</td><td>0.538</td><td>20.63</td><td>38.35</td></tr>
 <tr><td>1927</td><td>0.583</td><td>20.64</td><td>35.40</td></tr>
 <tr><td>1928</td><td>0.577</td><td>20.66</td><td>35.81</td></tr>
 <tr><td>1929</td><td>0.488</td><td>20.63</td><td>42.27</td></tr>
 <tr><td>1930</td><td>0.330</td><td>20.65</td><td>62.58</td></tr>
 <tr><td>1931</td><td>0.304</td><td>17.06</td><td>56.12</td></tr>
 <tr><td>1932</td><td>0.254</td><td>20.69</td><td>81.46</td></tr>
 <tr><td>1933</td><td>0.437</td><td>26.33</td><td>60.25</td></tr>
 <tr><td>1934</td><td>0.544</td><td>34.69</td><td>63.77</td></tr>
 <tr><td>1935</td><td>0.584</td><td>34.84</td><td>59.66</td></tr>
 <tr><td>1936</td><td>0.454</td><td>34.87</td><td>76.81</td></tr>
 <tr><td>1937</td><td>0.438</td><td>34.79</td><td>79.43</td></tr>
 <tr><td>1938</td><td>0.428</td><td>34.85</td><td>81.43</td></tr>
 <tr><td>1939</td><td>0.350</td><td>34.42</td><td>98.34</td></tr>
 <tr><td>1940</td><td>0.348</td><td>33.85</td><td>97.27</td></tr>
 <tr><td>1941</td><td>0.351</td><td>33.85</td><td>96.44</td></tr>
 <tr><td>1942</td><td>0.448</td><td>33.85</td><td>75.56</td></tr>
 <tr><td>1943</td><td>0.448</td><td>33.85</td><td>75.56</td></tr>
 <tr><td>1944</td><td>0.448</td><td>33.85</td><td>75.56</td></tr>
 <tr><td>1945</td><td>0.708</td><td>34.71</td><td>49.03</td></tr>
 <tr><td>1946</td><td>0.867</td><td>34.71</td><td>40.03</td></tr>
 <tr><td>1947</td><td>0.746</td><td>34.71</td><td>46.53</td></tr>
 <tr><td>1948</td><td>0.700</td><td>34.71</td><td>49.59</td></tr>
 <tr><td>1949</td><td>0.733</td><td>31.69</td><td>43.23</td></tr>
 <tr><td>1950</td><td>0.800</td><td>34.72</td><td>43.40</td></tr>
 <tr><td>1951</td><td>0.880</td><td>34.72</td><td>39.45</td></tr>
 <tr><td>1952</td><td>0.833</td><td>34.60</td><td>41.54</td></tr>
 <tr><td>1953</td><td>0.853</td><td>34.84</td><td>40.84</td></tr>
 <tr><td>1954</td><td>0.853</td><td>35.04</td><td>41.08</td></tr>
 <tr><td>1955</td><td>0.905</td><td>35.03</td><td>38.71</td></tr>
 <tr><td>1956</td><td>0.914</td><td>34.99</td><td>38.28</td></tr>
 <tr><td>1957</td><td>0.898</td><td>34.95</td><td>38.92</td></tr>
 <tr><td>1958</td><td>0.899</td><td>35.10</td><td>39.04</td></tr>
 <tr><td>1959</td><td>0.914</td><td>35.10</td><td>38.40</td></tr>
 <tr><td>1960</td><td>0.914</td><td>35.27</td><td>38.59</td></tr>
 <tr><td>1961</td><td>1.033</td><td>35.25</td><td>34.12</td></tr>
 <tr><td>1962</td><td>1.199</td><td>35.23</td><td>29.38</td></tr>
 <tr><td>1963</td><td>1.293</td><td>35.07</td><td>27.12</td></tr>
 <tr><td>1964</td><td>1.293</td><td>35.10</td><td>27.15</td></tr>
 <tr><td>1965</td><td>1.293</td><td>35.12</td><td>27.16</td></tr>
 <tr><td>1966</td><td>1.293</td><td>35.13</td><td>27.17</td></tr>
 <tr><td>1967</td><td>2.060</td><td>34.95</td><td>16.97</td></tr>
 <tr><td>1968</td><td>1.959</td><td>38.69</td><td>19.75</td></tr>
 <tr><td>1969</td><td>1.807</td><td>41.09</td><td>22.74</td></tr>
 <tr><td>1970</td><td>1.635</td><td>35.94</td><td>21.98</td></tr>
 <tr><td>1971</td><td>1.394</td><td>40.80</td><td>29.27</td></tr>
 <tr><td>1972</td><td>1.976</td><td>58.16</td><td>29.43</td></tr>
 <tr><td>1973</td><td>3.137</td><td>97.32</td><td>31.02</td></tr>
 <tr><td>1974</td><td>4.391</td><td>159.26</td><td>36.27</td></tr>
 <tr><td>1975</td><td>4.085</td><td>161.02</td><td>39.42</td></tr>
 <tr><td>1976</td><td>4.347</td><td>124.84</td><td>28.72</td></tr>
 <tr><td>1977</td><td>4.706</td><td>147.71</td><td>31.39</td></tr>
 <tr><td>1978</td><td>5.930</td><td>193.22</td><td>32.58</td></tr>
 <tr><td>1979</td><td>21.793</td><td>306.68</td><td>14.07</td></tr>
 <tr><td>1980</td><td>16.393</td><td>612.56</td><td>37.37</td></tr>
 <tr><td>1981</td><td>8.432</td><td>460.03</td><td>54.56</td></tr>
 <tr><td>1982</td><td>10.586</td><td>375.67</td><td>35.49</td></tr>
 <tr><td>1983</td><td>9.121</td><td>424.35</td><td>46.52</td></tr>
 <tr><td>1984</td><td>6.694</td><td>360.48</td><td>53.85</td></tr>
 <tr><td>1985</td><td>5.888</td><td>317.26</td><td>53.88</td></tr>
 <tr><td>1986</td><td>5.364</td><td>367.66</td><td>68.54</td></tr>
 <tr><td>1987</td><td>6.790</td><td>446.46</td><td>65.75</td></tr>
 <tr><td>1988</td><td>6.108</td><td>436.94</td><td>71.54</td></tr>
 <tr><td>1989</td><td>5.543</td><td>381.44</td><td>68.81</td></tr>
 <tr><td>1990</td><td>4.068</td><td>383.51</td><td>94.27</td></tr>
 <tr><td>1991</td><td>3.909</td><td>362.11</td><td>92.63</td></tr>
 <tr><td>1992</td><td>3.710</td><td>343.82</td><td>92.67</td></tr>
 <tr><td>1993</td><td>4.968</td><td>359.77</td><td>72.42</td></tr>
 <tr><td>1994</td><td>4.769</td><td>384.00</td><td>80.52</td></tr>
 <tr><td>1995</td><td>5.148</td><td>384.17</td><td>74.63</td></tr>
 <tr><td>1996</td><td>4.730</td><td>387.77</td><td>81.98</td></tr>
 <tr><td>1997</td><td>5.945</td><td>330.98</td><td>55.67</td></tr>
 <tr><td>1998</td><td>5.549</td><td>294.24</td><td>53.03</td></tr>
 <tr><td>1999</td><td>5.218</td><td>278.88</td><td>53.45</td></tr>
 <tr><td>2000</td><td>4.951</td><td>279.11</td><td>56.38</td></tr>
 <tr><td>2001</td><td>4.370</td><td>271.04</td><td>62.02</td></tr>
 <tr><td>2002</td><td>4.600</td><td>309.73</td><td>67.34</td></tr>
 <tr><td>2003</td><td>4.876</td><td>363.38</td><td>74.53</td></tr>
 <tr><td>2004</td><td>6.671</td><td>409.72</td><td>61.42</td></tr>
 <tr><td>2005</td><td>7.316</td><td>444.74</td><td>60.79</td></tr>
 <tr><td>2006</td><td>11.545</td><td>603.46</td><td>52.27</td></tr>
 <tr><td>2007</td><td>13.384</td><td>695.39</td><td>51.96</td></tr>
 <tr><td>2008</td><td>14.989</td><td>871.96</td><td>58.17</td></tr>
 <tr><td>2009</td><td>13.110</td><td>972.35</td><td>74.17</td></tr>
 <tr><td>2010</td><td>20.193</td><td>1224.53</td><td>60.64</td></tr>
 <tr><td>2011</td><td>35.119</td><td>1571.52</td><td>44.75</td></tr>
 <tr><td>2012</td><td>31.150</td><td>1668.98</td><td>53.58</td></tr>
 <tr><td>2013</td><td>23.793</td><td>1411.23</td><td>59.31</td></tr>
 <tr><td>2014</td><td>20.484</td><td>1293.08</td><td>63.13</td></tr>
 <tr><td>2015</td><td> </td><td> </td><td> </td></tr>
</table>





 
 
  </pre>
 <hr>
  <pre>
 
 
 
 
 
 Deflation Precedes Hyperinflation-Long Answer 

It is impossible to call the exact time that the U.S. dollar will collapse; I would be a fool to try. But I will tell you that I think our fiat monetary system is approaching the end of its lifespan right now. I certainly didn't read the signs which predict hyperinflation until now. The signs that a hyperinflation is coming are detailed here. To qualify this post I will tell you that I am an avid reader, and I have a Masters Degree in administration, and a Bachelors Degree in history with minors in psychology and economics

I believe that a monetary collapse is fast approaching. I have been studying economic history to figure out how the U.S. could possibly have asset deflation when hyperinflation is what I was betting on. It seems counterintuitive that deflation could be occurring (cheaper assets) when liquidity is flooded into the economy from Federal Reserve policy. 

The problem with economies is that they are not machines. An economy is not controlled by the monetary policy of governments or central banks. Evidence of this is QE1 and QE2: the liquidity did nothing to free up credit markets. The QE did not work because, fear has taken center stage. People are not buying homes because it is hard to catch a falling knife-they are scared of depreciation and they are not secure in their jobs. Economies are controlled by people within the economy. People spend fiat when they are sure of their job security, and they have faith that the future will be secure. Fiat works well when people are secure. Machines do not have desires, and fears about the future. If the economy were a machine you would only have to give it gas and it would run faster. But when you gas an economy, you can never be sure of the result. In trying to re-inflate the housing market Ben Bernanke has caused inflation in other areas. Bernanke’s sworn enemy is deflation, and he will fall for the deflationary head fake very soon. 

What I discovered is that before hyperinflation there is always a period of asset deflation and a fiat currency rally. We are seeing that fiat rally in the U.S. dollar right now. Even gold and silver (both assets) are deflating as people clamor for U.S. dollars and U.S. Treasuries. This is one obvious sign of the impending fiat collapse. What is not disputed is that when people get scared, they raise cash or flee to the next best sure thing: U.S. treasuries. Cash is king: but this is only for a short time.

The Federal Reserve has created money as a back stop to take the moral hazard out of every bad investment for some time. That easy money from the fed is “scared money” trying to find safety. Institutions now find it too risky to loan money to the American consumer. Americans have been losing their jobs and swimming in debts for years. The jobs that left are simply gone-and they are not coming back. These bailed out institutions can’t believe their good fortune and they pay their employees and executives with the easy money from the fed. People who would have lost their jobs when their institutions failed are also bailed out. But, these employees are not certain of the economy so they hang onto their money. They do not buy a bigger house, or a new car, and they spend less. They keep their money in U.S. dollars and treasuries which they believe are certain to be a store of value. The institutions freeze pay, and refuse to hire new employees or invest in job creation.

It is all about the flow of capital. This is how it looks when money flows into the pyramid during credibility inflation. Picture this upside down pyramid as “credibility inflation” which has been occurring for the past forty years. Money flows into those investments which have “credibility”.

=Credit Default Swaps
=Collateralized Debt Obligations
=Mortgage Backed Securities
=Small Business
=Real Estate
=Diamonds and Gemstones
=OTC Stocks
=Commodities
=MUNI Bonds
=Corporate Bonds
=Listed Stocks
=Government Bonds
=Treasury Bills
=Federal Reserve Notes (Paper Money)
=Gold

You will notice that the dollar is at the bottom of the inverse pyramid, right above gold. For the past forty years people inflated assets with "credibility" all manner of bubbles and asset classes with easy credit. Think dot com bubble, think real estate bubble, think commodity bubble. Now as capital exits, the assets, businesses and derivatives it flows down and the U.S. dollar certainly sees a rally. But that will be short lived (it is happening now). The dollar is not the true foundation of the pyramid since it is merely a "government sponsored fraud". And as such, its value can be EASILY controlled by the Fed. As the higher levels on the pyramid have lost credibility there is only one place for smart money to flow to and that is the U.S. Dollar-and eventually Gold! The flight to quality will certainly end with gold since it is an asset with intrinsic value. 


Countesy of FOFOA-All fiat currency is a short position on gold.
Notice the bottleneck at the bottom of the pyramid? That is because there are not enough U.S. dollars or gold to supply everyone who will want them. This sounds wrong doesn't it? Well you should know that the U.S. holds 90% of the money supply in reserve. Only about ten percent of the U.S. dollars are actually in circulation. Most of the money supply actually only exists in the form of zeros and decimals in bank computers. When people rush to banks to get their fiat, there will have to be a bank holiday to get fiat to the banks. And after that rush to fiat, when fear chases people out of the dollar there is not enough gold in the world to convert the trillions in fiat which will seek conversion from zero value paper. All of the gold in the world has a value of about 9 trillion dollars. The debt of the U.S. alone is almost twice the value of all gold in the world. 

When the confidence is shattered there are not enough dollars to provide cash to everyone who will demand it. That is when the banks will need a bank holiday. Banks will close for a few days so that the U.S. can supply them with dollars which everyone will want. In every country which experienced hyperinflation it was like lightning had struck. What I have done is researched what actually occurs directly before a period of hyperinflation.

Here is the progression which confirms the hyperinflationary direction.
1. Monetization of bad debts is the beginning-bailouts, car and home buying subsidies-buying all bad debts and FDIC insurance-nobody loses
2. Deflation of assets is the second stage-as people become fearful of investing and fearful banks invest in safe assets-like cash and treasuries
3. A rise in the value U.S. dollar will follow-(happening now) up 13% since flirting with 71.
4. Next is the collapse of the dollar when fear takes over and the dollars will immediately seek conversion to value

It is after #4 in the progression that the Federal Reserve will resort to printing money in greater quantity to meet their obligations. The fear is what causes the hyperinflation. The fear of holding dollars which are supposed to be a store of value. Businesses will demand cash and reject checks and credit cards before the hyperinflation takes hold. 

You see most of this has started already. It has begun and yet the fear has not gripped the public yet. They have not recognized the deflationary head fake. When people do realize what is happening it will be too late to preserve your wealth or gather what you need to sustain you through the hyperinflationary time.

Have a look at the chart to see when Zimbabwe's hyperinflation started. 



The next chart is the "deflationary head-fake" (Argentina) right before the onset of hyperinflation as the private bank credit money disappears...



So first comes hyperinflation, then, and only then, comes the massive printing as the central bank tries desperately to keep the government functioning. So don't look for massive printing to see hyperinflation coming. Look for the monetization of bad debt (already happened) and the first signs of real price inflation (we are seeing it now in food and health care 10%), even in the face of apparently deflationary forces. 

...velocity & money demand.
Jim Powell explained velocity:
And that brings us to what economists call velocity. Money responds to the law of supply and demand just as everything else does. Velocity is the speed at which money changes hands. When demand for the money is high, money changes hands more slowly, and velocity is low. This is deflationary....When demand for the money is low, velocity is high.

A key point is that velocity and money supply can act as substitutes for each other. A 10% rise in velocity has the same effect as a 10% rise in money supply. The biggest problem with velocity and money demand is they can turn 180 degrees overnight. If people trust the currency, and suddenly perceive some kind of big threat to their futures, money demand can shoot up.

If you don't spend your money, that's the same thing as taking it out of circulation. This can instantly cause the equivalent of a sharp deflation of the money supply by 10 or 20 percent, or more.

That's what happened in the Great Depression. The Fed was inflating. In 1932, the money supply was $20 billion, and by 1940 it was $38 billion. But fear was so great that velocity was falling faster than money supply was rising. This is why Franklin Roosevelt said in his first inaugural speech, "The only thing we have to fear is fear itself." People were afraid to spend their money, as they are now, and velocity was falling, which has the same effect as deflation, because if you don't spend your money, it's not in circulation.

These wild shifts in money demand and velocity have the same effect as massive, instantaneous shifts up and down in money supply. It's like we're having a huge inflation, then a deflation, every few hours — because our fears change every few hours — because the politicians have all this arbitrary power and we don't know what they're going to do to us!

It is important to see that the economy is not a machine. Machines don't feel, they don't have fear...But people, biological organisms, do have feelings. They do fear, and their fears can change instantaneously.

Velocity of money is just like the stock market which is controlled by fear and greed.

The world is certainly not going to end after the currency collapse. We will just move to a fresh system. The government will certainly repudiate the current U.S. Dollars, and it will be decades before the general public will accept another fiat currency backed by nothing. But in the mean time your ability to survive the currency collapse is most important. Understand this: hyperinflation is the process of saving debt at all costs, even buying it outright for cash. This is exactly what our congress and quasi-government Federal Reserve has been doing.

This has caused issuers of bad debt to stop issuing debt and flee to safer investments, which in turn has caused the public to have less credit? This is what is impossible to control for our government-even the operation twist will be unsuccessful in making banks free up credit for consumers. And all of this has caused the deflationary head fake which has led to a flight to U.S. dollars. And this will all end in a currency confidence collapse. And dollars will seek conversion to real goods. And that is when hyperinflation will begin.

Further References:
Fiat Paper Money: The History and Evolution of our Currency Raph T. Foster
FOFOA- http://fofoa.blogspot.com/2010/09/just-another-hyperinflation-post-part-2.html
My Blog: http://tacticaldefensellc.com/Blog.html
James Quinn
Peter Schiff
Michael Pento 

Saving Private Ryan 

There was a scene in the movie, Saving Private Ryan where an American soldier was shot and dying. His comrades gathered around him and tried to stop the bleeding.
The soldiers try to save the man by pouring sulfa on his gut wound. The wounded man asks for morphine. They quickly give him a shot of morphine. It does nothing for the man and the bleeding intensifies. Quickly the soldiers pour more sulfa on his wound; the bleeding will not stop. Finally one soldier begs the wounded man, “How can we fix you?” The wounded man asks for more morphine. At this point the men all look at each other. They realize another shot of morphine will kill the wounded man. But they understand that he is dead anyway…so they give him the morphine. Better that he dies comfortably. 

This is the way I see the American economy. The American economy is the dying soldier in the movie. The morphine is the QE1,2 and eventually 3. The QE will kill the economy, but the economy is going to die anyway. So with nothing to lose, and some temporary comfort to gain, the QE is administered in whatever dose that is necessary to arrest the pain. 

Gold is money 

Originally Posted by kenn682 
Your explaination seems to lend credence and gives the operative dynamic to what Gonzalo Lira has previously stated! If accurate, this makes this craziness we're seeing even more scary. Could you expalin why gold is at the bottom of the inverse pyramid? I have my guess but what do I know?! Peace

 

People abandoned gold when they got comfortable with paper. This process took hundreds of years. So now when someone sees a 100 dollar bill on the sidewalk, they actually see GOLD. It has intrinsic value for what it can buy, and what people have been conditioned to believe about the paper. The governments of the world were successful in teaching people to trade paper. Paper holds value. Paper is not gold; but right now it is. 

When a person sees a piece of paper with $100 printed on it, they see value. But lately people see that the same $100 loses purchasing power each year. And the government cannot be trusted to mange the supply of paper. 

It is the law of supply and demand which dictates: when supply exceeds demand, the price will fall. The oversupply of fiat has already happened. The government sees that spending has not picked up, so they suspect "Deflation". But America is awash in liquidity-it is just that people are hanging on to the fiat as a store of value. Soon people will discover that holding fiat is dangerous-they will buy anything of value-chairs, lamps, backpacks-anything that can hold value; it will all be better than holding paper since the purchased item can be traded later. 

Gold is scarce, and it has always been considered to be money. A person can take gold anywhere in the world and it will be weighed-and you will receive what you like. When people realize that they have been fooled into thinking paper was money, they will seek to convert their fiat to the only logical honest money. In every case of currency failure: people turn to gold and silver since it is a store of value. There have been more than three thousand examples of fiat currency in the world, and every single one has ended in failure. No exceptions.



 
 
 
  </pre>
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
