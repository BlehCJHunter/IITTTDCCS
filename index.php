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
            <h2>Clinical Coding System</h2>
            <h3>Project: Automating the Clinical Coding System</h3>
            <br>
            <p>Public hospitals in Queensland and other Australian states receive funding from Medicare and other government bodies on a per-patient-per-procedure basis (QLD Health 2018). For funding to be allocated correctly to each hospital, the procedures undertaken on a per-patient basis must be recorded and remitted to Medicare or the relevant funding body in a timely fashion. The current procedure for recording and remitting this information, called clinical coding, is extremely manual and time-consuming. This task involves an administrative worker reviewing patient charts and practitioner/nurse notes to determine what the medical condition was, which procedures were performed, and what materials were used in the process. Each condition and procedure is then assigned a code based on the Australian clinical coding standard ICD-10-AM; for example, P59.9 Jaundice in newborn (IHPA 2019). At times critical information such as the condition or procedure can be up to interpretation, due to complexity or inability to decipher clinician handwriting.</p>
            <p>Where small hospitals may be able to keep up with procedures using this manual method, large hospitals require a clinical coding team to process the many procedures performed daily. This project proposes an automated system for clinical coding, that operates supplementarily to paper charts, whereby clinicians enter procedure details directly into a computerised system which will automatically code said procedure and produce a summary of codes ready for remittal to Medicare. The final iteration of this system, beyond the scope of this project, will also augment the point of care experience for practitioners by providing easy access to a patient’s medical history and highlighting considerations for current and future care of the patient. When available for use in a healthcare environment, this system will reduce time spent reviewing patient charts and prevent miscoding due misinterpreted practitioner notes, and has the potential to provide a higher standard of care at the bedside and reduction in adverse reactions due to unknown allergies or concomitant medications. This will provide real value to hospitals in the form of increased efficiency and decreased manual labour, and the potential for shorter post-procedural admission times, thus increasing bed availability.</p>
        </main>
        <footer>
            <ul>
                <li><a href="mailto:s3807909@student.rmit.edu">Contact us</a></li>
            </ul>
        </footer>
    </body>
</html>