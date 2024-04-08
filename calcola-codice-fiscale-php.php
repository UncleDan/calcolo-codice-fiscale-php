        <?php

        // Definizione della funzione calcolaCodiceFiscale
        function calcolaCodiceFiscale($cognome, $nome, $sesso, $dataDiNascita, $codiceLuogoNascita) {
            // Funzione per rimuovere gli accenti e la cediglia
            function normalizzaStringa($stringa) {
                // Mappa delle lettere accentate con l'equivalente non accentato
                $accenti = [
                    'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
                    'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
                    'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
                    'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss',
                    'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
                    'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
                    'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o',
                    'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y'
                ];
            
                // Rimuove le cediglie e sostituisce le lettere accentate
                $stringa = strtr($stringa, $accenti);
                // Rimuove tutti i caratteri non letterali
                $stringa = preg_replace('/[^A-Z]/i', '', $stringa);
                // Converte in maiuscolo
                $stringa = strtoupper($stringa);
            
                return $stringa;
            }
             
            // Funzione per ottenere i primi tre caratteri del cognome secondo le regole specificate
            function ottieniCaratteriCognome($cognome) {
                // Rimuove gli spazi e converte la stringa in maiuscolo
                $cognome = normalizzaStringa($cognome);
                // Definisce le vocali e consonanti
                $vocali = ['A', 'E', 'I', 'O', 'U'];
                $consonanti = str_split(preg_replace('/[AEIOU]/i', '', $cognome));
                $vocaliCognome = str_split(preg_replace('/[^AEIOU]/i', '', $cognome));
            
                // Controlla il numero di consonanti e costruisce il risultato
                $risultato = '';
                if (count($consonanti) >= 3) {
                    $risultato = implode('', array_slice($consonanti, 0, 3));
                } elseif (count($consonanti) == 2) {
                    $risultato = implode('', $consonanti) . $vocaliCognome[0];
                } elseif (count($consonanti) == 1 && count($vocaliCognome) >= 2) {
                    $risultato = $consonanti[0] . $vocaliCognome[0] . $vocaliCognome[1];
                } elseif (count($consonanti) == 1 && count($vocaliCognome) == 1) {
                    $risultato = $consonanti[0] . $vocaliCognome[0] . 'X';
                } elseif (count($vocaliCognome) == 2) {
                    $risultato = $vocaliCognome[0] . $vocaliCognome[1] . 'X';
                } else {
                    // Gestisce casi non previsti
                    $risultato = '???'; // Formato non valido
                }
            
                return $risultato;
            }
        
            // Funzione per ottenere i primi tre caratteri del nome secondo le regole specificate
            function ottieniCaratteriNome($nome) {
                // Rimuove gli spazi e converte la stringa in maiuscolo
                $nome = normalizzaStringa($nome);
                // Definisce le vocali e consonanti
                $vocali = ['A', 'E', 'I', 'O', 'U'];
                $consonanti = str_split(preg_replace('/[AEIOU]/i', '', $nome));
                $vocaliNome = str_split(preg_replace('/[^AEIOU]/i', '', $nome));
            
                // Controlla il numero di consonanti e costruisce il risultato
                $risultato = '';
                if (count($consonanti) >= 4) {
                    $risultato = $consonanti[0] . $consonanti[2] . $consonanti[3];
                } elseif (count($consonanti) == 3) {
                    $risultato = implode('', $consonanti);
                } elseif (count($consonanti) == 2) {
                    $risultato = implode('', $consonanti) . $vocaliNome[0];
                } elseif (count($consonanti) == 1 && count($vocaliNome) >= 2) {
                    $risultato = $consonanti[0] . $vocaliNome[0] . $vocaliNome[1];
                } elseif (count($consonanti) == 1 && count($vocaliNome) == 1) {
                    $risultato = $consonanti[0] . $vocaliNome[0] . 'X';
                } elseif (count($vocaliNome) == 2) {
                    $risultato = $vocaliNome[0] . $vocaliNome[1] . 'X';
                } else {
                    // Gestisce casi non previsti
                    $risultato = '???'; // Formato non valido
                }
            
                return $risultato;
            }
            
            function ottieniCaratteriData($data, $sesso) {
                // Mappa dei mesi con i valori sostitutivi
                $mesi = [
                    '01' => 'A', '02' => 'B', '03' => 'C', '04' => 'D', '05' => 'E',
                    '06' => 'H', '07' => 'L', '08' => 'M', '09' => 'P', '10' => 'R',
                    '11' => 'S', '12' => 'T'
                ];
            
                // Estrae l'anno, il mese e il giorno dalla data
                $anno = substr($data, 2, 2); // Ultimi due caratteri dell'anno
                $meseCodice = $mesi[substr($data, 5, 2)]; // Mese sostitutivo
                $giorno = substr($data, 8, 2); // Giorno
            
                // Se il sesso è 'F', aggiunge 40 al giorno
                if (strtoupper($sesso) === 'F') {
                    $giorno += 40;
                }
            
                // Compone la stringa finale
                $risultato = $anno . $meseCodice . str_pad($giorno, 2, '0', STR_PAD_LEFT);
            
                return $risultato;
            }

            function generaControCodice($primi15Caratteri) {
                if (strlen($primi15Caratteri) != 15) {
                    return "?"; // La stringa deve essere di 15 caratteri.
                }
            
                // Mappatura dei valori per i caratteri in posizione pari e dispari

                 $valoriPari = [
                    '0' => 0, 'A' => 0, '1' => 1, 'B' => 1, '2' => 2, 'C' => 2, '3' => 3, 'D' => 3,
                    '4' => 4, 'E' => 4, '5' => 5, 'F' => 5, '6' => 6, 'G' => 6, '7' => 7, 'H' => 7,
                    '8' => 8, 'I' => 8, '9' => 9, 'J' => 9, 'K' => 10, 'L' => 11, 'M' => 12, 'N' => 13,
                    'O' => 14, 'P' => 15, 'Q' => 16, 'R' => 17, 'S' => 18, 'T' => 19, 'U' => 20,
                    'V' => 21, 'W' => 22, 'X' => 23, 'Y' => 24, 'Z' => 25
                ];
                
                $valoriDispari = [
                    '0' => 1, 'A' => 1, '1' => 0, 'B' => 0, '2' => 5, 'C' => 5, '3' => 7, 'D' => 7,
                    '4' => 9, 'E' => 9, '5' => 13, 'F' => 13, '6' => 15, 'G' => 15, '7' => 17, 'H' => 17,
                    '8' => 19, 'I' => 19, '9' => 21, 'J' => 21, 'K' => 2, 'L' => 4, 'M' => 18, 'N' => 20,
                    'O' => 11, 'P' => 3, 'Q' => 6, 'R' => 8, 'S' => 12, 'T' => 14, 'U' => 16,
                    'V' => 10, 'W' => 22, 'X' => 25, 'Y' => 24, 'Z' => 23
                ];
            
                $sommaPari = 0;
                $sommaDispari = 0;
            
                // Calcolo delle somme
                for ($i = 0; $i < strlen($primi15Caratteri); $i++) {
                    $carattere = strtoupper($primi15Caratteri[$i]);
                    if (($i + 1) % 2 == 0) {
                        $sommaPari += $valoriPari[$carattere];
                    } else {
                        $sommaDispari += $valoriDispari[$carattere];
                    }
                }
            
                // Calcolo del carattere di controllo
                $sommaTotale = $sommaPari + $sommaDispari;
                $resto = $sommaTotale % 26;
                $carattereControllo = chr($resto + 65); // Converti il resto in lettera (A-Z)
            
                return $carattereControllo;
            }


            // Costruzione della stringa del codice fiscale
            $codice = ottieniCaratteriCognome($cognome);
            $codice .= ottieniCaratteriNome($nome);
            $codice .= ottieniCaratteriData($dataDiNascita,$sesso);
            $codice .= strtoupper($codiceLuogoNascita);  
            $codice .= generaControCodice($codice);
        
            return $codice;
        }
        