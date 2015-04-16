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
