<?php
session_start();
//ADD TO DATABASE

//$fileNameRaw = $_POST['fileName'];
//$fileNameClean = $title = str_replace( array( '\'', '"', ',' , '-', '.', '>' ), ' ', $fileNameRaw);
//$fileNameNum = preg_replace('/[0-9]+/', '', $fileNameClean);
//$fileNameSpace = str_replace(' ','',$fileNameNum);
//$fileName= substr_replace($fileNameSpace, "", -3);

//$fileName ='manifestsProjectXS';
$path = 'uploadsUnzipped/'.$fileName.'/';
$files = array_values(array_filter(scandir($path), function($file) use ($path) {
    return !is_dir($path . '/' . $file);
}));


// ---------NAME OF EXTENSIONS----------
$totalNameExtension ='';
$nTotalNumberExtension = 0;
$nTotalNoNameExtension = 0;
$nTotalNameExtension = 0;
foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    if ((strpos($nameExtension, "name")) ){
        $nTotalNoNameExtension = $nTotalNoNameExtension +1;
    } else {
        $nTotalNameExtension = $nTotalNameExtension + 1;

    }

    $nTotalNumberExtension = $nTotalNumberExtension + 1;
    $totalNameExtension = $totalNameExtension.$nameExtension. '/';
}
//echo $nTotalNoNameExtension;
//echo "<br>";
//echo $nTotalNameExtension;
//echo "<br>";
//echo $nTotalNumberExtension;

//echo "All the names of the extensions analysed: ".$totalNameExtension;
//echo "<br>";
//echo "<br>";

// ---------MANIFEST VERSION----------
$nErrorsManifest =0;
$nGoodManifest =0;
$manifestErrors='';
$manifestPass = '';

foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    //Manifest Handling
    $manifestVersion = addslashes($obj->manifest_version);
    if ($manifestVersion != '2'){
        $nErrorsManifest= $nErrorsManifest + 1;
        $manifestErrors = $manifestErrors.$file.'/';
    } else {
        $nGoodManifest = $nGoodManifest + 1;
        $manifestPass = $manifestPass.$nameExtension.'/';

    }
}
//echo "File name of Manifests that are WRONG: ".$manifestErrors;
//echo "<br>";
//echo "Number of Manifests that are WRONG: ".$nErrorsManifest;
//echo "<br>";
//echo "Name of the extension with CORRECT Manifest: ".$manifestPass;
//echo "<br>";
//echo "Number of Manifests that are CORRECT: ".$nGoodManifest;
//echo "<br>";
//echo "<br>";

// --------- VERSION----------
//BAD
$nErrorsVersion =0;
$versionErrors ='';
//MEH
$nAverageVersion =0;
$versionAverage ='';
//GOOD
$nGoodVersion = 0;
$versionPass ='';
foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    $version = addslashes($obj->version);
    if ($version === ''){
        $nErrorsVersion= $nErrorsVersion + 1;
        $versionErrors = $versionErrors.$nameExtension.'/';
    } else if (($version === '0.1') || ($version === '1.0.0')||($version === '0.0.1')||($version === '1')||($version === '1.0')){
        $nAverageVersion= $nAverageVersion + 1;
        $versionAverage = $versionAverage.$nameExtension.'/';

    } else {
        $nGoodVersion = $nGoodVersion + 1;
        $versionPass = $versionPass.$nameExtension.'/';

    }

}
//echo "File name of Version that are WRONG: ".$versionErrors;
//echo "<br>";
//echo "Number of Version that are WRONG: ".$nErrorsVersion;
//echo "<br>";
//echo "Name of the extension with GOOD Version: ".$versionPass;
//echo "<br>";
//echo "Number of Version that are GOOD: ".$nGoodVersion;
//echo "<br>";
//echo "Name of the extension with AVERAGE Version: ".$versionAverage;
//echo "<br>";
//echo "Number of Version that are AVERAGE: ".$nAverageVersion;
//echo "<br>";
//echo "<br>";

// ---------DESCRIPTION ----------
//BAD
$nErrorsDescription =0;
$descriptionErrors ='';
//MEH
$nAverageDescription =0;
$descriptionAverage ='';
//GOOD
$nGoodDescription = 0;
$descriptionGood ='';

foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    $description = addslashes($obj->description);
    if ($description == ''){
        $nErrorsDescription= $nErrorsDescription + 1;
        $descriptionErrors = $descriptionErrors.$nameExtension.'/';
    }else if (($description === '__MSG_ext_desc__') || ($description === '__MSG_extdesc__')||($description === '__MSG_appDesc__')||($description === '__MSG_description__')||($description === '__MSG_extinfo__')){
        $nAverageDescription= $nAverageDescription + 1;
        $descriptionAverage = $descriptionAverage.$nameExtension.'/';

    } else {
        $nGoodDescription = $nGoodDescription + 1;
        $descriptionGood = $descriptionGood.$nameExtension.'/';

    }
}
//echo "File name of Description that are WRONG: ".$descriptionErrors;
//echo "<br>";
//echo "Number of Description that are WRONG: ".$nErrorsDescription;
//echo "<br>";
//echo "Name of the extension with AVERAGE Description: ".$descriptionAverage;
//echo "<br>";
//echo "Number of Description that are AVERAGE: ".$nAverageDescription;
//echo "<br>";
//echo "Name of the extension with GOOD Description: ".$descriptionGood;
//echo "<br>";
//echo "Number of Description that are GOOD: ".$nGoodDescription;
//echo "<br>";
//echo "<br>";

// ---------AUTHOR ----------
//BAD
$nErrorsAuthor =0;
$authorErrors ='';
//GOOD
$nGoodAuthor = 0;
$authorGood ='';
foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    $author = addslashes($obj->author);
    if ($author == '') {
        $nErrorsAuthor = $nErrorsAuthor + 1;
        $authorErrors = $authorErrors . $nameExtension . '/';
    } else{
        $nGoodAuthor = $nGoodAuthor + 1;
        $authorGood = $authorGood.$nameExtension.'/';

    }
}
//echo "File name of Author that are WRONG: ".$authorErrors;
//echo "<br>";
//echo "Number of Author that are WRONG: ".$nErrorsAuthor;
//echo "<br>";
//echo "Name of the extension with GOOD Author: ".$authorGood;
//echo "<br>";
//echo "Number of Author that are GOOD: ".$nGoodAuthor;
//echo "<br>";
//echo "<br>";

// ---------VERSION NAME ----------
//BAD
$nErrorsVN =0;
$vNErrors ='';
//GOOD
$nGoodVN = 0;
$vNGood ='';
foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    $versionName = addslashes($obj->version_name);
    if ($versionName == '') {
        $nErrorsVN = $nErrorsVN + 1;
        $vNErrors = $vNErrors . $nameExtension . '/';
    } else{
        $nGoodVN = $nGoodVN + 1;
        $vNGood = $vNGood.$nameExtension.'/';

    }
}
//echo "File name of Version Name that are WRONG: ".$vNErrors;
//echo "<br>";
//echo "Number of Version Name that are WRONG: ".$nErrorsVN;
//echo "<br>";
//echo "Name of the extension with GOOD Version Name: ".$vNGood;
//echo "<br>";
//echo "Number of Version Name that are GOOD: ".$nGoodVN;
//echo "<br>";
//echo "<br>";

//-----------MINIMUM CHROME VERSION
//BAD
$nErrorsMCV =0;
$mCVErrors ='';
//MEH
$nAverageMCV =0;
$mCVAverage ='';
//GOOD
$nGoodMCV = 0;
$mCVGood ='';

foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    $mCV = intval($obj->minimum_chrome_version);
    if ($mCV == ''){
        $nErrorsMCV= $nErrorsMCV + 1;
        $mCVErrors = $mCVErrors.$nameExtension.'/';
    }else if ($mCV <= 50){
        $nAverageMCV= $nAverageMCV + 1;
        $mCVAverage = $mCVAverage.$nameExtension.'/';

    } else {
        $nGoodMCV = $nGoodMCV + 1;
        $mCVGood = $mCVGood.$nameExtension.'/';

    }
}
//echo "File MCV that are WRONG: ".$mCVErrors;
//echo "<br>";
//echo "Number of MCV that are WRONG: ".$nErrorsMCV;
//echo "<br>";
//echo "Name of the extension with AVERAGE MCV: ".$mCVAverage;
//echo "<br>";
//echo "Number of MCV that are AVERAGE: ".$nAverageMCV;
//echo "<br>";
//echo "Name of the extension with GOOD MCV: ".$mCVGood;
//echo "<br>";
//echo "Number of MCV that are GOOD: ".$nGoodMCV;
//echo "<br>";
//echo "<br>";

