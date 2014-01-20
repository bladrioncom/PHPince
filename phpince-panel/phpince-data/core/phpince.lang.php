<?php
/*---------------------------------------------------------------------+
| PHPince Website
| Copyright (c) 2011 - 2014 Dominik Hulla
| Web: http://phpince.com
| Author: Dominik Hulla / dh@bladrion.com
| Developer: Bladrion Technologies (http://bladrion.com)
+----------------------------------------------------------------------+
| This program is free software: you can redistribute it and/or modify
| it under the terms of the GNU General Public License as published by
| the Free Software Foundation, either version 3 of the License, or
| (at your option) any later version.
| 
| This program is distributed in the hope that it will be useful,
| but WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
| GNU General Public License for more details.
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
| 
| You should have received a copy of the GNU General Public License
| along with this program.  If not, see <http://www.gnu.org/licenses/>.
+----------------------------------------------------------------------*/
header('Content-Type: text/html; charset=utf-8');
$PHPINCE_LANG = array(
	"English" => array(
	//Webadmin
		0 => 'Web panel',
		1 => 'Powered by',
		2 => 'Simple Content Management System',
		3 => 'Website',
		4 => 'Administration',
		5 => 'Settings',
		6 => 'Logout',
		7 => 'Navigation',
		8 => 'My Account',
		9 => 'Save',
		10 => 'Reset',
		11 => 'Yes',
		12 => 'No',
		13 => 'Updating the website will take between', //?? seconds
		14 => 'Articles',
		15 => 'Pages',
		16 => 'Files',
		17 => 'Users',
		18 => 'Navigation',
		19 => 'Modules',
		20 => 'Layout',
		21 => 'Disable access',
		22 => 'Statistics',
		23 => 'Scripts',
		24 => 'My Profile',
		25 => 'Change password',
		26 => 'Permissions',
		27 => 'Now update to',
		28 => 'Updated system',
		29 => 'en',
		30 => 'Are you sure ?',
		31 => 'Style editor',
	//Login system
		100 => 'Login',
		101 => 'Please fill account and password.',
		102 => 'Login',
		103 => 'Account or password is incorrect',
		104 => 'Sign in',
		105 => 'Account',
		106 => 'Password',
		107 => 'Create new account',
		108 => 'Forgotten your password?',
		109 => 'Registration',
		110 => 'E-Mail',
		111 => 'Rewrite only blue numbers from the picture',
		112 => 'Create Account',
		113 => 'By registering you agree that we can record your IP address.',
		114 => 'Please complete all fields',
		115 => 'Account creation was completed successfully.<br>In progress automatic redirection ...',
		116 => 'Account you are trying to create already exists, or specified e-mail address is already used.',
		117 => 'Please enter only allowed characters.',
		118 => 'Rewrote wrong numbers from image.',
		119 => 'Please enter only characters a-z, A-Z, 0-9',
		120 => 'New password',
		121 => 'Repeat new password',
		123 => 'The specified account does not exist',
		124 => 'Recover password',
		125 => 'Passwords do not match',
		126 => 'Good day', //{Username},
		127 => 'Your verification key to restoring password is:',
		128 => 'Your password, you can apply here:',
		129 => 'Recover password is successful, on E-Mail was sent an activation key:',
		130 => 'Key',
		131 => 'The specified activation key does not exist or has expired.',
		132 => 'Recover password was successful.<br>In progress automatic redirection ...',
		133 => 'Logout',
	//Error pages
		200 => 'Access blocked',
		201 => 'Your IP address has been blocked more information read here:',
		202 => 'Your IP address has been blocked for 10 minutes. You have entered a wrong password many times.',
		203 => 'This website is under construction',
		204 => 'Sorry, the website is closed. Please visit this website later.',
	//Webadmin: Home
		300 => 'Administration',
		301 => 'System Information',
		302 => 'Name website',
		303 => 'Version PHP',
		304 => 'Version MySQL',
		305 => 'Version system',
		306 => 'Version core',
		307 => 'Statistics website',
		308 => 'Number of Articles',
		309 => 'Number of pages',
		310 => 'Number of users',
		311 => 'Blocked IPs',
		312 => 'Database size',
		313 => 'Access to my account',
		314 => 'Time',
		315 => 'IP address',
		316 => 'Action',
		317 => 'System log',
		318 => 'Google PageRank',
		319 => 'Visit the site today',
		320 => 'Account',
	//Webadmin: Settings
		500 => 'System Settings',
		501 => 'Language system',
		502 => 'Charset website',
		503 => 'HTML version of the active style',
		504 => 'Style website',
		505 => 'Wysiwyg editor',
		506 => 'Time format',
		507 => 'hours',
		508 => 'Allow registration of new users',
		509 => 'Check current version',
		510 => 'Enable supplement Bladrion - IntelDoc',
		511 => 'Enable supplement STOPspam',
		512 => 'Search Engine Optimization',
		513 => 'Name of website',
		514 => 'Description of website',
		515 => 'Keywords',
		516 => 'Words must be separated by commas',
		517 => 'Index website',
		518 => 'Please complete all fields',
		520 => 'Settings were successfully modified',
		521 => 'Edit Settings',
		522 => 'Security',
		523 => 'Block the login if incorrect password',
		524 => 'Time blocking access',
		525 => 'bad login',
		526 => 'minutes',
		527 => 'Lock web-site for the public',
		528 => 'Enable supplement CloudFlare <a target="_blank" href="http://www.fbi.gov/news/stories/2011/november/malware_110911">Anti-DNS Malware</a>',
	//Webadmin: Change password
		600 => 'Change password',
		601 => 'Old password',
		602 => 'New password',
		603 => 'Allowed characters: a-z, A-Z, 0-9',
		604 => 'Repeat new password',
		605 => 'Fill all passwords',
		606 => 'The new password does not match',
		607 => 'Old password is incorrect',
		608 => 'Password has been successfully changed',
	//Webadmin: Account
		700 => 'My Profile',
		701 => 'E-Mail',
		702 => 'Registered since',
		703 => 'Level account',
		704 => 'Change E-Mail',
		705 => 'Please enter a valid E-Mail',
		706 => 'E-mail was successfully updated',
	//Webadmin: Files
		800 => 'Files',
		801 => 'Upload new files',
		802 => 'File name',
		803 => 'Size',
		804 => 'Uploading was successful.',
		805 => 'No files found.',
		806 => 'Upload a new file:',
		807 => 'Delete file:',
		808 => 'Edit file:',
		809 => 'View',
	//Webadmin: Navigation
		900 => 'Navigation',
		901 => 'Create a new navigation',
		902 => 'Navigation ID:',
		903 => 'Add new link',
		904 => 'New link',
		905 => 'Link name',
		906 => 'The link address',
		907 => 'Link target',
		908 => 'Link name or address is not filled',
		909 => 'Edit link',
		910 => 'Reorder navigation',
		911 => 'Delete link',
		912 => 'Delete menu',
		913 => 'Added new navigation',
		914 => 'Edit link',
		915 => 'Add new link',
		916 => 'Open in active window',
		917 => 'Open in new window or tab',
	//Webadmin: Scripts
		1000 => 'Scripts',
		1001 => 'Name script',
		1002 => 'Launched script:',
	//Webadmin: Perms
		1100 => 'Permissions',
		1101 => 'Edit permissions',
		1102 => 'a higher level',
		1103 => 'Permissions changed',
	//Webadmin: Ban
		1200 => 'Disable access',
		1201 => 'IP address',
		1202 => 'Valid until',
		1203 => 'Lock type',
		1204 => 'Author',
		1205 => 'Message',
		1206 => 'Status',
		1207 => 'Active',
		1208 => 'Not active',
		1209 => 'Forever',
		1210 => 'Login',
		1211 => 'Entire site',
		1212 => 'Unblocked IP',
		1213 => 'Did not match any blocked IP addresses',
		1214 => 'New disable access',
		1215 => 'Days',
		1216 => 'Blocked IP',
		1217 => 'Please fill IP address',
	//Webadmin: Users
		1300 => 'Users',
		1301 => 'Account Name',
		1302 => 'Last login',
		1303 => 'Permissions',
		1304 => 'Registered since',
		1305 => 'Last IP',
		1306 => 'Fill in the correct format',
		1307 => 'Edit user',
		1308 => 'Change user password',
		1309 => 'Create new user',
	//Webadmin: Pages
		1400 => 'Pages',
		1401 => 'Create new',
		1402 => 'Page Name',
		1403 => 'Last updated',
		1404 => 'Author',
		1410 => 'No pages were found',
		1405 => 'Please fill page title and text',
		1406 => 'Create Page:',
		1407 => 'Edit Page:',
		1408 => 'The page successfully modified, <a href="/panel/pages">back to pages</a>',
		1409 => 'Delete page:',
		1411 => 'Editing page',
	//Webadmin: News
		1500 => 'Articles',
		1501 => 'Create new',
		1502 => 'Article title',
		1503 => 'Last updated',
		1504 => 'Author',
		1505 => 'Please fill article title and text',
		1506 => 'Article created:',
		1507 => 'Edited article:',
		1508 => 'Article modified successfully, <a href="/panel/news">back to articles</a>',
		1509 => 'Deleted the article:',
		1510 => 'No articles were found',
		1511 => 'Uncategorized',
		1512 => 'Category',
		1513 => 'Category',
		1514 => 'Create new',
		1515 => 'Category name',
		1516 => 'Delete a category:',
		1517 => 'Please fill name',
		1518 => 'Editing category',
		1519 => 'Category successfully modified, <a href="/panel/news">back to articles</a>',
		1520 => 'Edited category:',
		1521 => 'Added new category:',
		1522 => 'No category were found',
		1523 => 'Editing article',
	//Webadmin: Apps
		1600 => 'Modules',
		1601 => 'Folder module',
		1602 => 'Uninstall module:',
		1603 => 'Installed module:',
	//Webadmin: Formating
		1700 => 'Layout',
		1701 => 'Layout modified',
		1702 => 'Edited layout',
		1703 => 'When editing above mentioned code you need knowledge PHPince tags. For more info see the <a target="_blank" href="http://phpince.com/page/21">tutorial</a>.',
	//Webadmin: Stats
		1800 => 'Statistics',
		1801 => 'Visit rate this day',
		1802 => 'Visit rate this month',
		1803 => 'Visit rate this year',
		1804 => 'Visit rate total',
		1805 => 'Visit rate website',
		1806 => 'Total number of states',
		1807 => 'Websites that link to my website',
		1808 => 'Number of links pointing to my site',
		1809 => 'Visits of robots',
		1810 => 'Name',
		1811 => 'Overall',
		1812 => 'Operating system',
		1813 => 'Internet Browser',
		1814 => 'Statistics locations',
		1815 => 'Websites that link to my website',
		1816 => 'Statistics robots',
		1817 => 'Today',
	//Webadmin: Editor
		1900 => 'Style editor',
		1901 => 'Go back',
		1902 => 'File edited successfully',
	//Ranks
		400 => 'Level 0',
		401 => 'Level 1',
		402 => 'Level 2',
		403 => 'Level 3',
		404 => 'Level 4',
		405 => 'Level 5',
		406 => 'Level 6',
		407 => 'Level 7',
		408 => 'Level 8',
		409 => 'Level 9',
		410 => 'Level 10',
	//Perms
		2002 => 'Show system log',
		2003 => 'Show system information',
		2004 => 'Access to "Settings"',
		2005 => 'Access to "Files"',
		2006 => 'Access to "Navigation"',
		2007 => 'Web access in construction mode',
		2008 => 'Access to "Scripts"',
		2009 => 'Access to "Disable access"',
		2010 => 'Access to "Permissions"',
		2011 => 'Access to "Users"',
		2012 => 'Option to run the system update',
		2013 => 'Access to "Pages"',
		2014 => 'Pages: Possibility to edit all pages',
		2015 => 'Access to "Articles"',
		2016 => 'Articles: Possibility to edit all articles',
		2017 => 'Articles: Possibility to edit categories',
		2018 => 'Access to "Modules"',
		2019 => 'Access to "Layout"',
		2020 => 'Access to "Statistics"',
		2021 => 'Access to "Style editor"',
	//Formatings
		3001 => 'Custom style for articles',
		3002 => 'Custom style for active article (domain.tld/topic/id)',
		3003 => 'Report if the article does not exist',
		3004 => 'Report if not written any article',
		3005 => 'Custom style for page (domain.tld/page/id)',
		3006 => 'Report if the page does not exist',
		3007 => 'Report if the plugin does not exist',
	),
	"Slovensky" => array(
	//Webadmin
		0 => 'Webový panel',
		1 => 'Funguje na',
		2 => 'Jednoduchý redakčný systém',
		3 => 'Web-stránka',
		4 => 'Administrácia',
		5 => 'Nastavenia',
		6 => 'Odhlásiť',
		7 => 'Navigácia',
		8 => 'Môj účet',
		9 => 'Uložiť',
		10 => 'Obnoviť',
		11 => 'Áno',
		12 => 'Nie',
		13 => 'Aktualizácia web-stránky prebehne za', //?? seconds
		14 => 'Články',
		15 => 'Stránky',
		16 => 'Súbory',
		17 => 'Používatelia',
		18 => 'Navigácia',
		19 => 'Moduly',
		20 => 'Rozloženie',
		21 => 'Zakázať prístup',
		22 => 'Štatistiky',
		23 => 'Skripty',
		24 => 'Môj profil',
		25 => 'Zmeniť heslo',
		26 => 'Oprávnenia',
		27 => 'Aktualizovať teraz na',
		28 => 'Aktualizoval systém',
		29 => 'sk',
		30 => 'Ste si istý ?',
		31 => 'Editor štýlov',
	//Login system
		100 => 'Prihlásenie',
		101 => 'Prosím, vyplňte účet a heslo.',
		102 => 'Prihlásenie',
		103 => 'Účet alebo heslo je nesprávne',
		104 => 'Prihlásiť',
		105 => 'Účet',
		106 => 'Heslo',
		107 => 'Vytvoriť nový účet',
		108 => 'Zabudnuté heslo',
		109 => 'Registrácia',
		110 => 'E-Mail',
		111 => 'Opíšte len modré číslice z obrázku',
		112 => 'Vytvoriť účet',
		113 => 'Registráciou súhlasíte, že môžme zapisovať vašu IP adresu.',
		114 => 'Prosím, vyplňte všetky polia',
		115 => 'Vytvorenie účtu prebehlo úspešne.<br>Prebieha automatické presmerovanie ...',
		116 => 'Účet ktorý sa pokúšate vytvoriť už existuje alebo zadaná E-Mailová adresa už je použitá.',
		117 => 'Zadávajte len povolené znaky.',
		118 => 'Opísali ste zle obrázok.',
		119 => 'Zadávajte len znaky a-z, A-Z, 0-9',
		120 => 'Nové heslo',
		121 => 'Zopakujte nové heslo',
		123 => 'Zadaný účet neexistuje',
		124 => 'Obnoviť heslo',
		125 => 'Heslá sa nezhodujú',
		126 => 'Dobrý deň', //{Username},
		127 => 'Váš overovací kľúč k obnoveniu hesla je:',
		128 => 'Svoje heslo si môžte uplatniť tu:',
		129 => 'Obnova hesla prebehla úspešne, na E-Mail bol odoslaný aktivačný kľúč:',
		130 => 'Kľúč',
		131 => 'Zadaný aktivačný kľúč neexistuje alebo uplynula jeho platnosť.',
		132 => 'Obnova hesla prebehla úspešne.<br>Prebieha automatické presmerovanie ...',
		133 => 'Odhlásenie',
	//Error pages
		200 => 'Prístup zablokovaný',
		201 => 'Vaša IP adresa bola zablokovaná, viac informácií čítajte tu:',
		202 => 'Vaša IP adresa bola zablokovaná na {BAN_TIME} minút. Dôvodom tohto zablokovania je veľký počet ne uhádnutia hesla k účtu.',
		203 => 'Na web-stránke sa pracuje',
		204 => 'Ospravedlňujeme sa, ale na webovej stránke sa pracuje. Navštívte prosím túto stránku neskôr.',
	//Webadmin: Home
		300 => 'Administrácia',
		301 => 'Systémové informácie',
		302 => 'Názov stránky',
		303 => 'Verzia PHP',
		304 => 'Verzia MySQL',
		305 => 'Verzia systému',
		306 => 'Verzia jadra',
		307 => 'Štatistika web-stránky',
		308 => 'Počet článkov',
		309 => 'Počet stránok',
		310 => 'Počet užívateľov',
		311 => 'Počet blokovaných IP',
		312 => 'Veľkosť databázy',
		313 => 'Prístup na môj účet',
		314 => 'Čas',
		315 => 'IP adresa',
		316 => 'Akcia',
		317 => 'Systémový záznam',
		318 => 'Google PageRank',
		319 => 'Návštevnosť webu dnes',
		320 => 'Účet',
	//Webadmin: Settings
		500 => 'Systémové nastavenia',
		501 => 'Jazyk systému',
		502 => 'Znaková sada web stránky',
		503 => 'Verzia HTML aktívneho štýlu',
		504 => 'Štýl web stránky',
		505 => 'Wysiwyg editor',
		506 => 'Formát času',
		507 => 'hodín',
		508 => 'Povoliť registráciu nových užívateľov',
		509 => 'Overovať aktuálnu verziu',
		510 => 'Povoliť doplnok Bladrion - IntelDoc',
		511 => 'Povoliť doplnok STOPspam',
		512 => 'Optimalizácia pre vyhľadávače',
		513 => 'Názov web stránky',
		514 => 'Informácie o web stránke',
		515 => 'Kľúčové slová',
		516 => 'Slová oddeľujte čiarkou',
		517 => 'Indexovať web stránku',
		518 => 'Prosím, vyplňte všetky polia',
		520 => 'Nastavenia boli úspešne upravené',
		521 => 'Upravil nastavenia',
		522 => 'Bezpečnosť',
		523 => 'Blokovať prihlásenie pri nesprávnom hesle',
		524 => 'Čas blokovania prístupu',
		525 => 'zlé prihlásenie',
		526 => 'minút',
		527 => 'Uzamknúť web-stránku pre verejnosť',
		528 => 'Povoliť doplnok CloudFlare <a target="_blank" href="http://www.fbi.gov/news/stories/2011/november/malware_110911">Anti-DNS Malware</a>',
	//Webadmin: Change password
		600 => 'Zmena hesla',
		601 => 'Staré heslo',
		602 => 'Nové heslo',
		603 => 'Povolené znaky: a-z, A-Z, 0-9',
		604 => 'Zopakujte nové heslo',
		605 => 'Vyplňte všetky heslá',
		606 => 'Nové heslo sa nezhoduje',
		607 => 'Staré heslo je nesprávne',
		608 => 'Heslo bolo úspešne zmenené',
	//Webadmin: Account
		700 => 'Môj profil',
		701 => 'E-Mail',
		702 => 'Registrovaný od',
		703 => 'Úroveň účtu',
		704 => 'Zmeniť E-Mail',
		705 => 'Zadajte platný E-Mail',
		706 => 'E-Mail bol úspešne aktualizovaný',
	//Webadmin: Files
		800 => 'Súbory',
		801 => 'Nahrať nové súbory',
		802 => 'Názov súboru',
		803 => 'Veľkosť',
		804 => 'Nahranie prebehol úspešne',
		805 => 'Nebol nájdený žiaden súbor.',
		806 => 'Nahral nový súbor:',
		807 => 'Zmazal súbor:',
		808 => 'Upravil súbor:',
		809 => 'Zobraziť',
	//Webadmin: Navigation
		900 => 'Navigácia',
		901 => 'Vytvoriť novú navigáciu',
		902 => 'Navigácia číslo:',
		903 => 'Pridať nový odkaz',
		904 => 'Nový odkaz',
		905 => 'Názov odkazu',
		906 => 'Adresa odkazu',
		907 => 'Cieľ odkazu',
		908 => 'Názov odkazu alebo adresa odkazu nie je vyplnená',
		909 => 'Úprava odkazu',
		910 => 'Upravil poradie navigácie',
		911 => 'Zmazal odkaz',
		912 => 'Zmazal navigáciu',
		913 => 'Pridal novú navigáciu',
		914 => 'Upravil odkaz',
		915 => 'Pridal nový odkaz',
		916 => 'Otvoriť v aktívnom okne',
		917 => 'Otvoriť v novom okne alebo karte',
	//Webadmin: Scripts
		1000 => 'Skripty',
		1001 => 'Názov skriptu',
		1002 => 'Spustil script:',
	//Webadmin: Perms
		1100 => 'Oprávnenia',
		1101 => 'Upravil oprávnenia',
		1102 => 'a vyššia úroveň',
		1103 => 'Oprávnenia zmenené',
	//Webadmin: Ban
		1200 => 'Zakázanie prístupu',
		1201 => 'IP adresa',
		1202 => 'Platné do',
		1203 => 'Typ zablokovania',
		1204 => 'Autor',
		1205 => 'Správa',
		1206 => 'Status',
		1207 => 'Aktívny',
		1208 => 'Neaktívny',
		1209 => 'Navždy',
		1210 => 'Prihlásenie',
		1211 => 'Celý web',
		1212 => 'Odblokoval IP',
		1213 => 'Nebol udelený žiaden zákaz.',
		1214 => 'Nové zablokovanie',
		1215 => 'Počet dní',
		1216 => 'Zablokoval IP',
		1217 => 'Vyplňte IP adresu',
	//Webadmin: Users
		1300 => 'Používatelia',
		1301 => 'Názov účtu',
		1302 => 'Posledné prihlásenie',
		1303 => 'Oprávnenia',
		1304 => 'Registrovaný od',
		1305 => 'Posledná IP',
		1306 => 'Vyplňte polia v správnom formáte',
		1307 => 'Upravil užívateľa',
		1308 => 'Zmenil heslo užívateľovi',
		1309 => 'Vytvoriť užívateľa',
	//Webadmin: Pages
		1400 => 'Stránky',
		1401 => 'Vytvoriť novú',
		1402 => 'Názov stránky',
		1403 => 'Posledná úprava',
		1404 => 'Autor',
		1410 => 'Neboli vytvorené žiadne stránky.',
		1405 => 'Vyplňte názov stránky a text',
		1406 => 'Vytvoril stránku:',
		1407 => 'Upravil stránku:',
		1408 => 'Stránka úspešne upravená, <a href="/panel/pages">späť na stránky</a>',
		1409 => 'Zmazal stránku:',
		1411 => 'Úprava stránky',
	//Webadmin: News
		1500 => 'Články',
		1501 => 'Vytvoriť nový',
		1502 => 'Názov článku',
		1503 => 'Posledná úprava',
		1504 => 'Autor',
		1505 => 'Vyplňte názov článku a text',
		1506 => 'Vytvoril článok:',
		1507 => 'Upravil článok:',
		1508 => 'Článok úspešne upravený, <a href="/panel/news">späť na články</a>',
		1509 => 'Zmazal článok:',
		1510 => 'Neboli vytvorené žiadne články.',
		1511 => 'Nezaradené',
		1512 => 'Kategória',
		1513 => 'Kategórie',
		1514 => 'Vytvoriť novú',
		1515 => 'Názov kategórie',
		1516 => 'Zmazal kategóriu:',
		1517 => 'Vyplňte názov',
		1518 => 'Úprava kategórie',
		1519 => 'Kategória úspešne upravená, <a href="/panel/news">späť na články</a>',
		1520 => 'Upravil kategóriu:',
		1521 => 'Pridal novú kategóriu:',
		1522 => 'Neboli vytvorené žiadne kategórie',
		1523 => 'Úprava článku',
	//Webadmin: Apps
		1600 => 'Moduly',
		1601 => 'Priečinok modulu',
		1602 => 'Odinštaloval modul:',
		1603 => 'Nainštaloval modul:',
	//Webadmin: Formating
		1700 => 'Rozloženie',
		1701 => 'Rozloženie upravené',
		1702 => 'Upravil rozloženie',
		1703 => 'Pri úprave hore uvedeného kódu potrebujete znalosť PHPince značiek. Pre viac info si prezrite <a target="_blank" href="http://phpince.com/page/21">tutorial</a>.',
	//Webadmin: Stats
		1800 => 'Štatistiky',
		1801 => 'Návštevnosť tento deň',
		1802 => 'Návštevnosť tento mesiac',
		1803 => 'Návštevnosť tento rok',
		1804 => 'Návštevnosť celkovo',
		1805 => 'Návštevnosť web-stránky',
		1806 => 'Celkový počet štátov',
		1807 => 'Stránky odkazujúce na môj web',
		1808 => 'Počet odkazov na môj web',
		1809 => 'Počet návštev robotov',
		1810 => 'Názov',
		1811 => 'Celkovo',
		1812 => 'Operačný systém',
		1813 => 'Internetový prehliadač',
		1814 => 'Štatistika lokácie',
		1815 => 'Stránky odkazujúce na môj web',
		1816 => 'Štatistika robotov',
		1817 => 'Dnes',
	//Webadmin: Editor
		1900 => 'Editor štýlov',
		1901 => 'Vrátiť sa späť',
		1902 => 'Súbor úspešne upravený',
	//Ranks
		400 => 'Úroveň 0',
		401 => 'Úroveň 1',
		402 => 'Úroveň 2',
		403 => 'Úroveň 3',
		404 => 'Úroveň 4',
		405 => 'Úroveň 5',
		406 => 'Úroveň 6',
		407 => 'Úroveň 7',
		408 => 'Úroveň 8',
		409 => 'Úroveň 9',
		410 => 'Úroveň 10',
	//Perms
		2002 => 'Zobrazovať systémový log',
		2003 => 'Zobrazovať systémové informácie',
		2004 => 'Prístup k položke "Nastavenia"',
		2005 => 'Prístup k položke "Súbory"',
		2006 => 'Prístup k položke "Navigácia"',
		2007 => 'Prístup na web v construction modu',
		2008 => 'Prístup k položke "Skripty"',
		2009 => 'Prístup k položke "Zakázať prístup"',
		2010 => 'Prístup k položke "Oprávnenia"',
		2011 => 'Prístup k položke "Používatelia"',
		2012 => 'Možnosť spustiť systémovú aktualizáciu',
		2013 => 'Prístup k položke "Stránky"',
		2014 => 'Stránky: Možnosť upravovať všetky stránky',
		2015 => 'Prístup k položke "Články"',
		2016 => 'Články: Možnosť upravovať všetky články',
		2017 => 'Články: Možnosť pridávať/upravovať kategórie',
		2018 => 'Prístup k položke "Moduly"',
		2019 => 'Prístup k položke "Rozloženie"',
		2020 => 'Prístup k položke "Štatistiky"',
		2021 => 'Prístup k položke "Editor štýlov"',
	//Formatings
		3001 => 'Zobrazenie článkov',
		3002 => 'Zobrazenie jedného článku',
		3003 => 'Správa ak článok neexistuje',
		3004 => 'Správa ak nie je vypísaný žiaden článok',
		3005 => 'Zobrazenie stránky',
		3006 => 'Správa ak stránka neexistuje',
		3007 => 'Správa ak modul neexistuje',
	),
	"Česky" => array(
	//Webadmin
		0 => 'Webový panel',
		1 => 'Funguje na',
		2 => 'Jednoduchý redakční systém',
		3 => 'Web-stránka',
		4 => 'Administrace',
		5 => 'Nastavení',
		6 => 'Odhlásit se',
		7 => 'Navigace',
		8 => 'Můj účet',
		9 => 'Uložit',
		10 => 'Obnovit',
		11 => 'Ano',
		12 => 'Ne',
		13 => 'Aktualizace web-stránky proběhne za', //?? seconds
		14 => 'Články',
		15 => 'Stránky',
		16 => 'Soubory',
		17 => 'Uživatelé',
		18 => 'Navigace',
		19 => 'Moduly',
		20 => 'Rozložení',
		21 => 'Zakázat přístup',
		22 => 'Statistiky',
		23 => 'Skripty',
		24 => 'Můj profil',
		25 => 'Změnit heslo',
		26 => 'Oprávnění',
		27 => 'Aktualizovat teď na',
		28 => 'Aktualizoval systém',
		29 => 'cs',
		30 => 'Jste si jistí ?',
		31 => 'Editor stylů',
	//Login system
		100 => 'Přihlášení',
		101 => 'Prosím, vyplňte účet a heslo.',
		102 => 'Přihlášení',
		103 => 'Účet nebo heslo je nesprávné',
		104 => 'Přihlásit',
		105 => 'Účet',
		106 => 'Heslo',
		107 => 'Vytvořit nový účet',
		108 => 'Zapomenuté heslo',
		109 => 'Registrace',
		110 => 'E-Mail',
		111 => 'Opíšte jen modré číslice z obrázku',
		112 => 'Vytvořit účet',
		113 => 'Registrací souhlasíte, že můžeme zapisovat vaší IP adresu.',
		114 => 'Prosím, vyplňte všechna pole',
		115 => 'Vytvoření účtu proběhlo úspěšně.<br>Proběhne automatické přesměrování ...',
		116 => 'Účet který se pokoušíte vytvořit, už existuje nebo zadaná E-Mailová adresa už je použitá.',
		117 => 'Zadávejte jen povolené znaky.',
		118 => 'Opsali jste špatně obrázek.',
		119 => 'Zadávejte jen znaky a-z, A-Z, 0-9',
		120 => 'Nové heslo',
		121 => 'Zopakujte nové heslo',
		123 => 'Zadaný účet neexistuje',
		124 => 'Obnovit heslo',
		125 => 'Hesla se nezhodují',
		126 => 'Dobrý den', //{Username},
		127 => 'Váš ověřovací klíč k obnovení hesla je:',
		128 => 'Své heslo si můžete uplatnit zde:',
		129 => 'Obnova hesla proběhla úspešně, na E-Mail byl odeslaný aktivační klícč:',
		130 => 'Klíč',
		131 => 'Zadaný aktivační klíč neexistuje nebo vypršela jeho platnost.',
		132 => 'Obnova hesla proběhla úspešně.<br>Proběhlo automatické přesměrování ...',
		133 => 'Odhlášení',
	//Error pages
		200 => 'Přístup zablokován',
		201 => 'Vaše IP adresa byla zablokována, pro více informací čtěte zde:',
		202 => 'Vaše IP adresa byla zablokována na {BAN_TIME} minut. Důvodem tohoto zablokování je velký počet neuhodnutí hesla k účtu.',
		203 => 'Na web-stránce se pracuje',
		204 => 'Omlouváme se, ale na webové stránce se pracuje. Navštivte prosím tuto stránku později.',
	//Webadmin: Home
		300 => 'Administrace',
		301 => 'Systémové informace',
		302 => 'Název stránky',
		303 => 'Verze PHP',
		304 => 'Verze MySQL',
		305 => 'Verze systému',
		306 => 'Verze jadra',
		307 => 'Statistika web-stránky',
		308 => 'Počet článků',
		309 => 'Počet stránek',
		310 => 'Počet uživatelů',
		311 => 'Počet blokovaných IP',
		312 => 'Velikost databáze',
		313 => 'Přístup na můj účet',
		314 => 'Čas',
		315 => 'IP adresa',
		316 => 'Akce',
		317 => 'Systémový záznam',
		318 => 'Google PageRank',
		319 => 'Návštěvnost webu dnes',
		320 => 'Účet',
	//Webadmin: Settings
		500 => 'Systémové nastavení',
		501 => 'Jazyk systému',
		502 => 'Znaková sada web-stránky',
		503 => 'Verze HTML aktivního stylu',
		504 => 'Styl web-stránky',
		505 => 'Wysiwyg editor',
		506 => 'Formát času',
		507 => 'hodin',
		508 => 'Povolit registraci nových uživatelů',
		509 => 'Ověřovat aktuální verzi',
		510 => 'Povolit doplněk Bladrion - IntelDoc',
		511 => 'Povolit doplněk STOPspam',
		512 => 'Optimalizace pro vyhledávače',
		513 => 'Název web-stránky',
		514 => 'Informace o web-stránce',
		515 => 'Klíčové slova',
		516 => 'Slova oddělujte čárkou',
		517 => 'Indexovat web-stránku',
		518 => 'Prosím, vyplňte všechny pole',
		520 => 'Nastavené byli úspešně upravené',
		521 => 'Upravil nastavení',
		522 => 'Bezpečnost',
		523 => 'Blokovat přihlášení při nesprávném hesle',
		524 => 'Čas blokováním přístupu',
		525 => 'špatné přihlášení',
		526 => 'minut',
		527 => 'Uzamknout web-stránku pro veřejnost',
		528 => 'Povolit doplněk CloudFlare <a target="_blank" href="http://www.fbi.gov/news/stories/2011/november/malware_110911">Anti-DNS Malware</a>',
	//Webadmin: Change password
		600 => 'Změna hesla',
		601 => 'Staré heslo',
		602 => 'Nové heslo',
		603 => 'Povolené znaky: a-z, A-Z, 0-9',
		604 => 'Zopakujte nové heslo',
		605 => 'Vyplňte všechny hesla',
		606 => 'Nové heslo se neshoduje',
		607 => 'Staré heslo je nesprávně',
		608 => 'Heslo bylo úspešně změněné',
	//Webadmin: Account
		700 => 'Můj profil',
		701 => 'E-Mail',
		702 => 'Registrovaný od',
		703 => 'Úroveň účtu',
		704 => 'Změnit E-Mail',
		705 => 'Zadajte platný E-Mail',
		706 => 'E-Mail byl úspešně aktualizován',
	//Webadmin: Files
		800 => 'Soubory',
		801 => 'Nahrát nové soubory',
		802 => 'Název souboru',
		803 => 'Velikost',
		804 => 'Nahrání proběhlo úspěšně',
		805 => 'Nebyl nalezen žádný soubor.',
		806 => 'Nahrál nový soubor:',
		807 => 'Smazal soubor:',
		808 => 'Upravil soubor:',
		809 => 'Zobrazit',
	//Webadmin: Navigation
		900 => 'Navigace',
		901 => 'vytvořit novou navigaci',
		902 => 'Navigace číslo:',
		903 => 'Přidat nový odkaz',
		904 => 'Nový odkaz',
		905 => 'Název odkazu',
		906 => 'Adresa odkazu',
		907 => 'Cíl odkazu',
		908 => 'Název odkazu nebo adresa odkazu není vyplněná',
		909 => 'Úprava odkazu',
		910 => 'Upravil pořadí navigace',
		911 => 'Smazal odkaz',
		912 => 'Smazal navigaci',
		913 => 'Přidal novou navigaci',
		914 => 'Upravil odkaz',
		915 => 'Přidal nový odkaz',
		916 => 'Otevřít v aktivním okně',
		917 => 'Otevřít v novém okně nebo karťe',
	//Webadmin: Scripts
		1000 => 'Skripty',
		1001 => 'Název skriptu',
		1002 => 'Spustil script:',
	//Webadmin: Perms
		1100 => 'Oprávnění',
		1101 => 'Upravil oprávnění',
		1102 => 'a vyšší úroveň',
		1103 => 'oprávnění změněny',
	//Webadmin: Ban
		1200 => 'Zakázání přístupu',
		1201 => 'IP adresa',
		1202 => 'Platí do',
		1203 => 'Typ zablokování',
		1204 => 'Autor',
		1205 => 'Správa',
		1206 => 'Status',
		1207 => 'Aktivní',
		1208 => 'Neaktivní',
		1209 => 'Navždy',
		1210 => 'Přihlášení',
		1211 => 'Celý web',
		1212 => 'Odblokoval IP',
		1213 => 'Nebyl udělen žádný zákaz.',
		1214 => 'Nové zablokování',
		1215 => 'Počet dní',
		1216 => 'Zablokoval IP',
		1217 => 'Vyplňte IP adresu',
	//Webadmin: Users
		1300 => 'Uživatelé',
		1301 => 'Název účtu',
		1302 => 'Poslední příhlášení',
		1303 => 'Oprávnění',
		1304 => 'Registrovaný od',
		1305 => 'Poslední IP',
		1306 => 'Vyplňte pole ve správném formáťe',
		1307 => 'Upravil uživatelé',
		1308 => 'Změnil heslo uživateli',
		1309 => 'Vytvořit uživatele',
	//Webadmin: Pages
		1400 => 'Stránky',
		1401 => 'Vytvořit novou',
		1402 => 'Název stránky',
		1403 => 'Poslední úprava',
		1404 => 'Autor',
		1410 => 'Nebyly vytvořeny žádné stránky.',
		1405 => 'Vyplňte název stránky a text',
		1406 => 'Vytvořil stránku:',
		1407 => 'Upravil stránku:',
		1408 => 'Stránka úspěšně upravená, <a href="/panel/pages">zpět na stránky</a>',
		1409 => 'Smazal stránku:',
		1411 => 'Úprava stránky',
	//Webadmin: News
		1500 => 'Články',
		1501 => 'Vytvořit nový',
		1502 => 'Název článku',
		1503 => 'Poslední úprava',
		1504 => 'Autor',
		1505 => 'Vyplňte název článku a text',
		1506 => 'Vytvořil článek:',
		1507 => 'Upravil článek:',
		1508 => 'Článek úspešně upravený, <a href="/panel/news">zpět na články</a>',
		1509 => 'Smazal článek:',
		1510 => 'Nebyli vytvořené žádné články.',
		1511 => 'Nezařazené',
		1512 => 'Kategorie',
		1513 => 'Kategorie',
		1514 => 'Vytvořit novou',
		1515 => 'Název kategorie',
		1516 => 'Smazal kategorii:',
		1517 => 'Vyplňte název',
		1518 => 'Úprava kategorie',
		1519 => 'Kategorie byla úspěšně upravená, <a href="/panel/news">zpět na články</a>',
		1520 => 'Upravil kategorii:',
		1521 => 'Přidal novou kategorii:',
		1522 => 'Nebyli vytvořené žádné kategorie',
		1523 => 'Úprava článku',
	//Webadmin: Apps
		1600 => 'Moduly',
		1601 => 'Složka modulů',
		1602 => 'Odinstalovat modul:',
		1603 => 'Nainstalovat modul:',
	//Webadmin: Formating
		1700 => 'Rozložení',
		1701 => 'Rozložení upravené',
		1702 => 'Upravil rozložení',
		1703 => 'Při úpravě výše uvedeného kódu potřebujete znalost PHPince značek. Pro více info si prohlédněte <a target="_blank" href="http://phpince.com/page/21">návod</a>.',
	//Webadmin: Stats
		1800 => 'Statistiky',
		1801 => 'Návštěvnost tento den',
		1802 => 'Návštěvnost tento měsíc',
		1803 => 'Návštěvnost tento rok',
		1804 => 'Návštěvnost celkem',
		1805 => 'Návštěvnost web-stránky',
		1806 => 'Celkový počet států',
		1807 => 'Stránky odkazující na můj web',
		1808 => 'Počet odkazů na můj web',
		1809 => 'Počet návštev robotů',
		1810 => 'Název',
		1811 => 'Celkem',
		1812 => 'Operační systém',
		1813 => 'Internetový prohlížeč',
		1814 => 'Statistika lokace',
		1815 => 'Stránky odkazující na můj web',
		1816 => 'Statistika robotů',
		1817 => 'Dnes',
	//Webadmin: Editor
		1900 => 'Editor stylů',
		1901 => 'Vráťit se zpět',
		1902 => 'Soubor úspěšně upravený',
	//Ranks
		400 => 'Úroveň 0',
		401 => 'Úroveň 1',
		402 => 'Úroveň 2',
		403 => 'Úroveň 3',
		404 => 'Úroveň 4',
		405 => 'Úroveň 5',
		406 => 'Úroveň 6',
		407 => 'Úroveň 7',
		408 => 'Úroveň 8',
		409 => 'Úroveň 9',
		410 => 'Úroveň 10',
	//Perms
		2002 => 'Zobrazovat systémový log',
		2003 => 'Zobrazovat systémové informace',
		2004 => 'Přístup k položce "Nastavení"',
		2005 => 'Přístup k položce "Soubory"',
		2006 => 'Přístup k položce "Navigace"',
		2007 => 'Přístup na web v construction módu',
		2008 => 'Přístup k položce "Skripty"',
		2009 => 'Přístup k položce "Zakázat přístup"',
		2010 => 'Přístup k položce "Oprávnění"',
		2011 => 'Přístup k položce "Uživatelé"',
		2012 => 'Možnost spusťit systémovou aktualizaci',
		2013 => 'Přístup k položce "Stránky"',
		2014 => 'Stránky: Možnost upravovat všechny stránky',
		2015 => 'Přístup k položce "Články"',
		2016 => 'Články: Možnost upravovat všechny články',
		2017 => 'Články: Možnost přidávat/upravovat kategorie',
		2018 => 'Přístup k položce "Moduly"',
		2019 => 'Přístup k položce "Rozložení"',
		2020 => 'Přístup k položce "Statistiky"',
		2021 => 'Přístup k položce "Editor stylů"',
	//Formatings
		3001 => 'Zobrazení článků',
		3002 => 'Zobrazení jednoho článku',
		3003 => 'Správa pokud článek neexistuje',
		3004 => 'Správa pokud není vypsaný žádný článek',
		3005 => 'Zobrazení stránky',
		3006 => 'Správa pokud stránka neexistuje',
		3007 => 'Správa pokud modul neexistuje',
	)
);
?>