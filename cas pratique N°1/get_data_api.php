<?php
/**
 * Plugin Name: death data by area
 * Simplifia technical test/ 08/04/2025
 * Description: use Geo API and Insee to get specific death data per region
 * Version: 1.0
 * Author: Philippe Lavocat
 */


// entrée ville/région/ect
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form values, using null coalescing operator to avoid warnings
    $city   = trim($_POST['city'] ?? '');
    $date   = trim($_POST['date'] ?? '');

    echo "<strong>Données trouvées pour la ville de </strong>";
    echo  htmlspecialchars($city) . "<br>";
    echo "à la date du : " . htmlspecialchars($date) . "<br>";
	

    // Call a function to process the form
    SearchDeathDatas($city, $date);
}

// Define a custom function to handle the form data
function SearchDeathDatas($city, $date) {
    // iput data check :
    $errors = [];
    if (empty($city)) {
        $errors[] = "Nom de la ville requis.";
    }
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        $errors[] = "Respectez le format de la date : aaaa/mm/jj.";
    } elseif (!strtotime($date)) {
        $errors[] = "Date invalide : ". htmlspecialchars($date);
    }
   
    // display error message (if not empty) :
    if (!empty($errors)) {
        echo "<strong>Données invalide(s) :</strong><br>";
        foreach ($errors as $error) {
            echo "- " . htmlspecialchars($error) . "<br>";
        }
		return;
    }
    // Everything is ok => Process :
    else {
        // From city Name get Region Name & Insee code :
        $regions = GetRegionCity($city);
		
		if ($regions != false) {
			// Get datas from INSEE :
			$results = DataInsee($regions, $date);
			
			// Display result :
			if ($results != false) {
				foreach ($results as $name => $nb) {
					echo "<h3>Nombre de décès le ".$date." pour la région ".$name." : </h3>";
					echo $nb;
					echo '</br></br>';
				}
			}
		}
	}
}
function DataInsee($regions, $date) {
	/* ******************* */
	/* INSEE API SIDE : */
	/* ******************* */
	// Ref : https://catalogue-donnees.insee.fr/fr/explorateur/DS_EC_DECES
	$base_url = "https://api.insee.fr/melodi/data/DS_EC_DECES";
	$results = [];
	
	$result_region = [];
	foreach ($regions as $region) {
		$geo_filter = "2022-REG-" . $region['code_region'];
		$api_url = $base_url . "?GEO=" . $geo_filter;
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($ch);
		curl_close($ch);
		
		$nb_deces = 0;
		
		if ($response !== false) {
			$data = json_decode($response, true);

			if (isset($data['observations'])) {
				foreach ($data['observations'] as $obs) {
					if (
						isset($obs['dimensions']['TIME_PERIOD']) &&
						$obs['dimensions']['TIME_PERIOD'] === $date &&
						isset($obs['measures']['OBS_VALUE_NIVEAU']['value'])
					) {
						$nb_deces += (int)$obs['measures']['OBS_VALUE_NIVEAU']['value'];
					}
				}
			}
		}
		else {
			echo "<strong>Aucunes données reçu...</strong><br>";
			return false;
		}
		$result_region[$region['region']] = $nb_deces;
	}
	return $result_region;
}

function GetRegionCity($city) {
	/* ******************* */
	/* Geo API.gouv SIDE : */
	/* ******************* */
	// Ref : https://geo.api.gouv.fr/decoupage-administratif/communes#name
	$url = "https://geo.api.gouv.fr/communes?nom=" . urlencode($city) . "&fields=region&boost=population";
    
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch);

	if (curl_errno($ch)) {
		echo 'Impossible de lire les données reçues de Gouv.api (curl error) : ' . curl_error($ch);
		return false;
	}

	curl_close($ch);

	$data = json_decode($response, true);
	if (empty($data)) {
        echo 'Aucune donnée trouvée pour cette ville.';
		return false;
    }
	
	$exactMatches = [];
	foreach ($data as $ville) {
        if (mb_strtoupper($ville['nom'], 'UTF-8') === mb_strtoupper($city, 'UTF-8')) {
            $exactMatches[] = [
                'region' => $ville['region']['nom'],
                'code_region' => $ville['region']['code']
            ];
        }
    }
	
	return $exactMatches;
}
?>