// ---------SHORT NAME ----------
//BAD
$nErrorsSN =0;
$sNErrors ='';
//GOOD
$nGoodSN = 0;
$sNGood ='';
foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    $shortName = addslashes($obj->short_name);
    if ($shortName == '') {
        $nErrorsSN = $nErrorsSN + 1;
        $sNErrors = $sNErrors . $nameExtension . '/';
    } else{
        $nGoodSN = $nGoodSN + 1;
        $sNGood = $sNGood.$nameExtension.'/';

    }
}
//echo "File name of Version Name that are WRONG: ".$sNErrors;
//echo "<br>";
//echo "Number of Version Name that are WRONG: ".$nErrorsSN;
//echo "<br>";
//echo "Name of the extension with GOOD Version Name: ".$sNGood;
//echo "<br>";
//echo "Number of Version Name that are GOOD: ".$nGoodSN;
//echo "<br>";
//echo "<br>";

// ---------KEY ----------
//BAD
$nErrorsKey =0;
$keyErrors ='';
//GOOD
$nGoodKey = 0;
$KeyGood ='';
foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    $key = addslashes($obj->key);
    if ($key == '') {
        $nErrorsKey = $nErrorsKey + 1;
        $keyErrors = $keyErrors . $nameExtension . '/';
    } else{
        $nGoodKey = $nGoodKey + 1;
        $KeyGood = $KeyGood.$nameExtension.'/';

    }
}
//echo "File name of Key that are WRONG: ".$keyErrors;
//echo "<br>";
//echo "Number of Key that are WRONG: ".$nErrorsKey;
//echo "<br>";
//echo "Name of the extension with GOOD Key: ".$KeyGood;
//echo "<br>";
//echo "Number of Key that are GOOD: ".$nGoodKey;
//echo "<br>";
//echo "<br>";

//-----------HOMEPAGE---------
//BAD
$nErrorsHomepage =0;
$homepageErrors ='';
//MEH
$nAverageHomepage =0;
$homepageAverage ='';
//GOOD
$nGoodHomepage = 0;
$homepageGood ='';

foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    $homepage = addslashes($obj->homepage_url);
    if ($homepage == ''){
        $nErrorsHomepage= $nErrorsHomepage + 1;
        $homepageErrors = $homepageErrors.$nameExtension.'/';
    } else if (strpos($homepage, "https") !== false){

        $nGoodHomepage = $nGoodHomepage + 1;
        $homepageGood = $homepageGood.$nameExtension.'/';

    } else {
        $nAverageHomepage= $nAverageHomepage + 1;
        $homepageAverage = $homepageAverage.$nameExtension.'/';


    }
}
//echo "File Homepage that are WRONG: ".$homepageErrors;
//echo "<br>";
//echo "Number of Homepage that are WRONG: ".$nErrorsHomepage;
//echo "<br>";
//echo "Name of the extension with AVERAGE Homepage: ".$homepageAverage;
//echo "<br>";
//echo "Number of Homepage that are AVERAGE: ".$nAverageHomepage;
//echo "<br>";
//echo "Name of the extension with GOOD Homepage: ".$homepageGood;
//echo "<br>";
//echo "Number of Homepage that are GOOD: ".$nGoodHomepage;
//echo "<br>";
//echo "<br>";

//-----------CONTENT SCRIPTS MATCHES---------
//BAD
$nErrorsCSM =0;
$cSMErrors ='';


//MEH
$nAverageCSM =0;
$cSMAverage ='';

$cSCSSUsed = '';
$cSJSUsed ='';
$cSRUNUsed ='';

//GOOD
$nGoodCSM = 0;
$cSMGood ='';

foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    $cSM= addslashes( $obj->content_scripts['0']->matches[0]);
    $cSCSS= addslashes( $obj->content_scripts['0']->css[0]);
    $cSJS= addslashes( $obj->content_scripts['0']->js[0]);
    $cSRUN= addslashes( $obj->content_scripts['0']->run_at);

    if ($cSM === ''){
        $nErrorsCSM= $nErrorsCSM + 1;
        $cSMErrors = $cSMErrors.$nameExtension.'/';
    } else if (strpos($cSM, "all_urls")){
        $nAverageCSM = $nAverageCSM + 1;
        $cSMAverage = $cSMAverage.$nameExtension.'/';
        $cSCSSUsed = $cSCSSUsed.$cSCSS.'/';
        $cSJSUsed = $cSJSUsed.$cSJS.'/';
        $cSRUNUsed = $cSRUNUsed.$cSRUN.'/';

    } else {
        $nGoodCSM= $nGoodCSM + 1;
        $cSMGood = $cSMGood.$nameExtension.'/';
    }
}
//echo "File CSM that are WRONG: ".$cSMErrors;
//echo "<br>";
//echo "Number of CSM that are WRONG: ".$nErrorsCSM;
//echo "<br>";
//echo "Name of the extension with AVERAGE CSM: ".$cSMAverage;
//echo "<br>";
//echo "Number of CSM that are AVERAGE: ".$nAverageCSM;
//echo "<br>";
//echo "Name of CS CSS that are AVERAGE: ".$cSCSSUsed;
//echo "<br>";
//echo "Name of CS JS that are AVERAGE: ".$cSJSUsed;
//echo "<br>";
//echo "Name of CS RUN that are AVERAGE: ".$cSRUNUsed;
//echo "<br>";
//echo "Name of the extension with GOOD CSM: ".$cSMGood;
//echo "<br>";
//echo "Number of CSM that are GOOD: ".$nGoodCSM;
//echo "<br>";
//echo "<br>";

// ---------INCOGNITO ----------
//BAD
$nErrorsIncognito =0;
$incognitoErrors ='';
//MEH
$nAverageIncognito =0;
$incognitoAverage ='';
//MEH2
$nAverageIncognito2 =0;
$incognitoAverage2 ='';
//GOOD
$nGoodIncognito = 0;
$incognitoGood ='';
foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    $incognito = addslashes($obj->incognito);
    if ($incognito == '') {
        $nErrorsIncognito = $nErrorsIncognito + 1;
        $incognitoErrors = $incognitoErrors . $nameExtension . '/';
    } else if ($incognito == 'split'){
        $nAverageIncognito= $nAverageIncognito + 1;
        $incognitoAverage = $incognitoAverage.$nameExtension.'/';

    } else if ($incognito == 'spanning'){
        $nAverageIncognito2= $nAverageIncognito2 + 1;
        $incognitoAverage2 = $incognitoAverage2.$nameExtension.'/';

    } else {
        $nGoodIncognito = $nGoodIncognito + 1;
        $incognitoGood = $incognitoGood.$nameExtension.'/';

    }
}

//echo "File name of INCOGNITO that are NOT SPECIFIED: ".$incognitoErrors;
//echo "<br>";
//echo "Number of INCOGNITO that are NOT SPECIFIED: ".$nErrorsIncognito;
//echo "<br>";
//echo "Name of the extension with SPLIT INCOGNITO: ".$nAverageIncognito;
//echo "<br>";
//echo "Number of Incognito that are SPLIT: ".$incognitoAverage;
//echo "<br>";
//echo "Name of the extension with SPANNING INCOGNITO: ".$nAverageIncognito2;
//echo "<br>";
//echo "Number of Incognito that are SPANNING: ".$incognitoAverage2;
//echo "<br>";
//echo "Name of the extension with NOT ALLOWED INCOGNITO: ".$nGoodIncognito;
//echo "<br>";
//echo "Number of INCOGNITO that are NOT ALLOWED: ".$nGoodIncognito;
//echo "<br>";
//echo "<br>";

// ---------OPTIONAL PERMISSIONS ----------
//BAD
$nErrorsOP =0;
$OPErrors ='';
//MEH
$nAverageOP =0;
$OPAverage ='';
//MEH2
$nAverageOP2 =0;
$OPAverage2 ='';
//GOOD
$nGoodOP = 0;
$OPGood ='';
foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    $OP = '';
    for ($x = 0; $x <= 5; $x++) {
        $OP = $OP.($obj->optional_permissions[strval($x)].'/');
    }
    if ($OP == '//////') {
        $nErrorsOP = $nErrorsOP + 1;
        $OPErrors = $OPErrors . $nameExtension . '/';
    } else if (($OP === 'cookies') || ($OP === 'bookmarks')||($OP === 'history')||($OP === 'tabs')||($OP === 'allTabs')){
        $nAverageOP= $nAverageOP + 1;
        $OPAverage = $OPAverage.$nameExtension.'/';

    } else if (strpos($OP, "<all_urls>")){
        $nAverageOP2= $nAverageOP2 + 1;
        $OPAverage2 = $OPAverage2.$nameExtension.'/';

    } else {
        $nGoodOP = $nGoodOP + 1;
        $OPGood = $OPGood.$nameExtension.'/';
    }
}

