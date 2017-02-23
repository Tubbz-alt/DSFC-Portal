<?php 
namespace App\library {
    
    class commonFunctions {
        
        public function getWardShorForm($str) {
                $wrd = strtoupper(trim($str));
                if ($wrd == "ALDBOURNE") {
                    $str = 'Aldbourne';
                } else if ($wrd == 'KINGFISHER - AMBULATORY CARE') {
                    $str = 'Amb Care';
                } else if (strpos($wrd,'LINNET - ACUTE MEDICAL UNIT')!==FALSE) {
                    $str = 'LAMU';
                } else if (strpos($wrd,'MERCURY')!==FALSE) {
                    $str = 'Mercury';
                } else if ($wrd == 'AMPNEY') {
                    $str = 'Ampney';
                } else if ($wrd == 'BEECH') {
                    $str = 'Beech';
                } else if ($wrd == 'WCC - CATH LAB RECOVERY') {
                    $str = 'Cath Lab';
                } else if ($wrd == 'CHIPPENHAM - CEDAR WARD') {
                    $str = 'Chip - Cedar';
                } else if ($wrd == 'CHILDRENS UNIT') {
                    $str = 'Childrens';
                } else if ($wrd == 'COATE WATER UNIT') {
                    $str = 'Coate Water';
                } else if ($wrd == 'DAY SURGERY UNIT (ASU)') {
                    $str = 'ASU';
                } else if ($wrd == 'DELIVERY SUITE') {
                    $str = 'Delivery';
                } else if ($wrd == 'DOVE UNIT') {
                    $str = 'Dove';
                } else if ($wrd == 'ENDOSCOPY') {
                    $str = 'Endoscopy';
                } else if ($wrd == 'BEECH EPU') {
                    $str = 'Beech EPU';
                } else if ($wrd == 'FALCON - ASU') {
                    $str = 'Falcon';
                } else if ($wrd == 'FOREST - SEQOL') {
                    $str = 'SEQOL - Forest';
                } else if ($wrd == 'HAZEL') {
                    $str = 'Hazel';
                } else if ($wrd == 'ITU/HDU') {
                    $str = 'ITU/HDU';
                } else if ($wrd == 'JUPITER') {
                    $str = 'Jupiter';
                } else if ($wrd == 'KINGFISHER - SHORT STAY UNIT') {
                    $str = 'Short Stay';
                } else if ($wrd == 'KINGFISHER - MEDICAL TRIAGE UNIT') {
                    $str = 'Medical Traige';
                } else if ($wrd == 'WARMINSTER - LONGLEAT WARD') {
                    $str = 'Longleat';
                } else if ($wrd == 'MELDON') {
                    $str = 'Meldon';
                } else if ($wrd == 'CHIPPENHAM - MULBERRY WARD') {
                    $str = 'Chip - Mulberry';
                } else if ($wrd == 'NEPTUNE') {
                    $str = 'Neptune';
                } else if ($wrd == 'OBSERVATION WARD (A&E)') {
                    $str = 'Obs Ward';
                } else if ($wrd == 'ORCHARD - SEQOL') {
                    $str = 'SEQOL - Orchard';
                } else if ($wrd == 'DAY THERAPY UNIT') {
                    $str = 'Day Therapy';
                } else if ($wrd == 'OPD WARD') {
                    $str = 'OPD';
                } else if ($wrd == 'PAEDIATRIC ASSESSMENT UNIT') {
                    $str = 'Paediatric';
                } else if ($wrd == 'RENAL UNIT') {
                    $str = 'Renal';
                } else if ($wrd == 'SURGICAL ASSESSMENT UNIT') {
                    $str = 'SAU';
                } else if ($wrd == 'AILESBURY (SAVERNAKE)') {
                    $str = 'Ailesbury';
                } else if ($wrd == 'SHALBOURNE UNIT') {
                    $str = 'Shalbourne';
                } else if ($wrd == 'SCBU') {
                    $str = 'SCUB';
                } else if ($wrd == 'TREATMENT CTR DISCHARGE LOUNGE') {
                    $str = 'CTR Discharge';
                } else if ($wrd == 'TEST WARD DO NOT USE') {
                    $str = 'Test Ward';
                } else if ($wrd == 'Immediate Theatre') {
                    $str = 'Theatre';
                } else if ($wrd == 'THEATRES ADMISSION LOUNGE') {
                    $str = 'Theatre Admis';
                } else if ($wrd == 'TRAUMA UNIT') {
                    $str = 'Trauma';
                } else if ($wrd == 'WCC - CORONARY CARE UNIT') {
                    $str = 'CCU';
                } else if ($wrd == 'WHITEHORSE BIRTH CENTRE') {
                    $str = 'Whitehorse';
                } else if ($wrd=='TEAL - OLDER PERSONS SHORT STAY UNIT') {
                    $str = 'TOPSSU';
                }
                return $str;
        }// End of getWardShorForm
        
        
        
    }
}
?>