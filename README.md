<h1>Kā gūt informāciju iekšā datubāzē?</h1>
<h1 style="color: red">!VISĀM DARBĪBĀM JĀNOTIEK ŠITAJĀ PATH: c:\laragon\www\HoopStats ! UN JAIZMANTO TERMINAL (LARAGON TERMINAL)</h1>
<li>Datubāzei jābut nosauktai "HoopStats"</li>
<li>php artisan migrate</li>
<li>php artisan db:seed</li>
<p>Tālāk sekos šis komandas lai gūt spēlētāju un komandu statistiku:</p>
<li>Spēlētāju statistika: php artisan players:sync-stats 2025-26 <li>
<li>Komandu statistika: php artisan teams:sync-stats 2025-26</li>

<p>!Uzmanību! Ja ir slikts vai vājšs internets statistika netiks atjaunota/iegūta!</p>