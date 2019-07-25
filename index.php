<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Welcome to The Thing Doers Website</title>
        <meta name="description" content="This website exists as a proof of concept for an Automated Clinical Coding System">
        <meta name="keywords" content="clinical coding system, proof of concept">
        <meta name="author" content="Brendan, Callum, Jess, Joe, Michael, Won">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="css/baseStyle.css">
	<style type="text/css">
	<!--
	body			{margin:0; background-color:#eee;}
	main			{padding:25px 0 25px 0; background-color:#fff;}
	h1			{padding:0px 10px 0px 10px;}
	header h1		{text-align:center;}
	h2, h3			{padding:15px 25px 0px 25px;}
	p			{padding:10px 2em 0px 2em; text-align:justify}
	-->
	</style>
    </head>
    <body>
        <header>
            <h1><br><br>The Thing Doers</h1>
        </header>
<?php include 'includes/nav.php';?>
        <main>
            <h1><a href="./login.php"> Quick and dirty test link to login.php </a>
            <h2>Into to the Clinical Coding System</h2>
            <h3>Forward</h3>
            <p>This group project is building on the initial project idea developed by Brendan and available for viewing here: https://brendan6780.github.io/ProjectIdea.html. Further adaptations by ‘The Thing Doers’, such as incorporation of additional functionalities and production of a UI wireframe, are discussed in the  section ‘Further Considerations for Development by The Thing Doers’.</p>
            <br>
            <h3>Background</h3>
            <p>Public hospitals in Queensland and other Australian states receive funding from Medicare and other government bodies on a per-patient-per-procedure basis (QLD Health 2018). For funding to be allocated correctly to each hospital, the procedures undertaken on a per-patient basis must be recorded and remitted to Medicare or the relevant funding body in a timely fashion. The current procedure for recording and remitting this information, called clinical coding, is extremely manual and time-consuming. This task involves an administrative worker reviewing patient charts and practitioner/nurse notes to determine what the medical condition was, which procedures were performed, and what materials were used in the process. Each condition and procedure is then assigned a code based on the Australian clinical coding standard ICD-10-AM; for example, P59.9 Jaundice in newborn (IHPA 2019). At times critical information such as the condition or procedure can be up to interpretation, due to complexity or inability to decipher clinician handwriting.</p>
            <p>Where small hospitals may be able to keep up with procedures using this manual method, large hospitals require a clinical coding team to process the many procedures performed daily. This project proposes an automated system for clinical coding, whereby clinicians enter procedure details directly into a patient’s electronic chart (where in practice by the hospital) or into a stand-alone application, either of which will automatically code said procedure and produce a summary of codes ready for remittal to Medicare. This system will reduce time spent reviewing patient charts and prevent miscoding due misinterpreted practitioner notes.</p>
        </main>
        <footer>
            <ul>
                <li><a href="mailto:s3807909@student.rmit.edu">Contact us</a></li>
            </ul>
        </footer>
    </body>
</html>