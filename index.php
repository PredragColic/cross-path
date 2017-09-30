<?php

function did_cross_previous_path($pokreti) {
    $koordinate = [0 => [0 => true]];
    $presla_put = false;
    $broj_pokreta = count($pokreti);
    $pozicija = ['x' => 0, 'y' => 0];
    $i = 0;
    while ((!$presla_put) && ($i < $broj_pokreta)) {
        $smer = ($i + 1) % 4;
        $coordinates_to_check = [];
        switch ($smer) {
            case 0:
                $x_end = $pozicija['x'] - $pokreti[$i];
                $y_end = $pozicija['y'];

                $start = $pozicija['x'] - 1;
                foreach (range($start, $x_end) as $value) {
                    $coordinates_to_check[] = [ 'x' => $value, 'y' => $pozicija['y']];
                }
                break;

            case 1:
                $x_end = $pozicija['x'];
                $y_end = $pozicija['y'] + $pokreti[$i];

                $start = $pozicija['y'] + 1;
                foreach (range($start, $y_end) as $value) {
                    $coordinates_to_check[] = [ 'x' => $pozicija['x'], 'y' => $value];
                }
                break;

            case 2:
                $x_end = $pozicija['x'] + $pokreti[$i];
                $y_end = $pozicija['y'];

                $start = $pozicija['x'] + 1;
                foreach (range($start, $x_end) as $value) {
                    $coordinates_to_check[] = [ 'x' => $value, 'y' => $pozicija['y']];
                }
                break;

            case 3:
                $x_end = $pozicija['x'];
                $y_end = $pozicija['y'] - $pokreti[$i];

                $start = $pozicija['y'] - 1;
                foreach (range($start, $y_end) as $value) {
                    $coordinates_to_check[] = [ 'x' => $pozicija['x'], 'y' => $value];
                }
                break;
        }

        foreach ($coordinates_to_check as $xy) {

            if (isset($koordinate[$xy['x']][$xy['y']])) {
                $presla_put = true;
                return $i+1;
                //return array('uraku' => $i+1, 'presla_put' => 'presla je put');
            }

            // add the point to the list of coordinates that has been traversed
            $koordinate[$xy['x']][$xy['y']] = true;
        }

        // update the current coordinate for the next iteration
        $pozicija = ['x' => $x_end, 'y' => $y_end];
        $i++;
    }
    return 0;
    //return array('u_koraku' => 0, 'presla_put' => 'nije presla put');
}


$a = [1, 3, 2, 5, 4, 4, 6, 3, 2];

$kornjaca = did_cross_previous_path($a);
print_r($kornjaca);
?>
