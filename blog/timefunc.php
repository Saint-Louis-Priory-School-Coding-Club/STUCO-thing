<?php
if ($idate > 60) {
        $imins = $idate / 60;
        if ($imins > 60) {
            $ihours = $imins / 60;
            if ($ihours > 24) {
                $idays = $ihours / 24;
                if ($idays > 365 && $idays < 730) {
                    $iyears = $idays / 365;
                    $date = round($iyears) . ' year ago';
                } elseif ($idays > 730) {
                        $iyears = $days / 365;
                        $date = round($iyears) . ' years ago';
                    } elseif ($idays < 2) {
                        $date = round($idays) . ' day ago';
                    } else {
                        $date = round($idays) . ' day ago';
                    }
                } else {
                    $date = round($ihours) . ' hours ago';

                }
            }  elseif ($imins < 2) {
                $date = round($imins) . ' minute ago';
                } else {
                    $date = round($imins) . ' minutes ago'; 
                }
        }  elseif ($idays < 2) {
            $date = $idate . ' second ago';
        } else {
            $date = $idate . ' seconds ago';
        }
?>