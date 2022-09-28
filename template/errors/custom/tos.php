<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Terms of Service - <?= $this->base->get_hostname() ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" type="image/png" href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/img/fav.png">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/css/tabler.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/css/all.min.css">
	<style type="text/css">
		.alert p {
			margin: 0;
		}
	</style>
</head>

<body class="border-top-wide border-primary d-flex flex-column theme-<?= get_cookie('theme') ?? 'light' ?>">
	<div class="page page-center">
		<div class="container-narrow py-4">
			<div class="text-center mb-2">
				<a href="." class="navbar-brand navbar-brand-autodark"><img src="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/img/xera.png" height="36" alt=""></a>
			</div>
			<div class="card card-md">
				<div class="card-body">
					<div class="tabs-block">
						<div class="tabs pb-3">
							<button class="tab-item btn btn-sm btn-primary" data-tab="Terms" id="DefaultClicked">Terms of Services</button>
							<button class="tab-item btn btn-sm btn-primary" data-tab="Policy">Privacy Policy</button>
						</div>
						<div id="Terms" class="tab-content">
							<h2>1. ACCEPTANCE OF TERMS</h2>

							<p>Byet Internet "<?= $this->base->get_hostname() ?>" welcomes you.</p>

							<p><?= $this->base->get_hostname() ?> provides its service to you subject to the following Terms of Service ("TOS"), which may be updated by us from time to time without notice to you. You can review the most current version of the TOS at any time at: <?= base_url() ?>/legal.php. In addition, when using particular <?= $this->base->get_hostname() ?> owned or operated services, you and <?= $this->base->get_hostname() ?> shall be subject to any posted guidelines or rules applicable to such services, which may be posted from time to time. All such guidelines or rules (including but not limited to our Spam Policy) are hereby incorporated by reference into the TOS. <?= $this->base->get_hostname() ?> may also offer other services that are governed by different Terms of Service.</p>



							<h2>2. DESCRIPTION OF SERVICE</h2>

							<p><?= $this->base->get_hostname() ?> provides users with access to a rich collection of resources, including various communications tools, forums, shopping services, search services, personalized content and branded programming through its network of properties which may be accessed through any various medium or device now known or hereafter developed (the "Service").</p>
							<p>You also understand and agree that the Service may include advertisements and that these advertisements are necessary for <?= $this->base->get_hostname() ?> to provide the Service. You also understand and agree that the Service may include certain communications from <?= $this->base->get_hostname() ?>, such as service announcements, administrative messages and the <?= $this->base->get_hostname() ?> Newsletter, and that these communications are considered part of <?= $this->base->get_hostname() ?> membership and you will not be able to opt out of receiving them. Unless explicitly stated otherwise, any new features that augment or enhance the current Service, including the release of new <?= $this->base->get_hostname() ?> properties, shall be subject to the TOS. You understand and agree that the Service is provided "AS-IS" and that <?= $this->base->get_hostname() ?> assumes no responsibility for the timeliness, deletion, mis-delivery or failure to store any user communications or personalization settings.</p>
							<p>You are responsible for obtaining access to the Service, and that access may involve third-party fees (such as Internet service provider or airtime charges). You are responsible for those fees, including those fees associated with the display or delivery of advertisements. In addition, you must provide and are responsible for all equipment necessary to access the Service.</p>



							<h2>3. YOUR REGISTRATION OBLIGATIONS</h2>

							<p>In consideration of your use of the Service, you represent that you are of legal age to form a binding contract and are not a person barred from receiving services under the laws of the United States or other applicable jurisdiction. You also agree to:

								(a) provide true, accurate, current and complete information about yourself as prompted by the Service's registration form (the "Registration Data") and

								(b) maintain and promptly update the Registration Data to keep it true, accurate, current and complete. If you provide any information that is untrue, inaccurate, not current or incomplete, or <?= $this->base->get_hostname() ?> has reasonable grounds to suspect that such information is untrue, inaccurate, not current or incomplete, <?= $this->base->get_hostname() ?> has the right to suspend or terminate your account and refuse any and all current or future use of the Service (or any portion thereof).</p>

							<p><?= $this->base->get_hostname() ?> is concerned about the safety and privacy of all its users, particularly children. Please remember that the Service is designed to appeal to a broad audience. Accordingly, as the legal guardian, it is your responsibility to determine whether any of the Service areas and/or Content (as defined in Section 6 below) are appropriate for your child.</p>



							<h2>4. <?= $this->base->get_hostname() ?> PRIVACY POLICY</h2>

							<p>Registration Data and certain other information about you is subject to our Privacy Policy. For more information, see our full privacy policy at <?= base_url() ?>/legal.php , You understand that through your use of the Service you consent to the collection and use (as set forth in the Privacy Policy) of this i`nformation, including the transfer of this information to the United States and/or other countries for storage, processing and use by <?= $this->base->get_hostname() ?> and its affiliates.



							</p>
							<h2>5. MEMBER ACCOUNT, PASSWORD AND SECURITY</h2>

							<p>You will receive a password and account designation upon completing the Service's registration process. You are responsible for maintaining the confidentiality of the password and account and are fully responsible for all activities that occur under your password or account. You agree to

								(a) immediately notify <?= $this->base->get_hostname() ?> of any unauthorized use of your password or account or any other breach of security, and

								(b) ensure that you exit from your account at the end of each session. <?= $this->base->get_hostname() ?> cannot and will not be liable for any loss or damage arising from your failure to comply with this Section 5.</p>



							</p>
							<h2>6. MEMBER CONDUCT</h2>

							<p>You understand that all information, data, text, software, music, sound, photographs, graphics, video, messages, tags, or other materials ("Content"), whether publicly posted or privately transmitted, are the sole responsibility of the person from whom such Content originated. This means that you, and not <?= $this->base->get_hostname() ?>, are entirely responsible for all Content that you upload, post, email, transmit or otherwise make available via the Service.</p>
							<p><?= $this->base->get_hostname() ?> does not control the Content posted via the Service and, as such, does not guarantee the accuracy, integrity or quality of such Content. You understand that by using the Service, you may be exposed to Content that is offensive, pornographic, indecent or objectionable. Under no circumstances will <?= $this->base->get_hostname() ?> be liable in any way for any Content, including, but not limited to, any errors or omissions in any Content, or any loss or damage of any kind incurred as a result of the use of any Content posted, emailed, transmitted or otherwise made available via the Service.</p>

							<p>Utilization of the myownfreehost product requires any abuse emails to be forwarded to abuse@<?= $_SERVER['HTTP_HOST'] ?>, or abuse tickets escalating. Failure to comply is a gross violation of these Terms.</p>


							<p><strong>You agree to not use the Service to :</strong></p>

							<p><span>1 | .</span> upload, post, email, transmit or otherwise make available any Content that is unlawful, harmful, threatening, abusive, harassing, tortious, defamatory, vulgar, obscene, libelous, invasive of another's privacy, hateful, or racially, ethnically or otherwise objectionable;</p>
							<p><span>2 | .</span> harm minors in any way;</p>
							<p><span>3 | .</span> impersonate any person or entity, including, but not limited to, a <?= $this->base->get_hostname() ?> official, forum leader, guide or host, or falsely state or otherwise misrepresent your affiliation with a person or entity;</p>
							<p><span>4 | .</span> forge headers or otherwise manipulate identifiers in order to disguise the origin of any Content transmitted through the Service;</p>
							<p><span>5 | .</span> upload, post, email, transmit or otherwise make available any Content that you do not have a right to make available under any law or under contractual or fiduciary relationships (such as inside information, proprietary and confidential information learned or disclosed as part of employment relationships or under nondisclosure agreements);</p>
							<p><span>6 | .</span> upload, post, email, transmit or otherwise make available any Content that infringes any patent, trademark, trade secret, copyright or other proprietary rights ("Rights") of any party; This includes linking to or redirecting to any content or copyright files hosted on a 3rd party resource / servers.</p>
							<p><span>7 | .</span> upload, post, email, transmit or otherwise make available any unsolicited or unauthorized advertising, promotional materials, "junk mail," "spam," "chain letters," "pyramid schemes," or any other form of solicitation, except in those areas (such as shopping) that are designated for such purpose (please read our complete Spam Policy);</p>
							<p><span>8 | .</span> upload, post, email, transmit or otherwise make available any material that contains software viruses or any other computer code, files or programs designed to interrupt, destroy or limit the functionality of any computer software or hardware or telecommunications equipment;</p>
							<p><span>9 | .</span> upload, post, email, transmit or otherwise make available any material that is of broadcast / streaming types.</p>
							<p><span>10 | .</span> upload, post, email, transmit or otherwise make available any material that is of keylogging / proxy service / irc / shell(s) if any type / file hosting / file sharing types.</p>
							<p><span>11 | .</span> upload, post, email, transmit or otherwise make available any material on free hosting accounts that is of pornographic nature. This excludes premium paid hosting accounts (cPanel/WHM hosting accounts).</p>
							<p><span>12 | .</span> interfere with or disrupt the Service or servers or networks connected to the Service, or disobey any requirements, procedures, policies or regulations of networks connected to the Service;</p>
							<p><span>13 | .</span> intentionally or unintentionally violate any applicable local, state, national or international law, including, but not limited to, regulations promulgated by the U.S. Securities and Exchange Commission, any rules of any national or other securities exchange, including, without limitation, the New York Stock Exchange, the American Stock Exchange or the NASDAQ, and any regulations having the force of law;</p>
							<p><span>14 | .</span> provide material support or resources (or to conceal or disguise the nature, location, source, or ownership of material support or resources) to any organization(s) designated by the United States government as a foreign terrorist organization pursuant to section 219 of the Immigration and Nationality Act;</p>
							<p><span>15 | .</span> "stalk" or otherwise harass another; and/or</p>
							<p><span>16 | .</span> upload, post, email, transmit or otherwise material for the purposes of file distribution, relay, or streaming reasons.</p>
							<p><span>17 | .</span> collect or store personal data about other users in connection with the prohibited conduct and activities set forth in paragraphs 1 through 15 above.</p>


							<p><strong>USE OF COPYRIGHT MATERIAL AND PROOF OF OWNERSHIP OF CONTENT</strong></p>

							<p>Sites must not contain Warez, copyright or other illegal material including links or redirects to copyright material hosted on 3rd party websites / resources. The onus is on you the customer to prove that you own the rights to publish material, not for <?= $this->base->get_hostname() ?> to prove that you do not. <?= $this->base->get_hostname() ?> does not allow the propagation or distribution of copyright material, files or warez under any circumstances.</p>

							<p><strong>ACCEPTABLE SERVER RESOURCE USE</strong></p>

							<p>Sites must not use excessive amounts of server resources. These include bandwidth, processor utilization and / or disk space. Please see the 'High Resource Use Policy' in the General Terms and Conditions.</p>



							<p><strong>SCRIPT USAGE TERMS</strong></p>

							<p>Scripts on the site must be designed to produce web-based content, and not to use the server as an application server. Using the server to generate large volumes of email from a database is an example of activity that is not allowed. Scripts should not attempt to manipulate the timeouts on servers. These are set at the present values to ensure the reliability of the server. Sites that reset these do so because they are resource intensive, and adversely affect server performance and are therefore not allowed. Scripts that are designed to provide proxy services, anonymous or otherwise, are not allowed.</p>

							<p>The primary purpose of any script must be to produce a web page. Scripts that send a single email based upon user entered information, or update a database are acceptable. Scripts that send bulk email or perform processor intensive database processes are not allowed. All outgoing mail is monitored and filtered and must be sent to or from a <?= $this->base->get_hostname() ?>-hosted domain.</p>

							<p>Sites must not contain scripts that attempt to access privileged server resources, or other sites on the same server.</p>

							<p><strong>USAGE OF DISK SPACE TERMS</strong></p>

							<p><?= $this->base->get_hostname() ?> offers large web space and bandwidth with hosting accounts. By this, we mean space for legitimate web site content and bandwidth for visitors to view it. All files on a domain must be part of the active website and linked to the site. Sites should not contain any backups, downloads, or other non-web based content. We will treat all password protected archive (e.g. zip and rar) files as unacceptable. Multimedia content such as audio and video is acceptable provided it is streamed to the user, links to HTTP download of this content is not acceptable.</p>

							<p><strong>INODE USAGE</strong></p>
							<p>In computing, an inode is a data structure on a traditional Unix-style file system such as UFS. An inode stores basic information about a regular file, directory, or other file system object.
								en.wikipedia.org/wiki/Inode</p>
							<p><?= $this->base->get_hostname() ?> reserves the right to limit INODEs usage on premium hosting plans to 180,000 and unlimited inodes on Business hosting plans subject to acceptable usage.</p>

							<p><strong>Right to suspend / terminate hosting services</strong></p>

							<p>We reserve the right to suspend or terminate any hosting services if a website/hosting service consumes excessive server resources or effects other websites / hosting services on a shared or clustered hosting server. Excessive resource usage can constitute any form of server usage calculated and determined at the discretion of <?= $this->base->get_hostname() ?>. <?= $this->base->get_hostname() ?> reserves the right to suspend service at any time without prior notice if or when the health or normal running / performance of a service is effected / degraded by a website or hosting service.</p>



							<p>You acknowledge that <?= $this->base->get_hostname() ?> may or may not pre-screen Content, but that <?= $this->base->get_hostname() ?> and its designees shall have the right (but not the obligation) in their sole discretion to pre-screen, refuse, or remove any Content that is available via the Service. Without limiting the foregoing, <?= $this->base->get_hostname() ?> and its designees shall have the right to remove any Content that violates the TOS or is otherwise objectionable. You agree that you must evaluate, and bear all risks associated with, the use of any Content, including any reliance on the accuracy, completeness, or usefulness of such Content. In this regard, you acknowledge that you may not rely on any Content created by <?= $this->base->get_hostname() ?> or submitted to <?= $this->base->get_hostname() ?>, including without limitation information in <?= $this->base->get_hostname() ?> Message Boards and in all other parts of the Service.</p>

							<p>You acknowledge, consent and agree that <?= $this->base->get_hostname() ?> may access, preserve and disclose your account information and Content if required to do so by law or in a good faith belief that such access preservation or disclosure is reasonably necessary to:</p>

							<p>(a) comply with legal process;</p>

							<p>(b) enforce the TOS;</p>

							<p>(c) respond to claims that any Content violates the rights of third parties;</p>

							<p>(d) respond to your requests for customer service; or (e) protect the rights, property or personal safety of <?= $this->base->get_hostname() ?>, its users and the public.</p>

							<p>You understand that the technical processing and transmission of the Service, including your Content, may involve</p>

							<p>(a) transmissions over various networks; and</p>

							<p>(b) changes to conform and adapt to technical requirements of connecting networks or devices.</p>

							<p>You understand that the Service and software embodied within the Service may include security components that permit digital materials to be protected, and that use of these materials is subject to usage rules set by <?= $this->base->get_hostname() ?> and/or content providers who provide content to the Service. You may not attempt to override or circumvent any of the usage rules embedded into the Service. Any unauthorized reproduction, publication, further distribution or public exhibition of the materials provided on the Service, in whole or in part, is strictly prohibited.</p>



							<h2>7. INTERSTATE NATURE OF COMMUNICATIONS ON <?= $this->base->get_hostname() ?> NETWORK</h2>


							<p>When you register with <?= $this->base->get_hostname() ?>, you acknowledge that in using <?= $this->base->get_hostname() ?> services to send electronic communications (including but not limited to email, uploading photos and files and other Internet activities), you will be causing communications to be sent through <?= $this->base->get_hostname() ?>'s computer networks, portions of which are located in California, Ohio, UK, and other locations in the United States and portions of which are located abroad. As a result, and also as a result of <?= $this->base->get_hostname() ?>'s network architecture and business practices and the nature of electronic communications, even communications that seem to be intrastate in nature can result in the transmission of interstate communications regardless of where you are physically located at the time of transmission. Accordingly, by agreeing to this Terms of Service, you acknowledge that use of the service results in interstate data transmissions.</p>



							<h2>8. SPECIAL ADMONITIONS FOR INTERNATIONAL USE</h2>


							<p>Recognizing the global nature of the Internet, you agree to comply with all local rules regarding online conduct and acceptable Content. Specifically, you agree to comply with all applicable laws regarding the transmission of technical data exported from the United States or the country in which you reside.</p>



							<h2>9. CONTENT SUBMITTED OR MADE AVAILABLE FOR INCLUSION ON THE SERVICE</h2>


							<p><?= $this->base->get_hostname() ?> does not claim ownership of Content you submit or make available for inclusion on the Service. However, with respect to Content you submit or make available for inclusion on publicly accessible areas of the Service, you grant <?= $this->base->get_hostname() ?> the following worldwide, royalty-free and non-exclusive license(s), as applicable:</p>

							<p>With respect to Content you submit or make available for inclusion on publicly accessible areas of <?= $this->base->get_hostname() ?> Servers, the license to use, distribute, reproduce, modify, adapt, publicly perform and publicly display such Content on the Service solely for the purposes of providing and promoting the <?= $this->base->get_hostname() ?> Service to which such Content was submitted or made available. This license exists only for as long as you elect to continue to include such Content on the Service and will terminate at the time you remove or <?= $this->base->get_hostname() ?> removes such Content from the Service.</p>
							<p>With respect to photos, graphics, audio or video you submit or make available for inclusion on publicly accessible areas of the Service other than <?= $this->base->get_hostname() ?> Servers, the license to use, distribute, reproduce, modify, adapt, publicly perform and publicly display such Content on the Service solely for the purpose for which such Content was submitted or made available. This license exists only for as long as you elect to continue to include such Content on the Service and will terminate at the time you remove or <?= $this->base->get_hostname() ?> removes such Content from the Service.</p>
							<p>With respect to Content other than photos, graphics, audio or video you submit or make available for inclusion on publicly accessible areas of the Service other than <?= $this->base->get_hostname() ?> Servers, the perpetual, irrevocable and fully sublicensable license to use, distribute, reproduce, modify, adapt, publish, translate, publicly perform and publicly display such Content (in whole or in part) and to incorporate such Content into other works in any format or medium now known or later developed.</p>
							<p>"Publicly accessible" areas of the Service are those areas of the <?= $this->base->get_hostname() ?> network of properties that are intended by <?= $this->base->get_hostname() ?> to be available to the general public. By way of example, publicly accessible areas of the Service would include <?= $this->base->get_hostname() ?> Message Boards and all areas that are open to both members and visitors. However, publicly accessible areas of the Service would not include portions of <?= $this->base->get_hostname() ?> Servers that are limited to members, <?= $this->base->get_hostname() ?> services intended for private communication such as <?= $this->base->get_hostname() ?> Mail or, or areas off of the <?= $this->base->get_hostname() ?> network of properties such as portions of World Wide Web sites that are accessible via hypertext or other links but are not hosted or served by <?= $this->base->get_hostname() ?>.</p>



							<h2>10. CONTRIBUTIONS TO <?= $this->base->get_hostname() ?></h2>


							<p>By submitting ideas, suggestions, documents, and/or proposals ("Contributions") to <?= $this->base->get_hostname() ?> through its forum, or contact forums, you acknowledge and agree that:</p>

							<p>(a) your Contributions do not contain confidential or proprietary information;</p>

							<p>(b) <?= $this->base->get_hostname() ?> is not under any obligation of confidentiality, express or implied, with respect to the Contributions;</p>

							<p>(c) <?= $this->base->get_hostname() ?> shall be entitled to use or disclose (or choose not to use or disclose) such Contributions for any purpose, in any way, in any media worldwide;</p>

							<p>(d) <?= $this->base->get_hostname() ?> may have something similar to the Contributions already under consideration or in development;</p>

							<p>(e) your Contributions automatically become the property of <?= $this->base->get_hostname() ?> without any obligation of <?= $this->base->get_hostname() ?> to you; and</p>

							<p>(f) you are not entitled to any compensation or reimbursement of any kind from <?= $this->base->get_hostname() ?> under any circumstances.</p>



							<h2>11. INDEMNITY</h2>


							<p>You agree to indemnify and hold <?= $this->base->get_hostname() ?> and its subsidiaries, affiliates, officers, agents, employees, partners and licensors harmless from any claim or demand, including reasonable attorneys' fees, made by any third party due to or arising out of Content you submit, post, transmit or otherwise make available through the Service, your use of the Service, your connection to the Service, your violation of the TOS, or your violation of any rights of another.</p>



							<h2>12. NO RESALE OF SERVICE</h2>

							<p>You agree not to reproduce, duplicate, copy, sell, trade, resell or exploit for any commercial purposes, any portion of the Service (including your <?= $this->base->get_hostname() ?> ID), use of the Service, or access to the Service, unless you are a member of the <?= $this->base->get_hostname() ?> Reseller Service, utilising the reselling platform to resell to end users.</p>



							<h2>13. GENERAL PRACTICES REGARDING USE AND STORAGE</h2>

							<p>You acknowledge that <?= $this->base->get_hostname() ?> may establish general practices and limits concerning use of the Service, including without limitation the maximum number of days that idle hosting accounts, message board postings or other uploaded Content will be retained by the Service, the maximum number of email messages that may be sent from or received by an account on the Service, the maximum size of any email message that may be sent from or received by an account on the Service, the maximum disk space that will be allotted on <?= $this->base->get_hostname() ?>'s servers on your behalf, and the maximum number of times (and the maximum duration for which) you may access the Service in a given period of time. You agree that <?= $this->base->get_hostname() ?> has no responsibility or liability for the deletion or failure to store any messages and other communications or other Content maintained or transmitted by the Service. You acknowledge that <?= $this->base->get_hostname() ?> reserves the right to log off accounts that are inactive for an extended period of time. You further acknowledge that <?= $this->base->get_hostname() ?> reserves the right to modify these general practices and limits from time to time.</p>



							<h2>14. MODIFICATIONS TO SERVICE</h2>

							<p><?= $this->base->get_hostname() ?> reserves the right at any time and from time to time to modify or discontinue, temporarily or permanently, the Service (or any part thereof) with or without notice. You agree that <?= $this->base->get_hostname() ?> shall not be liable to you or to any third party for any modification, suspension or discontinuance of the Service.</p>



							<h2>15. TERMINATION</h2>

							<p>You agree that <?= $this->base->get_hostname() ?> may, under certain circumstances and without prior notice, immediately terminate your <?= $this->base->get_hostname() ?> account, any associated email address, and access to the Service. Cause for such termination shall include, but not be limited to,</p>

							<p>(a) breaches or violations of the TOS or other incorporated agreements or guidelines,</p>

							<p>(b) requests by law enforcement or other government agencies,</p>

							<p>(c) a request by you (self-initiated account deletions),</p>

							<p>(d) discontinuance or material modification to the Service (or any part thereof),</p>

							<p>(e) unexpected technical or security issues or problems,</p>

							<p>(f) extended periods of inactivity,</p>

							<p>(g) engagement by you in fraudulent or illegal activities, and/or</p>

							<p>(h) nonpayment of any fees owed by you in connection with the Services.</p>

							<p><strong>Termination of your <?= $this->base->get_hostname() ?> account includes</strong></p>

							<p>(a) removal of access to all offerings within the Service, including but not limited to Hosting accounts, Email Services, SQL databases,</p>

							<p>(b) deletion of your password and all related information, files and content associated with or inside your account (or any part thereof), and</p>

							<p>(c) barring of further use of the Service. Further, you agree that all terminations for cause shall be made in <?= $this->base->get_hostname() ?>'s sole discretion and that <?= $this->base->get_hostname() ?> shall not be liable to you or any third party for any termination of your account, any associated email address, or access to the Service.</p>



							<p>Refund Policy.</p>

							<p>Refunds are issued at the sole discretion of <?= $this->base->get_hostname() ?> Internet. <?= $this->base->get_hostname() ?> Internet reserves the right not to issue a refund. Customer agrees that hosting payments are NONREFUNDABLE. For example, if Customer submits payment for twelve (12) months of service, service will be provided for twelve (12) months and will not be refunded if customer chooses to discontinue service with <?= $this->base->get_hostname() ?> mid-way through the term. Payments which are deemed to be fraud which can be verfied and certain to be fraud are elligable to a refund, subject to the terms and conditions of the payment provider such as PayPal or 2Checkout.</p>

							<h2>16. DEALINGS WITH ADVERTISERS</h2>

							<p></p>Your correspondence or business dealings with, or participation in promotions of, advertisers found on or through the Service, including payment and delivery of related goods or services, and any other terms, conditions, warranties or representations associated with such dealings, are solely between you and such advertiser. You agree that <?= $this->base->get_hostname() ?> shall not be responsible or liable for any loss or damage of any sort incurred as the result of any such dealings or as the result of the presence of such advertisers on the Service.<p></p>



							<h2>17. LINKS</h2>

							<p>The Service may provide, or third parties may provide, links to other World Wide Web sites or resources. Because <?= $this->base->get_hostname() ?> has no control over such sites and resources, you acknowledge and agree that <?= $this->base->get_hostname() ?> is not responsible for the availability of such external sites or resources, and does not endorse and is not responsible or liable for any Content, advertising, products or other materials on or available from such sites or resources. You further acknowledge and agree that <?= $this->base->get_hostname() ?> shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such Content, goods or services available on or through any such site or resource.</p>



							<h2>18. MAXIMUM FREE HOSTING ACCOUNTS PER PERSON</h2>

							<p>Three free hosting accounts are allowed per person. Registering more than three accounts is considered abuse and will result in all accounts being terminated without notice.</p>



							<h2>19. <?= $this->base->get_hostname() ?>'S PROPRIETARY RIGHTS</h2>

							<p>You acknowledge and agree that the Service and any necessary software used in connection with the Service ("Software") contain proprietary and confidential information that is protected by applicable intellectual property and other laws. You further acknowledge and agree that Content contained in sponsor advertisements or information presented to you through the Service or by advertisers is protected by copyrights, trademarks, service marks, patents or other proprietary rights and laws. Except as expressly authorized by <?= $this->base->get_hostname() ?> or advertisers, you agree not to modify, rent, lease, loan, sell, distribute or create derivative works based on the Service or the Software, in whole or in part.</p>



							<h2>20 FREE DOMAIN WITH PAID HOSTING</h2>

							<p>Free domain names which are included with Paid Hosting accounts are the property of <?= $this->base->get_hostname() ?> Internet. <?= $this->base->get_hostname() ?> will always retain ownership of free domain names we register. If requested, <?= $this->base->get_hostname() ?> will allow the 'transfer' any free domains to an alternative hosting provider if a transfer administration fee is paid, which amounts to $29.99. If the service has been provisioned for over 12 months or sooner <?= $this->base->get_hostname() ?> may waiver the above mentioned transfer fee. <?= $this->base->get_hostname() ?> reserves the right to cancel / transfer domain names which are provided with paid hosting accounts. We reserve the right to renew or allow the expiration of domain names we register.</p>

							<p>The .INFO domain name provided with the 'monthly standard' and 'monthly ultimate' premium plan is free for the 1st year only, to keep the domain after the 1st year, a renewal fee needs to be paid. (This is a separate additional payment to the monthly payments for the hosting) To renew the INFO domain name, we require a payment of $11.00 USD to cover the cost of renewing the domain with the registrars.</p>

							<p>19b. MYOWNFREEHOST RESELLER PAID PLAN LINKS</p>

							<p>MyOwnFreeHost.net resellers are required to have paid hosting plan links to <?= base_url() ?> present in a visible location on the reseller domain home page. <?= $this->base->get_hostname() ?> reserves the right to suspend and cancel resellers who do not have the paid plan links to <?= base_url() ?>. Resellers are entitled to use the securesignup affiliate program for paid plan links.</p>

							<p>MyOwnFreeHost.net resellers using plan 3 or above may remove the paid plan links and are exempt from the requirement for placing paid plan links.</p>

							<p>19c. USE OF ADVERT BLOCKERS</p>

							<p><?= $this->base->get_hostname() ?> may use adverts to subsidize the costs of running the service, the use of advert blockers, or the process of recommending advert blockers whilst using the service is forbidden. Violation will result in termination.</p>



							<h2>21. DISCLAIMER OF WARRANTIES</h2>

							<p>YOU EXPRESSLY UNDERSTAND AND AGREE THAT:</p>

							<p>1. YOUR USE OF THE SERVICE IS AT YOUR SOLE RISK. THE SERVICE IS PROVIDED ON AN "AS IS" AND "AS AVAILABLE" BASIS. <?= $this->base->get_hostname() ?> AND ITS SUBSIDIARIES, AFFILIATES, OFFICERS, EMPLOYEES, AGENTS, PARTNERS AND LICENSORS EXPRESSLY DISCLAIM ALL WARRANTIES OF ANY KIND, WHETHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT.</p>

							<p>2. <?= $this->base->get_hostname() ?> AND ITS SUBSIDIARIES, AFFILIATES, OFFICERS, EMPLOYEES, AGENTS, PARTNERS AND LICENSORS MAKE NO WARRANTY THAT (i) THE SERVICE WILL MEET YOUR REQUIREMENTS; (ii) THE SERVICE WILL BE UNINTERRUPTED, TIMELY, SECURE OR ERROR-FREE; (iii) THE RESULTS THAT MAY BE OBTAINED FROM THE USE OF THE SERVICE WILL BE ACCURATE OR RELIABLE; (iv) THE QUALITY OF ANY PRODUCTS, SERVICES, INFORMATION OR OTHER MATERIAL PURCHASED OR OBTAINED BY YOU THROUGH THE SERVICE WILL MEET YOUR EXPECTATIONS; AND (v) ANY ERRORS IN THE SOFTWARE WILL BE CORRECTED.</p>

							<p>3. ANY MATERIAL DOWNLOADED OR OTHERWISE OBTAINED THROUGH THE USE OF THE SERVICE IS ACCESSED AT YOUR OWN DISCRETION AND RISK, AND YOU WILL BE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER SYSTEM OR LOSS OF DATA THAT RESULTS FROM THE DOWNLOAD OF ANY SUCH MATERIAL.</p>

							<p>4. NO ADVICE OR INFORMATION, WHETHER ORAL OR WRITTEN, OBTAINED BY YOU FROM <?= $this->base->get_hostname() ?> OR THROUGH OR FROM THE SERVICE SHALL CREATE ANY WARRANTY NOT EXPRESSLY STATED IN THE TOS.</p>

							<p>5. A SMALL PERCENTAGE OF USERS MAY EXPERIENCE EPILEPTIC SEIZURES WHEN EXPOSED TO CERTAIN LIGHT PATTERNS OR BACKGROUNDS ON A COMPUTER SCREEN OR WHILE USING THE SERVICE. CERTAIN CONDITIONS MAY INDUCE PREVIOUSLY UNDETECTED EPILEPTIC SYMPTOMS EVEN IN USERS WHO HAVE NO HISTORY OF PRIOR SEIZURES OR EPILEPSY. IF YOU, OR ANYONE IN YOUR FAMILY, HAVE AN EPILEPTIC CONDITION, CONSULT YOUR PHYSICIAN PRIOR TO USING THE SERVICE. IMMEDIATELY DISCONTINUE USE OF THE SERVICE AND CONSULT YOUR PHYSICIAN IF YOU EXPERIENCE ANY OF THE FOLLOWING SYMPTOMS WHILE USING THE SERVICE: DIZZINESS, ALTERED VISION, EYE OR MUSCLE TWITCHES, LOSS OF AWARENESS, DISORIENTATION, ANY INVOLUNTARY MOVEMENT, OR CONVULSIONS.</p>



							<h2>22.LIMITATION OF LIABILITY</h2>

							<p>YOU EXPRESSLY UNDERSTAND AND AGREE THAT <?= $this->base->get_hostname() ?> AND ITS SUBSIDIARIES, AFFILIATES, OFFICERS, EMPLOYEES, AGENTS, PARTNERS AND LICENSORS SHALL NOT BE LIABLE TO YOU FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL OR EXEMPLARY DAMAGES, INCLUDING, BUT NOT LIMITED TO, DAMAGES FOR LOSS OF PROFITS, GOODWILL, USE, DATA OR OTHER INTANGIBLE LOSSES (EVEN IF <?= $this->base->get_hostname() ?> HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES), RESULTING FROM: (i) THE USE OR THE INABILITY TO USE THE SERVICE; (ii) THE COST OF PROCUREMENT OF SUBSTITUTE GOODS AND SERVICES RESULTING FROM ANY GOODS, DATA, INFORMATION OR SERVICES PURCHASED OR OBTAINED OR MESSAGES RECEIVED OR TRANSACTIONS ENTERED INTO THROUGH OR FROM THE SERVICE; (iii) UNAUTHORIZED ACCESS TO OR ALTERATION OF YOUR TRANSMISSIONS OR DATA; (iv) STATEMENTS OR CONDUCT OF ANY THIRD PARTY ON THE SERVICE; OR (v) ANY OTHER MATTER RELATING TO THE SERVICE.</p>



							<h2>23. EXCLUSIONS AND LIMITATIONS</h2>

							<p>SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF CERTAIN WARRANTIES OR THE LIMITATION OR EXCLUSION OF LIABILITY FOR INCIDENTAL OR CONSEQUENTIAL DAMAGES. ACCORDINGLY, SOME OF THE ABOVE LIMITATIONS OF SECTIONS 19 AND 20 MAY NOT APPLY TO YOU.</p>



							<h2>24. SPECIAL ADMONITION FOR SERVICES RELATING TO FINANCIAL MATTERS</h2>

							<p>If you intend to create or join any service, receive or request any news, messages, alerts or other information from the Service concerning companies, stock quotes, investments or securities, please read the above Sections 19 and 20 again. They go doubly for you. In addition, for this type of information particularly, the phrase "Let the investor beware" is apt. The Service is provided for informational purposes only, and no Content included in the Service is intended for trading or investing purposes. <?= $this->base->get_hostname() ?> and its licensors shall not be responsible or liable for the accuracy, usefulness or availability of any information transmitted or made available via the Service, and shall not be responsible or liable for any trading or investment decisions based on such information.</p>



							<h2>25. NO THIRD-PARTY BENEFICIARIES</h2>

							<p>You agree that, except as otherwise expressly provided in this TOS, there shall be no third-party beneficiaries to this agreement.</p>



							<h2>26. NOTICE</h2>

							<p><?= $this->base->get_hostname() ?> may provide you with notices, including those regarding changes to the TOS, by email, regular mail or postings on the Service.</p>



							<h2>27. TRADEMARK INFORMATION</h2>

							<p>The <?= $this->base->get_hostname() ?>, <?= $this->base->get_hostname() ?> logo, <?= $this->base->get_hostname() ?> (in Chinese characters), trademarks and service marks and other <?= $this->base->get_hostname() ?> logos and product and service names are trademarks of <?= $this->base->get_hostname() ?> (the "<?= $this->base->get_hostname() ?> Marks"). Without <?= $this->base->get_hostname() ?>'s prior permission, you agree not to display or use in any manner the <?= $this->base->get_hostname() ?> Marks.</p>



							<h2>28. NOTICE AND PROCEDURE FOR MAKING CLAIMS OF COPYRIGHT OR INTELLECTUAL PROPERTY INFRINGEMENT</h2>

							<p><?= $this->base->get_hostname() ?> respects the intellectual property of others, and we ask our users to do the same. <?= $this->base->get_hostname() ?> may, in appropriate circumstances and at its discretion, disable and/or terminate the accounts of users who may be repeat infringers. If you believe that your work has been copied in a way that constitutes copyright infringement, or your intellectual property rights have been otherwise violated, please provide <?= $this->base->get_hostname() ?>'s Copyright Agent the following information :</p>

							<p>an electronic or physical signature of the person authorized to act on behalf of the owner of the copyright or other intellectual property interest;</p>
							<p>a description of the copyrighted work or other intellectual property that you claim has been infringed;</p>
							<p>a description of where the material that you claim is infringing is located on the site;</p>
							<p>your address, telephone number, and email address;</p>
							<p>a statement by you that you have a good faith belief that the disputed use is not authorized by the copyright owner, its agent, or the law;</p>
							<p>a statement by you, made under penalty of perjury, that the above information in your Notice is accurate and that you are the copyright or intellectual property owner or authorized to act on the copyright or intellectual property owner's behalf.</p>


							<p><?= $this->base->get_hostname() ?>'s Agent for Notice of claims of copyright or other intellectual property infringement can be reached as follows:</p>

							<p>By mail:</p>
							<p>Copyright Agent</p>

							<h2>29. GENERAL INFORMATION</h2>

							<p>Entire Agreement.</p>

							<p>The TOS constitutes the entire agreement between you and <?= $this->base->get_hostname() ?> and governs your use of the Service, superseding any prior agreements between you and <?= $this->base->get_hostname() ?> with respect to the Service. You also may be subject to additional terms and conditions that may apply when you use or purchase certain other <?= $this->base->get_hostname() ?> services, affiliate services, third-party content or third-party software.</p>



							<p>Choice of Law and Forum.</p>

							<p>The TOS and the relationship between you and <?= $this->base->get_hostname() ?> shall be governed by the laws of the United Kingdom without regard to its conflict of law provisions. You and <?= $this->base->get_hostname() ?> agree to submit to the personal and exclusive jurisdiction of the courts located within the county of Northumberland, United Kingdom.</p>



							<p>Waiver and Severability of Terms.</p>

							<p>The failure of <?= $this->base->get_hostname() ?> to exercise or enforce any right or provision of the TOS shall not constitute a waiver of such right or provision. If any provision of the TOS is found by a court of competent jurisdiction to be invalid, the parties nevertheless agree that the court should endeavor to give effect to the parties' intentions as reflected in the provision, and the other provisions of the TOS remain in full force and effect.</p>



							<p>No Right of Survivorship and Non-Transferability.</p>

							<p>You agree that your <?= $this->base->get_hostname() ?> account is non-transferable and any rights to your <?= $this->base->get_hostname() ?> ID or contents within your account terminate upon your death. Upon receipt of a copy of a death certificate, your account may be terminated and all contents therein permanently deleted.</p>



							<p>Statute of Limitations.</p>

							<p>You agree that regardless of any statute or law to the contrary, any claim or cause of action arising out of or related to use of the Service or the TOS must be filed within one (1) year after such claim or cause of action arose or be forever barred.</p>

							<p>The section titles in the TOS are for convenience only and have no legal or contractual effect.</p>



							<h2>30. VIOLATIONS</h2>

							<p><strong>Please report any violations of the TOS to abuse@<?= $_SERVER['HTTP_HOST'] ?>.</strong></p>
						</div>
						<div id="Policy" class="tab-content">
							<h2><?= $this->base->get_hostname() ?> Ltd. Privacy Statement</h2>
							<p><?= $this->base->get_hostname() ?> Ltd. cares about and respects your privacy. For this reason, we collect and use personal data only as it might be needed for us to deliver to you our products, services and websites (collectively, our "Services"). Your personal data includes information such as:</p>

							<ul>
								<li>Name</li>
								<li>Address</li>
								<li>Telephone number</li>
								<li>Date of birth</li>
								<li>Email address</li>
								<li>Other data collected that could directly or indirectly identify you</li>
							</ul>

							<p>Our Privacy Policy is intended to describe to you how and what data we collect, and how and why we use your personal data. It also describes options we provide for you to access, update or otherwise take control of your personal data that we process.</p>

							<p>If at any time you have questions about our practices or any of your rights described below, you may reach our Data Protection Officer ("DPO") and our dedicated team by contacting us at <a href="<?= $this->base->get_email() ?>/"><?= $this->base->get_email() ?></a>. This inbox is actively monitored and managed so that we can provide you with information you can confidently trust.</p>

							<p>We have also have a ticket system to provide answers to your most common questions, additional instructions on how to exercise rights that might be available to you, documentation you may need, and definitions to key terms and concepts in this Privacy Policy.</p>

							<h2>What information do we collect?</h2>
							<p>We collect information to provide the best possible experience when you use our Services. Much of what you consider personal data is collected directly from you when you:</p>

							<ol>
								<li> create an account or purchase any of our Services (e.g.: billing information, including name, address, and credit card number);</li>
								<li>request assistance from our Customer Services team (e.g.: telephone number);</li>
								<li>complete contact forms or request newsletters or other information from us (e.g.: email courses, e-books, or emails); or</li>
								<li>participate in contests and surveys, apply for a job, or otherwise participate in activities we promote that might require information about you.</li>
							</ol>

							<p>However, we also collect additional information when delivering our Services to you to ensure necessary and optimal performance. These methods of collection may not be as obvious, so we wanted to explain what these might be (as they vary from time to time) and how they work:</p>

							<p><strong>Account related information</strong> is collected in association with your use of our Services, such as account number, products you have purchased, when products renew or expire, information requests, support requests, and notes or details on our interactions.</p>

							<p><strong>Cookies and similar technologies</strong> on our websites allow us to track your browsing behaviour, links clicked, items purchased, and your device types. They also allow us to collect data (including analytics) about how you use and interact with our Services. This allows us to provide you with more relevant product offerings, a better experience on our sites and mobile applications, and to collect, analyse, and improve the performance of our Services. We may also collect your location via Internet Protocol (IP) address, so that we can personalise our Services. </p>

							<p><strong>Data about Usage of Services</strong> is automatically collected when you use and interact with our Services, including metadata, log files, cookie/device IDs, and location information. This information includes specific data about your interactions with the features, content, and links (including third-parties, such as social media plugins) contained within the Services, IP address, browser type and settings (including configuration and plug-ins), the date and time the Services were used, language preferences and cookie data, and information about devices accessing the Services, including type of device, what operating system is used, device settings, application IDs, unique device identifiers, and error data. Some of this data collected might be capable of and be used to approximate your location. </p>

							<p><strong>Supplemented Data</strong> may be received about you from other sources, including publicly available databases or third parties from whom we have purchased data, in which case we may combine this data with information we already have about you so that we can update, expand, and analyse the accuracy of our records, identify new customers, and provide products and services that may be of interest to you. If you provide us personal information about others, or if others give us your information, we will only use that information for the specific reason for which it was provided to us.</p>

							<h2>How we use information.</h2>

							<p>We strongly believe in both reducing the amount of data we collect and limiting the use and purpose of that data to only:</p>

							<ol>
								<li>Data for which we have been given permission</li>
								<li>Data necessary to deliver the Services you purchase or interact with</li>
								<li>Data we might be required or permitted to keep for legal compliance or other lawful purposes.</li>
							</ol>

							<p>These uses include: <strong>Delivering, improving, updating, and enhancing the Services we provide to you</strong>. We collect information relating to your purchase, use, and/or interactions with our Services. We utilise this information to:</p>

							<ul>
								<li>Improve and optimise the operation and performance of our Services (again, including our websites and mobile applications)</li>
								<li>Diagnose problems with and identify any security risks, errors, or needed enhancements to the Services</li>
								<li>Detect and prevent fraud and abuse of our Services and systems</li>
								<li>Collecting aggregate statistics about use of the Services</li>
								<li>Understand and analyse how you use our Services and what products and services are most relevant to you.</li>
							</ul>

							<p>Often, much of the data we collect is aggregated or statistical data about how individuals use our Services, and is not linked to any personal data., But as it is itself personal data, or it can be linked or linkable to personal data, we treat it accordingly. </p>

							<p><strong>Sharing with trusted third parties</strong>. We may share your personal data with affiliated companies within our corporate family, with third parties with which we have partnered to allow you to integrate their services into our own Services, and with trusted third-party service providers as necessary for them to perform services on our behalf, such as:</p>

							<ul>
								<li>Processing credit card payments</li>
								<li>Serving advertisements</li>
								<li>Conducting contests or surveys</li>
								<li>Performing analysis of our Services and customer demographics</li>
								<li>Communicating with you, such as by way email or survey delivery</li>
								<li>Customer relationship management.</li>
							</ul>

							<p>We only share your personal data as necessary for any third party to provide the services as requested or as needed on our behalf. These third parties (and any subcontractors) are subject to strict data processing terms and conditions and are prohibited from utilising, sharing or retaining your personal data for any purpose other than as they have been specifically contracted for (or without your consent). For further information on our sub-processors please refer to <strong><a href="https://<?= base_url() ?>/ThirdPartyDataProcessors.pdf" target="_blank">our list of Third-Party Data Processors</a>.</strong></p>

							<p><strong>Communicating with you.</strong> We may contact you directly, or through a third-party service provider, regarding products or services you have signed up or purchased from us, such as necessary to deliver transactional or service related communications. We may also contact you with offers for additional services we think you'll find valuable if you give us consent, or where allowed based upon legitimate interests. You don't need to provide consent as a condition to purchase our goods or services. These contacts may include:</p>

							<ul>
								<li>Email</li>
								<li>Text (SMS) messages</li>
								<li>Telephone calls</li>
								<li>Automated phone calls or text messages.</li>
							</ul>

							<p>You may also update your subscription preferences with respect to receiving communications from us and/or our partners by making a support ticket at <?= $this->base->get_email() ?> or by using the support links in your control panel. </p>

							<p>If we collect information from you in connection with a co-branded offer, it will be clear at the point of collection who is collecting the information and whose privacy policy applies. In addition, it will describe any options you have in regards to the use and/or sharing of your personal data with a co-branded partner, as well as how to exercise those options.</p>

							<p>If you make use of a service that allows you to import contacts (e.g. using email marketing services to send emails on your behalf), we will only use the contacts and any other personal information needed for the requested service. If you believe that anyone has provided us with your personal information and you would like to request that it be removed from our database, please contact us at <?= $this->base->get_email() ?></p>

							<p><strong>Transfer of personal data abroad.</strong> If you utilise our Services from a country other than the country where our servers are located, your communications with us may result in transferring your personal data across international borders. Also, when you call us or initiate a chat, we may provide you with support from one of our global locations outside your country of origin. Your personal data will be transferred and processed outside of the EEA. In these cases, your personal data is handled according to this Privacy Policy.</p>

							<p><strong>Compliance with legal, regulatory and law enforcement requests.</strong> We cooperate with government and law enforcement officials and private parties to enforce and comply with the law. We will disclose any information about you to government or law enforcement officials or private parties as we, in our sole discretion, believe necessary or appropriate to respond to claims and legal process (such as subpoena requests), to protect our property and rights or the property and rights of a third party, to protect the safety of the public or any person, or to prevent or stop activity we consider to be illegal or unethical.</p>

							<p>To the extent we are legally permitted to do so, we will take reasonable steps to notify you in the event that we are required to provide your personal information to third parties as part of legal process. We will also share your information to the extent necessary to comply with ICANN or any ccTLD rules, regulations, and policies when you register a domain name with us.</p>

							<p><strong>Website analytics.</strong> We use multiple web analytics tools provided by service partners such as Google Analytics and Statcounter.com to collect information about how you interact with our website or mobile applications, including what pages you visit, what site you visited prior to visiting our website, how much time you spend on each page, what operating system and web browser you use, and network and IP information. We use the information provided by these tools to improve our Services. </p>

							<p>These tools place persistent cookies in your browser to identify you as a unique user the next time you visit our website. Each cookie cannot be used by anyone other than the service provider (eg: Facebook and Google for Google Analytics). The information collected from the cookie may be transmitted to and stored by these service partners on servers in a country other than the country in which you reside. Though information collected does not include personal data such as name, address, billing information, etc., the information collected is used and shared by these service providers in accordance with their individual privacy policies. </p>

							<p>You can control the technologies we use by utilising settings in your browser or third-party tools, such as <a href="https://disconnect.me/disconnect" target="_blank">Disconnect</a>, <a href="https://www.ghostery.com/" target="_blank">Ghostery</a> and others.</p>
							<p><strong>Targeted advertisements.</strong> Targeted ads or interest-based offers may be presented to you based on your activities on our webpages and other websites, and based on the products you currently own. These offers will display as varying product banners presented to you while browsing. We also partner with third parties to manage our advertising on our webpages and other websites such as Facebook, Twitter, Google, and Microsoft. Our third-party partners may use technologies such as cookies to gather information about such activities in order to provide you with advertising based upon your browsing activities and interests, and to measure advertising effectiveness. If you wish to opt out of interest-based advertising in the European Union, please visit <a href="http://www.youronlinechoices.eu/" target="_blank">youronlinechoices.eu</a>. Please note, you will continue to receive generic ads.</p>

							<p><strong>Third-party websites.</strong> Our website and our mobile applications contain links to third-party websites. We are not responsible for the privacy practices or the content of third-party sites. Please read the privacy policy of any website you visit.</p>
							<br>
							<p>If you have an unresolved privacy or data use concern that we have not addressed satisfactorily, please contact our head office at <?= $this->base->get_hostname() ?> LTD, Bulman House, Regent Centre, Gosforth, Newcastle upon Tyne, NE3 3LS, you may invoke binding arbitration when other dispute resolution procedures have been exhausted.</p>

							<h2>How you can access, update or delete your data.</h2>
							<p>To easily access, view, update, delete, or port your personal data (where available), or to update your subscription preferences, please sign into your Account and visit "Edit Account Details." Please contact us at <?= $this->base->get_email() ?> for additional information and guidance for accessing, updating, or deleting data. </p>

							<p>If you make a request to delete your personal data and that data is necessary for the products or services you have purchased, the request will be honoured only to the extent it is no longer necessary for any Services purchased or required for our legitimate business purposes or legal or contractual record keeping requirements.</p>

							<p>If you are unable for any reason to access your Account Settings, you may also contact us by one of the methods described in the "Contact Us" section below. </p>

							<h2>How we secure, store, and retain your data.</h2>
							<p>We follow generally accepted standards to store and protect the personal data we collect, both during transmission and once received and stored, including utilisation of encryption where appropriate.</p>

							<p>We retain personal data only for as long as necessary to provide the Services you have requested and thereafter for a variety of legitimate legal or business purposes. These might include retention periods:</p>

							<ul>
								<li>mandated by law, contract, or similar obligations applicable to our business operations;</li>
								<li>for preserving, resolving, defending, or enforcing our legal/contractual rights; or</li>
								<li>needed to maintain adequate and accurate business and financial records.</li>
							</ul>

							<p>If you have any questions about the security or retention of your personal data, you can contact us at <?= $this->base->get_email() ?>.</p>

							<h2>'Do Not Track' notifications.</h2>
							<p>Some browsers allow you to automatically notify websites you visit not to track you using a "Do Not Track" signal. There is no consensus among industry participants as to what "Do Not Track" means in this context. Like many websites and online services, we currently do not alter our practices when we receive a "Do Not Track" signal from a visitor's browser. To find out more about "Do Not Track," you may wish to visit <a href="https://allaboutdnt.com/" target="_blank">www.allaboutdnt.com</a>.</p>

							<h2>Age restrictions.</h2>
							<p>Our Services are available for purchase only for those over the age of 16. Our Services are not targeted to, intended to be consumed by or designed to entice individuals under the age of 16. If you know of or have reason to believe anyone under the age of 16 has provided us with any personal data, please contact us.</p>

							<h2>Changes in our Privacy Policy.</h2>
							<p>We reserve the right to modify this Privacy Policy at any time. If we decide to change our Privacy Policy, we will post those changes to this Privacy Policy and any other places we deem appropriate, so that you are aware of what information we collect, how we use it, and under what circumstances, if any, we disclose it. If we make material changes to this Privacy Policy, we will notify you here, by email, or by means of a notice on our home page, at least thirty (30) days prior to the implementation of the changes.</p>

							<h2>Data Protection Authority.</h2>
							<p><?= $this->base->get_hostname() ?> Ltd. is the data controller for <?= base_url() ?> and is registered on the Information Commissioner's Office's Register of Data Controllers under number (A8382659).You may direct questions or complaints in respect of how we handle your Personal Data to the Information Commissioner's Office: </p>

							<p><a href="https://ico.org.uk/" target="_blank">www.ico.org.uk</a></p>
							<p>Information Commissioner's Office, Wycliffe House, Water Lane, Wilmslow, Cheshire, SK9 5AF</p>
							<p>Phone: 0303 123 1113</p>
							<h2>Contact us.</h2>

							<p>If you have any questions, concerns or complaints about our Privacy Policy, our practices, or our Services, you may contact our Office of the DPO by contacting us at <?= $this->base->get_email() ?>. In the alternative, you may contact us by either of the following means:</p>
							<ul>
								<li><strong>By Mail:</strong> Attn: Office of the Data Protection Officer, <?= $this->base->get_hostname() ?> Ltd. Bulman House, Regent Centre, Gosforth, Newcastle upon Tyne, NE3 3LS </li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<p class="text-muted text-center py-2">
				&copy; Copyright <?= date('Y') ?>. Powered by NxNetwork Ltd.
			</p>
		</div>
	</div>
	<script type="text/javascript">
		var tabs = document.getElementsByClassName("tab-item");
		var i, tablinks, tabcontent;
		for (i = 0; i < tabs.length; i++) {
			tabs[i].onclick = function() {
				var tabu = this.getAttribute("data-tab");
				var tabr = document.getElementById(tabu);
				tabcontent = document.getElementsByClassName("tab-content");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tab-item");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}
				tabr.style.display = "block";
				this.classList.add("active");
			}
		}
		window.onload = function() {
			document.getElementById('DefaultClicked').click();
		}
	</script>
</body>

</html>