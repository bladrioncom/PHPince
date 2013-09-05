<?php
/*---------------------------------------------------------------------+
| PHPince Website
| Copyright (c) 2011 - 2013 Dominik Hulla
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
ob_start();
require "../phpince-panel/phpince-data/core/bladrion.unisc.php";
require "../phpince-panel/phpince-data/config/phpince.version.php";
if((file_exists("lock.phpince"))&&(!($_GET["step"]=="lock"))) {
	bl_redirect("index.php?step=lock");
}
echo "<!DOCTYPE HTML>
<html>
<head>
<meta charset=\"utf-8\">
<title>PHPince Website - Install</title>
<meta name=\"robots\" content=\"noindex, nofollow\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"/phpince-panel/phpince-data/core/tems/phpince-install/template.css\">
<link rel=\"shortcut icon\" href=\"http://phpince.com/favicon.ico\">
</head>
<body>
<div id=\"wrapper\">
<header>
<div id=\"logo\"></div>
<div id=\"version\">Installer <span>".$PHPINCE_VERSION["SYSTEM"]."</span></div>
</header>";
switch ($_GET["step"]){
	case "lock":
		$title_id = 0;
		$title_name = "Locked";
	break;
	case 1:
	case 0:
		$title_id = 1;
		$title_name = "License";
	break;
	case 2:
		$title_id = 2;
		$title_name = "Check system";
	break;
	case 3:
		$title_id = 3;
		$title_name = "Connect";
	break;
	case 4:
		$title_id = 4;
		$title_name = "Completed";
	break;
}
echo "<h1>Step ".$title_id." <span>&gt; <span>".$title_name."</span></span></h1><section>";
switch ($title_id){
	case 1:
		setcookie("PHPINCE_INSTALL", "hash883", time()+3600, "/");
		echo "<div style=\"width:96%;height:450px;overflow:auto; padding:0 2% 0 2%;margin:0 0 20px 0;\"><h3>GNU GENERAL PUBLIC LICENSE</h3><p>Version 3, 29 June 2007</p><p>Copyright &copy; 2007 Free Software Foundation, Inc. &lt;<a href=\"http://fsf.org/\">http://fsf.org/</a>&gt;<br>Everyone is permitted to copy and distribute verbatim copies of this license document, but changing it is not allowed.</p><h3><a name=\"preamble\"></a>Preamble</h3><p>The GNU General Public License is a free, copyleft license for software and other kinds of works.</p><p>The licenses for most software and other practical works are designed   to take away your freedom to share and change the works. By contrast,   the GNU General Public License is intended to guarantee your freedom to   share and change all versions of a program--to make sure it remains free   software for all its users. We, the Free Software Foundation, use the   GNU General Public License for most of our software; it applies also to   any other work released this way by its authors. You can apply it to   your programs, too.</p><p>When we speak of free software, we are referring to freedom, not   price. Our General Public Licenses are designed to make sure that you   have the freedom to distribute copies of free software (and charge for   them if you wish), that you receive source code or can get it if you   want it, that you can change the software or use pieces of it in new   free programs, and that you know you can do these things.</p><p>To protect your rights, we need to prevent others from denying you   these rights or asking you to surrender the rights. Therefore, you have   certain responsibilities if you distribute copies of the software, or if   you modify it: responsibilities to respect the freedom of others.</p><p>For example, if you distribute copies of such a program, whether   gratis or for a fee, you must pass on to the recipients the same   freedoms that you received. You must make sure that they, too, receive   or can get the source code. And you must show them these terms so they   know their rights.</p><p>Developers that use the GNU GPL protect your rights with two steps:   (1) assert copyright on the software, and (2) offer you this License   giving you legal permission to copy, distribute and/or modify it.</p><p>For the developers&rsquo; and authors&rsquo; protection, the GPL clearly explains   that there is no warranty for this free software. For both users&rsquo; and   authors&rsquo; sake, the GPL requires that modified versions be marked as   changed, so that their problems will not be attributed erroneously to   authors of previous versions.</p><p>Some devices are designed to deny users access to install or run   modified versions of the software inside them, although the manufacturer   can do so. This is fundamentally incompatible with the aim of   protecting users&rsquo; freedom to change the software. The systematic pattern   of such abuse occurs in the area of products for individuals to use,   which is precisely where it is most unacceptable. Therefore, we have   designed this version of the GPL to prohibit the practice for those   products. If such problems arise substantially in other domains, we   stand ready to extend this provision to those domains in future versions   of the GPL, as needed to protect the freedom of users.</p><p>Finally, every program is threatened constantly by software patents.   States should not allow patents to restrict development and use of   software on general-purpose computers, but in those that do, we wish to   avoid the special danger that patents applied to a free program could   make it effectively proprietary. To prevent this, the GPL assures that   patents cannot be used to render the program non-free.</p><p>The precise terms and conditions for copying, distribution and modification follow.</p><h3><a name=\"terms\"></a>TERMS AND CONDITIONS</h3><h4><a name=\"section0\"></a>0. Definitions.</h4><p>&ldquo;This License&rdquo; refers to version 3 of the GNU General Public License.</p><p>&ldquo;Copyright&rdquo; also means copyright-like laws that apply to other kinds of works, such as semiconductor masks.</p><p>&ldquo;The Program&rdquo; refers to any copyrightable work licensed under this   License. Each licensee is addressed as &ldquo;you&rdquo;. &ldquo;Licensees&rdquo; and   &ldquo;recipients&rdquo; may be individuals or organizations.</p><p>To &ldquo;modify&rdquo; a work means to copy from or adapt all or part of the   work in a fashion requiring copyright permission, other than the making   of an exact copy. The resulting work is called a &ldquo;modified version&rdquo; of   the earlier work or a work &ldquo;based on&rdquo; the earlier work.</p><p>A &ldquo;covered work&rdquo; means either the unmodified Program or a work based on the Program.</p><p>To &ldquo;propagate&rdquo; a work means to do anything with it that, without   permission, would make you directly or secondarily liable for   infringement under applicable copyright law, except executing it on a   computer or modifying a private copy. Propagation includes copying,   distribution (with or without modification), making available to the   public, and in some countries other activities as well.</p><p>To &ldquo;convey&rdquo; a work means any kind of propagation that enables other   parties to make or receive copies. Mere interaction with a user through a   computer network, with no transfer of a copy, is not conveying.</p><p>An interactive user interface displays &ldquo;Appropriate Legal Notices&rdquo; to   the extent that it includes a convenient and prominently visible   feature that (1) displays an appropriate copyright notice, and (2) tells   the user that there is no warranty for the work (except to the extent   that warranties are provided), that licensees may convey the work under   this License, and how to view a copy of this License. If the interface   presents a list of user commands or options, such as a menu, a prominent   item in the list meets this criterion.</p><h4><a name=\"section1\"></a>1. Source Code.</h4><p>The &ldquo;source code&rdquo; for a work means the preferred form of the work for   making modifications to it. &ldquo;Object code&rdquo; means any non-source form of a   work.</p><p>A &ldquo;Standard Interface&rdquo; means an interface that either is an official   standard defined by a recognized standards body, or, in the case of   interfaces specified for a particular programming language, one that is   widely used among developers working in that language.</p><p>The &ldquo;System Libraries&rdquo; of an executable work include anything, other   than the work as a whole, that (a) is included in the normal form of   packaging a Major Component, but which is not part of that Major   Component, and (b) serves only to enable use of the work with that Major   Component, or to implement a Standard Interface for which an   implementation is available to the public in source code form. A &ldquo;Major   Component&rdquo;, in this context, means a major essential component (kernel,   window system, and so on) of the specific operating system (if any) on   which the executable work runs, or a compiler used to produce the work,   or an object code interpreter used to run it.</p><p>The &ldquo;Corresponding Source&rdquo; for a work in object code form means all   the source code needed to generate, install, and (for an executable   work) run the object code and to modify the work, including scripts to   control those activities. However, it does not include the work&rsquo;s System   Libraries, or general-purpose tools or generally available free   programs which are used unmodified in performing those activities but   which are not part of the work. For example, Corresponding Source   includes interface definition files associated with source files for the   work, and the source code for shared libraries and dynamically linked   subprograms that the work is specifically designed to require, such as   by intimate data communication or control flow between those subprograms   and other parts of the work.</p><p>The Corresponding Source need not include anything that users can   regenerate automatically from other parts of the Corresponding Source.</p><p>The Corresponding Source for a work in source code form is that same work.</p><h4><a name=\"section2\"></a>2. Basic Permissions.</h4><p>All rights granted under this License are granted for the term of   copyright on the Program, and are irrevocable provided the stated   conditions are met. This License explicitly affirms your unlimited   permission to run the unmodified Program. The output from running a   covered work is covered by this License only if the output, given its   content, constitutes a covered work. This License acknowledges your   rights of fair use or other equivalent, as provided by copyright law.</p><p>You may make, run and propagate covered works that you do not convey,   without conditions so long as your license otherwise remains in force.   You may convey covered works to others for the sole purpose of having   them make modifications exclusively for you, or provide you with   facilities for running those works, provided that you comply with the   terms of this License in conveying all material for which you do not   control copyright. Those thus making or running the covered works for   you must do so exclusively on your behalf, under your direction and   control, on terms that prohibit them from making any copies of your   copyrighted material outside their relationship with you.</p><p>Conveying under any other circumstances is permitted solely under the   conditions stated below. Sublicensing is not allowed; section 10 makes   it unnecessary.</p><h4><a name=\"section3\"></a>3. Protecting Users&rsquo; Legal Rights From Anti-Circumvention Law.</h4><p>No covered work shall be deemed part of an effective technological   measure under any applicable law fulfilling obligations under article 11   of the WIPO copyright treaty adopted on 20 December 1996, or similar   laws prohibiting or restricting circumvention of such measures.</p><p>When you convey a covered work, you waive any legal power to forbid   circumvention of technological measures to the extent such circumvention   is effected by exercising rights under this License with respect to the   covered work, and you disclaim any intention to limit operation or   modification of the work as a means of enforcing, against the work&rsquo;s   users, your or third parties&rsquo; legal rights to forbid circumvention of   technological measures.</p><h4><a name=\"section4\"></a>4. Conveying Verbatim Copies.</h4><p>You may convey verbatim copies of the Program&rsquo;s source code as you   receive it, in any medium, provided that you conspicuously and   appropriately publish on each copy an appropriate copyright notice; keep   intact all notices stating that this License and any non-permissive   terms added in accord with section 7 apply to the code; keep intact all   notices of the absence of any warranty; and give all recipients a copy   of this License along with the Program.</p><p>You may charge any price or no price for each copy that you convey, and you may offer support or warranty protection for a fee.</p><h4><a name=\"section5\"></a>5. Conveying Modified Source Versions.</h4><p>You may convey a work based on the Program, or the modifications to   produce it from the Program, in the form of source code under the terms   of section 4, provided that you also meet all of these conditions:</p><ul><li>a) The work must carry prominent notices stating that you modified it, and giving a relevant date.</li><li>b) The work must carry prominent notices stating that it is   released under this License and any conditions added under section 7.   This requirement modifies the requirement in section 4 to &ldquo;keep intact   all notices&rdquo;.</li><li>c) You must license the entire work, as a whole, under this License   to anyone who comes into possession of a copy. This License will   therefore apply, along with any applicable section 7 additional terms,   to the whole of the work, and all its parts, regardless of how they are   packaged. This License gives no permission to license the work in any   other way, but it does not invalidate such permission if you have   separately received it.</li><li>d) If the work has interactive user interfaces, each must display   Appropriate Legal Notices; however, if the Program has interactive   interfaces that do not display Appropriate Legal Notices, your work need   not make them do so.</li></ul><p>A compilation of a covered work with other separate and independent   works, which are not by their nature extensions of the covered work, and   which are not combined with it such as to form a larger program, in or   on a volume of a storage or distribution medium, is called an   &ldquo;aggregate&rdquo; if the compilation and its resulting copyright are not used   to limit the access or legal rights of the compilation&rsquo;s users beyond   what the individual works permit. Inclusion of a covered work in an   aggregate does not cause this License to apply to the other parts of the   aggregate.</p><h4><a name=\"section6\"></a>6. Conveying Non-Source Forms.</h4><p>You may convey a covered work in object code form under the terms of   sections 4 and 5, provided that you also convey the machine-readable   Corresponding Source under the terms of this License, in one of these   ways:</p><ul><li>a) Convey the object code in, or embodied in, a physical product   (including a physical distribution medium), accompanied by the   Corresponding Source fixed on a durable physical medium customarily used   for software interchange.</li><li>b) Convey the object code in, or embodied in, a physical product   (including a physical distribution medium), accompanied by a written   offer, valid for at least three years and valid for as long as you offer   spare parts or customer support for that product model, to give anyone   who possesses the object code either (1) a copy of the Corresponding   Source for all the software in the product that is covered by this   License, on a durable physical medium customarily used for software   interchange, for a price no more than your reasonable cost of physically   performing this conveying of source, or (2) access to copy the   Corresponding Source from a network server at no charge.</li><li>c) Convey individual copies of the object code with a copy of the   written offer to provide the Corresponding Source. This alternative is   allowed only occasionally and noncommercially, and only if you received   the object code with such an offer, in accord with subsection 6b.</li><li>d) Convey the object code by offering access from a designated   place (gratis or for a charge), and offer equivalent access to the   Corresponding Source in the same way through the same place at no   further charge. You need not require recipients to copy the   Corresponding Source along with the object code. If the place to copy   the object code is a network server, the Corresponding Source may be on a   different server (operated by you or a third party) that supports   equivalent copying facilities, provided you maintain clear directions   next to the object code saying where to find the Corresponding Source.   Regardless of what server hosts the Corresponding Source, you remain   obligated to ensure that it is available for as long as needed to   satisfy these requirements.</li><li>e) Convey the object code using peer-to-peer transmission, provided   you inform other peers where the object code and Corresponding Source   of the work are being offered to the general public at no charge under   subsection 6d.</li></ul><p>A separable portion of the object code, whose source code is excluded   from the Corresponding Source as a System Library, need not be included   in conveying the object code work.</p><p>A &ldquo;User Product&rdquo; is either (1) a &ldquo;consumer product&rdquo;, which means any   tangible personal property which is normally used for personal, family,   or household purposes, or (2) anything designed or sold for   incorporation into a dwelling. In determining whether a product is a   consumer product, doubtful cases shall be resolved in favor of coverage.   For a particular product received by a particular user, &ldquo;normally used&rdquo;   refers to a typical or common use of that class of product, regardless   of the status of the particular user or of the way in which the   particular user actually uses, or expects or is expected to use, the   product. A product is a consumer product regardless of whether the   product has substantial commercial, industrial or non-consumer uses,   unless such uses represent the only significant mode of use of the   product.</p><p>&ldquo;Installation Information&rdquo; for a User Product means any methods,   procedures, authorization keys, or other information required to install   and execute modified versions of a covered work in that User Product   from a modified version of its Corresponding Source. The information   must suffice to ensure that the continued functioning of the modified   object code is in no case prevented or interfered with solely because   modification has been made.</p><p>If you convey an object code work under this section in, or with, or   specifically for use in, a User Product, and the conveying occurs as   part of a transaction in which the right of possession and use of the   User Product is transferred to the recipient in perpetuity or for a   fixed term (regardless of how the transaction is characterized), the   Corresponding Source conveyed under this section must be accompanied by   the Installation Information. But this requirement does not apply if   neither you nor any third party retains the ability to install modified   object code on the User Product (for example, the work has been   installed in ROM).</p><p>The requirement to provide Installation Information does not include a   requirement to continue to provide support service, warranty, or   updates for a work that has been modified or installed by the recipient,   or for the User Product in which it has been modified or installed.   Access to a network may be denied when the modification itself   materially and adversely affects the operation of the network or   violates the rules and protocols for communication across the network.</p><p>Corresponding Source conveyed, and Installation Information provided,   in accord with this section must be in a format that is publicly   documented (and with an implementation available to the public in source   code form), and must require no special password or key for unpacking,   reading or copying.</p><h4><a name=\"section7\"></a>7. Additional Terms.</h4><p>&ldquo;Additional permissions&rdquo; are terms that supplement the terms of this   License by making exceptions from one or more of its conditions.   Additional permissions that are applicable to the entire Program shall   be treated as though they were included in this License, to the extent   that they are valid under applicable law. If additional permissions   apply only to part of the Program, that part may be used separately   under those permissions, but the entire Program remains governed by this   License without regard to the additional permissions.</p><p>When you convey a copy of a covered work, you may at your option   remove any additional permissions from that copy, or from any part of   it. (Additional permissions may be written to require their own removal   in certain cases when you modify the work.) You may place additional   permissions on material, added by you to a covered work, for which you   have or can give appropriate copyright permission.</p><p>Notwithstanding any other provision of this License, for material you   add to a covered work, you may (if authorized by the copyright holders   of that material) supplement the terms of this License with terms:</p><ul><li>a) Disclaiming warranty or limiting liability differently from the terms of sections 15 and 16 of this License; or</li><li>b) Requiring preservation of specified reasonable legal notices or   author attributions in that material or in the Appropriate Legal Notices   displayed by works containing it; or</li><li>c) Prohibiting misrepresentation of the origin of that material, or   requiring that modified versions of such material be marked in   reasonable ways as different from the original version; or</li><li>d) Limiting the use for publicity purposes of names of licensors or authors of the material; or</li><li>e) Declining to grant rights under trademark law for use of some trade names, trademarks, or service marks; or</li><li>f) Requiring indemnification of licensors and authors of that   material by anyone who conveys the material (or modified versions of it)   with contractual assumptions of liability to the recipient, for any   liability that these contractual assumptions directly impose on those   licensors and authors.</li></ul><p>All other non-permissive additional terms are considered &ldquo;further   restrictions&rdquo; within the meaning of section 10. If the Program as you   received it, or any part of it, contains a notice stating that it is   governed by this License along with a term that is a further   restriction, you may remove that term. If a license document contains a   further restriction but permits relicensing or conveying under this   License, you may add to a covered work material governed by the terms of   that license document, provided that the further restriction does not   survive such relicensing or conveying.</p><p>If you add terms to a covered work in accord with this section, you   must place, in the relevant source files, a statement of the additional   terms that apply to those files, or a notice indicating where to find   the applicable terms.</p><p>Additional terms, permissive or non-permissive, may be stated in the   form of a separately written license, or stated as exceptions; the above   requirements apply either way.</p><h4><a name=\"section8\"></a>8. Termination.</h4><p>You may not propagate or modify a covered work except as expressly   provided under this License. Any attempt otherwise to propagate or   modify it is void, and will automatically terminate your rights under   this License (including any patent licenses granted under the third   paragraph of section 11).</p><p>However, if you cease all violation of this License, then your   license from a particular copyright holder is reinstated (a)   provisionally, unless and until the copyright holder explicitly and   finally terminates your license, and (b) permanently, if the copyright   holder fails to notify you of the violation by some reasonable means   prior to 60 days after the cessation.</p><p>Moreover, your license from a particular copyright holder is   reinstated permanently if the copyright holder notifies you of the   violation by some reasonable means, this is the first time you have   received notice of violation of this License (for any work) from that   copyright holder, and you cure the violation prior to 30 days after your   receipt of the notice.</p><p>Termination of your rights under this section does not terminate the   licenses of parties who have received copies or rights from you under   this License. If your rights have been terminated and not permanently   reinstated, you do not qualify to receive new licenses for the same   material under section 10.</p><h4><a name=\"section9\"></a>9. Acceptance Not Required for Having Copies.</h4><p>You are not required to accept this License in order to receive or   run a copy of the Program. Ancillary propagation of a covered work   occurring solely as a consequence of using peer-to-peer transmission to   receive a copy likewise does not require acceptance. However, nothing   other than this License grants you permission to propagate or modify any   covered work. These actions infringe copyright if you do not accept   this License. Therefore, by modifying or propagating a covered work, you   indicate your acceptance of this License to do so.</p><h4><a name=\"section10\"></a>10. Automatic Licensing of Downstream Recipients.</h4><p>Each time you convey a covered work, the recipient automatically   receives a license from the original licensors, to run, modify and   propagate that work, subject to this License. You are not responsible   for enforcing compliance by third parties with this License.</p><p>An &ldquo;entity transaction&rdquo; is a transaction transferring control of an   organization, or substantially all assets of one, or subdividing an   organization, or merging organizations. If propagation of a covered work   results from an entity transaction, each party to that transaction who   receives a copy of the work also receives whatever licenses to the work   the party&rsquo;s predecessor in interest had or could give under the previous   paragraph, plus a right to possession of the Corresponding Source of   the work from the predecessor in interest, if the predecessor has it or   can get it with reasonable efforts.</p><p>You may not impose any further restrictions on the exercise of the   rights granted or affirmed under this License. For example, you may not   impose a license fee, royalty, or other charge for exercise of rights   granted under this License, and you may not initiate litigation   (including a cross-claim or counterclaim in a lawsuit) alleging that any   patent claim is infringed by making, using, selling, offering for sale,   or importing the Program or any portion of it.</p><h4><a name=\"section11\"></a>11. Patents.</h4><p>A &ldquo;contributor&rdquo; is a copyright holder who authorizes use under this   License of the Program or a work on which the Program is based. The work   thus licensed is called the contributor&rsquo;s &ldquo;contributor version&rdquo;.</p><p>A contributor&rsquo;s &ldquo;essential patent claims&rdquo; are all patent claims owned   or controlled by the contributor, whether already acquired or hereafter   acquired, that would be infringed by some manner, permitted by this   License, of making, using, or selling its contributor version, but do   not include claims that would be infringed only as a consequence of   further modification of the contributor version. For purposes of this   definition, &ldquo;control&rdquo; includes the right to grant patent sublicenses in a   manner consistent with the requirements of this License.</p><p>Each contributor grants you a non-exclusive, worldwide, royalty-free   patent license under the contributor&rsquo;s essential patent claims, to make,   use, sell, offer for sale, import and otherwise run, modify and   propagate the contents of its contributor version.</p><p>In the following three paragraphs, a &ldquo;patent license&rdquo; is any express   agreement or commitment, however denominated, not to enforce a patent   (such as an express permission to practice a patent or covenant not to   sue for patent infringement). To &ldquo;grant&rdquo; such a patent license to a   party means to make such an agreement or commitment not to enforce a   patent against the party.</p><p>If you convey a covered work, knowingly relying on a patent license,   and the Corresponding Source of the work is not available for anyone to   copy, free of charge and under the terms of this License, through a   publicly available network server or other readily accessible means,   then you must either (1) cause the Corresponding Source to be so   available, or (2) arrange to deprive yourself of the benefit of the   patent license for this particular work, or (3) arrange, in a manner   consistent with the requirements of this License, to extend the patent   license to downstream recipients. &ldquo;Knowingly relying&rdquo; means you have   actual knowledge that, but for the patent license, your conveying the   covered work in a country, or your recipient&rsquo;s use of the covered work   in a country, would infringe one or more identifiable patents in that   country that you have reason to believe are valid.</p><p>If, pursuant to or in connection with a single transaction or   arrangement, you convey, or propagate by procuring conveyance of, a   covered work, and grant a patent license to some of the parties   receiving the covered work authorizing them to use, propagate, modify or   convey a specific copy of the covered work, then the patent license you   grant is automatically extended to all recipients of the covered work   and works based on it.</p><p>A patent license is &ldquo;discriminatory&rdquo; if it does not include within   the scope of its coverage, prohibits the exercise of, or is conditioned   on the non-exercise of one or more of the rights that are specifically   granted under this License. You may not convey a covered work if you are   a party to an arrangement with a third party that is in the business of   distributing software, under which you make payment to the third party   based on the extent of your activity of conveying the work, and under   which the third party grants, to any of the parties who would receive   the covered work from you, a discriminatory patent license (a) in   connection with copies of the covered work conveyed by you (or copies   made from those copies), or (b) primarily for and in connection with   specific products or compilations that contain the covered work, unless   you entered into that arrangement, or that patent license was granted,   prior to 28 March 2007.</p><p>Nothing in this License shall be construed as excluding or limiting   any implied license or other defenses to infringement that may otherwise   be available to you under applicable patent law.</p><h4><a name=\"section12\"></a>12. No Surrender of Others&rsquo; Freedom.</h4><p>If conditions are imposed on you (whether by court order, agreement   or otherwise) that contradict the conditions of this License, they do   not excuse you from the conditions of this License. If you cannot convey   a covered work so as to satisfy simultaneously your obligations under   this License and any other pertinent obligations, then as a consequence   you may not convey it at all. For example, if you agree to terms that   obligate you to collect a royalty for further conveying from those to   whom you convey the Program, the only way you could satisfy both those   terms and this License would be to refrain entirely from conveying the   Program.</p><h4><a name=\"section13\"></a>13. Use with the GNU Affero General Public License.</h4><p>Notwithstanding any other provision of this License, you have   permission to link or combine any covered work with a work licensed   under version 3 of the GNU Affero General Public License into a single   combined work, and to convey the resulting work. The terms of this   License will continue to apply to the part which is the covered work,   but the special requirements of the GNU Affero General Public License,   section 13, concerning interaction through a network will apply to the   combination as such.</p><h4><a name=\"section14\"></a>14. Revised Versions of this License.</h4><p>The Free Software Foundation may publish revised and/or new versions   of the GNU General Public License from time to time. Such new versions   will be similar in spirit to the present version, but may differ in   detail to address new problems or concerns.</p><p>Each version is given a distinguishing version number. If the Program   specifies that a certain numbered version of the GNU General Public   License &ldquo;or any later version&rdquo; applies to it, you have the option of   following the terms and conditions either of that numbered version or of   any later version published by the Free Software Foundation. If the   Program does not specify a version number of the GNU General Public   License, you may choose any version ever published by the Free Software   Foundation.</p><p>If the Program specifies that a proxy can decide which future   versions of the GNU General Public License can be used, that proxy&rsquo;s   public statement of acceptance of a version permanently authorizes you   to choose that version for the Program.</p><p>Later license versions may give you additional or different   permissions. However, no additional obligations are imposed on any   author or copyright holder as a result of your choosing to follow a   later version.</p><h4><a name=\"section15\"></a>15. Disclaimer of Warranty.</h4><p>THERE IS NO WARRANTY FOR THE PROGRAM, TO THE EXTENT PERMITTED BY   APPLICABLE LAW. EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT   HOLDERS AND/OR OTHER PARTIES PROVIDE THE PROGRAM &ldquo;AS IS&rdquo; WITHOUT   WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT   LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A   PARTICULAR PURPOSE. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF   THE PROGRAM IS WITH YOU. SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME   THE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION.</p><h4><a name=\"section16\"></a>16. Limitation of Liability.</h4><p>IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED TO IN WRITING   WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MODIFIES AND/OR   CONVEYS THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES,   INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES   ARISING OUT OF THE USE OR INABILITY TO USE THE PROGRAM (INCLUDING BUT   NOT LIMITED TO LOSS OF DATA OR DATA BEING RENDERED INACCURATE OR LOSSES   SUSTAINED BY YOU OR THIRD PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE   WITH ANY OTHER PROGRAMS), EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN   ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.</p><h4><a name=\"section17\"></a>17. Interpretation of Sections 15 and 16.</h4><p>If the disclaimer of warranty and limitation of liability provided   above cannot be given local legal effect according to their terms,   reviewing courts shall apply local law that most closely approximates an   absolute waiver of all civil liability in connection with the Program,   unless a warranty or assumption of liability accompanies a copy of the   Program in return for a fee.</p><p>END OF TERMS AND CONDITIONS</p><p>By clicking to Next, you hereby agree to the terms of this License Agreement<p></div>";
		echo "<form method=\"post\" action=\"index.php?step=2\"><input type=\"submit\" value=\"Next\"></form>";
	break;
	case 2:
		$INSLALL_CHECK = 0;
		$PHPINCE_VERSION_php = substr(phpversion(),0,strpos(phpversion(), '-'));
		if(empty($PHPINCE_VERSION_php)){
			$PHPINCE_VERSION_php = phpversion();
		}
		if(floatval(phpversion())>="5.3"){
			$INSLALL_CHECK++;
			$INSTALL_LOAD["PHP"]["class"] = "ok";
			$INSTALL_LOAD["PHP"]["text"] = "passed";
			$INSTALL_LOAD["PHP"]["msg"] = $PHPINCE_VERSION_php;
		} else {
			$INSTALL_LOAD["PHP"]["class"] = "no";
			$INSTALL_LOAD["PHP"]["text"] = "unsupported";
			$INSTALL_LOAD["PHP"]["msg"] = $PHPINCE_VERSION_php;
		}
		if((is_writable("index.php"))&&(is_writable("../phpince-panel/phpince-upload/"))&&(is_writable("../index.php"))){
			$INSLALL_CHECK++;
			$INSTALL_LOAD["FILE"]["class"] = "ok";
			$INSTALL_LOAD["FILE"]["text"] = "passed";
			$INSTALL_LOAD["FILE"]["msg"] = "writable";
		} else {
			$INSTALL_LOAD["FILE"]["class"] = "no";
			$INSTALL_LOAD["FILE"]["text"] = "unsupported";
			$INSTALL_LOAD["FILE"]["msg"] = "not writable";
		}
		require "../phpince-panel/phpince-data/core/GeoIP.php";
		$BLADRION_Country_connect = geoip_open("../phpince-panel/phpince-data/core/GeoIP.dat",GEOIP_STANDARD);
		if((function_exists("geoip_open"))&&(geoip_country_name_by_addr($BLADRION_Country_connect, $_SERVER['REMOTE_ADDR']))){
			$INSTALL_LOAD["GEOIP"]["class"] = "ok";
			$INSTALL_LOAD["GEOIP"]["text"] = "passed";
			$INSTALL_LOAD["GEOIP"]["msg"] = "yes";
		} else {
			$INSTALL_LOAD["GEOIP"]["class"] = "no";
			$INSTALL_LOAD["GEOIP"]["text"] = "unsupported";
			$INSTALL_LOAD["GEOIP"]["msg"] = "no";
		}
		if((extension_loaded("PDO"))&&(extension_loaded("pdo_mysql"))){
			$INSLALL_CHECK++;
			$INSTALL_LOAD["PDO"]["class"] = "ok";
			$INSTALL_LOAD["PDO"]["text"] = "passed";
			$INSTALL_LOAD["PDO"]["msg"] = "yes";
		} else {
			$INSTALL_LOAD["PDO"]["class"] = "no";
			$INSTALL_LOAD["PDO"]["text"] = "unsupported";
			$INSTALL_LOAD["PDO"]["msg"] = "no";
		}
		if($_COOKIE["PHPINCE_INSTALL"]=="hash883"){
			$INSLALL_CHECK++;
			$INSTALL_LOAD["COOKIE"]["class"] = "ok";
			$INSTALL_LOAD["COOKIE"]["text"] = "passed";
			$INSTALL_LOAD["COOKIE"]["msg"] = "yes";
		} else {
			$INSTALL_LOAD["COOKIE"]["class"] = "no";
			$INSTALL_LOAD["COOKIE"]["text"] = "unsupported";
			$INSTALL_LOAD["COOKIE"]["msg"] = "no";
		}
		if(ini_get('allow_url_fopen')){
			$INSTALL_LOAD["URL"]["class"] = "ok";
			$INSTALL_LOAD["URL"]["text"] = "passed";
			$INSTALL_LOAD["URL"]["msg"] = "yes";
		} else {
			$INSTALL_LOAD["URL"]["class"] = "no";
			$INSTALL_LOAD["URL"]["text"] = "unsupported";
			$INSTALL_LOAD["URL"]["msg"] = "no";
		}
		if(array_key_exists('HTTP_MOD_REWRITE', $_SERVER)){
			$INSLALL_CHECK++;
			$INSTALL_LOAD["REWRITE"]["class"] = "ok";
			$INSTALL_LOAD["REWRITE"]["text"] = "passed";
			$INSTALL_LOAD["REWRITE"]["msg"] = "yes";
		} else {
			$INSTALL_LOAD["REWRITE"]["class"] = "no";
			$INSTALL_LOAD["REWRITE"]["text"] = "unsupported";
			$INSTALL_LOAD["REWRITE"]["msg"] = "no";
		}
		$PHPINCE_system["system"]["SYSTEM"] = $PHPINCE_VERSION["SYSTEM"];
		if(bl_sysversion($PHPINCE_system)){
			$INSTALL_LOAD["VER"]["class"] = "ok";
			$INSTALL_LOAD["VER"]["text"] = "passed";
			$INSTALL_LOAD["VER"]["msg"] = $PHPINCE_VERSION["SYSTEM"];
		} else {
			$INSTALL_LOAD["VER"]["class"] = "no";
			$INSTALL_LOAD["VER"]["text"] = "old version";
			$INSTALL_LOAD["VER"]["msg"] = $PHPINCE_VERSION["SYSTEM"];
		}
		if(function_exists('curl_version')){
			$INSLALL_CHECK++;
			$INSTALL_LOAD["CURL"]["class"] = "ok";
			$INSTALL_LOAD["CURL"]["text"] = "passed";
			$INSTALL_LOAD["CURL"]["msg"] = "yes";
		} else {
			$INSTALL_LOAD["CURL"]["class"] = "no";
			$INSTALL_LOAD["CURL"]["text"] = "unsupported";
			$INSTALL_LOAD["CURL"]["msg"] = "no";
		}
		if($INSLALL_CHECK==6){
			echo '<form method="post" action="index.php?step=3">';
		}
		echo '<table>
            	<tr>
                	<th width="40%"></th>
                    <th width="20%">Required</th>
                    <th width="20%">Available</th>
                    <th width="20%">Status</th>
                </tr>
            	<tr>
                	<td>PHP version</td>
                    <td>5.3 &lt;</td>
                    <td>'.$INSTALL_LOAD["PHP"]["msg"].'</td>
                    <td class="'.$INSTALL_LOAD["PHP"]["class"].'">'.$INSTALL_LOAD["PHP"]["text"].'</td>
                </tr>
                <tr>
                	<td>File writable</td>
                    <td>writable</td>
                    <td>'.$INSTALL_LOAD["FILE"]["msg"].'</td>
                    <td class="'.$INSTALL_LOAD["FILE"]["class"].'">'.$INSTALL_LOAD["FILE"]["text"].'</td>
                </tr>
                <tr>
                	<td>GeoIP</td>
                    <td>yes</td>
                    <td>'.$INSTALL_LOAD["GEOIP"]["msg"].'</td>
                    <td class="'.$INSTALL_LOAD["GEOIP"]["class"].'">'.$INSTALL_LOAD["GEOIP"]["text"].'</td>
                </tr>
				<tr>
                	<td>cURL</td>
                    <td>yes</td>
                    <td>'.$INSTALL_LOAD["CURL"]["msg"].'</td>
                    <td class="'.$INSTALL_LOAD["CURL"]["class"].'">'.$INSTALL_LOAD["CURL"]["text"].'</td>
                </tr>
                <tr>
                	<td>PDO MySQL</td>
                    <td>yes</td>
                    <td>'.$INSTALL_LOAD["PDO"]["msg"].'</td>
                    <td class="'.$INSTALL_LOAD["PDO"]["class"].'">'.$INSTALL_LOAD["PDO"]["text"].'</td>
                </tr>
                <tr>
                	<td>Cookies</td>
                    <td>yes</td>
                    <td>'.$INSTALL_LOAD["COOKIE"]["msg"].'</td>
                    <td class="'.$INSTALL_LOAD["COOKIE"]["class"].'">'.$INSTALL_LOAD["COOKIE"]["text"].'</td>
                </tr>
				<tr>
                	<td>Version</td>
                    <td>'.bl_sysversion($PHPINCE_system,true).'</td>
                    <td>'.$INSTALL_LOAD["VER"]["msg"].'</td>
                    <td class="'.$INSTALL_LOAD["VER"]["class"].'">'.$INSTALL_LOAD["VER"]["text"].'</td>
                </tr>
                <tr>
                	<td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                	<td>allow_url_fopen</td>
                    <td>yes</td>
                    <td>'.$INSTALL_LOAD["URL"]["msg"].'</td>
                    <td class="'.$INSTALL_LOAD["URL"]["class"].'">'.$INSTALL_LOAD["URL"]["text"].'</td>
                </tr>
                <tr>
                	<td>mod_rewrite</td>
                    <td>yes</td>
                    <td>'.$INSTALL_LOAD["REWRITE"]["msg"].'</td>
                    <td class="'.$INSTALL_LOAD["REWRITE"]["class"].'">'.$INSTALL_LOAD["REWRITE"]["text"].'</td>
                </tr>
            </table>';
			if($INSLALL_CHECK<6){
				echo '<h2 style="color:#9f1212;">Your webhosting unsupported PHPince Website :-( , check out our <a target="_blank" href="http://phpince.com/page_18">tested hosting</a> or report this installation on <a target="_blank" href="https://bitbucket.org/bladrioncom/phpince/issues">Git</a> or contact us on operator@phpince.com :-)</h2>';
			}
            echo '<input type="submit" value="Next">';
			if($INSLALL_CHECK==6){
				echo '</form>';
			}
	break;
	case 3:
		setcookie("PHPINCE_INSTALL", "", time()-3600);
		echo '<form method="post" action="index.php?step=3">';
		if(!empty($_POST)){
			if((empty($_POST["INSTALL_IP"]))||(empty($_POST["INSTALL_PORT"]))||(empty($_POST["INSTALL_USER"]))||(empty($_POST["INSTALL_PASS"]))||(empty($_POST["INSTALL_DB"]))||(empty($_POST["INSTALL_PREFIX"]))||(empty($_POST["USER_NAME"]))||(empty($_POST["USER_PASS"]))||(empty($_POST["USER_MAIL"]))){
				echo '<h2 style="color:#9f1212;"><b>! </b>Please fill all fields.</h2>';
			} else {
				if((preg_match("/[^a-zA-Z0-9]/", $_POST["USER_NAME"]))||(preg_match("/[^a-zA-Z0-9]/", $_POST["USER_PASS"]))||(!preg_match("/^[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+.)+[a-zA-Z]{2,4}$/", $_POST["USER_MAIL"]))){
					echo '<h2 style="color:#9f1212;"><b>! </b>Registration: Please fill in the fields correctly.</h2>';
				} else {
					try {
						$PHPINCE_mysql = new PDO('mysql:host='.$_POST["INSTALL_IP"].';port='.$_POST["INSTALL_PORT"].';dbname='.$_POST["INSTALL_DB"].'', $_POST["INSTALL_USER"], $_POST["INSTALL_PASS"]);
					} catch (PDOException $PHPINCE_mysql_e) {
						$PHPINCE_mysql_test_error_msg = "edeny";
					}
					if(!$PHPINCE_mysql){
						echo '<h2 style="color:#9f1212;"><b>! </b>Unable to connect to database.</h2>';
					} else {
						$CREATE_CONFIG = fopen('../phpince-panel/phpince-data/config/phpince.connect.php', 'w');
						fwrite($CREATE_CONFIG, '<?php
/*---------------------------------------------------------------------+
| PHPince Website
| Copyright (c) 2011 - 2013 Dominik Hulla
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
$PHPINCE_config = array(
	"ip" => "'.$_POST["INSTALL_IP"].'",
	"port" => "'.$_POST["INSTALL_PORT"].'",
	"user" => "'.$_POST["INSTALL_USER"].'",
	"pass" => "'.$_POST["INSTALL_PASS"].'",
	"db" => "'.$_POST["INSTALL_DB"].'",
	"prefix" => "'.$_POST["INSTALL_PREFIX"].'"
);
?>');
						fclose($CREATE_CONFIG);
						$CREATE_SECURE = fopen('../phpince-panel/phpince-data/config/phpince.secured.php', 'w');
						$SECURE_HASH = bl_randtext(12).".hash";
						fwrite($CREATE_SECURE, '<?php
/*---------------------------------------------------------------------+
| PHPince Website
| Copyright (c) 2011 - 2013 Dominik Hulla
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
$PHPINCE_secured = array(
	"hash" => "'.$SECURE_HASH.'"
);
?>');
						fclose($CREATE_SECURE);
						$PHPINCE_install_query = array(
							"CREATE TABLE IF NOT EXISTS `".$_POST["INSTALL_PREFIX"]."phpince_acc` (`id` int(32) NOT NULL AUTO_INCREMENT,`account` varchar(64) NOT NULL,`password` varchar(64) NOT NULL,`email` varchar(255) NOT NULL,`regdate` int(64) NOT NULL,`lastlogin` int(64) NOT NULL,`lastip` varchar(64) NOT NULL,`userlevel` int(2) NOT NULL DEFAULT '0',PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1",
							"INSERT INTO `".$_POST["INSTALL_PREFIX"]."phpince_acc` (`account`, `password`, `email`, `regdate`, `lastlogin`, `lastip`, `userlevel`) VALUES ('".$_POST["USER_NAME"]."', '".sha1($_POST["USER_PASS"].$SECURE_HASH)."', '".$_POST["USER_MAIL"]."', ".bl_date().", ".bl_date().", '".$_SERVER['REMOTE_ADDR']."', 10)",
							"CREATE TABLE IF NOT EXISTS `".$_POST["INSTALL_PREFIX"]."phpince_analytics` (`id` int(32) NOT NULL AUTO_INCREMENT,`session` text NOT NULL,`set_browser` text NOT NULL,`set_browser_version` varchar(32) NOT NULL,`set_os` text NOT NULL,`set_locate` text NOT NULL,`set_locate_code` varchar(32) NOT NULL,`set_time` int(32) NOT NULL,`set_bot` int(1) NOT NULL,`set_bot_name` text NOT NULL,PRIMARY KEY (`id`),KEY `set_time` (`set_time`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1",
							"CREATE TABLE IF NOT EXISTS `".$_POST["INSTALL_PREFIX"]."phpince_analytics_ref` (`id` int(32) NOT NULL AUTO_INCREMENT,`set_domain` varchar(255) NOT NULL,`set_url` text NOT NULL,`clicks` int(32) NOT NULL,PRIMARY KEY (`id`),KEY `set_domain` (`set_domain`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1",
							"CREATE TABLE IF NOT EXISTS `".$_POST["INSTALL_PREFIX"]."phpince_app` (`id` int(32) NOT NULL AUTO_INCREMENT,`datafiles` text NOT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1",
							"CREATE TABLE IF NOT EXISTS `".$_POST["INSTALL_PREFIX"]."phpince_ban` (`id` int(64) NOT NULL AUTO_INCREMENT,`ip` varchar(64) NOT NULL,`created` int(64) NOT NULL,`bantime` int(64) NOT NULL,`perma` int(1) NOT NULL DEFAULT '0',`autor` varchar(64) NOT NULL,`msg` text NOT NULL,`bantype` varchar(32) NOT NULL,PRIMARY KEY (`id`),KEY `ip` (`ip`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1",
							"CREATE TABLE IF NOT EXISTS `".$_POST["INSTALL_PREFIX"]."phpince_ban_login` (`id` int(32) NOT NULL AUTO_INCREMENT,`ip` varchar(64) NOT NULL,`denyes` int(32) NOT NULL,PRIMARY KEY (`id`),KEY `ip` (`ip`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1",
							"CREATE TABLE IF NOT EXISTS `".$_POST["INSTALL_PREFIX"]."phpince_hash` (`hash` varchar(64) NOT NULL,`account` varchar(64) NOT NULL,`ip` varchar(64) NOT NULL,`created` int(64) NOT NULL,UNIQUE KEY `hash` (`hash`)) ENGINE=MyISAM DEFAULT CHARSET=latin1",
							"CREATE TABLE IF NOT EXISTS `".$_POST["INSTALL_PREFIX"]."phpince_log` (`id` int(64) NOT NULL AUTO_INCREMENT,`account` int(64) NOT NULL,`ip` varchar(64) NOT NULL,`adate` int(64) NOT NULL,`action` varchar(32) NOT NULL,`msg` text NOT NULL,PRIMARY KEY (`id`),KEY `account` (`account`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1",
							"CREATE TABLE IF NOT EXISTS `".$_POST["INSTALL_PREFIX"]."phpince_nav` (`id` int(32) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1",
							"INSERT INTO `".$_POST["INSTALL_PREFIX"]."phpince_nav` (`id`) VALUES (1)",
							"CREATE TABLE IF NOT EXISTS `".$_POST["INSTALL_PREFIX"]."phpince_nav_item` (`id` int(11) NOT NULL AUTO_INCREMENT,`name` text NOT NULL,`url` text NOT NULL,`nav` int(32) NOT NULL,`position` int(32) NOT NULL,`set_id` text NOT NULL,`set_class` text NOT NULL,`set_target` text NOT NULL,PRIMARY KEY (`id`),KEY `nav` (`nav`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1",
							"INSERT INTO `".$_POST["INSTALL_PREFIX"]."phpince_nav_item` (`id`, `name`, `url`, `nav`, `position`, `set_id`, `set_class`, `set_target`) VALUES (1, 'Home', '/', 1, 0, '', '', ''), (2, 'Panel', '/panel', 1, 1, '', '', '');",
							"CREATE TABLE IF NOT EXISTS `".$_POST["INSTALL_PREFIX"]."phpince_ncat` (`id` int(32) NOT NULL AUTO_INCREMENT,`cat` text NOT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1",
							"CREATE TABLE IF NOT EXISTS `".$_POST["INSTALL_PREFIX"]."phpince_news` (`id` int(32) NOT NULL AUTO_INCREMENT,`created` int(32) NOT NULL,`edited` int(32) NOT NULL,`autor` int(32) NOT NULL,`title` text NOT NULL,`content` text NOT NULL,`ncat` int(32) NOT NULL DEFAULT '0',PRIMARY KEY (`id`),KEY `ncat` (`ncat`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1",
							"CREATE TABLE IF NOT EXISTS `".$_POST["INSTALL_PREFIX"]."phpince_pages` (`id` int(32) NOT NULL AUTO_INCREMENT,`created` int(32) NOT NULL,`edited` int(32) NOT NULL,`autor` int(32) NOT NULL,`title` text NOT NULL,`content` text NOT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1",
							"CREATE TABLE IF NOT EXISTS `".$_POST["INSTALL_PREFIX"]."phpince_perms` (`id` int(32) NOT NULL AUTO_INCREMENT,`perms` varchar(64) NOT NULL,`userlevel` int(2) NOT NULL,PRIMARY KEY (`id`),KEY `userlevel` (`userlevel`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1",
							"INSERT INTO `".$_POST["INSTALL_PREFIX"]."phpince_perms` (`id`, `perms`, `userlevel`) VALUES (2, 'systemlog', 8),(3, 'systeminfo', 8),(4, 'settings', 10),(5, 'files', 4),(6, 'nav', 6),(7, 'construction', 1),(8, 'script', 9),(9, 'ban', 1),(10, 'perms', 10),(11, 'users', 8),(12, 'sysupdate', 10),(13, 'pages', 5),(14, 'pagesall', 9),(15, 'news', 2),(16, 'newsall', 6),(17, 'newscat', 6),(18, 'apps', 9),(19, 'formating', 6),(20, 'stats', 2);",
							"CREATE TABLE IF NOT EXISTS `".$_POST["INSTALL_PREFIX"]."phpince_resetpass` (`id` int(11) NOT NULL AUTO_INCREMENT,`hash` varchar(64) NOT NULL,`account` int(32) NOT NULL,`newpass` varchar(64) NOT NULL,`expire` int(64) NOT NULL,PRIMARY KEY (`id`),KEY `hash` (`hash`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1",
							"CREATE TABLE IF NOT EXISTS `".$_POST["INSTALL_PREFIX"]."phpince_style` (`id` int(32) NOT NULL,`styledata` text NOT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1",
							"INSERT INTO `".$_POST["INSTALL_PREFIX"]."phpince_style` (`id`, `styledata`) VALUES (1, '<h1>{PHPINCE_TITLE}</h1>\r\n<p>{PHPINCE_TEXT}</p>\r\n<hr>'),(4, 'No topic writed'),(3, 'Sorry, topic not found'),(2, '<h1>Topic: {PHPINCE_TITLE} | {PHPINCE_CAT} | {PHPINCE_AUTOR}</h1>\r\n<p>{PHPINCE_TEXT}</p>'),(5, '<h1>Page: {PHPINCE_TITLE} | {PHPINCE_AUTOR}</h1>\r\n<p>{PHPINCE_TEXT}</p>'),(6, 'Sorry, page not found'),(7, 'Plugin not found');",
							"CREATE TABLE IF NOT EXISTS `".$_POST["INSTALL_PREFIX"]."phpince_system` (`data` int(1) NOT NULL,`site_name` text NOT NULL,`site_desc` text NOT NULL,`site_key` text NOT NULL,`site_charset` text NOT NULL,`site_html` text NOT NULL,`set_style` varchar(64) NOT NULL,`set_lp` varchar(64) NOT NULL,`set_bot` int(1) NOT NULL DEFAULT '1',`set_construction` int(1) NOT NULL DEFAULT '0',`set_editor` varchar(64) NOT NULL,`set_time` int(2) NOT NULL DEFAULT '12',`set_reg` int(1) NOT NULL DEFAULT '1',`set_version` int(1) NOT NULL DEFAULT '1',`set_inteldoc` int(1) NOT NULL DEFAULT '1',`set_stopspam` int(1) NOT NULL DEFAULT '1',`set_ban` int(32) NOT NULL DEFAULT '10',`set_ban_time` int(32) NOT NULL DEFAULT '10',PRIMARY KEY (`data`)) ENGINE=MyISAM DEFAULT CHARSET=latin1",
							"INSERT INTO `".$_POST["INSTALL_PREFIX"]."phpince_system` (`data`, `site_name`, `site_desc`, `site_key`, `site_charset`, `site_html`, `set_style`, `set_lp`, `set_bot`, `set_construction`, `set_editor`, `set_time`, `set_reg`, `set_version`, `set_inteldoc`, `set_stopspam`, `set_ban`, `set_ban_time`) VALUES (1, 'My Website', 'Site powered by PHPince Website', '', 'UTF-8 (Unicode)', 'HTML 5', 'Default', 'English', 0, 0, 'ckeditor', 12, 0, 1, 1, 1, 4, 10);",
						);
						for ($PHPINCE_install_i = 0; $PHPINCE_install_i <= count($PHPINCE_install_query); $PHPINCE_install_i++) {
							$PHPINCE_query = $PHPINCE_mysql->prepare($PHPINCE_install_query[$PHPINCE_install_i]);
							$PHPINCE_query->execute();
						}
						bl_redirect("index.php?step=4");
					}
				}
			}
		}
		if(empty($_POST["INSTALL_IP"])){
			$_POST["INSTALL_IP"] = "localhost";
		}
		if(empty($_POST["INSTALL_PORT"])){
			$_POST["INSTALL_PORT"] = "3306";
		}
		if(empty($_POST["INSTALL_PREFIX"])){
			$_POST["INSTALL_PREFIX"] = "web".bl_randtext(5)."_";
		}
		if(empty($_POST["USER_MAIL"])){
			$_POST["USER_MAIL"] = "@";
		}
		echo '<h2>IP</h2>
		<input name="INSTALL_IP" type="text" value="'.$_POST["INSTALL_IP"].'" autocomplete="off">
		<h2>Port <small>| Deffault 3306</small></h2>
		<input name="INSTALL_PORT" type="text" value="'.$_POST["INSTALL_PORT"].'" autocomplete="off">
		<h2>Username</h2>
		<input name="INSTALL_USER" type="text" value="'.$_POST["INSTALL_USER"].'" autocomplete="off">
		<h2>Password</h2>
		<input name="INSTALL_PASS" type="password" value="'.$_POST["INSTALL_PASS"].'" autocomplete="off">
		<h2>Database name</h2>
		<input name="INSTALL_DB" type="text" value="'.$_POST["INSTALL_DB"].'" autocomplete="off">
		<h2>Table prefix</h2>
		<input name="INSTALL_PREFIX" type="text" value="'.$_POST["INSTALL_PREFIX"].'" autocomplete="off">
		<p>&nbsp;</p><h1>Account registration</h1>
		<h2>Account</h2>
		<input name="USER_NAME" type="text" value="'.$_POST["USER_NAME"].'" autocomplete="off">
		<h2>Password</h2>
		<input name="USER_PASS" type="password" value="'.$_POST["USER_PASS"].'" autocomplete="off">
		<h2>E-Mail</h2>
		<input name="USER_MAIL" type="text" value="'.$_POST["USER_MAIL"].'" autocomplete="off">
		<input type="submit" value="Next"></form>';
	break;
	case 4:
		echo "<h2>Installation was successful, please delete the installation folder.</h2>";
		require '../phpince-panel/phpince-data/config/phpince.secured.php';
		echo "<iframe style=\"display:none;\" src=\"http://phpince.com/indexing/phpince.index.php?loader=okloader&hash=".sha1($PHPINCE_secured["hash"])."\"></iframe>";
		$LOCK_INSTALL = fopen('lock.phpince', 'w');
	break;
	case "lock":
		echo "<h2>To install the system to delete the file &quot;lock.phpince&quot; in the folder &quot;install&quot;.</h2>";
	break;
}
echo "</section>";
echo "<footer>Powered by <a href=\"http://phpince.com\">PHPince Website</a> | Copyright &copy; 2011 - 2013 Dominik Hulla<br>Released as free software without warranties under <a href=\"http://phpince.com/page_19\">GNU GPL v3</a> (or later).<p>&nbsp;</p></footer>
</div>
</body>
</html>";
ob_end_flush();
?>