//echo "File name of OP that are NOT SPECIFIED: ".$OPErrors;
//echo "<br>";
//echo "Number of OP that are NOT SPECIFIED: ".$nErrorsOP;
//echo "<br>";
//echo "Name of the extension with WARNING: ".$OPAverage;
//echo "<br>";
//echo "Number of OP that are WARNING: ".$nAverageOP;
//echo "<br>";
//echo "Name of the extension with WARNING OP: ".$OPAverage2;
//echo "<br>";
//echo "Number of OP that are WARNING: ".$nAverageOP2;
//echo "<br>";
//echo "Name of the OP with GOOD: ".$OPGood;
//echo "<br>";
//echo "Number of OP that are GOOD: ".$nGoodOP;
//echo "<br>";
//echo "<br>";

//// ---------PERMISSIONS ----------
////BAD
//$nErrorsP =0;
//$PErrors ='';
////MEH
//$nAverageP =0;
//$PAverage ='';
////MEH2
//$nAverageP2 =0;
//$PAverage2 ='';
////GOOD
//$nGoodP = 0;
//$PGood ='';
//foreach($files as $file) {
//    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
//    $obj = json_decode($data);
//    $nameExtension = addslashes($obj->name);
//    $P = '';
//    for ($x = 0; $x <= 5; $x++) {
//        $P = $P.($obj->permissions[strval($x)].'/');
//
//    }
//    if ($P == '//////') {
//
//        $nErrorsP = $nErrorsP + 1;
//        $PErrors = $PErrors . $nameExtension . '/';
//    } else if (($P === 'cookies') || ($P === 'bookmarks')||($P === 'history')||($P === 'tabs')||($P === 'allTabs')||($P === 'storage')){
//
//        $nAverageP= $nAverageP + 1;
//        $PAverage = $PAverage.$nameExtension.'/';
//
//    } else if (strpos($P, "h")){
//
//        $nAverageP2= $nAverageP2 + 1;
//        $PAverage2 = $PAverage2.$nameExtension.'/';
//
//    } else {
//
//        $nGoodP = $nGoodP + 1;
//        $PGood = $PGood.$nameExtension.'/';
//    }
//}
//echo "File name of P that are NOT SPECIFIED: ".$PErrors;
//echo "<br>";
//echo "Number of P that are NOT SPECIFIED: ".$nErrorsP;
//echo "<br>";
//echo "Name of the extension with WARNING: ".$PAverage;
//echo "<br>";
//echo "Number of P that are WARNING: ".$nAverageP;
//echo "<br>";
//echo "Name of the extension with WARNING P: ".$PAverage2;
//echo "<br>";
//echo "Number of P that are WARNING: ".$nAverageP2;
//echo "<br>";
//echo "Name of the P with GOOD: ".$PGood;
//echo "<br>";
//echo "Number of P that are GOOD: ".$nGoodP;
//echo "<br>";
//echo "<br>";

//-------------ACTION-----------
//no onde does them

//-----------AUTOMATION---------
//no one does them

// ---------Background Scripts ----------
//BAD
$nErrorsBS =0;
$BSErrors ='';
//MEH
$nAverageBS =0;
$BSAverage ='';
//MEH2
$nAverageBS2 =0;
$BSAverage2 ='';
//GOOD
$nGoodBS = 0;
$BSGood ='';

