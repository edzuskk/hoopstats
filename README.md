<h1>Kā gūt informāciju iekšā datubāzē?</h1>
<h1 style="color: red">!VISĀM DARBĪBĀM JĀNOTIEK ŠITAJĀ PATH: c:\laragon\www\HoopStats ! UN JAIZMANTO TERMINAL (LARAGON TERMINAL)</h1>
<li>Datubāzei jābut nosauktai "HoopStats"</li>
<li>php artisan migrate</li>
<li>php artisan db:seed</li>
<p>Tālāk sekos šis komandas lai gūt spēlētāju un komandu statistiku:</p>
<li>Spēlētāju statistika: "C:\laragon\bin\php\php-8.4.6-Win32-vs17-x64\php.exe" artisan players:sync-stats 2025-26 <li>
<li>Komandu statistika: "C:\laragon\bin\php\php-8.4.6-Win32-vs17-x64\php.exe" artisan teams:sync-stats 2025-26</li>