$nAverageBP = 0;
$nGoodBP = 0;
$nBadBP = 0;
foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    $BS = '';
    $BP = ($obj->background->persistent);

    for ($x = 0; $x <= 5; $x++) {
        $BS = $BS.($obj->background->scripts[strval($x)].'/');
    }
    if ($BS == '//////') {
        $nErrorsBS = $nErrorsBS + 1;
        $BSErrors = $BSErrors . $nameExtension . '/';

    } else if (strpos($BS, "external")){
        $nAverageBS= $nAverageBS + 1;
        $BSAverage = $BSAverage.$nameExtension.'/';
        if ($BP =='1'){
            $nAverageBP = $nAverageBP +1;
        }

    } else if (strpos($BS, ".js") || strpos($BS, "js") || strpos($BS, "/js/") || strpos($BS, "js/") ){
        $nAverageBS2= $nAverageBS2 + 1;
        $BSAverage2 = $BSAverage2.$nameExtension.'/';
        if ($BP =='1'){
            $nGoodBP = $nGoodBP + 1;
        }

    } else {
        $nGoodBS = $nGoodBS + 1;
        $BSGood = $BSGood.$nameExtension.'/';
        if ($BP =='1'){
            $nBadBP = $nBadBP +1;
        }
    }
}

//echo "File name of BS that are NOT SPECIFIED: ".$BSErrors;
//echo "<br>";
//echo "Number of BS that are NOT SPECIFIED: ".$nErrorsBS;
//echo "<br>";
//echo "Name of the BS with EXTERNAL SCRIPT: ".$BSAverage;
//echo "<br>";
//echo "Number of BS that are EXTERNAL SCRIPT: ".$nAverageBS;
//echo "<br>";
//echo "Number of BS that are PERSITENT BACKGROUND: ".$nAverageBP;
//echo "<br>";
//echo "Name of the BS with JS: ".$BSAverage2;
//echo "<br>";
//echo "Number of BS that are JS: ".$nAverageBS2;
//echo "<br>";
//echo "Number of BS that are PERSITENT BACKGROUND: ".$nGoodBP;
//echo "<br>";
//echo "Name of the BS with BAD, no JS detected: ".$BSGood;
//echo "<br>";
//echo "Number of BS that are BAD, no js detected: ".$nGoodBS;
//echo "<br>";
//echo "Number of BS that are PERSITENT BACKGROUND: ".$nBadBP;
//echo "<br>";
//echo "<br>";
//echo "<br>";

//-----------CHROME URL OVERRIDE NEW TAB---------
//BAD
$nErrorsCUONT = 0;
$CUONTErrors ='';

//GOOD
$nGoodCUONT = 0;
$CUONTGood ='';
$namesCUONT = '';

foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    $CUONT= addslashes($obj->chrome_url_overrides->newtab);
    if ($CUONT == ''){
        $nErrorsCUONT= $nErrorsCUONT + 1;
        $CUONTErrors = $CUONTErrors.$nameExtension.'/';
    } else {
        $nGoodCUONT= $nGoodCUONT + 1;
        $CUONTGood = $CUONTGood.$nameExtension.'/';
        $namesCUONT =  $namesCUONT.addslashes($obj->chrome_url_overrides->newtab);


    }
}
//echo "File CUONT that are NOT OVERRITTEN: ".$CUONTErrors;
//echo "<br>";
//echo "Number of CUONT that are NOT OVERRITTEN: ".$nErrorsCUONT;
//echo "<br>";
//echo "Name of the extension with OVERRITTEN CUONT: ".$CUONTGood;
//echo "<br>";
//echo "Number of CUONT that are OVERRITTEN: ".$nGoodCUONT;
//echo "<br>";
//echo "NAMES of CUONT HTML that are OVERRITTEN: ".$namesCUONT;
//echo "<br>";
//echo "<br>";

//-----------SEARCH PROVIDER---------
//BAD
$nErrorsSP = 0;
$SPErrors ='';

//GOOD
$nGoodSP = 0;
$SPGood ='';
$namesSP = '';

foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    $SP = addslashes($obj->chrome_settings_overrides->search_provider->name);
    if ($SP == ''){
        $nErrorsSP= $nErrorsSP + 1;
        $SPErrors = $SPErrors.$nameExtension.'/';
    } else {
        $nGoodSP= $nGoodSP + 1;
        $SPGood = $SPGood.$nameExtension.'/';
        $namesSP =  $namesSP.addslashes($obj->chrome_settings_overrides->search_provider->name).'/';


    }
}
//echo "File SP that are NOT OVERRITTEN: ".$SPErrors;
//echo "<br>";
//echo "Number of SP that are NOT OVERRITTEN: ".$nErrorsSP;
//echo "<br>";
//echo "Name of the extension with OVERRITTEN SP: ".$SPGood;
//echo "<br>";
//echo "Number of SP that are OVERRITTEN: ".$nGoodSP;
//echo "<br>";
//echo "NAMES of SP  that are OVERRITTEN: ".$namesSP;
//echo "<br>";
//echo "<br>";

//-----------OFFLINE ENABLED---------
//BAD
$nErrorsOFFLINE = 0;
$OFFLINEErrors ='';

//GOOD
$nGoodOFFLINE = 0;
$OFFLINEGood ='';

foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    $OFFLINE = addslashes($obj->offline_enabled);
    if ($OFFLINE == ''){
        $nErrorsOFFLINE= $nErrorsOFFLINE + 1;
        $OFFLINEErrors = $OFFLINEErrors.$nameExtension.'/';
    } else {
        $nGoodOFFLINE= $nGoodOFFLINE + 1;
        $OFFLINEGood = $OFFLINEGood.$nameExtension.'/';


    }
}
//echo "File OFFLINE that are ALLOWED: ".$OFFLINEErrors;
//echo "<br>";
//echo "Number of OFFLINE that are ALLOWED: ".$nErrorsOFFLINE;
//echo "<br>";
//echo "Name of the extension with NOTALLOWED OFFLINE: ".$OFFLINEGood;
//echo "<br>";
//echo "Number of OFFLINE that are NOTALLOWED: ".$nGoodOFFLINE;
//echo "<br>";
//echo "<br>";

// ---------WEB ACCESSIBLE RESOURCES ----------
//BAD
$nErrorsWAR =0;
$WARErrors ='';
//MEH
$nAverageWAR =0;
$WARAverage ='';
//GOOD
$nGoodWAR = 0;
$WARGood ='';
foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    $WAR = '';
    for ($x = 0; $x <= 5; $x++) {
        $WAR = $WAR.($obj->web_accessible_resources[strval($x)].'/');
    }
    if ($WAR == '//////') {
        $nErrorsWAR = $nErrorsWAR + 1;
        $WARErrors = $WARErrors . $nameExtension . '/';
    } else if (strpos($WAR, "js")){
        $nAverageWAR= $nAverageWAR + 1;
        $WARAverage = $WARAverage.$nameExtension.'/';

    } else {
        $nGoodWAR = $nGoodWAR + 1;
        $WARGood = $WARGood.$nameExtension.'/';
    }
}

//echo "File name of WAR that are NOT SPECIFIED: ".$WARErrors;
//echo "<br>";
//echo "Number of WAR that are NOT SPECIFIED: ".$nErrorsWAR;
//echo "<br>";
//echo "Name of the WAR with WARNING: ".$WARAverage;
//echo "<br>";
//echo "Number of WAR that are WARNING: ".$nAverageWAR;
//echo "<br>";
//echo "Name of the WAR with GOOD: ".$WARGood;
//echo "<br>";
//echo "Number of WAR that are GOOD: ".$nGoodWAR;
//echo "<br>";
//echo "<br>";


//-----------TTS ENGINE---------
//BAD
$nErrorsTTS = 0;
$TTSErrors ='';

//GOOD
$nGoodTTS = 0;
$TTSGood ='';

foreach($files as $file) {
    $data = file_get_contents('uploadsUnzipped/' . $fileName . '/' . $file);
    $obj = json_decode($data);
    $nameExtension = addslashes($obj->name);
    $TTS = $obj->tts_engine;
    if ($TTS == null){
        $nErrorsTTS= $nErrorsTTS + 1;
        $TTSErrors = $TTSErrors.$nameExtension.'/';
    } else {
        $nGoodTTS= $nGoodTTS + 1;
        $TTSGood = $TTSGood.$nameExtension.'/';


    }
}
//echo "File TTS that are NOTALLOWED: ".$TTSErrors;
//echo "<br>";
//echo "Number of TTS that are NOTALLOWED: ".$nErrorsTTS;
//echo "<br>";
//echo "Name of the extension with ALLOWED OFFLINE: ".$TTSGood;
//echo "<br>";
//echo "Number of TTS that are ALLOWED: ".$nGoodTTS;
//echo "<br>";
//echo "<br>";


    ?>
